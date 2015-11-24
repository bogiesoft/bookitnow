<div class="clearfix"></div>
<div id="body_content">
<div class="container">
<!-- booknow start here-->
<div class="col-sm-9" style="padding-left:0px;">
	<div class="orderhotels-top">
		<div class="row">
			<div class="col-sm-6 col-md-9">
				<h4 class="booknow-font"> <b>Secure Booking.</b></h4>
				<h5>Please Check Your Selections Carefully Before Submitting Your Booking.</h5>						
			</div>				
		</div>
	</div>		
		
<div class="orderhotels-one ">	
 <?php 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'book_form','onSubmit' => "return basket('".$this->uri->segment(2)."',this)");
			echo form_open(base_url().'extras/basket', $attributes);
		?>
<h4 class="booknow-font"><b>Party Details<b></h4>
				<h5>Note: Passenger names must match passports exactly. </h5>		
		<div class="row">
		<?php for($i=1;$i<=$seg[0]['num_adults'];$i++){ ?>
		<div class="col-sm-6 col-md-12">		
				<h5><?php if($i == 1)echo 'Lead';?> Adult (<?php echo $i;?>) </h5>
		</div>	
				<div class="col-sm-6 col-md-2">	
					<div class="form-group">
						<select name="adult_title_<?php echo $i;?>"  title="Select title">
							<option value="-1">Select Title</option>
							<option value="Mr">Mr</option>
							<option value="Mrs">Mrs</option>
							<option value="Ms">Ms</option>				
						</select>
					</div>	
				</div>
				<div class="col-sm-6 col-md-3">				 
					<div class="form-group">   
					<input title="First Name" class="form-control" name="adult_fname_<?php echo $i;?>" placeholder="First Name">
					</div>
				 
				</div>
				<div class="col-sm-6 col-md-3">
				  
					<div class="form-group">   
					<input title="Last Name" class="form-control" name="adult_lname_<?php echo $i;?>" placeholder="Last Name">
					</div>
				  
				</div>	
				<div class="col-sm-6 col-md-3">
				  
					<div class="form-group">   
					<input title="Date of Birth	" class="form-control datepicker_book" name="adult_dob_<?php echo $i;?>" placeholder="Date of Birth">
					</div>
				  
				</div>
				<?php } ?>
				
		<?php for($i=1;$i<=$seg[0]['num_children'];$i++){ ?>
		<div class="col-sm-6 col-md-12">		
				<h5> Child (<?php echo $i;?>) </h5>
		</div>	
				<div class="col-sm-6 col-md-2">	
					<div class="form-group">
						<select name="child_title_<?php echo $i;?>" title="Select title">
							<option value="-1">Select Title</option>
							<option value="Mast">Mast</option>
							<option value="Miss">Miss</option>										
						</select>
					</div>	
				</div>
				<div class="col-sm-6 col-md-3">				 
					<div class="form-group">   
					<input title="First Name" class="form-control" name="child_fname_<?php echo $i;?>" placeholder="First Name">
					</div>
				 
				</div>
				<div class="col-sm-6 col-md-3">
				  
					<div class="form-group">   
					<input title="Last Name" class="form-control" name="child_lname_<?php echo $i;?>" placeholder="Last Name">
					</div>
				  
				</div>	
				<div class="col-sm-6 col-md-3">
				  
					<div class="form-group">
					<input title="Date of Birth" class="form-control datepicker_book"  name="child_dob_<?php echo $i;?>" placeholder="Date of Birth">   
					
					</div>
				  
				</div>	
				<?php } ?>
		
	</div><br>
