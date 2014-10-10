<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_contact extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }

    function index() {

        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::contact'] = time();

        $this->template->write_view('content', 'admincp/contact/index', $data);
        $this->template->render();
    }
    function detail(){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('contact','id_contact',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        
	$this->template->write_view('content', 'admincp/contact/detail', $data);
        $this->template->render();        
    }
}
?>