<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PhaseFlightOrHotel extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function createSearch($json_data,$type,$fpid,$dt)
	{		
		$data = array('full_pack_id' => $fpid,
				'type_search' => $type,
				'pack_info' => $json_data,
				'flight_selected_date' => $dt
		);
		return $this->db->insert(PHASE_FLT_HOT_TABLE,$data);
	}
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(PHASE_FLT_HOT_TABLE, $array , $limit, $offset)->result_array();		
	}
	public function updateSearch($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(PHASE_FLT_HOT_TABLE, $data);
		return $id;
	}
	public function deleteRow($fid,$type)
	{
		$this->db->where('full_pack_id',$fid);
		$this->db->where('type_search',$type);
		return $this->db->delete(PHASE_FLT_HOT_TABLE);
	}
	
}
