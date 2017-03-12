<?php

class Schedule_model extends MY_Model {
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_schedules_for_school($school_id) {
        $sql = "select schedules.id, schedules.user_id, schedules.title, schedules.global from schedules
                join user_groups on schedules.user_id = user_groups.user_id
                join school_groups on school_groups.group_id = user_groups.group_id
                where school_groups.school_id = ? order by schedules.title asc";
        
        $values = array($school_id);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

}

/* End of file */