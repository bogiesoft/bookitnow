
<style>
body a:focus {
 outline: 0 none;
 text-decoration: none;
}
#container {
	width: 40%;
	height: 50%;
	max-width: 1200px;
	max-height: 700px;
	margin: 100px auto;

 
}

<!-- menu closed meena-->
</style>
<div class="clearfix"></div>

<!-- start slider meena adit -->
<div class="container-fluid holiday-bg">
	<div class="container">
	 <div class="row image-wrap">
		<div class="col-sm-12 col-md-6 col-xs-12">
				<div class="left-img-wrap">
					
					
					<h2 class="holiday-title">Topaz</h2>
					<div class="border-wrap"></div>
	<div class="image-bg">					
		<div id="container">
			<div id="slideshow" class="fullscreen">
				<!-- Below are the images in the gallery -->
			    <div id="img-1" data-img-id="1" class="img-wrapper active" style="background-image: url('/images/slider/img1.jpg')" class="img-responsive"></div>
			    <div id="img-2" data-img-id="2" class="img-wrapper" style="background-image: url('/images/slider/img2.jpg')" class="img-responsive" ></div>
			    <div id="img-3" data-img-id="3" class="img-wrapper" style="background-image: url('/images/slider/img3.jpg')" class="img-responsive" ></div>
			    <div id="img-4" data-img-id="4" class="img-wrapper" style="background-image: url('/images/slider/img4.jpg')" class="img-responsive" ></div>	
				<div id="img-3" data-img-id="5" class="img-wrapper" style="background-image: url('/images/slider/img5.jpg')" class="img-responsive" ></div>
			    <div id="img-4" data-img-id="6" class="img-wrapper" style="background-image: url('/images/slider/img6.jpg')" class="img-responsive" ></div>
				<div id="img-3" data-img-id="7" class="img-wrapper" style="background-image: url('/images/slider/img7.jpg')" class="img-responsive" ></div>
			
	

				<!-- Below are the thumbnails of above images -->
			    <div class="thumbs-container bottom">
			    	<div id="prev-btn" class="prev">
			    		<i class="fa fa-chevron-left fa-3x"></i>
			    	</div>
					<ul class="thumbs">
						<li data-thumb-id="1" class="thumb active" style="background-image: url(/images/slider/img1-thumb.jpg)" class="img-responsive" ></li>
						<li data-thumb-id="2" class="thumb" style="background-image: url(/images/slider/img2-thumb.jpg)" class="img-responsive" ></li>
						<li data-thumb-id="3" class="thumb" style="background-image: url(/images/slider/img3-thumb.jpg)" class="img-responsive" ></li>
						<li data-thumb-id="4" class="thumb" style="background-image: url(/images/slider/img4-thumb.jpg)" class="img-responsive" ></li>						
						<li data-thumb-id="5" class="thumb" style="background-image: url(/images/slider/img5-thumb.jpg)" class="img-responsive" ></li>
						<li data-thumb-id="6" class="thumb" style="background-image: url(/images/slider/img6-thumb.jpg)" class="img-responsive" ></li>
						<li data-thumb-id="7" class="thumb" style="background-image: url(/images/slider/img7-thumb.jpg)" class="img-responsive" ></li>
					
					
					</ul>
			    	<div id="next-btn" class="next">
			    		<i class="fa fa-chevron-right fa-3x"></i>
			    	</div>
			    </div>
			</div>
		</div>
	</div>					
		<br><br>
</div></div>
				
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
	
		<h2 class="holiday-title">Similar 4 Star Hotels</h2>
		<h5 class="text-in-color">Find the perfect deal with superescapes.com</h5>
		

<div class="right_side">				
			<div class="col-sm-4">
				<div class="tener_nature">	
					<div class="image"><img src="<?php echo base_url();?>images/tene-img-10.jpg" class="img-responsive" alt="Pool">
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
					<div class="image"><img src="<?php echo base_url();?>images/tene-img-11.jpg" class="img-responsive" alt="Pool">
						<div class="star"><img src="<?php echo base_url();?>images/star.png" class="img-responsive" alt="star"></div>
							<div class="mini_img"><img src="<?php echo base_url();?>images/tree-t.jpg" alt="tree"> 
							<img src="<?php echo base_url();?>images//family-t.jpg" alt="family">
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
					<div class="image"><img src="<?php echo base_url();?>images/tene-img-10.jpg" class="img-responsive" alt="Pool">
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
			

		
<!--images container closed meena here-->
				
						
			<div class="clearfix"></div>
		</div>
