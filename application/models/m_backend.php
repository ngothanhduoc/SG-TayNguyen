<?php

/**
 * Description of admin
 *
 * @author tailm
 */
class M_backend extends MY_Model {

    var $_dbgroup = 'db';
    var $_table = 'game';
	
    private $configs;
    public $datatables_config;
	
	protected $_total;
    
	public function __construct() {
        parent::__construct();
		
	$this->configs["strWhere"] = "WHERE TRUE";
        $this->configs["strGroupBy"] = "";
        $this->configs["strOrderBy"] = "";
        $this->configs["usingLimit"] = true;
        $this->configs["filterfields"] = array();
        $this->configs["fields"] = array();
        $this->configs["datefields"] = array();
    }
	public function config($params) {
        $this->datatables_config = array(
            "table" => $params['table'],
            "where" => "WHERE {$params['where']}",
            "limit" => isset($params['limit']) ? $params['limit'] : true,
        );
            
        return $this;
    }
    function jqxInsert($table,$param){
       $this->db_slave->insert($table,$param);
    }
    function jqxInsertId($table,$param){
        $this->db_slave->insert($table,$param);
        $id = $this->db_slave->insert_id();
        return $id;
    }
    function jqxUpdate($table,$field_id,$id,$param){
        $this->db_slave->where($field_id,$id);
	$rs = $this->db_slave->update($table,$param);
        return $rs;
    }
    function jqxDelete($table,$field_id,$id){
        $this->db_slave->where($field_id,$id);
	$rs = $this->db_slave->delete($table);
        return $rs;
    }
    
    function jqxGetId($table, $field, $id){
        $sql = $this->db_slave->select()
			      ->from($table)
                              ->where($field,$id)
			      ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }
    
