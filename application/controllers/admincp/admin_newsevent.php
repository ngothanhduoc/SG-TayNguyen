<?php

//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_newsevent extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
    }

    function index() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::newsevent'] = time();

        $this->load->model('m_backend');

        $result = $this->m_backend->jqxGets('news');

        $data['news_category'] = $result;
        $this->template->write_view('content', 'admincp/newsevent/index', $data);
        $this->template->render();
    }

    function add($id = 0) {
        $id = $this->check_security($id);
        $data = array();
        $this->load->model('m_backend');
        $str = '';


        $this->m_backend->datatables_config = array(
            "table" => 'news',
        );
        $data = $this->m_backend->jqxBinding();

        $post = $this->input->post();
        $id_news = $post['id'];
        unset($post['id']);
        if (!empty($post)) {

            if (empty($id_news) === FALSE) {
                $rs = $this->m_backend->update_data("news", $post, array('id_news' => $id_news));
                redirect("/backend/newsevent/index");
            } else {
                $id_news = $this->m_backend->jqxInsertId('news', $post);
                redirect("/backend/newsevent/index");
            }
        }
        if ($id !== FALSE) {
            $this->m_backend->_table = 'news';
            $this->m_backend->_key = "id_news";
            $data['data'] = $this->m_backend->get_by_id($id);
        }
        $this->template->write_view('content', 'admincp/newsevent/add', $data);
        $this->template->render();
    }

    public function news_category() {
        $data = array();
        $this->template->write_view('content', 'admincp/newsevent/view_news_category', $data);
        $this->template->render();
    }

    public function news_addcategory($id = "") {
        $id = $this->check_security($id);
        $post = $this->input->post(NULL, TRUE);
        $data = array();
        if ($id !== FALSE) {
            $this->load->model('m_backend');
            $this->m_backend->_table = 'news_category';
            $this->m_backend->_key = "id_category";
            if (!empty($post)) {
                unset($post['id_category']);
                if (!empty($post['status']))
                    $post['status'] = 'active';
                else
                    $post['status'] = 'block';
                $status = $this->m_backend->update($id, $post);
                if ($status === 1)
                    redirect(base_url('backend/newsevent/category'));
                else
                    echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
            }
            $data['data'] = $this->m_backend->get_by_id($id);
//            exit(json_encode($post));
        }else {
            if (!empty($post)) {
                $this->load->model('m_backend');
                $this->m_backend->_table = 'news_category';
                if (!empty($post['status']))
                    $post['status'] = 'active';
                else
                    $post['status'] = 'block';
                $post['create_user'] = $this->_user_info['username'];
                $status = $this->m_backend->insert($post);
                if (!empty($status))
                    redirect(base_url('backend/newsevent/category'));
                else
                    echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
            }
        }


        $this->template->write_view('content', 'admincp/newsevent/view_addcategory', $data);
        $this->template->render();
    }

}
