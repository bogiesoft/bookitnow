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
				<?php } ?>
		<?php for($i=1;$i<=$seg[0]['num_children'];$i++){ ?>
		<div class="col-sm-6 col-md-12">		
				<h5> Child (<?php echo $i;?>) </h5>
		</div>	
				<div class="col-sm-6 col-md-2">	
					<div class="form-group">
						<select name="child_title_<?php echo $i;?>" title="Select title">
							<option value="-1">Select Title</option>
							<option value="Mr">Mast</option>
							<option value="Mrs">Miss</option>										
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
				<!-- <div class="col-sm-6 col-md-2">
				  
					<div class="form-group">   
					<input type="Last Name" class="form-control" name="child_lname_<?php echo $i;?>" placeholder="Last Name">
					</div>
				  
				</div>	
				<div class="col-sm-6 col-md-2">				  
					<div class="form-group">   
					<input type="Last Name" class="form-control" name="child_lname_<?php echo $i;?>" placeholder="Last Name">
					</div>
				  
				</div>	
				<div class="col-sm-6 col-md-2">
				  
					<div class="form-group">   
					<input type="Last Name" class="form-control" name="child_lname_<?php echo $i;?>" placeholder="Last Name">
					</div>
				  
				</div>	-->
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
	<div class="flight-wrap"><h5><b>&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * 1.50);?> </b></h5></div>	
	<h5><b>Atol Protection</b></h5>	
	<div class="flight-wrap"><a class="toggle_atol">What's this?</a></div>	
	<?php include 'includes/atol_tooltip.php';?>
	<h5> <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']) ?> x &#163;1.50</h5><br>	
	</div>
	
	<div class="conatiner-bg">	
	<?php 
			$det_pax_prices = '';$res_sel_price = 0;
			if($seg[0]['pax'] != '' )
			{
				$ser_arr = explode(',',$seg[0]['pax']);
				
				foreach ($ser_arr as $key => $ser)
				{
					$ser_arr_sub = explode('-',$ser);					
					$det_pax_prices .=  '<small>'.$ser_arr_sub[0].' Adult(s), '.$ser_arr_sub[1].' children(s) : '.$hobjs[$key]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub)).'</span></small><br>';
					$res_sel_price += $hobjs[$key]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub));
				}
				//echo '<pre>';print_r($hobjs);exit;
			}
			else
			{
				
				$det_pax_prices .= '<small>'.$seg[0]['num_adults'].' Adult(s), '.$seg[0]['num_children'].' children(s) : '.$hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_adults'] + $seg[0]['num_children']).'</span></small><br>'; 
				$res_sel_price += $hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_adults'] + $seg[0]['num_children']);
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