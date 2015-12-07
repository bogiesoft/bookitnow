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
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals',$data);
	}
	
	public function dynamicArea(){
		$data = array();
		$this->layouts->add_include(array('css/bootstrap-responsive.min.css','css/jquery-ui.css','css/font-awesome.min.css','css/google_font.css','css/custom.css','css/responsive.css','css/menu.css','css/preview.min.css','css/bxslider/jquery.bxslider.css','css/tenerife-holidays.css','js/jquery-ui.js','js/jquery.blockUI.js','js/responsee.js','js/bxslider/jquery.bxslider.js','js/script-home.js'));
		$this->layouts->set_title('Home');
		$this->layouts->view('deals/dynamicarea',$data);
	}
	

	
}
