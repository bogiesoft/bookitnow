<?php if(!(@$is_laststep)){?>
<div id="your_Search">
	<div class="container">
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
		               <div class="form-group col-sm-3">
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
			           <div class="form-group col-sm-1">
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
		          
		        
				          <div class="form-group col-sm-1">
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
		          
				          <div class="form-group col-sm-1">
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
		          
				          <div class="form-group col-sm-1">
				           <label> Children :</label>
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
		          		<button class="button"  type="submit" style="margin-top:1.2em;">Search Again</button>          
		      		</form>
		      	</div>
		      </div>
		</div>
	</div>


</div>

<?php }?>



<div class="clearfix"></div>

<div id="select_names">
  <div class="container">
	<div class="hide_mobile hide_tablet bg_grey border_b has_bottom_margin">
      <div class="gridContainer ">
    	<ul class="fluidList steps fh clearfix">   	
          <li class="<?php echo $h_cur;?>"><strong>1. Select Hotel </strong><?php if($h_done == 'done')echo '<i class="fa fa-check-circle"></i>';?></li>
          <li class="<?php echo $b_cur;?>"><strong>2. Book</strong></li>          
          <li class="bg_1 clearfix">
        	<div id="LP_DIV_1429625391320" class="right"></div>
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
	    		<form id="rooms_form" class="form-inline f-box"></form>                      
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
			    		<button class="btn btn-primary1" type="submit" style="margin-top: 10px;float:right;"> Submit </button>	
		    	</form>
		    </div>
		</div>  
   <style>
  .btn-primary1 {   
     text-align: left;
     border: 0px;
     font-size: 12px;
     text-transform: lowercase;
     background: #0099cc;
    }
   label {
    font-size: 16px;
    font-family: 'Open Sans', sans-serif;
	}
	
  </style>



