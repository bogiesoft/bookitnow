 $(function() {
 
	 $('.datepicker_book').datepicker();
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
        	var html = '<head><meta charset="utf-8"><title>superescapes | Terms Of Use</title><meta name="viewport" content="width=device-width, initial-scale=1"><link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="/assets/css/modal_popup.css" rel="stylesheet" type="text/css"><link href="styles/bootstrap-responsive.min.css" rel="stylesheet" /><link rel="stylesheet" href="/assets/js/jquery-ui.css"><link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"><link href="/assets/css/custom.css" rel="stylesheet" type="text/css"><link href="/assets/css/responsive.css" rel="stylesheet" type="text/css"><link href="/assets/css/menu.css" rel="stylesheet"><link  href="/assets/css/inner-page.css" rel="stylesheet"><link href="/assets/css/menu.css" rel="stylesheet"></head><body><div class="clearfix"></div><div class="container main-wrappage"><div class="row"><div class="col-sm-12 col-md12 col-xs-12" style="text-align:center"><h3><img src="/images/logo.png"></h1><br><h2>Discounts Applied &amp; Selected Options Have Been Saved.<br></h2><div style="margin: 15px 0;"><img src="/images/loader-bar.gif"> </div><div class="box-border-wrap"><h5 class="loading-page"><b>Proceeding To Booking Details</b></h5></div><h4>Book With Confidence</h4><h5>Fully ABTA and ATOL Bonded for financial protection<h5><h3><img src="/images/abta.png"></h1><br> </div></div></div></div></div><div class="clearfix"></div> <div class="clearfix"></div></body>';
        	$('html').html(html);
        	return true;
        	/*$.post('/welcome/extras/save_extras_fun',{lug:id,crypt:crypt},function(data){
        		
        		
        	},'json');*/
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
        
        

               
        
