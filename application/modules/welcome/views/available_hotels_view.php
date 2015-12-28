<?php
	if($type == 'hotel_only'){
		include_once 'includes/change_search_hotels_only.php';
	}else{		
		include_once 'includes/change_search_hotels.php';
	}?> 
	<div class="col-sm-2" style="">
          <div style="display: block;" id="dvToggle" class=""> 
       <div id="dvFilter" class="filter"><div>
            <div class="clearfix bg_white  drop_light has_bottom_margin">
                  <div class="title-left"><span class="h-title">Order Hotels By:</strong></div> 
            </div>
			
            <div class="clearfix bg_white drop_light has_bottom_margin">                
              <!--   <div id="cphContent_divFlightAvailabilityFilterOperatorCode" class=" clearfix">
				   <div class="filtercheckbox"> <span>
                  <input id="chkFlightFilter_all" name="recommended" checked="checked" type="checkbox">
                  <label for="chkFlightFilter_all">Recommended</label></span> 
				  </div>
                </div>   -->          
                
                <div class="filtercheckbox"> <span name="check">
                    <input id="chkFlightFilter_0" mandatory="price" checked="checked" value="lowest" type="checkbox">
                    <label for="chkFlightFilter_0">Lowest Price</label>
                    </span>                    
               </div> 	

				<div class="filtercheckbox"> <span name="check">
                    <input id="chkFlightFilter_1" mandatory="price" value="highest" type="checkbox">
                    <label for="chkFlightFilter_1">Highest Price</label>
                    </span>
              
               </div> 	
            </div>         
          </div>
        </div>
<!--/FILTER FLIGHTS--> 							 
</div>

<!--search start here-->
<div class="about">
				<div class="title-left"><span class="h-title">Find Hotel Name</span></div>
						<div id="custom-search-input">
                            <div class="input-group col-md-12">
                               <form onsubmit="return filterHotels('<?php echo $this->uri->segment(2);?>','<?php echo $type; ?>',1, document.getElementById('hotel_key').value);">
									<input type="text" class="search-query form-control" placeholder="Search" id="hotel_key" />
									<span class="input-group-btn">
										<button class="btn btn-danger" type="submit">
											<span class=" glyphicon glyphicon-search">GO</span>
										</button>									
									</span>	
								</form>						
							</div>
                        </div>


<!--search closed here-->
<!--Star Rating-->
</div>
<div class="filter_section">
<div class="title-left"><span class="h-title">Star Rating:<span></div>		

<?php 
	ksort($offers['populators']['star_ratting']['res']);
	
	function min_price_star($item) {		
		return min($item);
	}
	function count_hot_star($item) {
		return count($item);
	}	
	echo '<div class="filtercheckbox filtercheckbox2">
              <span name="check">
            	<input id="chkStar_all" type="checkbox" checked="checked">
            	<label style="height:50px;" for="chkStar_all">All Rattings
					<p class="p1">'.array_sum(array_map('count_hot_star',$offers['populators']['star_ratting']['price'])).' hotels from</p>
	            	<p class="p2"> &#163;'.min(array_map('min_price_star',$offers['populators']['star_ratting']['price'])).'</p>
				</label>
              </span>
           </div>';
	foreach ($offers['populators']['star_ratting']['res'] as $key => $val)
	{
	
		echo '<div class="filtercheckbox filtercheckbox2">
                               <span name="check">
            						<input id="chkStar_'.$key.'" type="checkbox" mandatory="star" value='.$key.' >
            						<label style="height:50px;" for="chkStar_'.$key.'">'.$val.'
					                    <p class="p1">
					                       '.count($offers['populators']['star_ratting']['price'][$key]).' hotels from
					            		</p>
	                   					 <p class="p2"> &#163;'.min($offers['populators']['star_ratting']['price'][$key]).'</p>
									</label>
                  				</span>
                           </div>';
	}
	?>

</div>
<div class="clearfix filter_section">
<div class="title-left"><span class="h-title">Board Basis:<span></div>		
					

<?php 
	echo '<div class="filtercheckbox">
            <span name="check">
            	<input id="chkBoardbasisFilter_all" checked="checked" type="checkbox" value="ALL" >
            	<label for="chkBoardbasisFilter_all">All Board Basis</label>
			</span>
            <label for="chkBoardbasisFilter"></label>
          </div>';

foreach ($offers['populators']['boardbasis'] as $key => $val)
{
		echo '<div class="filtercheckbox filtercheckbox1">
                               <span name="check">
            						<input id="chkBoardbasisFilter_'.$key.'" mandatory="boardbasis" type="checkbox" value="'.$key.'" >
            						<label for="chkBoardbasisFilter_'.$key.'">'.$val.'</label>
				   				</span>
                               <label for="chkBoardbasisFilter"></label>
                           </div>';
}
?>	
					
<!--closed Rating-->
</div>
<div class="clearfix filter_section">
			<div class="title-left"><span class="h-title">Resorts</span></div>
			<?php 
			echo '<div class="filtercheckbox">
                               <span name="check">
            						<input id="chkResortsFilter_all" checked="checked" type="checkbox" value="ALL" >
            						<label for="chkResortsFilter_all">All Resorts</label>
				   				</span>
                               <label for="chkResortsFilter"></label>
                           </div>';
				foreach ($offers['populators']['resorts'] as $key => $val)
				{
					//echo '<button type="button" class="btn btn-primary">'.$val.'</button>';
					echo '<div class="filtercheckbox filtercheckbox1">
                               <span name="check" groupname="filter">
            						<input id="chkResortsFilter_'.$key.'" type="checkbox"  mandatory="resorts" value="'.$key.'" >
            						<label for="chkResortsFilter_'.$key.'">'.$val.'</label>
				   				</span>
                               <label for="chkResortsFilter"></label>
                           </div>';
				}	
				
			?>
			

</div>
</div>
<!-- middle design start here-->
<div class="col-sm-7" style="padding-left:0px;" >

	<?php 
		echo '<div id="hotel_content">';
		echo $content;
		echo '</div>';
	?>
	</div>
<!-- middle design closed here-->

<!--sidebar-->
    <div class="col-sm-3">
        <div class="left-sidebar">
        
        
        <?php echo @$seleted_info;?>
        
        <?php include_once 'includes/atol_left.php';?>

	<div class="clearfix"></div>
	<?php include_once 'includes/independent_reviews_left.php';?>
	<div class="clearfix"></div>

        
      
</div>
</div>
<!--sidebar-->
</div>
</div>
<<script type="text/javascript">
var hotel_crypt = '<?php echo $this->uri->segment(2);?>';
var type = '<?php echo $type;?>';
</script>			 
<style>	 
.filtercheckbox1 {
    border-radius: 5px;
    margin-bottom: 0;
    position: relative;
    text-align: left;
    margin-top: -18px;
}
.filtercheckbox2 {
    border-radius: 5px;
    margin-bottom: 0;
    position: relative;
    text-align: left;
       margin-top: 2px;
}
.p1 {
    margin: -7px -29px 10px;
    height: 5px;
}
.p2 {
    margin:-14px 68px 10px;
    color: #1A8DD2;
    }
</style>		
	