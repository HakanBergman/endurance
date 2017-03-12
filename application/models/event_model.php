<?php

class Event_model extends MY_Model {

    private $CI;

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        $this->CI = & get_instance();
    }

    function get_user_events_between_dates($user_id, $start, $end) {
        $sql = "SELECT id, title, type, start, end, allDay, description, moreinfo 
                from events
                where 
                user_id = ? and
                type = 3 and
                (start >= ? and
                end <= ?)";

        $values = array($user_id, $start, $end);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    function get_school_events_between_dates($school_id, $start, $end) {
        $sql = "SELECT id, title, type, start, end, allDay, description, moreinfo 
                from events
                where 
                school_id = ? and
                type = 2 and
                (start >= ? and
                end <= ?)";

        $values = array($school_id, $start, $end);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    function get_ssf_events_between_dates($start, $end) {
        $sql = "SELECT id, title, type, start, end, allDay, description 
                from events
                where 
                is_ssf = 1 and
                type = 1 and
                (start >= ? and
                end <= ?)";

        $values = array($start, $end);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

}

/* End of file */