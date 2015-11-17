<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhaseSavingsNExtras extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function createSearch($data)
	{				
		$this->db->insert(PHASE_SAV_N_EXT_TABLE,$data);
		return $this->db->insert_id();
	}
	
	public function updateSearch($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(PHASE_SAV_N_EXT_TABLE, $data);
		return $id;
	}
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(PHASE_SAV_N_EXT_TABLE, $array , $limit, $offset)->result_array();		
	}	
	public function deleteRow($fid)
	{
		$this->db->where('full_pack_id',$fid);		
		return $this->db->delete(PHASE_SAV_N_EXT_TABLE);
	}
}
