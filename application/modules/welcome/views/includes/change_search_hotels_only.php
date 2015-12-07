
<div class="you">
<?php 
	//echo '<pre>';print_r($change_search_info['row']['num_rooms']);exit;
// 	$dept_arr = explode('|',$change_search_info['query']['depapt']);
// 	$t = explode('-',$departures[$dept_arr[0]]);	
// 	$ser_str = array_pop($t) .' to ';	
	$ser_str = '';
	$controller->load->model ( 'Arrivals' );
	$arr_rows_cat_wise = $controller->Arrivals->fetchArrivalsByCategory();	
	//echo "<pre>";print_r($change_search_info);exit;
	foreach ($arr_rows_cat_wise as $tarrival)
	{		
		if($tarrival['arapts'] == $change_search_info['row']['arapts'])
		{
		
			$ser_str .= $tarrival['name_resort'];
		}		
	}
	$ser_str .= ', '.$change_search_info['row']['num_adults'].' Adult(s), ';
	$ser_str .= $change_search_info['row']['num_children'].' Children(s), ';
	$ser_str .= $change_search_info['query']['maxstay'].' Night(s), ';
	$ddate = isset($fselected_date) ? $fselected_date : $change_search_info['query']['depdate'];
	$ser_str .=  date('d M Y',$controller->cvtDt(str_date($ddate)));
	
	
?>


<p><strong>Your Search:</strong> <?php echo $ser_str;?>.</p>
</div>

 <div class="make_buttons">
    <div class="button" data-toggle="collapse" data-target="#demo" style="">Change Search</div>
  
<div class="clearfix"></div>
  
  
  <div id="demo" class="collapse" style="margin-top:1em;">
   <div class="row" class="forms">
       <form name="full_pack_form" onsubmit="return hotelsForm(this)" method="post" accept-charset="utf-8">
        
         
        <div class="form-group col-sm-2">
            <label> Travel To:</label>
                    <br>
                    <select name="hotel_travel_to" id="" class="full_width">
                          <option value="-1">Select Destination</option>
                        <?php 
                        foreach ($arr_rows_cat_wise as $tarrival)
                        {
                        	$checked = '';
                        	if($tarrival['arapts'] == $change_search_info['row']['arapts'])$checked = 'selected';
                        	echo '<option '.$checked.' mapper="'.$tarrival['map_root'].'" value="'.$tarrival['arapts'].'">'.$tarrival['name_resort'].'</option>';
                        }                        
                        ?>  
                    </select>
          </div>
        <div class="form-group col-sm-2">
            <label> Check In Date:</label>
                    <br>
                    
                    <input readonly name="hotel_check_in_date" value="<?php echo $change_search_info['row']['selected_date'];?>"  type="text" id="datepicker">
          </div>
          
          
           <div class="form-group col-sm-2">
            <label> Nights:</label>
                    <br>
                    <select name="hotel_nights" class="full_width">                         
                          <option value="-1">---</option>
                          <?php for($i=1;$i<=21;$i++){
                          	$checked = '';
                          	if($i == $change_search_info['query']['maxstay'])$checked = 'selected';
                          	echo '<option '.$checked.'>'.$i.'</option>';
                          }?>
                    </select>
          </div>   
          
        
          <div class="form-group col-sm-2">
          <label> Rooms:</label>
                    <br>
                   <!-- $change_search_info['query']['maxstay'] --> 
                    <select name="hotel_rooms" class="full_width">                          
                          <?php for($i=1;$i<=4;$i++){
                          	$checked = '';
                          	if($i == $change_search_info['row']['num_rooms'])$checked = 'selected';                          	 
                          	echo '<option '.$checked.'>'.$i.'</option>';
                          }?>                        
                        </select>
          </div>
          
          <div class="form-group col-sm-2">
          <label> Adults:</label>
                    <br>
                    <select name="hotel_adults" class="full_width">
                    	<?php 
                    		
                    		for($i=$change_search_info['row']['num_rooms'];$i<=($change_search_info['row']['num_rooms'] * 4);$i++){
                          	$checked = '';
                          	if($i == $change_search_info['row']['num_adults'])$checked = 'selected';                          	 
                          	echo '<option '.$checked.'>'.$i.'</option>';
                          }
                       ?>                          
					</select>
          </div>
          
          <div class="form-group col-sm-2">
           <label> Children 2-12 yrs:</label>
                    <br>
                    <select name="hotel_childrens" class="full_width">
                    	<option value="-1">0</option>
                    	<?php 
                    		
                    		for($i=1;$i<=5;$i++){
                          	$checked = '';
                          	if($i == $change_search_info['row']['num_children'])$checked = 'selected';                          	 
                          	echo '<option '.$checked.'>'.$i.'</option>';
                          }
                       ?>               
                        </select>
          </div>          
          <button class="button"  type="submit" style="margin-top:1.8em;">Search Again</button>          
      </form>
      </div>
      </div>

