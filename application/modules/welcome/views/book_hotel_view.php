<div class="clearfix"></div>
<?php include_once 'includes/change_search_hotels_only.php';?>
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
				<?php 
		    		echo $this->session->flashdata('message');
		    		//$attributes = array('name'=>'book_form','onSubmit' => "return basket('".$this->uri->segment(2)."',this)");
		    		$attributes = array('name'=>'book_form');
					echo form_open(base_url().'book_hotel/'.$this->uri->segment(2), $attributes);
				 ?>
				<div class="orderhotels-one">			 
					<h4 class="booknow-font"><b>Party Details<b></h4>
					<h5>Note: Passenger names must match passports exactly. </h5>		
					<div class="row">
						<?php 
						$ati_arr = array('Mr','Mrs','Ms');
						$cti_arr = array('Mast','Miss');
						for($i=1;$i<=$seg[0]['num_adults'];$i++){ ?>
						<div class="col-sm-6 col-md-12">		
								<h5><?php if($i == 1)echo 'Lead';?> Adult (<?php echo $i;?>) </h5>
						</div>	
						<div class="col-sm-6 col-md-2">	
							<div class="form-group">
								<select name="adult_title_<?php echo $i;?>"  title="Select title">
									<option value="-1">Select Title</option>
									<?php foreach ($ati_arr as $val){
										$selected = (set_value('adult_title_'.$i) == $val) ? 'selected' : '';
										echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
									}?>				
								</select>
								<?php echo form_error('adult_title_'.$i); ?>
							</div>	
						</div>
										<div class="col-sm-6 col-md-3">				 
							<div class="form-group">   
							<input title="First Name" class="form-control" name="adult_fname_<?php echo $i;?>" placeholder="First Name" value="<?php echo set_value('adult_fname_'.$i);?>">
							<?php echo form_error('adult_fname_'.$i); ?>
							</div>
						 
						</div>
						<div class="col-sm-6 col-md-3">				  
							<div class="form-group">   
								<input title="Last Name" class="form-control" name="adult_lname_<?php echo $i;?>" placeholder="Last Name" value="<?php echo set_value('adult_lname_'.$i);?>">
								<?php echo form_error('adult_lname_'.$i); ?>
							</div>				  
						</div>	
						<div class="col-sm-6 col-md-3">						  
							<div class="form-group">   
								<input title="Date of Birth	" class="form-control datepicker_book" name="adult_dob_<?php echo $i;?>" placeholder="Date of Birth" value="<?php echo set_value('adult_dob_'.$i);?>">
								<?php echo form_error('adult_dob_'.$i); ?>
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
									<?php foreach ($cti_arr as $val){
										$selected = (set_value('child_title_'.$i) == $val) ? 'selected' : '';
										echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
									}?>									
								</select>
								<?php echo form_error('child_title_'.$i); ?>
							</div>	
						</div>
						<div class="col-sm-6 col-md-3">				 
							<div class="form-group">   
							<input title="First Name" class="form-control" name="child_fname_<?php echo $i;?>" placeholder="First Name" value="<?php echo set_value('child_fname_'.$i);?>">
							<?php echo form_error('child_fname_'.$i); ?>
							</div>
						 
						</div>
						<div class="col-sm-6 col-md-3">
						  
							<div class="form-group">   
							<input title="Last Name" class="form-control" name="child_lname_<?php echo $i;?>" placeholder="Last Name" value="<?php echo set_value('child_lname_'.$i);?>">
							<?php echo form_error('child_lname_'.$i); ?>
							</div>
						  
						</div>	
						<div class="col-sm-6 col-md-3">
						  
							<div class="form-group">
							<input title="Date of Birth" class="form-control datepicker_book"  name="child_dob_<?php echo $i;?>" placeholder="Date of Birth" value="<?php echo set_value('child_dob_'.$i);?>">
							<?php echo form_error('child_dob_'.$i); ?>							
							</div>
						  
						</div>	
						<?php } ?>
		
					</div>
					<br>
				</div><!--booknow second row closed-->
				<div class="orderhotels-one">
					<div  class="row">
						<div class="col-sm-6 col-md-12">
							<h4 class="booknow-font"><b>Contact & Billing Information</b></h4>			
						</div>			
							<div class="col-md-4 col-sm-3 col-xs-12">				
							<h5>Email Address <span class="txt_red">*</span></h5>
							<input type="email" title="Email" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
							<?php echo form_error('email'); ?>
							</div>
							<div class="col-md-4 col-sm-3 col-xs-12">				
							<h5>Address Line 1 <span class="txt_red">*</span></h5>
							<input class="form-control" title="Adderess-1" name="address_1" value="<?php echo set_value('address_1'); ?>">
							<?php echo form_error('address_1'); ?>
							</div>
					</div>
			
					<div  class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">					
						<h5>Re-Type Email Address <span class="txt_red">*</span></h5>
						<input type="email" class="form-control" title=" Confirm Email" name="confirm_email" value="<?php echo set_value('confirm_email'); ?>">
						<?php echo form_error('confirm_email'); ?>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">				
						<h5>City / County <span class="txt_red">*</span></h5>
						<input class="form-control" title="City" name="city" value="<?php echo set_value('city'); ?>">
						<?php echo form_error('city'); ?>
						</div>					
					</div>
					<div  class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">					
						<h5>Home Telephone <span class="txt_red">*</span></h5>
						<input class="form-control" title="Home Telephone" name="home_tel" value="<?php echo set_value('home_tel'); ?>">
						<?php echo form_error('home_tel'); ?>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">				
						<h5>Postcode <span class="txt_red">*</span></h5>
						<input class="form-control" title="Postal code" name="post_code" value="<?php echo set_value('post_code'); ?>">
						<?php echo form_error('post_code'); ?>
						</div>					
					</div>
					<div  class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">					
						<h5>Mobile Telephone</h5>
						<input class="form-control" title="Mobile" name="mobile" value="<?php echo set_value('mobile'); ?>">
						<?php echo form_error('mobile'); ?>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">	
						<?php 
							$switch = (set_value('have_diff_add')) ?  'block' : 'none';
							$checked = (set_value('have_diff_add')) ?  'checked' : '';
						?>			
						<h5><input type="checkbox" name="have_diff_add" id="toggle3" <?php echo $checked;?> style="display:none;"/><span></span><label for="toggle3" style="text-decoration: underline;cursor:pointer;font-size:14px;">I have a different billing address</label></h5><br><br><br>
						
						
						</div>					
					</div>				
				</div>	
				<div class="orderhotels-one toggle3" style="display: <?php echo $switch;?>;">
					<div  class="row">
						<div class="col-sm-6 col-md-12">
							<h4 class="booknow-font"><b>Billing Information</b></h4>			
						</div>	
							<div class="col-md-4 col-sm-3 col-xs-12">				
							<h5>Address Line 1 <span class="txt_red">*</span></h5>
							<input class="form-control" title="Adderess-2" name="address_2" value="<?php echo set_value('address_2'); ?>">
							<?php echo form_error('address_2'); ?>
							</div>
							<div class="col-md-4 col-sm-3 col-xs-12">				
								<h5>City / County <span class="txt_red">*</span></h5>
								<input class="form-control" title="City" name="city2" value="<?php echo set_value('city2'); ?>">
								<?php echo form_error('city2'); ?>
								</div>
					</div>
					<div  class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">				
						<h5>Postcode <span class="txt_red">*</span></h5>
						<input class="form-control" title="Postal code" name="post_code2" value="<?php echo set_value('post_code2'); ?>">
						<?php echo form_error('post_code2'); ?><br>
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
							<?php $ct_arr = array('Visa Credit Card' => 'Visa Credit Card 2.5%',
									'Visa Debit Card' => 'Visa Debit Card',
									'Mastercard Prepaid' => 'Mastercard Prepaid',
									'Mastercard Credit' => 'Master Card Credit 2.5%',
									'Mastercard Debit' => 'Mastercard Debit',
									'Maestro  Debit' => 'Maestro Debit',
									'American Express' => 'American Express'						
							);
							?>
									<select name="card_type" title="Card Type">
										<option value="-1">Select Card</option>
										<?php foreach ($ct_arr as $key => $val){
											$selected = (set_value('card_type') == $key) ? 'selected' : ''; 
											echo '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
										}?>										
									</select>
									<?php echo form_error('card_type'); ?>
							</div>
						
					</div>			
					<div  class="row">				
						<div class="col-md-5 col-sm-3 col-xs-12">					
							<h5>Name on Card</h5>
							<input class="form-control" title=" Name on Card" name="name_card" value="<?php echo set_value('name_card'); ?>">
							<?php echo form_error('name_card'); ?>
						</div>
						<div class="col-md-5 col-sm-3 col-xs-12">				
							<h5>Card Number</h5>
							<input type="tel" min="2" max="5" class="form-control" title="Card Number" name="card_number" value="<?php echo set_value('card_number'); ?>">
							<?php echo form_error('card_number'); ?>
						</div>				
				</div>
		 			<div  class="row">		
						<div class="col-md-5 col-sm-3 col-xs-12">		
							<h5> Valid From Date</h5>
							<div class="col-sm-6 col-md-6" style="margin-left: -15px;">	
								<div class="form-group">
									<select name="valid_from_mth" title="Valid from">													
										<?php 
											for($i=1;$i<=12;$i++){
												$selected = (set_value('valid_from_mth') == $i) ? 'selected' : '';
												echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';			
											}
										?>					
									</select>
									<?php echo form_error('valid_from_mth'); ?>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">	
								<div class="form-group">
									<select name="valid_from_yr" title="Valid from">							
										<?php 
											for($i=(date('Y')-14);$i<=date('Y');$i++){
												$selected = (set_value('valid_from_yr') == $i) ? 'selected' : '';
												echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
											}
										?>														
									</select>
									<?php echo form_error('valid_from_yr'); ?>
								</div>	
							</div>
						</div>
						<div class="col-md-5 col-sm-3 col-xs-12">		
							<h5> Valid To Date</h5>	
							<div class="col-sm-6 col-md-6" style="margin-left: -15px;">	
								<div class="form-group">
								
									<select name="valid_to_mth" title="Valid to">
									
										<option value="-1">--</option>	
										<?php 
											for($i=1;$i<=12;$i++){
												$selected = (set_value('valid_to_mth') == $i) ? 'selected' : '';
												echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';			
											}
											?>
									</select>
									<?php echo form_error('valid_to_mth'); ?>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">	
								<div class="form-group">
									<select name="valid_to_yr" title="valid to">
										<option value="-1">--</option>			
										<?php 
											for($i=date('Y');$i<=(date('Y')+8);$i++){	
												$selected = (set_value('valid_to_yr') == $i) ? 'selected' : '';
												echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
											}
										?>										
									</select>
									<?php echo form_error('valid_to_yr'); ?>						
								</div>				
							</div>
						</div>
					</div>
					<div  class="row">
						<div class="col-md-5 col-sm-3 col-xs-12">					
							<h5>Security Number<br></h5>
							<h6>Last 3 numbers on the back of your card</h6>
							<input class="form-control" title=" Security Number" name="cvv_number" value="<?php echo set_value('cvv_number'); ?>">
							<?php echo form_error('cvv_number'); ?>					
						</div>
					</div>					
					<div  class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">					
							<input type="submit" class="btn btn-primary" />
						</div>
					</div>				
			</div>	
			<input type="hidden" name="type_search" value="<?php echo $form_type;?>"/>
			<?php echo form_close();?>
			<div class="orderhotels"></div>
				<!-- book now closed here-->
		</div>
			<!--right side wrap start here-->
			<div class="col-sm-3" style="font-weight:normal;">	
				<div class="deals">	<h2>Your Selections	</h2></div>					
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
			                <span style="float:right;font-size: 13px;"><a href="<?php echo base_url().'availableHotels/'.$this->uri->segment(2);?>">Change</a></span>
			            </small>                
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
				
				<div class="bg_grey" style="margin-bottom:10px;">
		     		<div>
						<div class="left">TOTAL</div>
			        	<div class="right" style="text-align: right;">&#163;<span id="ExtraTotal"><span id="cphContent_lblSubTotal"><?php echo ((($seg[0]['num_adults'] + $seg[0]['num_children']) * $res_sel_price) + (($seg[0]['num_adults'] + $seg[0]['num_children']) * 2.50));?></span></span></div>
		        	</div>
					<div style="margin-bottom: 15px; margin-top: 5px;line-height: 20px;">            
		             	<small>Per Person: &#163;<span id="pprice"><?php echo (($res_sel_price * ($seg[0]['num_adults'] + $seg[0]['num_children'])) + (2.50 * ($seg[0]['num_adults'] + $seg[0]['num_children']))) / ($seg[0]['num_adults'] + $seg[0]['num_children']) ;?></span>  X <?php echo ($seg[0]['num_adults'] + $seg[0]['num_children']);?></small>             
		         	</div> 		       
		  		 </div>	
				 	
				<!--riht side wrap closed here-->	
				<div class="left-sidebar">
					<?php include_once 'includes/atol_left.php';?>
					<div class="clearfix"></div>					
				</div>
			</div>
<!--sidebar-->
		</div>
	</div>
