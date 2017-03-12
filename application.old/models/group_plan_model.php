<?php

class Group_plan_model extends MY_Model {
    
    public $belongs_to_many = array( 'groups' );
    public $has_many = array( 'plans' );

    function __construct() {
        // Call the Model constructor
        parent::__construct();        
    }

}

/* End of file */