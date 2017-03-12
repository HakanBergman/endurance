<?php

class User_group_model extends MY_Model {
    
    public $belongs_to_many = array( 'users' );
    public $has_many = array( 'groups' );

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
}

/* End of file */