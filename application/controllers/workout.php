<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data["pageUser"]->type != "50" && $this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        } else {
            $this->load->model('group_model');
            $this->load->model('plan_model');
            $this->load->model('group_plan_model');
            $this->load->model('school_group_model');
            $this->load->library('period');
        }
    }

    public function list_groups() {

        $groups = $this->group_model->with('user_groups')->join('school_groups', 'groups.id = school_groups.group_id')->order_by('groups.display_order')->order_by('groups.title')->get_many_by(array('school_groups.school_id' => $this->data['pageUser']->school_id, 'school_groups.group_type' => 10));


        $this->smartytpl->assign("groups", $groups);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/group/list.php');
        $this->smartytpl->display('footer.php');
    }

    public function sort_groups() {

        $sectionids = $this->input->post('sectionsid');
        $count = 1;
        if (is_array($sectionids)) {
            foreach ($sectionids as $sectionid) {
                // your DB query here
                $this->group_model->update($sectionid, array('display_order' => $count));
                $count++;
            }
            echo '{"status":"success"}';
        } else {
            echo '{"status":"failure", "message":"No Update happened. Could be an internal error, please try again."}';
        }
    }

    public function delete_group($id) {

        if ($this->input->post('confirm')) {

            $this->group_model->delete($id);

            redirect('/group/list', 'refresh');
        } else {
            $group = $this->group_model->with('group_plans')->get($id);

            if (!isset($group)) {
                show_404();
            }

            $students = $this->group_model->get_users($id);

            $this->smartytpl->assign("id", $id);
            $this->smartytpl->assign("group", $group);
            $this->smartytpl->assign("students", $students);

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/group/delete.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function edit_group($id, $year = false) {

        $group = $this->group_model->get($id);

        $nowyear = date('Y');

        if ($year && strlen($year) == 4) {
            
        } else {
            $year = $nowyear;
        }

        $plan = $this->plan_model->from_group($group, $year);

        if ($this->input->post('group')) {

            unset($_POST['group']['id']);
            unset($_POST['plan']['id']);

            if ($group) {
                foreach ($_POST['group'] as $key => $val) {
                    $group->$key = $val;
                }
                $this->group_model->update($group->id, $group);
            } else {
                $group = $this->group_model->insert($_POST['group']);
            }

            if (count($plan) != 0) {
                $this->plan_model->update($plan[0]->id, $_POST['plan']);
            } else {
                $plan = $this->plan_model->insert($_POST['plan']);
                $this->plan_model->set_for_group($group, $year, $plan);
            }

            redirect('/group/list', 'refresh');
        } else {

            if ($group) {
                $plan = $this->plan_model->from_group($group, $year);

                if (count($plan) !== 0) {
                    $plan = $plan[0];
                } else {
                    $plan = false;
                }
            } else {
                $plan = false;
            }

            $this->smartytpl->assign("plan", $plan);
            $this->smartytpl->assign("group", $group);
            $this->smartytpl->assign("id", $id);
            $this->smartytpl->assign("oldyear", array($nowyear + 5, $nowyear + 4, $nowyear + 3, $nowyear + 2, $nowyear + 1, $nowyear, $nowyear - 1));
            $this->smartytpl->assign("selyear", $year);
            $this->data["id"] = $id;

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/group/edit.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function add_group() {

        if ($this->input->post('group')) {

            $year = date('Y');
            $grouppost = $this->input->post('group');
            $group = array();
            $plan = array();

            $group['title'] = $grouppost['title'];
            $group_id = $this->group_model->insert($group);

            if ($group_id) {
                //Koppla grupp till aktuell skola
                $school_group['group_id'] = $group_id;
                $school_group['school_id'] = $this->data['pageUser']->school_id;
                $school_group['group_type'] = 10;
                $this->school_group_model->insert($school_group);
            }

            if ($group_id && $this->input->post('plan')) {
                foreach ($this->input->post('plan') as $key => $val) {
                    $plan[$key] = $val;
                }
                $plan_id = $this->plan_model->insert($plan);

                if ($plan_id) {
                    $group_plan = array();
                    $group_plan["group_id"] = $group_id;
                    $group_plan["plan_id"] = $plan_id;
                    $group_plan["year"] = $year;
                    $this->group_plan_model->insert($group_plan);
                }
            } else {
                $plan = plan::insert($_POST['plan']);
                $group->set_plan($plan);
            }


            redirect('/group/list', 'refresh');
        } else {
            $this->smartytpl->assign("plan", false);
            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/group/add.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function statistics($id, $date_from = false, $date_to = false) {

        if (!isset($id)) {
            show_404();
        }

        $group = $this->group_model->get($id);
        $students = $this->group_model->get_users($id);

        $this->load->library('Statistics', '', 'stats');
        $statistics = $this->stats;

        if (count($students) !== 0) {
            $statistics->user = $students;
        }

        if ($this->data['pageUser']->type == "50" || $this->data['pageUser']->type == "10") {
            $school_info = $this->user_model->school_info_for_user($id, $this->data['pageUser']->school_id);
        } elseif ($this->data['pageUser']->type == "150") {
            $school_info = false;
        } elseif ($this->data['pageUser']->type == "5") {
            if ($this->user_coach_model->has_access($this->data['pageUser']->id, $id)) {
                $school_info = false;
            } else {
                show_error('errors/forbidden', 403);
            }
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

        if ($compare) {
            $compare_stats = clone $statistics;
            $compare_stats->dateTo->oneYearAgo();
            $compare_stats->dateFrom->oneYearAgo();
        } else {
            $compare_stats = false;
        }

        $this->smartytpl->assign('group', $group);

        $this->smartytpl->assign('students', $students);

        $this->smartytpl->assign('title', $group->title);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->assign('compare_stats', $compare_stats);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/group/statistics.php');
        $this->smartytpl->display('footer.php');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */