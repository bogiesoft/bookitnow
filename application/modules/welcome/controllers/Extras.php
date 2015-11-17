<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extras extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('Layouts');
		$this->layouts->add_include($this->config->item('header_css'));
		$this->layouts->add_include($this->config->item('header_js'));
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->helper(array('url','common','form'));
		$this->load->model('UserSearch');		
	}
	
	
	
	
	public function index()
	{
		
		$data = array();
		$data['controller'] = $this;
		$this->load->model('FullSearch');
		$data['seg'] = $this->FullSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)));
		if(!empty($data['seg']))
		{
			$this->load->model('PhaseFlightOrHotel');
			$this->load->model('AlLugagePrice');
			$this->load->model('SavingsNExtFields');
			
			$data['flit'] = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$data['seg'][0]['id']));
			$data['hotel'] = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'pack_hotel','full_pack_id'=>$data['seg'][0]['id']));
			
			if(empty($data['flit']) || empty($data['hotel']))
			{
				redirect(base_url());
			}
			
			$data['fobj'] = json_decode($data['flit'][0]['pack_info'],true);	
			$data['lug_row'] = $this->AlLugagePrice->fetch_a_search(array('airline_code'=>$data['fobj']['@attributes']['suppcode']));
			$data['hobjs'] = json_decode($data['hotel'][0]['pack_info'],true);
			
			if(empty($data['fobj']) || empty($data['hobjs'])){
				redirect(base_url());
			}
			
			
			$data['departures'] = ( !$this->cache->get('departures')) ? (($this->cache->save('departures', $this->fetch_departures(), 3600)) ? $this->cache->get('departures') : array() ) : $this->cache->get('departures');
			$data['arrivals'] = ( !$this->cache->get('arrivals')) ? (($this->cache->save('arrivals', $this->fetch_arrivals(), 3600)) ? $this->cache->get('arrivals') : array() ) : $this->cache->get('arrivals');
			//Future  - Region should be dynamic
			//$data['ext_fields'] = $this->SavingsNExtFields->fetch_a_fields(array('region'=>0),'ALL');
			$data['ext_fields'] = $this->SavingsNExtFields->fetchFilelsByCond(array('region'=>0));
			$arr1 = array();
 			foreach ($data['ext_fields'] as $ext_fields)
 			{
 				$arr1[$ext_fields['category']][] = $ext_fields;
 			}
 			$data['ext_fields'] = $arr1;
 			
			//$data['res_sel_price'] = $tot_sel / count($data['hobjs']);
			
			/*
			 * Selection block
			 */
			
			$data['sel_info'] = $this->selctionBlock_fun($this->uri->segment(2));
			
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/customeffects.css','css/jquery.fancybox.css','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/script-hotels.js'));
			$this->layouts->set_title('Extras');
			$this->layouts->view('extras_view',$data);
		}
		else
		{
			redirect(base_url());
		}		
	}
	
	function  update_lug_fun()
	{
		if($this->input->post())
		{
			$result = array();
			$this->load->model('FullSearch');
			$this->load->model('PhaseFlightOrHotel');			
			$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')));
			$this->load->model('PhaseSavingsNExtras');
			$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('full_pack_id' => $rows[0]['id']));
			if(empty($ext_row))
			{
				$info  = array('full_pack_id' => $rows[0]['id'],
						'bags_count' => $this->input->post('lug')
				);
				if($rid = $this->PhaseSavingsNExtras->createSearch($info))
				{
					$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('id' => $rid));
				}
			}
			else
			{
				$info  = array('bags_count' => $this->input->post('lug'));
				if($this->PhaseSavingsNExtras->updateSearch($info,$ext_row[0]['id']))
				{
					$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('id' => $ext_row[0]['id']));
				}
			}		
			$final = $this->selctionBlock_fun($this->input->post('crypt'));
			
			echo json_encode($final);exit;
		}
	}
	public function cvtDt($date)
	{
		return strtotime(str_replace('/','-',$date));
	}
	
	public function saveForLater_fun()
	{
		if($this->input->post())
		{			
			/*if($this->input->post('subscribe'))
			{
				$this->load->model('SubscribersList');
				$info = array('fname' => $this->input->post('fname'),
						'lname' => $this->input->post('lname'),
						'email' => $this->input->post('email')
				);			
				$this->SubscribersList->createRecord($info);
			}*/
			
			//echo '<pre>';print_r($this->input->post());exit;
		}
		
		
		
		
		
	}
	
	function selctionBlock_fun($seg)
	{
		$this->load->model('FullSearch');
		$this->load->model('PhaseFlightOrHotel');
		$this->load->model('SavingsNExtFields');
		$this->load->model('PhaseSavingsNExtras');
		$rows = $this->FullSearch->fetch_a_search(array('url_hash' => trim($seg)));
		/*************/
		$flits = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
		$hotels = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'pack_hotel','full_pack_id'=>$rows[0]['id']));
			
		
		$fobj = json_decode($flits[0]['pack_info'],true);
		$hobjs = json_decode($hotels[0]['pack_info'],true);
		
		$tot_sel = 0;$tco = 0;
		
		if($rows[0]['pax'] != '')
		{
			$ser_arr = explode(',',$rows[0]['pax']);		
			foreach ($ser_arr as $key => $ser)
			{
				$ser_arr_sub = explode('-',$ser);				
				$tot_sel += $hobjs[$key]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
			}			
		}
		else
		{			
			$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_adults'] + $rows[0]['num_children']);
		}
		
		//$tot_sel += ($rows[0]['num_adults'] + $rows[0]['num_children']) * ($tco / count($hobjs));
		
		$tot_sel += ($rows[0]['num_adults'] + $rows[0]['num_children']) * $fobj['@attributes']['sellpricepp'];
			
		/***********/
		
		$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('full_pack_id' => $rows[0]['id']));
		$total = 0;
		$final = array();
		$final['sel_block']['segment'] = '';
		
		if(empty($ext_row))
		{
			$final['bags'] = 0;
			$final['total'] = $total;	
			$tot_sel += ($rows[0]['num_adults'] + $rows[0]['num_children']) * (2.50);			
			$final['whole'] = $tot_sel;
			$final['persons'] = ($rows[0]['num_adults'] + $rows[0]['num_children']);
		}
		else
		{
			if($ext_row[0]['pack_info'] != '')
			{
				$pack_raw = json_decode($ext_row[0]['pack_info'],true);
					
				foreach ($pack_raw as $key => $each)
				{
					$field_pack = $this->SavingsNExtFields->fetch_a_fields(array('id'=>$key));
					$final['sel_block']['segment'] .= '<div>
                                    <small>
                                        <strong>
                                            <span>'.$field_pack[0]['short_desc'].'</span></strong>
                                        <div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
                                            <div class="left">
                                                <span>'.$each / $field_pack[0]['price'].'</span>
                                                x &#163;<span id="cphContent_lblPPerPrice">'.$field_pack[0]['price'].'</span>
                                            </div>
                                            <div class="right" style="text-align: right;">
                                                <a onclick=blockAddingExtraPopup('.$key.',"'.$seg.'") title="Remove Parking" class="small right">Remove</a>
                                            </div>
                                        </div>
                                    </small>
                                </div>';
					$total += $each;
				}
			}
			
			
			$this->load->model('AlLugagePrice');
			$flit = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
				
				
			$fobj = json_decode($flit[0]['pack_info'],true);
			$lug_row = $this->AlLugagePrice->fetch_a_search(array('airline_code'=>$fobj['@attributes']['suppcode']));
				
			//$final['lug'] = $lug_row[0]['price'] * (int)$ext_row[0]['bags_count'];
				//echo $lug_row[0]['price'];exit;
			if(@$ext_row[0]['bags_count'])
			{
				$final['sel_block']['segment'] .= '<div id="BaggageRightSide">
					<small>
					<strong>Hold Luggage:
					<span id="cphContent_lblBaggageWeight">'.$ext_row[0]['bags_count'].' x 20kg</span></strong>
					<div class="right" style="text-align: right;">
					<a onclick=rmBagg('.$ext_row[0]['id'].',"'.$seg.'")  title="Remove Baggage" class="small right" >Remove</a>
					</div>
					</div>
					</small>
				</div>';
			}
				
			$total += ($ext_row[0]['bags_count'] * (int)@$lug_row[0]['price']);
			
			$final['bags'] = $ext_row[0]['bags_count'];
			$final['total'] = $total;
			$tot_sel += ($rows[0]['num_adults'] + $rows[0]['num_children']) * (2.50);
			$tot_sel += $total;
			$final['whole'] = $tot_sel;	
			$final['persons'] = ($rows[0]['num_adults'] + $rows[0]['num_children']);
		}
		return $final;
	}
	function remove_extras_fun()
	{
		$this->load->model('FullSearch');
		if($this->input->post())
		{
			$rows = $this->FullSearch->fetch_a_search(array('url_hash' => trim($this->input->post('crypt'))));
			$this->load->model('PhaseSavingsNExtras');
			$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('full_pack_id' => $rows[0]['id']));
			$pinfo = array();
			if($this->input->post('field_num') != '')
			{
				$pack_raw = json_decode($ext_row[0]['pack_info'],true);
				foreach ($pack_raw as $key => $each)
				{
					if((int)$key != (int)$this->input->post('field_num'))
					{
						$pinfo[$key] = $each;
					}
				}
				$info['pack_info']  =  json_encode($pinfo);				
			}
			else if($this->input->post('lug') != '')
			{
				$info['bags_count']  =  0;
			}
			if($this->PhaseSavingsNExtras->updateSearch($info,$ext_row[0]['id']))
			{
				$final = $this->selctionBlock_fun(trim($this->input->post('crypt')));					
				echo json_encode($final);exit;
			}
		}
	}
	function update_extras_fun()
	{
		if($this->input->post())
		{			
			$result = array();
			$this->load->model('FullSearch');
			$this->load->model('PhaseFlightOrHotel');
			$this->load->model('SavingsNExtFields');			
			$rows = $this->FullSearch->fetch_a_search(array('url_hash' => trim($this->input->post('crypt'))));
			$this->load->model('PhaseSavingsNExtras');
			$ext_row = $this->PhaseSavingsNExtras->fetch_a_search(array('full_pack_id' => $rows[0]['id']));
			$field_rows = $this->SavingsNExtFields->fetch_a_fields(array('id'=>$this->input->post('id')));
			$pinfo = array();
			$total = 0;
			if($field_rows[0]['pp'])
			{
				$p = ($rows[0]['num_adults'] + $rows[0]['num_children']) * $field_rows[0]['price'];
			}
			else
			{
				$p = (int)$this->input->post('dp') * $field_rows[0]['price'];	
			}
			$pinfo[$this->input->post('id')] = $p;
			if(empty($ext_row))
			{				
				$info  = array('full_pack_id' => $rows[0]['id'],
						'pack_info' => json_encode($pinfo)
				);
				$rid = $this->PhaseSavingsNExtras->createSearch($info);	
			}
			else
			{				
				if($ext_row[0]['pack_info'] != '')
				{					
					$pack_raw = json_decode($ext_row[0]['pack_info'],true);
					
					foreach ($pack_raw as $key => $each)
					{
						if((int)$key != (int)$this->input->post('id'))
						{
							$pinfo[$key] = $each;
						}						
					}				
				}
				$info['pack_info']  =  json_encode($pinfo);				
				$rid = $this->PhaseSavingsNExtras->updateSearch($info,$ext_row[0]['id']);
			}
			$final = $this->selctionBlock_fun(trim($this->input->post('crypt')));
			
			echo json_encode($final);exit;
		}
	}
	
	
	//Future : if not delete
	public function download_page($path){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$path);
		curl_setopt($ch, CURLOPT_FAILONERROR,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$retValue = curl_exec($ch);
		curl_close($ch);
		if($retValue == false)
		{
			echo '<p>Sorry. This service is currently unavailable. Please try again later.</p>';exit;
		}
	
		return $retValue;
	}
	public function fetch_departures()
	{
		$depts_raw = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
		$departures = array();
		foreach ($depts_raw as $departure)
		{
			$code = (array)$departure->attributes()->code;
			$name = (array)$departure->attributes()->name;
			$departures[$code[0]] = $name[0];
		}
		return $departures;
	}
	
	public function fetch_arrivals()
	{
		$arrivals = array();
		$results['arrivals'] = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=2&compid=1'));
		foreach ($results['arrivals'] as $arrival)
		{
			$code = (array)$arrival->attributes()->code;
			$name = (array)$arrival->attributes()->name;
			$arrivals[$code[0]] = $name[0];
		}
		return $arrivals;
	}
	
	public function book_hotel()
	{
		$data = array();
		$tot_sel = 0;
		$data['controller'] = $this;
		if(!empty($row = $this->UserSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)))))
		{			
			$data['seg'] = $row;
			$data['hobjs'] = json_decode($row[0]['pack_info'],true);
			foreach ($data['hobjs'] as $hobj)
			{
				$tot_sel += $hobj['@attributes']['sellpricepp'];
			}
			$data['res_sel_price'] = $tot_sel / count($data['hobjs']);	
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script-hotels.js'));
			$this->layouts->set_title('Book Hotel');
			$this->layouts->view('book_hotel_view',$data);
		}
		else{
			redirect(base_url());
		}
	}
	
	public function book()
	{	
		$data = array();
		$data['controller'] = $this;
		$this->load->model('FullSearch');
		$data['seg'] = $this->FullSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)));
		if(!empty($data['seg']))
		{
			$this->load->model('PhaseFlightOrHotel');
			$this->load->model('AlLugagePrice');
			$this->load->model('SavingsNExtFields');
			
			$data['flit'] = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$data['seg'][0]['id']));
			$data['hotel'] = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'pack_hotel','full_pack_id'=>$data['seg'][0]['id']));
			
			if(empty($data['flit']) || empty($data['hotel']))
			{
				redirect(base_url());
			}
			
			$data['fobj'] = json_decode($data['flit'][0]['pack_info'],true);	
			$data['lug_row'] = $this->AlLugagePrice->fetch_a_search(array('airline_code'=>$data['fobj']['@attributes']['suppcode']));
			$data['hobjs'] = json_decode($data['hotel'][0]['pack_info'],true);
			
			$tot_sel = 0;
			$data['departures'] = ( !$this->cache->get('departures')) ? (($this->cache->save('departures', $this->fetch_departures(), 3600)) ? $this->cache->get('departures') : array() ) : $this->cache->get('departures');
			$data['arrivals'] = ( !$this->cache->get('arrivals')) ? (($this->cache->save('arrivals', $this->fetch_arrivals(), 3600)) ? $this->cache->get('arrivals') : array() ) : $this->cache->get('arrivals');
			//Future  - Region should be dynamic
			$data['ext_fields'] = $this->SavingsNExtFields->fetch_a_fields(array('region'=>0),'ALL');
			$arr1 = array();
 			foreach ($data['ext_fields'] as $ext_fields)
 			{
 				$arr1[$ext_fields['category']][] = $ext_fields;
 			}
 			$data['ext_fields'] = $arr1;
 			//echo '<pre>';print_r($data['ext_fields']);exit;
			foreach ($data['hobjs'] as $hobj)
			{
				$tot_sel += $hobj['@attributes']['sellpricepp'];
			}
			
			
			/*
			 * Selection block
			 */
			$data['sel_info'] = $this->selctionBlock_fun($this->uri->segment(2));
			
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/customeffects.css','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script-hotels.js'));
			$this->layouts->set_title('Book');
			$this->layouts->view('booking_view',$data);
		}
		else
		{
			redirect(base_url());
		}
			
	}
	
	function booking_submition()
	{	
		
		if($this->input->post())
		{
			$post_data = $this->input->post();
			$this->load->model('FullSearch');
			$data = array();
			if(!$this->input->post('type_search'))
			{
				$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $post_data['segment']));
				$data['base_id'] = $rows[0]['id'];
			}
			else{
				$data['type_search'] = $post_data['type_search'];
			}
			
		
			$adults_info = array();$children_info = array();
			foreach ($post_data as $key => $value)
			{				
				if (strpos($key,'adult') !== false ) {
					$ad_arr = explode('_',$key);
					$adults_info[$ad_arr[1]][] =  $value;				    
				}	
				if (strpos($key,'child') !== false ) {
					$ad_arr = explode('_',$key);
					$children_info[$ad_arr[1]][] =  $value;
				}				
				
			}
			
			$data['children_info'] = json_encode($children_info);
			$data['adults_info'] = json_encode($adults_info);
			$data['address_1'] = $post_data['address_1'];
			//$data['address_2'] = @$post_data['address_2'];
			$data['address_2'] = '';
			$data['mobile'] = $post_data['mobile'];
			$data['home_tel'] = $post_data['home_tel'];
			$data['email'] =	$post_data['email'];		
			$data['postal_code'] = $post_data['post_code'];
			$data['city_country'] = $post_data['city'];	
			$this->load->model('BookingInfo');
		
			if($this->BookingInfo->createRecord($data))
			{
				$list = array($post_data['email']);
				$sub = "Booking Information";
				$body ="<div>
							<div>
								<div>Dear ".$adults_info['fname'][0].",&nbsp;</div>
								<div>&nbsp;</div>
								<div>Greetings!</div>
								<div>&nbsp;</div>
								<div>We will contact you soon under your trip request.</div>
								<div>&nbsp;</div>
								<div>Booking information goes here.</div>
								<div>&nbsp;</div>
								<div>Regards,</div>
								<div>Team BookItNow</div>
								<div>&nbsp;</div>
							</div>
						</div>";
// 				if(emailFunction($this,$sub,$body,BOOKINGADMINEMAIL,'Admin',$list))
// 				{}
				$list =  array(BOOKINGADMINEMAIL);
				$body ="<div>
							<div>
								<div>Dear Admin,&nbsp;</div>
								<div>&nbsp;</div>
								<div>Mr ".$adults_info['fname'][0]." , booked ticket.Bellow is the information</div>
								<div>&nbsp;</div>							
								<div>Booking information goes here.</div>
								<div>&nbsp;</div>
								<div>Regards,</div>
								<div>Team BookItNow</div>
								<div>&nbsp;</div>
							</div>
						</div>";
// 				if(emailFunction($this,$sub,$body,BOOKINGADMINEMAIL,'Admin',$list))
// 				{}
				echo json_encode(array('success' => 1));
			}
			else
			{
				echo json_encode(array('success' => 0));
			}
			
		}
		
		
	}
}
