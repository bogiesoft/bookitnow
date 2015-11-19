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
            <th>Mobile</th>
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>
          <?php 
          	foreach ($rows as $sno => $row)
          	{
          		$adult_raw_info = json_decode($row['adults_info']);      
          		echo '<tr>';
          		echo  '<th scope="row">'.($sno+1).'</th>';          		
          		echo  '<th scope="row">'.$adult_raw_info->fname[0].'</th>';          		
          		echo  '<th scope="row">'.$adult_raw_info->lname[0].'</th>';
          		echo  '<th scope="row">'.$row['email'].'</th>';
          		echo  '<th scope="row">'.$row['mobile'].'</th>';
          		echo  '<th scope="row"><a href="'.base_url().'admin/view_booking/'.$row['id'].'"><i class="fa fa-eye" title="view"></i></a></th>';
          		echo '</tr>';
          	}
          ?>          
        </tbody>
      </table>
    </div>
    