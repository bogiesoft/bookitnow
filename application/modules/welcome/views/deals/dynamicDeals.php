<div class="clearfix"></div>
<div  id="content1" style="width:100%; background:#f5f5f5;">
<div class="container">
  <div class="mamaison-wrap">
    <h2 class="txt_white">Mamaison Hotel Riverside, Prague City Special</h2>
     <span class="txt_color_3">42% OFF this Luxury 5-Star short break</span> 
  </div>
</div>
<div class="clearfix"></div>
<div class="container" style="padding-right:0px;">
  <div class="calendar_datails">
    <div class="col-sm-6">
      <div class="left_side">        
           <div class="icons"><!--icons-->
        
          <div class="stars"> <img class="" alt="" src="<?php echo base_url();?>images/star_3.png" class="img-responsive">
           </div>
           
          <div class="stars"> 
          <img class="" alt="" src="<?php echo base_url();?>images/tree-t.jpg" class="img-responsive">
           <img class="" alt="" src="<?php echo base_url();?>images/family-t.jpg" class="img-responsive"> 
           
           
            </div>
            
        </div><!--icons end-->
        
        <div class="clearfix"></div>
        
        <div>
          <h4 class="holiday-title-calen"><b>Mamaison Hotel Riverside Prague</b> </h4>
          <span class="book-title3"  >Prague City, Prague, Czech Republic</span>
           </div>
        <div class="clearfix"></div>
        
        
        <div class="left_side_slider"><!--slider--> 
        <div class="slier-bg-wrap">		
	    <div id="slideshow" class="fullscreen">
<div id="img-1" data-img-id="1" class="img-wrapper active" style="background-image: url('/images/slider/img1.jpg')" class="img-responsive"></div>
 <div id="img-2" data-img-id="2" class="img-wrapper" style="background-image: url('/images/slider/img2.jpg')" class="img-responsive" ></div>
