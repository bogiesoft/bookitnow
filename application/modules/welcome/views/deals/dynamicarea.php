<div class="clearfix"></div>

<!-- start slider meena adit -->
<div class="container-fluid holiday-bg">
	<div class="container">
	
		<div class="row image-wrap">
				<div class="col-sm-12 col-md-6 col-xs-12">
				<div class="left-img-wrap">
					
					
					
					
					<h2 class="holiday-title">Tenerife Holidays </h2>
					<div class="border-wrap"></div>
					<div class="image-bg"><img src="<?php echo base_url();?>images/holiday-img.jpg" class="img-responsive" alt="banner-img">
					<ul class="buttons-holiday">
					<li class="active-item"><a href="#"> DEALS</a></li>	
					<li class="active-item"><a href="#">ABOUT US</a></li>
					<li class="active-item"><a href="#">RELATED DESTINATIONS</a></li>		
					</ul>
					<div class="buttons-wrop">
					
					</div>	</div><br><br>
				</div>
			</div>
					
			<div class="col-sm-12 col-md-6 col-xs-12">
		  <div class="clearfix"></div>
						
<!------------------------------FORM START HERE MEENA -------------------------------------------->	


          
          <div class="tabbable-tab custom-tabs tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll pull-left">
			<ul class="nav nav-tabs">
		
			  <h2 class="holiday-title">Holiday Type <span class="book-title">Search &amp; Book Your Holiday</span></h2>
			  <div class="border-wrap"></div>
			
			  <li class="active-item flight_hotel"><a href="#panel2" data-toggle="tab"><span> Flight &amp; Hotel </span></a></li>
			  <li class="hotel"><a href="#panel3" data-toggle="tab"><span>Just a Hotel</span></a></li>
			  <li class="flight active"><a href="#panel1" data-toggle="tab" class="active "><span> Just a Flight </span></a></li>
			  
			</ul>	
			<div class="form-bg-wrap">
				<div class="tab-content " id="dvContent">
					<div class="tab-pane" id="panel1">
						<?php $attributes = array('name'=>'flight_hotel_form');
							echo form_open('welcome/index', $attributes);
						?>
				<div class="row-fluid">
					<div class="span5">
						<div class="flyform">
	  						<label>Fly From:</label>  						
	  						<select class="input-block-level"  name="departure_airports">
	  							<option value="-1">Select Destination</option>
	  							<?php
									foreach($filtered_departures as $key => $val)
									{									
										//echo "<option value='-1'>".$key."</option>";
										$opt_val_str = '';
										foreach($val as $key1 => $val1)
										{
											$opt_val_str .= $key1.'|';		
										}
										echo "<option value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
									}
								  ?>	                    
			                </select>
						</div>
						<div class="travelto">
	              			<label>Travel To:</label>
	              			<select class="input-block-level"  name="arrival_airports">
	                			<option value="-1">Select Destination</option>                                          
	              			</select>
	            		</div>
	            		<div class="flyform">
			              	<label>Departure Date:</label>
			              	<input class="input-block-level" id="datepicker" type="text"  name="departure_date" >
			            </div>					
			            <div class="board_basis">
			              <label>Nights :</label>
			              <select class="input-block-level"   name="nights">
			                <option value="-1">---Select---</option>
			               <?php for($i=1;$i<=21;$i++){
			              	echo '<option>'.$i.'</option>';
			              }?>       
			              </select>
			              </div><div>
			              <div class="hotel_adults" >
	              <label>Adults:</label>
	              <select class="input-block-level" name="adults">   
	              <?php for($i=1;$i<=15;$i++){
	              	echo '<option>'.$i.'</option>';
	              }?>             
	               </select>
	            </div>
	            <div class="hotel_childerns"  >
	              <label>Childrens:</label>
	              <select class="input-block-level" name="childrens">
	                <option  value="-1">0</option>
	              <?php for($i=1;$i<=10;$i++){
	              	echo '<option>'.$i.'</option>';
	              }?>           
	              </select>
	              <p text-align:center;">(Age *2-12)</p>
	            </div>
			               <div class="search">              
	              <input type="submit" class="sea" value="Search &gt;" />
	            </div>
			            </div>
			        
	           
	          </div>
	        </div>
	        <?php echo form_close();?>
	      </div>
	            
	      		 	<div class="tab-pane active" id="panel2">
				<?php $attributes = array('name'=>'full_pack_form','onSubmit'=>'return full_pack_submit(this)');
					echo form_open('welcome/index', $attributes);
				?>
				<div class="row-fluid">
					<div class="span5">
						<div class="flyform">
	  						<label>Fly From:</label>  						
	  						<select class="input-block-level" name="full_departure_airports">
	  							<option value="-1">Select Destination</option>
	  							<?php
									foreach($filtered_departures as $key => $val)
									{									
										//echo "<option value='-1'>".$key."</option>";
										$opt_val_str = '';
										foreach($val as $key1 => $val1)
										{
											$opt_val_str .= $key1.'|';		
										}
										echo "<option value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
									}
								  ?>	                    
			                </select>
						</div>
						<div class="travelto">
	              			<label>Travel To:</label>
	              			<select class="input-block-level"  name="full_arrival_airports">
	                			<option value="-1">Select Destination</option>                                          
	              			</select>
	            		</div>
	            		<div class="flyform">
			              	<label>Departure Date:</label>
			              	<input class="input-block-level" id="datepicker3" type="text"  name="full_departure_date">
			            </div>
						<div class="board_basis">
			              <label>Rooms :</label>
			              <select name="full_rooms" onchange="roomBase()" class="input-block-level">						
							 <option>1</option>
			                 <option>2</option>
			                 <option>3</option>
			                 <option>4</option>
						  </select>
			            </div>
			            <div class="adults">
			              <label>Nights :</label>
			              <select class="input-block-level"   name="full_nights">
			                <option value="-1">---Select---</option>
			                <?php for ($i=1;$i<=21;$i++){
			                	echo '<option>'.$i.'</option>';
			                }?>		              
			              </select>
			            </div>
			            <div class="adults">
			              <label>Adults:</label>
			              <select class="input-block-level"  name="full_adults">		               
			               <option>1</option>
			                <option>2</option>
			                <option>3</option>
			                <option>4</option>
			              </select>
			            </div>
	
						<div class="childerns">
			              <label>Childrens:</label>
			              <select class="input-block-level"  name="full_children" onchange="roomBase();">
			                <option value="-1">0</option>
			                <option>1</option>
			                <option>2</option>
			                <option>3</option>
			                <option>4</option>
			              </select>
			              <p text-align:center;">(Age *2-12)</p>
			            </div>
			            
	            <div class="search">              
	              <input type="submit" class="sea" value="Search &gt;" />
	            </div>
	          </div>
	        </div>
	        <?php echo form_close();?>
	      </div>
	      
	      		    <div class="tab-pane" id="panel3">
	      <?php $attributes = array('name'=>'hotels_form','onsubmit'=>'return hotelsForm(this);');
							echo form_open('welcome/index', $attributes);
						?>
	        <div class="row-fluid">
	          <div class="span5"  style="padding-bottom: 10px;">
	            <label>Travel To:</label>
	            <select class="input-block-level" name="hotel_travel_to">
	              <option value="-1">---Select Destination---</option>
	              	<?php echo $hotel_travel_list;?>
	              </select>
	            </div>
	            <div class="check"  style="margin-bottom:10px;">
	              <label>Check In Date:</label>
	              <input id="datepicker1" type="text" name="hotel_check_in_date" style="height: 35px;">
	            </div>
	            <div class="board_basis" >
	              <label>Nights:</label>
	              <select class="input-block-level" name="hotel_nights">
	                <option value="-1">---Select---</option>
	                <?php for ($i=1;$i<=21;$i++){
			                	echo '<option>'.$i.'</option>';
			                }?>		  
	              </select>
	            </div>
	            </div>          
	            <div class="hotel_rooms"  >
	              <label>Rooms:</label>
	              <select class="input-block-level"  name="hotel_rooms" >
	                <option value="-1">---Select---</option>
	               <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	              </select>
	            </div>
	            <div class="hotel_adults" >
	              <label>Adults:</label>
	              <select class="input-block-level" name="hotel_adults">
	                <option  value="-1">---Select---</option>
	               <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	              </select>
	            </div>
	            <div class="hotel_childerns"  >
	              <label>Childrens:</label>
	              <select class="input-block-level" name="hotel_childrens">
	                <option  value="-1">0</option>
	                <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	              </select>
	              <p text-align:center;">(Age *2-12)</p>
	            </div>
	             
	            <div class="search">
	              <input type="submit" class="sea" value="Search &gt;" />
	            </div>
	              <?php echo form_close();?>
	               <br><br> <br> <br>
	          </div>
	         
	      		</div>   
	      		   	
	      	</div>
		</div>
      
          
		  
