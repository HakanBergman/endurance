<?php

class Password_reminders_model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = 'password_reminders';
    }

}

/* End of file */