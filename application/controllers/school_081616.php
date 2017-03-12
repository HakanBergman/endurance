<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class School extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('group_model');
        $this->load->model('user_model');
        $this->load->model('school_model');
        $this->load->library('PDate', '', 'PDate');
        $this->load->library('Statistics', '', 'stats');
    }

    public function statistics($id, $date_from = false, $date_to = false) {

        
        if(!isset($id)) {
            show_404();
        }
        
        $school = $this->school_model->get($id);
        
        if(!$school) {
            show_404();
        }
        
        $this->load->library('Statistics', '', 'stats');
        $statistics = $this->stats;
        
        
        /*Hämta alla användare på skolan*/
        $groups = $this->group_model->get_groups_for_school($id, 10);
        
        $students = array();
        foreach($groups as $group) {
            $group_students = $this->group_model->get_users($group->group_id);  
            foreach ($group_students as $student) {
                $students[] = $student;
            }
        }
        
        $statistics->user = $students;

        if ($this->data['pageUser']->type == "50") {
            $school_info = $this->user_model->school_info_for_user($this->data['pageUser']->id, $this->data['pageUser']->school_id);
            if($id != $school_info->school_id) {
                show_error('errors/forbidden', 403);
            }
        } elseif ($this->data['pageUser']->type == "150") {
            $school_info = false;
        } else {
            show_error('errors/forbidden', 403);
        }

        if (!$school_info || !isset($school_info->end_date)) {
            $enddate = false;
        } else {
            $enddate = strtotime($school_info->end_date);
        }

        if (isset($_POST['f'], $_POST['t'])) {

            if ($enddate && strtotime($_POST['f']) >= $enddate) {
                $statistics->dateFrom = $enddate;
            } else {
                $statistics->dateFrom = strftime($_POST['f']);
            }

            if ($enddate && strtotime($_POST['t']) >= $enddate) {
                $statistics->dateTo = $enddate;
            } else {
                $statistics->dateTo = strftime($_POST['t']);
            }
        } elseif ($date_to) {

            if ($enddate && strtotime($date_from) >= $enddate) {
                $statistics->dateFrom = $enddate;
            } else {
                $statistics->dateFrom = strftime($date_from);
            }

            if ($enddate && strtotime($date_to) >= $enddate) {
                $statistics->dateTo = $enddate;
            } else {
                $statistics->dateTo = strftime($date_to);
            }
        } else {
            if ($enddate && strtotime(date("Y-m-d", time())) > $enddate) {
                $date = new PDate(array('date' => $enddate));
            } else {
                $date = new PDate();
            }
            $date->week = 0;
            $date->day = 0;

            $statistics->dateFrom = clone $date;
            if ($enddate && time() > $enddate) {
                
            } else {
                $date->period++;
                $date->day--;
            }

            $statistics->dateTo = $date;
        }

        $compare = !empty($_POST['compare']);
        
        if($compare) {
            $compare_stats = clone $statistics;  
            $compare_stats->dateTo->oneYearAgo();
            $compare_stats->dateFrom->oneYearAgo();
            
        } else {
            $compare_stats = false;
        }

        $this->smartytpl->assign('title', $school->title);
        $this->smartytpl->assign('school', $school);
        $this->smartytpl->assign('students', $students);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->assign('compare_stats', $compare_stats);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/school/statistics.php');
        $this->smartytpl->display('footer.php');
    }

    public function edit($id) {

        if ($this->data['pageUser']->type != "100") {
            show_error('errors/forbidden', 403);
        }

        if(!isset($id)) {
            show_404();
        }

        $school = $this->school_model->get($id);

        if(!$school) {
            show_404();
        }

        if ($this->input->post('school_title')) {

            $this->form_validation->set_rules('school_title', 'Titel', 'required');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('/school/edit/' . $id);
            } else {
                $school = array();
                $school['title'] = $this->input->post('school_title');
                $this->school_model->update($id, $school);
                redirect('/teacher/list', 'refresh');
            }
        } else {
            $teacher = $this->user_model->get($id);
            $this->data["school"] = $school;
            $this->data["id"] = $id;
            $this->load->view('header', $this->data);
            $this->load->view('pages/school/edit', $this->data);
            $this->load->view('footer');
        }
    }



}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */