<?php
//============================================================+
// File name   : booking.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
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

$tbl = <<<EOD
<table border="0" cellpadding="2" cellspacing="2" nobr="true">
 
 <tr>
  <td style="width:60%"><b>Your Personal Travel Advisor:</b> Howard Finch</td>
  <td style="width:40%"><b>Quote Reference:</b> SUP-QQ-98251</td>
 </tr>
 <tr>  
  <td style="width:60%"><b>Phone Number:</b> 08006947174</td>
  <td style="width:40%"><b>Date:</b> 01/12/15</td> 
 </tr>
 <tr>
  <td style="width:60%"><b>Email Address:</b> satya@test.com</td>
  <td style="width:40%"><b>Adults:</b> 2 <b>Children:</b> 0 <b>Infants:</b> 0</td>  
 </tr>
</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl = <<<EOD
<div style="margin-top:20px;">
	<p>Dear Rob</p>
	<p></p>
	<p>
		I have pleasure in enclosing a quote in respect of your recent enquiry with Super Escapes. Please feel free to contact us, should you need any more information or advice.
	</p>
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');


$tbl = <<<EOD
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
        <td >Bristol International Airport Fuerteventura Airport</td>
        <td>09/12/15</td>
		<td>08:05</td>
		<td>09/12/15</td>
		<td>12:10</td>
		<td>EZY6065</td>
    </tr>
    <tr>
		<td>Fuerteventura Airport Bristol International Airport</td>
    	<td>09/12/15</td>
		<td>08:05</td>
		<td>09/12/15</td>
		<td>12:10</td>
		<td>EZY6065</td>
    </tr>  
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOD
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
        <td style="text-align:center;">Dunas Caleta Club</td>
        <td style="text-align:center;">Corralejo</td>
		<td style="text-align:center;">All Inclusive Standard</td>
		<td style="text-align:center;">1 Bedroom Apartment</td>
		<td style="text-align:center;">2 KEY</td>		
    </tr>
    <tr>
		<td style="text-align:center;font-weight:bold;">Check In</td>
    	<td style="text-align:center;font-weight:bold;">Check Out</td>
		<td style="text-align:center;font-weight:bold;">Adults</td>
		<td style="text-align:center;font-weight:bold;">Children</td>
		<td style="text-align:center;font-weight:bold;">Infants</td>
    </tr>
	<tr>
		<td style="text-align:center;">09/12/15</td>
    	<td style="text-align:center;">09/12/15</td>
		<td style="text-align:center;">2</td>
		<td style="text-align:center;">1</td>
		<td style="text-align:center;">1</td>
    </tr>	
</table>
EOD;

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
	<img src="http://192.168.1.101:9999/images/abta.png"/>
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

$tbl = <<<EOD
<div style="margin-top:20px;">	
	<p>Yours sincerely</p>
	<p>Howard Finch</p>	
</div>
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
//$pdf->Output('D:\xampp\htdocs\test_plugins\tcpdf\examples\example_001.pdf', 'F');
$t = $pdf->Output('example_001.pdf', 'I');
//$data = chunk_split($t);
/*$subject = 'test attachment';
$body = 'booking info';
$from = 'prattipati.satyanarayana@gmail.com';
$sendername = "vinod";
$list = array('satya@expertwebworx.com');
 		
  		
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
			$this->email->attach($data);
  			$ci->email->message($body);
  			if($ci->email->send())
  			{
  				echo "hello";  				
  			}
  			else
  			{
  				echo "else";  				
  			}*/
	exit;

//============================================================+
// END OF FILE
//============================================================+
