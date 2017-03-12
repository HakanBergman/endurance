<?php

class Template_workout_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        $this->CI = & get_instance();
        $this->CI->load->model('workout_model');
        parent::__construct();
    }

    private $CI;

    function color($workout_id) {

        $parts = $this->CI->workout_model->parts(NULL, $workout_id);

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

        return $this->static_color($current);
    }

    function static_color($object) {

        if (Domains::get('parts', $object->type, "color", 0) == "value") {
            return Domains::get('parts', $object->type, "color", 1);
        }

        foreach (Domains::get('parts', $object->type, "fields") as $f) {
            if ($f->name == Domains::get('parts', $object->type, "color", 1)) {
                foreach ($f->values as $v) {
                    if ($v->key == $object->{$f->name}) {
                        return $v->color;
                    }
                }
            }
        }

        return "";
    }

    function duration($workout_id) {

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
            $a .= sprintf("IF(`parts`.`type` = %u, `parts`.`%s`, ", $key, mysql_real_escape_string($field));
            $b .= ')';
        }

        //$q = "SELECT SUM($a 0$b) AS `duration` FROM workout_parts, parts WHERE workout_parts.workout_id = ? AND workout_parts.part_id = parts.id";
        
        $q = "SELECT SUM(
                CASE 
                        WHEN `parts`.`type` = 0 THEN `parts`.`duration`
                        WHEN `parts`.`type` = 1 THEN `parts`.`duration`
                        WHEN `parts`.`type` = 2 THEN `parts`.`duration`
                        ELSE 0
                        END
                ) 
                AS `duration` FROM workout_parts, parts 
                WHERE workout_parts.workout_id = ? 
                AND workout_parts.part_id = parts.id";
        
        $query = $this->db->query($q, array($workout_id));
        return $query ? $query->row()->duration : 0;
    }

    public function get_for_user($user = null, $global = 0, $enddate = false) {
        $CI = & get_instance();
        $CI->load->model('user_model');
        $CI->load->model('user_group_model');
        $session_data = $CI->session->userdata('logged_in');
        $pageUser = $CI->user_model->get($session_data['id']);
        $user_id = $user === null ? $pageUser->id : $user->id;
        $res = $this->get_many_by(array('user_id' => $user_id, 'global' => $global));
        return $res;
    }

    public function get_global($school_id = false) {
        if (!$school_id) {
            return $this->get_many_by(array('global' => 1));
        } else {
            return $this->get_many_by(array("global" => 1, "school_id" => $school_id));
        }
    }

}

/* End of file */