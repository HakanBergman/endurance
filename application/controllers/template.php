<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template extends MY_Controller {

    function __construct() {
        parent::__construct();
        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != "10") {
            show_error('errors/forbidden', 403);
        }

        $this->load->model('workout_model');
        $this->load->model('group_model');
        $this->load->model('schedule_model');
        $this->load->model('schedule_workout_model');
        $this->load->model('template_workout_model');
    }

    public function list_workouts() {
        $schedules = $this->schedule_model->get_all('display_order', 'desc');

		/* Fetch all our template workouts from DB for this specific user */
		$this->db->from("template_workouts");
		$this->db->where("user_id", $this->data['pageUser']->id);
		$workouts = $this->db->get();

		/* Add our IDs to an array */
		foreach ($workouts as $workout) { print_r($workout); }

		/* Sort them in order */
				
		return $query->result();
        
        $this->smartytpl->assign("schedules", $schedules);
        $this->smartytpl->assign("template_workout", $template_workout);
        
        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/template/workout.php');
        $this->smartytpl->display('footer.php');
    }   

}

/* End of file template.php */
/* Location: ./application/controllers/template.php */