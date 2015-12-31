<div class="clear has_bottom_margin clearfix" id="dvContent">
    <div id="tabwrap_flights dates_list_container" >
   		<ul id="tabs_flights">
   		  <?php 
 			foreach ($dates_list as $date){            				
  				if($selected_date == $date)
  				{
   					echo '<li class="center current">
           					<a>
			            		<div class="current_date" dt='.$date.'>'.date('D d M',$controller->cvtDt($date)).' </div>
			            		<small> '.$num_of_flights[$date].' flights from</small><br>
			            		<strong class="price">'.$best_prices_dates_wise[$date].'</strong>
			            		<div class="dropcover"></div>
			            	</a>
			             </li>';
            	}else{
            		echo '<li class="center">
		        			<a>
		        				<div class="current_date" dt='.$date.'>'.date('D d M',$controller->cvtDt($date)).' </div>
		        				<small> '.$num_of_flights[$date].' flights from</small><br>
		        				<strong class="price">'.$best_prices_dates_wise[$date].'</strong>
		        				<div class="dropcover"></div>
		        			</a>
		        		</li>';
            	}
            }
          ?>
        </ul>
        <div id="content" style="clear: both;">
        	<?php   			
            	$count = 0;
            	echo ' <div id="DateMinus3" class="clearfix "> ';
            	foreach($flights_list['offers_list'] as $flight_obj)
            	{     
            		$plain_txt = json_encode($flight_obj);   				
            		$encrypted_txt = $controller->encrypt_decrypt('encrypt', $plain_txt); 
            		$dscode = $flight_obj['@attributes']['depapt'];
            		$ascode = $flight_obj['@attributes']['arrapt'];
            		$ascode_con = @trim(explode('-',$arrivals[(string)$ascode])[1]);
            		$ascode = ($ascode_con != '') ? $ascode_con : trim(explode('-',$arrivals[(string)$ascode])[0]);
            		$dscode = trim(explode('-',$departures[(string)$dscode])[0]);
            		$dept_start_time = substr(explode(' ',$flight_obj['@attributes']['outdep'])[1],0,-3);
            		$dept_arr_time = substr(explode(' ',$flight_obj['@attributes']['outarr'])[1],0,-3);
            		$return_start_time = substr(explode(' ',$flight_obj['@attributes']['indep'])[1],0,-3);
            		$return_arr_time = substr(explode(' ',$flight_obj['@attributes']['inarr'])[1],0,-3);
            		           				
                	echo '<div id="divShowWhenSelect_1" class="flightresult">
                      <div class="clearfix">
                    	<div class="flight_info clearfix">                         
                          <div class="flight_depart"> <strong class="txt_color_2"><i class="fa fa-plane icon_flightdepart" aria-hidden="true"></i><h3 class="fl_dep_ret">Depart</h3></strong><br>
                       	 	<div> <!--<img src="'.@$suppliers_list[$flight_obj['@attributes']['suppcode']].'" style="border: 0;">-->
                              <div style="float: right"> </div>
                            </div>
                        <strong style="font-size: 16px;color: #114C6F;">'.date('l d M Y',$controller->cvtDt($flight_obj['@attributes']['outdep'])).'</strong><br>                       
                        <small>'. $dscode.' to '.$ascode.' '.$dept_start_time.'/'.$dept_arr_time.'</small><br>
                        <span class="txt_color_2"> </span> </div>     						
                          <div class="flight_return"> <strong class="txt_color_2"><i class="fa fa-plane icon_flightreturn" aria-hidden="true"></i><h3 class="fl_dep_ret">Return</h3></strong><br>
                        <div> <!--<img src="'.@$suppliers_list[$flight_obj['@attributes']['suppcode']].'" style="border: 0;">--> </div>
                        <strong style="font-size: 16px;color: #114C6F;">'.date('l d M Y',$controller->cvtDt($flight_obj['@attributes']['indep'])).'</strong><br>
                        <small>'.$ascode.' to '.$dscode.' '.$return_start_time.'/'.$return_arr_time.'</small><br>
                        <span class="txt_color_2"> </span> </div>                        
                          <div class="clear flight_bags">                      
                        	<small> <span></span> </small> 
                          </div>
                        </div>
	                    <div class="fluid flight_price clearfix">
	                          <div class="flight_cost"> <strong class="txt_color_1 txt_large"> <span>&#163;'.$flight_obj['@attributes']['sellpricepp'].'</span></strong><small class="txt_color_1">pp</small><br>
	                        	<small> <span class="luggage_label"></span> </small> </div>
	                          	<div class="flight_button center"><a class="button"  style="margin-top: 5px;" onclick=Addflight("'.$type_flight.'","'.$encrypted_txt.'","'.$this->uri->segment(2).'")>ADD <i class="fa fa-plus-circle" aria-hidden="true"></i> </a> </div>
	                        </div>
	                  </div>
                    </div>';
            		//echo '<td><div>'.$flight_obj['@attributes']['suppname'].'</div><div>'.date('l d M Y',$controller->cvtDt($flight_obj['@attributes']['indep'])).'</div><div>'.$ascode.' to '.$dscode.'</div></td>';
            		$count++;
            		if($count == 10)break;
            	}
            	echo '</div>';
            ?>
         </div>	             
    </div>               
    <div class="bg_grey2 padded has_bottom_margin clearfix"> 
        <!--PAGING-->
        <div class="paging right" id="pager_list"> 
        <?php
         	$res_count = count($flights_list['offers_list']);
        		if($res_count > 10)
				{
					echo '<span>Page: </span><span class="pager_list_pages">';
					$num_pages = ($res_count%10)? ($res_count/10)+1 : $res_count/10; 
					for($i=1;$i<=$num_pages;$i++)
					{
						if($i==1)echo '<span>'.$i.'</span>';
							else echo '<a class="pagerhyperlink">'.$i.'</a>';
					}	
						echo ' </span> ';
				}
		?>             	 	
        </div>
	      <!--/PAGING--> 
    </div>
