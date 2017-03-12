<?php

class Plan_model extends MY_Model {

    public $has_many = array('group_plans');

    function __construct() {
        // Call the Model constructor
        $CI =& get_instance();
        parent::__construct();
    }

    protected function year() {
        $date = new PDate();
        return $date->year;
    }

    public function from_group($group, $year = null) {
        if(is_object($group)) {
            return $this->from('group', $group->id, $year);
        } else {
            return $this->from('group', $group, $year);
        }
    }

    public function from_user($user, $year = null) {
        /*echo "================";
        var_dump($user);
        echo "================";*/
        if(is_object($user)) {
            return $this->from('user', $user->id, $year);
        } else {
            return $this->from('user', $user, $year);
        }
    }

    function set_for_group($group, $year, $plan_id) {
        return $this->set('group', $group->id, $plan_id, $year);
    }

    function set_for_user($user, $year, $plan_id) {
        
        return $this->set('user', $user->id, $plan_id, $year);
    }

    private function from($type, $id, $year, $enddate = false) {
        
        //var_dump($id);

        $year = ($year === null) ? $this->year() : $year;

        if(!$enddate) {
        $sql = "SELECT
                plans.*,
                {$type}_plans.year
            FROM
                plans,
                {$type}_plans
            WHERE
                {$type}_plans.plan_id = plans.id AND
                {$type}_plans.{$type}_id = ? AND
                {$type}_plans.year = ?
            ";
        } else {
            $sql = "SELECT
                plans.*,
                {$type}_plans.year
            FROM
                plans,
                {$type}_plans
            WHERE
                {$type}_plans.plan_id = plans.id AND
                {$type}_plans.{$type}_id = ? AND
                {$type}_plans.year = ?
            ";
        }
        $values = array($id, $year);
        $CI =& get_instance();
        $result = $CI->db->query($sql, $values)->result();
        return $result;
    }

    protected static function set($type, $type_id, $plan_id, $year = null) {

        $year = ($year === null) ? self::year() : $year;
        
        $sql = "INSERT INTO
            {$type}_plans ({$type}_id, plan_id, year)
            VALUES(?, ?, ?)
            ON DUPLICATE KEY
            UPDATE plan_id = ?
            ";
        $values = array($type_id, $plan_id, $year, $plan_id);
        $CI =& get_instance();
        $CI->db->query($sql, $values);
        return;
    }

}

/* End of file */