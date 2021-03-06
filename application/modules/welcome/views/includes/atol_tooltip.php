<div class="atol_info clearfix" style="display: none;">
	 <div class="clearfix has_bottom_margin hide_mobile hide_tablet">
           <h4 class="left ">Atol Protection</h4>
               <a class="right toggle_atol" style="float:right;"><small>close</small></a>
     </div>
	 <div style="clear: both;">
        <p class="hide_mobile hide_tablet">
             <strong>With A1 Travel your holiday is protected!</strong><br>
               A1Travel hold ATOL license 5287 and we are full ABTA members.
       </p>
	   <small>
         <p>
             All of our Flight Plus Holidays are financially protected by the ATOL scheme.<br>
             A Flight Plus Holiday is where you purchase through us, at the same time or within a day of each other, a flight plus overseas accommodation and / or car hire from separate Travel Suppliers and as separate bookings (i.e. not a package holiday)
         </p>
         <p>
           On all Flight Plus Holiday bookings, your money is ATOL protected. This means you will be able to continue with your holiday or suitable alternative holiday (at no extra cost) or receive a refund of the amount paid to us in the unlikely event of our insolvency or the insolvency of one or more of your service Travel Suppliers
         </p>
		 <p> When you book with us, we will send you an ATOL confirmation invoice that provides you with all the information you will need about your ATOL protection
          </p>
       </small>
     </div>
 </div>
 
 
                                    
<div id="quickQuote"  style="display: none; max-width: 480px;">
     <div>
		<div >
             <div id="saveforlater" class="center padded bg_grey">
                   <div class="sprite logo has_bottom_margin"></div>
                   <h3>
                      <strong>Save For Later</strong>
                   </h3>
                   <h5 class="has_bottom_margin">Save your selections to your email, along with a quick-search link that will allow
                    you to check this trip again, directly from your inbox.</h5>
             <div>
             <form action="<?php echo base_url();?>" onsubmit="return confirmValidate(this)">
             <label>Title</label><br>
             <select name="title" style="display: inline-block; width: auto;" title="Title">
				<option value="Mr">Mr</option>
				<option value="Mrs">Mrs</option>
				<option value="Miss">Miss</option>
			</select>
		</div>
        <div>
           <label> First Name</label><br>
           <input name="fname" type="text" title="First Name">
        </div>
         <div>
            <label> Last Name</label><br>
            <input name="lname" type="text" title="Last Name">
         </div>
          <div>
             <label> Email Address</label><br>
                   <input name="email" type="text"  title="Email">
          </div>
          
          <div>
             <label>Subscribe to Our Newsletter</label><br>
              <input type="checkbox" style="display: block !important;position: static;opacity: initial;" name="subscribe" checked="checked" title="Subscribe">
          </div>
           <input type="hidden" name="segment" value="<?php echo @$this->uri->segment(2);?>" />
          <button type="submit" class="button" >SAVE &amp; SEND QUOTE <i aria-hidden="true" class="icon-envelope"></i></a>
         
         </div>
       </div>
       
	</div>
</div>


<div id="cphContent_divQuoteSent" style="display:none;">
	<h3 class="padded bg_1 txt_white">Thank You</h3>
	<h5 class="bg_2 txt_white padded has_bottom_margin">Details have been emailed to you</h5>
	<small>
		You may instantly check avaiability and price for this trip at any time by clicking the link provided in your email.<br>
        Please note that prices are subject to supplier availability and are subject to change.
     </small><br><br>
     <a class="button save-for-later" id="button" name="button" onclick="$.fancybox.close();">CLOSE THIS WINDOW &nbsp;<i aria-hidden="true" class="icon-envelope"></i></a>
</div>

<div id="success_book" style="display:none;">
	<h3 class="padded bg_1 txt_white">Thank You</h3>
	<h4 class="">Your booking reference id sent to your email.</h4>
	<small>
		You are successfully booked.we will contact you soon.
    </small><br><br>
     <a class="button save-for-later" id="button" name="button" href="<?php echo base_url();?>">CLOSE THIS WINDOW &nbsp;<i aria-hidden="true" class="icon-envelope"></i></a>
</div>

<div id="failure_book" style="display:none;">
	<h3 class="padded bg_1 txt_white">Sorry</h3>
	<h4 class="">We are unable to process your request.</h4>
	<small>
		Please contact book it now admin.
    </small><br><br>
     <a class="button save-for-later" id="button" name="button" href="<?php echo base_url();?>">CLOSE THIS WINDOW &nbsp;<i aria-hidden="true" class="icon-envelope"></i></a>
</div>