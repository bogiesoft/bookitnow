<div class="hide_mobile hide_tablet bg_grey border_b">
     <div class="gridContainer ">
       <!--STEPS-->
      <ul class="fluidList steps fh clearfix">
          <li class=""><strong class="done">1. Select Flights </strong></li>
          <li class=""><strong class="done">2. Select Hotel</strong></li>
          <li class=""><strong class="done">3. Savings &amp; Extras</strong></li>
          <li class="current"><strong>4. Book</strong></li>
      </ul>
  <!--/STEPS-->

                        

                    
                    
                    
                </div>
            </div>
<div id="body_content">
<div class="container">

<!-- booknow start here-->
<div class="col-sm-9" style="padding-left:0px;">
	<div class="orderhotels-top">
		<div class="row">
			<div class="col-sm-6 col-md-9">
					<h4>OPTIONAL EXTRAS</h4>
					<h5>Hold Luggage, Transfers, Car Hire and ParkingM</h5>
					<h6>Not required? Click Book Now at Any Time</h6>		
			</div>	
			<div class="row">
			  <div class="col-sm-6 col-md-3">
				<div class="box-border">
				   <div>
				 	<!--  <p class="online-save">Online Savings: <span class="online-rate">&#163;57.70</span></p>			
					<p class="online-save">RRP:  	<span class="text-decoration">&#163;665.04</span></P>-->
					<p class="online-save">Total Cost:  	<span class="online-rate">&#163;<?php echo $sel_info['whole']; ?></span></P>					
					<p> <a href="<?php echo base_url().'book/'.$this->uri->segment(2);?>" class="btn-small btn-default-small" role="button" onclick="return callWaitPageForextra();">BOOK NOW</a></p>	
					<p class="later"><a id="cphContent_lnkDesktopBasketQQ" onclick="LoadQQPopup(this);">Save for Later<a></p>					
				   </div>
			 	</div>
			</div>
		  </div>
	    </div>
    </div>		
	
	<div class="list-group">
		<a href="#" class="list-group-item active"><span class="h-title">ADD HOLD LUGGAGE </span>  </a>  
	</div>				
	<div class="orderhotels-one ">			
		<div class="row">
			<div class="col-sm-6 col-md-9">
				<h5><?php echo $lug_row[0]['weight'];?>kg Per Passenger </h5>
				<h6>(Covers outbound and inbound) </h6>
				<h6>*Your booking includes 1 piece of hand luggage per person.  </h6>
			</div>
			<div class="col-sm-6 col-md-3">
									<h5>HOW MANY BAGS?</h5>
										<div class="bags_input_group">
											<div class="bag_qty">
											<input class="button minus" type="submit" onclick='javascript:return BaggageMinus("<?php echo $this->uri->segment(2);?>");' value="-">
											<input class="aspNetDisabled" type="text" disabled="disabled" value="<?php echo $sel_info['bags'];?>">
											<input class="button plus" type="submit" onclick='javascript:return BaggagePlus("<?php echo $this->uri->segment(2);?>");' value="+">
											<input id="cphContent_btnBaggage" type="submit" style="display: none;" value="" name="ctl00$cphContent$btnBaggage">
											</div>
									</div>
									</div>	
														
			</div>
		</div>
			
			
		<?php 
		foreach ($ext_fields as $heading => $fields)
		{
			
			echo '<div class="orderhotels"></div>';
			echo '<div class="list-group">
			  <a href="#" class="list-group-item active"><span class="h-title">'.$heading.' </span>  </a>  
			</div>';
			$count = 1;
			foreach ($fields as $field)
			{
				$pp='';
				$tot = '';
				if($field['pp'])
				{
					$pp='<h5>Price Per Person :<span class="online-rate"> &#163;'.$field['price'].' </span></h5>';
					$tot = '<span class="online-save">Total:&nbsp;<strong class="online-rate">&#163;'.($seg[0]['num_adults'] + $seg[0]['num_children']) * $field['price'].'</strong> </span>';					
				}
				else if($field['long_desc'] != '')
				{			
					
					$pp='<p class="later"><a href="#inline'.$count.'" class="various1" onclick="getpackinfo(this)">Full Details</a></p>';
					$pp .= '<div id="#inline'.$count.'" style="display:none">'.$field['long_desc'].'</div>';
					$tot .= '<select name="ct_'.$field['id'].'">';
					for ($i=1;$i<=$field['dropdown'];$i++)
					{
						$tot .= '<option value='.$i.'>'.$i.' Car &#163;'.($i * $field['price']).'</option>';
					}
					$tot .= '</select>';
				}							
				
				echo '<div class="orderhotels-one ">
					<div class="row">
						<div class="col-sm-6 col-md-9">
							<h5>'.$field['short_desc'].'</h6></h5>			  				
							'.$pp.'
						</div>
						<br>
						<div class="col-sm-6 col-md-3">
						'.$tot.'
					 	<a href="#" class="btn-small btn-default-small" role="button" onclick=addsavings('.$field['id'].',"'.$this->uri->segment(2).'")>ADD </a>
						</div>
					</div>
				</div>';
				$count++;
			}			
		}
		?>		
	
				

			
			
<!--booknow second row closed-->

				

<!-- book now closed here-->




</div>


<!--sidebar-->
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
	<h5>Persons : <?php echo $seg[0]['num_adults']+$seg[0]['num_children'];?> x &#163;<?php echo $fobj['@attributes']['sellpricepp'];?></h5><br>
	</div>
	

	<div class="conatiner-bg">	
	<div class="flight-wrap"><h5><b>&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50);?> </b></h5></div>	
	<h5><b>Atol Protection</b></h5>	
	<div class="flight-wrap"><a class="toggle_atol">What's this?</a></div>	
	<?php include 'includes/atol_tooltip.php';?>
	
                                 
	<h5> <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']) ?> x &#163;2.50</h5><br>	
	</div>.
	<?php //echo '<pre>';print_r($hobjs);exit; ?>
	
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
         </div>
         <div class="right" style="text-align: right;">
                  <h2 class="txt_color_1 txt_xtra_large">&#163;<span id="cphContent_lblSubTotal"><?php echo $sel_info['whole'];?></span></h2>
                  <small>Per Person: &#163;<span id="pprice"><?php echo ($sel_info['whole'] / ($seg[0]['num_adults'] + $seg[0]['num_children']));?></span>  X <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']);?></small>
              </div>
         <div class="conatiner-bg">
         	<a onclick="return callWaitPageForextra();" class="button full_width txt_xtra_large" href="<?php echo base_url().'book/'.$this->uri->segment(2);?>"><i aria-hidden="true" class="icon-lock"></i>&nbsp;BOOK NOW</a>
    	 </div>
	  </div>
    
     </div>	
     
     
     
   
	</div>
	</div>
		</div>
	<!--riht side wrap closed here-->
