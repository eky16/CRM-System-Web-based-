<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        if(time() - $this->session->userdata('last_activity') > $this->config->item('sess_expiration')) {
            $this->session->sess_destroy();
            redirect('login');
        } else {
            $this->session->set_userdata('last_activity', time());
        }
    }
    
}
