<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FullSearch extends CI_Model {	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function createSearch($service_url,$type_serach,$raw_data)
	{	

		
		$data = array('service_url' => $service_url,
				'type_search' => $type_serach,
				'selected_date' => $raw_data['full_departure_date'],
				'date_of_search' => date('Y-m-d'),
				'search_position' => '',
				'map_root' => $raw_data['mapper'],
				'arapts' => $raw_data['full_arrival_airports'],
				'num_adults' => $raw_data['full_adults'],
				'num_children' => $raw_data['full_children']				
		);
		if(isset($raw_data['pax']))
		{
			$data['pax'] = $raw_data['pax'];
		}
		if($this->db->insert(FULL_PACK_TABLE,$data))
		{
			$hash = md5(microtime().'_'.$this->db->insert_id());
			$data =array('url_hash'=>$hash);
			$this->db->where('id',$this->db->insert_id());
			if($this->db->update(FULL_PACK_TABLE,$data))
			{
				return $hash; 
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
	
	public function fetch_a_search($array,$limit=1,$offset=0)
	{
		return $this->db->get_where(FULL_PACK_TABLE, $array , $limit, $offset)->result_array();		
	}
	 public function update_row($data,$id)
	 {
	 	$this->db->where('id',$id);
	 	return $this->db->update(FULL_PACK_TABLE,$data);
	 }
}
