<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSearch extends CI_Model {
	
	
	public function __construct()
	{		
		parent::__construct();	
	}
	
	public function update_row($data,$id)
	{
		$this->db->where('id',$id);
		return $this->db->update(USER_SEARCH_TABLE,$data);
	}
	
	public function createSearch($data)
	{		
		/*$data = array('service_url' => $service_url,
				'type_search' => $type_serach,
				'selected_date' => $info['hotel_check_in_date'],
				'pax' => $info['pax'],
				'num_adults' => $info['hotel_adults'],
				'num_children' => $info['hotel_childrens']		
		);*/
		if($this->db->insert(USER_SEARCH_TABLE,$data))
		{
			$hash = md5(microtime().'_'.$this->db->insert_id());
			$data =array('url_hash'=>$hash);
			$this->db->where('id',$this->db->insert_id());
			if($this->db->update(USER_SEARCH_TABLE,$data))
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
		return $this->db->get_where(USER_SEARCH_TABLE, $array , $limit, $offset)->result_array();		
	}
	
}
