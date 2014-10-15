<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_anw extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::anwser'] = time();

        $this->template->write_view('content', 'admincp/anwser/index', $data);
        $this->template->render();
    }
    function edit($id = 0){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('anwser','id_anwser',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        $post = $this->input->post();   
        $id_anwser = $post['id'];
        unset($post['id']);
        if (!empty($post)) {

            if (empty($id_anwser) === FALSE) {
                $rs = $this->m_backend->update_data("anwser", $post, array('id_anwser' => $id_anwser));
                redirect("/backend/anw/index");
            }
        }
	$this->template->write_view('content', 'admincp/anwser/edit', $data);
        $this->template->render();        
    }
}
?>