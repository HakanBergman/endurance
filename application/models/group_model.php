<?php

class Group_model extends MY_Model {

    public $has_many = array('group_plans', 'user_groups');
    public $belongs_to_many = array('school_groups');

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_users($group_id) {
        $sql = "SELECT `users`.*, user_groups.*
            FROM `users`, `user_groups`
            WHERE `user_groups`.`group_id` = ?
            AND `user_groups`.`user_id` = `users`.`id`
            AND user_groups.start_date <= now() 
            AND user_groups.end_date IS NULL
            AND (user_groups.deleted IS NULL OR user_groups.deleted = 0)
            ORDER BY fullname
            ";
        $values = array($group_id);
        $CI = & get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    function set_plan($plan, $year = null) {
        $plan->set_for_group($this, $year);
    }

    function delete($group_id) {

        $sql = "
            DELETE FROM `user_groups`
            WHERE `group_id` = ?
            ";
        $values = array($group_id);
        $CI = & get_instance();
        $CI->db->query($sql, $values);
        
        $sql = "
            DELETE FROM `groups`
            WHERE `id` = ?
            ";
        $values = array($group_id);
        $result = $CI->db->query($sql, $values);
        
        return $result;
    }
    
    function get_groups_for_school($school_id, $group_type) {
        $groups = $this->join('school_groups', 'groups.id = school_groups.group_id')->get_many_by(array('school_groups.school_id' => $school_id, 'school_groups.group_type' => $group_type));
        
        return $groups;
    }

}

/* End of file */