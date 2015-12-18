
<div id="body_content">
<div class="container">

<div class="col-sm-9" style="padding-left:0px;">
<div class="about">
<div class="title"> Contact Us </div>
<div class="contactform">  

<div class="contactform">
                <strong>Already booked? Call our Customer Services Team &nbsp;@&nbsp;<span style="font-weight:bold; font-size:16px; color:Blue">0138 629 8003</span><br></strong>
                <br>
                Have you already made your booking but have a question or wish to make a payment?<br>
                Contact our Customer Services Team who will be happy to help!
                <table border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td>
                            Monday
                        </td>
                        <td>
                            09:00 - 18:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tuesday
                        </td>
                        <td>
                            09:00 - 18:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Wednesday
                        </td>
                        <td>
                            09:00 - 18:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Thursday
                        </td>
                        <td>
                            09:00 - 18:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Friday
                        </td>
                        <td>
                            09:00 - 18:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Saturday
                        </td>
                        <td>
                            09:00 - 17:00
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sunday
                        </td>
                        <td>
                            Closed
                        </td>
                    </tr>
                </tbody></table>
                <br>
                Calls to this number will be charged at local rate plus network extra. 
                <br>Call charges from a mobile may be more dependent on your mobile provider.<br>
                <br>
                <strong>Contact Details</strong><br>
                <span>General Queries : </span><a href="mailto:info@superescapes.co.uk">info@superescapes.co.uk</a><br>
                <span>Balance Payment : </span><a href="mailto:accounts@superescapes.co.uk">accounts@superescapes.co.uk</a><br>
                <span>Complaints : </span><a href="mailto:customer.relations@superescapes.co.uk">customer.relations@superescapes.co.uk</a><br>
                <br>
                <strong>Want to make a group booking or have any query before confirming the holiday : </strong><a href="mailto:customer.relations@superescapes.co.uk">customer.relations@superescapes.co.uk</a>
                <br><br>
                <span style="font-weight:bold; font-size:14px" ;="">Super Escapes Travel</span><br>
                Unit 1 Finway<br>
                Dallow Road<br>
                Luton<br>
                <strong>LU1 1WE</strong>
            </div>

<div class="contactform">
                Your Comments, Queries, Suggestions, let them flow. This is your space. It will
                help us in improving the website.
                <?php //echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'contactus');
			echo form_open(base_url().'welcome/contactUs', $attributes);
		?>
                <table cellpadding="2" cellspacing="2" border="0" width="100%">
                    <tbody><tr>
                        <td class="label" style="width: 20%">
                            Name<span class="manadatory">*</span>
                        </td>
                        <td style="width: 80%">
                            <input type="text" name="name" style="width: 350px" value="<?php echo set_value('name'); ?>">
                            <?php echo form_error('name'); ?>                           
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Email ID<span class="manadatory">*</span>
                        </td>
                        <td>
                            <input name="email" type="text" style="width: 350px"  value="<?php echo set_value('email'); ?>"> 
                             <?php echo form_error('email'); ?>                          
                        </td>
                    </tr>
                    <tr>
                        <td class="label" style="width: 20%">
                            Subject<span class="manadatory">*</span>
                        </td>
                        <td style="width: 80%">
                            <input name="subject" type="text"  style="width: 350px"  value="<?php echo set_value('subject'); ?>">
                             <?php echo form_error('subject'); ?>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="label" style="vertical-align: top; white-space: nowrap">
                            Comments/Suggestions<span class="manadatory">*</span>
                        </td>
                        <td>
                            <textarea name="comments" rows="2" cols="20" style="width: 350px; height: 75px;"> <?php echo set_value('comments'); ?></textarea>
                             <?php echo form_error('comments'); ?>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                        </td>
                        <td>
                            <input type="submit" value="Submit" class="button">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td id="ctl00_ContentPlaceHolder1_tdMsg" class="label">
                        </td>

                    </tr>
                </tbody></table>
                <?php echo form_close();?>
            </div>

        
    </div>


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

</div>
</div>
<<style>

.label{
	color:#333; 
}
td{
	padding: 5px;
	}

</style>
