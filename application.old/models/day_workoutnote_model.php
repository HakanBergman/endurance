<?php

class Day_workoutnote_model extends MY_Model {

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
        return $this->db->query($sql, $values)->result();
    }

}

/* End of file */