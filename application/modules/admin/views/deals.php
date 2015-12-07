
    <div class="content_bottom">
     <div class="col-md-8 span_3">  					
		   
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
		if($(e).next().prop("tagName").toLowerCase() == 'ul')
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
		alert($(e).next().prop("tagName").toLowerCase());
		if($(e).next().prop("tagName").toLowerCase() == 'ul')
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
		if($(e).next().prop("tagName").toLowerCase() == 'ul')
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
