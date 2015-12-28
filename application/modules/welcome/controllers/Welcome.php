<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->helper(array('form','url','common'));
		$this->load->model('UserSearch');
		$this->load->model ( 'User' );	
	}
	

	
	public function seperatorFlights($code,$name)
	{
		static $departures = array();
		$sp_ar = explode(' - ',$name);		
		$county = (@$sp_ar[1] != '') ? @$sp_ar[1] : @$sp_ar[0];   
		$departures[$county][$code] = $sp_ar[0];		
		return $departures;
	}
	
	public function index()
	{	
		$data = array();
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
				'css/jquery-ui.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/custom.css',
				'css/responsive.css',
				'css/menu.css',
				'css/preview.min.css',
				'css/bxslider/jquery.bxslider.css',
				'css/jquery.fancybox.css',
				'css/popup_fancy.css',
				'js/jquery-ui.js',
				'js/jquery.blockUI.js',
				'js/responsee.js',
				'js/responsiveslides.min.js',
				'js/bxslider/jquery.bxslider.js',
				'js/parallax-slider/jquery.cslider.js',
				'js/jquery.fancybox.pack.js',
				'js/script-home.js'));
		$this->layouts->set_title('Home');
		$results = array();		
		/************fetching departure airports**************/		
		changeSearch($data);		
		/******************end***********/		
		/************fetching travel to list for hotels**************/
		$data['hotel_travel_list'] = $this->arrival_list_basedon_dynaminc_departuere_airport();		
		/******************end***********/		
		$this->layouts->view('home_page',$data);
	}
		
	public function formatArriavlsFun($code,$name)
	{
		static $arrivals = array();
		$sp_ar = explode(' - ',$name);
		$county = @$sp_ar[0];
		$ext = (@$sp_ar[2] != '') ? ' - '.@$sp_ar[2] : '';
		$fname = (@$sp_ar[1] != '') ? @$sp_ar[1] : $county;
		$arrivals[$county][$code] = $fname.$ext;
		return $arrivals;
	}
	
	//function to fetch the results based on ajax request
	public function fetch_results()
	{	
		$results = array();$string = '';
		//$data= array();
		$arrivals= array();
		//if(array_key_exists($this->input->post('dest_shrtcode'),$this->cache->get('departures')))
		//{
			$results['arrivals'] = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=2&compid=1'));			
			
			foreach ($results['arrivals'] as $arrival)
			{
				$code = (array)$arrival->attributes()->code;
				$name = (array)$arrival->attributes()->name;
				$arrivals = $this->formatArriavlsFun($code[0],$name[0]);
				//$data[$code[0]] = $name[0];
			}
			
		//}	
		$string .= '<option value="-1">Select Destination</option>';
		foreach($arrivals as $key => $val)
		{
			$string .= '<option value="-1" style="font-weight:bold;color:red;">'.strtoupper($key).'</option>';
			foreach ($val as $key1 => $val1)
			{				
				$string .= '<option value='.$key1.'>'.$val1.'</option>';
			}			
		}
		echo $string;exit;
	}
	
		
		
	
	public function fetch_filtered_flights()
	{
		if($this->input->post())	{						
			if(strtotime(str_replace('/', '-', $this->input->post('departure_date'))) < strtotime(date('d-m-Y')))
			{
				echo '<span class="status expired">Expired</span>';exit;
			}
			$data['result'] = array();$count = 0; $flex = 3;
			$req_url_half = 'http://87.102.127.86:8005/search/websearch.exe?pageid=3&depapt='.$this->input->post('departure_airports').'&arrapt='.$this->input->post('arrival_airports').'&compid=1&minstay='.$this->input->post('nights').'&maxstay='.$this->input->post('nights').'&flex='.$flex.'&depdate=';
			
			$req_url = $req_url_half.$this->input->post('departure_date');				
			$data['results'] = new SimpleXMLElement($this->download_page($req_url));
			if($data['results']->attributes()->offers > 0)
			{
				$post_data = $this->input->post();
				$post_data['childrens'] = ($this->input->post('childrens') != -1) ? $this->input->post('childrens') : 0;
				$data = array('service_url' => $req_url,
						'type_search' => 'flight_hotel',
						'selected_date' => $this->input->post('departure_date'),
						'num_adults' => $this->input->post('adults'),
						'num_children' => $post_data['childrens'],
						'arapts' => $this->input->post('arrival_airports')
				);
				$hash = $this->UserSearch->createSearch($data);
				if(!empty($this->UserSearch->fetch_a_search(array('url_hash' => $hash))))
				{
					echo 'available/'.$hash;
				}
				else
				{
					echo 'notavailable';
				}
			}
			else
			{
				echo 'notavailable';
			}			
		}		
		exit;
	}
	
	
	public function check_results_for_full_pack_fun()
	{	
		if($this->input->post()){
			$post_data = $this->input->post();
			$flex= 3;$allow = 0;
			$map_arr = explode('-',trim($post_data['mapper']));
			if((int)$post_data['full_children'] == -1){
				$post_data['full_children'] = 0;
			}
			if(isset($post_data['pax']))
			{
				$paxes_str = explode(',',substr($post_data['pax'],0,-1));
				$paxes = array_unique($paxes_str);
				
				$count = 0;
				$service_url = '';
				foreach ($paxes as $pax)
				{
					
					$service_url_str = "http://87.102.127.86:8005/search/websearch.exe?pageid=8&compid=1&depapt=".$post_data['full_departure_airports']."&minstay=".$post_data['full_nights']."&maxstay=".$post_data['full_nights']."&depdate=".$post_data['full_departure_date']."&flex=".$flex."&countryid=$map_arr[0]&regionid=$map_arr[1]&areaid=$map_arr[2]&resortid=&boards=&rating=&pax=".$pax."&maxoffers=500";
				
					$results = new SimpleXMLElement($this->download_page($service_url_str));
					if($results->attributes()->count > 0)
					{						
						$count++;
						$service_url .= $service_url_str.',';
					}
				}
				if($count == count($paxes) && count($paxes) > 1)
					{
						$post_data['pax'] = substr($post_data['pax'],0,-1);					
						$allow = 1;
					}
					else if($count == count($paxes))
					{
						$allow = 1;
						unset($post_data['pax']);
					}
			}
			else
			{
				
				$service_url = "http://87.102.127.86:8005/search/websearch.exe?pageid=8&compid=1&depapt=".$post_data['full_departure_airports']."&minstay=".$post_data['full_nights']."&maxstay=".$post_data['full_nights']."&depdate=".$post_data['full_departure_date']."&flex=".$flex."&countryid=$map_arr[0]&regionid=$map_arr[1]&areaid=$map_arr[2]&resortid=&boards=&rating=&pax=".$post_data['full_adults']."-".$post_data['full_children']."&maxoffers=500";
				$results = new SimpleXMLElement($this->download_page($service_url));
				if($results->attributes()->count > 0)
				{
					$allow = 1;
				}
			}					
			if($allow)			
			{
				$this->load->model( 'FullSearch' );
				$hash = $this->FullSearch->createSearch($service_url,'full_package',$post_data);
				if(!empty($this->FullSearch->fetch_a_search(array('url_hash' => $hash))))
				{
					echo 'flightsAvailability/'.$hash;
				}
				else
				{
					echo 'notavailable';
				}
			}
			else
			{
				echo 'notavailable';
			}
			exit;
		}	
	}
	
	
	/*
	 *  Fetch the results based on date
	 */
	
	public function dateDataFun()
	{
		$search_array = $this->cache->get($this->input->post('crypt'));
		print_r($this->input->post());exit;
	}
		
	public function available($id=null)
	{
		
		$rows = $this->UserSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)));
		$data= array();$results=array();
		$results['controller']=$this;		
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/flight_result.css','css/style.css','css/jquery.fancybox.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/script.js'));
		$this->layouts->set_title('Search Page');
		$results['suppliers_list'] = array(
				'AVRO' => '/images/AVROF.gif',
				'EJET' => '/images/EASYJET.gif',
				'NFFT' => '/images/NORWAIR.jpg',
				'MNFT' => '/images/FLYM.gif',
				'EJFT' => '/images/AVROF.gif',
				'MONA' => '/images/FLYM.gif',
				'MNNF' => '/images/MNNF.gif',
				'NORW' => '/images/NORWAIR.jpg',
				'EJNF' => '/images/EJNF.gif',
				'FLTH' => '/images/THOMASCOOK.png',
				'TFFT' => '/images/THOMSON.gif',
				'FTNF' => '/images/FTNF.gif',
				'TFNF' => '/images/TFNF.gif',
				'THFL' => '/images/THFL.gif',
				'TOHO' => '/images/TOHO.gif',
				'RYAT' => '/images/logo_ryan_txt.png',
				'JET2' => '/images/JET2.gif',
				'AERL' => '/images/AERL.gif',
				'EJTF' => '/images/EJTF.gif',
				'NFTF' => '/images/NFTF.gif',
				'FTTF' => '/images/FTTF.gif',
				'MNTF' => '/images/MNTF.gif'
		
		);
		//$this->cache->delete($this->uri->segment(2));
		if(!empty($rows))
		{		
			$count = 0;$flex = 3;
		//	$results['departures'] = ( !$this->cache->get('departures')) ? (($this->cache->save('departures', $this->fetch_departures(), 3600)) ? $this->cache->get('departures') : array() ) : $this->cache->get('departures');
		//	$results['arrivals'] = ( !$this->cache->get('arrivals')) ? (($this->cache->save('arrivals', $this->fetch_arrivals(), 3600)) ? $this->cache->get('arrivals') : array() ) : $this->cache->get('arrivals');
			$results['departures'] =  $this->fetch_departures();
			$results['arrivals'] = $this->fetch_arrivals();
			// Future To-do :  Here Please check weather "selected_date" should more than current date otherwise 404 page
					
			$req_url = $rows[0]['service_url'];
			
			$req_url_half = str_replace($rows[0]['selected_date'],'',$req_url);	
			
			$data['results'] = new SimpleXMLElement($this->download_page($req_url));
			
			$search_dates=array();$best_price = 0;
			//if(empty($this->cache->get($this->uri->segment(2))))
			//{
				if($data['results']->attributes()->offers > 0)
				{
					$coded_date = json_decode(json_encode($data['results']),true);
					$this->search_upto_flex_days($coded_date,$rows[0]['selected_date'],$flex,$search_dates);
					$search_dates[$rows[0]['selected_date']]['offers_list'] = $coded_date['offer'];
					//echo $rows[0]['selected_date'];exit;
					if($cdate_bp = $this->best_price_date_wise_fun($coded_date['offer']))
					{
						
						$search_dates[$rows[0]['selected_date']]['best_price'] = $cdate_bp;
					}
						
				}
				else
				{						
					redirect(base_url());			
				}			
				//$this->cache->save($this->uri->segment(2),$search_dates, 3600);
			//}
			//else{		
			//	$search_dates = $this->cache->get($this->uri->segment(2));				
		//}
			
			//echo "<pre>";print_r($search_dates);exit;
			$list_min = array_column($search_dates, 'best_price');
			
			if(!empty($list_min))
			{
				$best_price = min($list_min);
					
				$results['dates_list']=array_keys($search_dates);
				usort($results['dates_list'], array($this,"sortFunction"));
				$count=0;
				
				//Variables
				//$flight_suppliers=array();
				$dept_take_offs=array();
				$return_take_offs=array();
				$results['fly_from'] = array();
				$results['flight_operators'] = array();
				//End - Varibles
				
				foreach($search_dates as $key_date => $value_date)
				{						
					if(@$value_date['best_price'] == $best_price && $count < 1)
					{						
						//Sort by best price
						usort($search_dates[$key_date]['offers_list'], function($a, $b) {						
							return $a['@attributes']['sellpricepp'] > $b['@attributes']['sellpricepp'] ? 1 : -1;
						});
						//END - Sort by best price 
						
						$results['flights_list'] = $search_dates[$key_date];
						$results['selected_date'] = $key_date;
						$count++;
					}
					
					if(!empty(@$value_date['offers_list']))
					{	
						
						foreach ($value_date['offers_list'] as $key => $offer)
						{
							
							//$value_date['offers_list'][$key]['@attributes']['sellpricepp'] = $offer['@attributes']['sellpricepp'] + 10;
							
							//$flight_suppliers[$offer['@attributes']['suppname']] = $offer['@attributes']['suppcode'];
							$dept_take_offs[] =  (int)substr(explode(' ',$offer['@attributes']['outdep'])[1],0,2);							
							$return_take_offs[] = (int)substr(explode(' ',$offer['@attributes']['indep'])[1],0,2);
							
							// Listing departure airport list							
							if(!in_array($offer['@attributes']['depapt'], $results['fly_from'])){
								$results['fly_from'][$offer['@attributes']['depapt']]=explode(' - ',$results['departures'][$offer['@attributes']['depapt']])[0];
								$results['fly_from_best_prices'][$offer['@attributes']['depapt']] = $value_date['best_price'];
							}
							// END - Listing departure airport list
							
							// Listing flight operator list
							if(!in_array($offer['@attributes']['suppcode'], $results['flight_operators'])){
								
								$results['flight_operators'][$offer['@attributes']['suppcode']]=$results['suppliers_list'][$offer['@attributes']['suppcode']];
							}
							// END - Listing flight operator list
								
							
						}	
						$results['num_of_flights'][$key_date] = count(@$value_date['offers_list']);
						$results['best_prices_dates_wise'][$key_date] = '&#163;'.@$value_date['best_price'];
					}
					else
					{
						$results['num_of_flights'][$key_date] = 0;
						$results['best_prices_dates_wise'][$key_date] = '&#163;N/A';
					}
				}
				
				// Filter populators
				$results['dept_take_offs_min'] = min($dept_take_offs);				
				$results['dept_take_offs_max'] = max($dept_take_offs)+1; // Remember : Take a look while max gretaer than 23 hours
				$results['return_take_offs_min'] = min($return_take_offs);
				$results['return_take_offs_max'] = max($return_take_offs)+1;
				//END - Filter Populators
				//print_r($results);exit;
				if(!$count)
				{
					$results['flights_list'] = $search_dates[$rows[0]['selected_date']];
					$results['selected_date'] = $rows[0]['selected_date'];
				}
				
				
				//For change search poopulations
				$departures = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
				
				foreach ($departures as $departure)
				{
					$code = (array)$departure->attributes()->code;
					$name = (array)$departure->attributes()->name;
					$results['filtered_departures'] = $this->seperatorFlights($code[0],$name[0]);
					$results['departures'][$code[0]] = $name[0];
				}	
				$parts = parse_url($req_url);
				parse_str($parts['query'], $query);
				$results['change_search_info']['query'] = $query;
				$results['change_search_info']['row'] = $rows[0];
				$results['controller'] = $this;
				$results['fcls'] = 'current';
				$results['bcls'] = '';
				$results['f_done'] = '';
				//End
				//$t = findKey($results,'sellpricepp');
			//	echo "<pre>";print_r($results);exit;
				
				
				$this->layouts->view('available_flights_view1',$results);
			}
			else
			{
				redirect(base_url());
			}				
		}
		else
		{			
			redirect(base_url());
		}		
	}
	
	/*
	 * Full package for flights availability
	 */
	
	public function loadFlightDataFun($service_url,$u_selected_date,$row)
	{		
		$data= array();$results=array();
		$results['controller']=$this;		
		$results['suppliers_list'] = dept_images();
		//$this->cache->delete($service_url);
		
			$count = 0;$flex = 3;
			$results['departures'] = $this->fetch_departures();
			$results['arrivals'] = $this->fetch_arrivals();
			// Future To-do :  Here Please check weather "selected_date" should more than current date otherwise 404 page
		
			$req_url = $service_url;
			
			$data['results'] = new SimpleXMLElement($this->download_page($req_url));
			
			$search_dates=array();$best_price = 0;
			//if(empty($this->cache->get($service_url)))
			//{
				if($data['results']->attributes()->offers > 0)
				{
					$coded_date = json_decode(json_encode($data['results']),true);
					$this->search_upto_flex_days($coded_date,$u_selected_date,$flex,$search_dates);
					$search_dates[$u_selected_date]['offers_list'] = $coded_date['offer'];
					if($cdate_bp = $this->best_price_date_wise_fun($coded_date['offer']))
					{		
						$search_dates[$u_selected_date]['best_price'] = $cdate_bp;
					}		
				}
				else
				{
					redirect(base_url());
				}
			//	$this->cache->save($service_url,$search_dates, 3600);
			//}
			//else{
			//	$search_dates = $this->cache->get($service_url);
			//}
			$list_min = array_column($search_dates, 'best_price');
		
			if(!empty($list_min))
			{
				$best_price = min($list_min);
					
				$results['dates_list']=array_keys($search_dates);
				usort($results['dates_list'], array($this,"sortFunction"));
				$count=0;
		
				//Variables
				$dept_take_offs=array();
				$return_take_offs=array();
				$results['fly_from'] = array();
				$results['flight_operators'] = array();
				//End - Varibles
		
				foreach($search_dates as $key_date => $value_date)
				{
					if(@$value_date['best_price'] == $best_price && $count < 1)
					{
						//Sort by best price
						usort($search_dates[$key_date]['offers_list'], function($a, $b) {
							return $a['@attributes']['sellpricepp'] > $b['@attributes']['sellpricepp'] ? 1 : -1;
						});
						//END - Sort by best price
		
							$results['flights_list'] = $search_dates[$key_date];
							$results['selected_date'] = $key_date;
							$count++;
					}
		
					if(!empty(@$value_date['offers_list']))
					{
		
						foreach ($value_date['offers_list'] as $offer)
						{
							//$flight_suppliers[$offer['@attributes']['suppname']] = $offer['@attributes']['suppcode'];
							$dept_take_offs[] =  (int)substr(explode(' ',$offer['@attributes']['outdep'])[1],0,2);
							$return_take_offs[] = (int)substr(explode(' ',$offer['@attributes']['indep'])[1],0,2);
		
							// Listing departure airport list
							if(!in_array($offer['@attributes']['depapt'], $results['fly_from'])){
								$results['fly_from'][$offer['@attributes']['depapt']]=explode(' - ',$results['departures'][$offer['@attributes']['depapt']])[0];
								$results['fly_from_best_prices'][$offer['@attributes']['depapt']] = $value_date['best_price'];
							}
							// END - Listing departure airport list
		
							// Listing flight operator list
							if(!in_array($offer['@attributes']['suppcode'], $results['flight_operators'])){
		
								$results['flight_operators'][$offer['@attributes']['suppcode']]=$results['suppliers_list'][$offer['@attributes']['suppcode']];
							}
							// END - Listing flight operator list	
						}
						$results['num_of_flights'][$key_date] = count(@$value_date['offers_list']);
						$results['best_prices_dates_wise'][$key_date] = '&#163;'.@$value_date['best_price'];
					}
					else
					{
						$results['num_of_flights'][$key_date] = 0;
						$results['best_prices_dates_wise'][$key_date] = '&#163;N/A';
					}
				}
		
				// Filter populators
				$results['dept_take_offs_min'] = min($dept_take_offs);
				$results['dept_take_offs_max'] = max($dept_take_offs)+1; // Remember : Take a look while max gretaer than 23 hours
				$results['return_take_offs_min'] = min($return_take_offs);
				$results['return_take_offs_max'] = max($return_take_offs)+1;
				//END - Filter Populators
				//	print_r($results);exit;
				if(!$count)
				{
					$results['flights_list'] = $search_dates[$u_selected_date];
					$results['selected_date'] = $u_selected_date;
				}
		
				
				$parts = parse_url($service_url);
				parse_str($parts['query'], $query);
				$results['change_search_info']['query'] = $query;
				$results['change_search_info']['row'] = $row[0];
				
				$results['fcls'] = 'current';
				$results['hcls'] = '';
				$results['ecls'] = '';
				$results['bcls'] = '';
				$results['f_done'] = '';
				$results['h_done'] = '';
				$results['e_done'] = '';
				$results['b_done'] = '';
				
				/************fetching departure airports**************/
				changeSearch($results);
				/******************end***********/
				
				$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
				'css/jquery-ui.css','css/font-awesome.min.css',
				'css/google_font.css','css/custom.css','css/responsive.css',
				'css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css',
				'css/flight_result.css','css/jquery.fancybox.css','css/style.css','css/popup_fancy.css',
				'js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js',
				'js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js',
				'js/jquery.fancybox.pack.js','js/script.js'));
		$this->layouts->set_title('Search Page');
				$this->layouts->view('available_flights_view1',$results);
			}
			else
			{
				redirect(base_url());
			}
		
	}
	
	public function fullFlightsavailable($id=null)
	{	
		$this->load->model('FullSearch');
		$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)));
		
		if(!empty($rows))
		{
			$parts = parse_url($rows[0]['service_url']);
			parse_str($parts['query'], $query);						
			$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=3&depapt=".$query['depapt']."&arrapt=".$rows[0]['arapts']."&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&flex=".$query['flex']."&depdate=".$query['depdate']."";
			$this->loadFlightDataFun($url,$query['depdate'],$rows);
		}	
		else
		{
			redirect(base_url());
		}
	}
	
	
	public function filter_flights_fun()
	{
		if($this->input->post())
		{
			
			$obj_chkval = $this->input->post('checkedValues');		
			
			//$search_dates = $this->raw_flights_fun($this->input->post('crypt'));
			
			
			/*********************/
			if($this->input->post('searchType') == 'flight_date')
			{
				$rows = $this->UserSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')));
				if(!empty($rows))
				{				
					$search_dates = $this->raw_flights_pred_fun($this->input->post('crypt'),$rows[0]['service_url'],$rows[0]['selected_date']);
				}
			}
			else if($this->input->post('searchType') == 'full_flight_date')
			{
				$this->load->model('FullSearch');
				$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')));
				if(!empty($rows))
				{
					$parts = parse_url($rows[0]['service_url']);
					parse_str($parts['query'], $query);
					$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=3&depapt=".$query['depapt']."&arrapt=".$rows[0]['arapts']."&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&flex=".$query['flex']."&depdate=".$query['depdate']."";
					$search_dates = $this->raw_flights_pred_fun($this->input->post('crypt'),$url,$query['depdate']);
				}
					
			}		
			/*****************************************/
			if(!empty($search_dates))
			{	
				
				$cvals_departures = $obj_chkval['departures'];
				$cvals_operators = $obj_chkval['operators'];				
				
				$time_str = explode(' - ',$this->input->post('deptRange'));
				$start_dept = (int)$time_str[0];
				$end_dept = (int)$time_str[1];
				
				$time_str_ret = explode(' - ',$this->input->post('returnRange'));
				$start_return = (int)$time_str_ret[0];
				$end_return = (int)$time_str_ret[1];	
				$results_filtered_by_time = array();
				foreach($search_dates as $key_date => $search_date)
				{
					//$results_filtered_by_time[$key_date] = $this->iterative_dates_fun($search_date,$start_dept,$end_dept,$start_return,$end_return,$cvals_departures,$cvals_operators);
					$results_info = $this->iterative_dates_fun($search_date,$start_dept,$end_dept,$start_return,$end_return,$cvals_departures,$cvals_operators);
					if($key_date == $this->input->post('date'))
					{
						if(isset($results_info['list']))
						{
						usort($results_info['list'], function($a, $b) {
							return $a['@attributes']['sellpricepp'] > $b['@attributes']['sellpricepp'] ? 1 : -1;
						});
						}
						$results_filtered_by_time = $this->filter_given_content_fun(@$results_info['list'],$this->input->post('searchType'),(int)$this->input->post('page'),$this->input->post('crypt'));
						
					}
					$filtered_tab_populates['num_flights'][$key_date] = (count(@$results_info['list'])) ? count(@$results_info['list']) : 0;
					$filtered_tab_populates['best_prices'][$key_date] = (count(@$results_info['prices'])) ? min(@$results_info['prices']) : 'N/A';
				}				
				echo json_encode(array($results_filtered_by_time,$filtered_tab_populates));exit;
			}
		}			
	}
	
	public function iterative_dates_fun($search_date,$start_dept,$end_dept,$start_return,$end_return,$cvals_departures,$cvals_operators)
	{
		//echo '<pre>';print_r($search_date);exit;
		$results_filtered_by_time = array();
		if(count($cvals_departures) == 1 && $cvals_departures[0] == 'ALL')
		{
			if(count($cvals_operators) == 1 && $cvals_operators[0] == 'ALL')
			{
				if(isset($search_date['offers_list']))
				{
					foreach ($search_date['offers_list'] as $row)
					{
						$check_time = (int)substr(explode(' ',$row['@attributes']['outdep'])[1],0,2);
						$check_return_time = (int)substr(explode(' ',$row['@attributes']['indep'])[1],0,2);
						if(($check_time >= $start_dept && $check_time < $end_dept) && ($check_return_time >= $start_return && $check_return_time < $end_return))
						{
							$results_filtered_by_time['list'][] = $row;
							$results_filtered_by_time['prices'][] = $row['@attributes']['sellpricepp'];						
						}
					}
				}
			}
			else
			{
				foreach ($cvals_operators as $operator)
				{
				   if(isset($search_date['offers_list']))
				   {
					foreach ($search_date['offers_list'] as $row)
					{
						if($row['@attributes']['suppcode'] == $operator)
						{
							$check_time = (int)substr(explode(' ',$row['@attributes']['outdep'])[1],0,2);
							$check_return_time = (int)substr(explode(' ',$row['@attributes']['indep'])[1],0,2);
							if(($check_time >= $start_dept && $check_time < $end_dept) && ($check_return_time >= $start_return && $check_return_time < $end_return))
							{
								$results_filtered_by_time['list'][] = $row;
								$results_filtered_by_time['prices'][] = $row['@attributes']['sellpricepp'];	
							}
						}
					}
				  }
				}
			}			
		}
		else
		{
				
			if(count($cvals_operators) == 1 && $cvals_operators[0] == 'ALL')
			{
				if(isset($search_date['offers_list']))
				{
				  foreach ($search_date['offers_list'] as $row)
				  {
					foreach($cvals_departures as $departure)
					{
						if($row['@attributes']['depapt'] == $departure)
						{
							$check_time = (int)substr(explode(' ',$row['@attributes']['outdep'])[1],0,2);
							$check_return_time = (int)substr(explode(' ',$row['@attributes']['indep'])[1],0,2);
							if(($check_time >= $start_dept && $check_time < $end_dept) && ($check_return_time >= $start_return && $check_return_time < $end_return))
							{
								$results_filtered_by_time['list'][] = $row;
								$results_filtered_by_time['prices'][] = $row['@attributes']['sellpricepp'];	
							}
						}
					}
				  }
				}
			}
			else{
				if(isset($search_date['offers_list']))
				{
				  foreach ($search_date['offers_list'] as $row)
				  {
					foreach($cvals_departures as $departure)
					{
						foreach ($cvals_operators as $operator)
						{
							if(($row['@attributes']['depapt'] == $departure) && ($row['@attributes']['suppcode'] == $operator))
							{
								$check_time = (int)substr(explode(' ',$row['@attributes']['outdep'])[1],0,2);
								$check_return_time = (int)substr(explode(' ',$row['@attributes']['indep'])[1],0,2);
								if(($check_time >= $start_dept && $check_time < $end_dept) && ($check_return_time >= $start_return && $check_return_time < $end_return))
								{
									$results_filtered_by_time['list'][] = $row;
									$results_filtered_by_time['prices'][] = $row['@attributes']['sellpricepp'];	
								}
							}
						}
					}
				  }
				}
			}
		}
		return $results_filtered_by_time;
	}
	
	public function filter_given_content_fun($response,$type,$page,$crypt=null)
	{
		$result = array();$html='';$pageHtml='';
		$start = (($page-1)*10)-1;
		$start = ($start < 0) ? 0 : $start;
		$departures = ( !$this->cache->get('departures')) ? (($this->cache->save('departures', $this->fetch_departures(), 3600)) ? $this->cache->get('departures') : array() ) : $this->cache->get('departures');
		$arrivals = ( !$this->cache->get('arrivals')) ? (($this->cache->save('arrivals', $this->fetch_arrivals(), 3600)) ? $this->cache->get('arrivals') : array() ) : $this->cache->get('arrivals');
		
		$suppliers_list = array(
				'AVRO' => '/images/AVROF.gif',
				'EJET' => '/images/EASYJET.gif',
				'NFFT' => '/images/NORWAIR.jpg',
				'MNFT' => '/images/FLYM.gif',
				'EJFT' => '/images/AVROF.gif',
				'MONA' => '/images/FLYM.gif',
				'MNNF' => '/images/MNNF.gif',
				'NORW' => '/images/NORWAIR.jpg',
				'EJNF' => '/images/EJNF.gif',
				'FLTH' => '/images/THOMASCOOK.png',
				'TFFT' => '/images/THOMSON.gif',
				'FTNF' => '/images/FTNF.gif',
				'TFNF' => '/images/TFNF.gif',
				'THFL' => '/images/THFL.gif',
				'TOHO' => '/images/TOHO.gif',
				'RYAT' => '/images/logo_ryan_txt.png',
				'JET2' => '/images/JET2.gif',
				'AERL' => '/images/AERL.gif',
				'EJTF' => '/images/EJTF.gif',
				'NFTF' => '/images/NFTF.gif'
		
		);
		
		//ordering keys
		if(!empty($response))
		{
			$iOne = array_combine(range(0, count($response)-1), array_values($response));
		}
		//END -  Ordeing keys
		for($i=$start;$i<$start+10;$i++)
		{
			if(isset($iOne[$i])){
		
				$flight_obj = $iOne[$i];
				$plain_txt = json_encode($flight_obj);
				$encrypted_txt = $this->encrypt_decrypt('encrypt', $plain_txt);
				$dscode = $flight_obj['@attributes']['depapt'];
				$ascode = $flight_obj['@attributes']['arrapt'];
				$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
				$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',$arrivals[(string)$ascode])[0]);
				$dscode = trim(explode('-',$departures[(string)$dscode])[0]);
		
				$dept_start_time = substr(explode(' ',$flight_obj['@attributes']['outdep'])[1],0,-3);
				$dept_arr_time = substr(explode(' ',$flight_obj['@attributes']['outarr'])[1],0,-3);
				$return_start_time = substr(explode(' ',$flight_obj['@attributes']['indep'])[1],0,-3);
				$return_arr_time = substr(explode(' ',$flight_obj['@attributes']['inarr'])[1],0,-3);
		
				$html .= '<div id="divShowWhenSelect_1" class="flightresult">
				                      <div class="clearfix">
				                    	<div class="flight_info clearfix">
				                          <div class="fluid zeroMargin_desktop flight_depart"> <strong class="txt_color_2"><i class="fa fa-plane icon_flightdepart" aria-hidden="true"></i>Depart</strong><br>
				                       	 	<div><!-- <img id="cphContent_lvDatePlus3_imgRightlogo_0" src="'.@$suppliers_list[$flight_obj['@attributes']['suppcode']].'" style="border: 0;">-->
				                              <div style="float: right"> </div>
				                            </div>
				                        	<strong>'.date('l d M Y',$this->cvtDt($flight_obj['@attributes']['outdep'])).'</strong><br>
				                        	<input name="ctl00$cphContent$lvDatePlus3$ctrl0$hdOriginalOperatorCode" id="cphContent_lvDatePlus3_hdOriginalOperatorCode_0" value="13" type="hidden">
				                       		<small>'. $dscode.' to '.$ascode.' '.$dept_start_time.'/'.$dept_arr_time.'</small><br>
				                        	<span class="txt_color_2"> </span> </div>
				                          	<div class="fluid flight_return"> <strong class="txt_color_2"><i class="fa fa-plane icon_flightreturn" aria-hidden="true"></i>Return</strong><br>
				                        		<div> <!--<img id="cphContent_lvDatePlus3_imgReturnFlightLogo_0" src="'.@$suppliers_list[$flight_obj['@attributes']['suppcode']].'" style="border: 0;">--> </div>
						                        <strong>'.date('l d M Y',$this->cvtDt($flight_obj['@attributes']['indep'])).'</strong><br>
						                        <small>'.$ascode.' to '.$dscode.' '.$return_start_time.'/'.$return_arr_time.'</small><br>
						                        <span class="txt_color_2"> </span>
						                    </div>
				                          	<div class="clear flight_bags">
				                        		<small> <span id="cphContent_lvDatePlus3_lblBaggageDepartPrice_0"></span> </small>
				                      		</div>
				                          </div>
						                  <div class="fluid flight_price clearfix">
						                          <div class="flight_cost"> <strong class="txt_color_1 txt_large"> <span id="cphContent_lvDatePlus3_lblTotalPrice_0">&#163;'.$flight_obj['@attributes']['sellpricepp'].'</span></strong><small class="txt_color_1">pp</small><br>
						                        <small> <span id="cphContent_lvDatePlus3_lblBaggageReturnPrice_0" class="luggage_label"></span> </small> </div>
						                          <div class="flight_button center"> <span id="cphContent_lvDatePlus3_lblPriceInfo_0"></span> <a  id="cphContent_lvDatePlus3_ibtnAddFlightToBasket_0" class="button"  style="margin-top: 5px;" onclick=Addflight("'.$type.'","'.$encrypted_txt.'","'.$crypt.'")>ADD <i class="fa fa-plus-circle" aria-hidden="true"></i> </a> </div>
						                        </div>
						                  </div>
				                   </div>';
				//onclick=Addflight("'.$type.'","'.$encrypted_txt.'","'.$crypt.'")
			}
		}
		
		$result['status'] = 'success';
		if(!empty($response))
		{				
			$res_count = count($response);		
			if((($type == 'flight_date') || ($type == 'full_flight_date')) && $res_count > 10)
			{
				$num_pages = ($res_count%10)? ($res_count/10)+1 : $res_count/10;
				$pageHtml .= '<span>Page: </span><span  class="pager_list_pages">';
			//	$pageHtml .= '<a class="aspNetDisabled">&lt;</a>&nbsp;';
				for($i=1;$i<=$num_pages;$i++)
				{
					if($i==$page)$pageHtml .= '<span>'.$i.'</span>';
					else $pageHtml .= '<a class="pagerhyperlink">'.$i.'</a>';
				}
				//$pageHtml .= '<a class="pagerhyperlink">&gt;</a>&nbsp;';
				$pageHtml .= '</span>';
			}
		}
		else
		{
			$html .= '<div> <strong class="txt_color_2">Sorry! No Flights Available</strong><br> Please select an alternative date
                      </div>';
		}
		
		$result['data'] = $html;
		$result['pages_data'] = $pageHtml;
		return $result;
	}
	
	
	
	public function raw_flights_pred_fun($hash,$req_url,$selected_date,$flex=3)
	{
		$search_dates=array();
		if(empty($this->cache->get($hash)))
		{							
				$data['results'] = new SimpleXMLElement($this->download_page($req_url));
				if($data['results']->attributes()->offers > 0)
				{
					$coded_date = json_decode(json_encode($data['results']),true);
					$this->search_upto_flex_days($coded_date,$selected_date,$flex,$search_dates);
					$search_dates[$selected_date]['offers_list'] = $coded_date['offer'];
					$search_dates[$selected_date]['best_price'] = $this->best_price_date_wise_fun($coded_date['offer']);
				}
				$this->cache->save($hash,$search_dates,3600);			
		}
		else{
			$search_dates = $this->cache->get($hash);
		}
		return $search_dates;
	}
		
		
	
	public function best_price_date_wise_fun($list)
	{
		$array_for_best_price = array();
		foreach($list as $row)
		{
			$array_for_best_price[] = $row['@attributes']['sellpricepp'];
		}
		return @min($array_for_best_price);
	}
	
	public function sortFunction( $a, $b ) {		
		return $this->cvtDt($a) - $this->cvtDt($b);
	}	
	
	
	public function cvtDt($date)
	{
		return strtotime(str_replace('/','-',$date));				
	}
	
	public function notavailable()
	{		
		$data = array();
		$data['message'] = '<h5 class="text-one">Bristol - Cyprus (Search all) | 1 Nights | November 20 2015 | All Inclusive | Any Rating Star | 2 Adults, 0 Children, 0 infant | 1 Rooms</h1>'; 
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/custom.css','css/responsive.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/inner-page.css','js/responsee.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('No Results Page');
		$this->layouts->view('notavailable',$data);
	}
	
	public function search_upto_flex_days(&$req_url_raw,$provided_date,$flex=3,&$data)
	{
		
		static $decr=0;
		static $incr=0;		
		$date = DateTime::createFromFormat('d/m/Y', $provided_date);
		if( $incr == 0 && strtotime(str_replace('/','-',$provided_date)) > strtotime(date('d-m-Y')))
		{
			if($decr == $flex){				
				$provided_date = $date->modify('+'.($decr + 1).' day')->format('d/m/Y');				
				$incr++;
			}
			else{
				
				$provided_date = $date->modify('-1 day')->format('d/m/Y');							
				$decr++;
			}
		}
		else
		{
			if($incr)$flag=0;else $flag=$decr;		
			$provided_date = $date->modify('+'.($flag + 1).' day')->format('d/m/Y');			
			$incr++;
		}
			if(key($req_url_raw['offer']) === '@attributes')
			{
			//echo '<pre>';print_r(key($req_url_raw['offer']));exit;
				$req_url_raw['offer'][0]['@attributes'] = $req_url_raw['offer']['@attributes'];				
				unset($req_url_raw['offer']['@attributes']);
				
			}
			
	
			$this->pushDateDataFun($req_url_raw['offer'],$provided_date,$data);	
			
			if(($decr+$incr) == 2*$flex) return $data;
		
		return $this->search_upto_flex_days($req_url_raw,$provided_date,$flex,$data);
	}
	
	public function pushDateDataFun(&$req_url_raw,$provided_date,&$data)
	{		
		$array_for_best_price = $margin_row = array();
		$this->load->model('Options');
		$margin_row = $this->Options->fetch_a_fields(array(),1);
		
		foreach($req_url_raw as $key => $row)
		{		
			if($provided_date == explode(' ',$row['@attributes']['outdep'])[0])
			{				
				//margins - start
				$row['@attributes']['sellpricepp'] = $row['@attributes']['sellpricepp'] + @$margin_row[0]['flight_rate'];
				$row['@attributes']['netpricepp'] = $row['@attributes']['netpricepp'] + @$margin_row[0]['flight_rate'];
				//end
				
				
				
				$array_for_best_price[] = $row['@attributes']['sellpricepp'];
				$data[$provided_date]['offers_list'][] = $row;
				unset($req_url_raw[$key]);		
			}			
		}
		
		if(@min($array_for_best_price))$data[$provided_date]['best_price'] = @min($array_for_best_price);
		else $data[$provided_date]['best_price'] = 10000; // Bad one
	}
	
	
	
	public function arrival_list_basedon_dynaminc_departuere_airport()
	{		
		$results = array();$string = '';
		$this->load->model ( 'Arrivals' );
		$arr_rows_cat_wise = $this->Arrivals->fetchArrivalsByCategory();
		
		foreach($arr_rows_cat_wise as $key => $val)
		{
			$results[$val['name']][$val['arapts']][] = $val['name_resort'];
			$results[$val['name']][$val['arapts']][] = $val['map_root'];
			//$results[$val['name']][$val['map_root']] = $val['name_resort'];
		}
		
			
		$string .= '<option value="-1">Select Destination</option>';
		foreach($results as $key => $val)
		{
			$string .= '<option value="-1" style="font-weight:bold;color:red;">'.strtoupper($key).'</option>';
			foreach ($val as $key1 => $val1)
			{		
				$string .= '<option mapper='.$val1[1].' value='.$key1.' >'.$val1[0].'</option>';
				continue;				
			}
		}
		if(!$this->input->post())return $string;
		echo $string;exit;
	}
	
	
	/*public function arrival_list_basedon_dynaminc_departuere_airport()
	{		
		echo "<pre>";print_r($this->input->post());exit; 
		return fetchingArrivalsByDestination($this);
	}*/
	
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
	
	
	public function aboutus()
	{		
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('About Us');
		$this->layouts->view('aboutus');
	}
	
	public function cheapHolidays()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('Cheap Holidays');
		$this->layouts->view('cheap_holidays');
	}
	
	public function allinclusiveholidays()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('All Inclusive Holidays');
		$this->layouts->view('allinclusiveholidays');
	}
	public function lastminuteholidays()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('All Inclusive Holidays');
		$this->layouts->view('lastminuteholidays');
	}
	public function summerholidays()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('Summer Holidays');
		$this->layouts->view('summerholidays');
	}
	
	public function winterholidays()
	{
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('Winter Holidays');
		$this->layouts->view('winterholidays');
	}
	public function subscribe()
	{
		if ($this->input->post ()) {			
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'fname', 'First Name', 'trim|required' );
			$this->form_validation->set_rules ( 'lname', 'Last Name', 'trim|required' );			
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'zipcode', 'Zip Code', 'trim|required|numeric' );			
			if (! $this->form_validation->run ()) {		
				$errors = array();
				// Loop through $_POST and get the keys
				foreach ($this->input->post() as $key => $value)
				{
					// Add the error message for this field
					$errors[$key] = form_error($key,'<div class="error">', '</div>');
				}
				$response['errors'] = array_filter($errors);
				echo json_encode($response);
			} else {
				$this->load->model('SubscribersList');
				if($this->SubscribersList->createRecord($this->input->post ())){
					//emailFunction($this,$this->input->post('subject'),$this->input->post('comments'),$this->input->post ('email'),$this->input->post ('fname'))
					//$body = "Thank you for getting in touch with us..";
					echo json_encode(array('success' => 'Thank you for getting in touch with us..'));
				}
				else{
					echo json_encode(array('success' => 'Sorry,Some thing went wrong'));
				}
				
			}
			exit;
		}
		
	}
	public function contactUs()
	{
		if ($this->input->post ()) {
			
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'name', 'Name', 'trim|required' );
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'subject', 'Subject', 'trim|required' );
			$this->form_validation->set_rules ( 'comments', 'Comments', 'trim|required' );
			if (! $this->form_validation->run ()) {
			} else {
				$this->load->model('ContactsList');
				if($this->ContactsList->createRecord($this->input->post ())){
					$list = array(CONTACTSADMINEMAIL);
					if(emailFunction($this,$this->input->post('subject'),$this->input->post('comments'),$this->input->post ('email'),$this->input->post ('name'),$list))
                	{
                		$this->session->set_flashdata ( 'message', '<p class="success">Thank you for contact us,We will reach you soon</p>' );
                    }
                    else
                    {
                    	$this->session->set_flashdata ( 'message', '<p class="success">Thank you for contact us,We will reach you soon...</p>' );
                    }
                    redirect(base_url().'welcome/contactUs');
				}
			}
		}
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('Winter Holidays');
		$this->layouts->view('contactus');
	}
	
	public function price_promise()
	{	
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('price promise');
		$this->layouts->view('price_promise');
	}
	
	public function terms_of_use()
	{	
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script.js'));
		$this->layouts->set_title('terms of use');
		$this->layouts->view('terms_of_use');
	}
	
	
	//Encription & decryption function
	function encrypt_decrypt($action, $string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';
		$key = hash('sha256', $secret_key);
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
	    if( $action == 'encrypt' ) {
				$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
				$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
				$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
	
	function saveflight_fun()
	{
		if($this->input->post())
		{
			if ($this->input->post('searchType') == 'full_flight_date')
			{
				$fobj = $this->encrypt_decrypt('decrypt',$this->input->post('crypt_text'));
				$this->load->model('PhaseFlightOrHotel');
				$this->load->model('PhaseSavingsNExtras');
				$this->load->model( 'FullSearch' );		
				$this->load->model( 'BookingInfo' );
				
				if(!empty($row = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')))))
				{
					$isexist = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>$this->input->post('searchType'),'full_pack_id'=>$row[0]['id']));
					if(!empty($isexist))
					{	
						$udata = array('type_search' => 'full_flight_date',
								'pack_info' => $fobj,
								'flight_selected_date' => $this->input->post('dt')
						);
						if($this->PhaseFlightOrHotel->updateSearch($udata,$isexist[0]['id']))
						{
						 	if($this->FullSearch->update_row(array('search_position'=>'full_flight_date'),$row[0]['id']))
						 	{
						 		$this->PhaseFlightOrHotel->deleteRow($row[0]['id'],'pack_hotel');
						 		$this->PhaseSavingsNExtras->deleteRow($row[0]['id']);
						 		$this->BookingInfo->deleteRow($row[0]['id']);
						 		echo base_url()."HotelsAvailability/".$this->input->post('crypt');
						 	}
						 	else
						 	{
						 		echo 'notavailable';
						 	}
						 }
						 else
						 {
						 	echo 'notavailable';
						 }
					}
					else 
					{
						if($this->PhaseFlightOrHotel->createSearch($fobj,$this->input->post('searchType'),$row[0]['id'],$this->input->post('dt')))
						 {
						 	if($this->FullSearch->update_row(array('search_position'=>'full_flight_date'),$row[0]['id']))
						 	{
						 		echo base_url()."HotelsAvailability/".$this->input->post('crypt');
						 	}
						 	else
						 	{
						 		echo 'notavailable';
						 	}
						 }
						 else
						 {
						 	echo 'notavailable';
						 }
					}
				}
				
			}
		else{
				$fobj = encrypt_decrypt('decrypt',$this->input->post('crypt_text'));
				//$this->load->model( 'BookingInfo' );
				
				if(!empty($row = $this->UserSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')))))
				{					
					$udata = array(
							'pack_info' => $fobj,
							'selected_date' =>$this->input->post('dt')
					);
					if($this->UserSearch->update_row($udata,$row[0]['id']))
					{
						echo base_url().'book_flight/'.$this->input->post('crypt');
					}
					else
					{
						echo 'notavailable';
					}					
				}
				
			}
			exit;
		}
	}
	
	
	public function adminLogin(){
		if ($this->input->post ()) {
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'password_hash', 'Password', 'trim|required|min_length[3]' );
			if (! $this->form_validation->run ()) {
			} else {
				$_POST ['password_hash'] = md5 ( $this->input->post ( 'password_hash' ) );
				if ($row = $this->User->fetch_a_user ( $this->input->post () )) {
					$newdata = array (
							'id' => $row [0] ['id'],
							'email' => $row [0] ['email'],
							'name' => $row[0]['first_name'].' '.$row[0]['last_name'],
							'logged_in' => TRUE 
					);
					$this->session->set_userdata ( $newdata );
					redirect ( base_url () . 'admin/index' );
				} else {
					$this->session->set_flashdata ( 'message', 'Sorry,Invalid credentials' );
					redirect ( base_url () . 'admin/' );
				}
			}
		}
		$this->layouts->add_include ( array (
				'css/login.css',
				'css/font-awesome.min.css' 
		) );
		$this->layouts->set_title ( 'Admin Login' );
		$this->layouts->view ( 'admin/login',array(),'login' );
	}
	public function forgot_pwd() {
		$this->layouts->add_include ( array (
				'css/login.css',
				'css/font-awesome.min.css'
		) );
		if($this->input->post()){
			$this->load->library ( 'form_validation' );
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			
			if (! $this->form_validation->run ()) {
			} else {
				$n = $this->User->fetch_a_user(array('email'=>$this->input->post('email')));				
				if(!empty($n)){
					$info['flag'] = $this->randStrGen(30);
					if($this->User->updateUser($info,'email',$this->input->post('email')))
					{	
						$subject = "Password Reminder";
						$body = 'Hi '.$n[0]['first_name'];
						$body .= '<br> Bellow is your reset link of book it now acount access.<br>';
						$body .= 'Link : '.base_url().'welcome/resetPassword/'.$info['flag'];
						$body .= '<br>Yours Thankfully,<br>BookItNow Admin';
						$list = array($this->input->post('email'));
						$this->session->set_flashdata ( 'message', '<p class="success">We sent reset password link to your email.Please check it.</p>' );
						redirect(base_url().'admin');
						//emailFunction($this,$subject,$body,BOOKINGADMINEMAIL,'Admin',$list);
						
					}
				}
				else{
					$this->session->set_flashdata ( 'message', '<p class="warning">Sorry,given email is not existed in our database.</p>' );
					redirect(base_url().'welcome/forgot_pwd');
				}
				
				
			}
			
			
			
			//$info['e']
			//echo "<pre>";print_r();exit;
		}
		$this->layouts->set_title ( 'Forgot Password' );
		$this->layouts->view ( 'admin/forgot',array(),'login' );
	}	
	
	public function randStrGen($len){
		$result = "";
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$charArray = str_split($chars);
		for($i = 0; $i < $len; $i++){
			$randItem = array_rand($charArray);
			$result .= "".$charArray[$randItem];
		}
		return $result;
	}
	
	public function resetPassword($flag)
	{
		if($flag == ''){
			redirect(base_url());
		}
		else{
			$data = array();
			$data['flag'] = $flag;
			$this->layouts->add_include ( array (
					'css/login.css',
					'css/font-awesome.min.css'
			) );
			if($this->input->post()){
				//echo "<pre>";print_r($this->input->post());exit;
				$this->load->library ( 'form_validation' );
				$this->form_validation->set_rules ( 'password', 'Password', 'trim|required|matches[confirm_password]' );
				$this->form_validation->set_rules ( 'confirm_password', 'Confirm Password', 'trim|required' );
				if (! $this->form_validation->run ()) {
				} else {
					$n = $this->User->fetch_a_user(array('flag'=>$flag));
					if(!empty($n)){
						$info['password_hash'] = md5($this->input->post('password'));
						if($this->User->updateUser($info,'flag',$flag)){
							$this->session->set_flashdata ( 'message', '<p class="success">Your password have been reset successfully.</p>' );
						}
					}
					else{
						
						$this->session->set_flashdata ( 'message', '<p class="error">Sorry, We are unable to update your password.</p>' );
						redirect(base_url().'admin');
					}
				}
			}
			
			$this->layouts->set_title ( 'Reset Password' );
			$this->layouts->view ( 'admin/reset',$data,'login' );		
		}	
	}
	
	public function bulkSubmit(){
		
		if($this->input->post()){
			$postData = $this->input->post();			
		//	echo "<pre>";print_r($postData['mformData']['Fly_From']);exit;
			$subject = 'Bulk Booking Request';
			$body = 'Hi';$search = '';
			$body .= '<br/><p>The following user requesting for bulk booking</p><br/>';
			$in_user_arr = array('email','first_name','mobile');
			$db_data = array();
			foreach ($postData['bformData'] as $uinfo){
				if($uinfo['value'] != '')				
				if(in_array($uinfo['name'],$in_user_arr)){
					$body .= '<b>'.ucfirst(str_replace("_"," ",$uinfo['name'])).'</b> : '.$uinfo['value'].'<br>';
				}
				else{
					$search .= '<b>'.ucfirst(str_replace("_"," ",$uinfo['name'])).'</b> : '.$uinfo['value'].'<br>';
				}
				
				if($uinfo['name'] == 'email')$from = $uinfo['value'];
				if($uinfo['name'] == 'first_name')$sendername = $uinfo['value'];
				if($uinfo['name'] == 'fly_from' && is_numeric($uinfo['value'])){
					
				}
				else{
					$db_data[$uinfo['name']] = $uinfo['value'];
				}
				
			}
			$body .= '<p>Here is the search information :</p><br/>';
			$body .= $search;
			/*foreach ($postData['mformData'] as $key => $sinfo){				
				$body .= '<b>'.str_replace("_"," ",$key).'</b> : '.$sinfo.'<br>';
			}*/		
			$body .= '<p>Regards</p><p>BookItNow Admin</p>';
			$this->load->model('BulkBooking');
			$this->BulkBooking->createRecord($db_data);
			//emailFunction($this,$subject,$body,$from,$sendername,array(BOOKINGADMINEMAIL));
		//	echo json_encode(array('status'=>'success','message'=>$body));exit;
			echo json_encode(array('status'=>'success','message'=>'Thank you,We will contact you soon'));exit;
		}		
	}	
}
