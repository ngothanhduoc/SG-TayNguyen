<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public $data;

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/m_home');
        $this->template->set_template('home_web');

        $this->data['partner'] = $this->m_home->get_where("images", array('type' => 'partner'));
        $this->data['company'] = $this->m_home->get_where("images", array('type' => 'company'));
        $this->data['news'] = $this->m_home->get_new(5);
        $this->m_home->_table = "contact_yahoo";
        $this->data['contact'] = $this->m_home->get_table();
        
    }

    public function index() {
        $data = $this->data;
        $this->m_home->_table = "article";
        $this->m_home->_key = "id";
        $data['gioi_thieu'] = $this->m_home->get_by_id(1);
        $data['product'] = $this->m_home->get_product(8);

        $this->template->write_view('content', 'website/view_home', $data);
        $this->template->render();
    }

    public function about() {
        $data = $this->data;
        $this->m_home->_table = "article";
        $this->m_home->_key = "id";
        $data['gioi_thieu'] = $this->m_home->get_by_id(1);

        $this->template->write_view('content', 'website/view_about', $data);
        $this->template->render();
    }

    public function product() {
        $data = $this->data;
        $data['product'] = $this->m_home->get_product(12);
        $this->template->write_view('content', 'website/view_product', $data);
        $this->template->render();
    }

    public function news() {
        $data = $this->data;
        $this->m_home->_table = "news";
        $data['data_news'] = $this->m_home->get_table();
        $this->template->write_view('content', 'website/view_news',$data);
        $this->template->render();
    }

    public function anw() {
        $data = $this->data;
        $this->template->write_view('content', 'website/view_anw', $data);
        $this->template->render();
    }

    public function ajax_product() {
        $page = $this->input->get("page", TRUE);
        if (!is_array($page))
            $data['product'] = $this->m_home->get_product(12, $page);
        if (!empty($data['product'])) {
            $this->load->view('website/view_product_ajax', $data);
        } else {
            echo "end";
        }
    }

    public function detail_product($params) {
        $data = $this->data;
        $id = get_id_url($params);
        $this->m_home->_table = "product";
        $this->m_home->_key = "id_product";
        $data['product'] = $this->m_home->get_by_id($id);
        $this->template->write_view('content', 'website/view_detail_product', $data);
        $this->template->render();
    }
    public function detail_news($params){
        $data = $this->data;
        $id = get_id_url($params);
        $this->m_home->_table = "news";
        $this->m_home->_key = "id_news";
        $data['data_news'] = $this->m_home->get_by_id($id);
        $this->template->write_view('content', 'website/view_detail_news', $data);
        $this->template->render();
    }
}
