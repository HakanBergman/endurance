<?php

class Day_result_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_week($user, $date) {

        $table = $this->_table;

        $sql = "
            SELECT
                `$table`.*
            FROM
                `days`,
                `$table`
            WHERE
                `days`.`id` = `$table`.`day_id` AND
                `days`.`user_id` = ? AND
                `days`.`year` = ? AND
                `days`.`period` = ? AND
                `days`.`week` = ?
            ORDER BY
                `days`.`day` ASC,
                `$table`.`segment` ASC
            ";
        $values = array($user->id, $date->year, $date->period, $date->week);
        $res = $this->db->query($sql, $values)->result();
        return $res;
    }

    public function get_day($day) {

        $c = count(Domains::get('segments'));
        $r = array();

        for ($i = 0; $i < $c; $i++) {
            $r[] = null;
        }

        $sql = "
                SELECT
                    *
                FROM
                    day_results
                WHERE
                    day_id = ?
                ORDER BY
                    segment ASC
                ";
        
        $values = array($day->id);
        $ret = $this->db->query($sql, $values)->result();

        foreach ($ret as $item) {
            $r[$item->segment] = $item;
        }

        return $r;
    }

}

/* End of file */