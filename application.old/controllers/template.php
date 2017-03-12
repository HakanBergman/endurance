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
        $schedules = $this->schedule_model->get_all('title', 'asc');
        $template_workout = $this->template_workout_model->get_many_by("user_id", $this->data['pageUser']->id);
        $workouts = array();
        foreach($template_workout as $pivot) {
            $workouts[] = $this->workout_model->get($pivot->workout_id);
        }
        
        $this->smartytpl->assign("schedules", $schedules);
        $this->smartytpl->assign("template_workout", $template_workout);
        $this->smartytpl->assign("workouts", parseWorkout($template_workout, 'template_workout'));
        
        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/template/workout.php');
        $this->smartytpl->display('footer.php');
    }
    
    public function list_workouts_ajax() {
        
        $template_workout = $this->template_workout_model->get_many_by("user_id", $this->data['pageUser']->id);
        $workouts = array();
        foreach($template_workout as $pivot) {
            $workouts[] = $this->workout_model->get($pivot->workout_id);
        }
        echo json_encode(array("result" => $workouts));
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */