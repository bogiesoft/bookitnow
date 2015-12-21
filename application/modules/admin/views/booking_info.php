<!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Bookings <small>Customer Bookings</small> </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Bookings</li>
      </ol>
   </section>
      <!-- Main content -->
   <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <!-- /.box -->
          <div class="box" >           
           <div class="box-body">
 		   <?php 
  				echo $this->session->flashdata('message');
  			?>
		   <table class="table table-bordered">
		        <thead>
		          <tr>
		            <th>#</th>
		            <th>First Name</th>
		            <th>Last Name</th>
		            <th>Email</th>
		            <th>Mobile</th>
		            <th>Action</th>            
		          </tr>
		        </thead>
		        <tbody>
		          <?php 
		          $count=0;
		          	foreach ($rows as $sno => $row)
		          	{
		          		$adult_raw_info = json_decode($row['adults_info']);      
		          		echo '<tr>';
		          		echo  '<td scope="row">'.($sno+1).'</th>';          		
		          		echo  '<td scope="row">'.$adult_raw_info->fname[0].'</td>';          		
		          		echo  '<td scope="row">'.$adult_raw_info->lname[0].'</td>';
		          		echo  '<td scope="row">'.$row['email'].'</td>';
		          		echo  '<td scope="row">'.$row['mobile'].'</td>';
		          		echo  '<td scope="row"><a href="'.base_url().'admin/view_booking/'.$row['reference_id'].'"><i class="fa fa-eye" title="view"></i></a></td>';
		          		echo '</tr>';
		          		$count++;
		          	}
		          	if(!$count){
		          		echo '<tr>';
		          		echo '<th colspan=6> No records</th>';
		          		echo '</tr>';
		          	}
		          		
		          ?>          
		        </tbody>
		      </table>
		      </div><!-- /.box-body -->
		   </div><!-- /.box -->
		 </div><!-- /.col -->
	  </div><!-- /.row -->
    </section><!-- /.content -->

    