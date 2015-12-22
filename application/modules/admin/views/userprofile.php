<!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> UserProfile <small>UserProfileEdit</small> </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">UserProfile</li>
      </ol>
   </section>
      <!-- Main content -->
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
					echo form_open(base_url().'admin/userprofile', $attributes);
				?>
				<div class="box-body">
				    <div class="form-group">	    	
				    	<label for="exampleInputEmail1">firstName</label>
				    	<input  class="form-control" id="exampleInputfirst_name" name="first_name" placeholder="first_name" required value="<?php echo $rows[0]['first_name']?>">
				 	</div>
				 	<div class="form-group">
					    <label for="exampleInputPassword">LastName</label>
					    <input  class="form-control" id="exampleInputLast_name" placeholder="last_name" name="last_name" required value="<?php echo $rows[0]['last_name']?>">
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword">Email</label>
					    <input type="email" class="form-control" id="exampleInputEmail" placeholder="email" name="email" required value="<?php echo $rows[0]['email']?>">
					</div>
					
					<div class="form-group">
					    <label for="exampleInputPassword">HomeTelephone</label>
					    <input  class="form-control" id="exampleInputHome_telephone" placeholder="home_telephone" name="home_telephone" required value="<?php echo $rows[0]['home_telephone']?>">
					</div>
					
					<div class="form-group">
					    <label for="exampleInputPassword">Mobile</label>
					    <input  class="form-control" id="exampleInputMobile" placeholder="mobile" name="mobile" required value="<?php echo $rows[0]['mobile']?>">
					</div>
					<div class="form-group">
					    <label for="exampleInputPassword">Address</label>
					    <input  class="form-control" id="exampleaddressAddress" placeholder="address" name="address" required value="<?php echo $rows[0]['address']?>">
					</div>
		       </div>
		        <div class="box-footer">
		        	<a  class="btn btn-default" href="<?php echo base_url();?>admin/profile">cancel</a>    
		        	<button type="submit" class="btn btn-info pull-right"  >Save</button>        </div>     
		       </div>
		       <?php echo form_close();?>
       			</div><!-- /.box-body -->
		   </div><!-- /.box -->
		 </div><!-- /.col -->
	  </div><!-- /.row -->
    </section><!-- /.content -->


