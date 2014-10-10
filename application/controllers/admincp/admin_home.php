<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_home extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::slide'] = time();

        $this->template->write_view('content', 'admincp/home/index', $data);
        $this->template->render();
    }
    function add(){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('slide','id_slide',$id, "id_slide");
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        
	$this->template->write_view('content', 'admincp/home/add', $data);
        $this->template->render();        
    }
}
?>