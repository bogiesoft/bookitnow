
<!-- start slider -->

<div class="header-slider">
	<div class="caption">
		<div class="tabbable custom-tabs tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll pull-left">
			<ul class="nav nav-tabs">
			  <h2>Holiday Type</h2>
			  <h4>Search & Book Your Holiday</h4>
			  <li class="active-item active flight_hotel"><a href="#panel2" data-toggle="tab"><span> Flight & Hotel </span></a></li>
			  <li class="hotel"><a href="#panel3" data-toggle="tab"><span >Just a Hotel</span></a></li>
			  <li class="flight"><a href="#panel1" data-toggle="tab" class="active "><span> Just a Flight </span></a></li>
			  
			</ul>
			<div class="tab-content "  id='dvContent'>
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
		              	<input class="" id="datepicker" type="text"  name="departure_date">
		            </div>
					<!--  <div class="board_basis">
		              <label>Rooms :</label>
		              <select name="rooms" class="input-block-level">						
						 <option>1</option>
		                 <option>2</option>
		                 <option>3</option>
		                 <option>4</option>
					  </select>
		            </div>-->
		            <div class="board_basis">
		              <label>Nights :</label>
		              <select class="input-block-level"   name="nights">
		                <option value="-1">---Select---</option>
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		                <option>5</option>
		                <option>6</option>
		                <option>7</option>
		                
		              </select>
		            </div>
		           <!--  <div class="adults">
		              <label>Adults:</label>
		              <select class="input-block-level"  name="adults">		               
		               <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		              </select>
		            </div>

					<div class="childerns">
		              <label>Childrens:</label>
		              <select class="input-block-level"  name="children">
		                <option value="-1">---Select---</option>
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		              </select>
		              <p style="color:#fff; text-align:center;">(Age *2-12)</p>
		            </div>-->
            <div class="search">              
              <input type="submit" class="sea" value="Search &gt;" />
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
		              	<input class="" id="datepicker3" type="text"  name="full_departure_date">
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
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		                <option>5</option>
		                <option>6</option>
		                <option>7</option>
		                
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
		                <option value="-1">---Select---</option>
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		              </select>
		              <p style="color:#fff; text-align:center;">(Age *2-12)</p>
		            </div>
		            <div id="append_ext"></div>
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
          <div class="span5">
            <label>Travel To:</label>
            <select class="input-block-level" name="hotel_travel_to" style="padding:10px; margin-bottom:10px;">
              <option value="-1">---Select Destination---</option>
              	<?php echo $hotel_travel_list;?>
              </select>
            </div>
            <div class="check"  style="margin-bottom:10px;">
              <label style="color:#fff;">Check In Date:</label>
              <input id="datepicker1" type="text" name="hotel_check_in_date">
            </div>
            <div class="board_basis" >
              <label style="color:#fff;">Nights:</label>
              <select class="input-block-level" style="height:43px;margin-bottom:10px;" name="hotel_nights">
                <option value="-1">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            </div>          
            <div class="hotel_rooms"  >
              <label>Rooms:</label>
              <select class="input-block-level"  onchange="roomBase_hotel()"  name="hotel_rooms" >
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
              <select class="input-block-level"  onchange="roomBase_hotel()"  name="hotel_childrens">
                <option  value="-1">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#fff; text-align:center;">(Age *2-12)</p>
            </div>
             <div id="append_ext_hotel"></div>
            <div class="search">
              <input type="submit" class="sea" value="Search &gt;" />
            </div>
          </div>
        </div>
         <?php echo form_close();?>
      </div>
 
          </div>
          </div>
          </div>

<div class="slider">

       
<div class="callbacks_container">
<ul class="rslides" id="slider">
<li> <img src="<?php echo base_url();?>images//banner1.jpg" alt="" class="img-responsive"> </li>
<li> <img src="<?php echo base_url();?>images//banner2.jpg" alt="" class="img-responsive"> </li>
</ul>
          
        </div>  
      </div>
      </div>
  </div>
   
    <!--/slider --> 
    <div class="clearfix"></div>
   
    
    
<div id="body_content">
<div class="container">

<div class="col-sm-12">
<div class="latest_offers">
<p class="text">Latest Offers &nbsp; <i class="fa fa-chevron-right"></i></p>
<marquee direction="left" scrollamount="5" behavior="scroll" width="80%;">
<p class="pera">Tuesday's Manager's Choice Holiday Deals Don't Miss Our Unbeatable, Hand-Picked Deals with Exclusive Rates</p></marquee>
</div>
  
</div>
</div>
<div class="clearfix"></div>

<div class="container">
<div class="row"> 
<div class="col-sm-9">
<div class="right_side">
<div class="col-sm-6">
<div class="green_nature">
<div class="image"><img src="<?php echo base_url();?>images//Pool.jpg" class="img-responsive">
<div class="star"><img src="<?php echo base_url();?>images//star.png" class="img-responsive"></div>
<div class="mini_img"><img src="<?php echo base_url();?>images//tree.jpg"> 
<img src="<?php echo base_url();?>images//family.jpg">
</div>
</div>
<h2>Green Nature Diamond</h2>
<h3>Luxury Turkey! | FREE Room Upgrade</h3>
<p>FREE Marmaris City Tour and MORE!</p>
<div class="rate">
<div class="clearfix padded_v">
                            <div class="fluid columns_nine zeroMargin_desktop">
							<small class="txt_color_1">Deals From</small><br>
                                <strong class="txt_xxtra_large txt_color_1">&euro;172</strong><small class="txt_color_1">pp</small>
                                                               
                            </div>
                            <div class="fluid columns_three">
                                <a href="#" class="button">GO <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
                            </div>
                        </div>

