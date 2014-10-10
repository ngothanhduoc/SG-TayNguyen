<?php

//session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @property Util $util 
 * @property MY_Input $input 
 * 
 * @author phuongnt
 */
class MY_Controller extends CI_Controller {
    protected  $_user_info ;
     function __construct() {
        parent::__construct();

        $this->template->set_template('default');

        // load user menu
        //$user_info = $this->get_user();

        $data['menu_list'] = $this->load_menu();
        $this->template->write_view('breakcrumb', 'layouts/admincp/breakcrumb', array());
        $this->template->write_view('leftmenu', 'layouts/admincp/leftmenu', $data);
    }

    /**
     * Get logged in user
     */
    function get_user() {
        //$this->load->library('session');
        //$user_info = $this->session->userdata('user_info');
	$user_info = $this->session->userdata('user_info');

        $this->load->library('session');
        $this->_user_info = $user_info = $this->session->userdata('user_info');       
        //$user_info = $_SESSION['user_info'];
         
        if (!empty($user_info)) {
            return $user_info;
        }
        return FALSE;
    }

    /**
     * Check menu permission
     */
    function check_permission() {
        $controllerName = $this->router->fetch_class();
        $tmp = explode('_', $controllerName);

        $flag = FALSE;

        $user_info = $this->get_user();

        if (empty($user_info) === TRUE) {
            redirect(base_url() . 'logout');
        }

        $uri = uri_string();

        //Chap nhan link co param o sau
        $validate = preg_match('#^.*[0-9]{1,}#', $uri);
        if ($validate) {
            $arr = explode('/', $uri);
            $u = '';
            for ($i = 0; $i < count($arr) - 1; $i++) {
                if ($u == '') {
                    $u .= $arr[$i];
                } else {
                    $u .= '/' . $arr[$i];
                }
            }
            $uri = $u;
        }
        $uri = '/' . $uri;
        $menu_list = $this->load_menu();
            
        if (empty($menu_list)) {
            $flag = FALSE;
        } else {
            if ($tmp[0] == 'admin') {
                if ($uri == 'backend/welcome') {
                    $flag = TRUE;
                }
                if ($controllerName == 'admin_ajax') {
                    $flag = TRUE;
                }

                foreach ($menu_list as $items) {
                    if ($uri == $items['url']) {
                        $flag = TRUE;
                    }
                }
            } else {
                $flag = TRUE;
            }
        }

        if ($flag === FALSE) {
            redirect(base_url() . 'logout');
        }
    }

    /**
     * Load user menu
     */
    function load_menu() {
        //$this->load->library('session');
        //$menu_info = $this->session->userdata('menu');
        $menu_info = $_SESSION['user_menu'];

        if (!empty($menu_info)) {
            return $menu_info;
        }

        return FALSE;
    }

    /**
     * Check a request is post or else
     * @return boolean
     */
    function is_post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 
     */
    function load_breakcrumb() {
        $uri = uri_string();
        //Chap nhan link co param o sau
        $validate = preg_match('#^.*[0-9]{1,}#', $uri);
        if ($validate) {
            $arr = explode('/', $uri);
            $u = '';
            for ($i = 0; $i < count($arr) - 1; $i++) {
                if ($u == '') {
                    $u .= $arr[$i];
                } else {
                    $u .= '/' . $arr[$i];
                }
            }
            $uri = $u;
        }
        $menu_list = $this->load_menu();

        if ($uri == 'welcome') {
            return array('group_name' => 'welcome', 'item_name' => '');
        }

        foreach ($menu_list as $items) {
            foreach ($items as $item) {
                if ($uri == $item['relative_url']) {
                    return array('group_name' => $item['group'], 'item_name' => $item['display_name']);
                }
            }
        }
    }
    public function check_security($param){
        if(empty($param))
            return FALSE;
        $param = $this->security->xss_clean($param);
        return $param;
    }
}