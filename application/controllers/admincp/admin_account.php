<?php
//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Account extends MY_Controller {

    protected $_arrParam;
    function __construct() {
        parent::__construct();
            $this->check_permission();		
    }


    function index() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName.'::'.$actionName.'::user'] = time();
        
        $this->template->write_view('content', 'admincp/account/index', $data);
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

        foreach($list['rows'] as $v){
                $arrr[$v['id']] = $v['display_name'];
        }
        $data['groupmenu'] = $arrr;
        $arrAd = array();
        
        $arrGis = array();
        
        
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('user','id_admin',$this->input->get('id',TRUE));
            $data['data'] = $rs;
            
            $adminmenu = $this->m_backend->get_adminmenu($rs['id_admin']);

            foreach($adminmenu as $val){
                    $arrAd[] = $val['id_function'];
            }
            
            $gis = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $rs['id_admin']);
            
            if(empty($gis) === FALSE){
                foreach($gis as $val){
                    $arrGis[] = $val['id_game'];
                }
            }
           
        }
        
        
        
        $arr = array();
        $arrG = $this->m_backend->get_groupmenu();
        
        foreach($arrG as $key => $val){
            $val['level'] = 0;
            $arr[] = $val;
            $arrM = $this->m_backend->get_menu($val['id']);
            foreach($arrM as $key => $vl){
                    if(in_array($vl['id_function'],$arrAd)){
                            $vl['checked'] = 1;
                    }else{
                            $vl['checked'] = 0;
                    }
                    $vl['level'] = 1;
                    $arr[] = $vl;
            }
        }

        $data['menu'] = $arr;
        
	$this->template->write_view('content', 'admincp/account/add', $data);
        $this->template->render();        
    }
}