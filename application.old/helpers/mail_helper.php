<?php

/**
 * Skickar välkomstmail.
 */
function welcome_email($email) {

    $this->load->helper('url');

    //Kolla om användaren finns
    $users = $this->user_model->get_by('email', $email);

    if (count($users) == 1) {
        $user = $users[0];

        $data["user"] = $user;
        $message = $this->load->view('mail/newuser', $data, TRUE);

        $this->load->library('email');
        $sender_email = $this->config->item("default_email");
        $sender_name = $this->config->item("default_email_name");
        $this->email->from($sender_email, $sender_name);
        $this->email->to($user->email);
        $this->email->subject('Återställ lösenord');
        $this->email->message($message);
        
        if ($this->email->send()) {
            
            $_SESSION['notice'][] = array("positive" => true, "message" => "Ett meddelande med instruktioner har skickats till användaren");
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
