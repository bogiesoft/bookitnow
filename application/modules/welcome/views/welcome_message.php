<div class="container">
  <div class="tabbable custom-tabs tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#panel1" data-toggle="tab" class="active "><span>Flight & Hotel</span></a></li>
      <li><a href="#panel2" data-toggle="tab"><span>Hotel</span></a></li>
      <li><a href="#panel3" data-toggle="tab"><span>Flight</span></a></li>
    </ul>
    <div class="tab-content " id='dvContent'>
	 
      <div class="tab-pane active" id="panel1">
	  <?php $attributes = array('name'=>'flight_hotel_form');
			echo form_open('welcome/index', $attributes);
		?>
        <div class="row-fluid">
          <div class="span5">
            <div class="flyform">
              <label>Fly From:</label>
              <select class="input-block-level" name="departure_airports">
              <option value="-1">Select Destination</option>
			  <?php
				foreach($departures as $key => $val)
				{
					echo "<option value=".$key.">".$val."</option>";
				}
			  ?>
                    
              </select>
            </div>
            <div class="travelto">
              <label>Travel To:</label>
              <select class="input-block-level"  name="arrival_airports">
                <option value="-1">Select Destination</option>                                          
              </select>
            </div>
            <div class="flyform" >
              <label>Departure Date:</label>
              <input type="text" id="datepicker" name="departure_date">
            </div>
			
			<div class="board_basis">
              <label>Board Basis:</label>
              <select name="boardbasis" class="input-block-level">
				<option value="-1">- Please Select -</option>
				<option value="AI">All Inclusive</option>
				<option value="RO">Room Only</option>
				<option value="BB">Bed and Breakfast</option>
				<option value="SC">Self Catering</option>
				<option value="HB">Half Board</option>
				<option value="FB">Full Board</option>
			  </select>
            </div>
			
            
            <div class="adults" >
              <label>Adults:</label>
              <select class="input-block-level" name="adults">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="childerns" >
              <label>Childrens:</label>
              <select class="input-block-level"  name="childern">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#0198cd; text-align:center;">(Age *2-12)</p>
            </div>
          
            <div class="search" >
              <input class="btn btn-primary" type="submit" value="Search >"/>
            </div>
          </div>
        </div>
		 <?php echo form_close();?>
      </div>
	 
      <div class="tab-pane" id="panel2">
        <div class="row-fluid">
          <div class="span5">
            <label>Travel To:</label>
            <select class="input-block-level">
              <option>---Select Destination---</option>
              <option value="-1"> </option>
                            <option value="-1" style="">TOP SELLING BEACH</option>
                            <option value="FAO">Algarve</option>
                            <option value="ALC">Benidorm</option>
                            <option value="CUN">Mexico - Cancun</option>
                            <option value="GRO/BCN">Costa Brava</option>
                            <option value="PFO/LCA">Cyprus</option>
                            <option value="DXB">Dubai</option>
                            <option value="SFB">Florida - Sanford</option>
                            <option value="FUE">Fuerteventura</option>
                            <option value="LPA">Gran Canaria</option>
                            <option value="IBZ">Ibiza</option>
                            <option value="ACE">Lanzarote</option>
                            <option value="PMI">Majorca / Mallorca</option>
                            <option value="SSH">Sharm el Sheikh</option>
                            <option value="TFS">Tenerife</option>
                            <option value="DLM">Turkey - Dalaman</option>
                            <option value="-1"> </option>
                            <option value="-1" style="">TOP SELLING CITY</option>
                            <option value="AMS">Amsterdam</option>
                            <option value="BCN">Barcelona</option>
                            <option value="SXF">Berlin</option>
                            <option value="BUD">Budapest</option>
                            <option value="DXB">Dubai</option>
                            <option value="KRK">Krakow</option>
                            <option value="MAD">Madrid</option>
                            <option value="RAK">Marrekech</option>
                            <option value="PMI">Palma City</option>
                            <option value="CDG">Paris</option>
                            <option value="PRG">Prague</option>
                            <option value="FCO/CIA/ROM">Rome</option>
                            <option value="TLL">Tallin</option>
                            <option value="TSF/VCE">Venice</option>
                            <option value="VIE">Vienna</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">AUSTRIA</option>
                            <option value="INN">Innsbruck</option>
                            <option value="SZG">Salzburg</option>
                            <option value="VIE">Vienna</option>
                            <option value="-1"> </option>
                            <option value="PMI/IBZ/MAH" style="font-weight:bold;">BALEARICS (SEARCH ALL)</option>
                            <option value="PMI">Majorca / Mallorca</option>
                            <option value="IBZ">Ibiza</option>
                            <option value="MAH">Menorca</option>
                            <option value="-1"> </option>
                            <option value="BOJ/PDV/SOF/VAR" style="font-weight:bold;">BULGARIA (SEARCH ALL)</option>
                            <option value="BOJ">Bourgas</option>
                            <option value="PDV">Plovdiv</option>
                            <option value="SOF">Sofia</option>
                            <option value="VAR">Varna</option>
                            <option value="-1"> </option>
                            <option value="SID/BVC" style="font-weight:bold;">CAPE VERDE</option>
                            <option value="BVC">Boa Vista</option>
                            <option value="SID">Sal</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">CANADA</option>
                            <option value="YVR">Vancover</option>
                            <option value="YYC">Calgary</option>
                            <option value="YYZ">Toronto</option>
                            <option value="-1"> </option>
                            <option value="MBJ/BGI/POP/PUJ" style="font-weight:bold;">CARIBBEAN (SEARCH ALL)</option>
                            <option value="ANU">Antigua</option>
                            <option value="NAS">Bahamas - Nassau</option>
                            <option value="BGI">Barbados</option>
                            <option value="POP">Domincan Rep (North)</option>
                            <option value="PUJ">Domincan Rep (South)</option>
                            <option value="GND">Grenada</option>
                            <option value="MBH">Jamaica</option>
                            <option value="SKB">St Kitts</option>
                            <option value="UVF">St Lucia</option>
                            <option value="TAB">Tobago</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">CUBA</option>
                            <option value="CCC">Cayo Coco</option>
                            <option value="HOG">Holguin</option>
                            <option value="VRA">Varadero</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">CZECH REPUBLIC</option>
                            <option value="PRG">Prague City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">CROATIA</option>
                            <option value="DBV">Dubrovnik</option>
                            <option value="PUY">Pula</option>
                            <option value="SPU">Split</option>
                            <option value="ZAG">Zagreb</option>
                            <option value="-1"> </option>
                            <option value="TFS/ACE/LPA/FUE" style="font-weight:bold;">CANARY ISLANDS (SEARCH ALL)</option>
                            <option value="TFS">Tenerife</option>
                            <option value="ACE">Lanzarote </option>
                            <option value="LPA">Gran Canaria</option>
                            <option value="FUE">Fuerteventura</option>
                            <option value="SPC">La Palma</option>
                            <option value="-1"> </option>
                            <option value="LCA/PFO" style="font-weight:bold;">CYPRUS (SEARCH ALL)</option>
                            <option value="LCA">Larnaca</option>
                            <option value="PFO">Paphos </option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">DENMARK</option>
                            <option value="CPH">Copenhagen</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">DUBAI - UNITED ARAB EMIRATES</option>
                            <option value="DXB">Dubai</option>
                            <option value="-1"> </option>
                            <option value="SSH/HRG" style="font-weight:bold;">EGYPT (SEARCH ALL)</option>
                            <option value="SSH">Sharm el Sheikh</option>
                            <option value="HRG">Hurghada</option>
                            <option value="RMF">Marsa Alam</option>
                            <option value="TCP">Taba</option>
                            <option value="LXR">Luxor</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">ESTONIA</option>
                            <option value="TLL">Tallinn</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">FRANCE</option>
                            <option value="BIQ">Biarritz</option>
                            <option value="BOD">Bordeaux</option>
                            <option value="CDG">Paris CDG</option>
                            <option value="GNB">Grenoble</option>
                            <option value="LRH">La Rochelle</option>
                            <option value="LYS">Lyon</option>
                            <option value="MPL">Montpellier</option>
                            <option value="MRS">Marseille</option>
                            <option value="NCE">Nice</option>
                            <option value="TLS">Toulouse</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">FRANCE - CORSICA</option>
                            <option value="AJA">Ajaccio</option>
                            <option value="BIA">Bastia- corsica</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">GAMBIA</option>
                            <option value="BJL">Gambia - Banjul</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">GERMANY</option>
                            <option value="SFX">Berlin</option>
                            <option value="CGN">Colgne</option>
                            <option value="DTM">Dortmund</option>
                            <option value="NRN">Dusseldorf</option>
                            <option value="HAM">Hamburg</option>
                            <option value="MUC">Munich</option>
                            <option value="-1"> </option>
                            <option value="RHO/CFU/HER/KGS" style="font-weight:bold;">GREECE AND ISLANDS (SEARCH ALL)</option>
                            <option value="ATH">Athens</option>
                            <option value="CHQ">Chania (Crete)</option>
                            <option value="CFU">Corfu</option>
                            <option value="SKG">Halkidiki</option>
                            <option value="HER">Heraklion (Crete)</option>
                            <option value="KLX">Kalamata</option>
                            <option value="EFL">Kefalonia</option>
                            <option value="KGS">Kos</option>
                            <option value="LXS">Lemnos</option>
                            <option value="JMK">Mykonos</option>
                            <option value="PVK">Prevaza / Lefkas</option>
                            <option value="RHO">Rhodes</option>
                            <option value="SMI">Samos</option>
                            <option value="JTR">Santorini</option>
                            <option value="JSI">Skiathos</option>
                            <option value="VOL">Volos</option>
                            <option value="ZTH">Zante</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">IRELAND</option>
                            <option value="DUB">Dublin - City Break</option>
                            <option value="CRK">Cork - City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">INDIA</option>
                            <option value="GOI">Goa</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">INDIAN OCEAN</option>
                            <option value="MLE">Male - Maldives</option>
                            <option value="MRU">Mauritius</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">ISREAL</option>
                            <option value="TLV">Tel aviv</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">ITALY</option>
                            <option value="BGY">Bergamo - Milan</option>
                            <option value="BRI">Bari</option>
                            <option value="BLQ">Bologna</option>
                            <option value="CAG">Cagliari</option>
                            <option value="FCO/CIA/ROM">Rome - Ciampino</option>
                            <option value="CTA">Catania</option>
                            <option value="CIA/FCO">Rome - Fiumicino</option>
                            <option value="FLR">Florence</option>
                            <option value="MXP">Milan Malpensa</option>
                            <option value="NAP">Naples</option>
                            <option value="TRN">Turin</option>
                            <option value="TSF/VCE">Venice Treviso / Marco Polo</option>
                            <option value="VRA">Verona</option>
                            <option value="PSA">Pisa</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">ITALY - SARDINIA</option>
                            <option value="AHO">Alghero - Sardinia</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">ITALY SICILY</option>
                            <option value="PMO">Palermo - Sicily</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">JORDAN</option>
                            <option value="AMM">Amman</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">KENYA</option>
                            <option value="MBA">Kenya - Mombasa</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">LATVIA</option>
                            <option value="RIX">Riga</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">MALTA</option>
                            <option value="MLA">Malta</option>
                            <option value="-1"> </option>
                            <option value="CUN/PVR" style="font-weight:bold;">MEXICO (SEARCH ALL)</option>
                            <option value="CUN">Cancun</option>
                            <option value="PVR">Puerto Vallarta</option>
                            <option value="-1"> </option>
                            <option value="AGA/RAK" style="font-weight:bold;">MOROCCO (SEARCH ALL)</option>
                            <option value="AGA">Agadir</option>
                            <option value="RAK">Marrakech - City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">NETHERLANDS</option>
                            <option value="AMS">Amsterdam</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">PORTUGAL</option>
                            <option value="FAO">The Algarve</option>
                            <option value="LIS">Lisbon - Estoril Coast</option>
                            <option value="OPO">Porto - City Break</option>
                            <option value="FNC">Madeira</option>
                            <option value="PXO">Porto Santo</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SLOVAKIA</option>
                            <option value="BTS">Bratslava</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SLOVENIA</option>
                            <option value="LJU">Ljubljana</option>
                            <option value="-1"> </option>
                            <option value="ALC/GRO/BCN/AGP/REU" style="font-weight:bold;">SPAIN - MAINLAND (SEARCH ALL)</option>
                            <option value="ALC">Benidorm / Costa Blanca</option>
                            <option value="AGP">Costa Del Sol</option>
                            <option value="LEI">Costa Almeria</option>
                            <option value="GRO/BCN">Costa Brava</option>
                            <option value="REU/BCN">Costa Dorada / Salou</option>
                            <option value="GRX">Costa Tropical</option>
                            <option value="BCN">Barcelona - City Break</option>
                            <option value="BIO">Bilbao - City Break</option>
                            <option value="GIB">Gibraltar - City Break</option>
                            <option value="MAD">Madrid - City Break</option>
                            <option value="SVQ">Seville - City Break</option>
                            <option value="VLC">Valencia - City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SPAIN - BALEARICS</option>
                            <option value="PMI">Majorca / Mallorca</option>
                            <option value="IBZ">Ibiza</option>
                            <option value="MAH">Menorca</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SPAIN - CANARIES</option>
                            <option value="TFS">Tenerife</option>
                            <option value="ACE">Lanzarote</option>
                            <option value="LPA">Gran Canaria</option>
                            <option value="FUE">Fuerteventura</option>
                            <option value="SPC">La Palma</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SWEDEN</option>
                            <option value="GOT">Gothenburg </option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">SWITZERLAND</option>
                            <option value="BSL">Basel</option>
                            <option value="GVA">Geneva</option>
                            <option value="ZRH">Zurich</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">THAILAND</option>
                            <option value="BKK">Bangkok</option>
                            <option value="HKT">Phuket</option>
                            <option value="USM">Koh Samui</option>
                            <option value="KBV">Krabi</option>
                            <option value="CNX">Chiang Mai</option>
                            <option value="CEI">Chiang Rai</option>
                            <option value="HHK">Hua Hin</option>
                            <option value="URT">Surat Thani</option>
                            <option value="TDX">Trat</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">TUNISIA</option>
                            <option value="MIR">Monastir</option>
                            <option value="DJE">Djerba</option>
                            <option value="NBE">Enfidha</option>
                            <option value="TUN">Tunis - City Break</option>
                            <option value="-1"> </option>
                            <option value="DLM/BJV/AYT" style="font-weight:bold;">TURKEY (SEARCH ALL)</option>
                            <option value="DLM">Dalaman</option>
                            <option value="BJV">Bodrum Region</option>
                            <option value="AYT">Antalya Region</option>
                            <option value="ADB">Izmir</option>
                            <option value="SAW">Istanbul Sabiha - City Break</option>
                            <option value="IST">Istanbul Ataturk - City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">UNITED STATES OF AMERICA</option>
                            <option value="MIA">Miami - Breaks</option>
                            <option value="SFB">Orlando - Sanford</option>
                            <option value="MCO">Orlando - International</option>
                            <option value="TPA">Tampa international</option>
                            <option value="ATL">Atlanta - City Break</option>
                            <option value="BOS">Boston - City Break</option>
                            <option value="ORD">Chicago O&#39;Hare - City Break</option>
                            <option value="LAS">Las Vegas - City Break</option>
                            <option value="JFK">New York JFK - City Break</option>
                            <option value="EWR">New York Newark - City Break</option>
                            <option value="PHL">Philadelphia - City Break</option>
                            <option value="IAD">Washinton Dullas - City Break</option>
                            <option value="DCA">Washinton Ronald R - City Break</option>
                            <option value="-1"> </option>
                            <option value="-1" style="font-weight:bold;">UNITED ARAB EMIRATES (DUBAI)</option>
                            <option value="DXB">Dubai</option>
            </select>
            <div class="check" >
              <label>Check In Date:</label>
              <input type="text" id="datepicker1">
            </div>
            <div class="nights" >
              <label>Nights:</label>
              <select class="input-block-level">
                <option>---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="board" >
              <label>Board Basis:*</label>
              <select class="input-block-level">
               <option value="-1">---Select---</option>
                            <option value="AI">All Inclusive</option>
                            <option value="RO">Room Only</option>
                            <option value="BB">Bed and Breakfast</option>
                            <option value="SC">Self Catering</option>
                            <option value="HB">Half Board</option>
                            <option value="FB">Full Board</option>
                
              </select>
            </div>
            <div class="hotel_rooms" >
              <label>Rooms:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="hotel_adults" >
              <label>Adults:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="hotel_childerns" >
              <label>Childrens:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#0198cd; text-align:center;">(Age *2-12)</p>
            </div>
            <div class="hotel_infants">
              <label>infants:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
               <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#0198cd; text-align:center;">(Age *0-1)</p>
            </div>
            <div class="search" >
              <p class="sea">Search ></p>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="panel3">
        <div class="row-fluid">
          <div class="span5">
          <div class="flyform">
              <label>Fly From:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                
              </select>
            </div>
            <div class="travelto">
              <label>Travel To:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                
              </select>
            </div>
            <div class="flyform" >
              <label>Departure Date:</label>
              <input type="text" id="datepicker2">
            </div>
          
          
          
          
          <div class="travelto">
              <label>No Of Nights:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="adults" >
              <label>Adults:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
            <div class="childerns" >
              <label>Childrens:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#0198cd; text-align:center;">(Age *2-12)</p>
            </div>
            <div class="infants">
              <label>infants:</label>
              <select class="input-block-level">
                <option disabled="disabled" selected="selected">---Select---</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
              <p style="color:#0198cd; text-align:center;">(Age *0-1)</p>
            </div>
           <div class="search" >
              <p class="sea">Search ></p>
            </div>
             </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>