<!------------------------------FORM CLOSED MEENA -------------------------------------------->	  
	  
		  

					
				
			</div>
			
	</div>
	
	</div>
		  <div class="clearfix"></div>  

</div>
<!--/slider closed meena adit --> 

   
 <div class="container-fluid line-bg"> </div>
    
<div id="body_content">
	<div class="container">
	
		
<div class="clearfix"></div>
<!--meena--adit-->
<div class="container">
	<div class="row"> 
	
		<div class="col-sm-9">
		<h2 class="holiday-title">Our Latest deals to Tenerife </h2>
		<h5 class="text-in-color">Select your preferences to find the perfect deal</h5>
			<div class="row">	
			
				<div class="col-sm-12 col-md-3">
					<div class="option dealfilter_rating">
                                            <label class="label-text">Rating:</label><br>
                                            <select name="ctl00$cphContent$ddlDepart" onchange="javascript:blockHotelDeals();setTimeout('__doPostBack(\'ctl00$cphContent$ddlDepart\',\'\')', 0)" id="cphContent_ddlDepart">
											<option selected="selected" value="any">Select</option>
											<option value="LGW/LTN/STN/LHR/SEN/LCY">Any London</option>
											<option value="BFS/BHD">Belfast</option>
											<option value="EMA/BHX">Midlands</option>
											<option value="NCL/MME">North East</option>
											<option value="MAN/LPL/EMA/DSA/LBA/BLK/HUY">North West</option>
											<option value="GLA/PIK/EDI/ABZ/INV">Scotland</option>
											<option value="BRS/EXT/CWL/BOH/SOU/EXE">South West</option>

											</select>
										                                           
					</div>						
				</div>
			
				
				<div class="col-sm-12 col-md-3">
					<div class="option dealfilter_from">
                                             <label class="label-text">Date</label>
                                            <select name="ctl00$cphContent$ddlDepart" onchange="javascript:blockHotelDeals();setTimeout('__doPostBack(\'ctl00$cphContent$ddlDepart\',\'\')', 0)" id="cphContent_ddlDepart">
											<option selected="selected" value="any">Select</option>
											<option value="Dec2015">Dec 2015</option>
											<option value="Jan2016">Jan 2016</option>
											<option value="Feb2016">Feb 2016</option>
											<option value="Mar2016">Mar 2016</option>
											<option value="Apr2016">Apr 2016</option>
											<option value="May2016">May 2016</option>
											<option value="Jun2016">Jun 2016</option>
											<option value="Jul2016">Jul 2016</option>
											<option value="Aug2016">Aug 2016</option>
											<option value="Sep2016">Sep 2016</option>
											<option value="Oct2016">Oct 2016</option>
											<option value="Nov2016">Nov 2016</option>
											<option value="Dec2016">Dec 2016</option>
											<option value="Jan2017">Jan 2017</option>
											</select>										
                    </div>					
				</div>	
				<div class="col-sm-12 col-md-2">
					<div class="option dealfilter_from">
                                             <label class="label-text">Nights:</label>
                                            <select name="ctl00$cphContent$ddlDepart" onchange="javascript:blockHotelDeals();setTimeout('__doPostBack(\'ctl00$cphContent$ddlDepart\',\'\')', 0)" id="cphContent_ddlDepart">
											<option value="any">Any Night</option>
											<option value="3">3 nights</option>
											<option value="4">4 nights</option>
											<option value="5">5 nights</option>
											<option value="6">6 nights</option>
											<option selected="selected" value="7">7 nights</option>
											<option value="8">8 nights</option>
											<option value="9">9 nights</option>
											<option value="10">10 nights</option>
											<option value="11">11 nights</option>
											<option value="12">12 nights</option>
											<option value="14">14 nights</option>
											</select>										
                    </div>					
				</div>	
						
				
					<div class="col-sm-12 col-md-2">
					<div class="option dealfilter_from">
                                             <label class="label-text">Board Basis:</label>
                                          <select name="ctl00$cphContent$ddlDepart" onchange="javascript:blockHotelDeals();setTimeout('__doPostBack(\'ctl00$cphContent$ddlDepart\',\'\')', 0)" id="cphContent_ddlDepart">
												<option selected="selected" value="any">Any Board</option>
												<option value="AI">All Inclusive</option>
												<option value="BB">Bed &amp; Breakfast</option>
												<option value="HB">Half Board</option>
												<option value="SC">Self Catering</option>
											</select> 										
                    </div>					
				</div>

				
				<div class="col-sm-12 col-md-2">
					<div class="option dealfilter_from">
                                             <label class="label-text">Rating:</label>
                                         <select name="ctl00$cphContent$ddlRating" onchange="javascript:blockHotelDeals();setTimeout('__doPostBack(\'ctl00$cphContent$ddlRating\',\'\')', 0)" id="cphContent_ddlRating">
											<option selected="selected" value="any">Any Rating</option>
											<option value="3">3 star</option>
											<option value="4">4 star</option>
											<option value="5">5 star</option>
											</select>  										
                    </div>					
				</div>

			
				
		</div><!--row closed form--><br>

		<div class="right_side">
				
