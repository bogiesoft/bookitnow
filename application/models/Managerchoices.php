<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerChoices extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	public function createRecord($data)
	{
		//echo json_encode($data);exit;
		return $this->db->insert(MANAGERCHOICES,$data);
	}
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		
		return $this->db->get_where(MANAGERCHOICES, $array , $limit, $offset)->result_array();		
	}
	/*public function update_row($data,$id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->update(BULKBOOKING,$data);
	 }
	 
	 public function getAll()
	 {
	 	$query = $this->db->get(BULKBOOKING);
	 	return $query->result_array();
	 }*/
	 public function deleteRow($id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->delete(MANAGERCHOICES);
	 } 
}
