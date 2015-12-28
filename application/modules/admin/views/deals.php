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
     <div class="col-md-12 ">
      <div class="col-md-5 ">
         <!-- Horizontal Form -->
         <div class="box box-info ">
     	     <!-- /.box-header -->
             <!-- form start -->             		
           	 <form class="form-horizontal">
                 <div class="box-body">        
                    <label for="focusedinput" class="col-sm-2 control-label">Categories</label>
					<div class="col-sm-10">
						<select id="deal_category" class="form-control" onchange="$('.country:checked').each(function(){$(this).prop('checked',false);$(this).next().remove();});">
						<?php 
						foreach($deal_categories as $key => $cat)
						{
							echo "<option value=".$key.">".$cat."</option>";
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
		</div><!--/.col (6) -->
		<div class="col-md-7 ">
			<div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 5.0</td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 5.5</td>
                        <td>Win 95+</td>
                        <td>5.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 6</td>
                        <td>Win 98+</td>
                        <td>6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>Internet Explorer 7</td>
                        <td>Win XP SP2+</td>
                        <td>7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Trident</td>
                        <td>AOL browser (AOL desktop)</td>
                        <td>Win XP</td>
                        <td>6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.5</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 2.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 3.0</td>
                        <td>Win 2k+ / OSX.3+</td>
                        <td>1.9</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Camino 1.0</td>
                        <td>OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Camino 1.5</td>
                        <td>OSX.3+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape 7.2</td>
                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape Browser 8</td>
                        <td>Win 98SE+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Netscape Navigator 9</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.1</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.2</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.2</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.3</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.4</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.4</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.5</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.6</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.6</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.7</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.8</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Seamonkey 1.1</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Epiphany 2.20</td>
                        <td>Gnome</td>
                        <td>1.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 1.2</td>
                        <td>OSX.3</td>
                        <td>125.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 1.3</td>
                        <td>OSX.3</td>
                        <td>312.8</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 2.0</td>
                        <td>OSX.4+</td>
                        <td>419.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>Safari 3.0</td>
                        <td>OSX.4+</td>
                        <td>522.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>OmniWeb 5.5</td>
                        <td>OSX.4+</td>
                        <td>420</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>iPod Touch / iPhone</td>
                        <td>iPod</td>
                        <td>420.1</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>S60</td>
                        <td>S60</td>
                        <td>413</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 7.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 7.5</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 8.0</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 8.5</td>
                        <td>Win 95+ / OSX.2+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.0</td>
                        <td>Win 95+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.2</td>
                        <td>Win 88+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera 9.5</td>
                        <td>Win 88+ / OSX.3+</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Opera for Wii</td>
                        <td>Wii</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Nokia N800</td>
                        <td>N800</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Nintendo DS browser</td>
                        <td>Nintendo DS</td>
                        <td>8.5</td>
                        <td>C/A<sup>1</sup></td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.1</td>
                        <td>KDE 3.1</td>
                        <td>3.1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.3</td>
                        <td>KDE 3.3</td>
                        <td>3.3</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.5</td>
                        <td>KDE 3.5</td>
                        <td>3.5</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 4.5</td>
                        <td>Mac OS 8-9</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 5.1</td>
                        <td>Mac OS 7.6-9</td>
                        <td>1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 5.2</td>
                        <td>Mac OS 8-X</td>
                        <td>1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>NetFront 3.1</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>NetFront 3.4</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Dillo 0.8</td>
                        <td>Embedded devices</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Links</td>
                        <td>Text only</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Lynx</td>
                        <td>Text only</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>IE Mobile</td>
                        <td>Windows Mobile 6</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>PSP browser</td>
                        <td>PSP</td>
                        <td>-</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Other browsers</td>
                        <td>All others</td>
                        <td>-</td>
                        <td>-</td>
                        <td>U</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              
		</div>
	  </div><!--/.col (12) -->	
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
	    			<input type="hidden" name="deal_category" />
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
		if($(e).next().prop("tagName") != 'LI' && $(e).next().prop("tagName") != undefined )
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

	function region(e,mapng)
	{	
		
		if($(e).next().prop("tagName") != 'LI' && $(e).next().prop("tagName") != undefined )
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
		if($(e).next().prop("tagName") != 'LI' && $(e).next().prop("tagName") != undefined )
		{
			$(e).next().remove();
		}
		else{
			blockSearchingTabs();	
		if(!$(e).find('.resorts').length )
		{
			$.post('admin/hotelsByresort',{mapng:mapng,deal_category:$('#deal_category').val()},function(result){							
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
			$('[name="deal_category"]').val($('#deal_category').val());
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
