<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			 <title><?php echo $title_for_layout ?></title>
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			 <?php echo @$this->layouts->print_includes()['css']; ?> 
</head> 
<body> 
<div id="top_header">
  <div  class="container">
    <div class="left"> <a href="<?php echo base_url();?>price_promise" class="">Price Promise</a> <a href="<?php echo base_url();?>aboutus">About Us</a> <a href="<?php echo base_url();?>terms_of_use">Terms of Use</a> <a href="http://blogofbookitnow.expertwebworx.in/" target="_blank">Blog</a> </div>
  </div>
</div>
<div class="clearfix"></div>
<div id="header">
  <div class="container">
    <div class="col-sm-3">
      <div class="logo"><a href="/"><img src="<?php echo base_url();?>images/logo.png" class="img-responsive"></a></div>
    </div>
    <div class="col-sm-3">
      <div class="logo"><a href="#">
        <p>Book With Confidence</p>
        <img src="<?php echo base_url();?>images/abta.png" class="img-responsive"> </a></div>
    </div>
    <div class="col-sm-6">
      <div class="phonenumbers">
        <h2><i class="fa fa-phone"></i> 0138 629 8033</h2>
        <p>Mon-Fri: 8am - 11pm | Sat: 9am -10pm | Sun: 10am - 10pm</p>
        <p class="call">Call Our Local Rate Num :  203 598 4710 | Mon- Sat 9am - 5pm</p>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div id="menus">
<div class="container">
  <nav class="navbar navbar-inverse">
    <div class="navbar-header">
    	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
			<li class="dropdown mega-dropdown">
			 <li><a href="#">HOME</a></li>	
								
			</li>
            <li class="dropdown mega-dropdown">
    			<a href="#" class="dropdown-toggle"> DESTINATIONS <span class="caret"></span></a>				
				<ul class="dropdown-menu mega-dropdown-menu">
						<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
						<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
					<li class="col-sm-3">
						<ul>
							<li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
							<li><a href="#">Calls to action</a></li>
							<li><a href="#">Custom Fonts</a></li>
							<li><a href="#">Slide down on Hover</a></li>                         
						</ul>
					</li>
                 
				</ul>				
			</li>
            <li><a href="#">SPECIAL OFFERS</a></li>
			 <li><a href="#">HOTEL ONLY</a></li>
			  <li><a href="#">CITY BREAKS</a></li>
			   <li><a href="#">CONTACT US</a></li>
			
			  
		
		</ul>
   <div class="view"><a href="#" title="view my booking">View My Booking</a></div>
	</div><!-- /.nav-collapse -->
  </nav>
</div>

</div>


<div class="clearfix"></div>

  <?php echo $content_for_layout; ?> 
  
  <div class="clearfix"></div>



<div class="container">
      <div class="row mar-b-50 our-clients">
        <div class="col-md-3">
         <div class="great">
<h2>Great</h2>
<div class="stars"><img src="<?php echo base_url();?>images/5star.jpg"  class=""></div>
<p>
Based on 639 reviews
See some of the reviews here. </p>
<p> <i class="fa fa-check-square"></i>
Trustpilot </p>

</div>
        </div>
        <div class="col-md-9">
          <div class="outside">
            <p>
              <span id="slider-prev">
              </span>
              |
              <span id="slider-next">
              </span>
            </p>
          </div>

          <ul class="bxslider1 clients-list">
            <li>
        
             <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything  </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>
            <li>
           
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything  </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>
            
            <li>
         
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything  </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>
            <li>
           
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>
      
            <li>
                
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>


            </li>
            <li>
               
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything  </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>
            <li>
                
              <div class="every">
<div  class="every_star"><img src="<?php echo base_url();?>images/greenstars.jpg" class=""></div>
<h2>Everything </h2>
<p>Very simple process to book. No problems encountered. Everything was completed and delivered very qu... </p>
</div>

            </li>

          </ul>


        </div>
      </div>
      <!-- END CLIENTS -->
    </div>




<div class="bottom_container2">
<div class="container">
<div class="row">
<div class="col-sm-4">
<div  class="super">
<p>Super Escapes Travel
Unit 1 Finway, Dallow Road,
Luton, LU1 1WE</p>

</div>
</div>



<div class="col-sm-4">
<div  class="super">
<p>Follow Us On</p>
<ul>
<li><i class="fa fa-facebook"></i></li>
<li><i class="fa fa-twitter"></i></li>
<li><i class="fa fa-youtube"></i>
</li>

</ul>

</div>
</div>



<div class="col-sm-4">
<div  class="super">
<ul>
<li> <a href="#"><img src="<?php echo base_url();?>images/visa.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url();?>images/visa_electron.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url();?>images/mastercard.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url();?>images/masteo.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url();?>images/amercan.jpg"></a></li>
<li><a href="#"><img src="<?php echo base_url();?>images/paypal.jpg"></a></li>


