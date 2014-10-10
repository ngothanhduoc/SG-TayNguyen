<?php
//session_start();
ini_set("display_errors", '0');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Article extends MY_Controller {

    protected $_arrParam;
    function __construct() {
        parent::__construct();
            $this->check_permission();	
            $this->load->model('m_backend');
    }


    function index() {
        $data = array();
        
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        //$_SESSION[$controllerName.'::'.$actionName.'::article'] = time();
        
        $arrUser = $this->m_backend->jqxGets('user');
        $arr = array();
        foreach ($arrUser as $val) {
            $arr[$val['id_admin']] = $val['username'];
        }
        $data['users'] = $arr;
       
        
        
	$this->template->write_view('content', 'admincp/article/index', $data);
        $this->template->render();
    }
    function add(){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('article','id',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        
	$this->template->write_view('content', 'admincp/article/add', $data);
        $this->template->render();        
    }
}