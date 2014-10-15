<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_yahoo extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::contact_yahoo'] = time();

        $this->template->write_view('content', 'admincp/yahoo/index', $data);
        $this->template->render();
    }
    function add($id = 0){
        $data = array();
	$this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('contact_yahoo','id_yahoo',$id);
            if(empty($rs) === FALSE){
                $data['data'] = $rs;
            }
        }
        $post = $this->input->post();   
        $id_yahoo = $post['id'];
        unset($post['id']);
        if (!empty($post)) {

            if (empty($id_yahoo) === FALSE) {
                $rs = $this->m_backend->update_data("contact_yahoo", $post, array('id_yahoo' => $id_yahoo));
                redirect("/backend/yahoo/index");
            } else {
                $id_yahoo = $this->m_backend->jqxInsertId('contact_yahoo', $post);
                redirect("/backend/yahoo/index");
            }
        }
	$this->template->write_view('content', 'admincp/yahoo/add', $data);
        $this->template->render();        
    }
}
?>