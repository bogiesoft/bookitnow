 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<?php 
			echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'add_luggage','class'=>'form-horizontal');
			echo form_open(base_url().'admin/add_luggage', $attributes);
		?>
	
		 	<h4>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Airline Name</label>
				   <div class="col-sm-8">				   		
						<input type="text" class="form-control1" name="airline_name">
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Airline Code</label>
				   <div class="col-sm-8">
						<input type="text" class="form-control1" name="airline_code">
					</div>									
				</div>					
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Bag Weight</label>
				   <div class="col-sm-8">
						<input type="text" class="form-control1" name="weight">
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Price per one bag</label>
				   <div class="col-sm-8">
						<input type="text" class="form-control1" name="price">
					</div>									
				</div>		
				 <div class="reg-bwn"><button class="btn btn-primary" type="submit" >ADD</button></div>      					
			<?php echo form_close();?>	
