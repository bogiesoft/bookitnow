<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SavingsNExtFields extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	/*public function createSearch($data)
	{				
		$this->db->insert(PHASE_SAV_N_EXT_TABLE,$data);
		return $this->db->insert_id();
	}
	
	public function updateSearch($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update(PHASE_SAV_N_EXT_TABLE, $data);
	}*/
	
	public function fetch_a_fields($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(SAV_N_EXT_TABLE, $array , $limit, $offset)->result_array();		
	}
	public function fetchFilelsByCond($data)
	{
		$this->db->select(SAV_N_EXT_TABLE.'.*');
		$this->db->from(SAV_N_EXT_TABLE);
		$this->db->join(EXTRA_CATEGORIES_TABLE, EXTRA_CATEGORIES_TABLE.'.name = '.SAV_N_EXT_TABLE.'.category');
		$this->db->where(EXTRA_CATEGORIES_TABLE.'.status',1);	
		$query = $this->db->get();
		return $query->result_array();		
	}
}
