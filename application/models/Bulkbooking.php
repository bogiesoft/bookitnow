<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BulkBooking extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	public function createRecord($data)
	{
		return $this->db->insert(BULKBOOKING,$data);
	}
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(BULKBOOKING, $array , $limit, $offset)->result_array();		
	}
	public function update_row($data,$id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->update(BULKBOOKING,$data);
	 }
	 
	 public function getAll()
	 {
	 	$query = $this->db->get(BULKBOOKING);
	 	return $query->result_array();
	 }
	 /* public function deleteRow($id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->delete(LUGGAGE_TABLE);
	 } */
}