</div>           

<script type="text/javascript">
    var $type_flight = '<?php echo $type_flight;?>';
	var flight_crypt = '<?php echo $this->uri->segment(2);?>';	
	var mintime = parseInt('<?php echo @$dept_take_offs_min;?>');
    var maxtime = parseInt('<?php echo @$dept_take_offs_max;?>');
    var minrange = parseInt('<?php echo @$dept_take_offs_min;?>');
    var maxrange = parseInt('<?php echo @$dept_take_offs_max;?>');		   
    var mintime_R = parseInt('<?php echo @$return_take_offs_min;?>');
    var maxtime_R = parseInt('<?php echo @$return_take_offs_max;?>');
    var minrange_R = parseInt('<?php echo @$return_take_offs_min;?>');
    var maxrange_R = parseInt('<?php echo @$return_take_offs_max;?>');	    
</script>
<style>
	span.ui-corner-all{
		background : #f6b817 !important;
	}
</style>
		
<div id="wait_page" style="display:none">
	<div style="text-align:center;">
		<img src="/images/logo.png"/>
	</div>
	<div class="center wait_page" style="text-align:center;">	
		<div class="wait_page_section">
			<h2 style="padding-bottom: 10px;margin-bottom: 10px; color: #094fa3; font-weight: 700; border-bottom: 1px solid #A0CCDD;">
				Your Flights Have Been Added.
			</h2>
		</div>
		<div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;">
			<h3 class="txt_color_1">Now Checking Hotel Availability</h3>
			<div class="wait_page_loading"> <img src="/images/loader-bar.gif"></div>
			<br>
			<div style="color: #428bca; font-size: 17px;">Please Wait a Moment Whilst We Get you The Best Rates...</div>
		</div>
		<div>
			<h4 style="color: #f19412;" ><strong>Book With Confidence</strong></h4>
			<h5>Fully ABTA and ATOL Bonded for financial protection</h5>
			<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div>
			<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent">
				<img src="/images/abta.png"/>
			</div>
		</div>
	</div>
</div>
		
       