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
			
			
			$data['departures'] = $this->fetch_departures();
			$data['arrivals'] = $this->fetch_arrivals();
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
			$subscribe = false;
			if($this->input->post('subscribe'))
			{
				$this->load->model('SubscribersList');
				$row_sub = $this->SubscribersList->fetch_a_search(array('email' => $this->input->post('email')));
				if(empty($row_sub))
				{
					$info = array('fname' => $this->input->post('fname'),
							'lname' => $this->input->post('lname'),
							'email' => $this->input->post('email')
					);
					$this->SubscribersList->createRecord($info);					
				}
				$subscribe = true;				
			}
			$data = array();			
			$this->load->model('FullSearch');
			$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('segment')));			
			$this->load->model('PhaseFlightOrHotel');
			$this->load->model('AlLugagePrice');
			$this->load->model('SavingsNExtFields');
				
			$flit = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
			$hotel = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'pack_hotel','full_pack_id'=>$rows[0]['id']));
				
			
			$fobj= json_decode($flit[0]['pack_info'],true);
			$lug_row = $this->AlLugagePrice->fetch_a_search(array('airline_code'=>$fobj['@attributes']['suppcode']));
			$hobjs = json_decode($hotel[0]['pack_info'],true);
			//Body Preparation
			$tot_sel = 0;$ppr = '';$pprp = '';
			
			
			
			$sep = array();
			if($rows[0]['num_rooms'] > 1)
			{
			
				if($rows[0]['num_children'])
				{
					$ser_arr = explode(',',$rows[0]['pax']);
					$temp = $hobjs;
					foreach ($ser_arr as $key => $ser)
					{
						$ser_arr_sub = explode('-',$ser);
						if(in_array($ser,array_keys($sep)))
						{
							$tot_sel += $sep[$ser] * (array_sum($ser_arr_sub));
							$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
							$pprp .= 'Room-'.($key+1).' => &#163;'.$sep[$ser].' per person x '.array_sum($ser_arr_sub).'<br>';
						}
						else{
							$tot_sel += $temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
							$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
							$pprp .= 'Room-'.($key+1).' => &#163;'.$temp[0]['@attributes']['sellpricepp'].' per person x '.array_sum($ser_arr_sub).'<br>';
							$sep[$ser] = $temp[0]['@attributes']['sellpricepp'];
							unset($temp[0]);
							$temp = array_values($temp);
						}
					}
				}
				else{
					$n = distribute($rows[0]['num_adults'],$rows[0]['num_rooms']);
					foreach ($n as $key => $val)
					{
						$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * $val;
					}
				}
			}
			else if($rows[0]['num_rooms'] == 1){
				$ppr = $rows[0]['num_adults'] .'Adult(s), '.$rows[0]['num_children'].' Child(ren)<br>';
				$pprp = '&#163;'.$hobjs[0]['@attributes']['sellpricepp'].' per person x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>';
				$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_children'] + $rows[0]['num_adults']);
			}
			
