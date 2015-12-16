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

		      
		 
			
	// Datepicker
	var dateToday = new Date();
	$("#datepicker,#datepicker1,#datepicker3").datepicker({
		defaultDate: "+1w",	   
		minDate: dateToday,  
		dateFormat: "dd/mm/yy"
	});    
   
	if ($("#slider").length)
    	$("#slider").responsiveSlides({
          	auto: true,
          	nav: true,
          	speed: 500,
            namespace: "callbacks",
            pager: true,
          });
	
    $('ul.nav-tabs li').click(function(){
    	
    	if($(this).find('a').attr('href') == '#panel3')
    	{    		
    		if($(this).attr('class') == 'hotel')justAHotel('#panel3');
    	}
    	else if($(this).find('a').attr('href') == '#panel1')
    	{   
    		
    		if($(this).attr('class') == 'flight')justAFlight('#panel1');
    	}
    	else
    	{
    	
    		justAFlightNHotel('#panel2');
    		//alert($.cookie('actve_tab_cookie'))
    		//if($(this).attr('class') == 'active-item flight')
    			
    	}
    });
    
    if($.cookie('actve_tab_cookie') != undefined)
	{
    	
    	$('a[href="'+$.cookie('actve_tab_cookie')+'"]').trigger('click');
    	/*if($.cookie('actve_tab_cookie') == '#panel3')justAHotel('#panel3');
    	else if($.cookie('actve_tab_cookie') == '#panel2')justAFlightNHotel('#panel2');
    	else justAFlight('#panel1');*/
    	
	}
    else
    {
    	justAFlightNHotel('#panel2');
    }   
		
    
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
        function room_parllalization(request_data)
        {
        	
        	if($('select[name="hotel_childrens"]').val() >= 1 && !isNaN($('select[name="hotel_rooms"]').val()) && $('select[name="hotel_rooms"]').val() > 1)
			{
				var str = '';
				$.fancybox({
                    'href': '#rooms_div',
                    beforeShow: function() {
                        this.wrap.draggable();
                    }
                });
				
				
				$('#rooms_form').html(str);
				//var kp = "onkeypress='return event.charCode >= 48 && event.charCode <= 57'";
				var kp = "";
				if(Number($('select[name="hotel_rooms"]').val()) > Number($('select[name="hotel_adults"]').val()))
				{
					$('select[name="hotel_rooms"]').val($('select[name="hotel_adults"]').val());
				}
				
				
				
				
				for(var i=1;i<=$('select[name="hotel_rooms"]').val();i++)
    			{
					if((i%3)== 1)
					{
						str += '<div class="row form-pop-container"><div class="col-md-12">';
					}
					str += '<div class="form-group"><p>Room-'+i+'</p>';
					str += '<input class="form-control room_box_adult" placeholder="Adults" style="150px;" name="num_adult_'+i+'">';
					str += '<input name="num_child_'+i+'" class="form-control room_box_child" placeholder="Children"></div>';							
					if(!(i%3) || i == $('select[name="hotel_rooms"]').val())
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
					if(cunt_ad != parseInt($('select[name="hotel_adults"]').val()))
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
					if(cunt_ch != parseInt($('select[name="hotel_childrens"]').val()))
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
					submit_fnh_hotel_fun(request_data);	
					$('.fancybox-close').trigger('click');
					return false;
				});
				
				
			}
			else if(!isNaN($('select[name="hotel_rooms"]').val()) && $('select[name="hotel_rooms"]').val() > 1 && $('select[name="hotel_rooms"]').val() < Number($('select[name="hotel_adults"]').val()))
			{
				
				var str = '';
				
				$divi =  Math.floor(Number($('select[name="hotel_adults"]').val()) / Number($('select[name="hotel_rooms"]').val()));
				$rem = Number($('select[name="hotel_adults"]').val()) % Number($('select[name="hotel_rooms"]').val());
				str += $divi + '-' + 0 + ',';
				str += ($divi + $rem) + '-' + 0 + ',';   
				var t = {};
				t['name'] = 'pax';
				t['value'] = str;
				request_data.push(t);    
				$.cookie('mul_submition_prevent',1);
				submit_fnh_hotel_fun(request_data);
				return false;    				
			}
			else{
				
				$.cookie('mul_submition_prevent',1);
				submit_fnh_hotel_fun(request_data);  	
				return false;
			}		
			
			/******************end****************************/
			
        }
               
        function hotelsForm(e)
        {        	
			var request_data = $(e).serializeArray();
	        
			var count = 0;
			$.each(request_data, function(index, value){				
				if(value.name != 'hotel_childrens' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{
					var msg = $('[name="'+ value.name +'"]').prev('label').text();
					//alert('Please select '+ msg +' field');
					count++;
					return false;
				}
			});
			if(count)return false;		
			//blockSearchingTabs();
			var t = {};
			var arr_val = $('select[name="hotel_travel_to"]').val();
			t['name'] = 'mapper';
			t['value'] = $('select[name="hotel_travel_to"] option[value="'+arr_val+'"]').attr('mapper');
			request_data.push(t);
			if(Number($('select[name="hotel_adults"]').val()) >= 10)
			{				
				var mformData ={}; 
				mformData['Travel_To'] = $('[name="hotel_travel_to"] option:selected').text();
				mformData['Departure_Date'] = $('[name="hotel_check_in_date"]').val();
				mformData['Rooms'] = $('[name="hotel_rooms"] option:selected').text();
				mformData['Nights'] = $('[name="hotel_nights"] option:selected').text();
				mformData['Adults'] = $('[name="hotel_adults"] option:selected').text();
				mformData['Children'] = $('[name="hotel_childrens"] option:selected').text();    				
				bulkForm(mformData);
				return false;
			}
			room_parllalization(request_data);
			return false;
        	
        }
        
        function justAHotel(tab)
        {
        	/*
    		 * Start - Hotels form js
    		 */	 	
    		$('select[name="hotel_rooms"]').change(function(){			
    			var str='';			
    			for(var i=$(this).val();i<=($(this).val() * 4 );i++)
    			{
    				str += '<option>'+i+'</option>';
    			}
    			//$.cookie('selected_hotel_rooms_cookie', $(this).val());			
    			//$.cookie('hotel_adults_html_cookie', str);
    			$('select[name="hotel_adults"]').html(str);
    		});
    		
    		
//    		$('select[name="hotel_adults"]').change(function(){			
//    			$.cookie('selected_hotel_adults_cookie', $(this).val());	
//    		});		
//    		
//    		$('select[name="hotel_nights"]').change(function(){
//    			$.cookie('selected_hotel_nights_cookie', $(this).val());
//    		});
//    		$('input[name="hotel_check_in_date"]').change(function(){			
//    			$.cookie('selected_hotel_date_cookie', $(this).val());
//    		});
//    		
//    		$('select[name="hotel_travel_to"]').change(function(){			
//    			$.cookie('selected_hotel_travel_to_cookie', $(this).val());	
//    		});		
    		/*
    		 * Populate form with required things with cookie values during page refresh
    		 */	
    		
    		if($.cookie('hotel_adults_html_cookie') != 'undefined')
    		{			
    			$('select[name="hotel_adults"]').html($.cookie('hotel_adults_html_cookie'));
    		}
    		
    		if($.cookie('selected_hotel_date_cookie') != 'undefined')
    		{	
    			$('input[name="hotel_check_in_date"]').val($.cookie('selected_hotel_date_cookie'));
    		}
    		
    		$('select[name="hotel_rooms"] option[value='+$.cookie('selected_hotel_rooms_cookie')+']').attr('selected','selected');			
    		$('select[name="hotel_adults"] option[value='+$.cookie('selected_hotel_adults_cookie')+']').attr('selected','selected');			
    		$('select[name="hotel_nights"] option[value='+$.cookie('selected_hotel_nights_cookie')+']').attr('selected','selected');
    		$('select[name="hotel_travel_to"] option[value="'+$.cookie('selected_hotel_travel_to_cookie')+'"]').attr('selected','selected');
    		
    		$.cookie('actve_tab_cookie',tab);
    		/*
    		 * End -  Hotels form js
    		 */
    		
    		 //roomBase_hotel();
    	
        }
        
        
        
        function justAFlight(tab){
        	  	
       
        	/*
        	 * Start - Flights form js
        	 */
        	
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
        				$.post( "/welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {	
        					  $('.travelto select').html('');	
        					  $('.travelto select').append(data);       					  
        					  unblockSearchingTabs();        					 	
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
        				 
        			}
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

        			
        			
        			$.post( baseUrl + "welcome/fetch_filtered_flights",request_data, function( data ) {
        				
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
        		
        		
        		
//        		$('select[name="rooms"]').change(function(){
//        			var str='';
//        			
//        			for(var i=$(this).val();i<=($(this).val() * 4 );i++)
//        			{
//        				str += '<option>'+i+'</option>';
//        			}
//        			$.cookie('selected_rooms_cookie', $(this).val());			
//        			$.cookie('adults_html_cookie', str);
//        			$('select[name="adults"]').html(str);
//        		});        		
        		
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
        		
        		if($.cookie('selected_dept_cookie') != -1 && $.cookie('selected_dept_cookie') != '' && $.cookie('selected_dept_cookie') != undefined)
        		{       			
        			$('select[name="departure_airports"] option[value="'+$.cookie('selected_dept_cookie')+'"]').attr('selected','selected');
        			
        			var request_data = {};
    				request_data.dest_shrtcode = $.cookie('selected_dept_cookie');	
    				
    				blockSearchingTabs();
    				$.post( baseUrl + "welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {	
    					  $('.travelto select').html('');	
    					  $('.travelto select').append(data);       
    					  if($.cookie('selected_arrival_cookie') != 'undefined')
    		        	  {    		        			
    		        		$('select[name="arrival_airports"] option[value="'+$.cookie('selected_arrival_cookie')+'"]').attr('selected','selected');
    		        	  }
    					  unblockSearchingTabs();        					 	
    					}, "html");
        		}

        		
        		
        		$.cookie('actve_tab_cookie',tab);
        	/*
        	 * End - Flights form js
        	 */

        	
        }
        
        
        function justAFlightNHotel(tab){       	
        	/*
    		 *  Start - Flights&Hotels Js
    		 */
    		/*-------------- fetch the arrivals list based on destination selection ------------------*/
    		
    		$('select[name="full_departure_airports"]').change(function(){
    		
    			if($(this).val() == null || $(this).val() == '' || $(this).val() == -1 )
    			{
    				//alert("Please choose proper destination");
    				$('select[name="full_arrival_airports"]').html('');
    			}
    			else
    			{
    				
    				var request_data = {};
    				request_data.dest_shrtcode = $(this).val();	

    				blockSearchingTabs();
    				$.post( baseUrl + "welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {	
    					
    					  $('select[name="full_arrival_airports"]').html('');	
    					  $('select[name="full_arrival_airports"]').append(data);	
    					  unblockSearchingTabs();
    					  //$.cookie('selected_full_dept_cookie', request_data.dest_shrtcode);	
    					}, "html");
    			}
    		});
    		
    		$('select[name="full_arrival_airports"]').change(function(){
    			
    			
    			if($(this).val() == null || $(this).val() == '' || $(this).val() == -1 )
    			{
    				alert("Please choose proper destination");
    			}
    			else
    			{				
    				//$.cookie('selected_full_arrival_cookie', $(this).val());			
    			}
    		});	
    	
    		
    		$('select[name="full_rooms"]').change(function(){
    			var str='';
    			
    			for(var i=$(this).val();i<=($(this).val() * 4 );i++)
    			{
    				str += '<option>'+i+'</option>';
    			}
    			//$.cookie('selected_full_rooms_cookie', $(this).val());			
    			//$.cookie('full_adults_html_cookie', str);
    			$('select[name="full_adults"]').html(str);
    		});
    		
//    		$('select[name="full_adults"]').change(function(){			
//    			//$.cookie('selected_full_adults_cookie', $(this).val());	
//    		});		
//    		
//    		$('select[name="full_nights"]').change(function(){
//    			//$.cookie('selected_full_nights_cookie', $(this).val());
//    		});
//    		$('input[name="full_departure_date"]').change(function(){			
//    			//$.cookie('selected_full_date_cookie', $(this).val());
//    		});

    		/*
    		 * Populate form with required things with cookie values during page refresh
    		 */	
    		
    		if($.cookie('full_adults_html_cookie') != 'undefined')
    		{			
    			$('select[name="full_adults"]').html($.cookie('full_adults_html_cookie'));
    		}
    		if($.cookie('selected_full_date_cookie') != 'undefined')
    		{	
    			$('input[name="full_departure_date"]').val($.cookie('selected_full_date_cookie'));
    		}
    		
    		$('select[name="full_rooms"] option[value='+$.cookie('selected_full_rooms_cookie')+']').attr('selected','selected');			
    		$('select[name="full_adults"] option[value='+$.cookie('selected_full_adults_cookie')+']').attr('selected','selected');			
    		$('select[name="full_nights"] option[value='+$.cookie('selected_full_nights_cookie')+']').attr('selected','selected');
    		$('select[name="full_arrival_airports"]').html('<option value="-1">Select Destination</option>');
    		if($.cookie('selected_full_dept_cookie') != -1 && $.cookie('selected_full_dept_cookie') != '' && $.cookie('selected_full_dept_cookie') != undefined)
    		{
    			
    			$('select[name="full_departure_airports"] option[value="'+$.cookie('selected_full_dept_cookie')+'"]').attr('selected','selected');
    			
    			var request_data = {};
    			request_data.dest_shrtcode = $.cookie('selected_full_dept_cookie');				
    			$.post( baseUrl + "welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {    				
    				$('select[name="full_arrival_airports"]').html('');
    				  $('select[name="full_arrival_airports"]').append(data);
    				
    				  unblockSearchingTabs();
    				 
    				  if($.cookie('selected_full_arrival_cookie') != -1  || $.cookie('selected_full_dept_cookie') != '')
    				  {    					  
    					  $('select[name="full_arrival_airports"] option[value="'+$.cookie('selected_full_arrival_cookie')+'"]').attr('selected','selected');
    				  }
    				}, "html");		
    				
    		}
    		
    		$.cookie('actve_tab_cookie',tab);
    	/*
    	 * End - Flight&Hotels form js
    	 */
    		
    		//	roomBase();
    			
    		
        }
        
       function bulkForm(mformData){     	  
    	   $.fancybox({
               'href': '#bluk_div',
               beforeShow: function() {
                   this.wrap.draggable();
               },              
           });    	     
    	   $('#bulk_form').submit(function(){    		
    		   var bformData = $(this).serializeArray();
    		   var count = 0;
    		   $.each(bformData, function(index, value){ 
    			   if(value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == '')
   					{
	   					var msg = $('[name="'+ value.name +'"]').attr('placeholder');
	   					alert('Please fill '+ msg +' field');   
	   					count++;
	   					return false; 
	   					
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
    		   if(count)return false;
    		   $.post( baseUrl + "welcome/bulkSubmit",{bformData,mformData}, function( data ) {
    			   alert(data.message);
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
    				mformData['Fly_From'] = $('[name="full_departure_airports"] option:selected').text();
    				mformData['Travel_To'] = $('[name="full_arrival_airports"] option:selected').text();
    				mformData['Departure_Date'] = $('[name="full_departure_date"]').val();
    				mformData['Rooms'] = $('[name="full_rooms"] option:selected').text();
    				mformData['Nights'] = $('[name="full_nights"] option:selected').text();
    				mformData['Adults'] = $('[name="full_adults"] option:selected').text();
    				mformData['Children'] = $('[name="full_children"] option:selected').text();    				
    				bulkForm(mformData);
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
        
        function submit_fnh_hotel_fun(request_data)
        {
        	
        		var str = '';       	
            	if(isNaN(Number($('select[name="hotel_childrens"] option:selected').text())))var t = 0;
        		else t = $('select[name="hotel_childrens"] option:selected').text();
            	str += 	$('select[name="full_arrival_airports"] option:selected').text() +', '
            				+ $('input[name="hotel_check_in_date"]').val() +'. '
            				+ $('select[name="hotel_nights"] option:selected').text() + ' nights.'
            				+ $('select[name="hotel_adults"] option:selected').text() + ' Adult(s) '
            				+ t + ' Child(ren). '
            				+ $('select[name="hotel_rooms"] option:selected').text() + ' Room(s)';
            	
            	
            	
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

               // console.log(request_data);return false;
            	
            		
	        	$.post( "/welcome/hotel/fetch_filtered_hotels",request_data, function( data ) {
	        		

					if(data == 'notavailable')
					{
						
						var date = new Date();
			        	date.setTime(date.getTime() + (60 * 1000));
			        	$.cookie('notavailable_info', str, { expires: date });	
						window.location = "notavailable";
					}
					else
					{
								
			    			var str='';			
			    			for(var i=$('select[name="hotel_rooms"]').val();i<=($('select[name="hotel_rooms"]').val() * 4 );i++)
			    			{
			    				str += '<option>'+i+'</option>';
			    			}
			    			$.cookie('selected_hotel_rooms_cookie', $('select[name="hotel_rooms"]').val());			
			    			$.cookie('hotel_adults_html_cookie', str);  				
			    			$.cookie('selected_hotel_adults_cookie', $('select[name="hotel_adults"]').val());	
			    			$.cookie('selected_hotel_nights_cookie', $('select[name="hotel_nights"]').val());
			    			$.cookie('selected_hotel_date_cookie', $('input[name="hotel_check_in_date"]').val());
			    			$.cookie('selected_hotel_travel_to_cookie', $('select[name="hotel_travel_to"]').val());	
			    			window.location = data;
					}				
				}, "html");
        	//}
        }
        
        

	/*function roomBase()
	{
	
		var str = '';var kp = "";
		$('#append_ext').html(str);
		if(Number($('select[name="full_rooms"]').val()) >= 2 && Number($('select[name="full_children"]').val()) >= 1)
		{
		    for(var i=1;i<=Number($('select[name="full_rooms"]').val());i++)
		    {
			str +=  '<div class="adults"><label for="email">Room - '+i+':</label><input type="text" '+kp+'  placeholder="Number of Adults" name="num_adult_'+i+'" class="room_box_adult" ><p class="err_room"></p><input type="text" '+kp+' name="num_child_'+i+'" class="room_box_child"  placeholder="Number of Childeren"></div>';
 		    }			
		}
		$('#append_ext').html(str);
		
	}
	function roomBase_hotel()
	{
		var str = '';var kp = "";
		$('#append_ext_hotel').html(str);
		if(Number($('select[name="hotel_rooms"]').val()) >= 2 && Number($('select[name="hotel_childrens"]').val()) >= 1)
		{
		    for(var i=1;i<=Number($('select[name="hotel_rooms"]').val());i++)
		    {
			str +=  '<div class="adults"><label for="email">Room - '+i+':</label><input type="text" '+kp+'  placeholder="Number of Adults" name="num_adult_'+i+'" class="room_box_adult_hot" ><p class="err_room"></p><input type="text" '+kp+' name="num_child_'+i+'" class="room_box_child_hot"  placeholder="Number of Childeren"></div>';
 		    }			
		}
		
		$('#append_ext_hotel').html(str);
		
	}*/
	
	
