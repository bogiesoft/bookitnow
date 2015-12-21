<!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Luggage View <small>Manage Luggage Prices</small> </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Luggage View</li>
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
           <a class="btn btn-info" style="float:right;" href="<?php echo base_url().'admin/add_luggage';?>">Add New</a>
		      <table class="table table-bordered table-striped">
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
		          		echo  '<td scope="row">'.($sno+1).'</td>';
		          		echo  '<td scope="row">'.$row['airline_name'].'</td>';
		          		echo  '<td scope="row">'.$row['airline_code'].'</td>';
		          		echo  '<td scope="row">'.$row['weight'].'</td>';
		          		echo  '<td scope="row">'.$row['price'].'</td>';
		          		echo  '<td scope="row"><a href="'.base_url().'admin/edit_luggage/'.$row['id'].'"><i class="fa fa-edit"></i></a> / <a onclick="delete_lug('.$row['id'].')"><i class="fa fa-trash"></i></a></td>';
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