// 			if($rows[0]['pax'] != '')
// 			{
// 				$ser_arr = explode(',',$rows[0]['pax']);
// 				$rc = 1;
// 				foreach ($ser_arr as $key => $ser)
// 				{
// 					$ser_arr_sub = explode('-',$ser);
// 					$tot_sel += $hobjs[$key]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
// 					$ppr .= 'Room-'.$rc.' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
// 					$pprp .= 'Room-'.$rc.' => &#163;'.$hobjs[$key]['@attributes']['sellpricepp'].' per person x '.array_sum($ser_arr_sub).'<br>';
// 					$rc++;
// 				}
// 			}
// 			else
// 			{
// 				$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_adults'] + $rows[0]['num_children']);
// 				$ppr = $rows[0]['num_adults'] .'Adult(s), '.$rows[0]['num_children'].' Child(ren)<br>';
// 				$pprp = '&#163;'.$hobjs[0]['@attributes']['sellpricepp'].' per person x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>';
// 			}
			$dscode = $fobj['@attributes']['depapt'];
			$ascode = $fobj['@attributes']['arrapt'];
			$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
			$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',@$arrivals[(string)$ascode])[0]);
			$dscode = trim(explode('-',@$departures[(string)$dscode])[0]);
			$sel_info = $this->selctionBlock_fun($this->input->post('segment'));
			
			$body = '';
			$body .= '<b>Dear '.$this->input->post('title').' '.$this->input->post('fname').'</b>
					<br>Please find details of your recent search on <a href="'.base_url().'">bookitnow.com</a><br>
					<br><b>YOUR PARTY:</b><br>'.$ppr.'<b><br>FLIGHTS:</b><br>'.
					$dscode.' To '.$ascode.'<br>Departure Date : 
					<span class="aBn" data-term="goog_1032159087" tabindex="0">
							<span class="aQJ">'.date('d M Y',$this->cvtDt(str_date($flit[0]['flight_selected_date']))).'</span>
					</span>
					<br>'.$hobjs[0]['@attributes']['nights'].' Nights duration<br>
					Depart at <span class="aBn" data-term="goog_1032159088" tabindex="0"><span class="aQJ">'.
					substr(explode(' ',$fobj['@attributes']['outdep'])[1],0,-3).'</span></span><br>
					Flights Per Person: &#163;'.$fobj['@attributes']['sellpricepp'].' x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
					Flights Total: &#163;'.$fobj['@attributes']['sellpricepp'] * ($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
					<b><br>HOTEL:</b><br>'.urldecode($hobjs[0]['@attributes']['hotelname']).' in '.urldecode($hobjs[0]['@attributes']['resort']).
					'<br>'.(int)$hobjs[0]['@attributes']['starrating'].' Star, '.boardbasis($hobjs[0]['@attributes']['boardbasis']).'<br>
					Selected Room(s): <br>'.$pprp.'Total Room(s): &#163;'.$tot_sel.'<br><br><b> ATOL Admin Charge </b><br>
					This is an ATOL charged : 2.50 x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
					Total ATOL : &#163;'.(($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50).'<br>'.
					$sel_info['sel_block']['segment'].'<br><b> HOLIDAY TOTAL:</b>
					<br>&#163;'. $sel_info['whole'] .'<br><br>
			<a href="'.base_url().'extras/'.$this->input->post('segment').'" target="_blank">CLICK HERE TO SEARCH THIS HOLIDAY AGAIN</a><br><br>
			Want to know more? Need help or advice? Call us on 0208 548 2658 <br><br>
			Do not just travel, well travel!
