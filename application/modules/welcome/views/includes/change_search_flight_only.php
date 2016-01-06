<?php if(!(@$is_laststep)){?>
<div id="your_Search">
	<div class="container">
		<div class="you">
			<?php 
				//echo '<pre>';print_r($change_search_info);exit;
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
			       <form name="flight_hotel_form" method="post" accept-charset="utf-8">
				     <div class="form-group col-sm-3" >
				        	<label> Fly From:</label>
				            <br>               
		                    <select name="departure_airports" onchange="" id="" class="full_width">
		                          <option value="-1">Select Destination</option>
		                          <?php
										foreach($filtered_departures as $key => $val)
										{									
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
	         		 <div class="form-group col-sm-3">
			            <label> Travel To:</label>
			                    <br>
			                    <select name="arrival_airports" id="" class="full_width">
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
			               <input readonly name="departure_date" value="<?php echo $change_search_info['row']['selected_date'];?>"  type="text" id="datepicker">
			          </div>
			          <div class="form-group col-sm-1">
			            	<label> Nights:</label>
		                    <br>
		                    <select name="nights" class="full_width">                         
		                          <option value="-1">---</option>
		                          <?php for($i=1;$i<=21;$i++){
		                          	$checked = '';
		                          	if($i == $change_search_info['query']['maxstay'])$checked = 'selected';
		                          	echo '<option '.$checked.'>'.$i.'</option>';
		                          }?>
		                    </select>
			          </div>   
			          <div class="form-group col-sm-1">
				          <label> Adults:</label>
	                      <br>
	                      <select name="adults" class="full_width">
	                    	<?php 
	                    		
	                    		for($i=1;$i<=15;$i++){
	                          	$checked = '';
	                          	if($i == $change_search_info['row']['num_adults'])$checked = 'selected';                          	 
	                          	echo '<option '.$checked.'>'.$i.'</option>';
	                          }
	                       ?>                          
						  </select>
			          </div>
			          <div class="form-group col-sm-1">
			          	<label> Children</label>
			            <br>
			            <select name="childrens" class="full_width">
			            	<option value="-1">0</option>
			               	<?php 
			               		for($i=1;$i<=10;$i++){
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
<?php } ?>
<div class="clearfix"></div>
<div id="select_names">
	<div class="container">
	
		<div class="hide_mobile hide_tablet border_b has_bottom_margin">
	      <div class="gridContainer ">
		    <ul class="fluidList steps fh clearfix">   
		          <li class="<?php echo $fcls;?>"><strong>1. Select Flight </strong><?php if($f_done == 'done')echo '<i class="fa fa-check-circle"></i>';?></li>
		          <li class="<?php echo $bcls;?>"><strong>2. Book</strong></li>          
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
	         <div id="rooms_div" style="display: none;">
	  			<h2>Rooms - Persons</h2>
	     		<div>
	        		<h4 class="has_bottom_margin">Please share the members for each room.</h4>
		    		<form id="rooms_form"></form>
	                      
	    		</div>     
			</div>
		</div>
	</div>
</div>

<style>
.col-sm-2{
        width: 15%;
    }
</style>
