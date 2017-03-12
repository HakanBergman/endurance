<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Schedule extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data['pageUser']->type != "50") {
            show_error('errors/forbidden', 403);
        }

        $this->load->model('group_model');
        $this->load->model('schedule_model');
        $this->load->model('schedule_workout_model');
        $this->load->model('template_workout_model');
        $this->load->model('workout_model');
        $this->load->model('day_model');
        $this->load->model('day_workout_model');
        $this->load->library('PDate', '', 'now');
    }

    public function list_schedule() {
        
        
        $schedules = $this->schedule_model->get_schedules_for_school($this->data['pageUser']->school_id);
        $my_schedules = array();
        $others_schedules = array();
        foreach($schedules as $schedule) {
            if($schedule->user_id == $this->data['pageUser']->id) {
                $my_schedules[] = $schedule;
            } else {
                $others_schedules[] = $schedule;
            }
        }
        
        $this->smartytpl->assign("my_schedules", $my_schedules);
        $this->smartytpl->assign("others_schedules", $others_schedules);
        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/schedule/list.php');
        $this->smartytpl->display('footer.php');
    }

    public function delete_schedule($id) {

        //Kolla att programmet finns
        $schedule = $this->schedule_model->get($id);

        if (!isset($schedule)) {
            show_404();
        } else {
            if ($this->input->post('confirm')) {
                $this->schedule_model->delete($id);
                $_SESSION['notice'] = array(array("positive" => true, "message" => "Programmet togs bort."));
                redirect('/schedule/list', 'refresh');
            } else {
                $this->smartytpl->assign('schedule', $schedule);
                $this->smartytpl->assign('id', $id);
                $this->smartytpl->display('header.php');
                $this->smartytpl->display('pages/schedule/delete.php');
                $this->smartytpl->display('footer.php');
            }
        }
    }

    public function edit_schedule($id) {

        if ($this->input->post('confirm')) {

            $this->form_validation->set_rules('schedule[title]', 'Titel', 'trim|required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('student/edit/' . $id);
            } else {
                $schedule = $this->schedule_model->get($id);
                $schedulepost = $this->input->post('schedule');
                $schedule->title = $schedulepost["title"];
                $schedule->global = !empty($_POST['schedule']['global']);

                //Uppdatera program
                $success = $this->schedule_model->update($id, $schedule);

                if ($success) {
                    $_SESSION['notice'] = array(array("positive" => true, "message" => "Programmet uppdaterades"));
                    redirect('/schedule/list', 'refresh');
                } else {
                    $_SESSION['notice'] = array(array("positive" => false, "message" => "Programmet kunde inte sparas."));
                    redirect('/schedule/edit/' . $id, 'refresh');
                }
            }
        } else {
            $schedule = $this->schedule_model->get($id);

            if ($schedule) {
                $this->smartytpl->assign('id', $id);
                $this->smartytpl->assign('schedule', $schedule);
                $this->smartytpl->display('header.php');
                $this->smartytpl->display('pages/schedule/edit.php');
                $this->smartytpl->display('footer.php');
            } else {
                show_404();
            }
        }
    }

    public function add_schedule() {

        if ($this->input->post('confirm')) {

            $this->form_validation->set_rules('schedule[title]', 'Title', 'trim|required|xss_clean');
            $current_user = $this->data['pageUser'];
            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('schedule/add');
            } else {
                $schedule = array();
                $schedulepost = $this->input->post('schedule');
                $schedule['title'] = $schedulepost["title"];
                $schedule['user_id'] = $current_user->id;
                $schedule['global'] = !empty($_POST['schedule']['global']);
                $schedule_id = $this->schedule_model->insert($schedule);
                redirect('/schedule/list', 'refresh');
            }
        } else {
            $this->smartytpl->assign('schedule', false);
            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/schedule/add.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function duplicate_schedule($id) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('schedule[title]', 'Title', 'trim|required|xss_clean');
            $current_user = $this->data['pageUser'];
            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('schedule/list');
            } else {

                $oldschedule = $this->schedule_model->get($id);

                if ($oldschedule) {
                    $schedule = array();
                    $schedulepost = $this->input->post('schedule');
                    $schedule['title'] = $schedulepost["title"];
                    $schedule['user_id'] = $current_user->id;
                    $schedule_id = $this->schedule_model->insert($schedule);

                    $workouts = $this->schedule_workout_model->get_many_by(array("schedule_id" => $id));
                    foreach ($workouts as $w) {
                        $insertarray = array(
                            'schedule_id' => $schedule_id,
                            'workout_id' => $w->workout_id,
                            'week' => $w->week,
                            'day' => $w->day,
                            'segment' => $w->segment
                        );
                        $schedule_workout_id = $this->schedule_workout_model->insert($insertarray);
                    }
                } else {
                    show_404();
                }

                redirect('/schedule/list', 'refresh');
            }
        } else {

            $schedule = $this->schedule_model->get($id);

            if ($schedule) {

                $this->smartytpl->assign('id', $id);
                $this->smartytpl->assign('schedule', $schedule);
                $this->smartytpl->display('header.php');
                $this->smartytpl->display('pages/schedule/duplicate.php');
                $this->smartytpl->display('footer.php');
            } else {
                show_404();
            }
        }
    }

    public function summary() {
        if (is_numeric($this->input->post('period')) && is_numeric($this->input->post('week'))) {
            $year = $this->input->post('year'); 
            if ($this->input->post('week') != 5) {
                $sql = "SELECT
                            plans." . 'p' . $this->input->post('period') . 'w' . $this->input->post('week') . " AS h
                        FROM
                            group_plans,
                            plans
                        WHERE
                            group_plans.group_id = ? AND
                            group_plans.plan_id = plans.id";

                if($year) {
                    $sql .= " AND group_plans.year = ?";
                    $values = array($this->input->post('group'), $year);
                } else {
                    $values = array($this->input->post('group'));
                }

                $re = $this->db->query($sql, $values)->result();
                if (isset($re[0])) {
                    printf("%u:%02u", $re[0]->h, 0);
               } else {
                    echo "n/a";
                }
            
                
               } else {
                $sql = "SELECT
           (plans.p" . $this->input->post('period') . "w0 + plans.p" . $this->input->post('period') . "w1 + plans.p" . $this->input->post('period') . "w2 + plans.p" . $this->input->post('period') . "w3) AS h
        FROM
            group_plans,
            plans
        WHERE
            group_plans.group_id = ? AND
            group_plans.plan_id = plans.id";

                $values = array($this->input->post('group'));

                $re = $this->db->query($sql, $values)->result();
                if (isset($re[0])) {
                    printf("%u:%02u", $re[0]->h, 0);
                } else {
                    echo "n/a";
                }
            }
            //echo $this->db->last_query();
            return true;
        } else {
            return false;
        }
    }

    public function calendar($id, $week = 0) {
                
        $schedule = $this->schedule_model->get($id);
        
        if ($schedule) {
            
            $date = date('Y-m-d H:i:s');
            $now = new PDate(array('date' => $date));
            $this->smartytpl->assign('now', $now);

            $this->smartytpl->assign('id', $id);
            $this->smartytpl->assign('schedule', $schedule);
            $this->smartytpl->assign('week', $week);
            $groups = $this->group_model->get_groups_for_school($this->data['pageUser']->school_id, 10);
            $this->smartytpl->assign('groups', $groups);

            if ($week == 5) { /* Översikt */

                for ($i = 0; $i < 4; $i++) {
                    $schedule_workouts = $this->schedule_workout_model->get_many_by(array("schedule_id" => $id, "week" => $i));
                    $schedule_workouts = parseWorkout($schedule_workouts, 'schedule_workout');
                    
                    $this->smartytpl->assign('schedule_workout' . ((int) $i + 1), $schedule_workouts);
                }
                
            } else { /* Vecka 1-4 */

                $schedule_workouts = $this->schedule_workout_model->get_many_by(array("schedule_id" => $id, "week" => $week));
                $schedule_workouts = parseWorkout($schedule_workouts, 'schedule_workout');
                $this->smartytpl->assign('schedule_workout', $schedule_workouts);
            }
           
            $current_user = $this->data['pageUser'];

            //Användarens pass
            $template_workout = $this->template_workout_model->get_many_by(array("user_id" => $current_user->id, "global" => 0));
            $template_workout = parseWorkout($template_workout, 'template_workout');
            $this->smartytpl->assign('template_workout', $template_workout);

            //Globala pass
            $template_workout_global = $this->template_workout_model->get_many_by(array("school_id" => $current_user->school_id, "global" => 1));
            $template_workout_global = parseWorkout($template_workout_global, 'template_workout');
            $this->smartytpl->assign('template_workout_global', $template_workout_global);

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/schedule/calendar.php');
            $this->smartytpl->display('footer.php');
        } else {
            show_404();
        }
    }

    public function assign($id) {
        $schedule = $this->schedule_model->get($id);
        $date = $this->now;

        if ($this->input->post('users') && $this->input->post('date')) {
            //VISA VALD/VALDA FÖR ATT BEKRÄFTA
            foreach ($this->input->post('users') as $userid) {
                if (!ctype_digit($userid)) {
                    return false;
                }
            }

            $this->smartytpl->assign('action', 'confirm');
            $date->year = (int) substr($this->input->post('date'), 0, 4);
            $date->period = (int) substr($this->input->post('date'), 5);
            $this->smartytpl->assign('date', $date);
            $sql = "SELECT *, IFNULL(( SELECT COUNT(day_workouts.id) FROM days, day_workouts WHERE day_workouts.day_id = days.id AND days.user_id = users.id AND days.year = '?' AND days.period = '?' GROUP BY days.user_id ), 0) AS count FROM users WHERE id IN (" . implode(', ', $this->input->post('users')) . ") ";
            $values = array($date->year, $date->period);
            $users = $this->db->query($sql, $values)->result();
            $this->smartytpl->assign("users", $users);
        } elseif ($this->input->post('tasks') && $this->input->post('date')) {
            //INSERT
            $date->year = (int) substr($this->input->post('date'), 0, 4);
            $date->period = (int) substr($this->input->post('date'), 5);
            $this->smartytpl->assign('date', $date);
            $work = $this->schedule_workout_model->get_many_by(array('schedule_id' => $schedule->id));

            foreach ($this->input->post('tasks') as $userid => $task) {

                if ($task == 'replace') {
                    $sql = "DELETE FROM day_workouts USING day_workouts, days WHERE day_workouts.day_id = days.id AND days.year = '?' AND days.period = '?' AND days.user_id = '?'";
                    $values = array($date->year, $date->period, $userid);
                    $result = $this->db->query($sql, $values);
                }

                $user = $this->user_model->get($userid);
                foreach ($work as $w) {

                    $date->week = $w->week;
                    $date->day = $w->day;
                    $date->segment = $w->segment;

                    //$day = day::select_or_insert($user, $date);
                    $data = array(
                        "user_id" => $userid,
                        "year" => $date->year,
                        "period" => $date->period,
                        "week" => $date->week,
                        "day" => $date->day
                    );

                    $day = $this->day_model->get_by($data);
                    if (count($day) == 0) {
                        //Insert day
                        $dayid = $this->day_model->insert($data);
                        $day = $this->day_model->get_by($data);
                    }

                    $this->day_workout_model->insert(array(
                        'day_id' => $day->id,
                        'workout_id' => $w->workout_id,
                        'segment' => $date->segment
                    ));
                }
            }

            $_SESSION['notice'] = array(array("positive" => true, "message" => "Pass kopierade till utövare."));
            redirect('schedule/list');
        } else {
            //LISTA
            $groups = $this->group_model->with('user_groups')->join('school_groups', 'groups.id = school_groups.group_id')->get_many_by(array('school_groups.school_id' => $this->data['pageUser']->school_id, 'school_groups.group_type' => 10));

            foreach ($groups as $group) {
                //Hämta alla användare som hör till gruppen
                $group->users = $this->group_model->get_users($group->group_id);

                foreach ($group->users as $user) {
                    if (isset($user->end_date) && strtotime($user->end_date) < time()) {
                        $user->active = false;
                    } else {
                        $user->active = true;
                    }
                }
            }
            $this->smartytpl->assign('date', NULL);
            $this->smartytpl->assign("users", $groups);
            $this->smartytpl->assign('action', 'select');
        }
        $this->smartytpl->assign('now', $date);
        $this->smartytpl->assign('schedule', $schedule);
        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/schedule/assign.php');
        $this->smartytpl->display('footer.php');
    }

}