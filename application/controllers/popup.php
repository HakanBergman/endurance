<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popup extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != 10 && $this->data['pageUser']->type != 150) {
            show_error('errors/forbidden', 403);
        } else {
            $this->load->model('workout_model');
            $this->load->model('workout_parts_model');
            $this->load->model('template_workout_model');
            $this->load->model('schedule_workout_model');
            $this->load->model('day_workout_model');
            $this->load->model('day_workoutnote_model');
            $this->load->model('workoutnote_model');
            $this->load->model('day_result_model');
            $this->load->model('day_model');
            $this->load->model('part_model');
            $this->load->library('PDate', '', 'PDate');
        }
    }

    public function add_part() {

        $this->smartytpl->assign('title', $_POST['title']);
        $this->smartytpl->assign('name', $_POST['name']);
        $this->smartytpl->assign('type', $_POST['type']);

        $this->smartytpl->assign('value', null);
        $this->smartytpl->assign('primary', false);
        $this->smartytpl->assign('remove', false);

        $this->smartytpl->display('snippets/part.php');

        return;
    }

    public function delete_template_workout($workout_id) {
        $workout = $this->workout_model->get($workout_id);

        if ($workout) {

            //Delete workout parts
            $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $workout_id));

            foreach ($workout_parts as $workout_part) {
                $this->part_model->delete($workout_part->part_id);
                $this->workout_parts_model->delete($workout_part->id);
            }

            //Delete template workout
            $this->template_workout_model->delete_by(array('workout_id' => $workout_id));

            //Delete workout
            $this->workout_model->delete($workout_id);

            echo json_encode(array("result", "ok"));
        } else {
            echo json_encode(array("result", "error"));
        }
    }

    public function edit_template_workout($id) {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {
            
            $template_workout = $this->template_workout_model->get_by(array('workout_id' => $id));

            $workout = Domains::parseworkout($this->input->post('workout'));
            $workout_id = $this->workout_model->insert($workout);

            if ($this->input->post('part')) {
                $this->newParts($workout_id);
            }
            
            $template_workout->workout_id = $workout_id;
            $template_workout->global = !empty($_POST['workout']['global']);
            $this->template_workout_model->update($template_workout->id, $template_workout);

            $parsed_template_workout = json_decode(parseWorkout(array($template_workout), 'template_workout'));

            echo json_encode($parsed_template_workout[0]);
            
        } else {

            $workout = $this->workout_model->get($id);
            if ($workout) {
                $template_workout = $this->template_workout_model->get_by(array('workout_id' => $id));
                if ($template_workout)
                    $workout->global = $template_workout->global;

                $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $template_workout->workout_id));
                $parts = array();
                foreach ($workout_parts as $workout_part) {
                    $part = $this->part_model->get($workout_part->part_id);
                    $part->primary = $workout_part->primary;
                    $part->title = $this->part_model->toString($part);
                    $parts[] = $part;
                }

                $this->smartytpl->assign('parts', $parts);
                $this->smartytpl->assign('o', $template_workout);
                $this->smartytpl->assign('workout', json_decode(json_encode($workout)));
                $this->smartytpl->assign('type', 'template_workout');
                $this->smartytpl->assign('url', '/popup/template_workout/edit/' . $id);

                $this->smartytpl->display('pages/popup.php');

                return;
            }
            else
                return;
        }
    }

    public function add_template_workout() {

        $this->smartytpl->assign('title', $this->input->post('title'));
        $this->smartytpl->assign('name', $this->input->post('name'));
        $this->smartytpl->assign('type', $this->input->post('type'));

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            //Insert workout
            $workout = Domains::parseworkout($this->input->post('workout'));
            $workout_id = $this->workout_model->insert($workout);

            if ($workout_id && $this->input->post('part')) {
                $this->newParts($workout_id);
            }

            //Insert template_workout
            $template_workout = array();
            $template_workout["user_id"] = $this->data["pageUser"]->id;
            $template_workout['workout_id'] = $workout_id;
            $template_workout['global'] = !empty($_POST['workout']['global']);
            $template_workout['school_id'] = $this->data['pageUser']->school_id;

            $this->template_workout_model->insert($template_workout);
        } else {

            $this->smartytpl->assign('value', null);
            $this->smartytpl->assign('primary', false);
            $this->smartytpl->assign('remove', false);

            $this->smartytpl->assign('workout', false);
            $this->smartytpl->assign('o', false);
            $this->smartytpl->assign('type', 'template_workout');
            $this->smartytpl->assign('url', '/popup/template_workout/add');

            $this->smartytpl->display('pages/popup.php');

            return;
        }
    }

    public function edit_schedule_workout($id) {

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            $schedule_workout = $this->schedule_workout_model->get($id);

            $workout = Domains::parseworkout($this->input->post('workout'));
            $workout_id = $this->workout_model->insert($workout);

            if ($this->input->post('part')) {
                $this->newParts($workout_id);
            }

            $schedule_workout->workout_id = $workout_id;
            $this->schedule_workout_model->update($schedule_workout->id, $schedule_workout);

            $parsed_schedule_workout = json_decode(parseWorkout(array($schedule_workout), 'schedule_workout'));

            echo json_encode($parsed_schedule_workout[0]);
        } else {
            //VISA WORKOUTDETALJER 

            $schedule_workout = $this->schedule_workout_model->get($id);
            $workout = $this->workout_model->get($schedule_workout->workout_id);
            $this->smartytpl->assign('o', $schedule_workout);
            $this->smartytpl->assign('type', 'schedule_workout');

            $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $schedule_workout->workout_id));
            $parts = array();
            foreach ($workout_parts as $workout_part) {
                $part = $this->part_model->get($workout_part->part_id);
                $part->primary = $workout_part->primary;
                $part->title = $this->part_model->toString($part);
                $parts[] = $part;
            }
            $this->smartytpl->assign('parts', $parts);
            $this->smartytpl->assign('value', null);
            $this->smartytpl->assign('primary', false);
            $this->smartytpl->assign('remove', false);

            $this->smartytpl->assign('workout', json_decode(json_encode($workout)));
            $this->smartytpl->assign('parts', $parts);

            $this->smartytpl->assign('url', '/popup/schedule_workout/' . $id);

            $this->smartytpl->display('pages/popup.php');
        }
    }

    public function delete_schedule_workout($id) {

        $this->schedule_workout_model->delete($id);
        echo json_encode(null);
    }

    public function edit_day_workout($id, $userid = false) {
       
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {


            $day_workout = $this->day_workout_model->get($id);
            $workout_id = $this->workout_model->insert(Domains::parseworkout($this->input->post('workout')));

            if ($this->input->post('part')) {
                $this->newParts($workout_id);
            }

            $day_workout->workout_id = $workout_id;
            $this->day_workout_model->update($day_workout->id, $day_workout);
            $res = json_decode(parseWorkout($day_workout, 'day_workout'));
            echo json_encode($res[0]);
        } else {
            $day_workout = $this->day_workout_model->get($id);
            $day = $this->day_model->get($day_workout->day_id);
           
            $workout = $this->workout_model->get($day_workout->workout_id);
            if ($workout) {

                $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $id));
                $parts = array();

                foreach ($workout_parts as $workout_part) {
                    $parts[] = $this->part_model->get($workout_part->part_id);
                }

                $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $day_workout->workout_id));
                $parts = array();
                foreach ($workout_parts as $workout_part) {
                    $part = $this->part_model->get($workout_part->part_id);
                    $part->primary = $workout_part->primary;
                    $part->title = $this->part_model->toString($part);
                    $parts[] = $part;
                }

                $this->smartytpl->assign('userid', $userid);
                $this->smartytpl->assign('day', $day);
                $this->smartytpl->assign('parts', $parts);
                $this->smartytpl->assign('o', $day_workout);
                $this->smartytpl->assign('workout', json_decode(json_encode($workout)));
                $this->smartytpl->assign('type', 'day_workout');
                $this->smartytpl->assign('url', '/popup/day_workout/' . $id);

                $this->smartytpl->display('pages/popup.php');

                return;
            }
            else
                return;
        }
    }
    
        public function edit_day_workoutnotes($id, $userid = false) {
       
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            $day_workoutnote = $this->day_workoutnote_model->get($id);
            $workoutnote_id = $this->workoutnote_model->insert(Domains::parseworkout($this->input->post('workout')));

            $day_workoutnote->workoutnote_id = $workoutnote_id;
            $this->day_workoutnote_model->update($day_workoutnote->id, $day_workoutnote);
            $res = json_decode(parseWorkout($day_workoutnote, 'day_workoutnotes'));
            echo json_encode($res[0]);
        } else {
            $day_workoutnote = $this->day_workoutnote_model->get($id);
            $day = $this->day_model->get($day_workoutnote->day_id);
           
            $workoutnote = $this->workoutnote_model->get($day_workoutnote->workoutnote_id);

            if ($workoutnote) {          

                $parts = array();

                $this->smartytpl->assign('userid', $userid);
                $this->smartytpl->assign('day', $day);
                $this->smartytpl->assign('parts', $parts);
                $this->smartytpl->assign('o', $day_workoutnote);
                $this->smartytpl->assign('workout', json_decode(json_encode($workoutnote)));
                $this->smartytpl->assign('type', 'day_workoutnotes');
                $this->smartytpl->assign('url', '/popup/day_workoutnotes/' . $id);

                $this->smartytpl->display('pages/popup.php');

                return;
            }
            else
                return;
        }
    }
    
    public function delete_day_workoutnotes($id) {
        $this->day_workoutnote_model->delete($id);
        echo json_encode(null);
    }

    public function add_day_workout() {

        $this->smartytpl->assign('title', $this->input->post('title'));
        $this->smartytpl->assign('name', $this->input->post('name'));
        $this->smartytpl->assign('type', $this->input->post('type'));

        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            //Insert workout
            $workout = Domains::parseworkout($this->input->post('workout'));
            $workout_id = $this->workout_model->insert($workout);

            if ($workout_id && $this->input->post('part')) {
                $new_parts = array();
                $workout = $this->workout_model->get($workout_id);

                foreach ($this->input->post('part') as $key => $val) {
                    if (empty($val['remove'])) {
                        //Insert part
                        $part_id = $this->part_model->insert(Domains::parsepart($val));
                        $part = $this->part_model->get($part_id);
                        $new_parts[] = array('id' => $part->id, 'workout_id' => $workout_id, 'part_id' => $part_id, 'primary' => (empty($val['primary']) ? 0 : 1));
                    }
                }
            }
            //Insert workout_parts
            $this->workout_model->parts($new_parts);

            //Insert template_workout
            $template_workout = array();
            $template_workout["user_id"] = $this->data["pageUser"]->id;
            $template_workout['workout_id'] = $workout_id;
            $template_workout['global'] = !empty($_POST['workout']['global']);
            $this->template_workout_model->insert($template_workout);
        } else {

            $this->smartytpl->assign('value', null);
            $this->smartytpl->assign('primary', false);
            $this->smartytpl->assign('remove', false);

            $this->smartytpl->assign('workout', false);
            $this->smartytpl->assign('o', false);
            $this->smartytpl->assign('type', 'template_workout');
            $this->smartytpl->assign('url', '/popup/template_workout/add');

            $this->smartytpl->display('pages/popup.php');

            return;
        }
    }

    public function delete_day_workout($id) {

        $this->day_workout_model->delete($id);
        echo json_encode(null);
    }

    public function edit_day_result($id) {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            $day_result = $this->day_result_model->get($id);

            if (isset($_POST['result'])) {
                Domains::parseresult($_POST['result'], $day_result);
            }

            $workout_id = $this->workout_model->insert(Domains::parseworkout($_POST['workout']));
            $workout = $this->workout_model->get($workout_id);

            if ($this->input->post('part')) {
                $this->newParts($workout_id);
            }

            $day_result->workout_id = $workout->id;
         
            $this->day_result_model->update($day_result->id, $day_result);
            
            $res = json_decode(parseWorkout($day_result, 'day_result'));

            echo json_encode($res[0]);
        } else {
            $day_result = $this->day_result_model->get($id);
            
            $workout = $this->workout_model->get($day_result->workout_id);
            if ($workout) {

                $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $day_result->workout_id));
                $parts = array();
                foreach ($workout_parts as $workout_part) {
                    $part = $this->part_model->get($workout_part->part_id);
                    $part->primary = $workout_part->primary;
                    $part->title = $this->part_model->toString($part);
                    $parts[] = $part;
                }

                $this->smartytpl->assign('parts', $parts);
                $o = $day_result;
                $o->type = 'day_result';
                $this->smartytpl->assign('o', $day_result);
                
                
                $this->smartytpl->assign('workout', json_decode(json_encode($workout)));
                $this->smartytpl->assign('type', 'day_result');
                $this->smartytpl->assign('url', '/popup/day_result/' . $id);

                $this->smartytpl->display('pages/popup.php');

                return;
            }
            else
                return;
        }
    }

    public function delete_day_result($id) {
        $this->day_result_model->delete($id);
        echo json_encode(null);
    }

    public function add_day_result($id = false, $year = false, $period = false, $week = false, $day = false, $segment = false, $userid = false) {

       
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('workout')) {

            //Insert workout
            $workout = Domains::parseworkout($this->input->post('workout'));
            $workout_id = $this->workout_model->insert($workout);


            if ($workout_id && $this->input->post('part')) {
                $new_parts = array();
                $workout = $this->workout_model->get($workout_id);

                foreach ($this->input->post('part') as $key => $val) {
                    if (empty($val['remove'])) {
                        //Insert part
                        $part_id = $this->part_model->insert(Domains::parsepart($val));
                        $part = $this->part_model->get($part_id);
                        $new_parts[] = array('id' => $part->id, 'workout_id' => $workout_id, 'part_id' => $part_id, 'primary' => (empty($val['primary']) ? 0 : 1));
                    }
                }
                if (count($new_parts !== 0)) {
                    //Insert workout_parts
                    $this->workout_model->parts($new_parts);
                }
            }

            $date = $this->PDate;
            $date->year = $year;
            $date->period = $period; 
            $date->week = $week; 
            $date->day = $day;
            $date->segment = $segment;             
            
            
            
            if($this->data['pageUser']->type == 10) {
                $day = $this->day_model->select_or_insert($this->data['pageUser']->id, $date);
            } else {
                error_log($userid);
                $day = $this->day_model->select_or_insert($userid, $date);
            }
            

            $day_result = Domains::parseresult($this->input->post('result'));

            $day_result->day_id = $day->id;
            $day_result->workout_id = $workout_id;
            $day_result->segment = $date->segment;

            $o = $this->day_result_model->insert($day_result);

            $this->smartytpl->assign('title', $this->input->post('title'));
            $this->smartytpl->assign('name', $this->input->post('name'));
            $this->smartytpl->assign('type', $this->input->post('type'));
            
            $res = json_decode(parseWorkout($day_result, 'day_result'));
            echo json_encode($res[0]);
            
        } else {

            $this->smartytpl->assign('value', null);
            $this->smartytpl->assign('primary', false);
            $this->smartytpl->assign('remove', false);

            $this->smartytpl->assign('workout', false);
            $parts = array();
            $day_workout = $this->day_workout_model->get($id);
            if(is_object($day_workout)) {

                $workout_parts = $this->workout_parts_model->get_many_by(array('workout_id' => $day_workout->workout_id));
                
                foreach ($workout_parts as $workout_part) {
                    $part = $this->part_model->get($workout_part->part_id);
                    $part->primary = $workout_part->primary;
                    $part->title = $this->part_model->toString($part);
                    $parts[] = $part;
                }

                $this->smartytpl->assign('parts', $parts);
                $o = $day_workout;
                $res = json_decode(parseWorkout($day_workout, 'day_workout'));    
                
                $o->type = 'day_workout';

                $this->smartytpl->assign('o', $o);
                $this->smartytpl->assign('workout', $this->workout_model->get_workout($day_workout->workout_id));
            } else {
                $this->smartytpl->assign('o', false);
                $this->smartytpl->assign('workout', false);
                
            }
            
            
            $this->smartytpl->assign('parts', $parts);
            $this->smartytpl->assign('type', 'day_result');
            $this->smartytpl->assign('url', '/popup/day_result/add/'. $id . '/' . $year . '/' . $period . '/' . $week . '/' . $day . '/' . $segment . '/' . $userid);

            $this->smartytpl->display('pages/popup.php');
            return;
        }
    }

    private function newParts($workout_id) {
        $newparts = array();
        foreach ($this->input->post('part') as $key => $val) {
            if (empty($val['remove'])) {
                //Insert part
                $part_id = $this->part_model->insert(Domains::parsepart($val));
                $part = $this->part_model->get($part_id);
                $newparts[] = array('id' => $part->id, 'workout_id' => $workout_id, 'part_id' => $part_id, 'primary' => (empty($val['primary']) ? 0 : 1));
            }
        }
        //Insert workout_parts
        $this->workout_model->parts($newparts);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */