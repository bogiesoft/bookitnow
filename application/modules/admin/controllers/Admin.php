<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * 
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'Layouts' );
		$this->layouts->add_include ( $this->config->item ( 'header_css' ) );
		$this->layouts->add_include ( $this->config->item ( 'header_js' ) );
		$this->load->helper ( 'form', 'url', 'common' );
		$this->load->helper ( 'common' );
		$this->load->model ( 'User' );
		$this->load->library ( 'form_validation' );
	}
	public function index() {
		if ($this->input->post ()) {
			$this->form_validation->set_rules ( 'email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules ( 'password_hash', 'Password', 'trim|required|min_length[3]' );
			if (! $this->form_validation->run ()) {
			} else {
				$_POST ['password_hash'] = md5 ( $this->input->post ( 'password_hash' ) );
				if ($row = $this->User->fetch_a_user ( $this->input->post () )) {
					$newdata = array (
							'id' => $row [0] ['id'],
							'email' => $row [0] ['email'],
							'logged_in' => TRUE 
					);
					$this->session->set_userdata ( $newdata );
					redirect ( base_url () . 'admin/listings' );
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
		$this->layouts->view ( 'login' );
	}
	public function forgot_pwd() {
		$this->layouts->add_include ( array (
				'css/login.css',
				'css/font-awesome.min.css' 
		) );
		$this->layouts->set_title ( 'Forgot Password' );
		$this->layouts->view ( 'forgot' );
	}
	public function dashboard() {
		$this->layouts->add_include ( array (
				'css/login.css',
				'css/font-awesome.min.css' 
		) );
		$this->layouts->set_title ( 'Admin Dashboard' );
		$this->layouts->view ( 'dashboard' );
	}
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( base_url () );
	}
	public function listings() {
		$data = array ();
		$this->load->model ( 'Categories' );
		$this->layouts->add_include(array('css/bxslider/jquery.bxslider.css','js/jquery.blockUI.js'));
		$data ['categories'] = $this->Categories->fetch_all ();
		$depts_raw = new SimpleXMLElement ( download_page ( 'http://87.102.127.86:8005/search/websearch.exe?pageid=4&compid=1' ) );
		$data ['countries'] = json_decode ( json_encode ( $depts_raw ), true );
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',
				'css/admin/accordion.css',
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js' 
		) );
		$this->layouts->set_title ( 'Listings page' );
		$this->layouts->view ( 'listings', $data, 'admin' );
	}
	public function add_luggage() {
		$data = array ();
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',				
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js' 
		) );
		
		if ($this->input->post ()) {
			$this->form_validation->set_rules ( 'airline_name', 'Airline name', 'trim|required' );
			$this->form_validation->set_rules ( 'airline_code', 'Airline code', 'trim|required|min_length[2]' );
			$this->form_validation->set_rules ( 'weight', 'Bag weight', 'trim|required|numeric' );
			$this->form_validation->set_rules ( 'price', 'Price of the bag', 'trim|required|numeric' );
			if (! $this->form_validation->run ()) {
				
			} else {
				$this->load->model ( 'AlLugagePrice' );
				if($this->AlLugagePrice->insertRecord($this->input->post()))
				{
					$this->session->set_flashdata ( 'message', 'You have successfully created new record' );
					redirect(base_url().'admin/luggage_view');
				}
				else
				{
					$this->session->set_flashdata ( 'message', 'Sorry,Something went wrong' );
					redirect ( base_url () . 'admin/add_luggage' );
				}
				
			}
		}
		
		
		$this->layouts->set_title ( 'Admin Dashboard' );
		$this->layouts->view ( 'add_luggage.php', $data, 'admin' );
	}
	
	public  function luggage_view()
	{
		$data = array ();
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js'
		) );
		$this->load->model ( 'AlLugagePrice' );
		$data['rows'] = $this->AlLugagePrice->getAll();		
		$this->layouts->set_title ( 'Luggage view' );
		$this->layouts->view ( 'luggage_view.php', $data, 'admin' );
	}
	
	public  function deleteLug_fun()
	{
		if ($this->input->post ()) {
			$this->load->model ( 'AlLugagePrice' );
			if($this->AlLugagePrice->deleteRow($this->input->post('id')))
			{
				echo "success";
			}
			else
			{
				echo "failure";
			}
		}
		exit;
	}
	
	public function edit_luggage($id=null)
	{
		if ((int)$id)
		{
			$data = array ();
			$this->layouts->add_include ( array (
					'css/admin/style.css',
					'css/admin/lines.css',
					'css/font-awesome.min.css',
					'css/google_font.css',
					'css/admin/custom.css',
					'js/admin/metisMenu.min.js',
					'js/admin/custom.js',
					'js/admin/d3.v3.js',
					'js/admin/rickshaw.js'
			) );
			
			$this->load->model ( 'AlLugagePrice' );
			$data['row'] = $this->AlLugagePrice->fetch_a_search(array('id'=>$id));
			//echo '<pre>';print_r();exit;
			if ($this->input->post ()) {
				$this->form_validation->set_rules ( 'airline_name', 'Airline name', 'trim|required' );
				$this->form_validation->set_rules ( 'airline_code', 'Airline code', 'trim|required|min_length[2]' );
				$this->form_validation->set_rules ( 'weight', 'Bag weight', 'trim|required|numeric' );
				$this->form_validation->set_rules ( 'price', 'Price of the bag', 'trim|required|numeric' );
				if (! $this->form_validation->run ()) {
			
				} else {
			
					if($this->AlLugagePrice->update_row($this->input->post(),$id))
					{
						$this->session->set_flashdata ( 'message', 'Record updated successfully' );
						redirect(base_url().'admin/luggage_view');
					}
					else
					{
						$this->session->set_flashdata ( 'message', 'Sorry,Something went wrong' );
						redirect ( base_url () . 'admin/edit_luggage' );
					}
			
				}
			}
			
			
			$this->layouts->set_title ( 'Admin Dashboard' );
			$this->layouts->view ( 'edit_luggage.php', $data, 'admin' );
		}
		else
		{
			abort('404');
		}
		
	}
	
	public  function booking_info()
	{
		$data = array ();
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js'
		) );
		$this->load->model ( 'Bookinginfo' );
		$data['rows'] = $this->Bookinginfo->fetch_a_search(array(),'ALL');
		$adult_raw_info = json_decode($data['rows'][0]['adults_info']);
		
		//echo $adult_raw_info->fname[0];
		//echo '<pre>';print_r();
		//exit;
		$this->layouts->set_title ( 'Booking Information' );
		$this->layouts->view ( 'booking_info.php', $data, 'admin' );
	}
	
	public function view_booking($id=null)
	{
		if ((int)$id)
		{
			$data = array ();
			$this->layouts->add_include ( array (
					'css/admin/style.css',
					'css/admin/lines.css',
					'css/font-awesome.min.css',
					'css/google_font.css',
					'css/admin/custom.css',
					'js/admin/metisMenu.min.js',
					'js/admin/custom.js',
					'js/admin/d3.v3.js',
					'js/admin/rickshaw.js'
			) );
				
			$this->load->model ( 'Bookinginfo' );
			$data['row'] = $this->Bookinginfo->fetch_a_search(array('id'=>$id));
			
			if ($this->input->post ()) {
				$this->form_validation->set_rules ( 'adult_fname');
				$this->form_validation->set_rules ( 'adult_lname');
				$this->form_validation->set_rules ( 'email');
				$this->form_validation->set_rules ( 'mobile');
				
			}
				
				
			$this->layouts->set_title ( 'Admin Dashboard' );
			$this->layouts->view ( 'view_booking.php', $data, 'admin' );
		}
		else
		{
			abort('404');
		}
	
	}
	
	
	public function saveListingFun() {
		if ($this->input->post ()) {			
			$this->load->model ( 'Arrivals' );
			$row = $this->Arrivals->fetch_a_row ( array (
					'map_root' => $this->input->post( 'val' )
			) );
			if ($this->input->post( 'check_result' )) {				
				if (! empty ( $row )) {
				//	print_r($this->input->post());exit;
					$this->Arrivals->update_record($this->input->post());
					echo "update";
				} else {
					$this->Arrivals->insert_record( $this->input->post());
					echo "insert";
				}
			} else {
				if (! empty ( $row )) {
					$this->Arrivals->delete_record($row[0]['id']);
					echo "delete";
				}				
			}
			exit;
		}
	}
	
	public function addExtras()
	{
		$data = array();
		$this->load->model ( 'ExtraCategories' );
		$data['categories'] = $this->ExtraCategories->fetch_a_category(array(),'ALL');	
		$this->layouts->add_include(array('css/bxslider/jquery.bxslider.css','js/jquery.blockUI.js'));		
		$depts_raw = new SimpleXMLElement ( download_page ( 'http://87.102.127.86:8005/search/websearch.exe?pageid=4&compid=1' ) );
		$data ['countries'] = json_decode ( json_encode ( $depts_raw ), true );
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',
				'css/admin/accordion.css',
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js'
		) );
		$this->layouts->set_title ( 'Listings page' );
		$this->layouts->view ( 'listings', $data, 'admin' );
		
		//echo '<pre>';print_r($rows);exit;
	}
	public function mang_ext_categories()
	{
		$this->load->model ( 'ExtraCategories' );
		$data = array ();
		
		if($this->input->post())
		{
			
			if($this->ExtraCategories->updateByCond(array('status'=>0),1))
			{
				if(!empty($this->input->post('cat')))
				{
					foreach ($this->input->post('cat') as $key => $cat){
					
						$this->ExtraCategories->updateRow(array('status'=>1),$key);
					}
				}		
			}	
		}
		$data['categories'] = $this->ExtraCategories->fetch_a_category(array(),'ALL');
		$this->layouts->add_include ( array (
				'css/admin/style.css',
				'css/admin/lines.css',
				'css/font-awesome.min.css',
				'css/google_font.css',
				'css/admin/custom.css',
				'js/admin/metisMenu.min.js',
				'js/admin/custom.js',
				'js/admin/d3.v3.js',
				'js/admin/rickshaw.js'
		) );
		
		$this->layouts->set_title ( 'Exytra category management' );
		$this->layouts->view ( 'ext_fld_mng.php', $data, 'admin' );
	}
	
	public function readMappingsFun() {
		
		$this->load->model ( 'Arrivals' );
		$arr_rows = $this->Arrivals->fetch_all();		
		$arr_rows = array_column($arr_rows,'map_root');		
		$str = '';
		if ($this->input->post ( 'pos' ) == 'country') {
			$depts_raw = new SimpleXMLElement ( download_page ( "http://87.102.127.86:8005/search/websearch.exe?pageid=5&compid=1&countryid=" . $this->input->post ( 'com_id' ) ) );
			$depts_raw = json_decode ( json_encode ( $depts_raw ), true );
			$t = array ();
			foreach ( $depts_raw ['country'] as $key_country => $regions ) {
				if ($key_country == 'region') {
					$count = 0;
					foreach ( $regions as $key_region => $region ) {
						if ($key_region === '@attributes') {
							
							$str .= "<li><span class='regions'>". urldecode($regions ['@attributes'] ['name']) . '</span>';
							$count_area = 0;
							foreach ( $regions ['area'] as $key_area => $area ) {							
								if ($key_area === '@attributes') {
									$arrpts = 'arrivals='.$regions ['area'] ['@attributes'] ['arrapts']; //new
									$cra = $this->input->post ( 'com_id' ) . '-' . $regions ['@attributes'] ['Id'] . '-' . $regions ['area'] ['@attributes'] ['id'];	//new								
									$attribute = in_array($cra,$arr_rows) ? 'checked' : '';								//new
									$str .= "<ul><li><input $arrpts type='checkbox' $attribute value='" . $cra . "' onchange='checkMe(this)' /><span>". urldecode($regions ['area'] ['@attributes'] ['name']) . '</span><ul>';
									//$cra = $this->input->post ( 'com_id' ) . '-' . $regions ['@attributes'] ['Id'] . '-' . $regions ['area'] ['@attributes'] ['id'] . '-';
									//$count_resort = 0;
									/*foreach ( $regions ['area'] ['resort'] as $key_resort => $resort ) {
										if ($key_resort === '@attributes') {
											$mixed_crar = $cra . $regions ['area'] ['resort'] ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$regions ['area'] ['resort'] ['@attributes'] ['arrapts'];
											
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $regions ['area'] ['resort'] ['@attributes'] ['name'] . "</span></li>";
											// $t[] = $regions['area']['resort']['@attributes']['id'].'-'.$regions['area']['resort']['@attributes']['name'];
											$count_resort ++;
										}
										if (! $count_resort) {
											$mixed_crar = $cra . $resort ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$resort ['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute  value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $resort ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $resort['@attributes']['id'].'-'.$resort['@attributes']['name'];
										}
									}*/
									$str .= '</ul></li></ul>';
									$count_area ++;
								}
								if (! $count_area) {
									$arrpts = 'arrivals='.$area['@attributes'] ['arrapts']; //new
									$cra = $this->input->post ( 'com_id' ) . '-' . $regions ['@attributes'] ['Id'] . '-' . $area ['@attributes'] ['id'];	//new								
									$attribute = in_array($cra,$arr_rows) ? 'checked' : '';			//new				
									$str .= "<ul><li><input $arrpts type='checkbox' $attribute value='" . $cra . "' onchange='checkMe(this)' /><span>". urldecode($area ['@attributes'] ['name']) . ' </span><ul>';
									//$cra = $this->input->post ( 'com_id' ) . '-' . $regions ['@attributes'] ['Id'] . '-' . $area ['@attributes'] ['id'] . '-';
									//$count_resort = 0;
									/*foreach ( $area ['resort'] as $key_resort => $resort ) {
										if ($key_resort === '@attributes') {
											$mixed_crar = $cra . $area ['resort'] ['@attributes']['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';	
											$arrpts = 'arrivals='.$area ['resort'] ['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $area ['resort'] ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $area['resort']['@attributes']['id'].'-'.$area['resort']['@attributes']['name'];
											$count_resort ++;
										}
										if (! $count_resort) {
											$mixed_crar = $cra . $resort ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$resort ['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $resort ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $resort['@attributes']['id'].'-'.$resort['@attributes']['name'];
										}
									}*/
									$str .= '</ul></li></ul>';
								}
							}
							$str .= '</li>';
							$count ++;
						}
						
						if (! $count) {
							$str .= "<li><span class='regions'>" .urldecode($region ['@attributes'] ['name']).'</span>';
							$count_area = 0;
							foreach ( $region ['area'] as $key_area => $area ) {
								
								if ($key_area === '@attributes') {
									$arrpts = 'arrivals='.$region ['area'] ['@attributes'] ['arrapts']; //new
									$cra = $this->input->post ( 'com_id' ) . '-' . $region ['@attributes'] ['Id'] . '-' . $region ['area'] ['@attributes'] ['id'] ;	//new
									$attribute = in_array($cra,$arr_rows) ? 'checked' : '';
									$str .= "<ul><li><input $arrpts type='checkbox' $attribute value='" . $cra . "' onchange='checkMe(this)' /><span>". urldecode($region ['area'] ['@attributes'] ['name']) . "</span><ul>";
									//$count_resort = 0;
									//$cra = $this->input->post ( 'com_id' ) . '-' . $region ['@attributes'] ['Id'] . '-' . $region ['area'] ['@attributes'] ['id'] . '-';
									/*foreach ( $region ['area'] ['resort'] as $key_resort => $resort ) {
										if ($key_resort === '@attributes') {
											$mixed_crar = $cra . $region ['area'] ['resort'] ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$region ['area'] ['resort']['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)'/><span>" . $region ['area'] ['resort'] ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $region['area']['resort']['@attributes']['id'].'-'.$region['area']['resort']['@attributes']['name'];
											$count_resort ++;
										}
										if (! $count_resort) {
											$mixed_crar = $cra . $resort ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$resort ['@attributes'] ['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $resort ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $resort['@attributes']['id'].'-'.$resort['@attributes']['name'];
										}
									}*/
									$str .= '</ul></li></ul>';
									$count_area ++;
								}
								if (! $count_area) {
									$arrpts = 'arrivals='.$area['@attributes'] ['arrapts']; //new
									$cra = $cra = $this->input->post ( 'com_id' ) . '-' . $region ['@attributes'] ['Id'] . '-' . $area ['@attributes'] ['id'] ;	//new
									$attribute = in_array($cra,$arr_rows) ? 'checked' : '';			//new
									
									$str .= "<ul><li><input $arrpts type='checkbox' $attribute value='" . $cra . "' onchange='checkMe(this)' /><span>". urldecode($area ['@attributes'] ['name']) .  " </span><ul>";
									//$cra = $this->input->post ( 'com_id' ) . '-' . $region ['@attributes'] ['Id'] . '-' . $area ['@attributes'] ['id'] . '-';
									//$count_resort = 0;
									/*foreach ( $area ['resort'] as $key_resort => $resort ) {
										if ($key_resort === '@attributes') {
											$mixed_crar = $cra . $area ['resort'] ['@attributes'] ['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$area ['resort'] ['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $area ['resort'] ['@attributes'] ['name'] . "</span></li>";
											// $t[] = $area['resort']['@attributes']['id'].'-'.$area['resort']['@attributes']['name'];
											$count_resort ++;
										}
										if (! $count_resort) {
											$mixed_crar = $cra . $resort ['@attributes']['id'];
											$attribute = in_array($mixed_crar,$arr_rows) ? 'checked' : '';
											$arrpts = 'arrivals='.$resort ['@attributes']['arrapts'];
											$str .= "<li><input $arrpts type='checkbox' $attribute value='" . $mixed_crar . "' onchange='checkMe(this)' /><span>" . $resort ['@attributes'] ['name'] . '</span></li>';
											// $t[] = $resort['@attributes']['id'].'-'.$resort['@attributes']['name'];
										}
									}*/
									$str .= '</ul></li></ul>';
								}
							}
							$str .= '</li>';
						}
					}
				}
			}
		}
		echo $str;
		exit;
	}
}