</ul>
</div>
</div>




</div>
</div>


</div>









</div>

<div class="clearfix"></div>
<div id="footer">
<div class="container">
<div class="row">
<div class="col-sm-4">
<div class="top_beach">
<h2>On This Site</h2>
<ul>
<li><a href="#">Book A Holiday</a></li>
<li><a href="#">Special Offers</a></li>
<li><a href="#">Hotel Only</a></li>
<li><a href="#">City Breaks</a></li>
<li><a href="#">Insurance</a></li>
<li><a href="#">Deals By Email</a></li>

</ul>
<ul class="second">
<li><a href="<?php echo base_url();?>aboutus">About Us</a></li>
<li><a href="<?php echo base_url();?>welcome/contactUs">Contact Us</a></li>
<li><a href="<?php echo base_url();?>terms_of_use">Terms Of Use</a></li>
<li><a href="<?php echo base_url();?>price_promise">Privacy Promise</a></li>
<li><a href="#">Website Terms And Conditions</a></li>

</ul>
</div>

</div>


<div class="col-sm-4">
<div class="top_beach">
<h2>Top Beach Holidays</h2>
<ul>
<li><a href="#">The Algarve</a></li>
<li><a href="#">Benidorm</a></li>
<li><a href="#">Costa Brava</a></li>
<li><a href="#">Corfu</a></li>
<li><a href="#">Crete</a></li>
<li><a href="#">Cyprus</a></li>
<li><a href="#">Egypt</a></li>

</ul>
<ul class="third">
<li><a href="#">Fuerteventura</a></li>
<li><a href="#">Gran Canaria</a></li>
<li><a href="#">Greece</a></li>
<li><a href="#">Kos</a></li>
<li><a href="#">Lanzarote</a></li>
<li><a href="#">Majorca</a></li>
<li><a href="#">Malta</a></li>


</ul>
<ul class="third">

<li><a href="#">Morocco</a></li>
<li><a href="#">Rhodes</a></li>
<li><a href="#">Sharm El Sheikh</a></li>
<li><a href="#">Tenerife</a></li>
<li><a href="#">Tunisia</a></li>
<li><a href="#">Turkey</a></li>


</ul>
</div>

</div>




<div class="col-sm-4">
<div class="top_beach">
<h2>What We Sell</h2>
<ul>
<li><a href="<?php echo base_url().'welcome/cheapHolidays'?>">Cheap Holidays</a></li>
<li><a href="<?php echo base_url().'welcome/allinclusiveholidays'?>">All Inclusuve Holidays</a></li>
<li><a href="<?php echo base_url().'welcome/lastminuteholidays'?>">Last Minute Holidays</a></li>
<li><a href="#">Family Holidays</a></li>
<li><a href="<?php echo base_url().'welcome/summerholidays'?>">Summer Holidays</a></li>
<li><a href="#">Summer 2015 Holidays</a></li>

</ul>
<ul class="four">
	<li><a href="<?php echo base_url().'welcome/winterholidays'?>">Winter Holidays</a></li>
	<li><a href="#">Bargain Holidays</a></li>
	<li><a href="#">Beach Holidays</a></li>
	<li><a href="#">Low Deposit Holidays</a></li>
	<li><a href="#">Luxury Holidays</a></li>
</ul>
</div>

</div>



</div>
</div>

<p class="all">All Inclusive Holidays | Adults Only Holidays | Family Holidays</p>


</div>

<div class="container">
<p class="privacy">
At Superescapes we endeavour not just to provide great value cheap holidays but also to make sure that you get your perfect dream holiday at
 the cheapest price. We offer a wide range of holidays, including cheap holidays, All Inclusive holidays, Last Minute holidays, City Breaks 
 and more. We render our dedicated services to help you find, compare and choose best cheap holiday deals and escape to your exotic holiday 
 destination.

Whether it is Majorca, Spain, Turkey, Egypt or any other favourite destination of your choice, you can search for your perfect holiday
 at Superescapes.

We assure you that your holidays are fully protected, as we are members of ABTA and ATOL, so go ahead, book with confidence, and leave all your travel worries to us.
</p>

</div>

<div id="bottom_footer">
<div class="container">
<p class="privacy" style="float:left;">&copy; 2015 Book it now</p>
<a href="#" style="float:right;color:#6c6c6c; font-size:12px;">Powered by: emerchantdigital</a>

</div>

</div>
<div class="top"> <a href="#" class="scrollToTop"></a> </div>
  
  <!-- ClickDesk Live Chat Service for websites--><!-- <script type='text/javascript'>var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDwsSBXVzZXJzGMupgogNDA');var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 'http://my.clickdesk.com/clickdesk-ui/browser/');var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);</script>--><!-- End of ClickDesk -->
</body> 
<?php echo @$this->layouts->print_includes()['js']; ?> 

</html>
<<style>
<!--
.dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0; // remove the gap so it doesn't close
 }
-->
</style>
