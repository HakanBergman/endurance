<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data['pageUser']->type != "50" && $this->data['pageUser']->type != "10" && $this->data['pageUser']->type != "5" && $this->data['pageUser']->type != "150") {
            show_error('errors/forbidden', 403);
        }

        $this->load->model('day_model');
        $this->load->model('day_workout_model');
        $this->load->model('day_result_model');
        $this->load->model('group_model');
        $this->load->model('schedule_model');
        $this->load->model('schedule_workout_model');
        $this->load->model('workout_model');
        $this->load->model('template_workout_model');
        $this->load->model('day_workoutnote_model');
        $this->load->model('workoutnote_model');
        $this->load->library('PDate', '', 'PDate');
    }

    public function schedule_workout($schedule_id) {

        if ($this->input->post('action') == 'add') { //Skapa nytt pass
            $schedule_workout = array();
            $schedule_workout['schedule_id'] = $schedule_id;
            $schedule_workout['workout_id'] = $this->input->post('workout');
            $schedule_workout['week'] = $this->input->post('week');
            $schedule_workout['day'] = $this->input->post('day');
            $schedule_workout['segment'] = $this->input->post('segment');

            //Insert workout
            $schedule_workout['id'] = $this->schedule_workout_model->insert($schedule_workout);
        } elseif ($this->input->post('action') == 'move') { //Flytta pass
            $schedule_workout = $this->schedule_workout_model->get($this->input->post('id'));
            $schedule_workout->week = $this->input->post('week');
            $schedule_workout->day = $this->input->post('day');
            $schedule_workout->segment = $this->input->post('segment');
            $return_val = $this->schedule_workout_model->update($schedule_workout->id, $schedule_workout);
            $schedule_workout = json_decode(json_encode($schedule_workout), true);
        } elseif ($this->input->post('action') == 'remove') { //Radera pass
            $returnval = $this->schedule_workout_model->delete($this->input->post('id'));
            return;
        }

        //More data
        if (isset($schedule_workout['workout_id'])) {
            $workoutdata = $this->workout_model->get($schedule_workout['workout_id']);
        }
        $schedule_workout["__class__"] = "schedule_workout";
        $schedule_workout["__string__"] = $workoutdata->title;
        $schedule_workout["__color__"] = $this->template_workout_model->color($schedule_workout['workout_id']);
        $schedule_workout["__duration__"] = $this->template_workout_model->duration($schedule_workout['workout_id']);
        $schedule_workout["__comment__"] = $workoutdata->comment;


        $schedules = $this->schedule_model->get_all('title', 'asc');

        $this->smartytpl->assign("schedules", $schedules);
        echo json_encode($schedule_workout);
    }

    public function day_workout($id, $year = false, $period = false, $week = false, $day = false) {
        if ($this->input->post('action') == "add") {

            $date = $this->PDate;
            $date->year = $year;
            $date->period = $period;
            $date->week = $this->input->post('week');
            $date->day = $this->input->post('day');
            $date->segment = $this->input->post('segment');

            $day = $this->day_model->select_or_insert($id, $date);

            if ($_POST['workout'] > -1) {

                $id = $this->day_workout_model->insert(array(
                    'day_id' => $day->id,
                    'workout_id' => $_POST['workout'],
                    'segment' => $date->segment
                ));

                $day_workout = $this->day_workout_model->get_many_by(array('id' => $id));

                $res = json_decode(parseWorkout($day_workout, 'day_workout'));
                echo json_encode($res[0]);
            } else {

                /*$noteid = $this->workoutnote_model->insert(array(
                    'title' => 'Övrigt',
                    'comment' => ''
                ));

                $day_noteid = $this->day_workoutnote_model->insert(array(
                    'day_id' => $day->id,
                    'workoutnote_id' => $noteid,
                    'segment' => $date->segment
                ));

                $day_workout = $this->day_workoutnote_model->get_many_by(array('id' => $day_noteid));
                $res = json_decode(parseWorkout($day_workout, 'day_workoutnotes'));*/
                return false;
            }
            
        } elseif ($this->input->post('action') == "move") {

            $date = $this->PDate;
            $date->year = $year;
            $date->period = $period;
            $date->week = $this->input->post('week');
            $date->day = $this->input->post('day');
            $date->segment = $this->input->post('segment');

            $day = $this->day_model->select_or_insert($id, $date);
            $day_workout = $this->day_workout_model->get($this->input->post("id"));
            $day_workout->day_id = $day->id;
            $day_workout->segment = $date->segment;

            $this->day_workout_model->update($this->input->post("id"), $day_workout);

            $res = json_decode(parseWorkout($day_workout, 'day_workout'));
            echo json_encode($res[0]);
        } elseif ($this->input->post('action') == "remove") {

            $this->day_workout_model->delete($this->input->post("id"));
        }
    }

    public function day_result($id, $year = false, $period = false, $week = false, $day = false) {
        if ($this->input->post('action') == "add") {

            $date = $this->PDate;
            $date->year = $year;
            $date->period = $period;
            $date->week = $this->input->post('week');
            $date->day = $this->input->post('day');
            $date->segment = $this->input->post('segment');
            $day = $this->day_model->select_or_insert($id, $date);


            if ($_POST['workout'] > -1) {
                $id = $this->day_result_model->insert(array(
                    'day_id' => $day->id,
                    'workout_id' => $_POST['workout'],
                    'segment' => $date->segment
                ));

                $day_result = $this->day_result_model->get_many_by(array('id' => $id));
                $res = json_decode(parseWorkout($day_result, 'day_result'));
                
            } else {

                $noteid = $this->workoutnote_model->insert(array(
                    'title' => 'Övrigt',
                    'comment' => ''
                ));

                $day_noteid = $this->day_workoutnote_model->insert(array(
                    'day_id' => $day->id,
                    'workoutnote_id' => $noteid,
                    'segment' => $date->segment
                ));

                $day_workout = $this->day_workoutnote_model->get_many_by(array('id' => $day_noteid));
                $res = json_decode(parseWorkout($day_workout, 'day_workoutnotes'));
            }
            echo json_encode($res[0]);
            
        } elseif ($this->input->post('action') == "move") {
            $date = $this->PDate;
            $date->year = $year;
            $date->period = $period;
            $date->week = $this->input->post('week');
            $date->day = $this->input->post('day');
            $date->segment = $this->input->post('segment');
            $day = $this->day_model->select_or_insert($id, $date);


            if (!isset($_POST['workoutnote_id'])) {
                $day_result = $this->day_result_model->get($this->input->post("id"));

                $day_result->day_id = $day->id;
                $day_result->segment = $date->segment;

                $this->day_result_model->update($this->input->post("id"), $day_result);

                $res = json_decode(parseWorkout($day_result, 'day_result'));
            } else {
                $day_workoutnote = $this->day_workoutnote_model->get($this->input->post("id"));

                $day_workoutnote->day_id = $day->id;
                $day_workoutnote->segment = $date->segment;

                $this->day_workoutnote_model->update($this->input->post("id"), $day_workoutnote);

                $res = json_decode(parseWorkout($day_workoutnote, 'day_workoutnotes'));
            }

            echo json_encode($res[0]);
        } elseif ($this->input->post('action') == "remove") {

            $this->day_result_model->delete($this->input->post("id"));
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */