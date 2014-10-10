<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author phuongnt
 * @property CI_DB_active_record $db_master
 * @property CI_DB_active_record $db_slave
 */
class MY_Model extends CI_Model {

    var $_dbgroup = 'db';
    var $_table = '';
    var $_key = 'id';
    protected $db_master;
    protected $db_slave;


    function __construct() {
        parent::__construct();
        $this->db_master = $this->load->database($this->_dbgroup . '_master', TRUE);
        $this->db_slave = $this->load->database($this->_dbgroup . '_slave', TRUE);

    }


    function insert($data) {
        $this->db_master->insert($this->_table, $data);
        return $this->db_master->insert_id();

    }


    function update($id, $data) {
        $this->db_master->update($this->_table, $data, array($this->_key => $id));
        return $this->db_master->affected_rows();

    }


    function delete($id) {
        $this->db_master->delete($this->_table, array($this->_key => $id));
        return $this->db_master->affected_rows();

    }


    function get_by_id($id) {
        $sql = $this->db_slave->get_where($this->_table, array($this->_key => $id));
        return $sql->row_array();

    }


    function get_table($start = 0, $limit = 0) {
        $sql = $this->db_slave->get($this->_table);
        return $sql->result_array();

    }
    

}
