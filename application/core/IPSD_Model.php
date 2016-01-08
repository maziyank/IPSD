<?php 

if ( ! defined('BASEPATH')) 
	exit('No direct script access allowed'); 

class IPSD_Model extends CI_Model 
{ 
	public $table; 
	public function __construct() 
	{ 
		parent::__construct(); 
		$this->table = str_replace('M_','tbl_',get_Class($this)); 
		$this->load->database(); 
	}

	public function save($data,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 
		
		$op = 'update'; 
		$keyExists = FALSE; 
		$fields = $this->db->field_data($tablename); 

		foreach ($fields as $field) 
		{ 
			if($field->primary_key==1) 
			{ 
				$keyExists = TRUE;
				if(isset($data[$field->name])) 
				{ 
					$this->db->where($field->name, $data[$field->name]); 
				} 
				else 
				{ 
					$op = 'insert'; 
				} 
			} 
		} 
		if($keyExists && $op=='update') 
		{ 
			$this->db->set($data); 
			$this->db->update($tablename); 
			if($this->db->affected_rows()==1) 
			{ 
				return $this->db->affected_rows(); 
			} 
		} 
		$this->db->insert($tablename,$data); 
		return $this->db->affected_rows(); 
	} 

	function search($select="*",$conditions=NULL,$tablename="",$order='',$order_mode='ASC',$limit=1000,$offset=0) 
	{     
	// 
		$this->db->select($select);

		if($tablename=="") 
			$tablename = $this->table; 

		if($conditions != NULL) 
			$this->db->where($conditions); 

		if($order != NULL) 
			$this->db->order_by($order,$order_mode); 

		$query = $this->db->get($tablename,$limit,$offset); 
		return $query->result(); 
	} 

	function search2($select="*",$conditions=NULL,$tablename="",$order='',$order_mode='ASC',$limit=1000,$offset=0) 
	{     
	// 
		$this->db->select($select);

		if($tablename=="") 
			$tablename = $this->table; 

		if($conditions != NULL) 
			$this->db->where($conditions); 

		if($order != NULL) 
			$this->db->order_by($order,$order_mode); 

		$query = $this->db->get($tablename,$limit,$offset); 
		return $query->result_array(); 
	} 

	
	function get_data($select,$conditions=NULL,$tablename="") 
	{     
		if($tablename=="") 
			$tablename = $this->table; 

		if($conditions != NULL) 
			$this->db->where($conditions); 

		$this->db->select($select);
		$query = $this->db->get($tablename); 
		return $query->row(); 
	} 

	function get_field_data($select,$conditions=NULL,$tablename="") 
	{     
		if($tablename=="") 
			$tablename = $this->table; 

		if($conditions != NULL) 
			$this->db->where($conditions); 

		$this->db->select($select);
		$query = $this->db->get($tablename); 
		return $query->row()->$select; 
	} 

	function count($conditions=NULL,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 

		$this->db->select('COUNT(*) as c');
		$this->db->where($conditions); 
		$this->db->get($tablename); 
		return $query->row()->t; 
	} 

	function insert($data,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 

		$this->db->insert($tablename,$data); 
		return $this->db->affected_rows(); 
	} 

	function update($data,$conditions,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 

		$this->db->where($conditions); 
		$this->db->update($tablename,$data); 
		return $this->db->affected_rows(); 
	} 

	function delete($conditions,$field,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 

		$this->db->set($field,1); 
		$this->db->where($conditions); 
		$this->db->update($tablename); 
		return $this->db->affected_rows(); 
	} 


	function delete_permanent($conditions,$tablename="") 
	{ 
		if($tablename=="") 
			$tablename = $this->table; 

		$this->db->where($conditions); 
		$this->db->delete($tablename); 
		return $this->db->affected_rows(); 
	}

}

?>