
    <div class="content_bottom">
     <div class="col-md-8 span_3">	
     
    					 <form class="form-horizontal">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Categories</label>
									<div class="col-sm-8">
										<select name="categories" >
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
		   
		   	<!-- main -->
			
			<section class="ac-container" id="dvContent">
				<?php
				foreach ($countries['country'] as $country)
				{
					echo '<div><input class="country" id="country_'.$country['@attributes']['id'].'" name="accordion-1" type="checkbox" value='.$country['@attributes']['id'].' onchange="country(this)"/>
					<label for="country_'.$country['@attributes']['id'].'" class="grid1">
					<i></i>'.$country['@attributes']['name'].'</label><article class="ac-small" ><ul id="sub_'.$country['@attributes']['id'].'"></ul></article><div>';
				}
				?>
			</section>
<style>
.regions{
    color: #11AFE6;
    font-weight: bold;
    font-size: 16px;
}
</style>
			
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
