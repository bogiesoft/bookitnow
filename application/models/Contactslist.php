<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactsList extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	public function createRecord($data)
	{
		return $this->db->insert(CONTACTSLIST,$data);
	}
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(CONTACTSLIST, $array , $limit, $offset)->result_array();		
	}
	public function update_row($data,$id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->update(CONTACTSLIST,$data);
	 }
	 
	 public function getAll()
	 {
	 	$query = $this->db->get(CONTACTSLIST);
	 	return $query->result_array();
	 }
	 /* public function deleteRow($id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->delete(LUGGAGE_TABLE);
	 } */
}
