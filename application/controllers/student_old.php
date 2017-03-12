<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('group_model');
        $this->load->model('user_group_model');
        $this->load->model('user_chat_model');
        $this->load->model('plan_model');
        $this->load->model('day_model');
        $this->load->model('day_result_model');
        $this->load->model('day_workout_model');
        $this->load->model('day_workoutnote_model');
        $this->load->model('template_workout_model');
        $this->load->model('user_coach_model');
        $this->load->model('school_model');
        $this->load->library('mail');
        $this->load->library('PDate', '', 'PDate');
        $this->load->library('Statistics', '', 'stats');
    }

    public function move() {
        if ($this->data['pageUser']->type != "10") {
            show_error('errors/forbidden', 403);
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $school = $this->school_model->get($this->input->post('schoolselect'));
            $message = $this->input->post('movemessage');

            $this->mail->move_student_email($this->data['pageUser']->id, $school, $message);
            redirect('/user', 'refresh');
        } else {

            //Hämta skolor
            $schools = $this->school_model->order_by("title", "asc")->get_all();

            $this->smartytpl->assign("schools", $schools);

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/move.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function ajax_groups($school_id) {
        $groups = $this->group_model->get_groups_for_school($school_id, 10);

        echo json_encode($groups);
    }

    public function ajax_changedate($user_id) {

        $date = new PDate(array("date" => strtotime($_GET["pickdate"])));
        redirect('/mobile/' . $user_id . '/' . $date->year . '/' . $date->period . '/' . $date->week . '/' . $date->day, 'refresh');
    }

    public function list_students($school_id = false) {

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != "150") {
            show_error('errors/forbidden', 403);
        }

        if ($this->data['pageUser']->type == "50") {
            $school_id = $this->data['pageUser']->school_id;
        }

        $school = $this->school_model->get($school_id);
        $groups = $this->group_model->with('user_groups')->join('school_groups', 'groups.id = school_groups.group_id')->order_by('groups.display_order')->order_by('groups.title')->get_many_by(array('school_groups.school_id' => $school_id, 'school_groups.group_type' => 10));

        foreach ($groups as $group) {

            $group->users = $this->group_model->get_users($group->group_id);

            foreach ($group->users as $user) {
                $chat = $this->user_chat_model->get_by("user_id", $user->user_id);

                if ($chat) {
                    $user->user_chat_updated = date('j/n', strtotime($chat->updated));
                } else {
                    $user->user_chat_updated = false;
                }
                if (isset($user->end_date) && strtotime($user->end_date) < time()) {
                    $user->active = false;
                } else {
                    $user->active = true;
                }
                if ($this->data['pageUser']->type == "150") {
                    $user->lists = array();
                    for ($i = 1; $i <= 5; $i++) {
                        $list = json_decode($this->data["pageUser"]->{'favs_' . $i}, true);
                        reset($list);
                        $first_key = key($list);
                        $ids = $list[$first_key];

                        if (is_array($list) && in_array($user->user_id, $ids)) {
                            $user->lists[] = $i;
                        }
                    }
                }
            }
        }


        $external_students = $this->user_coach_model->get_coach_users($this->data["pageUser"]->id);

        foreach ($external_students as $student) {
            $chat = $this->user_chat_model->limit(1)->get_by("user_id", $student->user_id);
            if ($chat) {
                $student->user_chat_updated = date('j/n', strtotime($chat->updated));
            } else {
                $student->user_chat_updated = false;
            }
        }

        $this->smartytpl->assign("external_students", $external_students);



        if ($this->data['pageUser']->type == "150") {
            $result = array();
            for ($i = 1; $i <= 5; $i++) {
                $value = json_decode($this->data["pageUser"]->{'favs_' . $i});

                if (count($value->{key($value)}) > 0) {

                    $result[key($value)] = $this->user_model->getUsersFromIds($value->{key($value)});

                    foreach ($result[key($value)] as $user) {
                        $chat = $this->user_chat_model->limit(1)->get_by("user_id", $user->id);
                        if ($chat) {
                            $user->user_chat_updated = date('j/n', strtotime($chat->updated));
                        } else {
                            $user->user_chat_updated = false;
                        }
                    }
                } else {
                    $result[key($value)] = false;
                }
            }
        } else {
            $result = false;
        }


        $this->smartytpl->assign("lists", $result);
        $this->smartytpl->assign("students", $groups);
        $this->smartytpl->assign("school", $school);
        $this->smartytpl->assign("pageUser", $this->data['pageUser']);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/list.php');
        $this->smartytpl->display('footer.php');
    }

    public function delete_student($id, $group_id = false) {

        if ($this->data['pageUser']->type != "50") {
            show_error('errors/forbidden', 403);
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            //Kolla att användaren finns och är en utövare
            $user = $this->user_model->get($id);

            if ($user && $user->type == 10) {
                /*
                  Ändra user_group-kopplingen till deleted.
                 */
                $user_group = $this->user_group_model->get_by(array('user_id' => $id, 'group_id' => $group_id));
                $user_group->deleted = 1;
                $this->user_group_model->update($user_group->id, $user_group);
                redirect('/student/list', 'refresh');
            } else {
                $_SESSION['notice'] = array(array("positive" => false, "message" => "Det finns ingen utövare med detta id."));
                redirect('/student/list', 'refresh');
            }
        } else {
            $user = $this->user_model->get($id);
            if (!isset($user)) {
                show_404();
            }

            $this->data["student"] = $user;
            $this->data["group_id"] = $group_id;
            $this->data["id"] = $id;
            $this->load->view('header', $this->data);
            $this->load->view('pages/student/delete', $this->data);
            $this->load->view('footer');
        }
    }

    public function edit_student($id) {

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != "150") {
            show_error('errors/forbidden', 403);
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('student[email]', 'Epost', 'trim|required|xss_clean|valid_email|is_unique[users.email.id.' . $id . ']');
            $this->form_validation->set_rules('student[fullname]', 'Fullständigt namn', 'required');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('student/edit/' . $id);
            } else {
                $user = array();
                $studentpost = $this->input->post('student');
                $user['fullname'] = $studentpost["fullname"];
                $user['email'] = $studentpost["email"];
                $user['type'] = 10;

                //Uppdatera lösen om det finns angivet
                if ($studentpost["password"] !== "") {
                    $user['password'] = $this->hash($studentpost["password"]);
                }

                //Uppdatera användaren
                $success = $this->user_model->update($id, $user);

                $user = $this->user_model->with('user_groups')->get($id);

                //Uppdatera grupp
                if (isset($studentpost["group_id"])) {
                    $group_id = $studentpost["group_id"];
                    $pivot = array();
                    $pivot["group_id"] = $group_id;
                    $this->user_group_model->update_by('user_id', $id, $pivot);
                }

                if ($this->data['pageUser']->type == "150") {
                    redirect('/ssf', 'refresh');
                } else {
                    redirect('/student/list', 'refresh');
                }
            }
        } else {
            $user = $this->user_model->with('user_groups')->get($id);
            $this->smartytpl->assign('id', $id);

            if ($user) {
                $this->smartytpl->assign('student', $user);

                if ($this->data['pageUser']->type != "150") {
                    $school_info = $this->user_model->school_info_for_user($id, $this->data['pageUser']->school_id);
                    $groups = $this->group_model->order_by("title", "asc")->get_groups_for_school($school_info->school_id, 10);
                } else {
                    $groups = array();
                }

                $this->smartytpl->assign("groups", $groups);

                $this->smartytpl->display('header.php');
                $this->smartytpl->display('pages/student/edit.php');
                $this->smartytpl->display('footer.php');
            } else {
                show_404();
            }
        }
    }

    public function add_student() {

        if ($this->data['pageUser']->type != "50") {
            show_error('errors/forbidden', 403);
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('student[email]', 'Epost', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('student[fullname]', 'Fullständigt namn', 'required');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('student/add');
            } else {
                $user = array();
                $studentpost = $this->input->post('student');
                $user['fullname'] = $studentpost["fullname"];
                $user['email'] = $studentpost["email"];
                $user['type'] = 10;
                if ($studentpost["password"] !== "") {
                    $cleartext_password = $studentpost["password"];
                } else {
                    $cleartext_password = str_replace("/", "-", substr(base64_encode(md5(rand(), true)), 0, 8));
                }
                $user['password'] = $this->hash($cleartext_password);
                $user_id = $this->user_model->insert($user);

                $group_id = $studentpost["group_id"];
                $group = $this->group_model->get($group_id);


                if ($user_id && $group) {
                    $pivot = array();
                    $pivot["group_id"] = $group_id;
                    $pivot["user_id"] = $user_id;
                    $pivot["start_date"] = date('Y-m-d H:i:s');
                    $this->user_group_model->insert($pivot);
                }
                if ($user_id) {
                    $this->mail->welcome_email($user['email'], $cleartext_password);
                }

                if (headers_sent()) {
                    error_log("Headers sent");
                } else {
                    error_log("Inga headers sent");
                }

                redirect('/student/list/', 'refresh');
                exit();
            }
        } else {

            $groups = $this->group_model->with('user_groups')->join('school_groups', 'groups.id = school_groups.group_id')->get_many_by(array('school_groups.school_id' => $this->data['pageUser']->school_id, 'school_groups.group_type' => 10));
            $this->smartytpl->assign("groups", $groups);

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/add.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function chat($id) {

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != "5" && $this->data['pageUser']->type != "150" && $this->data['pageUser']->id != $id) {
            show_error('errors/forbidden', 403);
        }

        if ($this->data['pageUser']->type == "50") {

            $student = $this->user_model->get($id);
        } elseif ($this->data['pageUser']->type == "5") {
            if ($this->user_coach_model->has_access($this->data['pageUser']->id, $id)) {
                $student = $this->user_model->get($id);
            } else {
                show_error('errors/forbidden', 403);
            }
        } else {
            $student = $this->user_model->get($id);
        }

        if (count($student) !== 0) {
            $chat = $this->user_chat_model->limit(1)->get_by("user_id", $id);

            if ($this->input->post('text')) {

                if (count($chat) == 0) {
                    $chat = array('user_id' => $id, 'text' => $this->input->post('text'));
                    $chat_id = $this->user_chat_model->insert($chat);
                } else {

                    $success = $this->user_chat_model->update($chat->id, array('text' => $this->input->post('text')));
                }

                if ($this->data['pageUser']->type == "5") {
                    redirect("/external");
                } else {
                    redirect($this->data['pageUser']->type == "50" || $this->data['pageUser']->type == "150" ? "/student/list" : "/overview");
                }
            }

            $this->smartytpl->assign('chat', $chat);
            $this->smartytpl->assign('student', $student);

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/chat.php');
            $this->smartytpl->display('footer.php');
        } else {
            show_404();
        }
    }

    public function plan($id, $year = false) {

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->id != $id && $this->data['pageUser']->type != "5" && $this->data['pageUser']->type != "150") {
            show_error('errors/forbidden', 403);
        }
        if ($this->data['pageUser']->type == "5") {
            if ($this->user_coach_model->has_access($this->data['pageUser']->id, $id)) {
                $student = $this->user_model->with('user_groups')->get($id);
            } else {
                show_error('errors/forbidden', 403);
            }
        } else {
            $student = $this->user_model->with('user_groups')->get($id);
        }

        if ($student->type !== "10") {
            show_error('errors/forbidden', 403);
        }

        $school_info = FALSE;

        if ($this->data['pageUser']->type == "50") {
            $school_info = $this->user_model->school_info_for_user($id, $this->data['pageUser']->school_id);
        }

        if (!$school_info || !isset($school_info->end_date)) {
            $now = $this->PDate;
            $student_endyear = false;
        } else {
            $this->load->library('PDate', array('date' => $school_info->end_date), 'Endyear');
            $now = $this->Endyear;
            $student_endyear = $this->Endyear;
        }

        $year = ($year ? $year : $now->year);

        $plan = $this->plan_model->from_user($student, $year);
        if (count($plan) !== 0) {
            $plan = $plan['0'];
        } else {
            $plan = false;
        }

        if ($this->input->post('plan')) {

            if ($plan === false) {

                $plan_id = $this->plan_model->insert($this->input->post('plan'));
                $this->plan_model->set_for_user($student, $year, $plan_id);
            } else {
                $new_plan = array();
                foreach ($this->input->post('plan') as $key => $val) {
                    $new_plan[$key] = $val;
                }
                $plan_id = $this->plan_model->update($plan->id, $new_plan);
            }

            switch ($this->data['pageUser']->type) {
                case "5": redirect('external', 'refresh'); //utövare
                case "10": redirect('overview', 'refresh'); //utövare
                case "50": redirect('student/list', 'refresh'); //ledare
            }
        }

        if ($plan == false) {
            $group = $this->group_model->get($student->user_groups[0]->group_id);
            $plan = $this->plan_model->from_group($group, $year);
            if (count($plan) !== 0) {
                $plan = $plan['0'];
            } else {
                $plan = false;
            }
        }

        $this->smartytpl->assign('now', $now);
        $this->smartytpl->assign('student_endyear', $student_endyear);
        $this->smartytpl->assign('year', $year);
        $this->smartytpl->assign('plan', $plan);
        $this->smartytpl->assign('student', $student);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/plan.php');
        $this->smartytpl->display('footer.php');
    }

    public function statistics($id, $date_from = false, $date_to = false) {

        $student = $this->user_model->get($id);

        if (!isset($id) || !count($student) > 0) {
            show_404();
        }

        $this->load->library('Statistics', '', 'stats');
        $statistics = $this->stats;

        $statistics->user = $id;

        if ($this->data['pageUser']->type == "50" || $this->data['pageUser']->type == "10") {

            if ($this->data['pageUser']->type == "10") {
                if ($id !== $this->data['pageUser']->id) {
                    show_error('errors/forbidden', 403);
                }
            }

            $school_info = $this->user_model->school_info_for_user($id, $this->data['pageUser']->school_id);
           
            if(count($school_info) !== 0) { 
                if ($school_info->school_id !== $this->data['pageUser']->school_id) {
                    show_error('errors/forbidden', 403);
                }
            } else if(!$this->user_coach_model->has_access($this->data['pageUser']->id, $id)) {
                show_error('errors/forbidden', 403);
            }
        } elseif ($this->data['pageUser']->type == "150") {
            $school_info = false;
        } elseif ($this->data['pageUser']->type == "5") {
            if ($this->user_coach_model->has_access($this->data['pageUser']->id, $id)) {
                $school_info = false;
            } else {
                show_error('errors/forbidden', 403);
            }
        }

        if (isset($_POST['f'], $_POST['t'])) {

            $statistics->dateFrom = strftime($_POST['f']);
            $statistics->dateTo = strftime($_POST['t']);
            $date_from = $_POST['f'];
            $date_to = $_POST['t'];
            
        } elseif ($date_to) {
            $statistics->dateFrom = strftime($date_from);
            $statistics->dateTo = strftime($date_to);
        } else {

            $date = new PDate();
            $date->week = 0;
            $date->day = 0;

            $statistics->dateFrom = clone $date;
            $date_from = $date->hyGregorian('Y-m-d');
            $date->period++;
            $date->day--;

            $statistics->dateTo = $date;

            $date_to = $date->hyGregorian('Y-m-d');
        }

        $compare = !empty($_POST['compare']);

        if ($compare) {
            $compare_stats = clone $statistics;
            $compare_stats->dateTo->oneYearAgo();
            $compare_stats->dateFrom->oneYearAgo();
        } else {
            $compare_stats = false;
        }
        
        /*
          YEARS
         *          */        
        $startdate = new PDate(array("date" => strtotime($date_from))); 
        $yearfrom = $startdate->year;
        $enddate = new PDate(array("date" => strtotime($date_to)));
        $yearto = $enddate->year;
        //$current_season = 
        $currdate = $this->PDate;

        $current_season = $currdate->year;
        
        $i = $yearfrom;
        $yeardata = array();
        $yeardata_table = array();
        $yearstats = clone $statistics;
        $currstart = clone $startdate;
        $currend = clone $enddate;
        $control_sum = 0;
        while ($i <= $yearto) {
            
            $currstart->year = $i;
            $currstart->period = 0;
            $currstart->week = 0;
            $currstart->day = 0;
            
            $currend->year = $i;
            $currend->period = 12;
            $currend->week = 4;
            $currend->day = 6;
            
            $yearstats->dateFrom = $currstart;
            $yearstats->dateTo = $currend;
            
            $strength_data = 0;
            $illness_data = 0;
            $injury_data = 0;
            $rest_data = 0;
            
            foreach($yearstats->day() as $yearstat) {

                if($yearstat->key == 0) {
                    $illness_data = $yearstat->count;
                }
                if($yearstat->key == 1) {
                    $injury_data = $yearstat->count;
                }

            }

            foreach($yearstats->table('day_results') as $yearresult) {
                if($yearresult->type == 1) {
                    $strength_data += $yearresult->duration;

                }
                if($yearresult->title_val == 'Vila') {
                    $rest_data += $yearresult->count;

                }
            }
            
            $column_data = $yearstats->intensity($student->id);
            $shape_data = round($yearstats->shape($student->id), 2);

            $plan_array = $yearstats->summary("day_workouts", $student->id);
            $plan_data = (float)$plan_array->duration ;

            $totaltime = $strength_data;
            if($i == $current_season) {
                $label = "Årets säsong";
            } else {
                $label = (string)$i;
            }
            
            //Label, Aerob 1, Aerob 2, Aerob 3, Aerob 3+/tävling, Strength, Shape, Planned
            $data_array = array($label, 0, 0, 0, 0, ($strength_data / 60 / 60), $shape_data, $plan_data / 60 / 60, $illness_data, $injury_data, $rest_data);

            
            if($strength_data == 0) {
                $table_strength = "-";
            } else {
                $table_strength = secondsToTime($strength_data);
            }


            //0:Label, 1:Aerob 1, 2:Aerob 2, 3:Aerob 3, 4:Aerob 3+/tävling, 5:Strength, 6:Shape, 7:Planned, 8:Totaltime
            $data_array_table = array(
                $label, 
                "-", 
                "-", 
                "-", 
                "-", 
                $table_strength, 
                $shape_data, 
                secondsToTime($plan_data), 
                secondsToTime($totaltime),
                $illness_data, 
                $injury_data, 
                $rest_data 
                );
            
            foreach ($column_data as $k => $val) {
                if ($val->title == 'Aerob 1') {
                    $data_array[1] = $val->duration / 60 / 60;
                    $data_array_table[1] = secondsToTime($val->duration); 
                } else if ($val->title == 'Aerob 2') {
                    $data_array[2] = $val->duration / 60 / 60;
                    $data_array_table[2] = secondsToTime($val->duration);
                } else if ($val->title == 'Aerob 3') {
                    $data_array[3] = $val->duration / 60 / 60;
                    $data_array_table[3] = secondsToTime($val->duration);
                } else if ($val->title == 'Aerob 3+/tävling') {
                    $data_array[4] = $val->duration / 60 / 60;
                    $data_array_table[4] = secondsToTime($val->duration);
                }
                $totaltime += $val->duration;
                $data_array_table[8] = secondsToTime($totaltime);
            }
            $yeardata[] = $data_array;
            $yeardata_table[] = $data_array_table;
            
            
            $i++;
        }
        
        /*
            PERIODS
         *          */
        $startdate = new PDate(array("date" => strtotime($date_from)));
        $startdate->week = 0;
        $startdate->day = 0;
        $startdate->segment = 0;
        
        $enddate = new PDate(array("date" => strtotime($date_to)));
        $enddate->week = 3;
        $enddate->day = 6;
        $enddate->segment = 0;        
        
        $periodstats = clone $statistics;
        
        $currstart = clone $startdate;
        $currend = clone $enddate;
        $period = $startdate->period;
        
        for($year = $startdate->year; $year <= $enddate->year; $year++) {
            
            while($period <= 12) {
                $currstart->year = $year;
                $currstart->period = $period;
                $currend->year = $year;
                $currend->period = $period;
                
                $periodstats->dateFrom = $currstart;
                $periodstats->dateTo = $currend;
                $column_data = $periodstats->intensity($student->id);
                $shape_data = round($periodstats->shape($student->id), 2);
                
                $plan_array = $periodstats->summary("day_workouts", $student->id);
                $plan_data = (float)$plan_array->duration;
                
                $strength_data = 0;
                $illness_data = 0;
                $injury_data = 0;
                $rest_data = 0;

                foreach($periodstats->day() as $periodstat) {

                if($periodstat->key == 0) {
                    $illness_data = $periodstat->count;
                }
                if($periodstat->key == 1) {
                    $injury_data = $periodstat->count;
                }

            }

            foreach($periodstats->table('day_results') as $periodresult) {
                if($periodresult->type == 1) {
                    $strength_data += $periodresult->duration;

                }
                if($periodresult->title_val == 'Vila') {
                    $rest_data += $periodresult->count;

                }
            }
                
                $totaltime = $strength_data;
                $data_array = array($year . ' p' . ($period+1), 0, 0, 0, 0, ($strength_data / 60 / 60), $shape_data, ($plan_data / 60 / 60), $illness_data, $injury_data, $rest_data);
                
                if($strength_data == 0) {
                    $table_strength = "-";
                } else {
                    $table_strength = secondsToTime($strength_data);
                }
                
                $data_array_table = array(
                    $year . ' p' . ($period+1), 
                    "-", 
                    "-", 
                    "-", 
                    "-", 
                    $table_strength, 
                    $shape_data, 
                    secondsToTime($plan_data), 
                    secondsToTime($totaltime),
                    $illness_data, 
                    $injury_data, 
                    $rest_data
                );
                
                foreach ($column_data as $k => $val) {
                    if ($val->title == 'Aerob 1') {
                        $data_array[1] = $val->duration / 60 / 60;
                        $data_array_table[1] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 2') {
                        $data_array[2] = $val->duration / 60 / 60;
                        $data_array_table[2] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 3') {
                        $data_array[3] = $val->duration / 60 / 60;
                        $data_array_table[3] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 3+/tävling') {
                        $data_array[4] = $val->duration / 60 / 60;
                        $data_array_table[4] = secondsToTime($val->duration);
                    }
                    $totaltime += $val->duration;
                    $data_array_table[8] = secondsToTime($totaltime);
                }
                $perioddata[] = $data_array;
                $perioddatatable[] = $data_array_table;
                
                
                $period++;
            }
                $period = 1;
            
        }        

        
        /*
          WEEKS
         **/
        $dates = range(strtotime($date_from), strtotime($date_to), 86400);
        
        array_map(function($v)use(&$days) {
            if (date('D', $v) == 'Mon') {
                $days[] = date('Y-m-d', $v);
            }
        }, $dates); // Requires PHP 5.3+
        $weekdata = array();
        $weekstats = clone $statistics;
        foreach ($days as $key => $day) {

            $weekstats->dateFrom = $day;
            $enddate = date_create($day);
            date_add($enddate, date_interval_create_from_date_string('6 days'));
            $weekstats->dateTo = date_format($enddate, 'Y-m-d');

            $column_data = $weekstats->intensity($student->id);
            $shape_data = round($weekstats->shape($student->id), 2);
            $plan_array = $weekstats->summary("day_workouts", $student->id);
            $plan_data = (float)$plan_array->duration;
            
            $wdate = new DateTime($day);
            $week = $wdate->format("W");
            
            $strength_data = 0;
            $illness_data = 0;
            $injury_data = 0;
            $rest_data = 0;

            foreach($weekstats->day() as $weekstat) {

                if($weekstat->key == 0) {
                    $illness_data = $weekstat->count;
                }
                if($weekstat->key == 1) {
                    $injury_data = $weekstat->count;
                }

            }

            foreach($weekstats->table('day_results') as $weekresult) {
                if($weekresult->type == 1) {
                    $strength_data += $weekresult->duration;

                }
                if($weekresult->title_val == 'Vila') {
                    $rest_data += $weekresult->count;

                }
            }

            $totaltime = $strength_data;
            //Label, Aerob 1, Aerob 2, Aerob 3, Aerob 3+/tävling, Strength, Shape, Planned
            $data_array = array('v' . $week, 0, 0, 0, 0, ($strength_data / 60 / 60), $shape_data, ($plan_data / 60 / 60), $illness_data, $injury_data, $rest_data);

            if($strength_data == 0) {
                $table_strength = "-";
            } else {
                $table_strength = secondsToTime($strength_data);
            }
            
            $data_array_table = array(
                'v' . $week,
                "-", 
                "-", 
                "-", 
                "-", 
                $table_strength, 
                $shape_data, 
                secondsToTime($plan_data), 
                secondsToTime($totaltime),
                $illness_data, 
                $injury_data, 
                $rest_data
            );
            
            foreach ($column_data as $k => $val) {
                    if ($val->title == 'Aerob 1') {
                        $data_array[1] = $val->duration / 60 / 60;
                        $data_array_table[1] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 2') {
                        $data_array[2] = $val->duration / 60 / 60;
                        $data_array_table[2] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 3') {
                        $data_array[3] = $val->duration / 60 / 60;
                        $data_array_table[3] = secondsToTime($val->duration);
                    } else if ($val->title == 'Aerob 3+/tävling') {
                        $data_array[4] = $val->duration / 60 / 60;
                        $data_array_table[4] = secondsToTime($val->duration);
                    }
                    $totaltime += $val->duration;
                    $data_array_table[8] = secondsToTime($totaltime);
                }
            $weekdata[] = $data_array;
            $weekdatatable[] = $data_array_table;
        }
        
        /*
          DAYS
         **/
        $i = 28;
        $date_to = date('Y-m-d',strtotime(date("Y-m-d", strtotime($date_from)) . " +".$i."days"));
        $dates = range(strtotime($date_from), strtotime($date_to), 86400);
        $days = array();

        foreach($dates as $date) {
            $days[] = date('Y-m-d', $date);
        }

        $daydata = array();

        $daystats = clone $statistics;
        foreach ($days as $key => $day) {

            $daystats->dateFrom = $day;
            $enddate->dateFrom = $day;
            $daystats->dateTo = $day;

            $column_data = $daystats->intensity($student->id);
            $shape_data = round($daystats->shape($student->id), 2);
            $plan_array = $daystats->summary("day_workouts", $student->id);
            $plan_data = (float)$plan_array->duration;
            
            $wdate = new DateTime($day);
            $day = $wdate->format("d-m-y");
            
            $strength_data = 0;
            $illness_data = 0;
            $injury_data = 0;
            $rest_data = 0;

            foreach($daystats->day() as $daystat) {

                if($daystat->key == 0) {
                    $illness_data = $daystat->count;
                }
                if($daystat->key == 1) {
                    $injury_data = $daystat->count;
                }

            }

            foreach($daystats->table('day_results') as $dayresult) {
                if($dayresult->type == 1) {
                    $strength_data += $dayresult->duration;

                }
                if($dayresult->title_val == 'Vila') {
                    $rest_data += $dayresult->count;

                }
            }
            
            
            $totaltime = $strength_data;
            //Label, Aerob 1, Aerob 2, Aerob 3, Aerob 3+/tävling, Strength, Shape, Planned
            $data_array = array($day, 0, 0, 0, 0, ($strength_data / 60 / 60), $shape_data, ($plan_data / 60 / 60), $illness_data, $injury_data, $rest_data);

            if($strength_data == 0) {
                $table_strength = "-";
            } else {
                $table_strength = secondsToTime($strength_data);
            }
            $data_array_table = array(
                $day,
                "-", 
                "-", 
                "-", 
                "-", 
                $table_strength, 
                $shape_data, 
                secondsToTime($plan_data), 
                secondsToTime($totaltime),
                $illness_data, 
                $injury_data, 
                $rest_data
            );
            
            foreach ($column_data as $k => $val) {
                if ($val->title == 'Aerob 1') {
                    $data_array[1] = $val->duration / 60 / 60;
                    $data_array_table[1] = secondsToTime($val->duration);
                } else if ($val->title == 'Aerob 2') {
                    $data_array[2] = $val->duration / 60 / 60;
                    $data_array_table[2] = secondsToTime($val->duration);
                } else if ($val->title == 'Aerob 3') {
                    $data_array[3] = $val->duration / 60 / 60;
                    $data_array_table[3] = secondsToTime($val->duration);
                } else if ($val->title == 'Aerob 3+/tävling') {
                    $data_array[4] = $val->duration / 60 / 60;
                    $data_array_table[4] = secondsToTime($val->duration);
                }
                $totaltime += $val->duration;
                $data_array_table[8] = secondsToTime($totaltime);
            }
            $daydata[] = $data_array;
            $daydatatable[] = $data_array_table;
        }
       

        $student = $this->user_model->get($id);
        $this->smartytpl->assign('title', $student->fullname);
        $this->smartytpl->assign('student', $student);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->assign('weekstaple', $weekdata);
        $this->smartytpl->assign('weektable', $weekdatatable);
        $this->smartytpl->assign('daystaple', $daydata);
        $this->smartytpl->assign('daytable', $daydatatable);
        $this->smartytpl->assign('periodstaple', $perioddata);
        $this->smartytpl->assign('periodtable', $perioddatatable);   
        $this->smartytpl->assign('yearstaple', $yeardata);
        $this->smartytpl->assign('yeartable', $yeardata_table);
        $this->smartytpl->assign('compare_stats', $compare_stats);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/statistics.php');
        $this->smartytpl->display('footer.php');
    }

    public function calendar_stats($id, $year = false, $period = false, $week = false, $day = false) {

        $this->load->library('Statistics', '', 'stats');
        $statistics = $this->stats;

        $statistics->user = $id;

        $user = $this->data['pageUser'];

        if ($user->type == 150 || $user->type == 50) {
            $student = $this->user_model->with('user_groups')->get($id);
        } elseif ($user->type == 5) {
            if ($this->user_coach_model->has_access($user->id, $id)) {
                $student = $this->user_model->with('user_groups')->get($id);
            } else {
                show_error('errors/forbidden', 403);
            }
        } elseif ($user->type == 10) {
            if ($user->id != $id) {
                show_error('errors/forbidden', 403);
            }
            $student = $user;
        }

        if (count($student) === 0) {
            return false;
        }

        if ($this->data['pageUser']->type == "50") {
            $school_info = $this->user_model->school_info_for_user($id, $this->data['pageUser']->school_id);
        } else {
            $school_info = FALSE;
        }

        $date = new PDate();

        $date->year = $year;
        $date->period = ( isset($period) ? $period : 0 );
        $date->week = ( isset($week) ? $week : 0 );
        $date->day = ( isset($day) ? $day : 0 );
        
        

        $statistics->dateFrom = clone $date;

        switch (count(func_get_args())) {
            case 2: $date->year++;
                break;
            case 3: $date->period++;
                break;
            case 4: $date->week++;
                break;
            case 5: $date->day++;
                break;
            default: return false;
        }

        $date->day--;

        $statistics->dateTo = $date;

        $compare = !empty($_POST['compare']);

        if ($compare) {
            $compare_stats = clone $statistics;
            $compare_stats->dateTo->oneYearAgo();
            $compare_stats->dateFrom->oneYearAgo();
        } else {
            $compare_stats = false;
        }

        $this->smartytpl->assign('compare_stats', $compare_stats);
        $this->smartytpl->assign('link', true);
        $this->smartytpl->assign('student', $student);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->display('snippets/statistics.php');
    }

    private function dateDiff($start, $end) {

        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }

    public function mobile_calendar($id = false, $year = false, $period = false, $week = false, $day = false) {

        $user = $this->data['pageUser'];
        $date = $this->PDate;

        if ($id == false) {
            $id = $user->id;
        }

        if ($year !== false && $period !== false && $week !== false && $day !== false) {

            $date->year = $year;
            $date->period = $period;
            $date->week = $week;
            $date->day = $day;
        }

        if ($user->type == 150 || $user->type == 50) {
            $student = $this->user_model->with('user_groups')->get($id);
        } elseif ($user->type == 5) {
            if ($this->user_coach_model->has_access($user->id, $id)) {
                $student = $this->user_model->with('user_groups')->get($id);
            } else {
                show_error('errors/forbidden', 403);
            }
        } elseif ($user->type == 10) {
            if ($user->id != $id) {
                show_error('errors/forbidden', 403);
            }
            $student = $user;
        }

        if (count($student) === 0) {
            return false;
        }

        $plan = $this->plan_model->from_user($student, $date->year);

        if (isset($plan[0])) {
            $plan = $plan[0];
        } else {
            $group = $this->group_model->get($student->user_groups[0]->group_id);
            $plan = $this->plan_model->from_group($group, $date->year);

            if (isset($plan[0])) {
                $plan = $plan[0];
            }
        }

        $hasaccess = $this->hasAccess($student, $date);

        $duration_planned = 0;

        $property_name = "p" . $date->period . "w" . $date->week;
        $this->smartytpl->assign('duration_planned', ($plan ? ($plan->{$property_name} * 3600) : false));

        $weekdate = $date;
        $weekdates = array();
        $weekdates_unformatted = array();

        if (!$week) {
            $week = $date->week;
        }

        $this->smartytpl->assign('weekdates', $weekdates);

        $activeday = $this->lang->line(date('D', strtotime('+' . 0 . ' day', $date->time()))) . " " . date('d', strtotime('+' . 0 . ' day', $date->time())) . " " . $this->lang->line(date('M', strtotime('+' . 0 . ' day', $date->time())));
        $this->smartytpl->assign('activeday', $activeday);

        $this->smartytpl->assign('week', $week);
        $this->smartytpl->assign('id', $student->id);
        $this->smartytpl->assign('date', $date);
        $this->smartytpl->assign('student', $student);
        $this->smartytpl->assign('day', $this->day_model->get_week($student, $date));

        $triggerwarning = false;

        //Veckoplanering
        $day = $this->day_model->select_or_false($user->id, $date);

        if ($day) {
            $day_workout = $this->day_workout_model->get_day($day);
        } else {
            $day_workout = array();
        }

        //Genomfört
        if ($day) {
            $day_result = $this->day_result_model->get_day($day);
        } else {
            $day_result = array();
        }

        $day_results = array();
        foreach ($day_result as $workout) {
            if (isset($workout)) {
                $day_results[] = $workout;
            }
        }

        $day_workouts = array();
        foreach ($day_workout as $workout) {
            if (isset($workout)) {
                $day_workouts[] = $workout;
            }
        }

        $template_workout = $this->template_workout_model->get_for_user($student);
        $template_workout_global = $this->template_workout_model->get_global($this->data['pageUser']->school_id);

        $this->smartytpl->assign('day_workout', json_decode(parseWorkout($day_workouts, 'day_workout')));
        $this->smartytpl->assign('day_result', json_decode(parseWorkout($day_results, 'day_result')));

        
        
        //Användarens pass 
        $this->smartytpl->assign('template_workout', parseWorkout($template_workout, 'template_workout'));

        //Globala pass
        $this->smartytpl->assign('template_workout_global', parseWorkout($template_workout_global, 'template_workout'));
        $this->smartytpl->assign('hasaccess', $hasaccess);
        $this->smartytpl->assign('version', 'mobile');

        $this->smartytpl->assign('user', $user);

        $this->smartytpl->assign('mobile', true);
        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/mobile_calendar.php');
        $this->smartytpl->display('footer.php');
    }

    public function mswitch($version = false, $id = false, $year = false, $period = false, $week = false, $day = false) {

        $this->load->helper('cookie');

        if ($version == "mobile") {


            redirect('/mobile/' . $id . '/' . $year . '/' . $period . '/' . $week . '/' . $day, 'refresh');
        } else {


            redirect('/overview/' . $id . '/' . $year . '/' . $period . '/' . $week . '/' . $day, 'refresh');
        }
    }

    public function calendar($id = false, $year = false, $period = false, $week = false, $day = false) {


        $user = $this->data['pageUser'];
        $date = $this->PDate;

        if ($id == false) {
            $id = $user->id;
        }

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
                return redirect('/student/calendar/' . $id . '/' . $year . '/' . $period . '/' . $week);
            }

            $date->year = $year;
            $date->period = $period;
            if ($week == 5) {
                $date->week = 0;
            } else {
                $date->week = $week;
            }
        }

        //Veckoplanering
        $day = $this->day_model->select_or_false($user->id, $date);

        if ($user->type == 150 || $user->type == 50) {
            $student = $this->user_model->with('user_groups')->get($id);
        } elseif ($user->type == 5) {
            if ($this->user_coach_model->has_access($user->id, $id)) {
                $student = $this->user_model->with('user_groups')->get($id);
            } else {
                show_error('errors/forbidden', 403);
            }
        } elseif ($user->type == 10) {
            if ($user->id != $id) {
                show_error('errors/forbidden', 403);
            }
            $student = $user;
        }

        if (count($student) === 0) {
            return false;
        }

        $plan = $this->plan_model->from_user($student, $date->year);

        if (isset($plan[0])) {
            $plan = $plan[0];
        } else {
            $group = $this->group_model->get($student->user_groups[0]->group_id);
            $plan = $this->plan_model->from_group($group, $date->year);

            if (isset($plan[0])) {
                $plan = $plan[0];
            }
        }

        $hasaccess = $this->hasAccess($student, $date);
        if ($hasaccess) {
            $duration_planned = 0;
            if ($week == 5) {
                for ($i = 0; $i < 4; $i++) {
                    $property_name = "p" . $date->period . "w" . $date->week;
                    $duration_planned += ($plan ? ($plan->{$property_name} * 3600) : 0);
                    $this->smartytpl->assign('duration_planned', $duration_planned);
                }
            } else {
                $property_name = "p" . $date->period . "w" . $date->week;
                $this->smartytpl->assign('duration_planned', ($plan ? ($plan->{$property_name} * 3600) : false));
            }
        } else {
            $this->smartytpl->assign('duration_planned', 0);
        }

        $weekdate = $date;
        $weekdate->day = 0;
        $weekdates = array();
        $weekdates_unformatted = array();

        if ($week != 5) {
            for ($i = 0; $i < 7; $i++) {
                $weekdates[] = $this->lang->line(date('D', strtotime('+' . $i . ' day', $weekdate->time()))) . " " . date('d', strtotime('+' . $i . ' day', $weekdate->time())) . " " . $this->lang->line(date('M', strtotime('+' . $i . ' day', $weekdate->time())));
                $weekdates_unformatted[] = strtotime('+' . $i . ' day', $weekdate->time());
            }
        } else {
            for ($i = 0; $i <= (4 * 7) + 1; $i++) {
                $weekdates[] = $this->lang->line(date('D', strtotime('+' . $i . ' day', $weekdate->time()))) . " " . date('d', strtotime('+' . $i . ' day', $weekdate->time())) . " " . $this->lang->line(date('M', strtotime('+' . $i . ' day', $weekdate->time())));
                $weekdates_unformatted[] = strtotime('+' . $i . ' day', $weekdate->time());
            }
        }

        if (!$week) {
            $week = $date->week;
        }

        $this->smartytpl->assign('weekdates', $weekdates);
        $this->smartytpl->assign('week', $week);
        $this->smartytpl->assign('id', $student->id);
        $this->smartytpl->assign('date', $date);
        $this->smartytpl->assign('student', $student);
        $this->smartytpl->assign('day', $this->day_model->get_week($student, $date));

        $triggerwarning = false;

        if ($week == 5) {

            for ($i = 0; $i < 4; $i++) {
                $date->week = $i;

                $hasaccess = $this->hasAccess($student, $date);

                if ($hasaccess) {
                    //Veckoplanering
                    $day_workout = $this->day_workout_model->get_week($student, $date);
                    $this->smartytpl->assign('day_workout' . ((int) $i + 1), parseWorkout($day_workout, 'day_workout', $id));

                    //Anteckningar
                    $day_workoutnotes = $this->day_workoutnote_model->get_week($student, $date);
                    $this->smartytpl->assign('day_workoutnotes' . ((int) $i + 1), parseWorkout($day_workoutnotes, 'day_workoutnotes', $id));

                    //Genomfört
                    $day_result = $this->day_result_model->get_week($student, $date);
                    $this->smartytpl->assign('day_result' . ((int) $i + 1), parseWorkout($day_result, 'day_result'));
                } else {
                    $triggerwarning = true;
                    //Veckoplanering
                    $day_workout = array();
                    $this->smartytpl->assign('day_workout' . ((int) $i + 1), parseWorkout($day_workout, 'day_workout'));

                    //Genomfört
                    $day_result = array();
                    $this->smartytpl->assign('day_result' . ((int) $i + 1), parseWorkout($day_result, 'day_result'));

                    $day_workoutnotes = array();
                    $this->smartytpl->assign('day_workoutnotes', parseWorkout($day_workoutnotes, 'day_workoutnotes', $id));
                }

            }
            $date->week = 0;
        } else {
            $hasaccess = $this->hasAccess($student, $date);

            if ($hasaccess) {
                //Genomfört
                $day_result = $this->day_result_model->get_week($student, $date);
                $this->smartytpl->assign('day_result', parseWorkout($day_result, 'day_result'));

                //Veckoplanering
                $day_workout = $this->day_workout_model->get_week($student, $date);
                $this->smartytpl->assign('day_workout', parseWorkout($day_workout, 'day_workout'));

                //Anteckningar
                $day_workoutnotes = $this->day_workoutnote_model->get_week($student, $date);
                $this->smartytpl->assign('day_workoutnotes', parseWorkout($day_workoutnotes, 'day_workoutnotes', $id));
            } else {
                $day_result = array();
                $day_workout = array();
                $day_workoutnotes = array();

                $this->smartytpl->assign('day_workout', parseWorkout($day_workout, 'day_workout'));
                $this->smartytpl->assign('day_result', parseWorkout($day_result, 'day_result'));
                $this->smartytpl->assign('day_workoutnotes', parseWorkout($day_workoutnotes, 'day_workoutnotes', $id));
            }
        }

        $template_workout = $this->template_workout_model->get_for_user($student);
        $template_workout_global = $this->template_workout_model->get_global($this->data['pageUser']->school_id);
        $template_workout_notes = array((object) array("id" => NULL, "user_id" => NULL, "workout_id" => -1, "global" => NULL, "school_id" => NULL));

        $this->smartytpl->assign('day_workout', parseWorkout($day_workout, 'day_workout'));
        $this->smartytpl->assign('day_result', parseWorkout($day_result, 'day_result'));

        
        /**
         * Eventkalender
         */
        $start = date('Y-m-d', $weekdates_unformatted[0]) . " 00:00:00";
        $end = date('Y-m-d', end($weekdates_unformatted)) . " 00:00:00";
        $startdate = new PDate(array('date' => $weekdates_unformatted[0]));
        $enddate = new PDate(array('date' => end($weekdates_unformatted)));

        $this->smartytpl->assign('startdate', $startdate);
        $this->smartytpl->assign('enddate', $enddate);

        $this->load->model('event_model');
        $user_events = $this->event_model->get_user_events_between_dates($this->data['pageUser']->id, $start, $end);
        $school_events = $this->event_model->get_school_events_between_dates($this->data['pageUser']->school_id, $start, $end);
        $ssf_events = $this->event_model->get_ssf_events_between_dates($start, $end);

        $user_events = $this->prepareEvents($user_events, "user");
        $school_events = $this->prepareEvents($school_events, "school");
        $ssf_events = $this->prepareEvents($ssf_events, "ssf");

        $this->smartytpl->assign('user', $user);

        $this->smartytpl->assign('user_events', json_encode($user_events));
        $this->smartytpl->assign('school_events', json_encode($school_events));
        $this->smartytpl->assign('ssf_events', json_encode($ssf_events));
        /*         * *** */

        if (!$hasaccess || $triggerwarning) {

            $school_info = $this->user_model->school_info_for_user($student->id, $this->data['pageUser']->school_id);

            $_SESSION['notice'] = array(array("positive" => false, "message" => "Du har inte rätt att se aktiviteter daterade före " . $school_info->start_date . "."));
            if (isset($school_info->end_date)) {
                $_SESSION['notice'] = array(array("positive" => false, "message" => "Du har inte rätt att se aktiviteter daterade efter " . $school_info->end_date . "."));
            }
        }

        //Pass av typen övrigt
        $this->smartytpl->assign('template_workout_notes', parseWorkout($template_workout_notes, 'template_workout_notes'));

        //echo parseWorkout($template_workout_notes, 'template_workout_notes');
        //Användarens pass 
        $this->smartytpl->assign('template_workout', parseWorkout($template_workout, 'template_workout'));

        //Globala pass
        $this->smartytpl->assign('template_workout_global', parseWorkout($template_workout_global, 'template_workout'));
        $this->smartytpl->assign('hasaccess', $hasaccess);
        $this->smartytpl->assign('version', 'regular');

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/calendar.php');
        $this->smartytpl->display('footer.php');
    }

    private function prepareEvents($events, $type) {
        foreach ($events as $event) {
            $event->formatted_dates = array();

            //Strippa bort tiden
            $sdate = explode(" ", $event->start);
            $edate = explode(" ", $event->end);
            $start = $sdate[0];
            $end = $edate[0];

            $datediff = $this->dateDiff($sdate[0], $edate[0]) + 1;

            $event->editable = false;

            if ($this->data['pageUser']->type == "10") {
                if ($type == "user") {
                    $event->editable = true;
                }
            } elseif ($this->data['pageUser']->type == "50") {
                if ($type == "school") {
                    $event->editable = true;
                }
            } elseif ($this->data['pageUser']->type == "150") {
                if ($type == "ssf") {
                    $event->editable = true;
                }
            }

            for ($i = 0; $i <= $datediff - 1; $i++) {

                $week = date('W', strtotime('+' . $i . ' day', strtotime($event->start)));

                $event->formatted_dates[$week][] = $this->lang->line(date('D', strtotime('+' . $i . ' day', strtotime($event->start)))) . " " . date('d', strtotime('+' . $i . ' day', strtotime($event->start))) . " " . $this->lang->line(date('M', strtotime('+' . $i . ' day', strtotime($event->start))));
            }

            $event->numdays = $datediff;
        }

        return $events;
    }

    public function coaches($id) {

        if ($this->data['pageUser']->type != "10" && $this->data['pageUser']->id != $id) {
            show_error('errors/forbidden', 403);
        }

        $this->load->model('user_coach_model');
        $coaches = $this->user_coach_model->get_user_coaches($id);

        $this->smartytpl->assign('coaches', $coaches);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/coaches.php');
        $this->smartytpl->display('footer.php');
    }

    public function search() {
        // prevent direct access
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if (!$isAjax) {
            show_error('errors/forbidden', 403);
        }

        $term = trim($_GET['term']);
        $result = $this->user_model->search($term);

        $returnval = array();
        foreach ($result as $key => $res) {
            $returnval[$key]['id'] = $res->id;
            $returnval[$key]['value'] = $res->fullname;
        }
        echo json_encode($returnval);
    }

    private function hasAccess($student, $date) {
        $user = $this->data['pageUser'];

        if ($user->type == 150) { /* SSF */
            $hasaccess = true;
        } elseif ($user->type == 50) { /* TRÄNARE */

            $hasaccess = true;
        } elseif ($user->type == 5) { /* EXTERN TRÄNARE */
            if (!$this->user_coach_model->has_access($user->id, $student->id)) {
                show_error('errors/forbidden', 403);
            } else {
                $hasaccess = true;
            }
        } elseif ($user->type == 10) { /* ELEV */
            if ($user->id != $student->id) {
                show_error('errors/forbidden', 403);
            }
            $student = $user;
            $hasaccess = true;
        }


        return $hasaccess;
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */