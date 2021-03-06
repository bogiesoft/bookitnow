<!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>Edit Luggage</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>admin/luggage_view">Luggage View</a></li>
        <li class="active">Edit Luggage</li>
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
		    		echo $this->session->flashdata('message');
		    		$attributes = array('name'=>'add_luggage','class'=>'form-horizontal');
					echo form_open(base_url().'admin/edit_luggage/'.$row[0]['id'], $attributes);					
				?>
				 	<div class="box-body">
						<div class="form-group">
						   <label for="focusedinput" class="col-sm-2 control-label">Airline Name</label>
						   <div class="col-sm-10">				   		
								<input type="text" class="form-control" name="airline_name" value="<?php echo $row[0]['airline_name'];?>">
							</div>									
						</div>	
						<div class="form-group">
						   <label for="focusedinput" class="col-sm-2 control-label">Airline Code</label>
						   <div class="col-sm-10">
								<input type="text" class="form-control" name="airline_code" value="<?php echo $row[0]['airline_code'];?>">
							</div>									
						</div>					
						<div class="form-group">
						   <label for="focusedinput" class="col-sm-2 control-label">Bag Weight</label>
						   <div class="col-sm-10">
								<input type="text" class="form-control" name="weight" value="<?php echo $row[0]['weight'];?>">
							</div>									
						</div>	
						<div class="form-group">
						   <label for="focusedinput" class="col-sm-2 control-label">Price per one bag</label>
						   <div class="col-sm-10">
								<input type="text" class="form-control" name="price" value="<?php echo $row[0]['price'];?>">
							</div>									
						</div>
						</div>
					<div class="box-footer">
						<a class="btn btn-default" href="<?php echo base_url();?>admin/luggage_view">Cancel</a>				 		
						<button class="btn btn-info pull-right" type="submit" >UPDATE</button>
					</div>      					
				<?php echo form_close();?>
			</div><!-- /.box -->             
        </div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section><!-- /.content -->	
