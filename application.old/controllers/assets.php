<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function stylesheets($mobile = false) {
        $output = loadCss($mobile);
        $this->output->set_content_type('css')->set_output($output);
    }
    
    public function scripts() {
        $output = loadjJs();
        $this->output->set_content_type('js')->set_output($output);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */