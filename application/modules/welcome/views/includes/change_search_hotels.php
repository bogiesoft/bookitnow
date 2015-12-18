
<div class="you">
<?php 
	//echo '<pre>';print_r($change_search_info['row']['num_rooms']);exit;
	$dept_arr = explode('|',$change_search_info['query']['depapt']);
	$t = explode('-',$departures[$dept_arr[0]]);	
	$ser_str = array_pop($t) .' to ';	
	$controller->load->model ( 'Arrivals' );
	$arr_rows_cat_wise = $controller->Arrivals->fetchArrivalsByCategory();	
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
       <form name="full_pack_form" onsubmit="return full_pack_submit(this)" method="post" accept-charset="utf-8">
        <div class="form-group col-sm-2" >
        <label> Fly From:</label>
                    <br>
                   
                    
                    <select name="full_departure_airports" onchange="" id="" class="full_width">
                          <option value="-1">Select Destination</option>
                          <?php
								foreach($filtered_departures as $key => $val)
								{									
									//echo "<option value='-1'>".$key."</option>";
									$opt_val_str = '';
									foreach($val as $key1 => $val1)
									{
										$opt_val_str .= $key1.'|';		
									}
									$checked = '';
									
									if($change_search_info['query']['depapt'] == substr($opt_val_str, 0, -1))$checked = 'selected';
									echo "<option $checked value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
								}
							  ?>	   
					</select>
                  </div>
         
        <div class="form-group col-sm-2">
            <label> Travel To:</label>
                    <br>
                    <select name="full_arrival_airports" id="" class="full_width">
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
            <label> Departure Date:</label>
                    <br>
                    
                    <input readonly name="full_departure_date" value="<?php echo $change_search_info['row']['selected_date'];?>"  type="text" id="datepicker">
          </div>
          
          
           <div class="form-group col-sm-2">
            <label> Nights:</label>
                    <br>
                    <select name="full_nights" class="full_width">                         
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
                    <select name="full_rooms" class="full_width">                          
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
                    <select name="full_adults" class="full_width">
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
                    <select name="full_children" class="full_width">
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
<?php 
	//echo "<pre>";print_r($controller->router->fetch_method());exit; 
	?>
<div class="clearfix"></div>   
    <div style="display: block;" id="dvToggle" class=""> 
		<div class="hide_mobile hide_tablet bg_grey border_b has_bottom_margin">     
	   
		    <div class="gridContainer ">
		    	<ul class="fluidList steps fh clearfix">
		    	
		    	 <li class="<?php echo $fcls;?>"><strong class="<?php echo $f_done;?>">1. Select Flight</strong></li>		    	 
		          <li class="<?php echo $hcls;?>"><strong class="<?php echo $h_done;?>">2. Select Hotel</strong></li>		        
		          <li class="<?php echo $ecls;?>"><strong class="<?php echo $e_done;?>">3. Savings &amp; Extras</strong></li>
		          <li class="<?php echo $bcls;?>"><strong class="<?php echo $b_done;?>">4. Book</strong></li>
		          <li class="bg_1 clearfix">
		        		<div class="right"></div>
		      	  </li>
		      	 </ul>
		  	</div>
	      	
  		</div>
  	</div>
  </div>

   
<div id="body_content" style="margin:0px;">

<div class="clearfix"></div>

<div id="middle_conent">
<div class="container">

        
        
          
          <!-- /FILTER COLUMN-->
         
   <div id="rooms_div" style="display: none;">
  <div class="img-title"><img src="<?php echo base_url();?>images/top-bg.jpg" alt="title-name"></div>
      <div>
	    	<form id="rooms_form" class="form-inline f-box">
	    	</form>                      
     </div>
  </div>  
  
  <div id="bluk_div" style="display: none;">
  <div class="img-title"><img src="<?php echo base_url();?>images/top-bg.jpg" alt="title-name"></div>
      <div>
	    	 <form class="f-box" id="bulk_form" method="post">
	    	    <div class="form-group noHotel">	   
	    	    	<label>Fly From : </label> 			
	    			<select class="input-block-level"  name="fly_from" onchange="arrivals(this.value,document.getElementById('arrival_airports_p'))">
  						<option value="-1">Select Destination</option>
  							<?php
								foreach($filtered_departures as $key => $val)
								{						
									$opt_val_str = '';
									foreach($val as $key1 => $val1)
									{
										$opt_val_str .= $key1.'|';		
									}
									echo "<option value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
								}
							  ?>	                    
		              </select>
	    		</div>
	    		<div class="form-group">
					<label>Travel To : </label>    			
	    			<select class="input-block-level"  id="arrival_airports_p" name="travel_to">
                		<option value="-1">Select Destination</option>                            
              		</select>
	    		</div>
	    		<div class="form-group noHotel">	
	    			<label> Departure Date : </label>    			
	    			<input type="text" class="form-control datePicker" placeholder="Departure Date" name="Date_of_departure">
	    		</div>
	    		<div class="form-group noFull noFlight">	
	    			<label> Check In Date : </label>    			
	    			<input type="text" class="form-control datePicker" placeholder="Check In Date" name="check_in_date">
	    		</div>
	    		<div class="form-group">
	    			<label> Nights : </label>	    			
	    			<input type="text" class="form-control" placeholder="Nights" name="number_of_nights">
	    		</div>	    			    		
	    		<div class="form-group noFlight">	
	    			<label> Rooms: </label>    			
	    			<input type="text" class="form-control" placeholder="Number of rooms" name="rooms">
	    		</div>
	    		<div class="form-group">
	    			<label> Adults: </label>    		    			
	    			<input type="text" class="form-control" placeholder="Number of adults" name="Adults">
	    		</div>	    		
	    		<div class="form-group">
	    			<label> Children : </label>    		    			
	    			<input type="text" class="form-control" placeholder="Number of Children" name="Children">
	    		</div>
	    		<div class="form-group">
	    			<label> Name : </label>	    			
	    			<input type="text" class="form-control" placeholder="Name" name="first_name">
	    		</div>  		
	    		<div class="form-group">	
	    			<label> Email : </label>    			
	    			<input type="text" class="form-control" placeholder="Email" name="email">
	    		</div>
	    		<div class="form-group">	    
	    			<label> Mobile : </label>			
	    			<input type="text" class="form-control" placeholder="Mobile" name="mobile">
	    		</div>		    		
	    		<div class="form-group">	    
	    			<label> Comments : </label>			
	    			<textarea class="form-control" placeholder="Comments" name="comments"></textarea>
	    		</div>		    		
	    		<button class="btn btn-primary" type="submit" style="margin-top: 10px;float:right;"> Submit </button>	
	    	</form>    
	    	
     </div>
  </div>  
  
     



