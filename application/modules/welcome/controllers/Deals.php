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
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->helper(array('form','url','common'));
		$this->load->model('UserSearch');
		
	}
	public function index()
	{
		$data = array();
	    $this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/jquery.fancybox.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/responsiveslides.min.js','js/bxslider/jquery.bxslider.js','js/parallax-slider/jquery.cslider.js','js/jquery.fancybox.pack.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$results = array();			
		$this->layouts->view('dynamicarea',$data);
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
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/tenerife-holidays.css','css/jquery.fancybox.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/script-home.js'));
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
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/tenerife-holidays.css','css/jquery.fancybox.css','css/slideshow.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/gallery.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicResort',$data);
	}
	
	public function dynamicDeals(){
		$data = array();
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/tenerife-holidays.css','css/jquery.fancybox.css','css/slideshow.css','css/mamaison.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js','js/jquery.fancybox.pack.js','js/gallery.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicDeals',$data);
	}
	

	
}
