<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @property Util $util 
 * @author phuongnt
 */
class MY_Input extends CI_Input {

    function __construct() {
        parent::__construct();        
    }

    function get_param($field_name, $default = NULL){
        $value = $this->get_post($field_name);
        
        return empty($value) ? $default : $value;
    }
}