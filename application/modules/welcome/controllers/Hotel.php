<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

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
		$this->load->helper(array('url','common'));
		$this->load->model('UserSearch');		
	}
	

	
	public function fetch_filtered_hotels()
	{
	
		if($this->input->post())	{
			$post_data = $this->input->post();
			
			if(strtotime(str_replace('/', '-', $this->input->post('hotel_check_in_date'))) < strtotime(date('d-m-Y')))
			{
				echo '<span class="status expired">Expired</span>';exit;
			}
			$data['result'] = array();$flex = 0;$allow = 0;
			$splt_cont_reg = explode('-',$this->input->post('mapper'));
			
			$post_data['hotel_childrens'] = ($this->input->post('hotel_childrens') != -1) ? $this->input->post('hotel_childrens') : 0;
			if(isset($post_data['pax']))
			{
				$paxes_str = explode(',',substr($post_data['pax'],0,-1));
				$paxes = array_unique($paxes_str);
				$count = 0;
				$service_url = '';
				foreach ($paxes as $pax)
				{
					$service_url_str = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$post_data['hotel_nights']."&maxstay=".$post_data['hotel_nights']."&depdate=".$post_data['hotel_check_in_date']."&flex=".$flex."&countryid=".$splt_cont_reg[0]."&regionid=".$splt_cont_reg[1]."&areaid=".$splt_cont_reg[2]."&resortid=&boards=&rating=&pax=".$pax."&offersperday=100";
					//echo $service_url_str;exit;
					$results = new SimpleXMLElement($this->download_page($service_url_str));
					if($results->attributes()->offers > 0)
					{
						$count++;
						$service_url .= $service_url_str.',';
					}
				}
				if($count == count($paxes))
				{
					$post_data['pax'] = substr($post_data['pax'],0,-1);
					$allow = 1;
				}
			}
			else
			{
				$post_data['pax'] = '';
				$service_url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$post_data['hotel_nights']."&maxstay=".$post_data['hotel_nights']."&depdate=".$post_data['hotel_check_in_date']."&flex=".$flex."&countryid=".$splt_cont_reg[0]."&regionid=".$splt_cont_reg[1]."&areaid=".$splt_cont_reg[2]."&resortid=&boards=&rating=&pax=".$post_data['hotel_adults']."-".$post_data['hotel_childrens']."&offersperday=100";
				$results = new SimpleXMLElement($this->download_page($service_url));
				if($results->attributes()->offers > 0)
				{
					$allow = 1;
				}
			}
			
			if($allow)
			{
				$this->load->model( 'UserSearch' );
				$data = array('service_url' => $service_url,
						'type_search' => 'hotel_only',
						'selected_date' => $post_data['hotel_check_in_date'],
						'pax' => $post_data['pax'],
						'num_adults' => $post_data['hotel_adults'],
						'num_children' => $post_data['hotel_childrens'],
						'arapts' => $post_data['hotel_travel_to'],
						'num_rooms' => $post_data['hotel_rooms']
				);
				$hash = $this->UserSearch->createSearch($data);
				if(!empty($this->UserSearch->fetch_a_search(array('url_hash' => $hash))))
				{
					echo 'availableHotels/'.$hash;
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

	public function available_hotels()
	{
		
		if($this->uri->segment(2) != '')
		{		
			/****************fetching results*****************/
			$this->load->model('FullSearch');
			$rows = $this->UserSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2),'type_search' => 'hotel_only'));
			
			//Redirect If row does not exist
			if(empty($rows)){
				redirect(base_url());
			}
			
			$data= array();
			$data['row'] = $rows;
			
			if($rows[0]['pax'] != '')
				{
					$service_url_arr = explode(',',substr($rows[0]['service_url'],0,-1));
					
					$offers = array();
					$n = 0;
					foreach ($service_url_arr as $service_url)
					{
						
						$parts = parse_url($service_url);
						parse_str($parts['query'], $query);	
						//echo $query['pax'];
						$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$rows[0]['selected_date']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
						
						if($results = $this->loadHotelDataFun($url,$rows[0]['selected_date']))
						{								
							$temp = array();							
							$this->format_array_fun($results['offer'],count($results['offer']),$temp);							
							$offers[] = $temp;
						}
						else{
							
						}
					}	
					
				
					$data['offers'] = $this->filter_pax_based_fun($offers,0,count($offers),$offers[0]['filter_data']);
					
					if(empty(@$data['offers']['filter_data'])){
						redirect(base_url()."notavailable");
					}
					
					$data['content'] = $this->hotels_html($data['offers']['filter_data'],9,0,$this->uri->segment(2),'hotel_only');
					$myser_URL = $service_url_arr[0];
					//echo $myser_URL;exit;
				}
				else
				{
					
					$parts = parse_url($rows[0]['service_url']);
					parse_str($parts['query'], $query);
					
					$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$rows[0]['selected_date']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
					if($results = $this->loadHotelDataFun($url,$rows[0]['selected_date']))
					{
						
						$this->format_array_fun($results['offer'],count($results['offer']),$data['offers']);
						if(empty($data['offers'])){
							redirect(base_url()."notavailable");
						}
						//echo "<pre>";print_r($data['offers']);exit;
						$data['content'] = $this->hotels_html($data['offers']['filter_data'],9,0,$this->uri->segment(2),'hotel_only');
					}
					$myser_URL = $rows[0]['service_url'];
					
				}
				
			//echo '<pre>';print_r($data['row']);exit;
			/*****************end*****************************/
			$data['type'] = 'hotel_only';
			
			//For change search poopulations
			$departures = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
			foreach ($departures as $departure)
			{
				$code = (array)$departure->attributes()->code;
				$name = (array)$departure->attributes()->name;
				$data['filtered_departures'] = seperatorFlights($code[0],$name[0]);
				$data['departures'][$code[0]] = $name[0];
			}
			$parts = parse_url($myser_URL);
			parse_str($parts['query'], $query);
			$data['change_search_info']['query'] = $query;
			$data['change_search_info']['row'] = $rows[0];
			$data['controller'] = $this;
			$data['h_cur'] = 'current';
			$data['b_cur'] = '';
			$data['h_done'] = '';
			//End
			 		
		//	echo '<pre>';print_r($data['change_search_info']);exit;
			
			$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
					'css/jquery-ui.css','css/font-awesome.min.css',
					'css/google_font.css','css/custom.css',
					'css/responsive.css','css/inner-page.css',
					'css/menu.css','css/bxslider/jquery.bxslider.css',
					'css/jquery.fancybox.css','css/popup_fancy.css',
					'js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js',
					'js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js',
					'js/jquery.fancybox.pack.js','js/script-hotels.js'));
			$this->layouts->set_title('Available Hotels');
			$this->layouts->view('available_hotels_view',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function populators_filter_fun($results)
	{
		/********populators********/
	
		$boardbasis_arr = array('AI' => 'All Inclusive',
				'RO' => 'Room Only',
				'BB' => 'Bed and Breakfast',
				'SC' => 'Self Catering',
				'HB' => 'Half Board',
				'FB' => 'Full Board'
		);
		$populators = array();
		if(!empty($results))
		foreach ($results as $key => $result)
		{
			foreach ($result as $offer)
			{
				$populators['boardbasis'][$offer['@attributes']['boardbasis']] = $boardbasis_arr[$offer['@attributes']['boardbasis']];
				$populators['star_ratting']['res'][(int)$offer['@attributes']['starrating']] = '<img src="'.base_url().'images/star_'.(int)$offer['@attributes']['starrating'].'.png">';
				$populators['star_ratting']['price'][(int)$offer['@attributes']['starrating']][] = $offer['@attributes']['sellpricepp'];
				$populators['resorts'][$offer['@attributes']['resort']] = urldecode($offer['@attributes']['resort']);
				
			}
		}
		
		return $populators;
		
		/**************************/
		
		
	}
	public function filter_pax_based_fun($offers,$current_offer_pos,$count,$current_offer_result)
	{
		
		static $result = array();
		if($count == 1)
		{
			$result['filter_data'] = $offers[$current_offer_pos]['filter_data'];
			$result['populators'] = $this->populators_filter_fun($offers[$current_offer_pos]['filter_data']);
			return $result;
		}
		else if(($count - $current_offer_pos) < 2 )
		{		
			
			$result['populators'] = $this->populators_filter_fun(@$result['filter_data']);
			return $result;
		}
		
		
		foreach ($current_offer_result as $current_key => $current_offer)
		{
 			
			//echo '<pre>';print_r($offers[$current_offer_pos+1]['filter_data']);exit;
			foreach (@$offers[$current_offer_pos+1]['filter_data'] as $next_key => $next_offer)
			{		
				if($current_key == $next_key)
				{
					foreach ($current_offer as $current_hotel_key => $current_hotel)
					{
						foreach ($next_offer as $next_hotel_key => $next_hotel)
						{						
							if($current_hotel['@attributes']['boardbasis'] == $next_hotel['@attributes']['boardbasis'])
							{
								$result['filter_data'][$current_key][] = ($current_hotel['@attributes']['sellpricepp'] < $next_hotel['@attributes']['sellpricepp']) ? $next_hotel : $current_hotel;
								
							}
						}
					}
					/*
					 * Just removing duplicate boardbasis wise
					 */
					if(!empty(@$result['filter_data'][$current_key])){
						usort($result['filter_data'][$current_key], function($a, $b) {
							
							//echo "<pre>";print_r($a['@attributes']['sellpricepp']);
							return $a['@attributes']['sellpricepp'] > $b['@attributes']['sellpricepp'] ? 1 : -1;
						});
							
						$result1 = array();
						$result['filter_data'][$current_key] = array_filter($result['filter_data'][$current_key],function($val) use(&$result1){
							
							if(in_array($val['@attributes']['boardbasis'],$result1))
							{
								return false;
							}
							else
							{
								$result1[] = $val['@attributes']['boardbasis'];
								return true;
							}
						});
					}
				}
			}	
			
		}
		
		return $this->filter_pax_based_fun($offers,$current_offer_pos+1,$count,@$result['filter_data']);
		
	}	
	
	
	public function filtering_hotels_fun($filters_opt_array,$data)
	{
		echo '<pre>';print_r($filters_opt_array);print_r($data);exit;
		$filters_opt_array['stars'] = array(2,3);
		$filters_opt_array['resorts'] = array('Albufeira','Vilamoura');
		$results = array();
		foreach ($data as $key => $records)
		{
			foreach ($records as  $record)
			{
				/*foreach ($filters_opt_array['price'] as $model)
				{
					if($model == 'lowestprice')
					{
						
					}
					if($model == 'recommended')
					{
						print_r($model);exit;
					}			
				}*/
				foreach ($filters_opt_array['stars'] as $star)
				{				
					if((int)$record['@attributes']['starrating'] == $star)
					{
						//$results[$key][] = $record;
						//$filters_opt_array[]
						
						
					}				
				}			
			}
		}
		$results1 =array();
		foreach ($results as $key_res => $records_res)
		{		
			foreach ($records_res as  $record_res)
			{				
				foreach ($filters_opt_array['resorts'] as $resort)
				{
					if($record_res['@attributes']['resort'] == $resort)
					{
						$results1[$key_res][] = $record_res;				
					}
				}
			}			
		}
		echo '<pre>';print_r($results1);exit;
		
	}
	
	
	
	
	public function full_available_hotels()
	{
		$data= array();$results= array();
		if($this->uri->segment(2) != '')
		{
			$this->load->model('FullSearch');
			$this->load->model('PhaseFlightOrHotel');
			$rows = $this->FullSearch->fetch_a_search(array('url_hash' => $this->uri->segment(2)));			
			$flight_row = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
			if(empty($flight_row)){
				redirect(base_url().'flightsAvailability/'.$this->uri->segment(2));
			}
			
			$data['row'] = $rows;
			$data['fselected_date'] = $flight_row[0]['flight_selected_date'];
			if(!empty($rows))
			{
				if($rows[0]['pax'] != '')
				{
					$service_url_arr = explode(',',substr($rows[0]['service_url'],0,-1));
					
					$offers = array();
					$n = 0;
					foreach ($service_url_arr as $service_url)
					{
						
						$parts = parse_url($service_url);
						parse_str($parts['query'], $query);	
						//echo $query['pax'];
						$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$flight_row[0]['flight_selected_date']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
						
						if($results = $this->loadHotelDataFun($url,$flight_row[0]['flight_selected_date']))
						{								
							$temp = array();							
							$this->format_array_fun($results['offer'],count($results['offer']),$temp);							
							$offers[] = $temp;
						}
					}	
					
				
					$data['offers'] = $this->filter_pax_based_fun($offers,0,count($offers),$offers[0]['filter_data']);
					
					if(empty(@$data['offers']['filter_data'])){
						redirect(base_url()."notavailable");
					}
					
					$data['content'] = $this->hotels_html($data['offers']['filter_data'],9,0,$this->uri->segment(2),'pack_hotel');
					$myser_URL = $service_url_arr[0];
					//echo $myser_URL;exit;
				}
				else
				{
					
					$parts = parse_url($rows[0]['service_url']);
					parse_str($parts['query'], $query);
					
					$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$flight_row[0]['flight_selected_date']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
					if($results = $this->loadHotelDataFun($url,$flight_row[0]['flight_selected_date']))
					{
						
						$this->format_array_fun($results['offer'],count($results['offer']),$data['offers']);
						if(empty($data['offers'])){
							redirect(base_url()."notavailable");
						}
						//echo "<pre>";print_r($data['offers']);exit;
						$data['content'] = $this->hotels_html($data['offers']['filter_data'],9,0,$this->uri->segment(2),'pack_hotel');
					}
					$myser_URL = $rows[0]['service_url'];
					
				}				
				$departures = $this->fetch_departures();
				$arrivals = $this->fetch_arrivals();
			
				
				$this->load->model('PhaseFlightOrHotel');
				$selected_info = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
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
				
				$data['seleted_info'] =  '<div class="deals">
											<h2>Your Selections	</h2>
										  </div>
	               						  <div class="bg_grey">											
					            			<div>
					                			<div class="left">Flights</div>
								                <div class="right" style="text-align: right;">&#163;'.(($rows[0]['num_adults'] + $rows[0]['num_children']) * $flight_obj['@attributes']['sellpricepp']).'</div>
			           						 </div>
								             <div style="margin-bottom: 5px; margin-top: 5px;    line-height: 20px;">
								                <strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Depart:</strong>
								                <br>
								                <!-- <div style="position: relative;" class="clearfix">
								                   <div class="left">
								                        <img src="'.$dept_images[$flight_obj['@attributes']['suppcode']].'" style="width: 70px; height: 16px;">
								                    </div>
								                    <div class="right">
								                        <span class="txt_color_2"></span>
								                    </div>
								                </div>-->
								                        		
								               <small>'. $dscode.' to '.$ascode.'<br>'.date('d M Y',$this->cvtDt(str_date($selected_info[0]['flight_selected_date']))) .' : '.$dept_start_time.'-'.$dept_arr_time.'</small><br>
								                <span class="txt_color_2"></span>			                
								            </div>
								            <div style="margin-bottom: 5px;    line-height: 20px;">
							                	<strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Return:</strong><br>
								                <!--<div style="position: relative;" class="clearfix">
								                    <div class="left">
								                        <img src="'.$dept_images[$flight_obj['@attributes']['suppcode']].'" style="width: 70px; height: 16px;">
								                    </div>
								                </div>-->
								               	 <small>'.$ascode.' to '.$dscode.'<br>'.date('d M Y',$this->cvtDt(str_date(explode(' ',$flight_obj['@attributes']['indep'])[0]))).' : '.$return_start_time.'-'.$return_arr_time.'</small><br>
								                <span class="txt_color_2"></span>
					            			</div>

								            <div style="position: relative;" class="clearfix">
								                <div>
								                    <small>
								                        <span> Adults + Children : '.($rows[0]['num_adults'] + $rows[0]['num_children']).' x </span><span id="cphContent_ucBookingSummary_lblFPrice">&#163;'.$flight_obj['@attributes']['sellpricepp'].'</span>
								                    </small>
								                    <span style="float:right;">
									                    <small>
									                        <a href="'.base_url().'flightsAvailability/'.$this->uri->segment(2).'" onClick="return Change('."'".$type_s."'".','."'".$cry."'".')" title="Change Flight">Change</a>
									                    </small>
									                </span>
								                </div>			
								              
								            </div>								           
			          					 </div>                     		
			           					 <div class="bg_grey">	
								              <div>
												<div class="left">Atol Protection</div>
									           <div class="right" style="text-align: right;">&#163;'.(($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50 ).'</div>
									          </div>
									           	
									           	<div style="margin-top: 10px;" class="clearfix">
									                 <small>&#163;2.50 x '.($rows[0]['num_adults'] + $rows[0]['num_children']).'</small>
									                 <span style="float:right;">
									                    <small>
									                        <a class="toggle_atol">What\'s this?</a>
									                    </small>
									                </span>
						           			   </div>			        					
								       	</div>
									    <div class="atol_info clearfix" style="display: none;">
											 <div class="clearfix has_bottom_margin hide_mobile hide_tablet">
										           <h4 class="left ">Atol Protection</h4>
										               <a class="right toggle_atol"><small>close</small></a>
										     </div>
											 <div style="clear: both;">
										        <p class="hide_mobile hide_tablet">
										             <strong>With A1 Travel your holiday is protected!</strong><br>
										               A1Travel hold ATOL license 5287 and we are full ABTA members.
										       </p>
											   <small>
										         <p>
										             All of our Flight Plus Holidays are financially protected by the ATOL scheme.<br>
										             A Flight Plus Holiday is where you purchase through us, at the same time or within a day of each other, a flight plus overseas accommodation and / or car hire from separate Travel Suppliers and as separate bookings (i.e. not a package holiday)
										         </p>
										         <p>
										           On all Flight Plus Holiday bookings, your money is ATOL protected. This means you will be able to continue with your holiday or suitable alternative holiday (at no extra cost) or receive a refund of the amount paid to us in the unlikely event of our insolvency or the insolvency of one or more of your service Travel Suppliers
										         </p>
												 <p> When you book with us, we will send you an ATOL confirmation invoice that provides you with all the information you will need about your ATOL protection
										          </p>
										       </small>
										     </div>
										 </div>
									     <div class="bg_grey" style="margin-bottom:10px;">	
								              <div>
												<div class="left">Total</div>
									           <div class="right" style="text-align: right;">&#163;'.((($rows[0]['num_adults'] + $rows[0]['num_children']) * $flight_obj['@attributes']['sellpricepp']) + (($rows[0]['num_adults'] + $rows[0]['num_children']) * 2.50 )).'</div>
									          </div>									           	
									          <div style="margin-top: 10px;" class="clearfix">									                 
									                 <span style="float:right;">
									                    <small>Per Person: '.((($rows[0]['num_adults'] + $rows[0]['num_children']) * $flight_obj['@attributes']['sellpricepp']) / ($rows[0]['num_adults'] + $rows[0]['num_children'])).' X '.(($rows[0]['num_adults'] + $rows[0]['num_children'])).'</small>
									                </span>
						           			   </div>			        					
								       	</div>';
								
				/**************end*******************************/
				$data['type'] = 'pack_hotel';
				$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
						'css/jquery-ui.css','css/font-awesome.min.css',
						'css/google_font.css','css/custom.css',
						'css/responsive.css','css/inner-page.css',
						'css/menu.css','css/bxslider/jquery.bxslider.css',
						'css/jquery.fancybox.css','css/popup_fancy.css','css/customeffects.css',
						'js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js',
						'js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js',
						'js/jquery.fancybox.pack.js','js/script-hotels.js'));
				//$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/inner-page.css','css/menu.css','css/bxslider/jquery.bxslider.css','css/flight_result.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/script-hotels.js'));
				$this->layouts->set_title('Available Hotels');
				
				//For change search poopulations
				$departures = new SimpleXMLElement($this->download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
				foreach ($departures as $departure)
				{
					$code = (array)$departure->attributes()->code;
					$name = (array)$departure->attributes()->name;
					$data['filtered_departures'] = seperatorFlights($code[0],$name[0]);
					$data['departures'][$code[0]] = $name[0];
				}				
 				$parts = parse_url($myser_URL);
 				parse_str($parts['query'], $query);				
 				$data['change_search_info']['query'] = $query;
 				$data['change_search_info']['row'] = $rows[0];
 				$data['controller'] = $this;
 				$data['fcls'] = 'done';
 				$data['hcls'] = 'current';
 				$data['ecls'] = '';
 				$data['bcls'] = '';
 				$data['f_done'] = 'done';
 				$data['h_done'] = '';
 				$data['e_done'] = '';
 				$data['b_done'] = '';
 				
 				//End				
 			
				$this->layouts->view('available_hotels_view',$data);
				
				
			}
			else
			{
				redirect(base_url());
			}
			
		}
		
	}
	
	public function cvtDt($date)
	{
		return strtotime(str_replace('/','-',$date));
	}
	
	public function loadHotelDataFun($service_url,$u_selected_date)
	{	
		$data['results'] = new SimpleXMLElement($this->download_page($service_url));
		
		if($data['results']->attributes()->offers > 0)
		{
			$result = json_decode(json_encode($data),true);
			return $result['results'];
		}
		else
		{
			return false;
		}		
	}
	
	public function format_array_fun($raw_data,$raw_count,&$final_result,&$filter_data=array(),&$populated_list=array(),$count = 0)
	{
		
		$boardbasis_arr = array('AI' => 'All Inclusive',
				'RO' => 'Room Only',
				'BB' => 'Bed and Breakfast',
				'SC' => 'Self Catering',
				'HB' => 'Half Board',
				'FB' => 'Full Board'
		);		
		$first = current($raw_data);
		$f_key = key($raw_data);
		if(!isset($first['@attributes']))
		{
			$temp = $first;	
			unset($first);
			$first['@attributes'] = $temp;
			
		}
		
		//margins - start - hotels
		$this->load->model('Options');
		$margin_row = $this->Options->fetch_a_fields(array(),1);
		$first['@attributes']['sellpricepp'] = $first['@attributes']['sellpricepp'] + @$margin_row[0]['hotel_rate'];
		$first['@attributes']['netpricepp'] = $first['@attributes']['netpricepp'] + @$margin_row[0]['hotel_rate'];
		//end
		$filter_data[$first['@attributes']['resort'].'-'.$first['@attributes']['hotelname']][] = $first;
		
		$populated_list['boardbasis'][$first['@attributes']['boardbasis']] = $boardbasis_arr[$first['@attributes']['boardbasis']];
	
		$populated_list['star_ratting']['res'][(int)$first['@attributes']['starrating']] = '<img src="'.base_url().'images/star_'.(int)$first['@attributes']['starrating'].'.png">';		
		$populated_list['star_ratting']['price'][(int)$first['@attributes']['starrating']][] = $first['@attributes']['sellpricepp'];
		$populated_list['resorts'][$first['@attributes']['resort']] = urldecode($first['@attributes']['resort']);
		
		unset($raw_data[$f_key]);	
		
		if($count == ($raw_count-1))
		{		
			$final_result = array('filter_data' => $filter_data,'populators' => $populated_list);
		}
		else
		{
			$count++;			
			return $this->format_array_fun($raw_data,$raw_count,$final_result,$filter_data,$populated_list,$count);			
		}		
	}
	
	public function hotels_html($offers,$limit,$offset,$crypt,$type)
	{
		//echo $limit.' '.$offset;exit;
		$data = array();$html = '';
		$boardbasis_arr = array('AI' => 'All Inclusive',
				'RO' => 'Room Only',
				'BB' => 'Bed and Breakfast',
				'SC' => 'Self Catering',
				'HB' => 'Half Board',
				'FB' => 'Full Board'
		);
		$keys = array_keys($offers);
	
		for ($i=$offset;$i<=$offset+$limit;$i++)
		{			
			if(isset($keys[$i]))
			{
			$html .= '<div class="orderhotels">
					<div class="row">
						<div class="col-sm-6 col-md-7">
							<div class="thumbnail box-border"><div>
							<div class="star-img"><img alt="" src="'.base_url().'images/star_'.(int)$offers[$keys[$i]][0]['@attributes']['starrating'].'.png"></div>
							<div class="title-name">'.urldecode($offers[$keys[$i]][0]['@attributes']['hotelname']).'</div>							
							<h4>'.urldecode($offers[$keys[$i]][0]['@attributes']['resort']).'</h4>
							<p class="content">'.urldecode($offers[$keys[$i]][0]['@attributes']['content']).'</p>							
						</div>
					</div>
				 </div>
				<div class="row">
					<div class="col-sm-6 col-md-5">
						<div class="thumbnail box-border"><div>';
						if(is_array(@getimagesize(urldecode($offers[$keys[$i]][0]['@attributes']['image'])))){
							$html .= '    <img style="width: 100%;max-height: 180px;" src="'.urldecode($offers[$keys[$i]][0]['@attributes']['image']).'" />';
						}
						else{
							$html .= '    <img style="width: 100%;max-height: 180px;" src="'.base_url().'/images/destination_placeholder.jpg"/>';
						}						
					$html .='</div>
							<p style="margin:5px 0 2px;"> <a class="btn-small btn-default-small" style="width:100%;" role="button" onclick=fulldetails("'.$offers[$keys[$i]][0]['@attributes']['brocode'].'")>Full Details</a></p>
				</div>
			</div>
			</div>
			</div>
			</div>';
			$html .= '<div class="list-group">
			  <a href="#" class="list-group-item active"><span class="h-title">Available Rooms: </span>  </a>
			</div>
				<div class="orderhotels-1">';
			
			foreach ($offers[$keys[$i]] as $hotel)
			{			
				$plain_txt = json_encode($hotel);
				$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
				
				//echo '<pre>';print_r($encrypted_txt);exit;
				$html .= '
					<div class="row bg_grey" style="padding:0px;">
						<div class="col-sm-6 col-md-a">
							<h5>'.$boardbasis_arr[$hotel['@attributes']['boardbasis']].'</h5>
							<p class="content">Premium Double/twin Balcony/terrace </p>
						</div>
						<div class="col-sm-6 col-md-3 t-align">
							<div>
							<h5>Room Price</h5>
							<h4>&#163;'.$hotel['@attributes']['sellpricepp'].'pp</h4>
							</div>
						</div>
						<div class="col-sm-6 col-md-2 top-add">
							<p> <a class="btn-small btn-default-small" role="button" onclick=Addhotel("'.$type.'","'.$encrypted_txt.'","'.$crypt.'")>ADD <i class="fa fa-plus-circle" aria-hidden="true"></i> </a></p>
						</div>
					</div>
				';
				
			}			
			$html .='</div><br>'; 
			}
			else
			{
				break;
			}
			
		}
		
		$res_count = count($offers);
		$current_page = round(($offset)/10)+1;
		
		
		$num_pages = ($res_count%10)? ($res_count/10)+1 : $res_count/10;
		$html .= '<div id="cphContent_phpage" style="Display:block;">
						 <div class="bg_grey2 padded has_bottom_margin clearfix">
                            <div class="paging">
                                  <span>Page: </span>
								  <span id="cphContent_dpAllStar">';
		
		for($i=1;$i<=$num_pages;$i++)
		{
			if($current_page == $i)
			{
				$html .= '&nbsp;<span>'.$i.'</span>';
			}
			else
			{
				$html .= '&nbsp;<a class="pagerhyperlink" >'.$i.'</a>';
			}
			
		}		
		$html .='			</div>
                         </div>
                      </div>';
		return $html;
		
	}
	
	public function savehotel_fun()
	{
		if($this->input->post())
		{			
			$this->load->model('Options');
			$margin_row = $this->Options->fetch_a_fields(array(),1);
			
			if ($this->input->post('searchType') == 'pack_hotel')
			{
				$hobj = json_decode(encrypt_decrypt('decrypt',$this->input->post('crypt_text')),true);
				
				$reslt_obj = array();
				$this->load->model('PhaseFlightOrHotel');
				$this->load->model( 'FullSearch' );
				$this->load->model( 'BookingInfo' );
				$this->load->model('PhaseSavingsNExtras');
				$row = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')));
				
				if(!empty($row = $this->FullSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')))))
				{
					
					$flight_row = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$row[0]['id']));
					
					$ser_url_arr = explode(',',substr($row[0]['service_url'],0,-1));
					
					foreach ($ser_url_arr as $service_url)
					{
						$parts = parse_url($service_url);
						parse_str($parts['query'], $query);
						//echo $query['pax'];
						
						$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$flight_row[0]['flight_selected_date']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
						//echo '<pre>';print_r($url);exit;
						if($results = $this->loadHotelDataFun($url,$flight_row[0]['flight_selected_date']))
						{
						//	echo '<pre>';print_r($results);exit;
							foreach ($results['offer'] as $offer)
							{
								//margins - while hotel submition
								$offer['@attributes']['sellpricepp'] = $offer['@attributes']['sellpricepp'] + @$margin_row[0]['hotel_rate'];
								$offer['@attributes']['netpricepp'] = $offer['@attributes']['netpricepp'] + @$margin_row[0]['hotel_rate'];
								//end							
								//echo '<pre>';print_r($results['offer']);exit;
								if($offer['@attributes']['resort'] == $hobj['@attributes']['resort'] &&
									$offer['@attributes']['hotelname'] == $hobj['@attributes']['hotelname'] &&
									$offer['@attributes']['boardbasis'] == $hobj['@attributes']['boardbasis'])
								{
									
									$reslt_obj[] = $offer;
									break;
								}
							}							
						}					
					}
				//	echo '<pre>';print_r($results['offer']);exit;
					$isexist = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>$this->input->post('searchType'),'full_pack_id'=>$row[0]['id']));
					
					if(!empty($isexist))
					{
						$udata = array('type_search' => $this->input->post('searchType'),
								'pack_info' => json_encode($reslt_obj),
								'flight_selected_date' => $flight_row[0]['flight_selected_date']
						);
						if($this->PhaseFlightOrHotel->updateSearch($udata,$isexist[0]['id']))
						{
							if($this->FullSearch->update_row(array('search_position'=>$this->input->post('searchType')),$row[0]['id']))
							{								
								$this->PhaseSavingsNExtras->deleteRow($row[0]['id']);
								$this->BookingInfo->deleteRow($row[0]['id']);
								echo base_url()."extras/".$this->input->post('crypt');
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
						
						if($this->PhaseFlightOrHotel->createSearch(json_encode($reslt_obj),$this->input->post('searchType'),$row[0]['id'],$flight_row[0]['flight_selected_date']))
						{
							if($this->FullSearch->update_row(array('search_position'=>$this->input->post('searchType')),$row[0]['id']))
							{
								echo base_url()."extras/".$this->input->post('crypt');
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
				else{
					
					echo 'notavailable';
				}
			}
			else{
				$hobj = json_decode(encrypt_decrypt('decrypt',$this->input->post('crypt_text')),true);
				$this->load->model( 'BookingInfo' );
				$reslt_obj = array();
				if(!empty($row = $this->UserSearch->fetch_a_search(array('url_hash' => $this->input->post('crypt')))))
				{
					$ser_url_arr = explode(',',substr($row[0]['service_url'],0,-1));
					
					foreach ($ser_url_arr as $service_url)
					{
						$parts = parse_url($service_url);
						parse_str($parts['query'], $query);						
						$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$query['depdate']."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
						if($results = $this->loadHotelDataFun($url,$query['depdate']))
						{
							
							foreach ($results['offer'] as $key => $offer)
							{
								
								if($key === '@attributes'){
									
									$temp = array();
									//margins - while hotel submition
									$temp['@attributes']['sellpricepp'] = $offer['sellpricepp'] + @$margin_row[0]['hotel_rate'];
									$temp['@attributes']['netpricepp'] = $offer['netpricepp'] + @$margin_row[0]['hotel_rate'];
									//end
									
									if($offer['resort'] == $hobj['@attributes']['resort'] &&
											$offer['hotelname'] == $hobj['@attributes']['hotelname'] &&
											$offer['boardbasis'] == $hobj['@attributes']['boardbasis'])
									{
										$reslt_obj[] = $temp;
										break;
									}
								}
								else{									
									//margins - while hotel submition
									$offer['@attributes']['sellpricepp'] = $offer['@attributes']['sellpricepp'] + @$margin_row[0]['hotel_rate'];
									$offer['@attributes']['netpricepp'] = $offer['@attributes']['netpricepp'] + @$margin_row[0]['hotel_rate'];
									//end
									
									if($offer['@attributes']['resort'] == $hobj['@attributes']['resort'] &&
											$offer['@attributes']['hotelname'] == $hobj['@attributes']['hotelname'] &&
											$offer['@attributes']['boardbasis'] == $hobj['@attributes']['boardbasis'])
									{
										$reslt_obj[] = $offer;
										break;
									}
								}
								
							}
						}
					}
					$udata = array(
							'pack_info' => json_encode($reslt_obj),
							'selected_date' => $query['depdate']
					);
					if($this->UserSearch->update_row($udata,$row[0]['id']))
					{
						echo base_url().'book_hotel/'.$this->input->post('crypt');
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
	
	public function download_page($path){
		//$path = urlencode($path);
		//echo urldecode($path);exit;
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
	
	public function full_details_fun()
	{
		$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=7&compid=1&brochurecode=BEWE-AMTSES1CO0";
		echo $this->show_hotel_details($url);exit;
	}
	
	public function show_hotel_details($brcode = null)
	{
		$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=7&compid=1&brochurecode=".$brcode;
		
		$data = array();
		$raw = new SimpleXMLElement($this->download_page($url));
		$data['result'] = json_decode(json_encode($raw),true);	
		$this->load->view('full_details',$data);
	}
	
	public function filterHotel_fun()
	{
		
		if($this->input->post()){
			
			$checkedValues = $this->input->post('checkedValues');
			
			if($this->input->post('crypt') != '')
			{
				if($this->input->post('searchType') == 'pack_hotel' ){
					$this->load->model('FullSearch');
					$this->load->model('PhaseFlightOrHotel');
					$rows = $this->FullSearch->fetch_a_search(array('url_hash' => trim($this->input->post('crypt'))));
						
					$flight_row = $this->PhaseFlightOrHotel->fetch_a_search(array('type_search'=>'full_flight_date','full_pack_id'=>$rows[0]['id']));
					$sel_date = $flight_row[0]['flight_selected_date'];
				}
				else{
					$this->load->model('UserSearch');
					$rows = $this->UserSearch->fetch_a_search(array('url_hash' => trim($this->input->post('crypt'))));
					$sel_date = $rows[0]['selected_date'];
				}
				
				if(!empty($rows))
				{
					
					$offers = array();
					if($rows[0]['pax'] != '')
					{
						
						$service_url_arr = explode(',',substr($rows[0]['service_url'],0,-1));
						
						//$n = 0;
						foreach ($service_url_arr as $service_url)
						{
			
							$parts = parse_url($service_url);
							parse_str($parts['query'], $query);
							
							$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$sel_date."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
			
							if($results = $this->loadHotelDataFun($url,$sel_date))
							{
								//Sort by price
								if(@$checkedValues['prices'] && $checkedValues['prices'][0] == 'highest')
								{
									uasort($results['offer'], 'cmp');
								}
								$temp = array();
								$this->format_array_fun($results['offer'],count($results['offer']),$temp);
								$offers[] = $temp;
							}
						}
							
			
						$offers = $this->filter_pax_based_fun($offers,0,count($offers),$offers[0]['filter_data']);
						
						
						
					}
					else
					{
							
						$parts = parse_url($rows[0]['service_url']);
						parse_str($parts['query'], $query);
							
						$url = "http://87.102.127.86:8005/search/websearch.exe?pageid=6&compid=1&minstay=".$query['minstay']."&maxstay=".$query['maxstay']."&depdate=".$sel_date."&flex=0&countryid=".$query['countryid']."&regionid=".$query['regionid']."&areaid=".$query['areaid']."&resortid=&boards=&rating=&pax=".$query['pax']."&offersperday=200";
						if($results = $this->loadHotelDataFun($url,$sel_date))
						{
							
							
							//Sort by price 
							if(@$checkedValues['prices'] && $checkedValues['prices'][0] == 'highest')
							{
								uasort($results['offer'], 'cmp');
							}
							//end
							$this->format_array_fun($results['offer'],count($results['offer']),$offers);
												
						}							
					}			
				}	
			
				//If any resort selected
				if(@$checkedValues['resorts'])
				{
					$temp = array();
					foreach ($offers['filter_data'] as $offr_key => $offer)
					{
						$offr_arr = current(explode('-',$offr_key));
						foreach ($checkedValues['resorts'] as $resort)
						{
							if($offr_arr == $resort){
								$temp[$offr_key] = $offer;
							}
						}
					}
					$offers['filter_data'] = $temp;
				}
				//end
				//If any board basis selected
				if(@$checkedValues['boardbasis'])
				{
					$temp = array();
					foreach ($offers['filter_data'] as $offr_key => $offers)
					{
						foreach ($offers as $offer){
							foreach ($checkedValues['boardbasis'] as $boardbasis)
							{
								if($boardbasis == $offer['@attributes']['boardbasis'])
								{
									$temp[$offr_key][] = $offer;
								}
							}
						}
					}
					$offers['filter_data'] = $temp;
				}
				//end
					
				//If any star selected
				if(@$checkedValues['stars'])
				{
					$temp = array();
					foreach ($offers['filter_data'] as $offr_key => $offers)
					{
						foreach ($offers as $offer){
							foreach ($checkedValues['stars'] as $star)
							{
								if((int)$star == (int)$offer['@attributes']['starrating'])
								{
									$temp[$offr_key][] = $offer;
								}
							}
						}
					}
					$offers['filter_data'] = $temp;
				}
				//echo "<pre>";print_r($offers['filter_data']);exit;
				if(trim($this->input->post('keyword')) != '')
				{
					$temp = array();
					foreach ($offers['filter_data'] as $offr_key => $offers)
					{
						foreach ($offers as $offer){	
							//echo "<pre>";print_r($offer);exit;
							if (stripos(urlencode($offer['@attributes']['hotelname']),$this->input->post('keyword')) !== false) $temp[$offr_key][] = $offer;
						}
					}
					$offers['filter_data'] = $temp;
				}
				//end
				$limit = ((int)$checkedValues['page'] * 10)-1;
				$offset = max(($limit-10),0);
				
				//echo '<pre>';print_r($offers['filter_data']);exit;
				$content = $this->hotels_html($offers['filter_data'],10,$offset,$this->input->post('crypt'),$this->input->post('searchType'));
				
			
			echo $content;exit;
			
			
			/*
			if(@$checkedValues['resorts'])
			{
				echo "a";
			}
			else{
				echo "else";
			}
			exit;	*/		
		}
		}
	}
}
