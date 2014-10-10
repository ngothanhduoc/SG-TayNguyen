<?php
//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Menu extends MY_Controller {

    protected $_arrParam;
    function __construct() {
        parent::__construct();
            $this->check_permission();		
    }


    function index() {
        $data = array();
        
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName.'::'.$actionName.'::function'] = time();
        
        $this->load->model('m_backend');

        $result = $this->m_backend->jqxGets('function_group');
	$arr = array();
        foreach ($result as $val){
            $arr[$val['id']] = $val['display_name'];
        }
        $data['menu_group'] = $arr;
        
	$this->template->write_view('content', 'admincp/menu/index', $data);
        $this->template->render();
    }
    function add(){
        $data = array();
	$this->load->model('m_backend');
        $this->m_backend->datatables_config = array(
            "table" => 'function_group',
            //"where" => "where `status` != 0",
            "order_by" => "ORDER BY id DESC",
        );

        $list = $this->m_backend->jqxBinding();
        
        $arrr = array();
	$arr = array();	
        foreach($list['rows'] as $v){
                $arrr[$v['id']] = $v['display_name'];
                $arr[$v['display_name']] = $v['id'];
        }
        $data['groupmenu'] = $arrr;
        $data['arrgroupname'] = $arr;
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('function','id_function',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
                $data['groupName'] = $arrr[$rs['parent_id']];
            }
        }
        
	$this->template->write_view('content', 'admincp/menu/add', $data);
        $this->template->render();        
    }
    function group(){
        $data = array();
	$this->template->write_view('content', 'admincp/menu/group', $data);
        $this->template->render();
    }
    function addgroup($id=0){
        $id = $this->check_security($id);
        $data = array();
        if($id!=0){
            $this->load->model('m_backend');
            $this->m_backend->_table="function_group";
            $data['data']=$this->m_backend->jqxGetmenugroup($id);
        }
	$this->template->write_view('content', 'admincp/menu/addgroup', $data);
        $this->template->render();
    }
}