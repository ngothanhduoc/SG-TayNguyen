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
        $result = $this->m_backend->jqxGets('game');
        $arr = array();
        foreach ($result as $val){
            $arr[$val['id_game']] = $val['full_name'];
        }
        $data['game'] = $arr;
        
        $result = $this->m_backend->jqxGets('news_category');
        foreach ($result as $val){
            $arr[$val['id_category']] = $val['title'];
        }
        $data['news_category'] = $arr;
        $this->template->write_view('content', 'admincp/newsevent/index', $data);
        $this->template->render();
    }

    function add($id = 0) {
        $id = $this->check_security($id);
        $data = array();
        $this->load->model('m_backend');
        $str='';
        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);
        if(empty($gameUser) === FALSE){
            $arr = array();
            foreach($gameUser as $val){
                $arr[] = $val['id_game'];
            }
            $str = implode(',', $arr);
        }else{
            $str = 0;
        }
        
        $this->m_backend->datatables_config = array(
            "table" => 'game',
            "where" => "where id_game IN (".$str.")",
            //"order_by" => "ORDER BY id_news DESC",
        );

        $listgame = $this->m_backend->jqxBinding();

        $arrr = array();

        foreach ($listgame['rows'] as $v) {
            $arrr[$v['id_game']] = $v['full_name'];
        }
        $data['game'] = $arrr;
        
        $this->m_backend->datatables_config = array(
            "table" => 'news_category',
                //"where" => "where `status` != 0",
                //"order_by" => "ORDER BY id DESC",
        );
        $list = $this->m_backend->jqxBinding();
        $arrr = array();
        foreach ($list['rows'] as $v) {
            $arrr[$v['id_category']] = $v['title'];
        }
        $data['cat'] = $arrr;
        
        $data['gameIndex']=''; $data['catIndex']=''; $data['featured']='Active'; $data['order']='Active'; $data['type']="news";
        if ($id != 0 && is_numeric($id)) {
            $this->m_backend->datatables_config = array(
                "table" => 'news',
                "where" => "where id_game IN (".$str.")",
                //"order_by" => "ORDER BY id_news DESC",
            );

            $listnews = $this->m_backend->jqxBinding();
            $arr = array();
            if (empty($listnews) === FALSE) {
                foreach ($listnews['rows'] as $val) {
                    $arr[] = $val['id_news'];
                }
            }
            if (in_array($id, $arr)) {
                $info = $this->m_backend->jqxGet('news', 'id_news', $id);
                $data['data'] = $info;

                if (empty($data['data'])) {
                    return Redirect::to('backend/newsevent/index');
                }
                $data['featured']='Active';
                if($data['data']['featured_home']==0)
                    $data['featured']='Block';
                
                $data['order']='Active';
                if($data['data']['order_home']==0)
                    $data['order']='Block';
                
                $data['type']='news';
                if($data['data']['type']=='event')
                    $data['type']='event';

                $this->m_backend->_table = 'game';
                $infoGame = $this->m_backend->jqxGetgame($data['data']['id_game']);
                $data['gameIndex'] = $infoGame['full_name'];
                $this->m_backend->_table = 'news_category';
                $infoCat = $this->m_backend->jqxGetcategory($data['data']['id_category']);
                $data['catIndex'] = $infoCat['title'];
            }
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

