 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<table class="table table-bordered">    
     	 <thead>
     	  <tr><th colspan="3"><h4>Passengers Details</h4></th></tr>
          <tr>
            <th>Passenger</th>
            <th>Name</th>
            <th>DOB</th>                    
          </tr>
        </thead>   
        <tbody>
          <?php 
          
        	$adult_raw_info = json_decode($row[0]['adults_info'],true);
        	$child_raw_info = json_decode($row[0]['children_info'],true);
        	
        	$count = 1;
        	foreach($adult_raw_info['title'] as $key => $title){        		
        		echo '<tr>';
        		echo '<td>Adult - '.($count).'</td>';
        		echo '<td>'.$title. ' ' .$adult_raw_info['fname'][$key].' '.$adult_raw_info['lname'][$key].'</td>';
        		echo '<td>'.@$adult_raw_info['dob'][$key].'</td>';
        		echo '</tr>';
        		$count++;
        	}
        	if(!empty($child_raw_info))
        	{
        		$count = 1;
        		foreach($child_raw_info['title'] as $key => $title){
        			echo '<tr>';
        			echo '<td>Child - '.($count).'</td>';
        			echo '<td>'.$title. ' ' .$child_raw_info['fname'][$key].' '.$child_raw_info['lname'][$key].'</td>';
        			echo '<td>'.@$child_raw_info['dob'][$key].'</td>';
        			echo '</tr>';
        			$count++;
        		}
        	}          		
          ?>          
        </tbody>
      </table>
      <?php 
      if(@$fobj){
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
	
	$dept_images = dept_images();
      }
	$whole = 0;
	
	?>
      <table class="table table-bordered">    
     	 <thead>
     	  <tr><th colspan="3"><h4>Booking Information </h4></th></tr>        
        </thead>   
        <tbody>
        	<?php if(@$fobj){?>
        	<tr>
        
        		<td>Flight Info</td>
        		<td>
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
						
						<p class="later">	
						<h5>Adults : <?php echo $seg[0]['num_adults'];?> x &#163;<?php echo $fobj['@attributes']['sellpricepp'];?></h5><br>
						</div>						
				</td>
				<td><?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * $fobj['@attributes']['sellpricepp']); 
					$whole += (($seg[0]['num_adults'] + $seg[0]['num_children']) * $fobj['@attributes']['sellpricepp']);
					?></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Hotel Info</td>
        		<td>
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
						<div class="flight-wrap"><h5></div>		
						<h5><b><?php echo $hobjs[0]['@attributes']['nights'];?> Nights</b>	</h5>		
						<h5><?php echo urldecode($hobjs[0]['@attributes']['hotelname']);?></h5>
						<h6><?php echo urldecode($hobjs[0]['@attributes']['resort']);?>,</h6>
						<h6><?php echo boardbasis($hobjs[0]['@attributes']['boardbasis']);?></h6>
						<h6>Check in : <?php echo date('d M Y',$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate'])));?></h6>
						<h6>Check out : <?php echo date('d M Y',strtotime("+".$hobjs[0]['@attributes']['nights']." day",$controller->cvtDt(str_date($hobjs[0]['@attributes']['checkindate']))));?></h6>
						<div class="left">
					          <?php echo $det_pax_prices;?>	          
				        </div>
        		</td>
        		<td><?php echo ($res_sel_price);
        				$whole += ($res_sel_price);
        				
        			?></td>
			</tr>
				<?php if(@$fobj){?>
			<tr>
				<td>Extras Info</td>
        		<td>
        			<?php 
        				$total = 0;
        				if(@$ext_row[0]['pack_info'] != '')
						{
							$pack_raw = json_decode($ext_row[0]['pack_info'],true);
							
							foreach ($pack_raw as $key => $each)
							{
								$field_pack = $controller->SavingsNExtFields->fetch_a_fields(array('id'=>$key));
								echo  '<div>
			                                    <small>
			                                        <strong>
			                                            <span>'.$field_pack[0]['short_desc'].'</span></strong>
			                                        <div style="position: relative; margin-bottom: 5px; padding-bottom: 3px;" class="clearfix">
			                                            <div class="left">
			                                                <span>'.$each / $field_pack[0]['price'].'</span>
			                                                x &#163;<span id="cphContent_lblPPerPrice">'.$field_pack[0]['price'].'</span>
			                                            </div>			                                           
			                                        </div>
			                                    </small>
			                                </div>';
								$total += $each;
							}
						}
						$lug_row = $controller->AlLugagePrice->fetch_a_search(array('airline_code'=>$fobj['@attributes']['suppcode']));
						
						if(@$ext_row[0]['bags_count'])
						{
							echo '<div id="BaggageRightSide">
								<span>
								<strong>Hold Luggage:
								<span id="cphContent_lblBaggageWeight">'.$ext_row[0]['bags_count'].' x 20kg</span></strong>								
								</div>
								</span>
							</div>';
						}
						$total += (@$ext_row[0]['bags_count'] * (int)@$lug_row[0]['price']);
						?>
        		</td>
        		<td><?php echo $total;
	        		$whole += $total;	        		
	        		?></td>
        	</tr>
        	<?php } ?>
        	<tr>
        		<td>Atol Protection</td>
        		<td><h5> <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']) ?> x &#163;2.50</h5></td>
        		<td><?php echo (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50);
        			$whole += (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50);
        		?></td>
        	</tr>
        	<tr>
        		<td colspan=2>Total</td>        		
        		<td><?php echo $whole;?></td>
        	</tr>
        </tbody>
       </table>
     
      <?php //echo '<pre>';print_r($row);exit;
      
      ?>
     
      <table class="table table-bordered">    
     	 <thead>
     	  <tr><th colspan="3"><h4>Contact Information </h4></th></tr>        
        </thead>   
        <tbody>
        	<?php 
        	echo '<tr><td>Email</td><td>'.$row[0]['email'].'</td></tr>';
        	echo '<tr><td>Mobile</td><td>'.$row[0]['mobile'].'</td></tr>';
        	echo '<tr><td>Home Telephone</td><td>'.$row[0]['home_tel'].'</td></tr>';
        	echo '<tr><td>Postal Code</td><td>'.$row[0]['postal_code'].'</td></tr>';
        	echo '<tr><td>Address - 1</td><td>'.$row[0]['address_1'].'</td></tr>';
        	if ($row[0]['address_2'] != '')
        	{
        	echo '<tr><td>Billing Address</td><td>'.$row[0]['address_2'].'</td></tr>';
        	}
        	else 
        	{
        		echo '<tr><td>Billing Address</td><td>'.$row[0]['address_2'].'</td></tr>';
        	}
         	echo '<tr><td>City/Country</td><td>'.$row[0]['city_country'].'</td></tr>';        	
        	?>
        </tbody>
      </table>
		
		 <table class="table table-bordered">    
     	 <thead>
     	  <tr><th colspan="3"><h4>Card Information </h4></th></tr>         
        </thead>   
        <tbody>
        	<?php 
        	echo '<tr><td>Card Type</td><td>'.$row[0]['card_type'].'</td></tr>';
        	echo '<tr><td>Card Holder Name</td><td>'.$row[0]['name_card'].'</td></tr>';
        	echo '<tr><td>Card Number</td><td>'.$row[0]['card_number'].'</td></tr>';   
        	echo '<tr><td>CVV Number</td><td>'.$row[0]['cvv_number'].'</td></tr>';
        	?>
        </tbody>
      </table>
		 	
	 <form method="post">
	 <input type="hidden" name="reference_id" value="<?php echo $this->input->post('reference_id');?>" />
	 <input type="hidden" name="lname" value="<?php echo $this->input->post('lname');?>" />
	 <input type="hidden" name="email" value="<?php echo $this->input->post('email');?>" />
	 <input type="submit" name="download" value="Download"/>
	 </form>
							  
