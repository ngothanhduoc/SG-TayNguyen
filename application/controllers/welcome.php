<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Controller {


    public function __construct() {
        parent::__construct();
        $this->check_permission();
    }


    public function index() {
        //redirect(base_url() . 'game/index');
        
        $this->template->write_view('content', 'welcome_message', array());
        $this->template->render();

    }

}
