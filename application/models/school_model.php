<?php

class School_model extends MY_Model {

    private $CI;
    public $has_many = array('school_groups');

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        $this->CI = & get_instance();
    }   

}

/* End of file */