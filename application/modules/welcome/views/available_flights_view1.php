    <?php if($this->router->fetch_method() == 'fullFlightsavailable')$type_flight = 'full_flight_date';
            	  else $type_flight = 'flight_date';
            ?>
<div id="body_content" style="margin:0px;">

<div id="your_Search">
<div class="container">
<?php 
	if($type_flight == 'full_flight_date')
	{
		include_once 'includes/change_search_hotels.php';
	}
	else{
		include_once 'includes/change_search_flight_only.php';
	}
?> 
 <div  class="col-sm-2" style="width: 100.666667%;
    margin-top: -89px;">
   
          <div style="display: block;" id="dvToggle" class=""> 

<div class="hide_mobile hide_tablet bg_grey border_b has_bottom_margin">

      <div class="gridContainer ">
  
    <?php if($type_flight == 'full_flight_date'){?>
     <ul class="fluidList steps fh clearfix" >
          <li class="current"><strong>1. Select Flights </strong></li>
          <li class=""><strong>2. Select Hotel</strong></li>
          <li class=""><strong>3. Savings &amp; Extras</strong></li>
          <li class=""><strong>4. Book</strong></li>
          <li class="bg_1 clearfix">
        <div class="right"></div>
      </li>
      
      	<?php } else { ?>
      	 <ul class="fluidList steps fh clearfix" style="
    margin-top: 59px;
 margin-left: 117px;">
      		<li class="current"><strong>1. Select Flights </strong></li>
      		<li class=""><strong>2. Book</strong></li>
	      	<li class="bg_1 clearfix">
	        	<div class="right"></div>
	      	</li>
      	<?php }?>
        </ul>
  </div>
  
  </div>
  </div>
  
  
  
  
<!--/STEPS-->

</div>



<div class="clearfix"></div>

<div id="middle_conent">

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
          <div class="col-sm-3" style="">
          <div style="display: block;" id="dvToggle" class=""> 
        <!--FILTER--> 
        <!--FILTER FLIGHTS-->
        
        <div id="dvFilter" class="filter">
          <div>
            <div class="clearfix bg_white  drop_light has_bottom_margin" id="all_departures">
                <div class="padded bg_1 txt_white"><strong>Fly From:</strong></div>
               
                   <div class="filtercheckbox"> 
                   	  <span groupname="filter">
                  	  	<input id="FlightFilterAll" name="FlightFilterAll" type="checkbox" checked value="ALL">
                  	  	<label for="FlightFilterAll">All Departures</label>
                  	  </span>                      
                    </div>
                            

                 <?php 
                 	foreach ($fly_from as $scode => $operator)
                 	{
                 		echo ' <div class="filtercheckbox">
		                  	 <span  name="check" groupname="filter">
		                    	<input id="FlightFilter_'.$scode.'" name="FlightFilter_'.$scode.'" type="checkbox" value="'.$scode.'">
		                    	<label for="FlightFilter_'.$scode.'">'.$operator.'</label>
		                      </span>
		                	  <label for="chkFlightFilter_'.$scode.'"> <span class="lbl_sub">from &#163;'.$fly_from_best_prices[$scode].'</span></label>
		             	</div>';
                 	}
                 ?>
                        
                </div>
            <!-- <div class="clearfix bg_white drop_light has_bottom_margin" id="all_operators">
               <div class="padded bg_1 txt_white"><strong>Flight Operator:</strong></div>
                  <div class=" clearfix">
                	<div class="filtercheckbox">
                		<span groupname="filter">
                  			<input id="FlightFilterAllOperator" name="FlightFilterAllOperator" checked="checked" type="checkbox" value="ALL">
                  			<label for="FlightFilterAllOperator">All Operators</label>
                  		</span>
                  		
                  	</div>
             	 </div>
             	  <?php 
                 /*	foreach ($flight_operators as $scode => $operator)
                 	{
                 		echo '<div class="filtercheckbox">
			                  	 <span name="check" groupname="filter">
			                    	<input id="FlightOperatorFilter_'.$scode.'" name="FlightOperatorFilter_'.$scode.'" type="checkbox"  value="'.$scode.'">
			                    	<label for="FlightOperatorFilter_'.$scode.'" style="font-size:0;"> </label>
			                      </span>
			                	  <label for="FlightOperatorFilter_'.$scode.'">
	      							<span class="lbl_logo"> <img src="'.$operator.'" alt="'.$scode.'" style="width: 100px; height: 25px;"> </span> </label>
		             			</div>';
                 	}*/
                 ?>
            </div>-->
            <div class="clearfix bg_white drop_light has_bottom_margin">
                  <div class="padded bg_1 txt_white"><strong>Flight Times:</strong></div>
                  <div class="padded bg_white center">
                	<p>
                      <label for="timerange"> Depart take-off:</label>
                      <input id="timerange" readonly style="border: 0; color: #f6931f; font-weight: bold; text-align: center;" type="text">
                    </p>
                    <div id="slider-range"></div>
                    <p>
                    <label for="timerangereturn"> Return take-off:</label>
                    <input value="10:00 - 24:00" id="timerangereturn" readonly style="border: 0; color: #f6931f; font-weight: bold; text-align: center;" type="text">
                    </p>
                	<div id="slider-rangereturn"></div>      
              		</div>
                </div>
          </div>
            </div>
        <!--/FILTER FLIGHTS--> 
        
        <!--/FILTER--> 
      </div>
      </div>
          <!-- /FILTER COLUMN--> 
          <!--FLIGHTS COLUMN-->
          <div class="col-sm-9" style="float:right;">
          <div class="fluid columns_nine clearfix"> 
        
        <!--TABBED FLIGHTS-->
        
        
        
        <?php include_once 'includes/flights.php';?>
          </div>
      </div>
          <!--FLIGHTS COLUMN--> 
        </div>

</div>
</div>
<style>
. select_search{   background: rgba(253, 249, 249, 0.59) linear-gradient(to bottom, #F9F9F9 1%, rgba(152, 116, 60, 0.76) 100%) repeat scroll 0% 0%;
}</style>