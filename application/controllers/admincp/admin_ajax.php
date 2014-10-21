<?php

//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Ajax extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
    }

    public function get_list($table = 'game') {
        $table = $this->check_security($table);
        $this->m_backend->datatables_config = array(
            "table" => $table,
                //"where" => "where `status` != 0",
                //"order_by" => "ORDER BY id DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listgame() {

        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);

        if (empty($gameUser) === FALSE) {
            $arr = array();
            foreach ($gameUser as $val) {
                $arr[] = $val['id_game'];
            }
            $str = implode(',', $arr);
        } else {
            $str = 0;
        }
        $this->m_backend->datatables_config = array(
            "table" => 'game',
            "where" => "where id_game IN (" . $str . ")",
            "order_by" => "ORDER BY id_game DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listnewsevent() {
        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);

        if (empty($gameUser) === FALSE) {
            $arr = array();
            foreach ($gameUser as $val) {
                $arr[] = $val['id_game'];
            }
            $str = implode(',', $arr);
        } else {
            $str = 0;
        }
        $this->m_backend->datatables_config = array(
            "table" => 'news',
            "where" => "where id_game IN (" . $str . ")",
            "order_by" => "ORDER BY id_news DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function updatestatusgame($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        $response["code"] = -3;
        $response["message"] = "Error.";
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit(json_encode($response));
        }
        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);
        $arr = array();
        if (empty($gameUser) === FALSE) {
            foreach ($gameUser as $val) {
                $arr[] = $val['id_game'];
            }
        }
        $id = $this->input->get('id', TRUE);
        if (!in_array($id, $arr)) {
            exit;
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);


        $this->m_backend->table = $table;

        $this->m_backend->_table = $table;


        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function updatestatus($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        $response["code"] = -3;
        $response["message"] = "Error.";
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit(json_encode($response));
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);

        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletegame($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }

        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);
        $arr = array();
        if (empty($gameUser) === FALSE) {
            foreach ($gameUser as $val) {
                $arr[] = $val['id_game'];
            }
        }
        $id = $this->input->get('id', TRUE);
        if (!in_array($id, $arr)) {
            exit;
        }

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);

        $data = $this->m_backend->jqxDelete($table, $field, $id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function delete($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            redirect(base_url() . 'logout');
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);

        $data = $this->m_backend->jqxDelete($table, $field, $id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addpublisher() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/publisher';
        $response['message']['full_name'] = '';
        $response['message']['address'] = '';
        $response['message']['phone'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('address', 'address', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('phone', 'phone', 'callback_phone_check|trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (empty($Id) === TRUE) {
                    $Params = array();
                    $Params['phone'] = $this->security->xss_clean($arrParam['phone']);
                    $Params['full_name'] = $this->security->xss_clean($arrParam['full_name']);
                    $Params['address'] = $this->security->xss_clean($arrParam['address']);
                    $Params['website'] = $this->security->xss_clean($arrParam['website']);
                    $Params['note'] = $arrParam['note'];
                    $Params['create_time'] = date('Y-m-d H:i:s');

                    $this->m_backend->jqxInsert('publisher', $Params);
                } else {
                    $Params = array();
                    $Params['phone'] = $this->security->xss_clean($arrParam['phone']);
                    $Params['full_name'] = $this->security->xss_clean($arrParam['full_name']);
                    $Params['address'] = $this->security->xss_clean($arrParam['address']);
                    $Params['website'] = $this->security->xss_clean($arrParam['website']);
                    $Params['note'] = $arrParam['note'];
                    $this->m_backend->jqxUpdate('publisher', 'id_publisher', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                $response['message']['address'] = trim(str_replace($badchars, '', form_error('address')));
                $response['message']['phone'] = trim(str_replace($badchars, '', form_error('phone')));
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addgame() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['id_game_category'] = '';
        $response['message']['id_publisher'] = '';
        $response['message']['full_name'] = '';
        $response['message']['platform'] = '';
        $response['message']['system'] = '';
        $response['message']['id_game'] = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();

            $Id = $arrParam['id'];
            $this->form_validation->set_rules('id_game_category', 'id_game_category', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('id_publisher', 'id_publisher', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('platform', 'platform', 'callback_xss_check|trim|required');

            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {

                if (isset($arrParam['hot_game'])) {
                    $arrParam['hot_game'] = 1;
                } else {
                    $arrParam['hot_game'] = 0;
                }
                if (isset($arrParam['new_game'])) {
                    $arrParam['new_game'] = 1;
                } else {
                    $arrParam['new_game'] = 0;
                }

                $Params = array();
                $Params['id_game_category'] = $this->security->xss_clean($arrParam['id_game_category']);
                $Params['id_publisher'] = $this->security->xss_clean($arrParam['id_publisher']);
                $Params['full_name'] = $this->security->xss_clean($arrParam['full_name']);
                $Params['code_game'] = $this->security->xss_clean($arrParam['code_game']);
                $Params['platform'] = json_encode(explode(',', $this->security->xss_clean($arrParam['platform'])));
                $Params['url_download'] = $this->security->xss_clean($arrParam['url_download']);
                $Params['website'] = $this->security->xss_clean($arrParam['website']);
                $Params['forum'] = $this->security->xss_clean($arrParam['forum']);
                $Params['fanpage'] = $this->security->xss_clean($arrParam['fanpage']);
                $Params['hot_game'] = $this->security->xss_clean($arrParam['hot_game']);
                $Params['new_game'] = $this->security->xss_clean($arrParam['new_game']);
                $Params['description'] = $this->security->xss_clean($arrParam['description']);
                $Params['color'] = $this->security->xss_clean($arrParam['color']);
                $Params['content'] = $arrParam['content'];
                if (empty($Id) === TRUE) {
                    $Params['active_slide_game'] = 1;
                    $Params['status'] = 0;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_user'] = $this->session->userdata['user_info']['id_admin'];

                    $id_game = $this->m_backend->jqxInsertId('game', $Params);

                    if (empty($id_game) === FALSE) {
                        $ParamsH = array();
                        $ParamsH['id_admin'] = $this->session->userdata['user_info']['id_admin'];
                        $ParamsH['id_game'] = $id_game;
                        $ParamsH['status'] = 1;
                        $ParamsH['create_time'] = date('Y-m-d H:i:s');

                        $this->m_backend->jqxInsert('user_has_game', $ParamsH);

                        $_SESSION['KCFINDER']['uploadURL'] = '../../../assets/images/games/game' . $id_game;
                        $_SESSION['KCFINDER']['uploadDir'] = '../../../assets/images/games/game' . $id_game;

                        $path = FCPATH . 'assets/images/games/game' . $id_game . '/images';
                        if (!file_exists($path)) {
                            @mkdir($path, 0777, TRUE);
                            $this->load->library('WriteFile');
                            $fileName = $path . '/index.html';
                            $fileContent = "<html>\n";
                            $fileContent .= "<body bgcolor='#FFFFFF'></body>\n";
                            $fileContent .="</html>";
                            $this->writefile->_write_file($fileName, $fileContent);
                        }

                        $response['code'] = 0;
                        $response['message']['id_game'] = $id_game;
                    }
                } else {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['update_user'] = $this->session->userdata['user_info']['id_admin'];

                    $id_game = $this->m_backend->jqxUpdate('game', 'id_game', $Id, $Params);
                    $response['code'] = 0;
                    $response['message']['id_game'] = $Id;
                }
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['id_game_category'] = trim(str_replace($badchars, '', form_error('id_game_category')));
                $response['message']['id_publisher'] = trim(str_replace($badchars, '', form_error('id_publisher')));
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                $response['message']['platform'] = trim(str_replace($badchars, '', form_error('platform')));
                $response['message']['description'] = trim(str_replace($badchars, '', form_error('description')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addgameimage() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['logo_game'] = '';
        $response['message']['home_image'] = '';
        $response['message']['sub_image'] = '';
        $response['message']['background_game'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id_game'];

            $this->form_validation->set_rules('logo_game', 'logo_game', 'trim|required');
            //$this->form_validation->set_rules('home_image', 'home_image', 'trim|required');
            //$this->form_validation->set_rules('sub_image', 'sub_image', 'trim|required');
            $this->form_validation->set_rules('background_game', 'background_game', 'trim|required');
            //$this->form_validation->set_rules('image_slide_game', 'image_slide_game', 'trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (empty($Id) === FALSE && is_numeric($Id)) {

                    if (empty($arrParam['slide_image']) === FALSE) {
                        $arrSlide = array();
                        foreach ($arrParam['slide_image'] as $val) {
                            if ($val != '') {
                                $arrSlide[] = $val;
                            }
                        }
                        $arrParam['slide_image'] = json_encode($arrSlide);
                    } else {
                        $arrParam['slide_image'] = '';
                    }

                    $Id = $arrParam['id_game'];
                    unset($arrParam['id_game']);
                    if (empty($arrParam['sub_image']) === TRUE)
                        $arrParam['sub_image'] = '/frontend/assets/images/no-image-game.png';
                    $this->m_backend->jqxUpdate('game', 'id_game', $Id, $arrParam);
                    $response['code'] = 0;
                }
            }else {
                $badchars = array('<p>', '</p>');
                $response['message']['logo_game'] = trim(str_replace($badchars, '', form_error('logo_game')));
                //$response['message']['home_image'] =  trim(str_replace($badchars, '', form_error('home_image')));
                //$response['message']['sub_image'] =  trim(str_replace($badchars, '', form_error('sub_image')));
                $response['message']['background_game'] = trim(str_replace($badchars, '', form_error('background_game')));
                //$response['message']['image_slide_game'] =  trim(str_replace($badchars, '', form_error('image_slide_game')));


                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addgameimagewap() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['home_image_wap'] = '';
        $response['message']['background_game_wap'] = '';
        $response['message']['menu_bg'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id_game_wap'];

            //$this->form_validation->set_rules('home_image_wap', 'home_image_wap', 'trim|required');
            $this->form_validation->set_rules('background_game_wap', 'background_game_wap', 'trim|required');
            //$this->form_validation->set_rules('menu_bg', 'menu_bg', 'trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    /*
                      if(empty($arrParam['slide_image_wap']) === FALSE){
                      $arrSlide = array();
                      foreach($arrParam['slide_image_wap'] as $val){
                      if($val != ''){
                      $arrSlide[] = $val;
                      }
                      }
                      $arrParam['slide_image_wap'] = json_encode($arrSlide);
                      }else{
                      $arrParam['slide_image_wap'] = '';
                      }
                     */

                    unset($arrParam['id_game_wap']);
                    if (empty($arrParam['menu_bg']) === TRUE)
                        $arrParam['menu_bg'] = '/frontend/assets/wap/image/detail-menu-bg.png';
                    $this->m_backend->jqxUpdate('game', 'id_game', $Id, $arrParam);
                    $response['code'] = 0;
                }
            }else {
                $badchars = array('<p>', '</p>');
                //$response['message']['home_image_wap'] =  trim(str_replace($badchars, '', form_error('home_image_wap')));
                $response['message']['background_game_wap'] = trim(str_replace($badchars, '', form_error('background_game_wap')));
                //$response['message']['menu_bg'] =  trim(str_replace($badchars, '', form_error('menu_bg')));

                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addarticle() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/article/index';
        $response['message']['title'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('title', 'title', 'callback_xss_check|trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {

                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['fulltext'] = $arrParam['fulltext'];

                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['status'] = 1;
                    $Params['created'] = date('Y-m-d H:i:s');
                    $Params['created_by'] = $user_info['id_admin'];

                    $this->m_backend->jqxInsert('article', $Params);
                } else {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['modified'] = date('Y-m-d H:i:s');
                    $Params['modified_by'] = $user_info['id_admin'];
                    $this->m_backend->jqxUpdate('article', 'id', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addgamecategory() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/category';
        $response['message']['Image-name'] = '';
        $response['message']['title'] = '';
        $response['message']['description'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];
            $file_name = $arrParam['icon'];



            if (isset($_FILES["image"]["name"]) && empty($_FILES["image"]["name"]) === FALSE) {
                $arrParam['Image-name'] = $_FILES["image"]["name"];
            } else {
                $arrParam['Image-name'] = '';
            }

            $this->form_validation->set_rules('title', 'title', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {

                if ($arrParam['Image-name'] != '') {
                    $this->load->library('UploadImage');
                    if ($this->uploadimage->do_upload('image')) {
                        $dataImg = $this->uploadimage->getData();
                        $file_name = $dataImg['file_name'];

                        $originalName = $file_name;
                        $dirUpload = FCPATH . 'assets/images/upload/';
                        $dirFix = FCPATH . 'assets/images/upload/fix/';

                        $widthSize = 100;
                        $heightSize = 100;
                        $this->uploadimage->copyandresize($originalName, $dirUpload, $dirFix, $widthSize, $heightSize);

                        if (empty($Id) === FALSE) {
                            @unlink($dirUpload . $arrParam['icon']);
                            @unlink($dirFix . $arrParam['icon']);
                        }
                    } else {
                        $response['message']['system'] = $this->uploadimage->getError();
                        $response['code'] = 1;
                        goto end;
                    }
                }

                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['description'] = $this->security->xss_clean($arrParam['description']);
                $Params['content'] = $arrParam['content'];
                $Params['image'] = $file_name;
                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['status'] = 1;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_user'] = $user_info['id_admin'];

                    $this->m_backend->jqxInsert('game_category', $Params);
                } else {
                    $this->m_backend->jqxUpdate('game_category', 'id_game_category', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['message']['description'] = trim(str_replace($badchars, '', form_error('description')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addaccount() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/account/index';
        $response['message']['username'] = '';
        $response['message']['full_name'] = '';
        $response['message']['password'] = '';
        $response['message']['system'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->security->xss_clean($this->input->post(NULL, TRUE));
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('username', 'username', 'callback_username_check|trim|required');
            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');
            if (empty($Id) === TRUE) {
                $this->form_validation->set_rules('password', 'password', 'trim|required');
            }
            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                $Params = array();
                $Params['username'] = $arrParam['username'];
                $Params['full_name'] = $arrParam['full_name'];

                if (empty($Id) === TRUE) {
                    $Params['password'] = md5($arrParam['password']);
                    $Params['status'] = 0;
                    $Params['create_time'] = date('Y-m-d H:i:s');

                    $rs = $this->m_backend->jqxInsertId('user', $Params);
                } else {
                    $rs = $arrParam['id'];
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    if ($arrParam['password'] != '') {
                        $Params['password'] = md5($arrParam['password']);
                    }
                    $this->m_backend->jqxUpdate('user', 'id_admin', $Id, $Params);

                    $this->m_backend->jqxDelete('user_has_function', 'id_admin', $Id);

                    $this->m_backend->jqxDelete('user_has_game', 'id_admin', $Id);
                }

                if (isset($arrParam['mid'])) {
                    foreach ($arrParam['mid'] as $v) {
                        $Pas = array();
                        $Pas['id_admin'] = $rs;
                        $Pas['id_function'] = $v;
                        $r = $this->m_backend->jqxInsert('user_has_function', $Pas);
                    }
                }

                if (isset($arrParam['gid'])) {
                    foreach ($arrParam['gid'] as $v) {
                        $Pas = array();
                        $Pas['id_admin'] = $rs;
                        $Pas['id_game'] = $v;
                        $Pas['status'] = 1;
                        $Pas['create_time'] = date('Y-m-d H:i:s');
                        $r = $this->m_backend->jqxInsert('user_has_game', $Pas);
                    }
                }


                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['username'] = trim(str_replace($badchars, '', form_error('username')));
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                if (empty($Id) === TRUE) {
                    $response['message']['password'] = trim(str_replace($badchars, '', form_error('password')));
                }
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addmenu() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/menu/index';
        $response['message']['group_name'] = '';
        $response['message']['name_display'] = '';
        $response['message']['url'] = '';
        $response['message']['name'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('group_name', 'group_name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name_display', 'name_display', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('url', 'url', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                $Params['parent_id'] = $arrParam['group_name'];
                $Params['name_display'] = $arrParam['name_display'];
                $Params['url'] = $arrParam['url'];
                $Params['name'] = $arrParam['name'];

                $badchars = '#/#';
                $Params['alias'] = trim(preg_replace($badchars, '-', substr($arrParam['url'], 1)));
                if (empty($Id) === FALSE) {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxUpdate('function', 'id_function', $Id, $Params);
                } else {
                    $Params['is_leaf'] = 0;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxInsert('function', $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['group_name'] = trim(str_replace($badchars, '', form_error('group_name')));
                $response['message']['name_display'] = trim(str_replace($badchars, '', form_error('name_display')));
                $response['message']['url'] = trim(str_replace($badchars, '', form_error('url')));
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function username_check($str = '') {
        $str = $this->check_security($str);
        $validate = preg_match('#^[0-9a-zA-Z._-]{2,20}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('username_check', 'Viết liền nhau không dấu, nhiều hơn 2 ký tự!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function phone_check($str = '') {
        $str = $this->check_security($str);
        $validate = preg_match('#^[0-9._-]{10,12}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('phone_check', 'Không hợp lệ!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function xss_check($str = '') {
        $str = $this->check_security($str);
        if ($str != '') {
            $validate = preg_match('#^[^\*@\#\$%&<>()\']{1,1000}$#', $str);
            if (!$validate) {
                $this->form_validation->set_message('xss_check', 'Không được nhập ký tự đặc biệt!');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function updatenews($table) {
        $table = $this->check_security($table);
        //-- Check user have permission to delete ------------------------------
        $id = $this->input->get('id', TRUE);
        $st = $this->input->get('st', TRUE);
        $id = (!empty($id) ? $id : 0);
        $st = (!empty($st) ? $st : 0);
        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdatenews($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletenews($table) {
        $table = $this->check_security($table);
        $id = $this->input->get('id', TRUE);
        $id = (!empty($id) ? $id : 0);
        $this->m_backend->_table = $table;
        $data = $this->m_backend->jqxDeletenews($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addnewsevent() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/newsevent/index';
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            $this->form_validation->set_rules('name', 'Tiêu đề', 'trim|required');
            $this->form_validation->set_rules('image', 'Hình', 'trim|required');
            $this->form_validation->set_rules('content', 'Nội dung', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                
                $Params['name'] = $this->security->xss_clean($arrParam['title']);
                $Params['content'] = $arrParam['content'];
                $Params['image'] = $arrParam['image'];
                
              
                if (empty($Id) === FALSE) {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $rs = $this->m_backend->jqxUpdatenews($Id, $Params);
                    $response['message']['id_news'] = $Id;
                } else {
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $id_news = $this->m_backend->jqxInsertId('news', $Params);
                    $response['message']['id_news'] = $id_news;
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['name'] = $this->form_validation->error('title', ' ', ' ');
                $response['message']['description'] = $this->form_validation->error('description', ' ', ' ');
                
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addnewseventimage() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/newsevent/index';
        $response['message']['image_slide'] = '';
        $response['message']['image_banner'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('image_banner', 'Image Banner', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($arrParam['active_slide'] == 1 && (empty($arrParam['image_slide']) || $arrParam['image_slide'] == "")) {
                $this->form_validation->set_rules('image_slide', 'Image Slide', 'trim|required');
            }
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id_news'];
                $Params['image_banner'] = $arrParam['image_banner'];
                $Params['image_slide'] = $arrParam['image_slide'];
                $Params['order_slide'] = $arrParam['order_slide'];
                $Params['active_slide'] = $arrParam['active_slide'];

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    $this->m_backend->jqxUpdate('news', 'id_news', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['image_banner'] = $this->form_validation->error('image_banner', ' ', ' ');
                $response['message']['image_slide'] = $this->form_validation->error('image_slide', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function updatemenugroup($table) {
        $table = $this->check_security($table);
        //-- Check user have permission to delete ------------------------------
        $id = $this->input->get('id', TRUE);
        $st = $this->input->get('st', TRUE);
        $id = (!empty($id) ? $id : 0);
        $st = (!empty($st) ? $st : 0);
        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdatemenugroup($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletemenugroup($table) {
        $table = $this->check_security($table);
        $id = $this->input->get('id', TRUE);
        $id = (!empty($id) ? $id : 0);
        $this->m_backend->_table = $table;
        $data = $this->m_backend->jqxDeletemenugroup($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addmenugroup() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/menu/group';
        $response['message']['display_name'] = '';
        $response['message']['alias'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('display_name', 'display_name', 'trim|required');
            $this->form_validation->set_rules('alias', 'alias', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];
                $Params = array();
                $this->m_backend->_table = "function_group";
                $Params['display_name'] = $arrParam['display_name'];
                $Params['order'] = $arrParam['order'];
                $Params['class'] = $arrParam['class'];
                $Params['alias'] = $arrParam['alias'];
                $Params['is_display'] = $arrParam['is_display'];

                if (empty($Id) === FALSE) {
                    $rs = $this->m_backend->jqxUpdatemenugroup($Id, $Params);
                } else {
                    $rs = $this->m_backend->jqxInsert('function_group', $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['display_name'] = $this->form_validation->error('display_name', ' ', ' ');
                $response['message']['alias'] = $this->form_validation->error('alias', ' ', ' ');
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function update_news_category() {
        //-- Check user have permission to delete ------------------------------

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $this->m_backend->_table = "news_category";

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$this->input->get('field', TRUE)] = $st;
        $data = $this->m_backend->jqxu_update_news_category($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function delete_news_category() {
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $this->m_backend->_table = "news_category";
        $this->m_backend->_key = "id_category";
        $data = $this->m_backend->delete($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function changepass() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['message']['oldpass'] = '';
        $response['message']['password'] = '';
        $response['message']['repassword'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('oldpass', 'oldpass', 'trim|required|md5');
            $this->form_validation->set_rules('password', 'password', 'trim|required|matches[repassword]|md5');
            $this->form_validation->set_rules('repassword', 'repassword', 'trim|required|md5');
            if ($this->form_validation->run() == TRUE) {
                if (md5($arrParam['oldpass']) == $this->session->userdata['user_info']['password']) {
                    $Id = $this->session->userdata['user_info']['id_admin'];
                    $Params['password'] = md5($arrParam['password']);
                    $this->m_backend->_table = 'user';
                    $rs = $this->m_backend->jqxUpdateuser($Id, $Params);
                    $response['code'] = 0;
                } else {
                    $response['code'] = 1;
                    $response['message']['oldpass'] = 'Old pass is not correct';
                }
            } else {
                $response['code'] = 1;
                $response['message']['oldpass'] = $this->form_validation->error('oldpass', ' ', ' ');
                $response['message']['password'] = $this->form_validation->error('password', ' ', ' ');
                $response['message']['repassword'] = $this->form_validation->error('repassword', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addslide() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/home/index';
        $response['message']['image'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('image', 'Image', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];

                $Params['image'] = $arrParam['image'];
                $Params['name'] = $arrParam['name'];
                $Params['description'] = $arrParam['description'];

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    $this->m_backend->jqxUpdate('slide', 'id_slide', $Id, $Params);
                } else
                    $rs = $this->m_backend->jqxInsert('slide', $Params);

                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['image'] = $this->form_validation->error('image', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addproduct() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/product/index';
        $response['message']['name'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];

                $Params['image_small'] = $arrParam['image_small'];
//                $Params['image_big'] = $arrParam['image_big'];
                $Params['name'] = $arrParam['name'];
                $Params['description'] = $arrParam['description'];
                
                $this->m_backend->_table = 'group_product';
                $this->m_backend->_key = 'name';
                $game = $this->m_backend->get_by_id($this->security->xss_clean($arrParam['type_name']));
                $Params['id_group_product'] = $game['id_group_product'];
                
                if (empty($Id) === FALSE && is_numeric($Id)) {
                    $this->m_backend->jqxUpdate('product', 'id_product', $Id, $Params);
                } else
                    $rs = $this->m_backend->jqxInsert('product', $Params);

                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['image'] = $this->form_validation->error('image', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function contact_count() {
        $count = $this->m_backend->count_contact();
        $me = array(
            "code" => "error",
            "count" => 0,
        );
        if (!empty($count)) {
            $me = array(
                "code" => "ok",
                "count" => $count,
            );
        }
        exit(json_encode($me));
    }

}

?>