</div>







</div>


</div>
<div class="clearfix"></div>

<div id="select_names">
<div class="container">
<!--STEPS
<div class="hide_mobile hide_tablet bg_grey border_b has_bottom_margin">
      <div class="gridContainer ">
    <ul class="fluidList steps fh clearfix">
    
    	<?php if(@$row[0]['type_search'] == 'full_package'){ ?>
    		
    		<li class=""><strong class="done">1. Select Flights </strong></li>
    		<li class="current"><strong>2. Select Hotel</strong></li>
    		<li class=""><strong>3. Savings &amp; Extras</strong></li>
    		<li class=""><strong>4. Book</strong></li>
    		<li class="bg_1 clearfix">
    			<div class="right"></div>
    		</li>
    		
    	<?php }
    	else 
    	{?>
          <li class="current"><strong>1. Select Hotel </strong></li>
          <li class=""><strong class="done">2. Book</strong></li>          
          <li class="bg_1 clearfix">
        <div id="LP_DIV_1429625391320" class="right"></div>
      </li>
      <?php } ?>
     </ul>
  </div>
    </div>
-->

</div>

</div>
   
<div id="body_content" style="margin:0px;">

<div class="clearfix"></div>

<div id="middle_conent">
<div class="container">
<div class="gridContainer clearfix"> 
          <!--Search From Grid Info-->
          <div style="display: none;">
        <h3>Your Selections:</h3>
        <div style="display: none;"> 1 rooms
              2 adult(s)
              <h5 class="blue"> <strong>Your Search</strong></h5>
              02 October 2015, <span id="cphContent_ltrNoOfNights">7</span>Nights
              <div class="row-margin-sm small"> London Airports
            to
            Benidorm<br>
            02 October 2015<br>
            <br>
            <span id="cphContent_ltrHotelResortName">,Benidorm</span><br>
            <span id="cphContent_ltrBoardType">All Inclusive</span><br>
          </div>
              <div class="row-margin-sm small">
            <h6 class="left">Guide Price</h6>
            <h6 class="right blue">£<span ></span><small>pp</small></h6>
            <div class="clear"> </div>
            <small class="left">flights guide price:</small><small class="right">£<span id="cphContent_ltrFlightPrice"></span>pp</small>
            <div class="clear"> </div>
            <small class="left">rooms guide price:</small><small class="right">£<span id="cphContent_ltrHotelPrice"></span>pp</small>
            <div class="clear"> </div>
          </div>
            </div>
      </div>
          <!--Search From Grid Info--> 
          <!--Search Info-->
          <div style="display: none;">
        <h5 class="blue"> <strong>Your Search</strong></h5>
        <div class="row-margin-sm small"> London Airports
              to
              Benidorm<br>
              02 October 2015<br>
              7
              Nights<br>
              Any Star Rating<br>
              1
              rooms<br>
              All Inclusive <br>
              2 adult(s) </div>
        <a href="#" class="button small">MODIFY SEARCH</a> </div>
          <!--Search Info--> 
          
          <!-- /FILTER COLUMN-->
         
         <div id="rooms_div" style="display: none;">
  <h2>Rooms - Persons</h2>
     <div>
        <h4 class="has_bottom_margin">Please share the members for each room.</h4>
	    	<form id="rooms_form">
	    	</form>
                      
     </div>     
</div>
