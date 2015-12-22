<section class="content">
    <div class="row">
        <div class="col-xs-12">
        <!-- /.box -->
          <div class="box" >           
           <div class="box-body">
 		   <?php 
  				echo $this->session->flashdata('message');
  			?>
		  
		         <div class="panel-body">
                          <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../images/user.png" class="img-circle img-responsive"> </div>
                            <div class=" col-md-9 col-lg-9 ">
                              <table class="table table-user-information">
								<tbody>
								  <tr>
									<td>First Name:</td>
									<td> <?php echo $rows[0]['first_name']?></td>
								  </tr>
								  <tr>
									<td>Last Name:</td>
									<td><?php echo $rows[0]['last_name']?></td>
								  </tr>
								   <tr>
									<td>Email:</td>
									<td><?php echo $rows[0]['email']?></td>
								  </tr>
								  
								  <tr>
									<td>Home Teliphone</td>
									<td><?php echo $rows[0]['home_telephone']?></td>
								  </tr>
								  <tr>
									<td>Mobile No</td>
									<td><?php echo $rows[0]['mobile']?></td>
								  </tr>
								   <tr>
									<td>Address</td>
									<td><?php echo $rows[0]['address']?></td>
								  </tr>
								  
								 
								</tbody>
							  </table>
							  <div class="box-footer">
				 		<a class="btn btn-default " href="<?php echo base_url();?>admin/userprofile">Edit</a>
				 		<a class="btn btn-default pull-right" href="<?php echo base_url();?>admin/changepassword">changepassword</a>
				 	</div>  
                            </div>
                          </div>
                        </div>
		      </div><!-- /.box-body -->
		   </div><!-- /.box -->
		 </div><!-- /.col -->
	  </div><!-- /.row -->
    </section><!-- /.content -->

    
