<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Overview extends MY_Controller {

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

    public function index($year = false, $period = false, $week = false, $day = false ) {

        $date = $this->PDate;
        if ($year !== false && $period !== false && $week !== false) {

            if ($period < 0 || $period > 12) {
                while ($period < 0) {
                    $period += 13;
                    $year -= 1;
                }
                while ($period > 12) {
                    $period -= 13;
                    $year += 1;
                }
                return redirect('/' . $year . '/' . $period . '/' . $week);
            }

            $date->year = $year;
            $date->period = $period;
            $date->week = $week;
        }

        $weekdate = $date;
        $weekdate->day = 0;
        $weekdates = array(
            $weekdate->gregorian('d M'),
            date('d M', strtotime('+1 day', $weekdate->time())),
            date('d M', strtotime('+2 day', $weekdate->time())),
            date('d M', strtotime('+3 day', $weekdate->time())),
            date('d M', strtotime('+4 day', $weekdate->time())),
            date('d M', strtotime('+5 day', $weekdate->time())),
            date('d M', strtotime('+6 day', $weekdate->time())),
        );
        $this->smartytpl->assign('weekdates', $weekdates);
        
        $user = $this->data["pageUser"];
        $statistics = $this->Statistics;
        $statistics->user = $this->data["pageUser"];
        $sdate = $this->PDate;
        $sdate->day = 0;
        $statistics->dateFrom = clone $sdate;
        $sdate->week++;
        $sdate->day--;
        $statistics->dateTo = $sdate;

        $this->smartytpl->assign('id', $user->id);
        $this->smartytpl->assign('user', $user);
        $this->smartytpl->assign('date', $this->PDate);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->assign('day', $this->day_model->get_week($user, $this->PDate));
        $this->smartytpl->assign('day_result', parseWorkout($this->day_result_model->get_week($user, $this->PDate), 'day_result'));
        $this->smartytpl->assign('day_workout', parseWorkout($this->day_workout_model->get_week($user, $this->PDate), 'day_workout'));

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/overview.php');
        $this->smartytpl->display('footer.php');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */