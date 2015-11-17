<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Model {
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function fetch_a_category($array,$limit=1,$offset=0)
	{		
		return $this->db->get_where(CATEGORIES_TABLE, $array , $limit, $offset)->result_array();		
	}
	
	public function fetch_all()
	{
		$query = $this->db->get(CATEGORIES_TABLE);
		return $query->result_array();
	}
	
}
