<?php

class User_model extends MY_Model {

    public $has_many = array('user_groups');

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function login($username, $password) {
        $this->db->select('id, email, fullname, password, type');
        $this->db->from('users');
        $this->db->where('email', $username);
        $this->db->where('password', MD5($password, true));

        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function group($id) {

        $sql = "SELECT
                    `groups`.*
                FROM
                    `groups`,
                    `user_groups`
                WHERE
                    `user_groups`.`user_id` = ? AND
                    `user_groups`.`group_id` = `groups`.`id`
                ";
        $values = array($id);
        return $this->db->query($sql, $values)->result();
    }

    function current_group($id) {

        $sql = "SELECT
                    `groups`.*
                FROM
                    `groups`,
                    `user_groups`
                WHERE
                    `user_groups`.`user_id` = ? AND
                    `user_groups`.`group_id` = `groups`.`id` AND
                     user_groups.end_date IS NULL AND
                     (user_groups.deleted IS NULL OR user_groups.deleted = 0)
                    order by start_date desc
                    limit 1
                    
                    
                ";
        $values = array($id);
        $query = $this->db->query($sql, $values);

        if ($query->num_rows() > 0) {
            $row = $query->row_array(0);
            $row = json_decode(json_encode($row), FALSE);
        } else {
            $row = false;
        }

        return $row;
    }

    function userChatUpdated() {
        /* Chat updated */

        $session_data = $this->session->userdata('logged_in');
        $user = $this->get($session_data['id']);

        $sql = "SELECT DATE_FORMAT(`updated`, '%e/%c') AS `updated` FROM `user_chats` WHERE `user_id` = ?";
        $values = array($user->id);
        $res = $this->db->query($sql, $values)->result();
        if (count($res) !== 0) {
            return $res[0];
        } else {
            return false;
        }
    }

    function current_school_for_user($user_id) {
        $sql = "select school_groups.school_id from groups 
                join user_groups
                on groups.id = user_groups.group_id
                join school_groups
                on groups.id = school_groups.group_id
                where user_groups.user_id = ?
                order by start_date desc
                limit 1
            ";
        $values = array($user_id);
        $result = $this->db->query($sql, $values)->row();
        return $result;
    }

    function school_info_for_user($user_id, $school_id) {
        $sql = "select school_groups.group_id, school_groups.school_id, user_groups.user_id, DATE_FORMAT(user_groups.start_date, '%Y-%m-%d') as start_date, DATE_FORMAT(user_groups.end_date, '%Y-%m-%d') as end_date from groups 
                join user_groups
                on groups.id = user_groups.group_id
                join school_groups
                on groups.id = school_groups.group_id
                where user_groups.user_id = ?
                and school_id = ?
                limit 1";
        $values = array($user_id, $school_id);
        $result = $this->db->query($sql, $values)->row();

        return $result;
    }

    function search($searchstring) {

        $value = $this->db->escape("%" . $searchstring . "%");
        $this->db->from('users');
        $this->db->where("(type = 10 && fullname LIKE " . $value . ") || (type = 10 && email LIKE " . $value . ")");
        $result = $this->db->get()->result();

        foreach ($result as $r) {
            $school_id = $this->current_school_for_user($r->id);

            if (is_object($school_id)) {
                $r->school_id = $school_id->school_id;
            } else {
                $r->school_id = false;
            }
        }
        return $result;
    }

    function getUsersFromIds($id_array) {

        if (is_object($id_array)) {
            $id_array = json_decode(json_encode($id_array), true);
        }

        $this->db->select('id, email, fullname, password, type');
        $this->db->from('users');
        $this->db->where_in('id', $id_array);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

}

/* End of file */