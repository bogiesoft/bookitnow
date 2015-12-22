<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends CI_Controller {

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
		//$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->helper(array('form','url','common'));
		$this->load->model('UserSearch');
		
	}
	
	public function fetchDealsFun($dealType){
		$html = '';
		$this->load->model('ManagerChoices');
		$manager_deals = $this->ManagerChoices->fetch_a_search(array('deal_category'=>$dealType),'ALL');
		
		foreach ($manager_deals as $deal){
			$qString = ($dealType == 'holiday') ? 'type='.$dealType.'&hotel_id='.$deal['hotelid'].'&nights=7' : 'type='.$dealType.'&hotel_id='.$deal['hotelid'].'&nights=2';
			$html .= '<div class="col-sm-6">';
			$html .= '<div class="green_nature">';
			$html .= '<div class="image"><img src="'.base_url().'images/Pool.jpg" class="img-responsive" alt="'.$deal['hotel_name'].'">';
			$html .= '<div class="star"><img src="'.base_url().'images/star.png" class="img-responsive" alt="star"></div>';
			$html .= '<div class="mini_img"><img src="'.base_url().'images/tree.jpg" alt="tree">';
			$html .= '<img src="'.base_url().'images/family.jpg" alt="family">';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<h2>'.$deal['hotel_name'].'</h2>';
			$html .= '<div class="sm-font">'.$deal['feature_1'].' | '.$deal['feature_2'].'</div>';
			$html .= '<p>'.$deal['feature_3'].' | '.$deal['feature_4'].'</p>';
			$html .= '<div class="rate">';
			$html .= '<div class="clearfix padded_v">';
			$html .= '<div class="fluid columns_nine zeroMargin_desktop">';
			$html .= '<small class="txt_color_1">Deals From</small><br>';
			$html .= '<strong class="txt_xxtra_large txt_color_1">&#163;172</strong><small class="txt_color_1">pp</small></div>';
			$html .= '<div class="fluid columns_three">';
			$html .= '<a href="'.base_url().'welcome/deals/dynamicDeals/?hotel_id='.$qString.'" class="button">GO <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>';
			$html .= '</div></div></div></div></div>';				
		}
		return $html;
	}
	
	public function switchDeals(){
		exit($this->fetchDealsFun($this->input->post('deal_category')));
	}
	
	public function index()
	{
		$data = array();
		$data['manager_deals_content'] = $this->fetchDealsFun('holiday');
		
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
	    		'css/jquery-ui.css','css/font-awesome.min.css',
	    		'css/google_font.css','css/custom.css',
	    		'css/responsive.css','css/menu.css',
	    		'css/preview.min.css','css/bxslider/jquery.bxslider.css',
	    		'css/jquery.fancybox.css','js/jquery-ui.js',
	    		'js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js',
	    		'js/bxslider/jquery.bxslider.js','js/parallax-slider/jquery.cslider.js',
	    		'js/jquery.fancybox.pack.js','js/script-home.js'));
		$this->layouts->set_title('Manager Deals');		
		$this->layouts->view('deals',$data);
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
	
	public function dynamicArea(){
		$data = array();
		/************fetching departure airports**************/
		changeSearch($data);
		
		/******************end***********/
		/************fetching travel to list for hotels**************/
		$data['hotel_travel_list'] = $this->arrival_list_basedon_dynaminc_departuere_airport();
		/******************end***********/
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
				'css/jquery-ui.css','css/font-awesome.min.css',
				'css/google_font.css','css/custom.css',
				'css/responsive.css','css/menu.css',
				'css/preview.min.css','css/bxslider/jquery.bxslider.css',
				'css/tenerife-holidays.css','css/jquery.fancybox.css',
				'css/popup_fancy.css','js/jquery-ui.js',
				'js/jquery.blockUI.js','js/responsee.js',
				'js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicarea',$data);
	}
	
	public function dynamicResort(){
		$data = array();
		/************fetching departure airports**************/
		changeSearch($data);
	
		/******************end***********/
		/************fetching travel to list for hotels**************/
		$data['hotel_travel_list'] = $this->arrival_list_basedon_dynaminc_departuere_airport();
		/******************end***********/
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
				'css/jquery-ui.css','css/font-awesome.min.css',
				'css/google_font.css','css/custom.css',
				'css/responsive.css','css/menu.css',
				'css/preview.min.css','css/bxslider/jquery.bxslider.css',
				'css/tenerife-holidays.css','css/jquery.fancybox.css',
				'css/slideshow.css','css/popup_fancy.css',
				'js/jquery-ui.js','js/jquery.blockUI.js',
				'js/responsee.js','js/bxslider/jquery.bxslider.js',
				'js/jquery.fancybox.pack.js','js/gallery.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicResort',$data);
	}
	
	public function dynamicDeals()
	{
		$data = array();
		$this->load->model('ManagerChoices');
		$manager_deals = $this->ManagerChoices->fetch_a_search(array('deal_category'=>$_GET['type']),'ALL');
		
		
		
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css',
				'css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css',
				'css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css',
				'css/bxslider/jquery.bxslider.css','css/jquery.fancybox.css','css/mamaison.css',
				'css/tenerife-holidays.css','css/slideshow.css','js/jquery-ui.js',
				'js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js',
				'js/jquery.fancybox.pack.js','js/gallery.js','js/script-home.js'));
		for($i=0;$i<12;$i++){
			$data['calendar']['months'][date('m-Y', strtotime('+'.$i.' month'))] = date('M Y', strtotime('+'.$i.' month'));
		}
		$departures = new SimpleXMLElement(download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
		
		foreach ($departures as $departure)
		{
			$code = (array)$departure->attributes()->code;
			$name = (array)$departure->attributes()->name;
			$data['calendar']['filtered_departures'] = seperatorFlights($code[0],$name[0]);			
		}	
		$input_cal_info = array('month_cal' => date('m').'-'.date('Y'));
		$data['calendar']['datesInfo'] = $this->loadDates($input_cal_info);
		$data['calendar']['nights_limit'] = 21;
		$data['calendar']['book_types'] = array('fh'=>'Flights & Hotel','h' => 'Just Hotel','f'=>'Just Flight');		
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicDeals',$data);
	}
	
	public  function calendarDeals(){	
		if($this->input->post()){
			//echo "<pre>";print_r($this->input->post());exit;
			echo $this->loadDates($this->input->post());exit;			
		}
	}
	
	public function loadDates($input)
	{
		$month_arr = explode('-',$input['month_cal']);
		$num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_arr[0], $month_arr[1]);
		$html = '';
		$months = array('MON','TUE','WED','THU','FRI','SAT','SUN');
		$month_name = date('M',strtotime($month_arr[1] . "-" . $month_arr[0] . "-01"));
		for($i = 1; $i <= $num_of_days; $i++)
		{
			$day_name = date('D',strtotime($month_arr[1] . "-" . $month_arr[0] . "-" . str_pad($i, 2, '0', STR_PAD_LEFT)));
			if($i == 1){
				$fgaps = array_search(strtoupper($day_name),$months);
				for ($j=1;$j<=$fgaps;$j++){
					$html .= '<span>
		              		<div class="calendar_span calendar-price calendar_best_price">';
					$html .=  '</div>
	              	</span>';
				}
			}
			$html .= '<span>
	              <div class="calendar_span calendar-price calendar_best_price">
						<div>
								<a>
									<small class="date"> '.$i.' '.$month_name.'</small>
									<small class="from">from</small>
			                  		<div class="price" style="color:#F19412; font-weight:bold;"> <b>�119</b> </div>
			                  	</a>
							</div>
					</div>
              	</span>';
		
			//if(strtoupper($day_name) == 'SUN')$html .= '<br>';
			//$dates[] = $month_arr[1] . "-" . $month_arr[0] . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
		
		}
		return $html;
		
	}
	
	
	
}
