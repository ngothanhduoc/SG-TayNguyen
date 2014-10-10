<?php
/**
 * Description of admin
 *
 * @author duocnt
 */
class rightmenu {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("frontend/m_news");
        $this->CI->load->model("frontend/m_game");
    }
    public function get_news_menu($num){
        $result = $this->CI->m_news->get_news_right_menu($num);
        if(!empty($result)){
            foreach ($result as $key => $value) {
                $result[$key]['create_time']  = date("d/m/Y", strtotime($value['create_time']));
            }
        }
        return $result;
    }
    public function top_game_hot($num){
        $result = $this->CI->m_game->get_top_game_hot($num);
        return $result;
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
