<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('event_model');
    }

    public function calendar() {

        $user_events = $this->event_model->get_many_by(array("user_id" => $this->data['pageUser']->id));
        $school_events = $this->event_model->get_many_by(array("school_id" => $this->data['pageUser']->school_id));
        $ssf_events = $this->event_model->get_many_by(array("is_ssf" => 1));
        $events = array_merge($user_events, $school_events, $ssf_events);

        $ret = array();
        foreach ($events as $event) {

            $formatted_event = array();
            $formatted_event["id"] = $event->id;
            $formatted_event["title"] = $event->title;
            $formatted_event["start"] = $event->start;
            $formatted_event["end"] = $event->end;

            if ($event->type == 1) {
                $formatted_event["backgroundColor"] = '#378006';
                
                if ($this->data['pageUser']->type == "150") {
                    $formatted_event["editable"] = true;
                } else {
                    $formatted_event["editable"] = false;
                }
                
            } elseif ($event->type == 2) {
                $formatted_event["backgroundColor"] = '#084B8A';
                
                if ($this->data['pageUser']->type == "50") {
                    $formatted_event["editable"] = true;
                } else {
                    $formatted_event["editable"] = false;
                }
                
            } elseif ($event->type == 3) {
                $formatted_event["backgroundColor"] = '#FFBF00';
                
                if ($this->data['pageUser']->type == "10") {
                    $formatted_event["editable"] = true;
                } else {
                    $formatted_event["editable"] = false;
                }
            }

            if (isset($event->description)) {
                $formatted_event["description"] = $event->description;
            } else {
                $formatted_event["description"] = false;
            }

            if (isset($event->moreinfo)) {
                $formatted_event["moreinfo"] = $event->moreinfo;
            } else {
                $formatted_event["moreinfo"] = false;
            }

            if (isset($event->allDay) && $event->allDay == 1) {
                $formatted_event["allDay"] = true;
            } else {
                $formatted_event["allDay"] = false;
            }

            $ret[] = $formatted_event;
        }

        $this->smartytpl->assign("events", json_encode($ret));

        $this->smartytpl->display('header.php');
        $this->smartytpl->display('pages/event/calendar.php');
        $this->smartytpl->display('footer.php');
    }

    public function create_event() {

        $post = $this->input->post("event");
        $event = new stdClass();

        if ($this->input->post("title")) {
            $event->title = $this->input->post("title");
        }

        if ($this->input->post("description")) {
            $event->description = $this->input->post("description");
        }

        if ($this->input->post("moreinfo")) {
            $event->moreinfo = $this->input->post("moreinfo");
        }

        if ($this->input->post("allDay")) {
            $event->allDay = 1;
        } else {
            $event->allDay = 0;
        }

        if ($this->input->post("start")) {
            $event->start = date("Y-m-d H:i:s", strtotime($this->input->post("start")));
        }

        if ($this->input->post("end")) {
            $event->end = date("Y-m-d H:i:s", strtotime($this->input->post("end")));
        }

        if ($this->data['pageUser']->type == "150") {
            $event->type = 1;
            $event->is_ssf = 1;
        } elseif ($this->data['pageUser']->type == "50") {
            $event->type = 2;
            $event->is_ssf = 0;
            $event->school_id = $this->data['pageUser']->school_id;
        } else {
            $event->type = 3;
            $event->is_ssf = 0;
            $event->user_id = $this->data['pageUser']->id;
        }

        $this->event_model->insert($event);

        redirect('/event/calendar', 'refresh');
    }

    public function edit_event($id) {
        $event = $this->event_model->get($id);

        if(($this->data['pageUser']->type == "150" && $event->type = 1) || ($this->data['pageUser']->type == "50" && $event->type = 2) || ($this->data['pageUser']->type == "10" && $event->type = 3)) {
            if ($this->input->post("title")) {
                $event->title = $this->input->post("title");
            }

            if ($this->input->post("description")) {
                $event->description = $this->input->post("description");
            }

            if ($this->input->post("moreinfo")) {
                $event->moreinfo = $this->input->post("moreinfo");
            }            

            if ($this->input->post("allDay") ) {
                
                if( $this->input->post("allDay") !== "false" ) {
                    $event->allDay = 1;
                } else {
                    $event->allDay = 0; 
                }

            } else {
                $event->allDay = 0;
            }

            
            if ($this->input->post("start")) {
                if(strlen($this->input->post("start")) > 10) {
                    $event->start = date("Y-m-d H:i:s", strtotime($this->input->post("start")));
                } else {
                    $olddate = explode(" ", $event->start);
                    $time = $olddate[1];
                    $event->start = date("Y-m-d H:i:s", strtotime($this->input->post("start") . " " . $time));
                }
            }
            
            if ($this->input->post("end")) {
                if(strlen($this->input->post("end")) > 10) {
                    $event->end = date("Y-m-d H:i:s", strtotime($this->input->post("end")));
                } else {
                    $olddate = explode(" ", $event->start);
                    $time = $olddate[1];
                    $event->end = date("Y-m-d H:i:s", strtotime($this->input->post("end") . " " . $time));
                }
            }
 

            if ($this->data['pageUser']->type == "150") {
                $event->type = 1;
                $event->is_ssf = 1;
            } elseif ($this->data['pageUser']->type == "50") {
                $event->type = 2;
                $event->is_ssf = 0;
                $event->school_id = $this->data['pageUser']->school_id;
            } else {
                $event->type = 3;
                $event->is_ssf = 0;
                $event->user_id = $this->data['pageUser']->id;
            }

            $this->event_model->update($id, $event);
        }
        redirect('/event/calendar', 'refresh');
    }

    public function delete_event($id) {
        $event = $this->event_model->get($id);

        if ($event) {
            $this->event_model->delete($id);
        }

        redirect('/event/calendar', 'refresh');
    }

}