<!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Extras Management <small>Manage Categories</small> </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Extras Management View</li>
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
				echo form_open(base_url().'admin/mang_ext_categories', $attributes);
			?>
				<div class="form-group">
                    <div class=" col-sm-8">
			<?php 
				foreach ($categories as $category)
				{
					
					$checked = ($category['status'] == 1) ? 'checked' : '';
					
					echo '<div class="checkbox"><label for="cat_'.$category['id'].'">
           					<input id="cat_'.$category['id'].'" '.$checked.' type="checkbox" name="cat['.$category['id'].']" onchange="this.form.submit()"/>
	     					'.$category['name'].'</label></div><input name="post_cat" type="hidden"/>';
				}
			?>		
					</div>
				</div>		
			<?php echo form_close();?>
			</div><!-- /.box -->             
         </div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section><!-- /.content -->	