</div>



    <div class="col-sm-3">
        <div class="left-sidebar">
				<div class="superescapes">
					<h2>Why Super Escapes Travel?</h2>
					<ul>
					<li><img src="<?php echo base_url();?>images//1.png" alt="ATOL holders"><a href="#">ATOL holders</a></li>
					<li><img src="<?php echo base_url();?>images//2.png" alt="ATOL Protected"><a href="#">ATOL Protected</a></li>
					<li><img src="<?php echo base_url();?>images//3.png" alt="Hand picked deals"><a href="#">Hand picked deals</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
					<div class="reviews">
					<h2>Independent Reviews</h2>
					<p>We are dedicated towards delivering our best in quality and service. Read what our customer says about superescapes on feefo.</p>
					<div class="review"><img src="<?php echo base_url();?>images//feefo-logo.png" class="img-responsive" alt="feefo-logo"></div>
					</div>
				<div class="clearfix"></div>
					
		</div>
	</div>
	</div>
	<h2 class="side-heading">ABOUT TOPAZ<h2>
	<div class="reviews-text">
	<p>Following a recent refurbishment, Malta's Topaz Hotel is a stylish and comfortable place to holiday in Bugibba. A ten minute walk will take guests to the sea front promenade, shops, bars, restaurants and nightlife in the centre of Bugibba and most of Malta's major towns are just a few miles away. </p>
	<p>The Topaz Hotel sits in the heart of the bustling seaside resort of Bugibba, situated at the northern end of Malta Island. It is well placed for easy access to the various delights of the island, ten minute walk to the seafront, five minutes to the local entertainment and shopping and just 800 metres to the main centre of town. This hotel offers an All Inclusive concept and is geared up for all types of visitors including family groups, with a variety of dining, relaxation and entertainment options. Book into the Topaz Hotel and you'll be spoilt for choice! </p>
	<p>The Topaz Hotel could seriously add inches to your waistline so; make good use of the pools and the sports options too! Food, drink and entertainment: The Emerald Restaurant, La Perla Pizzeria (evenings only), the Beryl Pool Snack Bar, the Peacock Lounge (live entertainment most evenings) and The Royal Oak (a traditional English Pub). Also an Animation Team offers entertainment and activities. Varied dining facilities are available from the Table d'Hote menu in the main restaurant to the snacks at the poolside bar or, if you're feeling homesick, why not enjoy a beer in The Royal Oak, a traditional English style pub.</p>
	<p>For the kids: Children's paddling area in the swimming pool and a Kids Club during summer months with an Animation Team to keep them busy. </p>
	<p>Additional: 24 hour Front Desk, house-keeping, chargeable internet area, a 250 seat banqueting hall, hairdressing salon, souvenir shop, and a small library. </p>
	<p>The hotel has a wide variety of sport and leisure facilities including a large swimming pool and sun terrace, an indoor pool (from November to June), a sauna, a Jacuzzi and a games room for children. </p>
	<p>All 258 of the Topaz Hotel's guest rooms are beautifully decorated and fully furnished, most have a balcony and great views. The guest accommodation at the Topaz Hotel offers a Studio with inland views and a Twin Room with a pool or inland view, featuring full air-conditioning with individual temperature control, ensuite bathroom, euro-satellite TV, direct dial telephone, radio, safe for hire, hair dryer and some rooms have a balcony.</p>
	<h3 class="side-heading">Related Destinations<h3>
<p>If You Like Bugibba, You May Also Be interested In..</P>	
	</div>
	
<div class="col-sm-3 col-mg-4">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#"> Birzebbuga</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-12.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£230<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Mellieha</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-11.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£140<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Qawra</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-10.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£147<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Sliema</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-9.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£167<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>

<!--second row start here--->

<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">St Julians</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-8.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night </b>Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£198<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>
<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">St Pauls Bay</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-7.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£154<small class="txt_color_1">pp</small></strong>
			</div>
		</div>
	</div>		
</div>


<div class="col-sm-3 col-mg-3">
	<div class="green_nature">
		<div class="title-deal">
			<div class="img-wrap-bg"><h2><a href="#">Valletta</a></h2></div>
		</div>
		<div class="zoom-effect-container">	
			<div class="image-card">
			<img src="<?php echo base_url();?>images//tene-img-6.jpg" class="img-responsive" alt="Pool">			 
			</div> 
			<p><b>7 Night</b> Holidays From </p>			
			<div class="txt_xxtra_large-1">
			<strong class="txt_xxtra_large-1 txt_color_1">£403<small class="txt_color_1">pp</small></strong>
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
			<img src="<?php echo base_url();?>images//tene-img-5.jpg" class="img-responsive" alt="Pool">			 
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
			<img src="<?php echo base_url();?>images//tene-img-4.jpg" class="img-responsive" alt="Pool">			 
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
			<img src="<?php echo base_url();?>images//tene-img-3.jpg" class="img-responsive" alt="Pool">			 
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
			<img src="<?php echo base_url();?>images//tene-img-2.jpg" class="img-responsive" alt="Pool">			 
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
			<img src="<?php echo base_url();?>images//tene-img-1.jpg" class="img-responsive" alt="Pool">			 
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