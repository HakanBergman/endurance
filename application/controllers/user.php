<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        
        
        $this->load->view('header', $this->data);
        $this->load->view('pages/user', $this->data);
        $this->load->view('footer');
    }

    public function password() {

        $this->form_validation->set_rules('old', 'Gammalt lösenord', 'trim|required|xss_clean');
        $this->form_validation->set_rules('new', 'Nytt lösenord', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirm', 'Upprepa lösenord', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            /* Validation failed. :( */
            $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
            redirect('user', 'refresh');
        } else {
            /* Validera mot db */
            $user = $this->data['pageUser'];
            $old = $this->input->post('old');
            $new = $this->input->post('new');
            $confirm = $this->input->post('confirm');

            if (($user->password == $this->hash($old)) && ($new == $confirm)) {
                //Validerar, uppdatera lösen
                $newvals = new stdClass();
                $newvals->password = $this->hash($this->input->post('new'));
                $this->user_model->update($user->id, $newvals);
                $_SESSION['notice'] = array(array("positive" => true, "message" => 'Ditt lösenord ändrades.'));
                redirect('user', 'refresh');
            } else {
                //Validerar inte
                if (($user->password !== $this->hash($old))) {
                    $_SESSION['notice'] = array(array("positive" => false, "message" => 'Gammalt lösenord stämmer inte.'));
                }
                if($new !== $confirm) {
                    $_SESSION['notice'] = array(array("positive" => false, "message" => 'Nytt lösenord och Upprepa lösenord matchar inte.'));
                }
                redirect('user', 'refresh');
            }
        }
    }

    public function email() {
        $this->form_validation->set_rules('email', 'Ny epost', 'trim|required|xss_clean|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE) {
            /* Validation failed. :( */
            $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
            redirect('user', 'refresh');
        } else {
            $user = $this->data['pageUser'];
            $email = $this->input->post('email');
            $newvals = new stdClass();
            $newvals->email = $email;
            $this->user_model->update($user->id, $newvals);
            $_SESSION['notice'] = array(array("positive" => true, "message" => 'Din epost ändrades.'));
            redirect('user', 'refresh');
        }
    }

    public function fullname() {
        $this->form_validation->set_rules('fullname', 'Nytt fullständigt namn', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            /* Validation failed. :( */
            $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
            redirect('user', 'refresh');
        } else {
            $user = $this->data['pageUser'];
            $fullname = $this->input->post('fullname');
            
            $newvals = new stdClass();
            $newvals->fullname = $fullname;
            $this->user_model->update($user->id, $newvals);
            $_SESSION['notice'] = array(array("positive" => true, "message" => 'Ditt fullständiga namn ändrades.'));
            redirect('user', 'refresh');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */