<?php

class Day_model extends MY_Model {
     
    private $CI;
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        
        $this->CI =& get_instance();
    }
    
    public function get_week($user, $date) {
        
        $ret = array(null, null, null, null, null, null, null);
        
        $values = array(
            'user_id' => $user->id,
            'year' => $date->year,
            'period' => $date->period,
            'week' => $date->week
        );
        
        $ret = $this->get_many_by($values);
        
        foreach($ret as $val) {
            $ret[$val->day] = $val;
        }
        
        foreach($ret as $key => $val) {
            if($val === null) {
                $ret[$key] = new self(array(
                    'user_id' => $user,
                    'year' => $date->year,
                    'period' => $date->period,
                    'week' => $date->week,
                    'day' => $key
                ));
            }
        }
        
        return $ret;
    }
    
    public function select_or_insert($user, $date) {
        
        if(is_object($user)) {
            $userid = $user->id;
        } else {
            $userid = $user;
        }
        
        $data = array(
            "user_id" => $userid,
            "year" => $date->year,
            "period" => $date->period,
            "week" => $date->week,
            "day" => $date->day
        );
        
        $res = $this->get_by($data);

        if(count($res) == 0) {
            
            $id = $this->insert($data);
            
            $res = $this->get_by(array('id' => $id));
        }

        return $res;
    }
    
    public function select_or_false($user, $date) {
        
        $data = array(
            "user_id" => $user,
            "year" => $date->year,
            "period" => $date->period,
            "week" => $date->week,
            "day" => $date->day
        );
        
        $res = $this->get_by($data);
        if(count($res) != 0) {
            return $res;
        } else {
            return false;
        }
    }

}

/* End of file */