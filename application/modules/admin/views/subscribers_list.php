 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<div class="table-responsive">
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
            <th>Zip Code</th>            
          </tr>
        </thead>
        <tbody>
          <?php 
          $count=0;
          	foreach ($rows as $sno => $row)
          	{     
          		echo '<tr>';
          		echo  '<th scope="row">'.($sno+1).'</th>';          		
          		echo  '<th scope="row">'.$row['fname'].'</th>';          		
          		echo  '<th scope="row">'.$row['lname'].'</th>';
          		echo  '<th scope="row">'.$row['email'].'</th>';
          		echo  '<th scope="row">'.$row['zipcode'].'</th>';
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
    </div>
    