<?php

class Workout_model extends MY_Model {

    public $has_many = array('workout_parts');

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function parts($parts = null, $workout_id = FALSE) {

        if ($parts !== null) {
            return $this->setParts($parts);
        }

        if ($parts === null) {
            $sql = "SELECT
                    parts.*,
                    workout_parts.primary,
                    workout_parts.*
                FROM
                    parts, workout_parts
                WHERE
                    workout_parts.part_id = parts.id AND
                    workout_parts.workout_id = ?
                ORDER BY
                    workout_parts.order ASC";
            $values = array($workout_id);
            $parts = $this->db->query($sql, $values)->result();
        }

        return $parts;
    }

    function setParts($parts) {

        foreach ($parts as $key => $part) {

            if (is_array($part)) {
                $part = (object) $part;
            }

            $sql = "INSERT INTO `workout_parts`
                (`workout_id`, `part_id`, `order`, `primary`)
                VALUES(?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                `part_id` = ?, `primary` = ?
                ";
            $values = array($part->workout_id, $part->id, $key, $part->primary, $part->id, $part->primary);
            $this->db->query($sql, $values);
        }

        $sql = "DELETE FROM `workout_parts`
            WHERE `workout_id` = ?
            AND `order` >= ?";
        $values = array($part->workout_id, count($parts));
        $this->db->query($sql, $values);

        $this->parts = null;
    }

    function color($id) {

        $this->db->select('*');
        $this->db->from('workout_parts');
        $this->db->join('parts', 'comments.id = blogs.id');

        $query = $this->db->get();
        //$parts = $this->workout()->parts();


        if (count($parts) == 0) {
            return '';
        }

        $current = $parts[0];

        foreach ($parts as $part) {

            if ($current->primary < $part->primary) {
                $current = $part;
                continue;
            }

            if ($current->primary > $part->primary) {
                continue;
            }

            switch ($part->type) {
                case 0:
                    if ($current->type != 0 || $part->intensity > $current->intensity) {
                        $current = $part;
                    }
                    break;
            }
        }

        return $current->color();

        /* FIXME */

        $ret = Buzzstmt::construct(
                        "
            SELECT
                MAX(`part`.`intensity`) AS `intensity`
            FROM
                `workout_part`,
                `part`
            WHERE
                `workout_part`.`workout_id` = '?' AND
                `workout_part`.`part_id` = `part`.`id` AND
                `part`.`type` = '0'
            ", $this->_workout
                )->one();

        return '#ff' . dechex((5 - ($ret ? $ret->intensity : 4)) * 51) . '00';
    }

    function duration() {

        $a = '';
        $b = '';

        foreach (Domains::get('parts') as $key => $part) {

            $field = null;

            foreach ($part->fields as $f) {
                if (isset($f->role) && $f->role == 'duration') {
                    $field = $f->name;
                }
            }

            if ($field === null) {
                continue;
            }

            $a .= sprintf("IF(`part`.`type` = %u, `part`.`%s`, ", $key, mysql_real_escape_string($field));
            $b .= ')';
        }

        $ret = Buzzstmt::construct(
                        "
            SELECT
                SUM(
                    $a 0$b
                ) AS `duration`
            FROM
                `workout_part`,
                `part`
            WHERE
                `workout_part`.`workout_id` = '?' AND
                `workout_part`.`part_id` = `part`.`id`
            ", $this->workout_id
                )->one();

        return $ret ? $ret->duration : 0;
    }
    
    function get_workout($id) {
         $sql = "SELECT * FROM `workouts` WHERE `id` = ? LIMIT 0,1";
         $values = array($id);

         $query = $this->db->query($sql, $values);

         if ($query->num_rows() > 0)
         {
            $row = $query->row_array(0);
            $row = json_decode(json_encode($row), FALSE);
         } else {
            $row = false;
         }
         
         return $row;
    }

}

/* End of file */