 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<?php 
			echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'margin_form','class'=>'form-horizontal');
			echo form_open(base_url().'admin/margins', $attributes);
		?>
	
		 	<h4>
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Hotel Margin </label>
				   <div class="col-sm-8">				   		
				   		<?php if(!empty($opt_row)){$m = $opt_row[0]['hotel_rate'];				   				
				   		}
				   				else { $m = 0;}
				   		?>
						<input type="number" class="form-control1" name="hotel_rate" value=<?php echo $m;?> />
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Flight Margin </label>
				   <div class="col-sm-8">				   		
				   		<?php if(!empty($opt_row)){$m = $opt_row[0]['flight_rate'];
				   				echo '<input type="hidden" name="id" value='.$opt_row[0]['id'].' >';
				   		}
				   				else { $m = 0;}
				   		?>
						<input type="number" class="form-control1" name="flight_rate" value=<?php echo $m;?> />
					</div>									
				</div>	
				<div class="reg-bwn"><button class="btn btn-primary" type="submit" >ADD</button></div>      					
			<?php echo form_close();?>	