<div id="img-3" data-img-id="3" class="img-wrapper" style="background-image: url('/images/slider/img3.jpg')" class="img-responsive" ></div>
<div id="img-4" data-img-id="4" class="img-wrapper" style="background-image: url('/images/slider/img4.jpg')" class="img-responsive" ></div>	
<div id="img-3" data-img-id="5" class="img-wrapper" style="background-image: url('/images/slider/img5.jpg')" class="img-responsive" ></div>
<div id="img-4" data-img-id="6" class="img-wrapper" style="background-image: url('/images/slider/img6.jpg')" class="img-responsive" ></div>
<div id="img-3" data-img-id="7" class="img-wrapper" style="background-image: url('/images/slider/img7.jpg')" class="img-responsive" ></div>
			
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
			    </div><!--thumbs-container bottom end-->
        
        
        
        
        
        
        
        
        
        </div><!--fullscreen end-->
        </div><!--slier-bg-wrap end-->
        
          
        </div> <!--slider end-->  
        
      </div> <!--left_side end--> 
      
      
    </div><!--col-sm-6 pull-left end-->
    
    <div class="col-sm-6">
      <div>
        <h4 class="holiday-title-calen2"><b>Book This Hotel</b> </h4>
      </div>
      <div class="bg_grey2 clearfix" style="border: none;">
        <div class="left padded center" style="background: #ddd; border-right: 1px solid #ccc;"> <strong>1</strong> </div>
        <div class="left padded"> <strong>Select Your Preferences &amp; Click a Date</strong> </div>
      </div>
      <div class="" style="">
        <div class="bg_1 clearfix padded txt_white">
          <form method="post" id="calendar_form">
          <div class="option type" style="display: inline-block; font-size: 11px;">
            <label style="color:#fff;">I'd Like to Book:</label>
            <br>
            <select name="book_type" onchange="generateLeastOffers();">
            	<?php foreach ($calendar['book_types'] as $key => $book_type){
            		echo '<option value="'.$key.'">'.$book_type.'</option>';
            	}?>
            </select>
          </div>
          <div class="option from" style="display: inline-block; font-size: 11px;">
            <label style="color:#fff;">Traveling From:</label>
            <br>
            <select name="fly_from" onchange="generateLeastOffers();">
            	<?php 
            	foreach($calendar['filtered_departures'] as $key => $val)
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
          <div class="option nights" style="display: inline-block; font-size: 11px;">
            <label style="color:#fff;">Nights:</label>
            <br>
            <select name="nights" onchange="generateLeastOffers();">
             <?php for($i=1;$i<=$calendar['nights_limit'];$i++){
             	echo '<option value="'.$i.'">'.$i.'</option>';
             }?>
            </select>
          </div>
          <div class="option month" style="display: inline-block; font-size: 11px;">
            <label style="color:#fff;">Month:</label>
            <br>
            <select name="month_cal" onchange="generateLeastOffers();" >
            	<?php foreach($calendar['months'] as $value => $desc)
            		{
            			echo '<option value="'.$value.'">'.$desc.'</option>';
            		}
            	?>            
            </select>
          </div> 
          </form>        
        </div>
        <div class="calendar padded drop_light bg_white"> 
          <!--GRIDVIEW-->
          <div> <span style="display:inline-block;border-width:0px;width:100%;"><span>
            <div class="clear clearfix grey">
              <div class="bg_1 padded txt_white" style="display: none;"> <strong style="text-transform: uppercase;"> <span id="cphContent_ucCalendarDeals_dlstCalendar_lblMonthYear">Feb 2016</span></strong> </div>
              <div class="calendar_span day-header">Mon</div>
              <div class="calendar_span day-header">Tue</div>
              <div class="calendar_span day-header">Wed</div>
              <div class="calendar_span day-header">Thu</div>
              <div class="calendar_span day-header">Fri</div>
              <div class="calendar_span day-header">Sat</div>
              <div class="calendar_span day-header">Sun</div>
              
              <br>
              <div id="dates_base">
              	<?php echo $calendar['datesInfo'];?>                     
            </div>
          </div>
          <!--GRIDVIEW--> 
        </div>
        <!--calendar padded drop_light bg_white end-->
        <div class="clearfix"></div>
        <div id="cphContent_divPriceGuideInfo"> <small>Hotel prices per person, per night. Guide only.<br>
          Flight &amp; Hotel Combination prices per person. Guide only. <br>
          Based on cheapest departure &amp; occupancy. Subject to supplier availability. </small> </div>
      </div>
      
      
    </div><!--col-sm-6 pullrirgt end-->
    
  </div><!--calendar_datails end---------> 
  
  
</div><!----contanier end------->
</div><!----contanet1 end------->

