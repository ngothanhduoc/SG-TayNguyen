<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('frontend/m_home');
        $this->template->set_template('home_web');
    }

    public function index() {

        $this->m_home->_table = "article";
        $this->m_home->_key = "id";
        $data['gioi_thieu'] = $this->m_home->get_by_id(1);
        $data['product'] = $this->m_home->get_product(8);
        
        $this->template->write_view('content', 'website/view_home', $data);
        $this->template->render();
    }

    public function about() {
        $this->m_home->_table = "article";
        $this->m_home->_key = "id";
        $data['gioi_thieu'] = $this->m_home->get_by_id(1);
        
        $this->template->write_view('content','website/view_about', $data);
        $this->template->render();
    }

    public function product() {
        $data['product'] = $this->m_home->get_product(12);
        $this->template->write_view('content','website/view_product', $data);
        $this->template->render();
    }

    public function news() {
        $this->template->write_view('content','website/view_news');
        $this->template->render();
    }
    public function anw() {
        $this->template->write_view('content','website/view_anw');
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
    public function detail_product($params){
        $id = get_id_url($params);
        $this->m_home->_table = "product";
        $this->m_home->_key = "id_product";
        $data['product'] = $this->m_home->get_by_id($id);
        $this->template->write_view('content','website/view_detail_product',$data);
        $this->template->render();
    }

}
