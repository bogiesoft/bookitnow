 $(function() {	
	$.fancybox({
        href : '#success_book',
        'showCloseButton': false,
        'helpers'   : { 
            overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
        },
		afterClose: function () { // USE THIS IT IS YOUR ANSWER THE KEY WORD IS "afterClose"
            parent.location.reload(true);
        }
	});
 });