<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Vigilia Park</h2>
							<div class="tener-font">Puerto Santiago, Tenerife </div>
							<p><b>7 Nights</b> Self Catering</p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Royal Park Albatros Club</h2>
							<div class="tener-font">Golf del Sur, Tenerife </div>
							<p><b>7 Nights</b> Self Catering</p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			
			
			<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Neptuno</h2>
							<div class="tener-font">Costa Adeje, Tenerife </div>
							<p><b>7 Nights </b>Self Catering</p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Marino Tenerife</h2>
							<div class="tener-font">Costa del Silencio, Tenerife </div>
							<p><b>7 Nights</b> Self Catering</p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			
			<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Cordial Golf Plaza</h2>
							<div class="tener-font">Golf del Sur, Tenerife </div>
							<p><b>7 Nights</b> Self Catering</b></p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-sm-4">
					<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/Pool.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images/family-t.jpg" alt="family">
							</div>
					</div>
							<h2>Globales Acurio</h2>
							<div class="tener-font">Puerto de la Cruz , Tenerife </div>
							<p><b>7 Nights </b>Half Board</p>
					<div class="rate">
						<div class="clearfix padded_v">
							<div class="fluid columns_nine zeroMargin_desktop">
								<small class="txt_color_1">Deals From</small><br>
								<strong class="txt_xxtra_large-1 txt_color_1">£172</strong><small class="txt_color_1">pp</small>                                                               
							</div>
								<div class="fluid columns_go">
								<a href="#" class="button">BOOK <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
			
		
