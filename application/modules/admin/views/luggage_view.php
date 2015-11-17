 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<div class="table-responsive">
     	<?php 
     		echo $this->session->flashdata('message');
     	?>
     	
     <a class="btn btn-info" href="<?php echo base_url().'admin/add_luggage';?>">Add New</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Airline Name</th>
            <th>Airline Code</th>
            <th>Weight of bag</th>
            <th>Price</th>
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>
          <?php 
          	foreach ($rows as $sno => $row)
          	{
          		echo '<tr>';
          		echo  '<th scope="row">'.($sno+1).'</th>';
          		echo  '<th scope="row">'.$row['airline_name'].'</th>';
          		echo  '<th scope="row">'.$row['airline_code'].'</th>';
          		echo  '<th scope="row">'.$row['weight'].'</th>';
          		echo  '<th scope="row">'.$row['price'].'</th>';
          		echo  '<th scope="row"><a href="'.base_url().'admin/edit_luggage/'.$row['id'].'"><i class="fa fa-edit"></i></a> / <a onclick="delete_lug('.$row['id'].')"><i class="fa fa-trash"></i></a></th>';
          		echo '</tr>';
          	}
          ?>          
        </tbody>
      </table>
    </div>
    
    <script type="text/javascript">
		function delete_lug(id)
		{
			if(confirm("Are you sure , Do you want to delete ?"))
			{
				$.post('deleteLug_fun',{id:id},function(result){					
					if(result == 'success')
					{
						window.location = 'luggage_view';
					}
					else
					{
						alert('Something went wrong');
					}
				});
			}		
		}
    </script>