
    <div class="clearfix"></div>
   


<div id="body_content">
	<div class="container">
		
<div class="clearfix"></div>
<!--meena--adit-->
<div class="container">
	<div class="row"> 
		<div class="col-sm-9">
				<div class="right_side bg-cl">
					<h3 class="view-booking">View Booking </h3>
					<h4 class="small-view">Log In With Your Booking Details to View. </h4>
					<!-- <h5 class="red-text">Please allow a minimum of 48 hours after you make your booking before attempting to log in.</h5> -->				
				</div>
				<?php 
					echo $this->session->flashdata('message');
					$attributes = array('name'=>'viewbookingform');
					echo form_open(base_url().'managebookinglogin', $attributes);
				?>
					
				
					<div class="right_side bg-cl">
						<h4 class="b-refer">Booking Reference: </h4>
						<h4 class="small-view">The reference number you recieved in your confirmation </h4>
							<input name="reference_id" type="text" value="<?php echo set_value('reference_id'); ?>">
							<?php echo form_error('reference_id', '<div class="error">', '</div>'); ?>		
					</div>
					
					<div class="right_side bg-cl">
						<h4 class="b-refer">Surname: </h4>
						<h4 class="small-view">The Surname you submitted when making your booking [Must be lead passengers surname] </h4>
							<input name="lname" type="text" value="<?php echo set_value('lname'); ?>">		
							<?php echo form_error('lname', '<div class="error">', '</div>'); ?>
					</div>
					<div class="right_side bg-cl">
						<h4 class="b-refer">Email Address: </h4>
						<h4 class="small-view">The email you submitted when making your booking</h4>
							<input name="email" type="text" value="<?php echo set_value('email'); ?>">		
							<?php echo form_error('email', '<div class="error">', '</div>'); ?>
					</div>
					<div><br>
						<button type="submit" class="button txt_large" >LOGIN &amp; VIEW BOOKING <i aria-hidden="true" class="icon-arrow-circle-right"></i></button>
					</div>
					 <?php echo form_close();?>
		</div>
<!--sidebar-->
    <div class="col-sm-3">
        <div class="right-sidebar-col">
			<div class="superescapes">
			<h2>Why Super Escapes Travel?</h2>			
			</div><br>
			<div class="every-b"><h2>Have a question about an existing booking?</h2></div>
			<div class="every-b"><h2><b>Customer Support</b><h2></div>
			<div class="every-b"><h2><b>After Sales:</b> 0208 548 3057<h2></div>
			<div class="every-b"><h2>Balances & Passports:0208 548 3064<h2></div>
			<div class="every-b"><h2><b>FAX:</b> 0871 472 7798<h2></div>
			<div class="every-b"><h2><b>Email:</b> aftersales@a1travel.com<h2></div>
			<div class="every-b"><h2><b>Hours Of Business:</b><h2></div>
			<div class="every-b"><h2><b>Mon- Fri:</b> 9am to 5.30pm <b>Sat:</b> 9am to 5.00pm <b>Sun:</b> CLOSED <h2></div>
		</div>
		
		
		 <div class="right-sidebar-col">
			<div class="superescapes">
				<h2>In-Resort Emergencies Only</h2>			
			</div><br>
			<div class="every-b"><h2>If you are in resort and have an emergency out of<br><br><b> Office hours:</b><b> 07935 059 938</b></h2></div>
			<div class="every-b"><h2>This Number is NOT available during office hours.</div>
		</div>
		
		 <div class="right-sidebar-col">
			<div class="superescapes">
				<h2>Write to Us</h2>			
			</div><br>
			<div class="every-b"><h2><b>a1travel.com</b></h2></div>
			<div class="every-b"><h2>516 High Road</br>
			<br>Iflord, Essex </br>
			<br>IG3 8EG  </br>
			</div>
		</div>
	</div>
<!--sidebar-->
	</div>

	<br><br>

</div>

<!--meena adit closed-->
</div>
</div><!--contanier-->

    <div class="clearfix"></div>
<style>
body{
	color:#333 !important;
}
</style>
  