<!--images container closed meena here-->
				
					
			<div class="clearfix"></div>
		</div>
</div>
<!--sidebar-->
    <div class="col-sm-3">
        <div class="left-sidebar"> <br>
			<div class="superescapes"></div>

			<div class="tenerife">
				<h2>Top 3 Star tenerife Hotels</h2>
				
						<div class="tene-text-left"><a href="#"><b>Vigilia Park</b> ---    fr £124pp</a></div>										
						<div class="tene-text-left"><a href="#"><b>Royal Park Albatros Club</b> ---fr £133pp</a></div>									
						<div class="tene-text-left"><a href="#"><b>Globales Acurio</b> ---fr £138pp</a></div>	
			</div>
			
			<div class="clearfix"></div>			
			<div class="tenerife">
						<h2>Top 4 Star tenerife Hotels </h2>				
						<div class="tene-text-left"><a href="#"><b> Neptuno</b> ---fr £130pp</a></div>										
						<div class="tene-text-left"><a href="#"><b>Marino Tenerife </b> ---  fr £133pp</a></div>									
						<div class="tene-text-left"><a href="#"><b>Cordial Golf Plaza</b> --- fr £135pp</a></div>					
			</div><div class="clearfix"></div>
			<div class="tenerife">
						<h2>Top 5 Star tenerife Hotels  </h2>				
						<div class="tene-text-left"><a href="#"><b> Los Claveles</b> ---fr £183pp</a></div>										
						<div class="tene-text-left"><a href="#"><b>Hollywood Mirage</b> ---fr £183pp</a></div>									
						<div class="tene-text-left"><a href="#"><b>Mediterranean Palace</b> ---fr £205pp</a></div>
					
			</div><div class="clearfix"></div>
			
		</div>
		
	</div>
