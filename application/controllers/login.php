<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
        
        if($this->agent->is_mobile()) {
            $this->smartytpl->assign("ismobile", true);
        } else {
            $this->smartytpl->assign("ismobile", false);
        }
        
        $this->load->view('pages/home');
    }

    public function check_login() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('mail', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Lösenord', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            /* Validation failed. :( */
            $this->load->view('pages/home');
        } else {

            //Field validation succeeded.  Validate against database
            $email = $this->input->post('mail');
            $password = $this->input->post('pass');
            //query the database
            $result = $this->user_model->login($email, $password);

            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {
                    $sess_array = array(
                        'id' => $row->id,
                        'username' => $row->email
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                }
                /* Inloggd :D */
                //Var ska vi?
                $user = $this->user_model->get($row->id);
                if ($user) {
                    
                    $this->load->library("PDate");
                    $date = new PDate();    
                    
                    if($this->agent->is_mobile() && $user->type == 10) {
                        redirect('/mobile/' . $user->id . '/' . $date->year . '/' . $date->period . '/5', 'refresh'); //utövare
                    } else {
                        switch ($user->type) {
                            case "5": redirect('external', 'refresh'); //utövare
                            case "10": redirect('/overview/' . $user->id . '/' . $date->year . '/' . $date->period . '/5', 'refresh'); //utövare
                            case "50": redirect('group/list', 'refresh'); //ledare
                            case "100": redirect('teacher/list', 'refresh'); //admin
                            case "150": redirect('ssf', 'refresh'); //admin
                        }
                        
                    }
                }
            } else {
                /* Användaren finns inte :( */
                $this->form_validation->set_message('check_database', 'Invalid username or password');
                
                redirect('/', 'refresh');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('/', 'refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */