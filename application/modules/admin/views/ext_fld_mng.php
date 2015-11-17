 <div class="content_bottom">
     <div class="col-md-8 span_3">	
     	<?php 
			echo validation_errors(); 
    		echo $this->session->flashdata('message');
    		$attributes = array('name'=>'add_luggage','class'=>'form-horizontal');
			echo form_open(base_url().'admin/mang_ext_categories', $attributes);
			foreach ($categories as $category)
			{
				
				$checked = ($category['status'] == 1) ? 'checked' : '';
				
				echo '<div class="form-group">
				   <label for="cat_'.$category['id'].'" class="col-sm-4 control-label">'.$category['name'].'</label>
				   <div class="col-sm-8">				   		
						<input id="cat_'.$category['id'].'" '.$checked.' type="checkbox" name="cat['.$category['id'].']" onchange="this.form.submit()"/>
					</div>									
				</div>	
				<input name="post_cat" type="hidden"/>';
			}
		?>				
	<?php echo form_close();?>	
