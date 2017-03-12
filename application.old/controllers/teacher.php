<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teacher extends MY_Controller {

    function __construct() {
        parent::__construct();

        if ($this->data['pageUser']->type != "100") {
            show_error('errors/forbidden', 403);
        }

        $this->load->model('school_model');
        $this->load->model('group_model');
        $this->load->model('user_group_model');
        $this->load->library('mail');
    }

    public function list_teachers() {
        $schools = $this->school_model->with('school_groups')->order_by("schools.title", "asc")->get_all('title', 'asc');
        //hämta lärargrupen för varje skola
        foreach ($schools as $key => $school) {
            $has_teachers_group = false;
            foreach ($school->school_groups as $group) {
                if ($group->group_type == 50 || $group->group_type == 5) {
                    //Hämta alla tränare som hör till gruppen
                     
                    $school_teachers =  $this->user_model->join('user_groups', 'users.id = user_groups.user_id')->order_by("users.fullname", "asc")->get_many_by(array('user_groups.group_id' => $group->group_id, 'users.type' => 50));                   
                    $external_school_teachers =  $this->user_model->join('user_groups', 'users.id = user_groups.user_id')->order_by("users.fullname", "asc")->get_many_by(array('user_groups.group_id' => $group->group_id, 'users.type' => 5));
                    
                    foreach($school_teachers as $teacher) {
                       $school->school_teachers[] = $teacher; 
                    }  
                    
                    foreach($external_school_teachers as $teacher) {
                       $school->school_teachers[] = $teacher; 
                    }
                    
                    $has_teachers_group = true;
                }
            }
            if (!$has_teachers_group) {
                unset($schools[$key]);
            }
        }

        $this->data["schools"] = $schools;

        $this->load->view('header', $this->data);
        $this->load->view('pages/teacher/list', $this->data);
        $this->load->view('footer');
    }

    public function delete_teacher($id) {

        if ($this->input->post('delete_teacher')) {
            $this->user_model->delete($id);
            redirect('/teacher/list', 'refresh');
        } else {
            $teacher = $this->user_model->get($id);
            if (!isset($teacher)) {
                show_404();
            }

            $this->data["teacher"] = $teacher;
            $this->data["id"] = $id;
            $this->load->view('header', $this->data);
            $this->load->view('pages/teacher/delete', $this->data);
            $this->load->view('footer');
        }
    }

    public function edit_teacher($id) {

        if ($this->input->post('teacher_fullname')) {

            $this->form_validation->set_rules('teacher_email', 'Epost', 'trim|required|xss_clean|valid_email|is_unique[users.email.id.' . $id . ']');
            $this->form_validation->set_rules('teacher_fullname', 'Fullständigt namn', 'required');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('/teacher/edit/' . $id);
            } else {
                $teacher = array();
                $teacher['fullname'] = $this->input->post('teacher_fullname');
                $teacher['email'] = $this->input->post('teacher_email');
                $this->user_model->update($id, $teacher);
                redirect('/teacher/list', 'refresh');
            }
        } else {
            $teacher = $this->user_model->get($id);
            $this->data["teacher"] = $teacher;
            $this->data["id"] = $id;
            $this->load->view('header', $this->data);
            $this->load->view('pages/teacher/edit', $this->data);
            $this->load->view('footer');
        }
    }

    public function add_teacher() {

        if ($this->input->post('teacher_fullname')) {

            $this->form_validation->set_rules('teacher_email', 'Epost', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('teacher_fullname', 'Fullständigt namn', 'required');

            if ($this->form_validation->run() == FALSE) {
                /* Validation failed. :( */
                $_SESSION['notice'] = array(array("positive" => false, "message" => validation_errors()));
                redirect('/teacher/list');
            } else {
                $teacher = array();
                $teacher['fullname'] = $this->input->post('teacher_fullname');
                $teacher['email'] = $this->input->post('teacher_email');
                
                $school_id = $this->input->post('teacher_school');
                
                if($school_id == 25) {
                    $teacher['type'] = 5; //Extern tränare
                }
                else {
                    $teacher['type'] = 50;
                }
                
                $cleartext_password = str_replace("/", "-", substr(base64_encode(md5(rand(), true)), 0, 8));

                $teacher['password'] = $this->hash($cleartext_password);
                 
                $user_id = $this->user_model->insert($teacher);
                //Koppla till lärargrupp för skola
                
                $school_teacher_group = $this->group_model->join('school_groups', 'groups.id = school_groups.group_id')->get_by(array('school_groups.school_id' => $school_id, 'school_groups.group_type' => 50));
                $school_external_teacher_group = $this->group_model->join('school_groups', 'groups.id = school_groups.group_id')->get_by(array('school_groups.school_id' => $school_id, 'school_groups.group_type' => 5));
                
                if ($user_id && isset($school_teacher_group->id)) {
                    $pivot = array();
                    $pivot["group_id"] = $school_teacher_group->group_id;
                    $pivot["user_id"] = $user_id;
                    $this->user_group_model->insert($pivot);
                } elseif($user_id && isset($school_external_teacher_group->id)) {
                    $pivot = array();
                    $pivot["group_id"] = $school_external_teacher_group->group_id;
                    $pivot["user_id"] = $user_id;
                    $this->user_group_model->insert($pivot);
                }

                if ($user_id) {
                    $this->mail->welcome_email($teacher['email'], $cleartext_password);
                }
                redirect('/teacher/list', 'refresh');
            }
        } else {

            $schools = $this->school_model->with('school_groups')->order_by("schools.title", "asc")->get_all('title', 'asc');

            foreach ($schools as $key => $school) {
                $has_teachers_group = false;
                foreach ($school->school_groups as $group) {
                    if ($group->group_type == 50 || $group->group_type == 5) {
                        //Hämta alla tränare som hör till gruppen
                        $school->school_teachers = $this->user_model->join('user_groups', 'users.id = user_groups.user_id')->order_by("users.fullname", "asc")->get_many_by(array('user_groups.group_id' => $group->group_id, 'users.type' => 50));
                        $has_teachers_group = true;
                    }
                }
                if (!$has_teachers_group) {
                    unset($schools[$key]);
                }
            }

            $this->data["schools"] = $schools;
            $this->load->view('header', $this->data);
            $this->load->view('pages/teacher/add', $this->data);
            $this->load->view('footer');
        }
    }

    public function password($id) {

        if ($this->input->post('password')) {
            $teacher = array();
            $teacher["password"] = $this->hash($this->input->post('password'));
            $this->user_model->update($id, $teacher);
            redirect('/teacher/list', 'refresh');
        } else {
            $this->data['teacher'] = $this->user_model->get($id);
            $this->load->view('header', $this->data);
            $this->load->view('pages/teacher/password', $this->data);
            $this->load->view('footer');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */