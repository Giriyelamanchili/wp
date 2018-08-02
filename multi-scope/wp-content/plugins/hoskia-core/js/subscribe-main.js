/*

[Main Script]

Project: Hoskia
Version: 1.1
Author : themelooks.com

*/

(function ($) {
    'use strict';
    
    
	$( function(){
			
		/* ------------------------------------------------------------------------- *
        * Mail Chimp ajax
        * ------------------------------------------------------------------------- */
				
        var $subscribeForm = $('#footer_subscribe');
        	
		
        $subscribeForm.on('submit', function () {
		
			var $t = $(this),
			email = $('#footer_email').val();
          
			$.ajax({
				
				type: 'POST',
				url: subscribeajax.action_url,
				data: {
				  footer_email: email,
				  action: 'hoskia_footer_subscribe_ajax'
				},
				success: function( data ){
					
				  $t.find('#alert-footermessage').html( data );
				}
			});
          
          return false;
		  
        });

		// ComingSoon Subscribe
        var $sectsubscribeForm = $('#coming_subscribe');
        		
        $sectsubscribeForm.on('submit', function () {
		  
			var $t = $(this),
				email = $('#coming_email').val();
          
			$.ajax({
				type: 'POST',
				url: subscribeajax.action_url,
				data: {
				  coming_email: email,
				  action: 'comingsoon_subscribe_ajax'
				},
				success: function( data ){
					$t.find('#alert-comingmessage').html( data );
				}
			});
          
          return false;
		  
        });
		
 
	
	
	} );
     
    
})(jQuery);