</div>
</div>
</div>

<div class="col-sm-6">
<div class="green_nature">
<div class="image"><img src="<?php echo base_url();?>images//Beach-Area.jpg" class="img-responsive">
<div class="star"><img src="<?php echo base_url();?>images//star.png" class="img-responsive"></div>
<div class="mini_img"><img src="<?php echo base_url();?>images//tree.jpg"> 

</div>
</div>
<h2>Aquis Pelekas Beach</h2>
<h3>Luxury Turkey! | FREE Room Upgrade</h3>
<p>Beachfront Setting l Luxury 5-Star</p>

<div class="rate">
<div class="clearfix padded_v">
                            <div class="fluid columns_nine zeroMargin_desktop">
							<small class="txt_color_1">Deals From</small><br>
                                <strong class="txt_xxtra_large txt_color_1">&euro;172</strong><small class="txt_color_1">pp</small>
                                                               
                            </div>
                            <div class="fluid columns_three">
                                <a href="#" class="button">GO <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
                            </div>
                        </div>

</div>


</div>
</div>


<div class="col-sm-6">
<div class="green_nature">
<div class="image"><img src="<?php echo base_url();?>images//img03.jpg" class="img-responsive">

<div class="mini_img"><img src="<?php echo base_url();?>images//tree.jpg"> 

</div>
</div>
<h2>Green Nature Diamond</h2>
<h3>Luxury Turkey! | FREE Room Upgrade</h3>
<p>FREE Marmaris City Tour and MORE!</p>
<div class="rate">
<div class="clearfix padded_v">
                            <div class="fluid columns_nine zeroMargin_desktop">
							<small class="txt_color_1">Deals From</small><br>
                                <strong class="txt_xxtra_large txt_color_1">&euro;172</strong><small class="txt_color_1">pp</small>
                                                               
                            </div>
                            <div class="fluid columns_three">
                                <a href="#" class="button">GO <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
                            </div>
                        </div>

</div>
</div>
</div>


<div class="col-sm-6">
<div class="green_nature">
<div class="image"><img src="<?php echo base_url();?>images//img04.jpg" class="img-responsive">

<div class="mini_img"><img src="<?php echo base_url();?>images//tree.jpg"> 

</div>
</div>
<h2>Green Nature Diamond</h2>
<h3>Luxury Turkey! | FREE Room Upgrade</h3>
<p>FREE Marmaris City Tour and MORE!</p>
<div class="rate">
<div class="clearfix padded_v">
                            <div class="fluid columns_nine zeroMargin_desktop">
							<small class="txt_color_1">Deals From</small><br>
                                <strong class="txt_xxtra_large txt_color_1">&euro;172</strong><small class="txt_color_1">pp</small>
                                                               
                            </div>
                            <div class="fluid columns_three">
                                <a href="#" class="button">GO <i aria-hidden="true" class="icon-arrow-circle-right"></i></a>
                            </div>
                        </div>

</div>
</div>


</div>

<div class="clearfix"></div>
<div class="see">
<h2>See All 10 Manager's Choice Deals</h2>
</div>


<div class="clearfix"></div>


</div>

</div>

<!--sidebar-->
    <div class="col-sm-3">
        <div class="left-sidebar">
     <?php include_once 'includes/atol_left.php';?>
	<?php include_once 'includes/news_letter_left.php';?>
	<div class="clearfix"></div>
	<?php include_once 'includes/independent_reviews_left.php';?>
	<div class="clearfix"></div>
	<?php include_once 'includes/deals_email_left.php';?>

</div>
</div>
<!--sidebar-->



</div><!--row-->
</div><!--contanier-->

<div id="bottom_content">
<div class="container">
<div  class="row">
<div class="col-sm-4">
<div class="deal_fender">

<h2>Not Sure Where to Go?</h2>
<h3>Compare destinations</h3>
<div class="deal_img"><img src="<?php echo base_url();?>images//img3.jpg" class="img-responsive fluid ad_animated">
<div class="image_matter">
<p>Deal Finder</p>
<h4>Compare Late Deals and destinations
for Your Dates</h4>
</div>
</div>

</div>
</div>



<div class="col-sm-4">
<div class="deal_fender">

<h2>Latest Offers</h2>
<h3>Grab a Great Holiday Bargain</h3>

<div class="deal_img"><img src="<?php echo base_url();?>images//img4.jpg" class="img-responsive">
<div class="image_matter">
<p style="">Giveaways</p>
<h4 style="">Stag & Hen, Summer picks
and more...</h4>
</div>
</div>

</div>
</div>


<div class="col-sm-4">
<div class="deal_fender">
<h2>Exotic Escapes</h2>
<h3>Inspired Worldwide & Luxury</h3>
<div class="deal_img"><img src="<?php echo base_url();?>images/img5.jpg" class="img-responsive">
<div class="image_matter">
<p>Tailorrd holidays</p>
<h4>to far flung luxury
destinations..</h4>
</div>
</div>

</div>
</div>


</div>

</div>
</div>


<div id="rooms_div" style="display: none;">
  <h2>Rooms - Persons</h2>
     <div>
        <h4 class="has_bottom_margin">Please share the members for each room.</h4>
	    	<form id="rooms_form">
	    	</form>
                      
     </div>     
</div>


