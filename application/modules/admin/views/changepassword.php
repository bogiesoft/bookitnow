<!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>Change Password</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>admin/profile">Profile</a></li>
        <li class="active">Changepassword</li>
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
    
    	<?php echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'admin_login');
			echo form_open(base_url().'admin/changepassword', $attributes);
		?>
	   
	 	<div class="form-group">
		    <label for="exampleInputPassword"> Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" >
		</div>
		<div class="form-group">
		    <label for="exampleInputPassword">Conform Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="confirm_password" >
		</div>
       
           
       </div>
      <div class="box-footer">
				 		<a class="btn btn-default" href="<?php echo base_url();?>admin/profile">Cancel</a>
				 		<button class="btn btn-info pull-right" type="submit" >ADD</button>
				 	</div>    					
				<?php echo form_close();?>	
           </div><!-- /.box -->             
        </div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section><!-- /.content -->
