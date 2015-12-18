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
		  
		      $(".toggle_atol").click(function () {
		          $(".atol_info").fadeToggle("fast", function () {
		              // Animation complete.
		          });
		      });
		      
		      //$(".various1").fancybox();
	
    $( "#datepicker" ).datepicker(); 
    
    
    
    $('.filtercheckbox input[type="checkbox"]').click(function(){
    	
    	var f_name = $(this).attr('id');
    	if(f_name.indexOf("chkFlightFilter") > -1 && $(this).prop("checked") == true)
    	{
    		$('[mandatory="price"]').not(this).attr('checked',false);
    	}
    	if(f_name.indexOf("chkStar") > -1 && $(this).prop("checked") == true)
    	{
    		if(f_name != 'chkStar_all')$('#chkStar_all').attr('checked',false);
    		else $('[mandatory="star"]').not(this).attr('checked',false);
    	}
    	if(f_name.indexOf("chkBoardbasisFilter") > -1 && $(this).prop("checked") == true)
    	{
    		if(f_name != 'chkBoardbasisFilter_all')$('#chkBoardbasisFilter_all').attr('checked',false);
    		else $('[mandatory="boardbasis"]').not(this).attr('checked',false);
    	}
    	if(f_name.indexOf("chkResortsFilter") > -1 && $(this).prop("checked") == true)
    	{
    		if(f_name != 'chkResortsFilter_all')$('#chkResortsFilter_all').attr('checked',false);
    		else $('[mandatory="resorts"]').not(this).attr('checked',false);
    	}
    	var date = $('li.current').find('.current_date').attr('dt');
    	var page = 1;var keyword=$('#hotel_key').val();
    	filterHotels(hotel_crypt,type,page,keyword);     
    })
    $('#toggle3').change(function(){    	
    	if($(this).prop("checked") == true)
    	{
    		$('.toggle3').toggle(true);
    		$(this).value='true';
    	}
    	else{
    		$('.toggle3').toggle(false);
    		$(this).value='false';
    	}
    });

    $(document.body).on('click', 'a.pagerhyperlink' ,function(){
    	
    	var keyword=$('#hotel_key').val();
    	filterHotels(hotel_crypt,type,$(this).text(),keyword);
    });
    $('select[name="full_rooms"]').change(function(){
		var str='';
		
		for(var i=$(this).val();i<=($(this).val() * 4 );i++)
		{
			str += '<option>'+i+'</option>';
		}			
		$('select[name="full_adults"]').html(str);
	});
    $('select[name="hotel_rooms"]').change(function(){		
		var str='';			
		for(var i=$(this).val();i<=($(this).val() * 4 );i++)
		{
			str += '<option>'+i+'</option>';
		}		
		$('select[name="hotel_adults"]').html(str);
	});
	
    
    $('.datepicker_book').datepicker({
    	 changeMonth: true,
         changeYear: true,
         yearRange: "-100:+0",
    });
    
    
 });
 
 	function filterHotels(hotel_crypt,type,page,keyword)
 	{ 		
 		blockSearchingTabs();
 		var checkedValues = {};
		checkedValues['prices'] = $('input[mandatory="price"]:checked').map(function() {
		    return this.value;
		}).get();
		checkedValues['stars'] = $('input[mandatory="star"]:checked').map(function() {
		    return this.value;
		}).get();
		checkedValues['boardbasis'] = $('input[mandatory="boardbasis"]:checked').map(function() {
		    return this.value;
		}).get();
		checkedValues['resorts'] = $('input[mandatory="resorts"]:checked').map(function() {
		    return this.value;
		}).get();
		//checkedValues['page'] = $('#cphContent_dpAllStar').find('span').not('.pagerhyperlink').text();
		checkedValues['page'] = page;
		
		$.post("/welcome/hotel/filterHotel_fun",{'searchType':type,'checkedValues':checkedValues,'crypt':hotel_crypt,'keyword':keyword},function(data){
			//console.log(data);return false;
			$('#hotel_content').html('');
			$('#hotel_content').html(data);
			unblockSearchingTabs();
			return false;
		},'html');
		return false;
 	}
	 function getpackinfo(e)
	 {	
		 $('.various1').fancybox();
	 }
	 function LoadQQPopup(obj) {
      
         $('#' + obj.id).fancybox({
             href: '#quickQuote'
         });
        
     }
		//popup for block further search options during ajax request
		function blockSearchingTabs() {
            $.blockUI.defaults.css = {};
            
            //$('#dvContent').block({
            $('#middle_conent,#body_content').block({
                message: '<div><img src="/images/loader-bar.gif" alt=""  width="225px"/></div>',
                overlayCSS: { backgroundColor: '#fff' }
            });
        }
		//close popup once get the ajax response
        function unblockSearchingTabs() {
          //  $('#dvContent').unblock();
        	  $('#middle_conent,#body_content').unblock();
        }
        
        function Addhotel(type,info,segment)
        { 
        	
        	if(type == 'pack_hotel')
        	{
        		var html = '<div style="text-align:center;"> <img src="/images/logo.png"/>'
        				   +'</div><div class="wait_page_section">'
        				   +'<h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;text-align:center;">Hotel & Room Selections Added.</h2></div>'
        				   +'<div class="center wait_page" style="text-align:center;"><br>'
        				   +'<h3 class="txt_color_1">Calculating Savings &amp; Checking Available Extras</h3>'
        				   +'<h4>Enhance Your Trip For the Best Holiday Experience.</h4>'
        				   +'<h6>Hold Luggage, Transfers, Parking &amp; Car Hire.</h6>'        				   
        				   +'<div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"> <div class="wait_page_loading">'
        				   +'<img src="/images/loader-bar.gif"></div><br>'
        				   +'<h3 class="txt_color_1"> Please Wait a Moment Whilst We Get you The Best Rates...</h3></div><div><h4><strong>Book With Confidence</strong>'
        				   +'</h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> '
        				   +'<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> '
        				   +'<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent">'
        				   +'<img src="/images/abta.png"/></div></div></div>';
        	}
        	else
        	{
        		var html = '<div style="text-align:center;"> <img src="/images/logo.png"/></div><div class="center wait_page" style="text-align:center;"><br><span style="display: none;"><span >Searching For Flights</span></span><div class="wait_page_section"><h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;letter-spacing: 0.5px;">Selected Rooms Have Been Saved.</h2></div><div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"> <div class="wait_page_loading"> <img src="/images/loader-bar.gif"></div><br><h3 class="txt_color_1">Continuing To The Final Step</h3></div><div><h4><strong>Book With Confidence</strong></h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> <div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"><img src="/images/abta.png"/></div></div></div>';
        	}
        	
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
           
        	$.post("/welcome/hotel/savehotel_fun",{'searchType':type,'crypt_text':info,'crypt':segment},function(data){  
        		
        		//console.log(data);return false;

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
        
        function BaggageMinus(crypt)
        {
        	
        	var lug = Number($('.aspNetDisabled').val());
        	if(!lug <= 0)
        	{
        		$('.aspNetDisabled').val(lug-1);
        		update_luggage(lug-1,crypt);
        	}        	
        }
        
        function BaggagePlus(crypt)
        {
        	
        	var lug = Number($('.aspNetDisabled').val());
        	$('.aspNetDisabled').val(lug+1);  
        	update_luggage(lug+1,crypt);
        }
        
        function update_luggage(lug,crypt)
        {
        	blockSearchingTabs();
        	$.post('/welcome/extras/update_lug_fun',{lug:lug,crypt:crypt},function(data){
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		$('.online-save .online-final,#cphContent_lblSubTotal').text(data.whole);
        		//$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        		unblockSearchingTabs();
        	},'json');
        	
        }
        
        function addsavings(id,crypt)
        {
        	blockSearchingTabs();
        	$.post('/welcome/extras/update_extras_fun',{id:id,crypt:crypt,dp:$('select[name="ct_'+id+'"]').val()},function(data){
        		//console.log(data.sel_block.lug);
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		$('.online-save .online-final,#cphContent_lblSubTotal').text(data.whole);
        		//$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        		unblockSearchingTabs();
        	},'json');
        }
        
        function blockAddingExtraPopup(field_num,crypt)
        {
        	blockSearchingTabs();
        	$.post('/welcome/extras/remove_extras_fun',{field_num:field_num,crypt:crypt},function(data){
        		
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		//$('#cphContent_lblSubTotal').text(data.whole);
        		$('.online-save .online-final,#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        		unblockSearchingTabs();
        	},'json');
        	
        }
        
        function rmBagg(id,crypt)
        {        
        	blockSearchingTabs();
        	$.post('/welcome/extras/remove_extras_fun',{lug:id,crypt:crypt},function(data){
        		
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		$('.online-save .online-final,#cphContent_lblSubTotal').text(data.whole);
        		//$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        		unblockSearchingTabs();
        	},'json');
        }
        
        function callWaitPageForextra()
        { 
        	var html = '<div style="text-align:center;"> <img src="/images/logo.png"/>'
				   +'</div><div class="wait_page_section">'
				   +'<h2  style="font-size: 175%;padding-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #A0CCDD;text-align:center;">Discounts Applied & Selected Options Have Been Saved.</h2></div>'
				   +'<div class="center wait_page" style="text-align:center;"><br>'			          				   
				   +'<div class="wait_page_section" style="border-bottom: 1px solid #A0CCDD;"> <div class="wait_page_loading">'
				   +'<img src="/images/loader-bar.gif"></div><br>'
				   +'<h3 class="txt_color_1"> Proceeding To Booking Details </h3></div><div><h4><strong>Book With Confidence</strong>'
				   +'</h4><h5>Fully ABTA and ATOL Bonded for financial protection</h5> '
				   +'<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent"></div> '
				   +'<div class="sprite bonding" title="ABTA and ATOL Bonded Travel Agent">'
				   +'<img src="/images/abta.png"/></div></div></div>';
	
	
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
        }
        
        function basket(seg,e)
        {
        	
        	var request_data = $(e).serializeArray();       	
        
			var count = 0;$nrqf = ['mobile'];
			if($('#toggle3').prop("checked") === false)
	    	{
				$nrqf = ['address_2','city2','post_code2','mobile'];				
			}
			
			//Required field validations
			$.each(request_data, function(index, value){				
				
				if($.inArray(value.name, $nrqf) == -1 && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{				
					alert('Please select '+ $('[name="'+value.name+'"]').attr('title') +' field');
					$('[name="'+value.name+'"]').focus();
					count++;
					return false;
				}
				if(value.name == 'home_tel'){					
					if(!phonenumber(value.value))
					{
						 alert("Not a valid Phone Number"); 
						 $('[name="'+value.name+'"]').focus();
						 return false;
					}					
				}
				if(value.name == 'card_number'){
					var reg = /^\d{16}$/;					  
					if(!cardnumber(value.value,reg))
					{
						 alert("Not a valid Card Number"); 
						 $('[name="'+value.name+'"]').focus();
						 return false;
					}				
					
				}
				if(value.name == 'cvv_number'){
					var reg = /^\d{3}$/;
					if(!cardnumber(value.value,reg))
					{
						 alert("Not a valid CVV Number"); 
						 $('[name="'+value.name+'"]').focus();
						 return false;
					}	
				}
			});
			
			//Email & confirm email validation
			if ($('[name="email"]').val() != $('[name="confirm_email"]').val()) {
                alert("Email and Confirm Email must match");
                $('[name="email"]').focus();
                return false;
            }
		    if(count)return false;
			var t = {};
			t['name'] = 'segment';
			t['value'] = seg;
			request_data.push(t);
			
			$.post( "/welcome/extras/booking_submition",request_data, function( data ) {
				//console.log(data);return false;
				if(data.success == 1)
				{
						alert("Thank you for booked");
				}
				window.location =  "/";			
				}, "json");
			
        	return false;
        }
        function cardnumber(inputtxt,reg)  
        {           
          if(inputtxt.match(reg))  
          {  
            return true;  
          }  
          else  
          {            
           return false;  
          }  
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
        function Change(type,seg)
        {
        	if(confirm("Are you sure , Do you want to modify ?"))
			{
        		return true;
			}
        	else
        	{
        		return false;
        	}
        		
        }
        
        function fulldetails(brcode)
        {
        	$.fancybox({
        	   
        	    // href : $('.fancybox').attr('id'), // don't need this
        	    type: 'iframe',
        	    padding: 5,        	    
        	    href : '/welcome/hotel/show_hotel_details/'+brcode
        	    }); // fancybox
//        	$.fancybox({
//        		'href' : '/welcome/hotel/show_hotel_details/'+brcode
//        	});
//        	$.post( "/welcome/hotel/full_details_fun",{brcode : brcode}, function( data ) {
//        		alert(data)
//        		$.fancybox(data);				
//        	});        	
        }
        
        function confirmValidate(e)
        {
        	var req_data = $(e).serializeArray();
        	var count = 0;
        	
        	$.each(req_data, function(index, value){
        		
				
        		if(value.name != 'subscribe' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{			
					alert('Please select '+ $('[name="'+value.name+'"]').attr('title') +' field');
					$('[name="'+value.name+'"]').focus();
					count++;
					return false;
				}
        		if(value.name == 'email')
        		{
        			if(!validateEmail(value.value))
        			{
        				alert('Please enter a valid email address');
        				count++;
        				return false;
        			}
        		}        		
				
			});
        	if(count)return false;
        	
        	
        	$.post( "/welcome/extras/saveForLater_fun",req_data, function( data ) {
        		
        		if(data.status == 'success'){
        			
        			//alert("Thank you for the search");
        		}
        		else if(data.status == 'subscribe'){
        			//alert("Thank you for the subscribe");
        		}
        		$('#cphContent_lnkDesktopBasketQQ').remove();
        		
        		$.fancybox({
        			href : '#cphContent_divQuoteSent'
        		});
        		return false;
        	},'json');
        	
        	
        	return false;
        }
        
        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
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
				/*mformData['Travel_To'] = $('[name="hotel_travel_to"] option:selected').text();
				mformData['Departure_Date'] = $('[name="hotel_check_in_date"]').val();
				mformData['Rooms'] = $('[name="hotel_rooms"] option:selected').text();
				mformData['Nights'] = $('[name="hotel_nights"] option:selected').text();
				mformData['Adults'] = $('[name="hotel_adults"] option:selected').text();
				mformData['Children'] = $('[name="hotel_childrens"] option:selected').text();*/
				$('.noFlight,.noFull').show();
				$('.noHotel').hide();
				
				bulkForm(mformData,'hotel');
				return false;
			}
			room_parllalization(request_data);
			return false;
        	
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
        function arrivals(code,target){		
    		var request_data = {};
    		request_data.dest_shrtcode = code;
    		$(target).html('');	
    		if(Number(code) != -1)
    		$.post( "/welcome/arrival_list_basedon_dynaminc_departuere_airport",request_data, function( data ) {
    				$(target).append(data);   					 	
    			}, "html");
    		
    	}
        
