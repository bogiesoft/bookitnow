<?php include_once 'includes/change_search_hotels.php';?>
<div id="body_content">
<div class="container" >

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
					<p class="online-save">Total Cost:  	<span class="online-rate online-final">&#163;<?php echo $sel_info['whole']; ?></span></P>					
					<p> <a href="<?php echo base_url().'book/'.$this->uri->segment(2);?>" class="btn-small btn-default-small" role="button" onclick="return callWaitPageForextra();">BOOK NOW</a></p>	
					<p class="later"><a id="cphContent_lnkDesktopBasketQQ" onclick="LoadQQPopup(this);">Save for Later<a></p>					
				   </div>
			 	</div>
			</div>
		  </div>
	    </div>
    </div>		
	
	<div class="list-group" style="margin: inherit;margin-top: 15px;margin-left: 0px;width: 20%;">
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
			echo '<div class="list-group" style="margin: inherit;margin-top: 15px;margin-left: 0px;width: 20%;">
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
					$tot .= '<select name="ct_'.$field['id'].'"  style="width:57%">';
					for ($i=1;$i<=$field['dropdown'];$i++)
					{
						$tot .= '<option value='.$i.'>'.$i.' Car &#163;'.($i * $field['price']).'</option>';
					}
					$tot .= '</select>';
				}							
				
				echo '<div class="orderhotels-one ">
					<div class="row">
						<div class="col-sm-6 col-md-8">
							<h5>'.$field['short_desc'].'</h6></h5>			  				
							'.$pp.'
						</div>
						<br>
						<div class="col-sm-6 col-md-4">
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
	<div class="bg_grey">											
        <div>
      		<div class="left">Flights</div>
		    <div class="right" style="text-align: right;">&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * $fobj['@attributes']['sellpricepp']); ?></div>
        </div>
		<div style="margin-bottom: 5px; margin-top: 5px;    line-height: 20px;">
             <strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Depart:</strong>
             <br>
                <!--<div style="position: relative;" class="clearfix">
                   <div class="left">
                        <img src="<?php echo $dept_images[$fobj['@attributes']['suppcode']]; ?>" style="width: 70px; height: 16px;">
                    </div>
                    <div class="right">
                        <span class="txt_color_2"></span>
                    </div>
                </div>-->
             <small><?php echo $dscode.' to '.$ascode;?><br><?php echo date('d M Y',$controller->cvtDt(str_date($flit[0]['flight_selected_date'])));?> : <?=$dept_start_time . ' - ' . $dept_arr_time;?></small><br>
             <span class="txt_color_2"></span>			                
        </div>
        <div style="margin-bottom: 5px;    line-height: 20px;">
          	<strong style="color: rgba(241, 113, 19, 0.98);"><i aria-hidden="true" class="icon-calendar"></i>&nbsp;Return:</strong><br>
             <!--<div style="position: relative;" class="clearfix">
                  <div class="left">
                      <img src="<?php echo $dept_images[$fobj['@attributes']['suppcode']]; ?>" style="width: 70px; height: 16px;">
                  </div>
              </div>-->
		   	 <small><?php echo $ascode.' to '.$dscode;?><br><?php echo date('d M Y',$controller->cvtDt(str_date(explode(' ',$fobj['@attributes']['indep'])[0])));?> : <?=$return_start_time . ' - ' . $return_arr_time;?></small><br>
		     <span class="txt_color_2"></span>
        </div>
		<div style="position: relative;" class="clearfix">
             <div>
                 <small>
                      <span> Persons : <?php echo $seg[0]['num_adults']+$seg[0]['num_children'];?> x &#163;<?php echo $fobj['@attributes']['sellpricepp'];?></span>
                 </small>
                 <span style="float:right;">
        	        <small>
                       <a href="'.base_url().'flightsAvailability/'.$this->uri->segment(2).'" onClick="return Change('."'".$type_s."'".','."'".$cry."'".')" title="Change Flight">Change</a>
					</small>
				</span>
			 </div>			
					              
		</div>								           
      </div>  
	
	
	
	
	
	
	 <div class="bg_grey">	
          <div>
				<div class="left">Atol Protection</div>
	           <div class="right" style="text-align: right;">&#163;<?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50);?></div>
          </div>
          <div style="margin-top: 10px;" class="clearfix">
               <small><?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']) ?> x &#163;2.50</small>
               <span style="float:right;">
			        <small><a class="toggle_atol">What's this?</a></small>
			         <?php include_once 'includes/atol_tooltip.php';?>
			   </span>
          </div>			        					
	 </div>


	
	<?php //echo '<pre>';print_r($hobjs);exit; ?>
	
	
	
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
								$det_pax_prices .=  'Room '.($key+1).' -> '.$ser_arr_sub[0].' Adult(s), '.$ser_arr_sub[1].' children(s) : '.$sep[$ser] * (array_sum($ser_arr_sub)).'</span><br>';
								$res_sel_price += $sep[$ser] * (array_sum($ser_arr_sub));								
							}
							else{									
								$det_pax_prices .=  'Room '.($key+1).' -> '.$ser_arr_sub[0].' Adult(s), '.$ser_arr_sub[1].' children(s) : '.$temp[0]['@attributes']['sellpricepp'] * (array_sum($ser_arr_sub)).'</span><br>';
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
						$det_pax_prices .=  'Room '.$key.' -> '.$val.' Adult(s), 0 Children(s) : '.$hobjs[0]['@attributes']['sellpricepp'] * $val .'</span><br>';
						$res_sel_price += $hobjs[0]['@attributes']['sellpricepp'] * $val;
					}					
				}
			}
			else if($seg[0]['num_rooms'] == 1){
				$det_pax_prices .=  'Room 1 -> '.$seg[0]['num_adults'].' Adult(s), '.$seg[0]['num_children'].' Children(s) : '.$hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_children'] + $seg[0]['num_adults']) .'</span><br>';
				$res_sel_price += $hobjs[0]['@attributes']['sellpricepp'] * ($seg[0]['num_children'] + $seg[0]['num_adults']);
			}		

			
		?>
		
		<div class="bg_grey">	
          <div>
				<div class="left">Hotel <?php echo $hobjs[0]['@attributes']['nights'];?> Nights</div>
	           <div class="right" style="text-align: right;">&#163;<?php echo ($res_sel_price);?> </div>
          </div>
          <div style="margin-bottom: 15px; margin-top: 5px;    line-height: 20px;">         
             <small>
             	<?php echo urldecode($hobjs[0]['@attributes']['hotelname']);?><br>
             	<?php echo urldecode($hobjs[0]['@attributes']['resort']);?><br>
             	<?php echo boardbasis($hobjs[0]['@attributes']['boardbasis']);?><br>
             	Check in : <?php echo date('d M Y',$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate'])));?><br>
             	Check out : <?php echo date('d M Y',strtotime('+'.$hobjs[0]['@attributes']['nights'].'days',$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate']))));?><br>            	
            	<?php echo $det_pax_prices;?>	
                <span style="float:right;font-size: 13px;"><a href="<?php echo base_url().'HotelsAvailability/'.$this->uri->segment(2);?>" onClick="return Change('full_hotel','<?php echo $this->uri->segment(2);?>')">Change</a></span>
            </small>                
        </div>		        					
	 </div>	
        	
		
	
	<div class="bg_grey">
	 	<div>
			<div class="left">Extras</div>
	        <div class="right" style="text-align: right;">&#163;<span id="ExtraTotal"><?php echo $sel_info['total'];?></span></div>
        </div>
	    
		<div id="extra_segments">
		<?php echo $sel_info['sel_block']['segment'];?>
		</div>
		 
    
     </div>	
     <div class="bg_grey">
     	<div>
			<div class="left">TOTAL</div>
	        <div class="right" style="text-align: right;">&#163;<span id="ExtraTotal"><span id="cphContent_lblSubTotal"><?php echo $sel_info['whole'];?></span></span></div>
        </div>
		<div style="margin-bottom: 15px; margin-top: 5px;    line-height: 20px;">            
             <small>Per Person: &#163;<span id="pprice"><?php echo ($sel_info['whole'] / ($seg[0]['num_adults'] + $seg[0]['num_children']));?></span>  X <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']);?></small>             
         </div>        
	  </div>
     <div class="bg_grey">
         	<a onclick="return callWaitPageForextra();" class="button" style="width:100%;" href="<?php echo base_url().'book/'.$this->uri->segment(2);?>"><i aria-hidden="true" class="icon-lock"></i>&nbsp;BOOK NOW</a>
     </div>
     
   
	</div>
	</div>
		</div>
	<!--riht side wrap closed here-->