</div><!--booknow second row closed-->
<div class="orderhotels-one">
		<div  class="row">
			<div class="col-sm-6 col-md-12">
				<h4 class="booknow-font"><b>Contact & Billing Information</b></h4>			
			</div>			
				<div class="col-md-4 col-sm-3 col-xs-12">				
				<h5>Email Address <span class="txt_red">*</span></h5>
				<input type="email" title="Email" class="form-control" name="email">
				</div>
				<div class="col-md-4 col-sm-3 col-xs-12">				
				<h5>Address Line 1 <span class="txt_red">*</span></h5>
				<input class="form-control" title="Adderess-1" name="address_1">
				</div>
		</div>
			
				<div  class="row">
					<div class="col-md-4 col-sm-3 col-xs-12">					
					<h5>Re-Type Email Address <span class="txt_red">*</span></h5>
					<input type="email" class="form-control" title=" Confirm Email" name="confirm_email">
					</div>
					<div class="col-md-4 col-sm-3 col-xs-12">				
					<h5>City / County <span class="txt_red">*</span></h5>
					<input class="form-control" title="City" name="city">
					</div>					
				</div>
				<div  class="row">
					<div class="col-md-4 col-sm-3 col-xs-12">					
					<h5>Home Telephone <span class="txt_red">*</span></h5>
					<input class="form-control" title="Home Telephone" name="home_tel">
					</div>
					<div class="col-md-4 col-sm-3 col-xs-12">				
					<h5>Postcode <span class="txt_red">*</span></h5>
					<input class="form-control" title="Postal code" name="post_code">
					</div>					
				</div>
				<div  class="row">
					<div class="col-md-4 col-sm-3 col-xs-12">					
					<h5>Mobile Telephone</h5>
					<input class="form-control" title="Mobile" name="mobile">
					</div>
					<div class="col-md-4 col-sm-3 col-xs-12">				
					<h5>I have a different billing address </h5><br><br><br>
					
					</div>					
				</div>
				
</div>	


<div class="orderhotels-one">
		<div  class="row">
			<div class="col-sm-6 col-md-12">
				<h4 class="booknow-font"><b>Select a Payment Method</b></h4>			
			</div>	
			
		<div class="col-md-4 col-sm-3 col-xs-12">		
				<h5>Card Type</h5>	

						<select name="card_type" title="Card Type">
							<option value="-1">Select Card</option>
							<option value="visacreditcard">Visa Credit Card 2.5%</option>
							<option value="visadebitcard">Visa Debit Card</option>
							<option value="mastercardprepaid">Mastercard Prepaid</option>
							<option value="visadebitcard">Master Card Credit 2.5%</option>
							<option value="mastercardprepaid">Mastercard Debit</option>
							<option value="visadebitcard">Maestro Debit</option>
							<option value="mastercardprepaid">American Express</option>										
						</select>
				</div>
			
		</div>
			
				<div  class="row">
				
					<div class="col-md-5 col-sm-3 col-xs-12">					
					<h5>Name on Card</h5>
					<input class="form-control" title=" Name on Card" name="name_card">
					</div>
					<div class="col-md-5 col-sm-3 col-xs-12">				
					<h5>Card Number</h5>
					<input type="tel" min="2" max="5" class="form-control" title="Card Number" name="card_number">
					</div>				
				</div>
				<div  class="row">		
		<div class="col-md-5 col-sm-3 col-xs-12">		
				<h5> Valid From Date</h5>
				<div class="col-sm-6 col-md-4" style="margin-left: -15px;">	
					<div class="form-group">
						<select name="valid_from" title="Valid from">
							<option value="-1">Month	</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>								
						</select>
						</div>
						</div>
						<div class="col-sm-6 col-md-4">	
					<div class="form-group">
						<select name="valid_from" title="Valid from">
							<option value="-1">Year</option>
							<option value="2001">2001</option>
							<option value="2002">2002</option>
							<option value="2003">2003</option>
							<option value="2004">2004</option>
							<option value="2005">2005</option>
							<option value="2006">2006</option>
							<option value="2007">2007</option>
							<option value="2008">2008</option>
							<option value="2009">2009</option>
							<option value="2010">2010</option>
							<option value="2011">2011</option>
							<option value="2012">2012</option>
							<option value="2013">2013</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>								
						</select>
					</div>	
					</div>
					</div>
		<div class="col-md-5 col-sm-3 col-xs-12">		
				<h5> Valid To Date</h5>	
				<div class="col-sm-6 col-md-4" style="margin-left: -15px;">	
					<div class="form-group">
						<select name="valid_to" title="Valid to">
							<option value="-1">Month</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>								
						</select>
						</div>
						</div>
						<div class="col-sm-6 col-md-4">	
					<div class="form-group">
						<select name="valid_to" title="valid to">
							<option value="-1">Year</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>								
						</select>
					</div>	
			
		</div>
		</div>
		</div>
		<div  class="row">
					<div class="col-md-5 col-sm-3 col-xs-12">					
					<h5>Security Number<br></h5>
