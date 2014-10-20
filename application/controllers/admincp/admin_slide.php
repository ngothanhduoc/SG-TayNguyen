<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_slide extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::images'] = time();

        $this->template->write_view('content', 'admincp/home/index', $data);
        $this->template->render();
    }
    function add($id = 0){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('images','id_slide',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        $post = $this->input->post();     
        $id_slide = $post['id'];
        unset($post['id']);
        if (!empty($post)) {

            if (empty($id_slide) === FALSE) {
                $rs = $this->m_backend->update_data("images", $post, array('id_slide' => $id_slide));
                redirect("/backend/slide/index");
            } else {
                $id_slide = $this->m_backend->jqxInsertId('images', $post);
                redirect("/backend/slide/index");
            }
        }
	$this->template->write_view('content', 'admincp/home/add', $data);
        $this->template->render();        
    }
}
?>