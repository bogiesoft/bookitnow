<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExtraCategories extends CI_Model {
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function fetch_a_category($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(EXTRA_CATEGORIES_TABLE, $array , $limit, $offset)->result_array();		
	}
	
	public function fetch_all()
	{
		$query = $this->db->get(EXTRA_CATEGORIES_TABLE);
		return $query->result_array();
	}
	public function updateRow($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update(EXTRA_CATEGORIES_TABLE, $data);
		return $id;
	}
	public function updateByCond($data,$status)
	{
		$this->db->where('status',$status);
		return $this->db->update(EXTRA_CATEGORIES_TABLE, $data);		
	}
}
