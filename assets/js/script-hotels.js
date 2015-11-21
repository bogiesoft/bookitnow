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
	
    $( "#datepicker2" ).datepicker(); 
    
    
    
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
    	//filterFlightsNHotels(flight_crypt,type,page);     
    })
    
    $('.datepicker_book').datepicker();
 });
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
            $('#dvContent').block({
                message: '<div><img src="/images/logo.png" alt=""  width="225px"/></div>',
                overlayCSS: { backgroundColor: '#fff' }
            });
        }
		//close popup once get the ajax response
        function unblockSearchingTabs() {
            $('#dvContent').unblock();
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
        		
        	//	console.log(data);return false;

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
        	$.post('/welcome/extras/update_lug_fun',{lug:lug,crypt:crypt},function(data){
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		//$('.online-rate,#cphContent_lblSubTotal').text(data.whole);
        		$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        	},'json');
        	
        }
        
        function addsavings(id,crypt)
        {
        	$.post('/welcome/extras/update_extras_fun',{id:id,crypt:crypt,dp:$('select[name="ct_'+id+'"]').val()},function(data){
        		//console.log(data.sel_block.lug);
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		//$('.online-rate,#cphContent_lblSubTotal').text(data.whole);
        		$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        	},'json');
        }
        
        function blockAddingExtraPopup(field_num,crypt)
        {
        	$.post('/welcome/extras/remove_extras_fun',{field_num:field_num,crypt:crypt},function(data){
        		
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		$('#cphContent_lblSubTotal').text(data.whole);
        		//$('.online-rate,#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        	},'json');
        	
        }
        
        function rmBagg(id,crypt)
        {        	
        	$.post('/welcome/extras/remove_extras_fun',{lug:id,crypt:crypt},function(data){
        		
        		$('#ExtraTotal').text(data.total);
        		$('#extra_segments').html(data.sel_block.segment);
        		$('.aspNetDisabled').val(data.bags);
        		//$('.online-rate,#cphContent_lblSubTotal').text(data.whole);
        		$('#cphContent_lblSubTotal').text(data.whole);
        		$('#pprice').text(parseFloat(data.whole / data.persons).toFixed(2));
        			
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
        
			var count = 0;
			//Required field validations
			$.each(request_data, function(index, value){
				
				if(value.name != 'mobile' && (value.value == null || value.value == '-1' || value.value == 'undefined' || value.value == ''))
				{					
					alert('Please select '+ $('[name="'+value.name+'"]').attr('title') +' field');
					$('[name="'+value.name+'"]').focus();
					count++;
					return false;
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
				
				if(data.success == 1)
				{
						alert("Thank you for booked");
				}
				window.location =  "/";
				/*if(data.success)
				{
					window.location = "notavailable";
				}
				else
				{
					alert('Some thing went wrong')
				}*/
				  /*$('.travelto select').html('');	
				  $('.travelto select').append(data);	
				  unblockSearchingTabs();*/
				}, "json");
			
        	return false;
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
        
        

               
        