<h6>Last 3 numbers on the back of your card</h6>
					<input class="form-control" title=" Security Number">
					</div>					
				</div>
				<div  class="row">
					<div class="col-md-4 col-sm-3 col-xs-12">					
					
					<input type="submit" class="btn btn-primary" />
					</div>
									
				</div>
				
</div>	

<?php echo form_close();?>
<div class="orderhotels"></div>	
	

<!-- book now closed here-->

</div>


<!--right side wrap start here-->
<div class="col-sm-3">	
	<?php 
	$dscode = $fobj['@attributes']['depapt'];
	$ascode = $fobj['@attributes']['arrapt'];
	$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
	$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',@$arrivals[(string)$ascode])[0]);
	$dscode = trim(explode('-',@$departures[(string)$dscode])[0]);
	//print_r($fobj);exit;
	$dept_start_time = substr(explode(' ',$fobj['@attributes']['outdep'])[1],0,-3);
	$dept_arr_time = substr(explode(' ',$fobj['@attributes']['outarr'])[1],0,-3);
	$return_start_time = substr(explode(' ',$fobj['@attributes']['indep'])[1],0,-3);
	$return_arr_time = substr(explode(' ',$fobj['@attributes']['inarr'])[1],0,-3);
	//echo '<pre>';print_r($return_start_time);exit;
	$this->load->helper('common');
	$dept_images = dept_images();
	?>
	<div class="deals">	<h2>Your Selections	</h2></div>
	<div class="conatiner-bg">	
	<div class="flight-wrap"><h5><b>&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * $fobj['@attributes']['sellpricepp']); ?> </b></h5></div>	
	<h5><b>Flights</b></h5>	
	<h5>Depart:</h5>
	<div style="position: relative;" class="clearfix">
		<div class="left">
		    <img src="<?php echo $dept_images[$fobj['@attributes']['suppcode']]; ?>" style="width: 70px; height: 16px;">
		</div>
		<div class="right">
		    <span class="txt_color_2"></span>
		</div>
	</div>
	<h6><?php echo $dscode.' to '.$ascode;?></h6>
	<h6><?php echo date('d M Y',$controller->cvtDt(str_date($flit[0]['flight_selected_date'])));?> : <?=$dept_start_time . ' - ' . $dept_arr_time;?></h6>
	<h5>Return:</h5>
	<div style="position: relative;" class="clearfix">
		<div class="left">
		    <img src="<?php echo $dept_images[$fobj['@attributes']['suppcode']]; ?>" style="width: 70px; height: 16px;">
		</div>
		<div class="right">
		    <span class="txt_color_2"></span>
		</div>
	</div>
	<h6><?php echo $ascode.' to '.$dscode;?></h6>
	<h6><?php echo date('d M Y',$controller->cvtDt(str_date(explode(' ',$fobj['@attributes']['indep'])[0])));?> : <?=$return_start_time . ' - ' . $return_arr_time;?></h6>
	
	<div class="flight-wrap"><a href="<?php echo base_url().'flightsAvailability/'.$this->uri->segment(2);?>" onClick="return Change('full_flight','<?php echo $this->uri->segment(2);?>')">change</a></div><p class="later">	
	<h5>Adults : <?php echo $seg[0]['num_adults'];?> x &#163;<?php echo $fobj['@attributes']['sellpricepp'];?></h5><br>
	</div>
	

	<div class="conatiner-bg">	
	<div class="flight-wrap"><h5><b>&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50);?> </b></h5></div>	
	<h5><b>Atol Protection</b></h5>	
	<div class="flight-wrap"><a class="toggle_atol">What's this?</a></div>	
	<?php include 'includes/atol_tooltip.php';?>
	<h5> <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']) ?> x &#163;2.50</h5><br>	
	</div>
	
	<div class="conatiner-bg">	
	<?php 
			$det_pax_prices = '';$res_sel_price = 0;
						
			$sep = array();
			if($seg[0]['num_rooms'] > 1)
			{
				
				if($seg[0]['num_children'])
				{
					$ser_arr = explode(',',$seg[0]['pax']);	
					$temp = $hobjs;
					
					
						foreach ($ser_arr as $key => $ser)
						{							
							$ser_arr_sub = explode('-',$ser);
							if(in_array($ser,array_keys($sep)))
							{							
								$det_pax_prices .=  '<small>Room '.($key+1).' -> '.$ser_arr_sub[0].' Adult(s), '.$ser_arr_sub[1].' children(s) : '.$sep[$ser] * (array_sum($ser_arr_sub)).'</span></small><br>';
								$res_sel_price += $sep[$ser] * (array_sum($ser_arr_sub));								
							}
							else{									
								$det_pax_prices .=  '<small>Room '.($key+1).' -> '.$ser_arr_sub[0].' Adult(s), '.$ser_arr_sub[1].' children(s) : '.$temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub)).'</span></small><br>';
								$res_sel_price += $temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
								$sep[$ser] = $temp[0]['@attributes']['sellpricepp'];
								unset($temp[0]);
								$temp = array_values($temp);								
							}					
						}
			
				}
				else{					
					$n = distribute($seg[0]['num_adults'],$seg[0]['num_rooms']);
					foreach ($n as $key => $val)
					{
						$det_pax_prices .=  '<small>Room '.$key.' -> '.$val.' Adult(s), 0 Children(s) : '.$hobjs[0]['@attributes']['sellpricepp'] * $val .'</span></small><br>';
						$res_sel_price += $hobjs[0]['@attributes']['sellpricepp'] * $val;
					}					
				}
			}
			else if($seg[0]['num_rooms'] == 1){
				$det_pax_prices .=  '<small>Room 1 -> '.$seg[0]['num_adults'].' Adult(s), '.$seg[0]['num_children'].' Children(s) : '.$hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_children'] + $seg[0]['num_adults']) .'</span></small><br>';
				$res_sel_price += $hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_children'] + $seg[0]['num_adults']);
			}		

			
		?>
		<div class="flight-wrap"><h5><b>&#163;<?php echo ($res_sel_price);?> </b></h5></div>		
		<h5><b>Hotel <?php echo $hobjs[0]['@attributes']['nights'];?> Nights</b>	</h5>		
		<h5><?php echo urldecode($hobjs[0]['@attributes']['hotelname']);?></h5>
		<h6><?php echo urldecode($hobjs[0]['@attributes']['resort']);?>,</h6>
		<h6><?php echo boardbasis($hobjs[0]['@attributes']['boardbasis']);?></h6>
		<h6>Check in : <?php echo date('d M Y',$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate'])));?></h6>
		<h6>Check out : <?php echo date('d M Y',$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate'])));?></h6>
		<div class="left">
          <?php 
		echo $det_pax_prices;
			
		?>
          
         </div>	
         <div class="flight-wrap"><a href="<?php echo base_url().'HotelsAvailability/'.$this->uri->segment(2);?>" onClick="return Change('full_hotel','<?php echo $this->uri->segment(2);?>')">change</a></div>	
		<br>	
	</div>
	<div class="conatiner-bg">
	    <div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
            <div class="left"> <h4>Extras</h4> </div>
            <div class="right" style="text-align: right;">
                <h4>&#163;<span id="ExtraTotal"><?php echo $sel_info['total'];?></span></h4>
             </div>
        </div>
		<div id="extra_segments">
		<?php echo $sel_info['sel_block']['segment'];?>
		</div>
		 <div class="conatiner-bg">
		<div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
             <div class="left">
                  <h4>TOTAL</h4>
              </div>
              <div class="right" style="text-align: right;">
                  <h2 class="txt_color_1 txt_xtra_large">&#163;<span id="cphContent_lblSubTotal"><?php echo $sel_info['whole'];?></span></h2>
                  <small>Per Person: &#163;<span id="pprice"><?php echo ($sel_info['whole'] / ($seg[0]['num_adults'] + $seg[0]['num_children']));?></span>  X <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']);?></small>
              </div>
         </div>
         <div class="conatiner-bg">
         	<a onclick="callWaitPageForextra();" class="button full_width txt_xtra_large" href="<?php echo base_url().'book/'.$this->uri->segment(2);?>"><i aria-hidden="true" class="icon-lock"></i>&nbsp;BOOK NOW</a>
    	 </div>
	  </div>
    
     </div>	

	
<!--riht side wrap closed here-->	
<div class="left-sidebar">
<?php include_once 'includes/atol_left.php';?>
<div class="clearfix"></div>
<div class="clearfix"></div>
</div>
</div>
<!--sidebar-->
</div>
</div>	