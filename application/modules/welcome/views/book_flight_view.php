<div class="clearfix"></div>
<?php include_once 'includes/change_search_flight_only.php';?>

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
						$attributes = array('name'=>'book_form');
						echo form_open(base_url().'/book_flight/'.$this->uri->segment(2), $attributes);
					?>
			<div class="orderhotels-one ">	
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
				<input type="hidden" name="type_search" value="flight_only"/>			
			</div>	

			<?php echo form_close();?>
			<div class="orderhotels"></div>	
		<!-- book now closed here-->
		</div>

		<!--right side wrap start here-->
		<div class="col-sm-3" style="font-weight:normal;">	
			<?php echo $seleted_info;?>   
			 <?php include_once 'includes/atol_tooltip.php';?>
			 <div class="left-sidebar">
				<?php include_once 'includes/atol_left.php';?>
				 <div class="clearfix"></div>
			</div>			
		</div>
	</div>		
		<!--riht side wrap closed here-->	
	<!--sidebar-->
</div>
	