<img src="https://ci6.googleusercontent.com/proxy/FDg_fZ9IpYz-JP1QS-2FSmydrrO9Eq070M1SxzevBI5jFRZPzdiKBU9g-M2micrw8ctujkHcpQtlob_l-GoSptZElxAIVcira05itPuM5bkmq14h7x5bppNyr_LICjbpd27g4QscIQ4TvQ=s0-d-e1-ft#http://mandrillapp.com/track/open.php?u=30475359&amp;id=4c7542725e3540b49402a5bf768304d9" height="1" width="1" class="CToWUd"><div class="yj6qo"></div><div class="adL">
</div>';
			
				$list =  array($this->input->post('email'));
				$sub = 'Quick Quote By BookItNow';
 				if(emailFunction($this,$sub,$body,BOOKINGADMINEMAIL,'Admin',$list))
 				{				
 				}
						
			
			
			if($subscribe)echo json_encode(array('status' => 'subscribe'));
			else echo json_encode(array('status' => 'success'));
			//$res = $this->selctionBlock_fun($this->input->post('segment'));
			//echo '<pre>';print_r($data['hobjs']);
			exit;
		}
		
		
		
		
		
	}
	
	function test()
	{
		$this->load->view('test');
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
		//echo "<pre>";print_r($hobjs);exit;
		$tot_sel = 0;$tco = 0;
		
		
		$sep = array();
		if($rows[0]['num_rooms'] > 1)
		{
		
			if($rows[0]['num_children'])
			{
				$ser_arr = explode(',',$rows[0]['pax']);
				$temp = $hobjs;
				foreach ($ser_arr as $key => $ser)
				{
					$ser_arr_sub = explode('-',$ser);
					if(in_array($ser,array_keys($sep)))
					{
						$tot_sel += $sep[$ser] * (array_sum($ser_arr_sub));
					}
					else{
						$tot_sel += $temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
						$sep[$ser] = $temp[0]['@attributes']['sellpricepp'];
						unset($temp[0]);
						$temp = array_values($temp);
					}
				}
			}
			else{
				$n = distribute($rows[0]['num_adults'],$rows[0]['num_rooms']);
				foreach ($n as $key => $val)
				{
					$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * $val;
				}
			}
		}
		else if($rows[0]['num_rooms'] == 1){
			
			$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_children'] + $rows[0]['num_adults']);
		}
		
		
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
		$data['form_type'] = 'hotel_only';
		if(!empty($row = $this->UserSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)))))
		{			
			$data['seg'] = $row;
			$data['hobjs'] = json_decode($row[0]['pack_info'],true);
			foreach ($data['hobjs'] as $hobj)
			{
				$tot_sel += $hobj['@attributes']['sellpricepp'];
			}
			$data['res_sel_price'] = $tot_sel / count($data['hobjs']);	
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/jquery-ui.css','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/jquery-ui.js','js/script-hotels.js'));
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
			$data['departures'] = $this->fetch_departures();
			$data['arrivals'] = $this->fetch_arrivals();
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
			
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/customeffects.css','css/jquery-ui.css','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/jquery-ui.js','js/script-hotels.js'));
			$this->layouts->set_title('Book');
			$this->layouts->view('booking_view',$data);
		}
		else
		{
			redirect(base_url());
		}
			
	}
	function email_body_full($postdata,$rows = array())
	{
		$this->load->model('PhaseFlightOrHotel');
					$this->load->model('AlLugagePrice');
					$this->load->model('SavingsNExtFields');
			
					$flit = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
					$hotel = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'pack_hotel','full_pack_id'=>$rows[0]['id']));
			
		
					$fobj= json_decode($flit[0]['pack_info'],true);
					$lug_row = $this->AlLugagePrice->fetch_a_search(array('airline_code'=>$fobj['@attributes']['suppcode']));
					$hobjs = json_decode($hotel[0]['pack_info'],true);
					//Body Preparation
					$tot_sel = 0;$ppr = '';$pprp = '';
					$sep = array();
					if($rows[0]['num_rooms'] > 1)
					{
							
						if($rows[0]['num_children'])
						{
							$ser_arr = explode(',',$rows[0]['pax']);
							$temp = $hobjs;
							foreach ($ser_arr as $key => $ser)
							{
								$ser_arr_sub = explode('-',$ser);
								if(in_array($ser,array_keys($sep)))
								{
									$tot_sel += $sep[$ser] * (array_sum($ser_arr_sub));
									$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
									$pprp .= 'Room-'.($key+1).' => &#163;'.$sep[$ser].' per person x '.array_sum($ser_arr_sub).'<br>';
								}
								else{
									$tot_sel += $temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
									$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
									$pprp .= 'Room-'.($key+1).' => &#163;'.$temp[0]['@attributes']['sellpricepp'].' per person x '.array_sum($ser_arr_sub).'<br>';
									$sep[$ser] = $temp[0]['@attributes']['sellpricepp'];
									unset($temp[0]);
									$temp = array_values($temp);
								}
							}
						}
						else{
							$n = distribute($rows[0]['num_adults'],$rows[0]['num_rooms']);
							foreach ($n as $key => $val)
							{
								$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * $val;
							}
						}
					}
					else if($rows[0]['num_rooms'] == 1){
						$ppr = $rows[0]['num_adults'] .'Adult(s), '.$rows[0]['num_children'].' Child(ren)<br>';
						$pprp = '&#163;'.$hobjs[0]['@attributes']['sellpricepp'].' per person x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>';
						$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_children'] + $rows[0]['num_adults']);
					}					
					
					$dscode = $fobj['@attributes']['depapt'];
					$ascode = $fobj['@attributes']['arrapt'];
					$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
					$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',@$arrivals[(string)$ascode])[0]);
					$dscode = trim(explode('-',@$departures[(string)$dscode])[0]);
					$sel_info = $this->selctionBlock_fun($postdata['segment']);
		
					$body = '';
					$body .= '<b>Dear '.$postdata['adult_title_1'].' '.ucfirst($postdata['adult_fname_1']).'</b>
							<br>Please find details of your recent search on <a href="'.base_url().'">bookitnow.com</a><br>
							<br><b>YOUR PARTY:</b><br>'.$ppr.'<b><br>FLIGHTS:</b><br>'.
										$dscode.' To '.$ascode.'<br>Departure Date :
							<span class="aBn" data-term="goog_1032159087" tabindex="0">
									<span class="aQJ">'.date('d M Y',$this->cvtDt(str_date($flit[0]['flight_selected_date']))).'</span>
							</span>
							<br>'.$hobjs[0]['@attributes']['nights'].' Nights duration<br>
							Depart at <span class="aBn" data-term="goog_1032159088" tabindex="0"><span class="aQJ">'.
										substr(explode(' ',$fobj['@attributes']['outdep'])[1],0,-3).'</span></span><br>
							Flights Per Person: &#163;'.$fobj['@attributes']['sellpricepp'].' x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
							Flights Total: &#163;'.$fobj['@attributes']['sellpricepp'] * ($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
							<b><br>HOTEL:</b><br>'.urldecode($hobjs[0]['@attributes']['hotelname']).' in '.urldecode($hobjs[0]['@attributes']['resort']).
										'<br>'.(int)$hobjs[0]['@attributes']['starrating'].' Star, '.boardbasis($hobjs[0]['@attributes']['boardbasis']).'<br>
							Selected Room(s): <br>'.$pprp.'Total Room(s): &#163;'.$tot_sel.'<br><br><b> ATOL Admin Charge </b><br>
							This is an ATOL charged : 2.50 x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
							Total ATOL : &#163;'.(($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50).'<br>'.
										$sel_info['sel_block']['segment'].'<br><b> HOLIDAY TOTAL:</b>
							<br>&#163;'. $sel_info['whole'] .'<br><br>
					
					Want to know more? Need help or advice? Call us on 0208 548 2658 <br><br>
					Do not just travel, well travel!
		<img src="https://ci6.googleusercontent.com/proxy/FDg_fZ9IpYz-JP1QS-2FSmydrrO9Eq070M1SxzevBI5jFRZPzdiKBU9g-M2micrw8ctujkHcpQtlob_l-GoSptZElxAIVcira05itPuM5bkmq14h7x5bppNyr_LICjbpd27g4QscIQ4TvQ=s0-d-e1-ft#http://mandrillapp.com/track/open.php?u=30475359&amp;id=4c7542725e3540b49402a5bf768304d9" height="1" width="1" class="CToWUd"><div class="yj6qo"></div><div class="adL">
		</div>';
			
										return $body;
				
	}
	function email_body_hotel($postdata,$rows = array())
	{
		
		$hobjs = json_decode($rows[0]['pack_info'],true);
			$tot_sel = 0;$ppr = '';$pprp = '';
					$sep = array();
					if($rows[0]['num_rooms'] > 1)
					{
							
						if($rows[0]['num_children'])
						{
							$ser_arr = explode(',',$rows[0]['pax']);
							$temp = $hobjs;
							foreach ($ser_arr as $key => $ser)
							{
								$ser_arr_sub = explode('-',$ser);
								if(in_array($ser,array_keys($sep)))
								{
									$tot_sel += $sep[$ser] * (array_sum($ser_arr_sub));
									$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
									$pprp .= 'Room-'.($key+1).' => &#163;'.$sep[$ser].' per person x '.array_sum($ser_arr_sub).'<br>';
								}
								else{
									$tot_sel += $temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
									$ppr .= 'Room-'.($key+1).' => '. $ser_arr_sub[0] .'Adult(s), '.$ser_arr_sub[1].' Child(ren)<br>';
									$pprp .= 'Room-'.($key+1).' => &#163;'.$temp[0]['@attributes']['sellpricepp'].' per person x '.array_sum($ser_arr_sub).'<br>';
									$sep[$ser] = $temp[0]['@attributes']['sellpricepp'];
									unset($temp[0]);
									$temp = array_values($temp);
								}
							}
						}
						else{
							$n = distribute($rows[0]['num_adults'],$rows[0]['num_rooms']);
							foreach ($n as $key => $val)
							{
								$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * $val;
							}
						}
					}
					else if($rows[0]['num_rooms'] == 1){
						$ppr = $rows[0]['num_adults'] .'Adult(s), '.$rows[0]['num_children'].' Child(ren)<br>';
						$pprp = '&#163;'.$hobjs[0]['@attributes']['sellpricepp'].' per person x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>';
						$tot_sel += $hobjs[0]['@attributes']['sellpricepp'] * ($rows[0]['num_children'] + $rows[0]['num_adults']);
					}	
		
		$body = '';
		$body .= '<b>Dear '.$postdata['adult_title_1'].' '.ucfirst($postdata['adult_fname_1']).'</b>
							<br>Please find details of your recent search on <a href="'.base_url().'">bookitnow.com</a><br>
							<br><b>YOUR PARTY:</b><br>'.$ppr.'<b><br>HOTEL:</b><br>'.urldecode($hobjs[0]['@attributes']['hotelname']).' in '.urldecode($hobjs[0]['@attributes']['resort']).
									'<br>'.(int)$hobjs[0]['@attributes']['starrating'].' Star, '.boardbasis($hobjs[0]['@attributes']['boardbasis']).'<br>
							Selected Room(s): <br>'.$pprp.'Total Room(s): &#163;'.$tot_sel.'<br><br><b> ATOL Admin Charge </b><br>
							This is an ATOL charged : 2.50 x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'<br>
							Total ATOL : &#163;'.(($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50).'<br><br><b> HOLIDAY TOTAL:</b>
							<br>&#163;'. ($tot_sel + (($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50)) .'<br><br>Want to know more? Need help or advice? Call us on 0208 548 2658 <br><br>
					Do not just travel, well travel!
		<img src="https://ci6.googleusercontent.com/proxy/FDg_fZ9IpYz-JP1QS-2FSmydrrO9Eq070M1SxzevBI5jFRZPzdiKBU9g-M2micrw8ctujkHcpQtlob_l-GoSptZElxAIVcira05itPuM5bkmq14h7x5bppNyr_LICjbpd27g4QscIQ4TvQ=s0-d-e1-ft#http://mandrillapp.com/track/open.php?u=30475359&amp;id=4c7542725e3540b49402a5bf768304d9" height="1" width="1" class="CToWUd"><div class="yj6qo"></div><div class="adL">
		</div>';
										
		return $body;
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
				$body = $this->email_body_full($post_data,$rows);
			}
			else{
				$data['type_search'] = $post_data['type_search'];
				$rows = $this->UserSearch->fetch_a_search(array('url_hash' => $post_data['segment']));
				$data['base_id'] = $rows[0]['id'];
				$body = $this->email_body_hotel($post_data,$rows);
				
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
		   if(isset($post_data['address_2']))
		   $data['address_2'] = $post_data['address_2'];
		   //$data['address_2'] = '';
		   $data['mobile'] = $post_data['mobile'];
		   $data['home_tel'] = $post_data['home_tel'];
		   $data['email'] = $post_data['email'];  
		   $data['postal_code'] = $post_data['post_code'];
		   if(isset($post_data['post_code2']))
		   $data['postal_code2'] = @$post_data['post_code2'];
		   $data['city_country'] = $post_data['city']; 
		   if(isset($post_data['city2']))
		   $data['city_country2'] = @$post_data['city2'];
		   $data['card_type'] = $post_data['card_type'];
		   $data['name_card'] = $post_data['name_card'];
		   $data['card_number'] = $post_data['card_number'];
		   if(isset($post_data['cvv_number']))
		   $data['cvv_number'] = @$post_data['cvv_number'];
			
			
			$this->load->model('BookingInfo');
			
			
			
			if($rid = $this->BookingInfo->createRecord($data))
			{				
				$this->bookingInfoToEmail($rid,'email');
				//$list = array($post_data['email']);
				//$sub = "Booking Information";
				
 				//if(emailFunction($this,$sub,$body,BOOKINGADMINEMAIL,'Admin',$list))
 				//{}
 				echo json_encode(array('success' => 1));
			}
			else
			{
				echo json_encode(array('success' => 0));
			}
			
		}	
	}
	
	
	public function bookingInfoToEmail($ref_id,$type)
	{
	
		$this->load->model ( 'Bookinginfo' );
		$this->load->model('UserSearch');
		$data = array();
		$data['controller'] = $this;
		$data['row'] = $this->Bookinginfo->fetch_a_search(array('reference_id'=>$ref_id));
	
		if($data['row'][0]['type_search'] == 'hotel_only'){
	
			$data['seg'] = $this->UserSearch->fetch_a_search(array('id' => $data['row'][0]['base_id']));
			$data['hobjs'] = json_decode($data['seg'][0]['pack_info'],true);
		}
		else{
			$this->load->model('FullSearch');
			//	$this->serachInfo($data['row'][0]['base_id'])
			$data['seg'] = $this->FullSearch->fetch_a_search(array('id' => $data['row'][0]['base_id']));
			if(!empty($data['seg']))
			{
				$this->load->model('PhaseFlightOrHotel');
				$this->load->model('AlLugagePrice');
				$this->load->model('SavingsNExtFields');
				$this->load->model('PhaseSavingsNExtras');
					
	
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
			}
		}	
			//Adviser Information
			$data['pdfdata']['adviser_info']['name'] = ' Howard Finch ';
			$data['pdfdata']['adviser_info']['reference'] = $ref_id;
			$data['pdfdata']['adviser_info']['phone'] = '08006947174';
			$data['pdfdata']['adviser_info']['date'] = date('d/m/y');
			$data['pdfdata']['adviser_info']['email'] = 'finch@bookitnow.co.uk';
			
			boookattach($data,$type);
		
	}
	
	public function bookingLogin()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/viewbooking.css','js/responsee.js','js/bxslider/jquery.bxslider.js','js/viewbooking.js'));
		$data = array();
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'Bookinginfo' );
		$count = 0;
		if ($this->input->post ()) {   
		   $this->form_validation->set_rules ( 'reference_id', 'Reference Id', 'trim|required' );
		   $this->form_validation->set_rules ( 'lname', 'Last Name', 'trim|required' );
		   $this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );   
		   if (! $this->form_validation->run ()) {} else {   
		    $rows = $this->Bookinginfo->fetch_a_search(array('reference_id' => $this->input->post ('reference_id'),'email'=>$this->input->post('email')));
		    if(!$rows){
		     $this->session->set_flashdata ( 'message', '<span class="error">Sorry,Given details not matched with our database</span>' );
		    }
		    else {     
		     $adult_info=json_decode($rows[0]["adults_info"]);
		     if($this->input->post ('lname') !== current($adult_info->lname))
		     {
		      $this->session->set_flashdata ( 'message', '<span class="error">Sorry,Given details not matched with our database</span>' );
		     }
		     else{
		      $this->yourBasket();
		      $count++;
		     }     
		    }   
		   }
	  }
		if(!$count){
		
		$this->layouts->set_title('View Booking Login');
		$this->layouts->view('viewbookinglogin');	
		}
	}
	
	public function yourBasket()
	{		
		$this->load->model ( 'Bookinginfo' );
		$this->load->model('UserSearch');
		$data = array();
		$data['controller'] = $this;
		$data['row'] = $this->Bookinginfo->fetch_a_search(array('reference_id'=>$this->input->post('reference_id')));
		$data['departures'] = $this->fetch_departures();
		$data['arrivals'] = $this->fetch_arrivals();
		if($data['row'][0]['type_search'] == 'hotel_only'){
		
			$data['seg'] = $this->UserSearch->fetch_a_search(array('id' => $data['row'][0]['base_id']));
			$data['hobjs'] = json_decode($data['seg'][0]['pack_info'],true);
		}
		else if($data['row'][0]['type_search'] == 'flight_only')
		{
			$data['seg'] = $this->UserSearch->fetch_a_search(array('id' => $data['row'][0]['base_id']));
			$data['fobj'] = json_decode($data['seg'][0]['pack_info'],true);			
			$data['flit'][0]['flight_selected_date'] = explode(' ',$data['fobj']['@attributes']['outdep'])[0];
		}
		else{
			$this->load->model('FullSearch');
			//	$this->serachInfo($data['row'][0]['base_id'])
			$data['seg'] = $this->FullSearch->fetch_a_search(array('id' => $data['row'][0]['base_id']));
			if(!empty($data['seg']))
			{
				$this->load->model('PhaseFlightOrHotel');
				$this->load->model('AlLugagePrice');
				$this->load->model('SavingsNExtFields');
				$this->load->model('PhaseSavingsNExtras');
					
		
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
			}
		}
		if($this->input->post('download')){			
			//Adviser Information
			$data['pdfdata']['adviser_info']['name'] = ' Howard Finch ';
			$data['pdfdata']['adviser_info']['reference'] = $this->input->post('reference_id');
			$data['pdfdata']['adviser_info']['phone'] = '08006947174';
			$data['pdfdata']['adviser_info']['date'] = date('d/m/y');
			$data['pdfdata']['adviser_info']['email'] = 'finch@bookitnow.co.uk';
			boookattach($data);			
		}
		$this->layouts->set_title('View Booking Info');
		//echo '<pre>';print_r($data);exit;
			$this->layouts->view ( 'view_booking', $data );
					
	}
	
