<section class="content-header">
  <h1>Form Elements</h1>
  <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">General Elements</li>
  </ol>
</section>

<section class="content" style="background:#fff;">
    <div class="row">          
      <!-- right column -->
      <div class="col-md-8 ">
         <!-- Horizontal Form -->
         <div class="box box-info ">
     	     <!-- /.box-header -->
             <!-- form start -->             		
           	 <form class="form-horizontal">
                 <div class="box-body">        
                    <label for="focusedinput" class="col-sm-2 control-label">Categories</label>
					<div class="col-sm-10">
						<select name="categories" class="form-control">
						<?php 
						foreach($categories as $cat)
						{
							echo "<option value=".$cat['id'].">".$cat['name']."</option>";
						}
						?>
						</select>
					</div>		    
                  </div>                           
             </form>
          </div><!-- /.box -->
       

	<!-- main -->
	<section class="ac-container content" style="background:#fff;" id="dvContent">
	<?php
		foreach ($countries['country'] as $country)
		{
			echo '<div><input class="country" id="country_'.$country['@attributes']['id'].'" name="accordion-1" type="checkbox" value='.$country['@attributes']['id'].' onchange="country(this)"/>
				<label for="country_'.$country['@attributes']['id'].'" class="grid1">
				<i></i>'.$country['@attributes']['name'].'</label><article class="ac-small" ><ul id="sub_'.$country['@attributes']['id'].'"></ul></article><div>';
		}
	?>
	</section>	
	</div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section>
<script type="text/javascript">
	function country(e)
	{	
		blockSearchingTabs();
		var t= $(e).val(); 	
		if($(e).prop("checked") == true){		 
				$.post('admin/readMappingsFun',{com_id:t,pos:'country'},function(result){			
					$('#sub_'+t).html(result);
					unblockSearchingTabs();			
				},'html');				
         }
         else if($(e).prop("checked") == false){
        	 $('#sub_'+t).html('');
        	 unblockSearchingTabs();
         }		
	}
	function checkMe(e,name)
	{	
		blockSearchingTabs();	
		if($(e).prop("checked") == true){
			var check = 1;
		}
		else
		{
			var check = 0;
		}			
		$.post('/admin/saveListingFun',{check_result:check,val:$(e).val(),cat:$('select[name="categories"]').val(),name:$(e).next('span').html(),arapts:$(e).attr('arrivals')},function(result){			
			unblockSearchingTabs();
		},'html');
	}
	//popup for block further search options during ajax request
	function blockSearchingTabs() {
        $.blockUI.defaults.css = {};
        $('#dvContent').block({
            message: '<div><img src="/images/loader-bar.gif" alt=""  width="225px"/></div>',
            overlayCSS: { backgroundColor: '#fff' }
        });
    }
	//close popup once get the ajax response
    function unblockSearchingTabs() {
        $('#dvContent').unblock();
    }
</script> 
