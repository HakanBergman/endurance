<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail {
    
    static $CI;
    
    function __construct() {

        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('email');
    }

    /**
     * Skickar välkomstmail.
     */
    function welcome_email($email, $password) {

        

        //Kolla om användaren finns
        $user = $this->CI->user_model->get_by('email', $email);

        if ($user) {

            $data["user"] = $user;
            $data["password"] = $password;
            $message = $this->CI->load->view('mail/newuser', $data, TRUE);

            
            $sender_email = $this->CI->config->item("default_email");
            $sender_name = $this->CI->config->item("default_email_name");
            $this->CI->email->from($sender_email, $sender_name);
            $this->CI->email->to($user->email);
            $this->CI->email->subject('Välkommen');
            $this->CI->email->message($message);

            if ($this->CI->email->send()) {

                $_SESSION['notice'][] = array("positive" => true, "message" => "Ett meddelande med instruktioner har skickats till ". $email);
                return true;
            } else {
                $_SESSION['notice'][] = array("positive" => true, "message" => "Det blev något fel när välkomstmeddelande skulle skickas till användaren.");
                return false;
            }
        } else {
            $_SESSION['notice'][] = array("positive" => false, "message" => "Det finns ingen användare med den epost-adressen");
            return false;
        }
    }
    
        /**
     * Skickar välkomstmail.
     */
    function move_student_email($user_id, $school, $message) {

        
        //Kolla om användaren finns
        $user = $this->CI->user_model->get_by('id', $user_id);
        
        if ($user) {
            
            //$recipient = "Peter.Engstrom@drumedar.se";
            $recipient = "love@ssol.se";
            $data["user"] = $user;
            $data["school"] = $school;
            $data["message"] = $message;
            $message = $this->CI->load->view('mail/move_student', $data, TRUE);

            
            $sender_email = $this->CI->config->item("default_email");
            $sender_name = $this->CI->config->item("default_email_name");
            $this->CI->email->from($sender_email, $sender_name);
            $this->CI->email->to($recipient);
            $this->CI->email->subject('Flytt av utövare');
            $this->CI->email->message($message);

            if ($this->CI->email->send()) {

                $_SESSION['notice'][] = array("positive" => true, "message" => "Ett meddelande om din flytt har skickats till ansvarig.");
                return true;
            } else {
                $_SESSION['notice'][] = array("positive" => true, "message" => "Det blev något fel när meddelande skulle skickas.");
                return false;
            }
        } else {
            $_SESSION['notice'][] = array("positive" => false, "message" => "Det finns ingen användare med den epost-adressen");
            return false;
        }
    }

}

/* End of file Smartytpl.php */
/* Location: ./application/libraries/Smartytpl.php */