<!--sidebar-->
    <div class="col-sm-3">
        <div class="left-sidebar">
				<div class="superescapes">
					<h2>Why Super Escapes Travel?</h2>
					<ul>
					<li><img src="<?php echo base_url();?>images/1.png" alt="ATOL holders"><a href="#">ATOL holders</a></li>
					<li><img src="<?php echo base_url();?>images/2.png" alt="ATOL Protected"><a href="#">ATOL Protected</a></li>
					<li><img src="<?php echo base_url();?>images/3.png" alt="Hand picked deals"><a href="#">Hand picked deals</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
					<div class="reviews">
					<h2>Independent Reviews</h2>
					<p>We are dedicated towards delivering our best in quality and service. Read what our customer says about superescapes on feefo.</p>
					<div class="review"><img src="<?php echo base_url();?>images/feefo-logo.png" class="img-responsive" alt="feefo-logo"></div>
					</div>
				<div class="clearfix"></div>
					
		</div>
	</div>
	</div>
	<h2 class="side-heading">ABOUT TENERIFE<h2>
	<div class="reviews-text">
	<p>A holiday to Tenerife is a safe choice for anyone who wants a sunshine break no matter what the time of year. With year round sunshine and a wide range of activities to suit all tastes, it is easy to see why.</p>
	<p>The largest of the Canary Islands and the most popular Spanish island with tourists, Tenerife is popular with tourists of all ages: from teenagers and twenty somethings wanting to dance the night away in the bars and nightclubs of Playa de las Americas, all the way through to more mature couples seeking relaxation in the northern resort of Puerto de la Cruz, Tenerife has something for everyone.</p>
	<h3 class="side-heading">When to go & whats on<h3>
	
	<p>Holidaymakers will struggle to complain with Tenerife’s weather at any time of the year, but ‘the Island of Eternal Spring’, as it is known, does have a surprising contrast in climate. While during the summer temperatures average 26 degrees, peaking typically in August, winters can see warm climates in the low twenties on the coast, and snow inland, due to the island’s mountainous geography. Even in January, the average temperature is 18 degrees. </p>
	<p>One of Tenerife’s most famous events is the Carnival of Santa Cruz, which while most relevant to the city that bears its name, is actually celebrated all over the island. The carnival, which lasts ten days during February each year, has been designated a Festival of International Tourist Interest, and sees street music, minstrels and masquerades, all celebrating in the streets.</p>
	<p>The best way to soak up Tenerife’s scenery is Teide National Park, with its volcanic mountain and natural wilderness. The park is a World Heritage Site, and offers walkers the chance to soak up the beauty of the island.</p>
	<p>In the north, the Tenerife Airshow, held in Puerto de la Cruz each Easter, offers spectacular views of some fantastic aircraft old and new. The same resort offers the stunning botanical gardens – a wonderland of truly exotic plants including everything from giant figs with their strangler roots, to spiky dragon trees.</p>
	
	<h3 class="side-heading">What attracts holidaymakers to Tenerife?<h3>
	
	<p>Tenerife offers all kinds of holiday, whether you are looking for cheap holidays to Tenerife or something more luxurious the island is an ideal destination for tourists wanting an easy get away with a reasonable flight time (4 hours 30 minutes from London Gatwick), regardless of whether you want to party, relax or fill your days with activities.</p>
	<p>Unsurprisingly, given the size of the island, there is something for everyone. For those looking to dance until the sun comes up, Playa de Las Americas is perpetually popular with students and young people looking for a good time, while just along the coast the harbour town of Los Cristianos, with its charming buildings and architecture, offers holiday makers a more relaxed, all round experience, with beach front playgrounds for toddlers. There are still plenty of restaurants and a number of bars, and also a fantastic range of excursions, such as whale watching and dolphin spotting.</p>
	
	<h3 class="side-heading">Tenerife – A great all inclusive destination<h3>
	
	<p>For those wanting to spend nothing once they’ve got off the plane, Tenerife is home to a plethora of all inclusive holiday options, allowing you to put your feet up and enjoy all the cocktails, tapas and paella you could need. Many of these come with access to local activities, such as waterparks which provide adults and children alike with the opportunity to test out the numerous exciting water slides. Siam Waterpark, in particular, has won plaudits from holidaymakers all over the world. For those holidaymakers who are up for a challenge, Mount Teide is the highest peak in Spain at 3718 metres, with views to die for.
	</p>
	<p>However, if your holiday is all about putting your feet up, forgetting about work and relaxing both mentally and physically, then northern Tenerife is a more sedate area than the livelier south. There are numerous areas around the city of Puerto de la Cruz which, while consistently popular, attract a much more relaxed crowd. Popular with British holidaymakers and other Europeans alike, the north coast, with its black, volcanic sands and wide variety of restaurants, is ideal if you’re after a relaxing break. </p>
	
	<h3 class="side-heading">Where to stay on Tenerife <h3>
		
	<p>Tenerife has a wide variety of accommodation options for people on all budgets, with plenty of hotels, apartments and villas to choose from, ranging from five star luxury to hostels for travellers on a budget.</p>	
	<p>Playa de Las Americas, the biggest resort on the island, has a wide range of accommodation available for all kinds of holidaymakers, regardless of whether you’re wanting a luxury hotel for relaxation, or a base from which you can explore the island and enjoy its nightlife.</p>
	
	<p>For those wanting a holiday filled with luxury, Tenerife offers numerous five star hotels that come with all of the luxuries you’d expect. For example, the Costa Adeje Gran Hotel offers panoramic views of the Atlantic, a fantastic range of swimming pools, bars and restaurants, plus its very own wellness centre.</p>	
		
	<h3 class="side-heading">Tenerife Destinations<h3>
		 
	</div>
	
