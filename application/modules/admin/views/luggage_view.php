   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Tables
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->

              <div class="box" >
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
  	<?php 
  		echo $this->session->flashdata('message');
  	?>
    <!--    <a class="btn btn-info" href="<?php echo base_url().'admin/add_luggage';?>">Add New</a>-->
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
	</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    
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