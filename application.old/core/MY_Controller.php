<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class MY_Controller extends CI_Controller {

    protected $data;

    function __construct() {
        parent::__construct();
        
        if($this->agent->is_mobile()) {
            $this->smartytpl->assign("ismobile", true);
        } else {
            $this->smartytpl->assign("ismobile", false);
        }
        
        if (!$this->session->userdata('logged_in')) {
            //If no session, redirect to login page
            redirect('/', 'refresh');
        } else {
            $this->load->library("PDate");
            $this->smartytpl->assign("date", new PDate());
            
            $this->load->model('user_model');
            $session_data = $this->session->userdata('logged_in');
            $this->data['pageUser'] = $this->user_model->with('user_groups')->get($session_data['id']);
          
            if ($this->data['pageUser']->type == 50 || $this->data['pageUser']->type == 10) {
                //Get school for user 
                $this->load->model('school_model');
                $page_user_school = $this->user_model->current_school_for_user($session_data['id']);
                $school = $this->school_model->get($page_user_school->school_id);
                
                $this->data['pageUser']->school_id = $page_user_school->school_id;
                $this->smartytpl->assign("page_user_school", $school);
            } else {
                $this->smartytpl->assign("page_user_school", false);
                $this->data['pageUser']->school_id = false;
                $this->smartytpl->assign("pageUser_school", false);
            }

            $this->smartytpl->assign("pageUser", $this->data['pageUser']);


            if ($this->data['pageUser']->type == 10) {
                $updated = $this->user_model->userChatUpdated();

                if($updated) {
                    $this->smartytpl->assign("pageUserChatUpdated", true);
                }
                else {
                    $this->smartytpl->assign("pageUserChatUpdated", false);
                }
                $this->smartytpl->assign("pageUserChat", $updated);
                $this->data['pageUserChatUpdated']['updated'] = $updated;
                
            } else {
                $this->smartytpl->assign("pageUserChatUpdated", false);
                $this->data['pageUserChatUpdated']['updated'] = false;
            }
            $this->data['pageNotice'] = "";
        }
        
        //$this->output->enable_profiler(TRUE);
    }

    static function hash($string) {
        return md5($string, true);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */