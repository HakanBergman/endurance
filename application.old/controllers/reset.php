<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reset extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('password_reminders_model');
        $this->load->library('form_validation');
    }

    /**
     * Skickar mail med instruktioner om att återställa lösenord.
     */
    public function email() {
        if ($this->input->post('email')) {

            $this->load->helper('url');
            $email = $this->input->post('email');

            //Kolla om användaren finns
            $user = $this->user_model->get_by(array('email' => $email));
            if (count($user) !== 0) {

                $data["token"] = $this->createNewToken($user);
                $data["user"] = $user;
                $data["reseturl"] = site_url("reset/password/");
                $message = $this->load->view('mail/newpassword', $data, TRUE);

                $this->load->library('email');
                $this->email->from('no-reply@endurance.se', 'Endurance.se');
                $this->email->to($user->email);
                $this->email->subject('Återställ lösenord');
                $this->email->message($message);
                if ($this->email->send()) {
                    //Spara token i db
                    $reminder = array(
                        "email" => $user->email,
                        "token" => $data["token"]
                    );

                    $this->password_reminders_model->insert($reminder);
                    $_SESSION['notice'][] = array("positive" => true, "message" => "Ett meddelande med instruktioner har skickats till din epost.");
                    redirect('/reset', 'refresh');
                }
            } else {
                $_SESSION['notice'][] = array("positive" => false, "message" => "Det finns ingen användare med den epost-adressen");
                redirect('/reset/email', 'refresh');
            }
        } else {
            $this->data["pageUser"] = false;
            $this->load->view('header', $this->data);
            $this->load->view('pages/email', $this->data);
            $this->load->view('footer');
        }
    }

    /**
     * Återställer lösenord 
     * 
     * @param int $id
     * @param string $token
     */
    public function password($id, $token) {
        if ($this->input->post('password')) {

            //Kolla om token finns i tabellen password_reminders och isf att det inte är äldre en 60min.
            $password_reminders = $this->password_reminders_model->get_by(array('token' => $token, 'created_at >' => strtotime('-1 hour')));
            if (count($password_reminders) == 1) {
                $this->form_validation->set_rules('password', 'Nytt lösenord', 'trim|required|xss_clean|min_length[6]');

                if ($this->form_validation->run() == FALSE) {
                    /* Validation failed. :( */
                    $_SESSION['notice'][] = array("positive" => false, "message" => validation_errors());
                    redirect('user', 'refresh');
                } else {
                    $user = array();
                    $user["password"] = md5($this->input->post('password'), true);
                    if ($this->user_model->update($id, $user)) {
                        $_SESSION['notice'][] = array("positive" => true, "message" => "Ditt nya lösenord sparades.");
                        redirect('reset', 'refresh');
                    }
                    else {
                        $_SESSION['notice'][] = array("positive" => false, "message" => "Ditt lösenord kunde inte sparas just nu.");
                        redirect('reset', 'refresh');
                    }
                }
            } else {
                $_SESSION['notice'][] = array("positive" => false, "message" => "Detta token för att återställa lösenord är inte giltigt.");
                redirect('reset', 'refresh');
            }
        } else {
            $this->data["reseturl"] = site_url("reset/password/" . $id . "/" . $token);
            $this->data["pageUser"] = false;
            $this->load->view('header', $this->data);
            $this->load->view('pages/password', $this->data);
            $this->load->view('footer');
        }
    }

    private function createNewToken($user) {

        $hashKey = $this->config->item("encryption_key");
        $email = $user->email;

        $value = str_shuffle(sha1($email . spl_object_hash($this) . microtime(true)));

        return hash_hmac('sha1', $value, $hashKey);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
