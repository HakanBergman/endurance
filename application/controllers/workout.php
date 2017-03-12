<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Workout extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data["pageUser"]->type != "50" && $this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        } else {
            $this->load->model('workout_model');
        }
    }

    public function sort_groups() {

        $sectionids = $this->input->post('sectionsid');
        $count = 1;
        if (is_array($sectionids)) {
            foreach ($sectionids as $sectionid) {
                // your DB query here
                $this->workout_model->update($sectionid, array('display_order' => $count));
                $count++;
            }
            echo '{"status":"success"}';
        } else {
            echo '{"status":"failure", "message":"No Update happened. Could be an internal error, please try again."}';
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */