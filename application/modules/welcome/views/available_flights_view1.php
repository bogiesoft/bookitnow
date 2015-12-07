    <?php if($this->router->fetch_method() == 'fullFlightsavailable')$type_flight = 'full_flight_date';
            	  else $type_flight = 'flight_date';
            ?>
<div id="body_content" style="margin:0px;">
<!-- <div id="your_Search">
<div class="container">
<div class="you">
<?php 

	$dept_arr = explode('|',$change_search_info['query']['depapt']);
	$t = explode('-',$departures[$dept_arr[0]]);
	$ser_str = array_pop($t) .' to ';	
	$controller->load->model ( 'Arrivals' );
	$arr_rows_cat_wise = $controller->Arrivals->fetchArrivalsByCategory();
	foreach ($arr_rows_cat_wise as $tarrival)
	{
		if($tarrival['arapts'] == $change_search_info['query']['arrapt'])
		{
			$ser_str .= $tarrival['name_resort'];
		}		
	}
	$ser_str .= ', '.$change_search_info['row']['num_adults'].' Adult(s), ';
	$ser_str .= $change_search_info['row']['num_children'].' Children(s), ';
	$ser_str .= $change_search_info['query']['maxstay'].' Night(s), ';
	$ser_str .=  date('d M Y',$controller->cvtDt(str_date($change_search_info['query']['depdate'])));
	
	
?>
<p><strong>Your Search:</strong> <?php echo $ser_str;?>.</p>
</div>

 <div class="make_buttons">
    <div class="button" data-toggle="collapse" data-target="#demo" style="">Change Search</div>
  
<div class="clearfix"></div>  
  <div id="demo" class="collapse" style="margin-top:1em;">
   <div class="row" class="forms">
        <?php $attributes = array('name'=>'flight_hotel_form');
				echo form_open('welcome/index', $attributes);
		?>
        <div class="form-group col-sm-2" >
        <label> Fly From:</label>
                    <br>
                    <select name="departure_airports">
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
									echo "<option value=".substr($opt_val_str, 0, -1).">".$key." Airports</option>";
								}
							  ?>	                          
					</select>
                  </div>
         
        <div class="form-group col-sm-2">
            <label> Travel To:</label>
                    <br>
                    <select name="" id="" class="full_width">
                          <option value="-1">Select Destination</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;color:red;">TOP SELLING BEACH</option>
                          <option value="">Algarve</option>
                          <option selected="selected" value="ALC">Benidorm</option>
                          <option value="">Mexico - Cancun</option>
                          <option value="">Costa Brava</option>
                          <option value="">Cyprus</option>
                          <option value="">Dubai</option>
                          <option value="">Florida - Sanford</option>
                          <option value="">Fuerteventura</option>
                          <option value="">Gran Canaria</option>
                          <option value="">Ibiza</option>
                          <option value="">Lanzarote</option>
                          <option value="">Majorca / Mallorca</option>
                          <option value="">Sharm El Sheikh</option>
                          <option value="">Tenerife</option>
                          <option value="">Turkey - Dalaman</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;color:red;">TOP SELLING CITY</option>
                          <option value="">Amsterdam</option>
                          <option value="">Barcelona</option>
                          <option value="">Berlin</option>
                          <option value="">Budapest</option>
                          <option value="">Dubai</option>
                          <option value="">Krakow</option>
                          <option value="">Madrid</option>
                          <option value="">Marrekech</option>
                          <option value="">Palma City</option>
                          <option value="">Paris</option>
                          <option value="">Prague</option>
                          <option value="">Rome</option>
                          <option value="">Tallin</option>
                          <option value="">Venice</option>
                          <option value="">Vienna</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">AUSTRIA</option>
                          <option value="">Innsbruck</option>
                          <option value="">Salzburg</option>
                          <option value="">Vienna</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">BALEARICS (SEARCH ALL)</option>
                          <option value="">Majorca / Mallorca</option>
                          <option value="">Ibiza</option>
                          <option value="">Menorca</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">BULGARIA (SEARCH ALL)</option>
                          <option value="">Bourgas</option>
                          <option value="">Plovdiv</option>
                          <option value="">Sofia</option>
                          <option value="">Varna</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">CAPE VERDE</option>
                          <option value="">Boa Vista</option>
                          <option value="">Sal</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">CANADA</option>
                          <option value="">Vancover</option>
                          <option value="">Calgary</option>
                          <option value="">Toronto</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">CARIBBEAN (SEARCH ALL)</option>
                          <option value="">Antigua</option>
                          <option value="">Bahamas - Nassau</option>
                          <option value="">Barbados</option>
                          <option value="">Domincan Rep (North)</option>
                          <option value="">Domincan Rep (South)</option>
                          <option value="">Grenada</option>
                          <option value="">Jamaica</option>
                          <option value="">St Kitts</option>
                          <option value="">St Lucia</option>
                          <option value="">Tobago</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">CUBA</option>
                          <option value="">Cayo Coco</option>
                          <option value="">Holguin</option>
                          <option value="">Varadero</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">CZECH REPUBLIC</option>
                          <option value="">Prague City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">CROATIA</option>
                          <option value="">Dubrovnik</option>
                          <option value="">Pula</option>
                          <option value="">Split</option>
                          <option value="">Zagreb</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">CANARY ISLANDS (SEARCH ALL)</option>
                          <option value="">Tenerife</option>
                          <option value="">Lanzarote </option>
                          <option value="">Gran Canaria</option>
                          <option value="">Fuerteventura</option>
                          <option value="">La Palma</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">CYPRUS (SEARCH ALL)</option>
                          <option value="">Larnaca</option>
                          <option value="">Paphos </option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">DENMARK</option>
                          <option value="">Copenhagen</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">DUBAI - UNITED ARAB EMIRATES</option>
                          <option value="">Dubai</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">EGYPT (SEARCH ALL)</option>
                          <option value="">Sharm El Sheikh</option>
                          <option value="">Hurghada</option>
                          <option value="">Marsa Alam</option>
                          <option value="">Taba</option>
                          <option value="">Luxor</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">ESTONIA</option>
                          <option value="">Tallinn</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">FRANCE</option>
                          <option value="">Biarritz</option>
                          <option value="">Bordeaux</option>
                          <option value="">Paris CDG</option>
                          <option value="">Grenoble</option>
                          <option value="">La Rochelle</option>
                          <option value="">Lyon</option>
                          <option value="">Montpellier</option>
                          <option value="">Marseille</option>
                          <option value="">Nice</option>
                          <option value="">Toulouse</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">FRANCE - CORSICA</option>
                          <option value="">Ajaccio</option>
                          <option value="">Bastia- corsica</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">GAMBIA</option>
                          <option value="">Gambia - Banjul</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">GERMANY</option>
                          <option value="">Berlin</option>
                          <option value="">Colgne</option>
                          <option value="">Dortmund</option>
                          <option value="">Dusseldorf</option>
                          <option value="">Hamburg</option>
                          <option value="">Munich</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">GREECE AND ISLANDS (SEARCH ALL)</option>
                          <option value="">Athens</option>
                          <option value="">Chania (Crete)</option>
                          <option value="">Corfu</option>
                          <option value="">Halkidiki</option>
                          <option value="">Heraklion (Crete)</option>
                          <option value="">Kalamata</option>
                          <option value="">Kefalonia</option>
                          <option value="">Kos</option>
                          <option value="">Lemnos</option>
                          <option value="">Mykonos</option>
                          <option value="">Prevaza / Lefkas</option>
                          <option value="">Rhodes</option>
                          <option value="">Samos</option>
                          <option value="">Santorini</option>
                          <option value="">Skiathos</option>
                          <option value="">Volos</option>
                          <option value="">Zante</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">IRELAND</option>
                          <option value="">Dublin - City Break</option>
                          <option value="">Cork - City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">INDIA</option>
                          <option value="">Goa</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">INDIAN OCEAN</option>
                          <option value="">Male - Maldives</option>
                          <option value="">Mauritius</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">ISREAL</option>
                          <option value="">Tel aviv</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">ITALY</option>
                          <option value="">Bergamo - Milan</option>
                          <option value="">Bari</option>
                          <option value="">Bologna</option>
                          <option value="">Cagliari</option>
                          <option value="">Rome - Ciampino</option>
                          <option value="">Catania</option>
                          <option value="">Rome - Fiumicino</option>
                          <option value="">Florence</option>
                          <option value="">Milan Malpensa</option>
                          <option value="">Naples</option>
                          <option value="">Turin</option>
                          <option value="">Venice Treviso / Marco Polo</option>
                          <option value="">Verona</option>
                          <option value="">Pisa</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">ITALY - SARDINIA</option>
                          <option value="">Alghero - Sardinia</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">ITALY SICILY</option>
                          <option value="">Palermo - Sicily</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">JORDAN</option>
                          <option value="">Amman</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">KENYA</option>
                          <option value="">Kenya - Mombasa</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">LATVIA</option>
                          <option value="">Riga</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">MALTA</option>
                          <option value="">Malta</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">MEXICO (SEARCH ALL)</option>
                          <option value="">Cancun</option>
                          <option value="">Puerto Vallarta</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">MOROCCO (SEARCH ALL)</option>
                          <option value="">Agadir</option>
                          <option value="">Marrakech - City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">NETHERLANDS</option>
                          <option value="">Amsterdam</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">PORTUGAL</option>
                          <option value="">The Algarve</option>
                          <option value="">Lisbon - Estoril Coast</option>
                          <option value="">Porto - City Break</option>
                          <option value="">Madeira</option>
                          <option value="">Porto Santo</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SLOVAKIA</option>
                          <option value="">Bratslava</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SLOVENIA</option>
                          <option value="">Ljubljana</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">SPAIN - MAINLAND (SEARCH ALL)</option>
                          <option value="">Benidorm / Costa Blanca</option>
                          <option value="">Costa Del Sol</option>
                          <option value="">Costa Almeria</option>
                          <option value="">Costa Brava</option>
                          <option value="">Costa Dorada / Salou</option>
                          <option value="">Costa Tropical</option>
                          <option value="">Barcelona - City Break</option>
                          <option value="">Bilbao - City Break</option>
                          <option value="">Gibraltar - City Break</option>
                          <option value="">Madrid - City Break</option>
                          <option value="">Seville - City Break</option>
                          <option value="">Valencia - City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SPAIN - BALEARICS</option>
                          <option value="">Majorca / Mallorca</option>
                          <option value="">Ibiza</option>
                          <option value="">Menorca</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SPAIN - CANARIES</option>
                          <option value="">Tenerife</option>
                          <option value="">Lanzarote</option>
                          <option value="">Gran Canaria</option>
                          <option value="">Fuerteventura</option>
                          <option value="">La Palma</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SWEDEN</option>
                          <option value="">Gothenburg </option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">SWITZERLAND</option>
                          <option value="">Basel</option>
                          <option value="">Geneva</option>
                          <option value="">Zurich</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">THAILAND</option>
                          <option value="">Bangkok</option>
                          <option value="">Phuket</option>
                          <option value="">Koh Samui</option>
                          <option value="">Krabi</option>
                          <option value="">Chiang Mai</option>
                          <option value="">Chiang Rai</option>
                          <option value="">Hua Hin</option>
                          <option value="">Surat Thani</option>
                          <option value="">Trat</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">TUNISIA</option>
                          <option value="">Monastir</option>
                          <option value="">Djerba</option>
                          <option value="">Enfidha</option>
                          <option value="">Tunis - City Break</option>
                          <option value="-1"> </option>
                          <option value="" style="font-weight:bold;">TURKEY (SEARCH ALL)</option>
                          <option value="">Dalaman</option>
                          <option value="">Bodrum Region</option>
                          <option value="">Antalya Region</option>
                          <option value="">Izmir</option>
                          <option value="">Istanbul Sabiha - City Break</option>
                          <option value="">Istanbul Ataturk - City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">UNITED STATES OF AMERICA</option>
                          <option value="">Miami - Breaks</option>
                          <option value="">Orlando - Sanford</option>
                          <option value="">Orlando - International</option>
                          <option value="">Tampa international</option>
                          <option value="">Atlanta - City Break</option>
                          <option value="">Boston - City Break</option>
                          <option value="">Chicago O'Hare - City Break</option>
                          <option value="">Las Vegas - City Break</option>
                          <option value="">New York JFK - City Break</option>
                          <option value="">New York Newark - City Break</option>
                          <option value="">Philadelphia - City Break</option>
                          <option value="">Washinton Dullas - City Break</option>
                          <option value="">Washinton Ronald R - City Break</option>
                          <option value="-1"> </option>
                          <option value="-1" style="font-weight:bold;">UNITED ARAB EMIRATES (DUBAI)</option>
                          <option value="">Dubai</option>
                        </select>
          </div>
        <div class="form-group col-sm-2">
            <label> Departure Date:</label>
                    <br>
                    <input readonly name="" value="02/10/2015" id="" type="text">
          </div>
          
          
           <div class="form-group col-sm-2">
            <label> Nights:</label>
                    <br>
                    <select name="" id="" class="full_width">
                         
                          <option value="-1">---</option>
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                          <option value="">10</option>
                          <option value="">11</option>
                          <option value="">12</option>
                          <option value="">13</option>
                          <option value="">14</option>
                          <option value="">15</option>
                          <option value="">16</option>
                          <option value="">17</option>
                          <option value="">18</option>
                          <option value="">19</option>
                          <option value="">20</option>
                          <option value="">21</option>
                          <option value="">22</option>
                          <option value="">23</option>
                          <option value="">24</option>
                          <option value="">25</option>
                          <option value="">26</option>
                          <option value="">27</option>
                          <option value="">28</option>
                          <option value="">29</option>
                          <option value="">30</option>
                          <option value="">31</option>
                          <option value="">32</option>
                          <option value="">33</option>
                          <option value="">34</option>
                          <option value="">35</option>
                          <option value="">36</option>
                          <option value="">37</option>
                          <option value="">38</option>
                          <option value="">39</option>
                          <option value="">40</option>
                          <option value="">41</option>
                          <option value="">42</option>
                          <option value="">43</option>
                          <option value="">44</option>
                          <option value="">45</option>
                          <option value="">46</option>
                          <option value="">47</option>
                          <option value="">48</option>
                          <option value="">49</option>
                          </select>
          </div>
          
       
          
       <div class="form-group col-sm-2">
       <label> Board Basis:</label>
                    <span class="txt_red">*</span><br>
                    <select name="" id="" class="full_width">
                          <option value="-1">- Please Select -</option>
                          <option selected="selected" value="AI">All Inclusive</option>
                          <option value="">Room Only</option>
                          <option value="">Bed and Breakfast</option>
                          <option value="">Self Catering</option>
                          <option value="">Half Board</option>
                          <option value="">Full Board</option>
                        </select>
       </div>
          
          
          <div class="form-group col-sm-2">
          <label> Min Rating:</label>
                    <br>
                    <select name="" id="" class="full_width">
                          <option selected="selected" value="any">Any</option>
                          <option value="">2* +</option>
                          <option value="">3* +</option>
                          <option value="">4* +</option>
                          <option value="">5* +</option>
                        </select>
          </div>
          
          <div class="form-group col-sm-2">
          <label> Rooms:</label>
                    <br>
                    <select name="" id="" class="full_width" onchange="">
                          <option selected="selected" value="1">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                        </select>
          </div>
          
          <div class="form-group col-sm-2">
          <label> Adults:</label>
                    <br>
                    <select name="" onchange="" class="full_width">
                          <option value="">1</option>
                          <option selected="selected" value="2">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                          <option value="">10</option>
                          <option value="">11</option>
                          <option value="">12</option>
                        </select>
          </div>
          
          <div class="form-group col-sm-2">
           <label> Children 2-12 yrs:</label>
                    <br>
                    <select name="" onchange="" id="" class="full_width">
                          <option selected="selected" value="0">0</option>
                          <option value="">1</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                          <option value="">7</option>
                          <option value="">8</option>
                          <option value="">9</option>
                        </select>
          </div>
          <div class="form-group col-sm-2">
          <label> Infants 0-1 yrs:</label>
                    <br>
                    <select name="" id="" class="full_width">
                          <option selected="selected" value="0">0</option>
                          <option value="">1</option>
                          <option value="">2</option>
                        </select>
          </div>
          <div class="button" data-toggle="collapse" style="margin-top:1.8em;">Search Again</div>
          
      </form>
      </div>
      </div>

</div>









</div></div>
-->
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
?>  <div class="col-sm-2" style="">
          <div style="display: block;" id="dvToggle" class=""> 

<div class="hide_mobile hide_tablet bg_grey border_b has_bottom_margin">
      <div class="gridContainer ">
    <ul class="fluidList steps fh clearfix">
    <?php if($type_flight == 'full_flight_date'){?>
          <li class="current"><strong>1. Select Flights </strong></li>
          <li class=""><strong>2. Select Hotel</strong></li>
          <li class=""><strong>3. Savings &amp; Extras</strong></li>
          <li class=""><strong>4. Book</strong></li>
          <li class="bg_1 clearfix">
        <div class="right"></div>
      </li>
      	<?php } else { ?>
      		<li class="current"><strong>1. Select Flights </strong></li>
      		<li class=""><strong>2. Book</strong></li>
	      	<li class="bg_1 clearfix">
	        	<div class="right"></div>
	      	</li>
      	<?php }?>
        </ul>
  </div>
  </div>
  
<!--/STEPS-->

</div>

</div>

<div class="clearfix"></div>

<div id="middle_conent">
 <!--<div class="container">
<div class="gridContainer clearfix"> 
         Search From Grid Info
        <!--   <div style="display: none;">
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
            <h6 class="right blue">£<span id="cphContent_ltrTotalPrice"></span><small>pp</small></h6>
            <div class="clear"> </div>
            <small class="left">flights guide price:</small><small class="right">£<span id="cphContent_ltrFlightPrice"></span>pp</small>
            <div class="clear"> </div>
            <small class="left">rooms guide price:</small><small class="right">£<span id="cphContent_ltrHotelPrice"></span>pp</small>
            <div class="clear"> </div>
          </div>
            </div>
      </div>-->
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
            <div class="clearfix bg_white drop_light has_bottom_margin" id="all_operators">
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
                 	foreach ($flight_operators as $scode => $operator)
                 	{
                 		echo '<div class="filtercheckbox">
			                  	 <span name="check" groupname="filter">
			                    	<input id="FlightOperatorFilter_'.$scode.'" name="FlightOperatorFilter_'.$scode.'" type="checkbox"  value="'.$scode.'">
			                    	<label for="FlightOperatorFilter_'.$scode.'" style="font-size:0;"> </label>
			                      </span>
			                	  <label for="FlightOperatorFilter_'.$scode.'">
	      							<span class="lbl_logo"> <img src="'.$operator.'" alt="'.$scode.'" style="width: 100px; height: 25px;"> </span> </label>
		             			</div>';
                 	}
                 ?>
            </div>
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