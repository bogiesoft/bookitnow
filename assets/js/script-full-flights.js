 $(function() {
 
	 
	 $('.bxslider1').bxSlider({
         minSlides: 4,
         maxSlides: 8,
         slideWidth: 360,
         slideMargin: 2,
         moveSlides: 1,
         responsive: true,
         nextSelector: '#slider-next',
         prevSelector: '#slider-prev',
         nextText: 'Onward →',
         prevText: '← Go back'
       });  
	 
	//Check to see if the window is top if not then display button
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		});
		
		//Click event to scroll to top
		$('.scrollToTop').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});

		      $("#slider").responsiveSlides({
		      	auto: true,
		      	nav: true,
		      	speed: 500,
		        namespace: "callbacks",
		        pager: true,
		      });
		  
			
	// Datepicker
	var dateToday = new Date();
	$("#datepicker").datepicker({
		defaultDate: "+1w",	   
		minDate: dateToday,  
		dateFormat: "dd/mm/yy"
	});
    //$( "#datepicker" ).datepicker();
    $( "#datepicker1" ).datepicker();
    $( "#datepicker2" ).datepicker();
	
	
	
		
		/*-------------- fetch the arrivals list based on destination selection ------------------*/
		
		$('.flyform select').change(function(){
			
			if($(this).val() == null || $(this).val() == '' || $(this).val() == -1 )
			{
				alert("Please choose proper destination");
			}
			else
			{
				var request_data = {};
				request_data.dest_shrtcode = $(this).val();	

				blockSearchingTabs();
				$.post( "welcome/fetch_results",request_data, function( data ) {					
					  $('.travelto select').html('');	
					  $('.travelto select').append(data);	
					  unblockSearchingTabs();
					  $.cookie('selected_dept_cookie', request_data.dest_shrtcode);	
					}, "html");
			}
		});
		
		$('select[name="arrival_airports"]').change(function(){
			
			if($(this).val() == null || $(this).val() == '' || $(this).val() == -1 )
			{
				alert("Please choose proper destination");
			}
			else
			{
				$.cookie('selected_arrival_cookie', $(this).val());			
			}
		});
		
		
		
		$('form[name="flight_hotel_form"]').submit(function(){
			var request_data = $(this).serializeArray();
			var count = 0;
			$.each(request_data, function(index, value){				
				if(value.name != 'children' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{
					alert('Please select '+ value.name +' field');
					count++;
					return false;
				}
			});
			if(count)return false;		
			$.post( "welcome/fetch_filtered_flights",request_data, function( data ) {
				
				if(data == 'notavailable')
				{
					window.location = "notavailable";
				}
				else
				{
					window.location = data;
				}
				  /*$('.travelto select').html('');	
				  $('.travelto select').append(data);	
				  unblockSearchingTabs();*/
				}, "html");
			return false;
		});
		
		
		
		$(document.body).on('click', '.pager_list_pages a ' ,function(){
			blockSearchingTabs();
			$( '<a class="pagerhyperlink">'+$('.pager_list_pages span').html()+'</a>').insertAfter( ".pager_list_pages span" );
			$( ".pager_list_pages span" ).remove();			
			var clicked_val = $(this).html();
			$( '<span>'+clicked_val+'</span>').insertAfter( this );			
			$(this).remove();	
			var date = $('li.current').find('.current_date').attr('dt');
			filterFlightsNHotels(flight_crypt,'flight_date',date,parseInt(clicked_val));			
		});	
		
		$(document.body).on('click','#tabs_flights li:not(.current)',function(){			
			blockSearchingTabs();
			$('li.current').removeClass('current');
			$(this).addClass('current');	
			var date = $(this).find('div.current_date').attr('dt');
			filterFlightsNHotels(flight_crypt,'flight_date',date,1);			
		})
		
		
		$('select[name="rooms"]').change(function(){
			var str='';
			
			for(var i=$(this).val();i<=($(this).val() * 4 );i++)
			{
				str += '<option>'+i+'</option>';
			}
			$.cookie('selected_rooms_cookie', $(this).val());			
			$.cookie('adults_html_cookie', str);
			$('select[name="adults"]').html(str);
		});
		
		$('select[name="adults"]').change(function(){			
			$.cookie('selected_adults_cookie', $(this).val());	
		});		
		
		$('select[name="nights"]').change(function(){
			$.cookie('selected_nights_cookie', $(this).val());
		});
		$('input[name="departure_date"]').change(function(){			
			$.cookie('selected_date_cookie', $(this).val());
		});
		
		/*
		 * Populate form with required things with cookie values during page refresh
		 */	
		
		if($.cookie('adults_html_cookie') != 'undefined')
		{			
			$('select[name="adults"]').html($.cookie('adults_html_cookie'));
		}
		if($.cookie('selected_date_cookie') != 'undefined')
		{	
			$('input[name="departure_date"]').val($.cookie('selected_date_cookie'));
		}
		
		$('select[name="rooms"] option[value='+$.cookie('selected_rooms_cookie')+']').attr('selected','selected');			
		$('select[name="adults"] option[value='+$.cookie('selected_adults_cookie')+']').attr('selected','selected');			
		$('select[name="nights"] option[value='+$.cookie('selected_nights_cookie')+']').attr('selected','selected');
		
		if($.cookie('selected_dept_cookie') != -1 || $.cookie('selected_dept_cookie') != '')
		{			
			$('select[name="departure_airports"] option[value="'+$.cookie('selected_dept_cookie')+'"]').attr('selected','selected');
			
			var request_data = {};
			request_data.dest_shrtcode = $.cookie('selected_dept_cookie');				
			$.post( "welcome/fetch_results",request_data, function( data ) {				
				  $('.travelto select').html('');
				  $('.travelto select').append(data);
				  if($.cookie('selected_arrival_cookie') != -1  || $.cookie('selected_dept_cookie') != '')
				  {
					  $('select[name="arrival_airports"] option[value='+$.cookie('selected_arrival_cookie')+']').attr('selected','selected');
				  }
				}, "html");
		}
		
		
	
		/*
		 * filtration
		 */
		
		$('input[type="checkbox"]').change(function(){	
			blockSearchingTabs();
			if($(this).closest('.has_bottom_margin').attr('id') == 'all_operators' && $(this).prop("checked") == true && $(this).val() != 'ALL'){
				$('#FlightFilterAllOperator').attr('checked',false);
			}
			if($(this).closest('.has_bottom_margin').attr('id') == 'all_departures' && $(this).prop("checked") == true && $(this).val() != 'ALL'){
				$('#FlightFilterAll').attr('checked',false);	
			}
			if($(this).closest('.has_bottom_margin').attr('id') == 'all_operators' && $(this).prop("checked") == true && $(this).val() == 'ALL'){
				$('#all_operators input[type="checkbox"]').attr('checked',false);
				$(this).attr('checked',true);
				
			}
			if($(this).closest('.has_bottom_margin').attr('id') == 'all_departures' && $(this).prop("checked") == true && $(this).val() == 'ALL'){
				$('#all_departures input[type="checkbox"]').attr('checked',false);
				$(this).attr('checked',true);	
			}
			//console.log(checkedValues);return false;
				var date = $('li.current').find('.current_date').attr('dt');
			filterFlightsNHotels(flight_crypt,'flight_date',date,1);	
		});	
		
	$('#da-slider').cslider({
	         autoplay    : true,
	         bgincrement : 100
	       });
	
		
 });
		
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
        
        //Range - Sliders
        setsliderDepartTime(flight_crypt,mintime,maxtime,minrange,maxrange);
        function setsliderDepartTime(flight_crypt,mintime,maxtime,minrange,maxrange)
        {
        	
        	$("#slider-range").slider({
                range: true,
                min: minrange,
                max: maxrange,
                values: [mintime, maxtime],          
                slide: function (event, ui) {            	
                    $("#timerange").val(ui.values[0] + ":00 - " + ui.values[1] + ":00");                
                },
                change: function (event, ui) {     
                	blockSearchingTabs();
                	var date = $('li.current').find('.current_date').attr('dt');
                   filterFlightsNHotels(flight_crypt,'flight_date',date,1);
    			}

            });
            $("#timerange").val($("#slider-range").slider("values", 0) + ":00 - " + $("#slider-range").slider("values", 1) + ":00");
       
        }
        setsliderReturnTime(flight_crypt,mintime_R,maxtime_R,minrange_R,maxrange_R);
        function setsliderReturnTime(flight_crypt,mintime,maxtime,minrange,maxrange)
        {      
        	
	        $("#slider-rangereturn").slider({
	            range: true,
	            min: minrange,
	            max: maxrange,
	            values: [mintime, maxtime],          
	            slide: function (event, ui) {            	
	                $("#timerangereturn").val(ui.values[0] + ":00 - " + ui.values[1] + ":00");                
	            },	
	            change: function (event, ui) {
	            	blockSearchingTabs();
	            	var date = $('li.current').find('.current_date').attr('dt');
	            	filterFlightsNHotels(flight_crypt,'flight_date',date,1);
				}
	
	        });
	        $("#timerangereturn").val($("#slider-rangereturn").slider("values", 0) + ":00 - " + $("#slider-rangereturn").slider("values", 1) + ":00");
        }
        
        function filterFlightsNHotels(flight_crypt,type,date,page)
        {       	
        	var checkedValues = {};
			checkedValues['departures'] = $('#all_departures input:checkbox:checked').map(function() {
			    return this.value;
			}).get();
			checkedValues['operators'] = $('#all_operators input:checkbox:checked').map(function() {
			    return this.value;
			}).get();
			
			if(checkedValues['departures'].length == 0)
			{
				checkedValues['departures'] = ['ALL'];
			}
			if(checkedValues['operators'].length == 0)
			{
				checkedValues['operators'] = ['ALL'];
			}
			$.post("/welcome/filter_flights_fun",{'checkedValues':checkedValues,'searchType':type,crypt:flight_crypt,date:date,deptRange:$("#timerange").val(),returnRange:$("#timerangereturn").val(),page:page},function(data){
				$.each(data[1].best_prices, function(index, value) {
					$('div.current_date[dt="'+index+'"]').next('small').text((data[1].num_flights)[index] +' flights from');
					$('div.current_date[dt="'+index+'"]').nextAll('strong.price').html('&euro;'+value);
				});
				//console.log(data[1]);return false;
				if(data[0].status == 'success')
				{					
					$('#DateMinus3').html(data[0].data);
					$('#pager_list').html(data[0].pages_data);
					
					unblockSearchingTabs();
					
				}
				else
				{
					unblockSearchingTabs();
					alert('Sorry, No records found');
				}
				
			}, "json");
        }
        
        function hotels_form()
        {
        	alert('hello');
        	return false;
        }
