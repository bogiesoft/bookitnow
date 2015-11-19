<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingInfo extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	public function createRecord($data)
	{	
		
		if($this->db->insert(BOOKINFO_TABLE,$data))
		{
			//$ref_id = md5(microtime().'_'.$this->db->insert_id());
			$ref_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
			$data =array('reference_id'=>$ref_id);
			$this->db->where('id',$this->db->insert_id());
			if($this->db->update(BOOKINFO_TABLE,$data))
			{
				return true; 
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public function deleteRow($base_id)
	{
		$this->db->where('base_id',$base_id);
		return $this->db->delete(BOOKINFO_TABLE);
	}
	
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(BOOKINFO_TABLE, $array , $limit, $offset)->result_array();		
	}
	public function update_row($data,$id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->update(BOOKINFO_TABLE,$data);
	 }
	 
	
	 /* public function deleteRow($id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->delete(BOOKINFO_TABLE);
	 } */
}
