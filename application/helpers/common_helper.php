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
  
//   if( !function_exists('temp_savings_array') ) {
//   	function temp_savings_array()
//   	{
//   		$temp = array();
//   		$temp['return_transsfers'] = array(
//   				'shared_shuttle' => 15.80,
//   				'shuttle_bus' => 17.33
//   		);
//   		$temp['secure_parking'] = array(
//   				'airparks' => 47.99,
//   				'paige' => 17.33
//   		);
//   		$temp['car_hire'] = array(
//   				'small' => 25.30,
//   				'economy' => 27.10
//   		);
//   		return $temp;
//   	}
//   }
  
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
  
//   function array_value_recursive($key, array $arr){
//   	$val = array();
//   	array_walk_recursive($arr, function($v, $k) use($key, &$val){
  		
//   		if($k == $key) array_push($val, $v);
//   	});
  		
//   		return count($val) > 1 ? $val : array_pop($val);
//   }

  function cmp($a, $b) {
  	if ($a['@attributes'] == $b['@attributes']) {
  		return 0;
  	}
  	return ($a['@attributes']['sellpricepp'] < $b['@attributes']['sellpricepp']) ? 1 : -1;
  }
  
  
  function seperatorFlights($code,$name)
  {
  	static $departures = array();
  	$sp_ar = explode(' - ',$name);
  	$county = (@$sp_ar[1] != '') ? @$sp_ar[1] : @$sp_ar[0];
  	$departures[$county][$code] = $sp_ar[0];
  	return $departures;
  }
  
  function changeSearch(&$data){
  	$results['departures'] = new SimpleXMLElement(download_page('http://87.102.127.86:8005/search/websearch.exe?pageid=1&compid=1'));
  	foreach ($results['departures'] as $departure)
  	{
  		$code = (array)$departure->attributes()->code;
  		$name = (array)$departure->attributes()->name;
  		$data['filtered_departures'] = seperatorFlights($code[0],$name[0]);
  		$data['departures'][$code[0]] = $name[0];
  	}
  	/*if ( ! $foo = $this->cache->get('departures'))
  	{
  		$foo = $data['departures'];
  		// Save into the cache for 60 minutes
  		$this->cache->save('departures', $foo, 3600);
  	}*/
  }
  	
	
	
	
	
	
	
	
	
	
  require_once('tcpdf/examples/tcpdf_include.php');	
  class MYPDF extends TCPDF {
  
  	//Page header
  	public function Header() {
  		// Logo
  		//echo getcwd();exit;
  		$image_file = 'images/logo.png'; // *** Very IMP: make sure this image is available on given path on your server
  		$this->Image($image_file,20,6,25);
  		// Set font
  		$this->SetFont('helvetica', 'C', 12);
  
  		// Line break
  		$this->Ln(5);
  		$this->SetTextColor(9,79,162);
  		$this->Cell(210, 15, 'BookItNow Travel', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  		//$this->SetTextColor(255,0,0);
  		$this->Ln(6);
  		$this->SetFont('times', 'BI', 10, '', 'false');
  		$this->Cell(210, 0, 'Unit 1 Finway | Dallow Road | Luton | Beds | LUI IWE', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  		$this->Ln(5);
  		$this->Cell(210, 0, 'T:0138 629 8003 E : info@bookitnow.co.uk W : www.bookitnow.co.uk', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  		
  		$this->writeHTML('<br/><hr/><br/>', true, false, false, false, '');
//   		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
  		
//   		$this->Line(5, 10, 80, 30, $style);
  		// We need to adjust the x and y positions of this text ... first two parameters
  
  	}
  
  	// Page footer
//   	public function Footer() {
//   		// Position at 25 mm from bottom
//   		$this->SetY(-15);
//   		// Set font
//   		$this->SetFont('helvetica', 'I', 8);
  
//   		$this->Cell(0, 0, 'Product Company - ABC test company, Phone : +91 1122 3344 55, TIC : TESTTEST', 0, 0, 'C');
//   		$this->Ln();
//   		$this->Cell(0,0,'www.clientsite.com - T : +91 1 123 45 64 - E : info@clientsite.com', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  
//   		// Page number
//   		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
//   	}
  
  }
  
	
	
	
	
	
	
	function boookattach($results,$type='')
	{
		
// Include the main TCPDF library (search for installation path).
 //require_once('tcpdf/examples/tcpdf_include.php');
 $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 001');
//$pdf->SetSubject('<h1>TCPDF Tutorial</h1>');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '<div style="float:right">haoooooooo</div>', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>1, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>0, 'blend_mode'=>'Normal'));

// Set some content to print

$tbl = '	
<table border="0" cellpadding="2" cellspacing="2" nobr="true">
 
 <tr>
  <td style="width:60%"><b>Your Personal Travel Advisor:</b>'.@$results['pdfdata']['adviser_info']['name'].'</td>
  <td style="width:40%"><b>Quote Reference:</b>'.@$results['pdfdata']['adviser_info']['reference'].'</td>
 </tr>
 <tr>  
  <td style="width:60%"><b>Phone Number:</b>'.@$results['pdfdata']['adviser_info']['phone'].'</td>
  <td style="width:40%"><b>Date:</b> '.@$results['pdfdata']['adviser_info']['date'].'</td> 
 </tr>
 <tr>
  <td style="width:60%"><b>Email Address:</b>'.@$results['pdfdata']['adviser_info']['email'].'</td>
  <td style="width:40%"><b>Adults:</b> '.@$results['seg'][0]['num_adults'].' <b>Children:</b> '.@$results['seg'][0]['num_children'].'</td>  
 </tr>
</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');
//$ci = $results['controller'];
$t = json_decode($results['row'][0]['adults_info'],true);


$tbl = '
<div>
	<p>Dear '.$t['fname'][0].'</p>
	<p></p>
	<p>
		I have pleasure in enclosing a quote in respect of your recent enquiry with Super Escapes. Please feel free to contact us, should you need any more information or advice.
	</p>
</div>';
$pdf->writeHTML($tbl, true, false, false, false, '');

$depts = fetch_departures();
$arrivs = fetch_arrivals();
$dep_arr = explode('-',$depts[$results['fobj']['@attributes']['depapt']]);
$arr_arr = explode('-',$arrivs[$results['fobj']['@attributes']['arrapt']]);
$ret_arr = explode('-',$depts[$results['fobj']['@attributes']['retapt']]);
$dept_start_time = substr(explode(' ',$results['fobj']['@attributes']['outdep'])[1],0,-3);
$dept_arr_time = substr(explode(' ',$results['fobj']['@attributes']['outarr'])[1],0,-3);
$return_start_time = substr(explode(' ',$results['fobj']['@attributes']['indep'])[1],0,-3);
$return_arr_time = substr(explode(' ',$results['fobj']['@attributes']['inarr'])[1],0,-3);

$tbl = '
<b><u>Flight Details : </u></b><br><br>  
<table border="0" cellpadding="2" cellspacing="2" nobr="true">
	<tr>
		<th style="width:35%;text-align:center;font-weight:bold;">Route</th>
		<td style="width:13%;text-align:center;font-weight:bold;">Dep Date</td>
		<td style="width:13%;text-align:center;font-weight:bold;">Dep Time</td>
		<td style="width:13%;text-align:center;font-weight:bold;">Arr Date</td>
		<td style="width:13%;text-align:center;font-weight:bold;">Arr Time</td>
		<td style="width:13%;text-align:center;font-weight:bold;">Flight No</td>
	</tr>
    <tr>
        <td >'.current($dep_arr).' Airport '.array_pop($arr_arr).' Airport</td>
        <td>'.explode(' ',$results['fobj']['@attributes']['outdep'])[0].'</td>
		<td>'.$dept_start_time.'</td>
		<td>'.explode(' ',$results['fobj']['@attributes']['outarr'])[0].'</td>
		<td>'.$dept_arr_time.'</td>
		<td>'.$results['fobj']['@attributes']['suppname'].'</td>
    </tr>
    <tr>
         <td >'.array_pop($arr_arr).' Airport '.current($ret_arr).' Airport</td>
		<td>'.explode(' ',$results['fobj']['@attributes']['indep'])[0].'</td>    	
		<td>'.$return_start_time.'</td>
		<td>'.explode(' ',$results['fobj']['@attributes']['inarr'])[0].'</td>
		<td>'.$return_arr_time.'</td>
		<td>'.$results['fobj']['@attributes']['suppname'].'</td>
    </tr>  
</table>';
$ci = $results['controller'];

$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = '
<b><u>Accommodation Details: </u></b><br><br>  
<table border="0" cellpadding="2" cellspacing="2" nobr="true">
	<tr>
		<th style="text-align:center;font-weight:bold;">Hotel</th>
		<td style="text-align:center;font-weight:bold;">Resort</td>
		<td style="text-align:center;font-weight:bold;">Board</td>
		<td style="text-align:center;font-weight:bold;">Room</td>
		<td style="text-align:center;font-weight:bold;">Rating</td>		
	</tr>
    <tr>
        <td style="text-align:center;">'.urldecode($results['hobjs'][0]['@attributes']['hotelname']).'</td>
        <td style="text-align:center;">'.urldecode($results['hobjs'][0]['@attributes']['resort']).'</td>
		<td style="text-align:center;">'.boardbasis($results['hobjs'][0]['@attributes']['boardbasis']).'</td>
		<td style="text-align:center;">'.$results['seg'][0]['num_rooms'].' '.$results['hobjs'][0]['@attributes']['suppname'].'</td>
		<td style="text-align:center;">'.(int)$results['hobjs'][0]['@attributes']['starrating'].' KEY</td>		
    </tr>
    <tr>
		<td style="text-align:center;font-weight:bold;">Check In</td>
    	<td style="text-align:center;font-weight:bold;">Check Out</td>
		<td style="text-align:center;font-weight:bold;">Adults</td>
		<td style="text-align:center;font-weight:bold;">Children</td>
		<td style="text-align:center;font-weight:bold;">Infants</td>
    </tr>
	<tr>
		<td style="text-align:center;">'.$results['hobjs'][0]['@attributes']['checkindate'].'</td>
    	<td style="text-align:center;">'. date('d/m/Y',strtotime('+'.$results['hobjs'][0]['@attributes']['nights']." day",$ci->cvtDt(str_date($results['hobjs'][0]['@attributes']['checkindate'])))).'</td>
		<td style="text-align:center;">'.@$results['seg'][0]['num_adults'].'</td>
		<td style="text-align:center;">'.@$results['seg'][0]['num_children'].'</td>
		<td style="text-align:center;"></td>
    </tr>	
</table>';

$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl = <<<EOD
<div style="margin-top:20px;">
	<b><u>Price Summary:</u></p>	
	<p>
		The total price inclusive of any discounts for the holiday described above is: £653.92 To make a firm reservation please call us on 01386298033 and quote the reference number at the top of this quote. Our friendly and experienced travel consultants will be happy to book the above holiday or look for any alternatives that may suit your needs. 
	</p>
	<p>		
		May we take this opportunity of thanking you for your enquiry, and we do hope that we are able to assist you in fulfilling your requirements.
	</p>
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl = <<<EOD
<div style="margin-top:20px;text-align:center;">	
	<small>
		* All costings are subject to a final confirmation which will be given upon making a firm reservation *
	</small>
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOD
<div style="margin-top:20px;text-align:center;display:inline-block;">	
	<p style="color:blue">BookItNow Travel is a trading name of broadway Travel Services (Wimbledon) Ltd. Whose registered office is at Unit 1,Finway,Dallow Road,Luton,Beds LUI 1WE</p>
	<img src="/images/abta.png"/>
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl ='
<div style="margin-top:20px;">	
	<p>Yours sincerely</p>
	<p>'.@$results['pdfdata']['adviser_info']['name'].'</p>	
</div>';
$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
//$pdf->Output('D:\xampp\htdocs\test_plugins\tcpdf\examples\example_001.pdf', 'F');
if($type == 'email')
{
	$pdf->Output(getcwd().'/booking_files/'.$results['pdfdata']['adviser_info']['reference'].'.pdf', 'F');
	if(file_exists(getcwd().'/booking_files/'.$results['pdfdata']['adviser_info']['reference'].'.pdf'))
	{
		$subject = 'Quick Quote Ref: '.$results['pdfdata']['adviser_info']['reference'].' - Book it now';
		$body = 'Dear '.$t['fname'][0];
		$body .= '<p></p>';
		$body .= '<p>Please find the attached document</p>';
		$body .= '<p></p>';
		$body .= '<p>Cheers</p>';
		$body .= '<p>BootItNow</p>';
		
		$from = 'prattipati.satyanarayana@gmail.com';
		$sendername = "BookItNow Admin";
		$list = array($results['row'][0]['email']);
		
		
		$config['protocol'] = "smtp";
		$config['smtp_host'] = 'mail.expertwebworx.in';
		$config['smtp_port'] = '25';
		$config['smtp_user'] = 'campusxroads@expertwebworx.in';
		$config['smtp_pass'] = 'C}BA,RI25#c_c%UopsdW9neX';
		$config['smtp_crypto'] = 'tls';
		$config['charset'] = "iso-8859-1";
		$config['mailtype'] = "html";
		
		$ci->load->library('email', $config);
		$ci->email->set_newline("\r\n");
		
		
		$ci->email->from($from, $sendername);
		$ci->email->to($list);
		$ci->email->reply_to($from, $sendername);
		$ci->email->subject($subject);
		$ci->email->attach(getcwd().'/booking_files/'.$results['pdfdata']['adviser_info']['reference'].'.pdf');
		$ci->email->message($body);
		if($ci->email->send())
		{}	
	}	
}
else{
	$pdf->Output($results['pdfdata']['adviser_info']['reference'].'.pdf', 'D');
}


	
//============================================================+
// END OF FILE
//============================================================+

	}
	function findKey(&$array, $keySearch)
	{
		foreach ($array as $key => $item) {
			if ($key === $keySearch) {
				$array[$key] = $item;							
				return $array;
			}
			else {
				
				if (is_array($item) && findKey($item, $keySearch)) {					
					return $array;
				}				
			}
		}
		return false;
	}
	
	
	
	

  