<div class="clearfix"></div>
<div id="body_content">
  <div class="container">
    <div class="clearfix"></div>
    <!--meena--adit-->
    <div class="container">
      <h2 class="side-heading">
      Mamaison Hotel Riverside Prague
      <h2>
      <div class="reviews-text">
        <p>Following a recent refurbishment, Malta's Topaz Hotel is a stylish and comfortable place to holiday in Bugibba. A ten minute walk will take guests to the sea front promenade, shops, bars, restaurants and nightlife in the centre of Bugibba and most of Malta's major towns are just a few miles away. </p>
        <p>The Topaz Hotel sits in the heart of the bustling seaside resort of Bugibba, situated at the northern end of Malta Island. It is well placed for easy access to the various delights of the island, ten minute walk to the seafront, five minutes to the local entertainment and shopping and just 800 metres to the main centre of town. This hotel offers an All Inclusive concept and is geared up for all types of visitors including family groups, with a variety of dining, relaxation and entertainment options. Book into the Topaz Hotel and you'll be spoilt for choice! </p>
        <p>The Topaz Hotel could seriously add inches to your waistline so; make good use of the pools and the sports options too! Food, drink and entertainment: The Emerald Restaurant, La Perla Pizzeria (evenings only), the Beryl Pool Snack Bar, the Peacock Lounge (live entertainment most evenings) and The Royal Oak (a traditional English Pub). Also an Animation Team offers entertainment and activities. Varied dining facilities are available from the Table d'Hote menu in the main restaurant to the snacks at the poolside bar or, if you're feeling homesick, why not enjoy a beer in The Royal Oak, a traditional English style pub.</p>
        <p>For the kids: Children's paddling area in the swimming pool and a Kids Club during summer months with an Animation Team to keep them busy. </p>
        <p>Additional: 24 hour Front Desk, house-keeping, chargeable internet area, a 250 seat banqueting hall, hairdressing salon, souvenir shop, and a small library. </p>
        <p>The hotel has a wide variety of sport and leisure facilities including a large swimming pool and sun terrace, an indoor pool (from November to June), a sauna, a Jacuzzi and a games room for children. </p>
        <p>All 258 of the Topaz Hotel's guest rooms are beautifully decorated and fully furnished, most have a balcony and great views. The guest accommodation at the Topaz Hotel offers a Studio with inland views and a Twin Room with a pool or inland view, featuring full air-conditioning with individual temperature control, ensuite bathroom, euro-satellite TV, direct dial telephone, radio, safe for hire, hair dryer and some rooms have a balcony.</p>
        <h3 class="side-heading">
        Similar 5 Star Hotels
        <h3>
      </div>
      <div class="col-sm-3 col-mg-4">
        <div class="green_nature">
          <div class="title-deal">
            <div class="img-wrap-bg">
              <h2><a href="#">Hotel Hoffmeister and Spa</a></h2>
            </div>
          </div>
          <div class="zoom-effect-container">
            <div class="image-card"> <img src="<?php echo base_url();?>images/tene-img-12.jpg" class="img-responsive" alt="Pool"> </div>
            <p><b>7 Night</b> Holidays From </p>
            <div class="txt_xxtra_large-1"> <strong class="txt_xxtra_large-1 txt_color_1">£230<small class="txt_color_1">pp</small></strong> </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-mg-3">
        <div class="green_nature">
          <div class="title-deal">
            <div class="img-wrap-bg">
              <h2><a href="#">Jalta Hotel</a></h2>
            </div>
          </div>
          <div class="zoom-effect-container">
            <div class="image-card"> <img src="<?php echo base_url();?>images/tene-img-11.jpg" class="img-responsive" alt="Pool"> </div>
            <p><b>7 Night </b>Holidays From </p>
            <div class="txt_xxtra_large-1"> <strong class="txt_xxtra_large-1 txt_color_1">£140<small class="txt_color_1">pp</small></strong> </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-mg-3">
        <div class="green_nature">
          <div class="title-deal">
            <div class="img-wrap-bg">
              <h2><a href="#">Hilton Prague</a></h2>
            </div>
          </div>
          <div class="zoom-effect-container">
            <div class="image-card"> <img src="<?php echo base_url();?>images/tene-img-10.jpg" class="img-responsive" alt="Pool"> </div>
            <p><b>7 Night</b> Holidays From </p>
            <div class="txt_xxtra_large-1"> <strong class="txt_xxtra_large-1 txt_color_1">£147<small class="txt_color_1">pp</small></strong> </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3 col-mg-3">
        <div class="green_nature">
          <div class="title-deal">
            <div class="img-wrap-bg">
              <h2><a href="#">Sliema</a></h2>
            </div>
          </div>
          <div class="zoom-effect-container">
            <div class="image-card"> <img src="<?php echo base_url();?>images/tene-img-9.jpg" class="img-responsive" alt="Pool"> </div>
            <p><b>7 Night </b>Holidays From </p>
            <div class="txt_xxtra_large-1"> <strong class="txt_xxtra_large-1 txt_color_1">£167<small class="txt_color_1">pp</small></strong> </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--meena adit closed--> 
  </div>
</div>
<!--contanier-->

<div class="clearfix"></div>

<link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet' type='text/css'>
<style>
small {
    font-size: 89%!important;
}
body {
 margin: auto;
 padding: 0px;
 //*font-family: 'Open Sans', sans-serif;*//
 background-color: #fff;
}

</style>