    function jqxGet($table, $field, $id){
        $this->db_slave->select()
			      ->from($table)
                              ->where($field,$id)
			      ->limit(1)
			      ;
        $sql = $this->db_slave->get(); 
        if (is_object($sql)) {
            return $sql->row_array();
        }
    }
    function jqxGets($table){
        $sql = $this->db_slave->select()
                    ->from($table)
                    ->get();
         if (is_object($sql)) {
            return $sql->result_array();
        }     
	
    }
    function count_contact() {
        $this->_table = "contact";
        $query = $this->db_slave->where('status', "on")->get($this->_table)->num_rows();
        return $query;
    }
    function jqxGetgame($id) {
        $query = $this->db_slave->where('id_game', $id)->get($this->_table)->row_array();
        return $query;
    }
    function jqxGetgamename($name) {
        $query = $this->db_slave->where('full_name', $name)->get($this->_table)->row_array();
        return $query;
    }
    function jqxGetnews($id) {
        $query = $this->db_slave->where('id_news', $id)->get($this->_table)->row_array();
        return $query;
    }
    function jqxGetcategory($id) {
        $query = $this->db_slave->where('id_category', $id)->get($this->_table)->row_array();
        return $query;
    }function jqxGetcatname($name) {
        $query = $this->db_slave->where('title', $name)->get($this->_table)->row_array();
        return $query;
    }
    function jqxDeletenews($id){
        $count = $this->db_slave->where('id_news', $id)->delete($this->_table);
        if ($count == 1)
            return true;
        return false;
    }
    function jqxUpdatenews($id, $params){
        $count = $this->db_slave->where('id_news',$id)->update($this->_table,$params);
        if ($count >= 0)
            return true;
        return false;
    }
    function jqxGetmenugroup($id){
        $query = $this->db_slave->where('id', $id)->get($this->_table)->row_array();
        return $query;
    }
    function jqxUpdatemenugroup($id, $params){
        $count = $this->db_slave->where('id',$id)->update($this->_table,$params);
        if ($count >= 0)
            return true;
        return false;
    }
    function jqxDeletemenugroup($id){
        $count = $this->db_slave->where('id', $id)->delete($this->_table);
        if ($count == 1)
            return true;
        return false;
    }
    function jqxUpdateuser($id, $params){
        $count = $this->db_slave->where('id_admin',$id)->update($this->_table,$params);
        if ($count >= 0)
            return true;
        return false;
    }
    function jqxBinding() {
        $method = $this->security->xss_clean($_REQUEST);
        $pagenum = isset($method['pagenum']) ? $method['pagenum'] : 0;
        $pagesize = isset($method['pagesize']) ? $method['pagesize'] : 10;
        $start = $pagenum * $pagesize;
        if (!empty($this->datatables_config)) {
            if (!empty($this->datatables_config["select"])) {
                $FstrSQL = $select = (!empty($this->datatables_config["select"]) ? $this->datatables_config["select"] : "")
                        . " " .
                        (!empty($this->datatables_config["from"]) ? $this->datatables_config["from"] : "");
            } else {
                $FstrSQL = "SELECT SQL_CALC_FOUND_ROWS `{$this->datatables_config["table"]}`.* FROM `{$this->datatables_config["table"]}`";
            }
            $where = (!empty($this->datatables_config["where"]) ? $this->datatables_config["where"] : "Where true");
            $strgroupby = (!empty($this->datatables_config["group_by"]) ? $this->datatables_config["group_by"] : "");
            $orderby = (!empty($this->datatables_config["order_by"]) ? $this->datatables_config["order_by"] : "");
            $fields = (!empty($this->datatables_config["columnmaps"]) ? $this->datatables_config["columnmaps"] : array());
            $datefields = (!empty($this->datatables_config["datefields"]) ? $this->datatables_config["datefields"] : array());
            $limit = "";
            if (isset($this->datatables_config["limit"]) && $this->datatables_config["limit"]) {
                $limit = "LIMIT $start, $pagesize";
            } else {
                if ($pagesize == 10)
                    $pagesize = 1000;
                $limit = "LIMIT $start, $pagesize";
            }
        }else {
            $FstrSQL = $this->configs["strQuery"];
            $select = $this->configs["strQuery"];
            $where = $this->configs["strWhere"];
            $strgroupby = $this->configs["strGroupBy"];
            $orderby = $this->configs["strOrderBy"];
            $fields = $this->configs["fields"];
            $datefields = $this->configs["datefields"];
            $limit = "";
            if (isset($this->configs["usingLimit"]) && $this->configs["usingLimit"]) {
                $limit = "LIMIT $start, $pagesize";
            } else {
                $limit = "LIMIT 1000";
            }
        }



        if (isset($method['filterscount'])) {
            $filterscount = $method['filterscount'];

            if ($filterscount > 0) {
                $where.= " AND (";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for ($i = 0; $i < $filterscount; $i++) {
                    // get the filter's value.
                    $filtervalue = $method["filtervalue" . $i];
                    // get the filter's condition.
                    $filtercondition = $method["filtercondition" . $i];
                    // get the filter's column.
                    $filterdatafield = $method["filterdatafield" . $i];
                    // get the filter's operator.
                    $filteroperator = $method["filteroperator" . $i];

                    if ($filterdatafield[0] === "_" && $filterdatafield[strlen($filterdatafield) - 1] === "_") {
                        $filterdatafield = substr($filterdatafield, 1, -1);
                    }


                    if (count($datefields) > 0 && in_array($filterdatafield, $datefields)) {
                        $tmp = explode("GMT", $filtervalue);
                        if (isset($tmp[0])) {
                            $filtervalue = date("Y-m-d H:i:s", strtotime($tmp[0]));
                        }
                    }
                    //$filtervalue = $this->db->escape_str($filtervalue);
                    if (count($fields) > 0 && isset($fields[$filterdatafield])) {
                        $filterdatafield = $fields[$filterdatafield];
                    } else {
                        $filterdatafield = "`$filterdatafield`";
                    }

                    //check filterdatafield
                    if ($tmpdatafield == "") {
                        $tmpdatafield = $filterdatafield;
                    } else if ($tmpdatafield <> $filterdatafield) {
                        $where .= " ) AND ( ";
                    } else if ($tmpdatafield == $filterdatafield) {
                        if ($tmpfilteroperator == 0) {
                            $where .= " AND ";
                        }
                        else
                            $where .= " OR ";
                    }

                    // build the "WHERE" clause depending on the filter's condition, value and datafield.
                    // possible conditions for string filter: 
                    //      'EMPTY', 'NOT_EMPTY', 'CONTAINS', 'CONTAINS_CASE_SENSITIVE',
                    //      'DOES_NOT_CONTAIN', 'DOES_NOT_CONTAIN_CASE_SENSITIVE', 
                    //      'STARTS_WITH', 'STARTS_WITH_CASE_SENSITIVE',
                    //      'ENDS_WITH', 'ENDS_WITH_CASE_SENSITIVE', 'EQUAL', 
                    //      'EQUAL_CASE_SENSITIVE', 'NULL', 'NOT_NULL'
                    // 
                    // possible conditions for numeric filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN',
                    //  'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 
                    //  'NULL', 'NOT_NULL'
                    //  
                    // possible conditions for date filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN', 
                    // 'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 'NULL', 
                    // 'NOT_NULL'                         

                    switch ($filtercondition) {
                        case "NULL":
                            $where .= " ($filterdatafield is null)";
                            break;
                        case "EMPTY":
                            $where .= " ($filterdatafield is null) or ($filterdatafield='')";
                            break;
                        case "NOT_NULL":
                            $where .= " ($filterdatafield is not null)";
                            break;
                        case "NOT_EMPTY":
                            $where .= " ($filterdatafield is not null) and ($filterdatafield <>'')";
                            break;
                        case "CONTAINS_CASE_SENSITIVE":
                        case "CONTAINS":
                            $where .= " $filterdatafield LIKE '%$filtervalue%'";
                            break;
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                        case "DOES_NOT_CONTAIN":
                            $where .= " $filterdatafield NOT LIKE '%$filtervalue%'";
                            break;
                        case "EQUAL_CASE_SENSITIVE":
                        case "EQUAL":
                            $where .= " $filterdatafield = '$filtervalue'";
                            break;
                        case "NOT_EQUAL":
                            $where .= " $filterdatafield <> '$filtervalue'";
                            break;
                        case "GREATER_THAN":
                            $where .= " $filterdatafield > '$filtervalue'";
                            break;
                        case "LESS_THAN":
                            $where .= " $filterdatafield < '$filtervalue'";
                            break;
                        case "GREATER_THAN_OR_EQUAL":
                            $where .= " $filterdatafield >= '$filtervalue'";
                            break;
                        case "LESS_THAN_OR_EQUAL":
                            $where .= " $filterdatafield <= '$filtervalue'";
                            break;
                        case "STARTS_WITH_CASE_SENSITIVE":
                        case "STARTS_WITH":
                            $where .= " $filterdatafield LIKE '$filtervalue%'";
                            break;
                        case "ENDS_WITH_CASE_SENSITIVE":
                        case "ENDS_WITH":
                            $where .= " $filterdatafield LIKE '%$filtervalue'";
                            break;
                        default:
                            $where .= " $filterdatafield LIKE '%$filtervalue%'";
                    }

                    if ($i == $filterscount - 1) {
                        $where .= ")";
                    }

                    $tmpfilteroperator = $filteroperator;
                    $tmpdatafield = $filterdatafield;
                }
                // build the query.
            }
        }

        if (isset($method['sortdatafield'])) {
            $sortfield = $method['sortdatafield'];
            //fix sortfield
            if ($sortfield[0] === "_" && $sortfield[strlen($sortfield) - 1] === "_") {
                $sortfield = substr($sortfield, 1, -1);
            }

            if (count($fields) > 0 && isset($fields[$sortfield])) {
                $sortfield = $fields[$sortfield];
            } else {
                $sortfield = "`$sortfield`";
            }
            $sortorder = $method['sortorder'];
            if ($sortorder == "desc") {
                $SQLquery = "$FstrSQL $where $strgroupby ORDER BY $sortfield DESC $limit";
            } elseif ($sortorder == "asc") {
                $SQLquery = "$FstrSQL $where $strgroupby ORDER BY $sortfield ASC $limit";
            } else {
                $SQLquery = "$FstrSQL $where $strgroupby $orderby $limit";
            }
        } else {
            $SQLquery = "$FstrSQL $where $strgroupby $orderby $limit";
        }
        $_SESSION["debug"]["SQLquery"] = $SQLquery;     
        //$result['sQuery'] = $SQLquery;
                
	$query = $this->db_slave->query($SQLquery);
        
        
        
        if(is_object($query)){       
			$sql = "SELECT FOUND_ROWS() AS `found_rows`;";
					
			$resultTotal = $this->db_slave->query($sql);
			
			$rows = $resultTotal->result();
				
			$total_rows = (int) $rows[0]->found_rows;
			
			$result['rows'] = $query->result_array();
                       	$result['totalrecords'] = $total_rows;
			$result['pagenum'] = (int) $pagenum;
			$result['pagesize'] = (int) $pagesize;
			$result['totalpages'] = ceil($result['totalrecords'] / $result['pagesize']);
			return $result;			
		}
    }
//<<<<<<< HEAD
    function get_groupmenu(){
         $sql = $this->db_slave->select('g.id, g.display_name')
			       ->from('function_group g')
                               ->where('is_display',1)
			       ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }        
    }
    function get_menu($groupId){
        $sql = $this->db_slave->select('f.id_function, f.name_display')
			       ->from('function f')
                               ->where('f.parent_id', $groupId)
			       ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }        
        
    }
    function get_adminmenu($id_admin){
        $sql = $this->db_slave->select('h.id_function')
	    	              ->from('user_has_function h')
                              ->where('h.id_admin', $id_admin)
			      ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }        
	
    }
    
    //Duocnt
    function jqxu_update_news_category($id, $params){
        $count = $this->db_slave->where('id_category',$id)->update($this->_table,$params);
        if ($count >= 0)
            return true;
        return false;
    }
    function update_data($table, $data, $where){
         $this->db_slave->update($table, $data, $where);
    }
}