<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrivals extends CI_Model {
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function fetch_a_row($array,$limit=1,$offset=0)
	{		
		return $this->db->get_where(ARRIVALS_TABLE, $array , $limit, $offset)->result_array();		
	}
	
	public function  fetch_all()
	{
		$query = $this->db->get(ARRIVALS_TABLE);
		return $query->result_array();
	}
	
	public function insert_record($data)
	{		
		$data = array( 
				'name_resort' => $data['name'],
	        	'cat_id' => $data['cat'],
				'map_root' => $data['val'],
				'arapts' => $data['arapts']
		);
		return $this->db->insert(ARRIVALS_TABLE,$data);
	}
	
	public function update_record($data)
	{
		$info = array(
	        'name_resort' => $data['name'],
	        'cat_id' => $data['cat'],
			'arapts' => $data['arapts']
		);		
		$this->db->where('map_root','"'.$data['val'].'"');
		return $this->db->update(ARRIVALS_TABLE, $info);
	}
	
	public function delete_record($id)
	{
		return $this->db->delete(ARRIVALS_TABLE, array('id' => $id));
	}
	
	public function fetchArrivalsByCategory()
	{
		$this->db->select('c.name,a.*');
		$this->db->from(ARRIVALS_TABLE.' as a');
		$this->db->join(CATEGORIES_TABLE. ' as c', 'c.id = a.cat_id AND c.status=1');
		$query = $this->db->get();
		return $query->result_array();
	}
}
