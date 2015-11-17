<div class="get">
<h2>GET OUR NEWS LETTER  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><img src="<?php echo base_url();?>images/mail.png" class=""></span></h2>
	<?php 
    		echo $this->session->flashdata('message_sub');
    		$attributes = array('name'=>'sub_news','onClick' => 'return subscribe(this);' );
			echo form_open(base_url().'welcome/subscribe', $attributes);
		?>
  <div class="form-group">
      <label for="" class="get_name">First Name</label>
      <input type="text" class="form-control"  placeholder="First Name" name="fname" >
       <?php echo form_error('fname'); ?> 
    </div>
    <div class="form-group">
      <label for=""  class="get_name">Last Name</label>
      <input type="text" class="form-control"  placeholder="Last Name" name="lname" >
       <?php echo form_error('lname'); ?> 
    </div>
    
    <div class="form-group">
      <label for=""  class="get_name">Zip code</label>
      <input type="text" class="form-control"  placeholder="zip code" name = "zipcode" >
       <?php echo form_error('zipcode'); ?> 
    </div>
    
    <div class="form-group">
      <label for=""  class="get_name">Email</label>
      <input type="text" class="form-control"  placeholder="email" name="email" >
       <?php echo form_error('email'); ?> 
    </div>
  
   <input class="subcribe" type="submit" value="Subscribe"/>
   <?php echo form_close();?>
</div>
   <script type="text/javascript">
		function subscribe(e)
		{
			var postdata = $(e).serializeArray();   
		
			$.post("/welcome/subscribe",postdata,function(data){        		
				if(data.errors != '')
				{
					$('div.error').remove();
					$.each(data.errors, function(index, value){
					
						$(e).find('input[name="'+index+'"]').after(value);
						$('.error').css('color','red');
					});
				}
				else
				{
					console.log(data.success);
					alert(data.success);
				}
				return false;
			}, "json");  
			return false;
		}
</script>
       