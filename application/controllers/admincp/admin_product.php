<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_product extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::product'] = time();
        
        $this->template->write_view('content', 'admincp/product/index', $data);
        $this->template->render();
    }
    function add(){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('product','id_product',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        } 
        $this->m_backend->_table = 'group_product';
        $group = $this->m_backend->get_table();
        foreach ($group as $key => $value) {
            $data['group'][]  = $value['name'];
            if($rs['id_group_product'] == $value['id_group_product']){
                $data['group_name'] = $value['name'];
            }
        }   
        
	$this->template->write_view('content', 'admincp/product/add', $data);
        $this->template->render();        
    }
    public function index_group_product(){
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::product'] = time();

        $this->template->write_view('content', 'admincp/product/index_group_product', $data);
        $this->template->render();
    }
    function add_group_product(){
        $data = array();
	$this->load->model('m_backend');
        $post = $this->input->post(NULL,TRUE);
        $id_group_product = $post['id'];
        unset($post['id']);
        if (!empty($post)) {

            if (empty($id_group_product) === FALSE) {
                $rs = $this->m_backend->update_data("group_product", $post, array('id_group_product' => $id_group_product));
                redirect("/backend/group_product/index");
            } else {
                $group_product = $this->m_backend->jqxInsertId('group_product', $post);
                redirect("/backend/group_product/index");
            }
        }
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('group_product','id_group_product',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        
	$this->template->write_view('content', 'admincp/product/add_group_product', $data);
        $this->template->render();        
    }
}
?>