public function book_flight()
	{
		
		
		$data = array();
		$tot_sel = 0;
		$data['controller'] = $this;
		$data['form_type'] = 'flight_only';
		if(!empty($row = $this->UserSearch->fetch_a_search(array('type_search'=>'flight_hotel','url_hash' => $this->uri->segment(2)))))
		{
			$data['seg'] = $row;
			$data['hobjs'] = json_decode($row[0]['pack_info'],true);
			
			$tot_sel=$data['hobjs']['@attributes']['sellpricepp'];
			$data['res_sel_price'] = $tot_sel / count($data['hobjs']);
			
	
			$departures = $this->fetch_departures();
			$arrivals = $this->fetch_arrivals();
				
	//$this->load->model('PhaseFlightOrHotel');
	$selected_info = $row;
	//echo "<pre>";print_r($selected_info);exit;
	//print_r($selected_info);exit;
	$flight_obj = json_decode($selected_info[0]['pack_info'],true);
	
	$dscode = $flight_obj['@attributes']['depapt'];
	
	//echo $dscode;exit;
	$ascode = $flight_obj['@attributes']['arrapt'];
	
	$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
	
	$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',$arrivals[(string)$ascode])[0]);
	
	$dscode = trim(explode('-',$departures[(string)$dscode])[0]);
	//print_r($flight_obj);exit;
	
	$dept_start_time = substr(explode(' ',$flight_obj['@attributes']['outdep'])[1],0,-3);
	$dept_arr_time = substr(explode(' ',$flight_obj['@attributes']['outarr'])[1],0,-3);
	$return_start_time = substr(explode(' ',$flight_obj['@attributes']['indep'])[1],0,-3);
	$return_arr_time = substr(explode(' ',$flight_obj['@attributes']['inarr'])[1],0,-3);
	$this->load->helper('common');
	$dept_images = dept_images();
	$type_s = 'full_flight';
	$cry = $this->uri->segment(2);
	//echo "<pre>";print_r($row);exit;
	$data['seleted_info'] =  '
			
		<div class="deals">	<h2>Your Selections	</h2></div>
	<div class="conatiner-bg"style="
      font-weight: 500;
       color: inherit;
"> <div class="basket_item bg_grey padded border_b clearfix">
            			<div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
                			<div class="left">
                    			<h4>Flights</h4>
                			</div>
			                <div class="right" style="text-align: right;">
			                    <h4 style="margin-left: 125px;color: #0088cc;">&#163;'.(($row[0]['num_adults'] + max($row[0]['num_children'],0)) * $flight_obj['@attributes']['sellpricepp']).'</h4>
			                </div>
			            </div>
			            <div style="margin-bottom: 11px; margin-top: 0px;">
			                <strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Depart:</strong>
			                <br>
			              <!--  <div style="position: relative;" class="clearfix">
			                    <div class="left">
			                        <img src="'.$dept_images[$flight_obj['@attributes']['suppcode']].'" style="margin-left: 62px; margin-top: -42px;">
			                    </div>
			                    <div class="right">
			                        <span class="txt_color_2"></span>
			                    </div>
			                </div>-->
			               <small>'. $dscode.' to '.$ascode.' '.$dept_start_time.'/'.$dept_arr_time.'</small><br>
			                <span class="txt_color_2"></span>
			            </div>
			            <div style="margin-bottom: 5px;">
		                	<strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Return:</strong><br>
			             <!--   <div style="position: relative;" class="clearfix">
			                    <div class="left">
			                        <img src="'.$dept_images[$flight_obj['@attributes']['suppcode']].'" style="margin-left: 62px; margin-top: -42px;">
			                    </div>
			                </div>-->
			               	 <small>'.$ascode.' to '.$dscode.' '.$return_start_time.'/'.$return_arr_time.'</small><br>
			                <span class="txt_color_2"></span>
            			</div>
	
			            <div style="position: relative;" class="clearfix">
			                <div class="left">
			                    <small>
			                        <span id="cphContent_ucBookingSummary_lblFPersonCount"> Adults + Children : '.($row[0]['num_adults'] + max($row[0]['num_children'],0)).' x </span><span id="cphContent_ucBookingSummary_lblFPrice">&#163;'.$flight_obj['@attributes']['sellpricepp'].'</span>
			                    </small>
			                </div>
			                <div class="right">
			                    <small>
			                        <a href="'.base_url().'flightsAvailability/'.$this->uri->segment(2).'" onClick="return Change('."'".$type_s."'".','."'".$cry."'".')" title="Change Flight">Change</a>
			                    </small>
			                </div>
			            </div>
			          </div>
			      <div class="conatiner-bg">
			          <div class=" basket_item bg_grey padded border_b" style="position: relative;">
					    <div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
			                <div class="left">
			                    <h4 style="color: rgba(241, 113, 19, 0.98);">Atol Protection</h4>
			                </div>
			                <div class="right" style="text-align: right;">
			                    <h4 style="margin-left: 125px;color: #0088cc;">&#163;'.(($row[0]['num_adults'] + max($row[0]['num_children'],0)) * 2.50 ).'</h4>
			                </div>
			            </div>
			            <div style="position: relative;" class="clearfix">
			                <div class="left">
			                    <small>£2.50 x '.($row[0]['num_adults'] + max($row[0]['num_children'],0)).'
			                    </small>
			                </div>
           			   </div>
			        </div>
			        </div>
			           		
			                    		
	 
	             <div class="basket_item bg_grey padded border_b" style="position: relative;">
	
                  <div class="conatiner-bg" >
	               <div style="position: relative;" class="clearfix">
	                 <div class="left">
  
	               <small> 
                  <h3 style="font-size: 18px;">TOTAL:</h3> <h4 style="margin-left: 164px;margin-top: -19px;color: #0088cc;">&#163;'.((($row[0]['num_adults'] + max($row[0]['num_children'],0)) * $flight_obj['@attributes']['sellpricepp']  ) + (($row[0]['num_adults'] + max($row[0]['num_children'],0)) * 2.50 )).'</h4>
	
			</small>
			</div>
			</div>
					</div>
			</div>
					';
	/**************total*******************************/
	/**************end*******************************/
	$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/jquery-ui.css','css/customeffects','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/jquery-ui.js','js/script-hotels.js'));
	$this->layouts->set_title('Book Hotel');
	$this->layouts->view('book_flight_view',$data);
	}
	else{
		redirect(base_url());
	}
	}
}