<div class="col-sm-3 col-mg-4">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Adeje</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-12.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Callao Salvaje</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-11.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Costa Adeje</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-10.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Costa del Silencio</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-9.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<!--second row start here--->

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Garachico</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-8.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>
<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">CGolf del Sur</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-7.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Los Cristianos</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-6.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Los Silos</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-5.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<!--third row start here-->

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Playa de las Americas</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-4.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Playa la Arena</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-3.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Playa Paraiso</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-2.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>
<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Puerto de la Cruz</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images/tene-img-1.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£172<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

</div>


<!--meena adit closed-->
</div>
</div><!--contanier-->
<div class="clearfix"></div>

<div id="rooms_div" style="display: none;">
  <h2>Rooms - Persons</h2>
     <div>
        <h4 class="has_bottom_margin">Please share the members for each room.</h4>
	    	<form id="rooms_form">
	    	</form>
                      
     </div>     
</div>


<div id="bluk_div" style="display: none;">
  <div class="img-title"><img src="<?php echo base_url();?>images/top-bg.jpg" alt="title-name"></div>
      <div>
	    	 <form class="f-box" id="bulk_form" method="post">
	    	    <div class="form-group noHotel">	   
	    	    	<label>Fly From : </label> 			
	    			<select class="input-block-level"  name="fly_from" onchange="arrivals(this.value,document.getElementById('arrival_airports_p'))">
  						<option value="-1">Select Destination</option>
  							<?php
								foreach($filtered_departures as $key => $val)
								{						
									$opt_val_str = '';
									foreach($val as $key1 => $val1)
									{
										$opt_val_str .= $key1.'|';		
									}
									echo "<option value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
								}
							  ?>	                    
		              </select>
	    		</div>
	    		<div class="form-group">
					<label>Travel To : </label>    			
	    			<select class="input-block-level"  id="arrival_airports_p" name="travel_to">
                		<option value="-1">Select Destination</option>                            
              		</select>
	    		</div>
	    		<div class="form-group noHotel">	
	    			<label> Departure Date : </label>    			
	    			<input type="text" class="form-control datePicker" placeholder="Departure Date" name="Date_of_departure">
	    		</div>
	    		<div class="form-group noFull noFlight">	
	    			<label> Check In Date : </label>    			
	    			<input type="text" class="form-control datePicker" placeholder="Check In Date" name="check_in_date">
	    		</div>
	    		<div class="form-group">
	    			<label> Nights : </label>	    			
	    			<input type="text" class="form-control" placeholder="Nights" name="number_of_nights">
	    		</div>	    			    		
	    		<div class="form-group noFlight">	
	    			<label> Rooms: </label>    			
	    			<input type="text" class="form-control" placeholder="Number of rooms" name="rooms">
	    		</div>
	    		<div class="form-group">
	    			<label> Adults: </label>    		    			
	    			<input type="text" class="form-control" placeholder="Number of adults" name="Adults">
	    		</div>	    		
	    		<div class="form-group">
	    			<label> Children : </label>    		    			
	    			<input type="text" class="form-control" placeholder="Number of Children" name="Children">
	    		</div>
	    		<div class="form-group">
	    			<label> Name : </label>	    			
	    			<input type="text" class="form-control" placeholder="Name" name="first_name">
	    		</div>  		
	    		<div class="form-group">	
	    			<label> Email : </label>    			
	    			<input type="text" class="form-control" placeholder="Email" name="email">
	    		</div>
	    		<div class="form-group">	    
	    			<label> Mobile : </label>			
	    			<input type="text" class="form-control" placeholder="Mobile" name="mobile">
	    		</div>		    		
	    		<div class="form-group">	    
	    			<label> Comments : </label>			
	    			<textarea class="form-control" placeholder="Comments" name="comments"></textarea>
	    		</div>		    		
	    		<button class="btn btn-primary" type="submit" style="margin-top: 10px;float:right;"> Submit </button>	
	    	</form>    
	    	
     </div>
  </div>     
</div>
<link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet' type='text/css'>
<style>
label{
color: #393838;
font-size:14px;
}

</style>