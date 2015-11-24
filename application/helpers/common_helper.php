<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  if( !function_exists('download_page') ) {    
  function download_page($path){
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
  }
  
  if( !function_exists('encrypt_decrypt') ) {
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
  }
  
  if( !function_exists('dept_images') ) {
  	function dept_images()
  	{
  		return array(
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
  	}
  }
  
  if( !function_exists('str_date') ) {
  	function str_date($dt)
  	{
  		return $dt;
  	}
  }
  
if( !function_exists('boardbasis') ) {
  	function boardbasis($code)
  	{
  		$boardbasis_arr = array('AI' => 'All Inclusive',
				'RO' => 'Room Only',
				'BB' => 'Bed and Breakfast',
				'SC' => 'Self Catering',
				'HB' => 'Half Board',
				'FB' => 'Full Board'
		);
  		return $boardbasis_arr[$code];
  	}
  }
  
  if( !function_exists('emailFunction') ) {
  	function emailFunction($ci,$subject,$body,$from,$sendername,$list)
  	{  		
  		//echo '<pre>';print_r($ci);exit;
  			$config['protocol'] = "smtp";
  			$config['smtp_host'] = SMTP_HOST;
  			$config['smtp_port'] = SMTP_PORT;
  			$config['smtp_user'] = SMTP_EMAIL;
  			$config['smtp_pass'] = SMTP_PASSWORD;
  			$config['smtp_crypto'] = SMTP_ENCRPT;
  			$config['charset'] = "iso-8859-1";
  			$config['mailtype'] = "html";
  			//$config['newline'] = "\r\n";
  			//$config['validate'] = TRUE;
  			//);
  			$ci->load->library('email', $config);
  			$ci->email->set_newline("\r\n");
  			//$ci->email->initialize($config);
  		
  			$ci->email->from($from, $sendername);  			
  			$ci->email->to($list);
  			$ci->email->reply_to($from, $sendername);
  			$ci->email->subject($subject);
  			$ci->email->message($body);
  			if($ci->email->send())
  			{
  				return true;
  				//echo "success";
  			}
  			else
  			{
  				return false;
  				//print_r($ci->email->print_debugger(array('headers')));
  			}
  	}
  }
  
  if( !function_exists('temp_savings_array') ) {
  	function temp_savings_array()
  	{
  		$temp = array();
  		$temp['return_transsfers'] = array(
  				'shared_shuttle' => 15.80,
  				'shuttle_bus' => 17.33
  		);
  		$temp['secure_parking'] = array(
  				'airparks' => 47.99,
  				'paige' => 17.33
  		);
  		$temp['car_hire'] = array(
  				'small' => 25.30,
  				'economy' => 27.10
  		);
  		return $temp;
  	}
  }
  
  if( !function_exists('fetch_departures') ) {
	  function fetch_departures()
	  {
	  	$depts_raw = new SimpleXMLElement(download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
	  	$departures = array();
	  	foreach ($depts_raw as $departure)
	  	{
	  		$code = (array)$departure->attributes()->code;
	  		$name = (array)$departure->attributes()->name;
	  		$departures[$code[0]] = $name[0];
	  	}
	  	return $departures;
	  }
  }
  if( !function_exists('fetch_arrivals') ) {
	  function fetch_arrivals()
	  {
	  	$arrivals = array();
	  	$results['arrivals'] = new SimpleXMLElement(download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=2&compid=1'));
	  	foreach ($results['arrivals'] as $arrival)
	  	{
	  		$code = (array)$arrival->attributes()->code;
	  		$name = (array)$arrival->attributes()->name;
	  		$arrivals[$code[0]] = $name[0];
	  	}
	  	return $arrivals;
	  }
  }
  
  if( !function_exists('distribute') ) {
  function distribute($m,$n) {
  		
  	$div = floor($m / $n);
  	$mod = fmod($m, $n);
  	$result = array();
  	for ($i = 1;$i <= $n;$i++) {
  		$result[$i] = $div;
  	}
  		
  	if ($mod > 0) {
  		for ($i = 1;$i <= $mod;$i++) {
  			$result[$i] = $result[$i] + 1;
  		}
  	}
  	return $result;
  }
  }
  
  if( !function_exists('hotelsStr_fun') ) {
  	function hotelsStr_fun($hotels,$tree = array())
  	{
  		
  		$str = '';
  		$cra = $tree[0] . '-' . $tree[1] . '-' . $tree[2] . '-'. $tree[3].'-';	//new
  		$count_hotel = 0;
  		foreach ($hotels as $key_hotel =>$hotel)
  		{  	
  			
  			if ($key_hotel === '@attributes') {
  				$str .= "<li><input type='checkbox' value='" . $cra.$hotel['id']. "' onchange='checkMe(this)' /><span>". urldecode($hotel['name']) . '</span></li>';
  				$count_hotel++;
  			}
  			if(!$count_hotel){
  				$str .= "<li><input type='checkbox' value='" . $cra.$hotel['@attributes']['id']. "' onchange='checkMe(this)' /><span>". urldecode($hotel['@attributes']['name']) . '</span></li>';
  			}
  			
  		}
  		
  		return $str;
  	}
  };
  
  	
  
