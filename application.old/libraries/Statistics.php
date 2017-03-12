<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Statistics {

    protected $user;
    protected $dateFrom;
    protected $dateTo;
    protected $CI;

    private function PDate2SpecialValue($date) {
        $date = ( is_string($date) ? $this->{"date" . $date} : $date );
        return (((
                $date->year * 13 +
                $date->period) * 4 +
                $date->week) * 7 +
                $date->day);
    }

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('user_model');
        $session_data = $this->CI->session->userdata('logged_in');
        $this->user = $this->CI->user_model->get($session_data['id']);

        $this->__set('dateFrom', 0);
        $this->__set('dateTo', time());
    }

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        switch ($name) {
            case 'user':
                $this->{$name} = $value;
                return;
            case 'dateFrom':
            case 'dateTo':
                $this->{$name} = ( $value instanceof PDate ? $value : new PDate(array('date' => $value)) );
                return;
        }
    }

    public function __clone() {
        // Force a copy of this->object, otherwise
        // it will point to same object.

        $this->dateFrom = clone $this->dateFrom;
        $this->dateTo = clone $this->dateTo;
    }

    function shape() {

        if (is_array($this->user)) {
            $ids = array();
            foreach ($this->user as $student) {
                $ids[] = $student->user_id;
            }
            $ids = join(',', $ids);
        }

        if (is_object($this->user)) {
            $userid = $this->user->id;
        } else {
            $userid = $this->user;
        }

        /* $sql = "SELECT
          AVG(`day_results`.`shape`) AS `shape`
          FROM
          `day_results`,
          `days`
          WHERE
          `day_results`.`day_id` = `days`.`id` AND
          `day_results`.`shape` > -1 AND";

          if (is_array($this->user)) {
          $sql .= "`days`.`user_id` in (" . $ids . ") AND";
          } else {
          $sql .= "`days`.`user_id` = " . $userid . " AND";
          }

          $sql .= "(((
          `days`.`year` * 13 +
          `days`.`period`) * 4 +
          `days`.`week`) * 7 +
          `days`.`day`) BETWEEN ? AND ?";
         */
        $sql = "SELECT
                        AVG(dr.`shape`) AS `shape`
                FROM
                        workout_parts wp
                LEFT JOIN parts p ON wp.part_id = p.id
                LEFT JOIN workouts w ON wp.workout_id = w.id
                LEFT JOIN day_results dr ON w.id = dr.workout_id
                LEFT JOIN days d ON d.id = dr.day_id
                WHERE p.type != 4
                AND
                dr.`shape` > -1 AND ";

        if (is_array($this->user)) {
            $sql .= " `d`.`user_id` in (" . $ids . ") AND ";
        } else {
            $sql .= " `d`.`user_id` = " . $userid . " AND ";
        }

        $sql .= "(((
                d.`year` * 13 +
                d.`period`) * 4 +
                d.`week`) * 7 +
                d.`day`) BETWEEN ? AND ?;";
        $values = array($this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));
        $ret = $this->CI->db->query($sql, $values)->result();
        return ( $ret ? -$ret["0"]->shape + 4 : false );
    }

    function day() {

        if (is_array($this->user)) {
            $ids = array();
            foreach ($this->user as $student) {
                $ids[] = $student->user_id;
            }
            $ids = join(',', $ids);
        }

        if (is_object($this->user)) {
            $userid = $this->user->id;
        } else {
            $userid = $this->user;
        }

        $sql = "SELECT
                `days`.`attributes`
                FROM
                    `days`
                WHERE";

        if (is_array($this->user)) {
            $sql .= "`days`.`user_id` in (" . $ids . ") AND";
        } else {
            $sql .= "`days`.`user_id` = " . $userid . " AND";
        }

        $sql .= "(((
                    `days`.`year` * 13 +
                    `days`.`period`) * 4 +
                    `days`.`week`) * 7 +
                    `days`.`day`) BETWEEN ? AND ?";

        $values = array($this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));
        $res = $this->CI->db->query($sql, $values)->result();

        $ret = array();

        foreach (Domains::get('day', 0, 'values') as $val) {
            $val->count = 0;
            $ret[] = $val;
        }

        foreach ($res as $row) {
            foreach ($ret as $val) {
                $val->count += ( (($row->attributes >> $val->key) & 1) ? 1 : 0 );
            }
        }

        return $ret;
    }

    function getPlan($cur_user) {

        $ret = 0;
        for ($y = $this->dateFrom->year; $y <= $this->dateTo->year; $y++) {
            if (is_object($cur_user)) {
                $user = $this->CI->user_model->get($cur_user->user_id);
            } else {
                $user = $this->CI->user_model->get($cur_user);
            }

            $this->CI->load->model('plan_model');
            $plan = $this->CI->plan_model->from_user($user, $y);

            if (is_array($plan) && isset($plan[0])) {
                $plan = $plan[0];
            } else {
                if (is_object($cur_user)) {
                    $group = $this->CI->user_model->group($cur_user->id);
                } else {
                    $group = $this->CI->user_model->group($cur_user);
                }
                if (count($group) !== 0) {
 
                    $plan = $this->CI->plan_model->from_group($group[0], $y);
                } else {
                    $plan = false;
                }
                if (is_array($plan) && isset($plan[0])) {
                    $plan = $plan[0];
                }
            }

            if (count($plan) == 0 || $plan === false) {
                continue;
            }

            $pf = ( $y == $this->dateFrom->year ? $this->dateFrom->period : 0 );
            $pt = ( $y == $this->dateTo->year ? $this->dateTo->period : 12 );

            for ($p = $pf; $p <= $pt; $p++) {

                $wf = ( $y == $this->dateFrom->year && $p == $this->dateFrom->period ? $this->dateFrom->week : 0 );
                $wt = ( $y == $this->dateTo->year && $p == $this->dateTo->period ? $this->dateTo->week : 3 );

                for ($w = $wf; $w <= $wt; $w++) {

                    $df = ( $y == $this->dateFrom->year && $p == $this->dateFrom->period && $w == $this->dateFrom->week ? $this->dateFrom->day : 0 );
                    $dt = ( $y == $this->dateTo->year && $p == $this->dateTo->period && $w == $this->dateTo->week ? $this->dateTo->day : 6 );

                    $ret += ( (($dt - $df + 1) / 7) * $plan->{"p" . $p . "w" . $w} );
                }
            }
        }
        return $ret;
    }

    function plan() {

        $ret = 0;

        if (is_array($this->user) && (is_array($this->user[0]) || is_object($this->user[0]))) {
            $ret = 0;

            foreach ($this->user as $user) {

                $ret += $this->getPlan($user);
            }
        } else {
            $cur_user = $this->user;
            $ret = $this->getPlan($cur_user);
        }

        return ($ret * 3600);
    }

    function summary($table, $user) {

        $sql = "SELECT
                SUM(`parts`.`duration`) AS `duration`,
                SUM(`workout_parts`.`primary`) AS `count`
            FROM
                `parts`,
                `workout_parts`,
                `$table`,
                `days`
            WHERE
                `days`.`id` = `$table`.`day_id` AND
                `workout_parts`.`workout_id` = `$table`.`workout_id` AND
                `workout_parts`.`part_id` = `parts`.`id` AND
                `days`.`user_id` = ? AND
                (((
                    `days`.`year` * 13 +
                    `days`.`period`) * 4 +
                    `days`.`week`) * 7 +
                    `days`.`day`) BETWEEN ? AND ? limit 1";
        $values = array($user, $this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));

        $ret = $this->CI->db->query($sql, $values)->result();
        return $ret[0];
    }

    function table($table, $debug = false) {

        $a = '';
        $b = '';

        $statgroup = array();

        if (is_array($this->user)) {
            $ids = array();
            foreach ($this->user as $student) {
                $ids[] = $student->user_id;
            }
            $ids = join(',', $ids);
        }

        foreach (Domains::get('parts') as $key => $part) {
            if (isset($part->statgroup)) {
                $statgroup[$key] = $part->statgroup;
                $a .= sprintf("IF(`parts`.`type` = %u, `parts`.`%s`, ", $key, mysql_real_escape_string($part->fields[$part->statgroup]->name));
                $b .= ')';
            }
        }

        $sql = "SELECT
                `parts`.`type`,
                $a `parts`.`type`$b AS `title_key`,
                SUM(`parts`.`duration`) AS `duration`,
                SUM(`workout_parts`.`primary`) AS `count_primary`,
                SUM(`parts`.`amount`) AS `amount`,
                COUNT(*) AS `count_total`,
                SUM(
                CASE

                        WHEN `workout_parts`.`primary` = 0 THEN 0
                        WHEN parts.type = 0 THEN 
                        `workout_parts`.`primary` / (
                                SELECT SUM(`primary`)
				FROM `workout_parts` AS `wp`
				JOIN parts on `wp`.`part_id` = `parts`.`id`
				WHERE `wp`.`workout_id` = `$table`.`workout_id` and parts.type = 0
                        )
                        ELSE
                        1
                END
                ) AS `count`
            FROM
                `parts`,
                `workout_parts`,
                `$table`,
                `days`
            WHERE
                `days`.`id` = `$table`.`day_id` AND
                `workout_parts`.`workout_id` = `$table`.`workout_id` AND
                `workout_parts`.`part_id` = `parts`.`id` AND";

        if (is_array($this->user)) {
            $sql .= "`days`.`user_id` in (" . $ids . ") AND";
        } else {
            $sql .= "`days`.`user_id` = " . $this->user . " AND";
        }

        $sql .= "(((
                    `days`.`year` * 13 +
                    `days`.`period`) * 4 +
                    `days`.`week`) * 7 +
                    `days`.`day`) BETWEEN ? AND ?
            GROUP BY
                `parts`.`type`,
                `title_key`
            HAVING
                `count` > 0 OR
                `duration` > 0 OR
                `amount` > 0 OR
                `count_total` > 0";

        $values = array($this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));
        $ret = $this->CI->db->query($sql, $values)->result();  
        
        if ($debug) {
            error_log($this->CI->db->last_query());
        }
        foreach ($ret as $val) {
            $val->title_val = (
                    isset($statgroup[$val->type]) ?
                            Domains::key('parts', $val->type, 'fields', $statgroup[$val->type], 'values', $val->title_key)->val :
                            Domains::get('parts', $val->type, 'title')
                    );
        }
        return $ret;
    }

    function activity($user) {
        return $this->activity_or_intensity('activity', $user);
    }

    function intensity($user) {
        return $this->activity_or_intensity('intensity', $user);
    }

    private function activity_or_intensity($activity_or_intensity, $user) {


        if (is_array($user)) {
            $ids = array();
            foreach ($user as $student) {
                $ids[] = $student->id;
            }
            $ids = join(',', $ids);
        }

        $sql = "
            SELECT
                `parts`.`$activity_or_intensity`,
                SUM(`parts`.`duration`) AS `duration`,
                SUM(`workout_parts`.`primary`) AS `count_primary`,
                SUM(
                CASE

                        WHEN `workout_parts`.`primary` = 0 THEN 0
                        WHEN parts.type = 0 THEN 
                        `workout_parts`.`primary` / (
                                SELECT SUM(`primary`)
				FROM `workout_parts` AS `wp`
				JOIN parts on `wp`.`part_id` = `parts`.`id`
				WHERE `wp`.`workout_id` = `day_results`.`workout_id` and parts.type = 0
                        )
                        ELSE
                        1
                END
                ) AS `count`
            FROM
                `parts`,
                `workout_parts`,
                `day_results`,
                `days`
            WHERE
                `parts`.`type` = '0' AND
                `workout_parts`.`part_id` = `parts`.`id` AND
                `workout_parts`.`workout_id` = `day_results`.`workout_id` AND
                `day_results`.`day_id` = `days`.`id` AND";
        if (isset($ids)) {
            $sql .= "`days`.`user_id` in (" . $ids . ") AND";
        } else {
            $sql .= "`days`.`user_id` = " . $user . " AND";
        }
        $sql .= "(((
                    `days`.`year` * 13 +
                    `days`.`period`) * 4 +
                    `days`.`week`) * 7 +
                    `days`.`day`) BETWEEN ? AND ?
            GROUP BY
                `parts`.`$activity_or_intensity`
            ";
        $values = array($this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));
        $ret = $this->CI->db->query($sql, $values)->result();
        //echo $this->CI->db->last_query();

        foreach ($ret as $val) {
            $val->duration = (int) $val->duration;
            $val->count_primary = (int) $val->count_primary;
            $val->count = (float) $val->count;
            $val->title = Domains::get('parts', 0, 'fields', ( $activity_or_intensity == 'intensity' ? 1 : 0), 'values', $val->$activity_or_intensity, 'val');
        }

        return $ret;
    }

    function activity_and_intensity($user) {

        if (is_array($user)) {
            $ids = array();
            foreach ($user as $student) {
                $ids[] = $student->id;
            }
            $ids = join(',', $ids);
        }

        $sql = "
            SELECT
                `parts`.`activity` AS `activity_key`,
                `parts`.`intensity` AS `intensity_key`,
                SUM(`parts`.`duration`) AS `duration`,
                SUM(`workout_parts`.`primary`) AS `count_primary`,
                SUM(
                CASE

                        WHEN `workout_parts`.`primary` = 0 THEN 0
                        WHEN parts.type = 0 THEN 
                        `workout_parts`.`primary` / (
                                SELECT SUM(`primary`)
				FROM `workout_parts` AS `wp`
				JOIN parts on `wp`.`part_id` = `parts`.`id`
				WHERE `wp`.`workout_id` = `day_results`.`workout_id` and parts.type = 0
                        )
                        ELSE
                        1
                END
                ) AS `count`
            FROM
                `parts`,
                `workout_parts`,
                `day_results`,
                `days`
            WHERE
                `parts`.`type` = '0' AND
                `workout_parts`.`part_id` = `parts`.`id` AND
                `workout_parts`.`workout_id` = `day_results`.`workout_id` AND
                `day_results`.`day_id` = `days`.`id` AND";
        if (is_array($user)) {
            $sql .= "`days`.`user_id` in (" . $ids . ") AND ";
        } else {
            $sql .= "`days`.`user_id` = " . $user . " AND ";
        }
        $sql .= "(((
                    `days`.`year` * 13 +
                    `days`.`period`) * 4 +
                    `days`.`week`) * 7 +
                    `days`.`day`) BETWEEN ? AND ?
            GROUP BY
                `parts`.`activity`,
                `parts`.`intensity`
            ";

        $values = array($this->PDate2SpecialValue('From'), $this->PDate2SpecialValue('To'));
        $ret = $this->CI->db->query($sql, $values)->result();

        foreach ($ret as $val) {
            $val->duration = (int) $val->duration;
            $val->count_primary = (int) $val->count_primary;
            $val->count = (float) $val->count;
            $val->activity_val = Domains::key('parts', 0, 'fields', 0, 'values', $val->activity_key)->val;
            $val->intensity_val = Domains::key('parts', 0, 'fields', 1, 'values', $val->intensity_key)->val;
        }

        return $ret;
    }

}
