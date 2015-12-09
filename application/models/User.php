<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function fetch_a_user($array,$limit=1,$offset=0)
	{		
		return $this->db->get_where(USER_TABLE, $array , $limit, $offset)->result_array();		
	}
	
	public function updateUser($array,$col,$val){
		$this->db->where($col,$val);
		return $this->db->update(USER_TABLE,$array);
	}
	
}
