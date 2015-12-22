 $(function() {
	
		if($.cookie('notavailable_info') != '' || $.cookie('notavailable_info') != undefined || $.cookie('notavailable_info') != null)
		{
			$('#no_res').html($.cookie('notavailable_info'));
		}
	 
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
		
		
		
		/*$('form[name="flight_hotel_form"]').submit(function(){
			var request_data = $(this).serializeArray();
			var count = 0;
			$.each(request_data, function(index, value){				
				if(value.name != 'childrens' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
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
				
				}, "html");
			return false;
		});
		*/
		
		
		$(document.body).on('click', '.pager_list_pages a ' ,function(){
			blockSearchingTabs();
			$( '<a class="pagerhyperlink">'+$('.pager_list_pages span').html()+'</a>').insertAfter( ".pager_list_pages span" );
			$( ".pager_list_pages span" ).remove();			
			var clicked_val = $(this).html();
			$( '<span>'+clicked_val+'</span>').insertAfter( this );			
			$(this).remove();	
			var date = $('li.current').find('.current_date').attr('dt');
			filterFlightsNHotels(flight_crypt,$type_flight,date,parseInt(clicked_val));			
		});	
		
		$(document.body).on('click','#tabs_flights li:not(.current)',function(){			
			blockSearchingTabs();
			$('li.current').removeClass('current');
			$(this).addClass('current');	
			var date = $(this).find('div.current_date').attr('dt');
			filterFlightsNHotels(flight_crypt,$type_flight,date,1);			
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
//			$.post( "welcome/fetch_results",request_data, function( data ) {				
//				  $('.travelto select').html('');
//				  $('.travelto select').append(data);
//				  if($.cookie('selected_arrival_cookie') != -1  || $.cookie('selected_dept_cookie') != '')
//				  {
//					  $('select[name="arrival_airports"] option[value='+$.cookie('selected_arrival_cookie')+']').attr('selected','selected');
//				  }
//				}, "html");
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
			filterFlightsNHotels(flight_crypt,$type_flight,date,1);	
		});	
		
		$('select[name="full_rooms"]').change(function(){
			var str='';
			
			for(var i=$(this).val();i<=($(this).val() * 4 );i++)
			{
				str += '<option>'+i+'</option>';
			}			
			$('select[name="full_adults"]').html(str);
		});
		
		
		$('form[name="flight_hotel_form"]').submit(function(){
			var request_data = $(this).serializeArray();
			var count = 0;
			$.each(request_data, function(index, value){				
				if(value.name != 'childrens' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{
					alert('Please select '+ value.name +' field');
					count++;
					return false;
				}
			});
			if(count)return false;	
			
			var str = '';       	
        	
        	str += $('select[name="departure_airports"] option:selected').text() +' to '
        				+ $('select[name="arrival_airports"] option:selected').text() +'. '
        				+ $('input[name="departure_date"]').val() +'. '
        				+ $('select[name="nights"] option:selected').text() + ' nights.';
        				
        	
        	
        	
        		var html = '<div style="text-align:center;"> <img src="/images/logo.png"/></div><div class="center wait_page" style="text-align:center;"><div class="sprite logo has_bottom_margin"></div><br><span style="display: none;"><span >Searching For Flights</span></span><div class="wait_page_section"><h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;letter-spacing: 0.5px;">Checking Flights Availability</h2></div><div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"><h4 class="txt_color_1"><span>'+str+'</span></h5> <div class="wait_page_loading"> <img src="/images/loader-bar.gif"></div><br>Please Wait a Moment Whilst We Get you The Best Rates...</div><div><h4><strong>Book With Confidence</strong></h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"><img src="/images/abta.png"/></div></div></div>';
                $.fancybox({
                	content : html,
                	'width':'500',
                	'height' : '400',
                    'autoDimensions':false,
                    'type':'iframe',
                    'autoSize':false,
                    'showCloseButton': false,
                    'helpers'   : { 
                        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
                       },
        			});
                $('.fancybox-overlay').css('background','#fff');      
                $('.fancybox-close').hide();
                $('.fancybox-close').css('display','none');

			
			
			$.post( "/welcome/fetch_filtered_flights",request_data, function( data ) {
				
				if(data == 'notavailable')
				{
					var date = new Date();
		        	date.setTime(date.getTime() + (60 * 1000));
		        	$.cookie('notavailable_info', str, { expires: date });	
					window.location = baseUrl + "notavailable";
				}
				else
				{
					if(Number($('select[name="departure_airports"]').val()) !== -1)
					$.cookie('selected_dept_cookie', $('select[name="departure_airports"]').val());
					if(Number($('select[name="arrival_airports"]').val()) !== -1)
     				$.cookie('selected_arrival_cookie', $('select[name="arrival_airports"]').val());
					$.cookie('selected_nights_cookie',$('select[name="nights"]').val());                			
        			$.cookie('selected_date_cookie', $('input[name="departure_date"]').val());
					window.location = baseUrl + data;
				}				
				}, "html");
			return false;
		});

		
				
//	$('#da-slider').cslider({
//	         autoplay    : true,
//	         bgincrement : 100
//	       });
	
		
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
                   filterFlightsNHotels(flight_crypt,$type_flight,date,1);
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
	            	filterFlightsNHotels(flight_crypt,$type_flight,date,1);
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
				//console.log(data);return false;
				$.each(data[1].best_prices, function(index, value) {
					$('div.current_date[dt="'+index+'"]').next('small').text((data[1].num_flights)[index] +' flights from');
					$('div.current_date[dt="'+index+'"]').nextAll('strong.price').html('&#163;'+value);
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
        
        
        function Addflight(type,info,segment)
        {  
        	
        	var html = '<div style="text-align:center;"> <img src="/images/logo.png"/></div><div class="center wait_page" style="text-align:center;"><br><span style="display: none;"><span >Searching For Flights</span></span><div class="wait_page_section"><h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;letter-spacing: 0.5px;">Your Flights Have Been Added.</h2></div><div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"><h3 class="txt_color_1">Now Checking Hotel Availability</h3> <div class="wait_page_loading"> <img src="/images/loader-bar.gif"></div><br>Please Wait a Moment Whilst We Get you The Best Rates...</div><div><h4><strong>Book With Confidence</strong></h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"><img src="/images/abta.png"/></div></div></div>';
            $.fancybox({
            	content : html,
            	'width':'500',
            	'height' : '400',
                'autoDimensions':false,
                'type':'iframe',
                'autoSize':false,
                'showCloseButton': false,
                'helpers'   : { 
                    overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
                   },
    			});
            $('.fancybox-overlay').css('background','#fff');      
            $('.fancybox-close').hide();
            $('.fancybox-close').css('display','none');
        	
        	$.post("/welcome/saveflight_fun",{'searchType':type,'crypt_text':info,'crypt':segment,'dt':$('li.current a div.current_date').attr('dt')},function(data){
        	
        		if(data == 'notavailable')
				{
					window.location = "notavailable";
				}
				else
				{
					window.location = data;
				}
        	});      	
        }
        
        function full_pack_submit(e)
        {
        	
       		//$('form[name="full_pack_form"]').on( "submit",function(){ 
       			
    			var request_data = $(e).serializeArray();
    			
    			var arr_val = $('select[name="full_arrival_airports"]').val();
    			    			
    			var count = 0;
    			$.each(request_data, function(index, value){				
    				if(value.name != 'full_children' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
    				{
    					var msg = $('[name="'+ value.name +'"]').prev('label').text();
    					alert('Please select '+ msg +' field');
    					//alert('Please select '+ value.name +' field');
    					count++;
    					return false;
    				}
    			});
    			if(count)return false;	  			
    		
    			var t = {};
    			t['name'] = 'mapper';
    			t['value'] = $('select[name="full_arrival_airports"] option[value="'+arr_val+'"]').attr('mapper');
    			request_data.push(t);    			
    			if(Number($('select[name="full_adults"]').val()) >= 10)
    			{
    				var mformData ={};     				
    				/*mformData['Fly_From'] = $('[name="full_departure_airports"] option:selected').text();
    				mformData['Travel_To'] = $('[name="full_arrival_airports"] option:selected').text();
    				mformData['Departure_Date'] = $('[name="full_departure_date"]').val();
    				mformData['Rooms'] = $('[name="full_rooms"] option:selected').text();
    				mformData['Nights'] = $('[name="full_nights"] option:selected').text();
    				mformData['Adults'] = $('[name="full_adults"] option:selected').text();
    				mformData['Children'] = $('[name="full_children"] option:selected').text();*/
    				$('.noFlight,.noHotel').show();
    				$('.noFull').hide();
    				bulkForm(mformData,'full');
    				return false;
    			}
    			
    			
    			/****************Room parllalization**************/
    			
    			if($('select[name="full_children"]').val() >= 1 && !isNaN($('select[name="full_rooms"]').val()) && $('select[name="full_rooms"]').val() > 1)
    			{
    				var str = '';
    				$.fancybox({
                        'href': '#rooms_div',
                        beforeShow: function() {
                            this.wrap.draggable();
                        },
                       
                    });
    				
    				
    				$('#rooms_form').html(str);
    				//var kp = "onkeypress='return event.charCode >= 48 && event.charCode <= 57'";
    				var kp = "";
    				if(Number($('select[name="full_rooms"]').val()) > Number($('select[name="full_adults"]').val()))
    				{
    					$('select[name="full_rooms"]').val($('select[name="full_adults"]').val());
    				}
    				for(var i=1;i<=$('select[name="full_rooms"]').val();i++)
        			{
    					if((i%2)== 1)
    					{
    						str += '<div class="row form-pop-container"><div class="col-md-12">';
    					}
    					str += '<div class="form-group"><p>Room-'+i+'</p>';
    					str += '<input class="form-control room_box_adult" placeholder="Adults" style="150px;" name="num_adult_'+i+'">';
    					str += '<input name="num_child_'+i+'" class="form-control room_box_child" placeholder="Children"></div>';							
    					if(!(i%2) || i == $('select[name="full_rooms"]').val())
    					{
    						str += '</div></div><br>';
    					}
        				//str +=  '<div class="form-group"><label for="email">Room - '+i+':</label><input type="text" '+kp+' class="form-control room_box_adult" placeholder="Number of Adults" name="num_adult_'+i+'"><p class="err_room"></p><input type="text" '+kp+' name="num_child_'+i+'" class="form-control room_box_child" placeholder="Number of Childeren"></div>';    					
        			}
    					//str += '<span class="err_msg"></span><button class="btn btn-primary" type="submit"> CONTINUE</button>';
    				str += ' <div class="col-md-12"><span class="err_room"></span><span class="err_msg"></span><P class="btn-pop"><button class="btn btn-primary-pop" type="submit"> CONTINUE</button> </p></div>';
    				$('#rooms_form').html(str);
    				$.cookie('mul_submition_prevent',1);
    				$('#rooms_form').on( "submit",function(e){
    					
    					
    					
    					var cunt_ad = 0;
    					$('.room_box_adult').each(function(){
    						$(this).next('.err_room').html("");
    						if(parseInt($(this).val()) > 0){    							
    							cunt_ad = cunt_ad +  parseInt($(this).val());
    						}
    						else{    							
    							$(this).next('.err_room').html("Please fill all rooms with atleast one adult" );  
    							return false;
    						}
    					});
    					$('.err_msg').html('');
    					if(cunt_ad != parseInt($('select[name="full_adults"]').val()))
    					{
    						$('.err_msg').html('Adults count not matched with given count');
    						return false;
    					}
    					var cunt_ch = 0;
    					$('.room_box_child').each(function(){
    						
    						if(parseInt($(this).val()) > 0){    							
    							cunt_ch = cunt_ch +  parseInt($(this).val());
    						}
    					});
    					if(cunt_ch != parseInt($('select[name="full_children"]').val()))
    					{
    						$('.err_msg').html('Children count not matched with given count');
    						return false;
    					}
    					//Multi submit issue occuring
    					var room_data = $(this).serializeArray();
    					var count = 1;
    					var str = '';
    					for (var i=0;i<room_data.length;i++) {
    						if(room_data[i].name == "num_adult_"+ count +"")
    						{
    							str += room_data[i].value + '-';
    						}
    						else if(room_data[i].name == "num_child_"+ count +"")
    						{
    							if(room_data[i].value == '')room_data[i].value = 0;
    							str += room_data[i].value + ',';
    							count++;
    						}    					   
    					}
    					
    					
    					var t = {};
    					t['name'] = 'pax';
    					t['value'] = str;
    					
    					request_data.push(t);    					
    					submit_fnh_fun(request_data);	
    					$('.fancybox-close').trigger('click');
    					return false;
    				});
    				
    				
    			}
    			else if(!isNaN($('select[name="full_rooms"]').val()) && $('select[name="full_rooms"]').val() > 1 && $('select[name="full_rooms"]').val() < Number($('select[name="full_adults"]').val()))
    			{
    				var str = '';
    				
    				$divi =  Math.floor(Number($('select[name="full_adults"]').val()) / Number($('select[name="full_rooms"]').val()));
    				$rem = Number($('select[name="full_adults"]').val()) % Number($('select[name="full_rooms"]').val());
    				str += $divi + '-' + 0 + ',';
    				str += ($divi + $rem) + '-' + 0 + ',';   
    				var t = {};
					t['name'] = 'pax';
					t['value'] = str;
					request_data.push(t);    
					$.cookie('mul_submition_prevent',1);
					submit_fnh_fun(request_data);
					return false;    				
    			}
    			else{
    				$.cookie('mul_submition_prevent',1);
    				submit_fnh_fun(request_data);  	
    				return false;
    			}		
    			
    			/******************end****************************/
    				
    			return false;
    		
        }
        
        
        function submit_fnh_fun(request_data)
        {        
        	var str = '';       	
        	if(isNaN(Number($('select[name="full_children"] option:selected').text())))var t = 0;
    		else t = $('select[name="full_children"] option:selected').text();
        	str += $('select[name="full_departure_airports"] option:selected').text() +' to '
        				+ $('select[name="full_arrival_airports"] option:selected').text() +'. '
        				+ $('input[name="full_departure_date"]').val() +'. '
        				+ $('select[name="full_nights"] option:selected').text() + ' nights.'
        				+ $('select[name="full_adults"] option:selected').text() + ' Adult(s) '
        				+ t + ' Child(ren). '
        				+ $('select[name="full_rooms"] option:selected').text() + ' Room(s)';
        	
        	
        	
        	var html = '<div style="text-align:center;"> <img src="/images/logo.png"/></div><div class="center wait_page" style="text-align:center;"><div class="sprite logo has_bottom_margin"></div><br><span style="display: none;"><span >Searching For Hotels</span></span><div class="wait_page_section"><h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;letter-spacing: 0.5px;">Checking Hotels Availability</h2></div><div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"><h4 class="txt_color_1"><span>'+str+'</span></h5> <div class="wait_page_loading"> <img src="/images/loader-bar.gif"></div><br>Please Wait a Moment Whilst We Get you The Best Rates...</div><div><h4><strong>Book With Confidence</strong></h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"><img src="/images/abta.png"/></div></div></div>';
            $.fancybox({
            	content : html,
            	'width':'500',
            	'height' : '400',
                'autoDimensions':false,
                'type':'iframe',
                'autoSize':false,
                'showCloseButton': false,
                'helpers'   : { 
                    overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
                   },
    			});
            $('.fancybox-overlay').css('background','#fff');      
            $('.fancybox-close').hide();
            $('.fancybox-close').css('display','none');
            	
            	
            
        	
        	
        	if($.cookie('mul_submition_prevent') == 1)
        	{          		
        		$.cookie('mul_submition_prevent',0);
	        	$.post( baseUrl + "welcome/check_results_for_full_pack_fun",request_data, function( data ) {
	        		
					if(data == 'notavailable')
					{		        	
			        	var date = new Date();
			        	date.setTime(date.getTime() + (60 * 1000));
			        	$.cookie('notavailable_info', str, { expires: date });	
						window.location = baseUrl + "notavailable";
						
					}
					else
					{	
						if(Number($('select[name="full_departure_airports"]').val()) !== -1 )
						$.cookie('selected_full_dept_cookie', $('select[name="full_departure_airports"]').val());
						if(Number($('select[name="full_arrival_airports"]').val()) !== -1 )
						$.cookie('selected_full_arrival_cookie', $('select[name="full_arrival_airports"]').val());
						var str='';
			    		for(var i=$('select[name="full_rooms"]').val();i<=($('select[name="full_rooms"]').val() * 4 );i++)
			    		{
			    			str += '<option>'+i+'</option>';
			    		}
			    		$.cookie('selected_full_rooms_cookie', $('select[name="full_rooms"]').val());			
			    		$.cookie('full_adults_html_cookie', str);		    		
			    		$.cookie('selected_full_adults_cookie', $('select[name="full_adults"]').val());	
			    		$.cookie('selected_full_nights_cookie', $('select[name="full_nights"]').val());
			    		$.cookie('selected_full_date_cookie', $('input[name="full_departure_date"]').val());
			    		window.location = baseUrl + data;
					}				
				}, "html");
        	}
        }

    	function arrivals(code,target){		
    		var request_data = {};
    		request_data.dest_shrtcode = code;
    		$(target).html('');	
    		if(Number(code) != -1)
    		$.post( "/welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {
    				$(target).append(data);   					 	
    			}, "html");
    		
    	}
    	 function bulkForm(mformData,type){  
      	   var dateToday = new Date();
      	   $('.datePicker').datepicker({
      			defaultDate: "+1w",	   
      			minDate: dateToday,  
      			dateFormat: "dd/mm/yy"
      		});      
      	   $('#bulk_form').trigger("reset");
      	   $.fancybox({
                 'href': '#bluk_div',            
                 beforeShow: function() {
                     this.wrap.draggable();
                 },              
             });
      	   $('#arrival_airports_p').html('');
      	   if(type == 'full'){
  			   var excludeFields = ['check_in_date','Children'];     			 
  		   }
  		   if(type == 'hotel'){
  			   arrivals("ALL",document.getElementById('arrival_airports_p'));
  			   var excludeFields = ['fly_from','Children','Date_of_departure'];
  		   }
  		   if(type == 'flight'){
  			   var excludeFields = ['check_in_date','rooms','Children','Date_of_departure'];
  		   }
      	   $('#bulk_form').submit(function(){    		
      		   var bformData = $(this).serializeArray();
      		   var swap ={};
      		   var count = 0;   		   
      		   $.each(bformData, function(index, value){
      			   
      			   if((value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == '') && ($.inArray(value.name, excludeFields) == -1) )
     					{
  	   					var msg = $('[name="'+ value.name +'"]').attr('placeholder');
  	   					alert('Please fill '+ value.name +' field');   
  	   					count++;
  	   					return false;
  	   					
     					}
      			   else{
      				   if(value.name == 'fly_from' || value.name == 'travel_to')
      				   {
      					   if($.inArray(value.name, excludeFields) == -1)bformData[index]['value'] = $('select[name="'+value.name+'"] option:selected').text();    					  
  	    			   }	
      			   }
  	    			   if(value.name == 'email' && !validateEmail(value.value))
  	       			   {
  	    				  alert('Please enter valid email address'); 
  	    				   count++;
  		   					return false; 
  		   					
  	       			   }
  	    			   if(value.name == 'mobile' && !phonenumber(value.value)){
  	    				   alert('Please enter valid mobile number');
  	    				   count++;
  		   					return false; 
  	    			   }
  	    			   
  	    			  	   
  	    			   
     			   });  

      		 //  console.log(bformData);return false;

      		   if(count)return false;
      		 
      		   $.post( baseUrl + "welcome/bulkSubmit",{bformData}, function( data ) {
      			   alert('Thank you,We will contact you soon');
      			   window.location = '/';    			   
      		   },'json');  		  
      		   return false;
      	   })
         }      
    	 function validateEmail(email) {
             var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
             return re.test(email);
         }
    	 function phonenumber(inputtxt)
         {
           var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
           if(inputtxt.match(phoneno))
                 {
         	  		return true;
                 }
               else
                 {
                 
                 return false;
                 }
         }
      