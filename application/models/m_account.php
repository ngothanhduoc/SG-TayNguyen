<?php

/**
 * Description of admin
 *
 * @author tailm
 */
class M_account extends MY_Model {

    
    var $_dbgroup = 'db';
    var $_table = 'user';
    
    protected $_total;
	
    public function __construct() {
        parent::__construct();
		
    }
    public function get_by_username($username){
        $sql = $this->db_slave->select('u.*')
			      ->from('user u')
                              ->where('username',$username)
			      ->limit(1)
			      ->get();
        if (is_object($sql)) {
            return $sql->row_array();
        }
	        
    }
    public function get_menu_by_userid($id=0){
        $sql = $this->db_slave->select('m.name_display,m.url,mg.display_name as group_name,mg.class,m.alias as als,mg.alias')
                ->from('function m')
                ->join('function_group mg', 'm.parent_id = mg.id')
                ->join('user_has_function ahm', 'ahm.id_function = m.id_function')
                ->where('ahm.id_admin', $id)
                ->where('m.is_leaf', 1)
		->where('mg.is_display', 1)
                ->order_by('m.order')
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }
    
	public function get_accounts(){
		$sql = $this->db_slave->select('a.*')
							  ->from('user a')
							  //->order_by('order','asc')
							  //->limit(4)
							  ->get();
		return $sql->result_array();
	}
	public function get_menu($groupId){
		$sql = $this->db_slave->select('m.id, m.display_name')
							  ->from('menu m')
							  ->where('menu_group_id',$groupId)
							  ->get();
		return $sql->result_array();
	}
	public function get_groupmenu(){
		$sql = $this->db_slave->select('m.id, m.display_name')
							  ->from('menu_group m')
							  ->get();
		return $sql->result_array();
	}
	public function get_adminmenu($id){
		$sql = $this->db_slave->select('m.menu_id')
							  ->from('admin_has_menu m')
							  ->where('admin_id',$id)
							  ->get();
		return $sql->result_array();
	}
	public function get_admin($id){
		$sql = $this->db_slave->select('a.username, a.fullname')
							  ->from('admin a')
							  ->where('id',$id)
							  ->get();
		return $sql->row_array();
	}
	public function saveItem(){
		$arrParam = $this->input->post();
		$arrAc = array();
		
		if(isset($arrParam['adminid'])){
			if($arrParam['password'] != ''){
				$arrAc['username'] = trim($arrParam['username']);
				$arrAc['fullname'] = trim($arrParam['fullname']);
				$arrAc['password'] = md5(trim($arrParam['password']));
				$arrAc['partner_id'] = 1;
				$arrAc['partner_name'] = 'ME';
			}else{
				$arrAc['username'] = trim($arrParam['username']);
				$arrAc['fullname'] = trim($arrParam['fullname']);
				$arrAc['partner_id'] = 1;
				$arrAc['partner_name'] = 'ME';
			}
			$this->db_slave->where('id',$arrParam['adminid']);
			$this->db_slave->update('admin',$arrAc);
			//delete admin_has_menu and reupdate
			$this->db_slave->delete('admin_has_menu', array('admin_id' => $arrParam['adminid']));
			foreach($arrParam['mid'] as $val){
				$arr = array();
				$arr['admin_id'] = $arrParam['adminid'];
				$arr['menu_id'] = $val;
				$this->db_slave->insert('admin_has_menu',$arr);
			}
		}else{
			$arrAc['username'] = trim($arrParam['username']);
			$arrAc['fullname'] = trim($arrParam['fullname']);
			$arrAc['password'] = md5(trim($arrParam['password']));
			$arrAc['partner_id'] = 1;
			$arrAc['partner_name'] = 'ME';
			$this->db_slave->insert('admin',$arrAc);
			$id = $this->db_slave->insert_id();
			foreach($arrParam['mid'] as $val){
				$arr = array();
				$arr['admin_id'] = $id;
				$arr['menu_id'] = $val;
				$this->db_slave->insert('admin_has_menu',$arr);
			}
		}
		
	}
	public function status(){
		$id = $_GET['id'];
		$st = $_GET['st'];
		if($st == 0){
			$status = 1;
		}else{
			$status = 0;
		}
		$strQuery="UPDATE admin SET status = '".$status."' WHERE id = '".$id."'";
		$this->db_slave->query($strQuery);
	}
        
}