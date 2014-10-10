<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Game extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::game'] = time();

        $this->template->write_view('content', 'admincp/game/index', $data);
        $this->template->render();
    }

    function add() {
        $data = array();

        //get category
        $list = $this->m_backend->jqxGets('game_category');
        $arrCate = array();
        $arrCateName = array();
        foreach ($list as $v) {
            $arrCate[$v['id_game_category']] = $v['title'];
            $arrCateName[$v['title']] = $v['id_game_category'];
        }
        $data['arrCate'] = $arrCate;
        $data['arrCateName'] = $arrCateName;

        //get publisher
        $this->m_backend->datatables_config = array(
            "table" => 'publisher',
            "order_by" => "ORDER BY id_publisher DESC",
        );
        $list = $this->m_backend->jqxGets('publisher');
        $arrPublisher = array();
        $arrPublisherName = array();
        
        foreach ($list as $v) {
            $arrPublisher[$v['id_publisher']] = $v['full_name'];
            $arrPublisherName[$v['full_name']] = $v['id_publisher'];
        }
        $data['arrPublisher'] = $arrPublisher;
        $data['arrPublisherName'] = $arrPublisherName;
        
        //get platform
        $list = $this->m_backend->jqxGets('platform');
        $arrPlatform = array();
        foreach($list as $v){
            $arrPlatform[$v['id_platform']] = $v['full_name'];
        }
        $data['arrPlatform'] = $arrPlatform;
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {
            $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);
            $arr = array();
            if (empty($gameUser) === FALSE) {
                foreach ($gameUser as $val) {
                    $arr[] = $val['id_game'];
                }
            }

            if (in_array($this->input->get('id', TRUE), $arr)) {
                $rs = $this->m_backend->jqxGet('game', 'id_game', $this->input->get('id', TRUE));
                if (empty($rs) === FALSE) {
                    $data['catName'] = $arrCate[$rs['id_game_category']];
                    $data['pubName'] = $arrPublisher[$rs['id_publisher']];
                    $data['platform'] = @implode(',',  @json_decode($rs['platform'],true));

                    $slide = json_decode($rs['slide_image'], true);
                    $strslide = '';
                    if (empty($slide) === FALSE) {
                        foreach ($slide as $key => $v) {
                            $i = $key + 1;
                            $strslide .= '<div><input type="text" readonly style="width: 60%; float: left" class="form-control" id="thumb_' . $i . '" rel="' . $i . '" name="slide_image[]" value="' . $v . '">&nbsp;<button style="float: left" onclick=removeImage("#thumb_' . $i . '") type="button" class="btn btn-default rem">-</button></div>';
                        }
                    }
                    $data['slide_image'] = $strslide;
                    
                    $slideW = json_decode($rs['slide_image_wap'], true);
                    $strslideW = '';
                    if (empty($slideW) === FALSE) {
                        foreach ($slideW as $key => $v) {
                            $i = $key + 1;
                            $strslideW .= '<div><input type="text" readonly style="width: 60%; float: left" class="form-control" id="thum_' . $i . '" rel="' . $i . '" name="slide_image_wap[]" value="' . $v . '">&nbsp;<button style="float: left" onclick=removeImage("#thum_' . $i . '") type="button" class="btn btn-default rem">-</button></div>';
                        }
                    }
                    $data['slide_image_wap'] = $strslideW;
                    
                    $_SESSION['KCFINDER']['uploadURL'] = '../../../assets/images/games/game' . $rs['id_game'];
                    $_SESSION['KCFINDER']['uploadDir'] = '../../../assets/images/games/game' . $rs['id_game'];
                    $data['data'] = $rs;
                }
            } else {
                $data['catName'] = '';
                $data['pubName'] = '';
                $data['platform'] = '';
                $data['data']['hot_game'] = 0;
                $data['data']['new_game'] = 0;
            }
        } else {
            $data['catName'] = '';
            $data['pubName'] = '';
            $data['platform'] = '';
            $data['data']['hot_game'] = 0;
            $data['data']['new_game'] = 0;
        }

        $this->template->write_view('content', 'admincp/game/add', $data);
        $this->template->render();
    }

    function publisher() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::publisher'] = time();

        $this->template->write_view('content', 'admincp/game/publisher', $data);
        $this->template->render();
    }

    function addpublisher() {
        $data = array();
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('publisher', 'id_publisher', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
            }
        }

        $this->template->write_view('content', 'admincp/game/addpublisher', $data);
        $this->template->render();
    }

    function category() {
        $data = array();

        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::game_category'] = time();

        $arrUser = $this->m_backend->jqxGets('user');
        $arr = array();
        foreach ($arrUser as $val) {
            $arr[$val['id_admin']] = $val['username'];
        }
        $data['users'] = $arr;
        $this->template->write_view('content', 'admincp/game/category', $data);
        $this->template->render();
    }

    function addcategory() {
        $data = array();
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('game_category', 'id_game_category', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
            }
        }

        $this->template->write_view('content', 'admincp/game/addcategory', $data);
        $this->template->render();
    }

    function platform() {
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::platform'] = time();
        $data = array();
        $this->template->write_view('content', 'admincp/game/view_platform', $data);
        $this->template->render();
    }

    function add_platform() {
        $data = array();
        $id = $this->input->get('id', TRUE);
        $flat = FALSE;
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('platform', 'id_platform', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
                $flat = TRUE;
            }else{
                redirect(base_url('backend/game/platform'));
            }
        }
            
        
        
        
        
        $post = $this->input->post(NULL, TRUE);
        if (!empty($post['id_platform'])) {
            unset($post['id_platform']);
            $this->m_backend->_table = 'platform';
            $this->m_backend->_key = "id_platform";
            $status = $this->m_backend->update($id, $post);
            if ($status === 1)
                redirect(base_url('backend/game/platform'));
            else
                echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
        }else {
            if (!empty($post)) {
                unset($post['id_platform']);
                $this->m_backend->_table = 'platform';
                $post['creat_time'] = date("Y-m-d H:i:s");
                $status = $this->m_backend->insert($post);
                if (!empty($status))
                    redirect(base_url('backend/game/platform'));
                else
                    echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
            }
        }
        $this->template->write_view('content', 'admincp/game/view_add_platform', $data);
        $this->template->render();
    }

}
