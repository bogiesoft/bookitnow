<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function createSearch($data)
	{				
		$this->db->insert(OPTIONS,$data);
		return $this->db->insert_id();
	}
	
	public function updateSearch($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update(OPTIONS, $data);
	}
	
	public function fetch_a_fields($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(OPTIONS, $array , $limit, $offset)->result_array();		
	}
	
}
