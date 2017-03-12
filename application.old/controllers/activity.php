<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data["pageUser"]->type != "10") {
            show_error('errors/forbidden', 403);
        } else {
            $this->load->model('day_model');
            $this->load->model('workout_model');
            $this->load->model('template_workout_model');
            $this->load->model('day_result_model');
            $this->load->model('day_workout_model');
            $this->load->library('PDate', '', 'PDate');
            $this->load->library('Statistics', '', 'Statistics');
        }
    }

    public function index($year = false, $period = false, $week = false, $day = false) {
        
        $user = $this->data["pageUser"];
        $date = $this->PDate;
        //$date->day = date('N') - 1;
        //var_dump($date);
        //echo $date->gregorian("Y - m - d");
     
        if (strpos($year,'-') !== false) {
            $date = new PDate(array("date" => strtotime($year)));
            
        } elseif ($year !== false && $period !== false && $week !== false && $day !== false) {
            $date->year = $year;
            $date->period = $period;
            $date->week = $week;
            $date->day = $day;
        }

        $day = $this->day_model->select_or_false($user->id, $date);
        
        if ($this->input->post('day')) {
            
            if ($day === false) {
               $day = $this->day_model->select_or_insert($user->id, $date);
            }
            Domains::parse(Domains::get('day'), $this->input->post('day'), $day);
         
            $res = $this->day_model->update($day->id, $day);
            if($res) {
                $_SESSION['notice'] = array(array("positive" => true, "message" => 'Uppgifterna sparade'));
            }
            $day = $this->day_model->select_or_false($user->id, $date);
        }
        
        $this->smartytpl->assign('day', $day);

        $this->smartytpl->assign('url', "/activity/" . implode("/", func_get_args()));
        $this->smartytpl->assign('date', $date);

        $segments = Domains::get('segments');
        $this->smartytpl->assign('segments', $segments);

        if ($day) {
            $day_workout = json_decode(parseWorkout($this->day_workout_model->get_day($day), 'day_workout'));
            $this->smartytpl->assign('day_workout', $day_workout);
            $day_result = json_decode(parseWorkout($this->day_result_model->get_day($day), 'day_result'));
            $this->smartytpl->assign('day_result', $day_result);
        } else {
            $ea = array();
            for ($i = 0; $i < count($segments); $i++) {
                $ea[] = null;
            }
            $this->smartytpl->assign('day_workout', $ea);
            $this->smartytpl->assign('day_result', $ea);
        }

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/activity.php');
        $this->smartytpl->display('footer.php');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
