 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<?php 
			echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'add_luggage','class'=>'form-horizontal');
			echo form_open(base_url().'admin/view_booking/'.$row[0]['id'], $attributes);
			
		?>
	
		 	<h4>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">First Name:</label>
				   <div class="col-sm-8">
				   <?php $adult_raw_info = json_decode($row[0]['adults_info'],true);
				   	foreach($adult_raw_info as $key => $adult_all){
				   		foreach ($adult_all as $adult)
				   		{
				   			echo $adult;
				   		}
				   	}
				   ?>
				   
				   				   		
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Last Name:</label>
				   <div class="col-sm-8">
						<?php $adult_raw_info = json_decode($row[0]['adults_info'],true);
				   	foreach($adult_raw_info as $key => $adult_all){
				   		foreach ($adult_all as $adult)
				   		{
				   			echo $adult;
				   		}
				   	}
				   ?>
					</div>
					</div>
					<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Date of Birth:</label>
				   <div class="col-sm-8">
						<?php $adult_raw_info = json_decode($row[0]['adults_info'],true);
				   	foreach($adult_raw_info as $key => $adult_all){
				   		foreach ($adult_all as $adult)
				   		{
				   			echo $adult;
				   		}
				   	}
				   ?>
					</div>									
				</div>					
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Email:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Mobile:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>
				
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Address:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">City/Country:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Postcode:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Card Type:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Card Number:</label>
				   <div class="col-sm-8">
						
					</div>									
				</div>			
				    <?php echo form_close();?>   					
