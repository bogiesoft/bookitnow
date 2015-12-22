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
		   <table class="table table-bordered table-striped">
		        <thead>
		          <tr>
		            <th>#</th>
		            <th>fly_from</th>
		            <th>travel_to</th>
		            <th>Date_of_departure</th>
		            <th>check_in_date</th>
		            <th>number_of_nights</th> 
		            <th>rooms</th>
		            <th>Adults</th>
		            <th>Children</th>
		            <th>Name</th>
		            <th>email</th>      
		             <th>mobile</th>    
		              <th>comments</th>         
		          </tr>
		        </thead>
		        <tbody>
		          <?php 
		          $count=0;
		          	foreach ($rows as $sno => $row)
		          	{
		          		$adult_raw_info = json_decode($row['Adults']);      
		          		echo '<tr>';
		          		echo  '<td scope="row">'.($sno+1).'</th>';          		
		          		echo  '<td scope="row">'.$row['fly_from'].'</td>';          		
		          		echo  '<td scope="row">'.$row['travel_to'].'</td>';
		          		echo  '<td scope="row">'.$row['Date_of_departure'].'</td>';
		          		echo  '<td scope="row">'.$row['check_in_date'].'</td>';		          		
		          		echo  '<td scope="row">'.$row['number_of_nights'].'</td>';
		          		echo  '<td scope="row">'.$row['rooms'].'</td>';
		          		echo  '<td scope="row">'.$row['Adults'].'</td>';
		          		echo  '<td scope="row">'.$row['Children'].'</td>';
		          		echo  '<td scope="row">'.$row['first_name'].'</td>';
		          		echo  '<td scope="row">'.$row['email'].'</td>';		          		
		          		echo  '<td scope="row">'.$row['mobile'].'</td>';		          	
		          		echo  '<td scope="row">'.$row['comments'].'</td>';
		          		
		          		
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

    