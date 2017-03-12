<?php

class User_coach_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        $this->_table = "user_coaches";
        parent::__construct();
    }

    /**
     * Hämta externa tränare för en utövare
     * @param int $id
     * @return array
     */
    function get_user_coaches($id) {
        $sql = "select * 
                from user_coaches 
                join users on user_coaches.coach_id = users.id
                where user_id = ?";
        $values = array($id);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    /**
     * Hämtar utövare för en extern tränare
     * @param int $id
     * @return array
     */
    function get_coach_users($id) {
        $sql = "select * from users 
                join user_coaches on user_coaches.user_id = users.id 
                where users.type = 10 and user_coaches.coach_id = ?";
        $values = array($id);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    function has_access($coach_id, $user_id) {
        $sql = "select * from user_coaches
                where user_coaches.coach_id = ? and user_coaches.user_id = ?";
        $values = array($coach_id, $user_id);
        $CI = & get_instance();
        $query = $CI->db->query($sql, $values);

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}

/* End of file */