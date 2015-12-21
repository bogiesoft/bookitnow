<section class="content-header">
  <h1>Manager Choice Deals</h1>
  <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manager Choice Deals</li>
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
			
			<section class="ac-container" id="dvContent">
				<?php
				foreach ($countries['country'] as $country)
				{
					echo '<div><input class="country" id="country_'.$country['@attributes']['id'].'" name="accordion-1" type="checkbox" value='.$country['@attributes']['id'].' onchange="countryOnly(this)"/>
					<label for="country_'.$country['@attributes']['id'].'" class="grid1">
					<i></i>'.$country['@attributes']['name'].'</label><article class="ac-small" ><ul id="sub_'.$country['@attributes']['id'].'"></ul></article><div>';
				}
				?>
			</section>
		</div><!--/.col (right) -->
     </div>   <!-- /.row -->
 </section>		

<div id="deals_div" style="display: none;">
  <div class="img-title"><img src="<?php echo base_url();?>images/top-bg.jpg" alt="title-name"></div>
      <div>
	    	 <form class="f-box" method="post" onsubmit="return deal_extras_form(this);">
	    	    <div class="form-group">
	    			<input type="text" class="form-control" placeholder="Feature - 1" name="feature_1" />
	    		</div>	    			    		
	    		<div class="form-group">
	    			<input type="text" class="form-control" placeholder="Feature - 2" name="feature_2" />
	    		</div><div class="form-group">
	    			<input type="text" class="form-control" placeholder="Feature - 3" name="feature_3" />
	    		</div><div class="form-group">
	    			<input type="text" class="form-control" placeholder="Feature - 4" name="feature_4" />
	    		</div>	   	
	    			<input type="hidden" name="mapper" />
	    			<input type="hidden" name="hotel_name" />
	    		<div class="box-footer">
                    <button class="btn btn-info pull-right" type="submit" style="margin-top: 10px;float:right;"> Submit </button>
	    			<a class="btn btn-default cancel"> Cancel </a>	
                  </div>	    			    			
	    	</form>     	
     </div>
  </div>     
</div>
<style>
.parets_cus{
    color: #11AFE6;
    font-weight: bold;
    font-size: 16px;
    cursor:pointer;
}
</style>
			
<script type="text/javascript">
	
	function countryOnly(e)
	{	
		blockSearchingTabs();
		var t= $(e).val(); 	
		if($(e).prop("checked") == true){		 
				$.post('admin/regionsByCountry',{com_id:t},function(result){
				//	console.log(result);return false;			
					$('#sub_'+t).html(result);
					unblockSearchingTabs();			
				},'html');				
         }
         else if($(e).prop("checked") == false){
        	 $('#sub_'+t).html('');
        	 unblockSearchingTabs();
         }		
	}
	
	function area(e,mapng)
	{
		if($(e).next().prop("tagName") == 'ul')
		{
			$(e).next().remove();
		}
		else{
		blockSearchingTabs();	
		if(!$(e).find('.resorts').length )
		{
			$.post('admin/resortsByAreas',{mapng:mapng},function(result){					
				$(e).after(result);
				unblockSearchingTabs();
						
			},'html');			
		}
		else{
			alert('Sorry,Some thing went wrong')
			unblockSearchingTabs();	
		}
		}
	}
// 	function region(e,mapng)
// 	{	
// 		if($(e).next().prop("tagName").toLowerCase() == 'ul')
// 		{
// 			$(e).next().remove();
// 		}
// 		else{
// 		blockSearchingTabs();	
// 		if(!$(e).find('.areas').length )
// 		{
// 			$.post('admin/areassByregions',{mapng:mapng},function(result){							
// 				$(e).after(result);
// 					unblockSearchingTabs();			
// 				},'html');				
// 		}
// 		else
// 		{
// 			alert('Sorry,Some thing went wrong')
// 			unblockSearchingTabs();			
// 		}
// 		}
	
// 	}
	function region(e,mapng)
	{	
		
		if($(e).next().prop("tagName") == 'ul')
		{
			$(e).next().remove();
		}
		else{
		blockSearchingTabs();	
		if(!$(e).find('.areas').length )
		{
			$.post('admin/areassByregions',{mapng:mapng},function(result){							
				$(e).after(result);
					unblockSearchingTabs();			
				},'html');				
		}
		else
		{
			alert('Sorry,Some thing went wrong')
			unblockSearchingTabs();			
		}
		}
	
	}

	function resort(e,mapng)
	{
		if($(e).next().prop("tagName") == 'ul')
		{
			$(e).next().remove();
		}
		else{
			blockSearchingTabs();	
		if(!$(e).find('.resorts').length )
		{
			$.post('admin/hotelsByresort',{mapng:mapng},function(result){							
				$(e).after(result);
					unblockSearchingTabs();			
				},'html');				
		}
		else
		{
			alert('Sorry,Some thing went wrong')
			unblockSearchingTabs();			
		}
		}
	}
	
	
	function checkMe(e,name)
	{	
		if($(e).prop("checked") == true){
			$.fancybox({
                'href': '#deals_div',
                'helpers'   : { 
                    overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
                   }               
            });
			$('[name="hotel_name"]').val($(e).next('span').text());
			$('[name="mapper"]').val($(e).val()); 
            $('.cancel').click(function(){
				$(e).prop('checked',false);
				$('.fancybox-close').trigger('click');
            })
		}
		else{
			var req_data = {'mapper' : $(e).val()};
			$.post('/admin/deletemanagerDeals',req_data,function(result){				
				alert(result.message);			
				return false;
			},'json');			
			return false;
		}		
	}

	function deal_extras_form(obj){
		var req_data = $(obj).serializeArray();		
		$.post('/admin/savemanagerDeals',req_data,function(result){				
			if(result.status == 'success'){
				alert(result.message);
			}
			else if(result.status == 'fail')
			{
				alert(result.message);
			}													
			return false;
		},'json');	
		$('.fancybox-close').trigger('click');		
		return false;
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
