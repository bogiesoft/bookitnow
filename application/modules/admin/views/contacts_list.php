<!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Contacters List </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Contacters List</li>
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
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Comments</th>            
          </tr>
        </thead>
        <tbody>
          <?php 
          $count=0;
          	foreach ($rows as $sno => $row)
          	{     
          		echo '<tr>';
          		echo  '<th scope="row">'.($sno+1).'</th>';          		
          		echo  '<th scope="row">'.$row['name'].'</th>';          		
          		echo  '<th scope="row">'.$row['email'].'</th>';
          		echo  '<th scope="row">'.$row['subject'].'</th>';
          		echo  '<th scope="row">'.$row['comments'].'</th>';
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
    
    