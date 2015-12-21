<!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>Margins</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>admin/luggage_view">Margins</a></li>
        <li class="active">Add Luggage</li>
    </ol>
 </section>
 <section class="content" style="background:#fff;">
      <div class="row">           
      <!-- right column -->
         <div class="col-md-8 ">
          <!-- Horizontal Form -->
            <div class="box box-info ">
              <!-- /.box-header -->
                <!-- form start -->
		     	<?php 
					echo validation_errors(); 
		    		echo '<div class="alert">'.$this->session->flashdata('message').'</div>';
		    		$attributes = array('name'=>'margin_form','class'=>'form-horizontal');
					echo form_open(base_url().'admin/margins', $attributes);
				?>	
				<div class="box-body"> 	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Hotel Margin </label>
				   <div class="col-sm-10">				   		
				   		<?php if(!empty($opt_row)){$m = $opt_row[0]['hotel_rate'];				   				
				   		}
				   				else { $m = 0;}
				   		?>
						<input type="number" class="form-control" name="hotel_rate" value=<?php echo $m;?> />
					</div>									
				</div>	
				<div class="form-group">
				   <label for="focusedinput" class="col-sm-2 control-label">Flight Margin </label>
				   <div class="col-sm-10">				   		
				   		<?php if(!empty($opt_row)){$m = $opt_row[0]['flight_rate'];
				   				echo '<input type="hidden" name="id" value='.$opt_row[0]['id'].' >';
				   		}
				   				else { $m = 0;}
				   		?>
						<input type="number" class="form-control" name="flight_rate" value=<?php echo $m;?> />
					</div>									
				</div>
				</div>	
				<div class="box-footer">					
					<button class="btn btn-info pull-right" type="submit" >Save</button></div>   
				</div>   					
			<?php echo form_close();?>	
			</div><!-- /.box -->             
        </div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section><!-- /.content -->
