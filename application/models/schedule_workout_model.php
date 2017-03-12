<?php

class Schedule_workout_model extends MY_Model {
    
    public $has_many = array( 'group_plans', 'user_groups' );

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

}

/* End of file */