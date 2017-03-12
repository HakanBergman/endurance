<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class External extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data["pageUser"]->type != "5" && $this->data["pageUser"]->type != "150" && $this->data["pageUser"]->type != "50" && $this->data["pageUser"]->type != "10") {
            show_error('errors/forbidden', 403);
        } else {
            $this->load->model('group_model');
            $this->load->model('user_coach_model');
            $this->load->model('user_chat_model');
            $this->load->model('school_model');
        }
    }

    public function external_coach() {

        $students = $this->user_coach_model->get_coach_users($this->data["pageUser"]->id);

        foreach ($students as $student) {
            $chat = $this->user_chat_model->limit(1)->get_by("user_id", $student->user_id);
            if ($chat) {
                $student->user_chat_updated = date('j/n', strtotime($chat->updated));
            } else {
                $student->user_chat_updated = false;
            }
        }

        $this->smartytpl->assign("students", $students);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/list_external.php');
        $this->smartytpl->display('footer.php');
    }
    
        public function delete_external_coach($coachid) {
        if ($this->data["pageUser"]->type != "10") {
            show_error('errors/forbidden', 403);
        }
        $curruserid = $this->data["pageUser"]->id;
        $user_coach = $this->user_coach_model->limit(1)->get_by(array("user_id" => $curruserid, "coach_id" => $coachid));
        if(count($user_coach) > 0) {
            $this->user_coach_model->delete($user_coach->id);
        }
        redirect('/student/coaches/' . $this->data["pageUser"]->id, 'refresh');

    }
    
    public function add_external_coach() {
        if ($this->data["pageUser"]->type != "10") {
            show_error('errors/forbidden', 403);
        }
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            
            if($this->input->post("save_coach") && $this->input->post("save_coach") == 'save_coach') {
                $user = $this->user_model->limit(1)->get_by("email", $this->input->post("coach_email"));

                if(count($user) > 0) {
                    
                    $user_coach = array();
                    $user_coach['user_id'] = $this->data["pageUser"]->id;
                    $user_coach['coach_id'] = $user->id;
                    
                    //Insert workout
                    $user_coach['id'] = $this->user_coach_model->insert($user_coach);
                    
                    redirect('/student/coaches/' . $this->data["pageUser"]->id, 'refresh');
                    
                }
            }
            else {
                //Kolla om användaren redan finns
                $user = $this->user_model->limit(1)->get_by("email", $this->input->post("coach_email"));
                $user_coaches = array();
                if(count($user) > 0 && ($user->type == "50" || $user->type == "5")) {
                //Kolla om kopplingen redan finns
                $user_coaches = $this->user_coach_model->get_by(array("user_id" => $this->data["pageUser"]->id, "coach_id" => $user->id));
                
                
                }
                $this->smartytpl->assign("user_coaches", $user_coaches);
                $this->smartytpl->assign("coach", $user);
                
                $this->smartytpl->assign("userid", $this->data["pageUser"]->id);
            }
            
            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/add_external_coach.php');
            $this->smartytpl->display('footer.php');
            
        } else {

            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/add_external_coach.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function ssf() {

        if ($this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        }

        //Hämta alla skolor
        $schools = $this->school_model->order_by('title')->get_all();
        $this->smartytpl->assign("schools", $schools);

        $result = array();
        for ($i = 1; $i <= 6; $i++) {
            $value = json_decode(str_replace('_', ' ', $this->data["pageUser"]->{'favs_' . $i}));

            if (isset($value)) {
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
            } else {
                
            }
        }

        /* Sökning på g */
        if ($this->input->get('search_student')) {
            $term = trim($this->input->get('search_student'));
            $searchResult = $this->user_model->search($term);

            $returnval = array();
            foreach ($searchResult as $key => $user) {
                //Kolla om utövaren redan finns i lista
                $user->lists = array();
                for ($i = 1; $i <= 5; $i++) {
                    $list = json_decode($this->data["pageUser"]->{'favs_' . $i}, true);

                    if(is_array($list)) {
                    reset($list);
                    $first_key = key($list);
                    $ids = $list[$first_key];

                    if (in_array($user->id, $ids)) {
                        $user->lists[] = $i;
                    }
                    }
                }

                $group = $this->user_model->current_group($user->id);

                if($group) {
                $user->group = new stdClass();
                $user->group->id = $group->id;
                $user->group->title = $group->title;
                } else {
                    $user->group = false;
                }
                if($user->school_id) {
                    $user->school = $this->school_model->get($user->school_id); 
                } else {
                    $user->school = false;
                }
            }

            $this->smartytpl->assign("searchresult", $searchResult);
        } else {
            $this->smartytpl->assign("searchresult", false);
        }

        $this->smartytpl->assign("lists", $result);
        $this->smartytpl->assign("favs", $result);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/student/list_ssf.php');
        $this->smartytpl->display('footer.php');
    }

    public function ssf_save_to_list($user_id) {
        if ($this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        }
        $ssf_user = $this->user_model->get($this->data["pageUser"]->id);

        $lists = $this->input->post("lists");

        foreach ($lists as $list) {

            //Listan som finns sparad i db
            $db_list = json_decode($ssf_user->{$list}, true);

            //Hämta listans key som också är titeln på listan.
            reset($db_list);
            $first_key = key($db_list);

            //Kolla om $user_id redan finns i listan.
            if (!in_array($user_id, $db_list[$first_key])) {
                array_push($db_list[$first_key], $user_id);
            } else {

            }

            $ssf_user->{$list} = json_encode($db_list);
        }

        $this->user_model->update($ssf_user->id, $ssf_user);
        redirect('/ssf', 'refresh');
    }

    public function ssf_remove_from_list($listIndex, $user_id) {

        if ($this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        }

        $ssf_user = $this->user_model->get($this->data["pageUser"]->id);
        $list = "favs_" . $listIndex;

        //Listan som finns sparad i db
        $db_list = json_decode($ssf_user->{$list}, true);

        //Hämta listans key som också är titeln på listan.
        reset($db_list);
        $first_key = key($db_list);

        //Kolla om $user_id finns i listan
        if (in_array($user_id, $db_list[$first_key])) {
            $pos = array_search($user_id, $db_list[$first_key]);
            unset($db_list[$first_key][$pos]);
        }

        $ssf_user->{$list} = json_encode($db_list);
        $this->user_model->update($ssf_user->id, $ssf_user);
        redirect('/ssf', 'refresh');
    }

    public function ssf_edit_list($listIndex) {
        if ($this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        }
        $this->smartytpl->assign("listIndex", $listIndex);

        $ssf_user = $this->user_model->get($this->data["pageUser"]->id);
        $list = "favs_" . $listIndex;

        //Listan som finns sparad i db
        $db_list = json_decode($ssf_user->{$list}, true);

        //Hämta listans key som också är titeln på listan.
        reset($db_list);
        $first_key = key($db_list); 

        $this->smartytpl->assign("listTitle", str_replace('_', ' ', $first_key));
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if ($this->input->post("list_title")) {
                
                $new_title = str_replace(' ', '_', $this->input->post("list_title"));

                //Kolla att det inte finns en lista med detta namn redan
                for ($i = 1; $i <= 4; $i++) {
                    if ($i != $listIndex) {

                        $compareto = "favs_" . $i;
                        $compareto_list = json_decode($ssf_user->{$compareto}, true);
                        reset($compareto_list);
                        $compareto_key = key($compareto_list);

                        if ($new_title == $compareto_key) {
                            $_SESSION['notice'] = array(array("positive" => false, "message" => 'Listorna måste ha unika namn.'));
                            redirect('/ssf', 'refresh');
                        }
                    }
                }

                $db_list[str_replace(' ', '_', $new_title)] = $db_list[$first_key];
                if($new_title !== $first_key) {
                    unset($db_list[$first_key]);
                }
                $ssf_user->{$list} = json_encode($db_list);
            }

            $this->user_model->update($ssf_user->id, $ssf_user);

            redirect('/ssf', 'refresh');
        } else {
            $this->smartytpl->display('header.php');
            $this->smartytpl->display('pages/student/edit_ssf_list.php');
            $this->smartytpl->display('footer.php');
        }
    }

    public function ssf_statistics($date_from = false, $date_to = false) {

        if ($this->data["pageUser"]->type != "150") {
            show_error('errors/forbidden', 403);
        }

        $this->load->library('Statistics', '', 'stats');
        $statistics = $this->stats;

        /* Hämta alla skolor */
        $schools = $this->school_model->get_all();

        foreach ($schools as $school) {
            /* Hämta alla utövare på skolan */
            $school->groups = $this->group_model->get_groups_for_school($school->id, 10);

            $students = array();
            foreach ($school->groups as $group) {
                $group->students = $this->group_model->get_users($group->group_id);
                foreach ($group->students as $student) {
                    $students[] = $student;
                }
            }
        }

        $statistics->user = $students;

        if ($this->data['pageUser']->type == "50") {
            $school_info = $this->user_model->school_info_for_user($this->data['pageUser']->id, $this->data['pageUser']->school_id);
            if ($id != $school_info->school_id) {
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

        if ($compare) {
            $compare_stats = clone $statistics;
            $compare_stats->dateTo->oneYearAgo();
            $compare_stats->dateFrom->oneYearAgo();
        } else {
            $compare_stats = false;
        }

        $this->smartytpl->assign('title', "Alla utövare");
        $this->smartytpl->assign('students', $students);
        $this->smartytpl->assign('statistics', $statistics);
        $this->smartytpl->assign('compare_stats', $compare_stats);

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/school/statistics.php');
        $this->smartytpl->display('footer.php');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */