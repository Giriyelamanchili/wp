jQuery(function($){
    'use strict';

   
    /********** section media option redio button ************/
    $.metaplug = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            opt1:  "",
            opt2:  "",
            name:  "",
            cont:  "",
            media: ""
            
        }, options );

        
        //
        var $Cont  = $( settings.opt1 ),
        $Gmed      = $( settings.opt2 ),
        $Name      = settings.name, 
        $Content   = $( settings.cont ),
        $Media     = $( settings.media );
        
       
    
        $( 'input[type=radio][name='+$Name+']' ).on( 'click', function(){
            
            //
            if( $Cont.is(':checked') ){
               console.log( 'test' );
                $Content.css('display', 'block');
            
            }else{
                $Content.css('display', 'none');
            }
            //
            if( $Gmed.is(':checked') ){
                
                $Media.css('display', 'block');
            
            }else{
               $Media.css('display', 'none'); 
            }

            
        });  
     
        // Flat Content checked 
        if( $Cont.is(':checked') ){
            
            $Content.css('display', 'block');

        }else{
            $Content.css('display', 'none');
        } 
        //
        if( $Gmed.is(':checked') ){
            
            $Media.css('display', 'block');

        }else{
             $Media.css('display', 'none');
        }
    
          
    };
   
    /********** section media option Select box ************/
    $.metaplugSelectbox = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            selector:  "",
            matchval:  "",
            contdual:  "",
            contdualsame:  "",
            cont	:  ""
            
        }, options );

        
        //
        var $seltor  = $( settings.selector ),
        $Content     = $( settings.cont ),
        $Contentdual = $( settings.contdual ),
        $metval      = settings.matchval;
	  
       	var $selected =  $seltor.select();
			
		var $selectedVal = $selected.val();
    
        $( $seltor ).change( function(){
			
       		var $selected =  $( this ).select();
			
			var $selectedVal = $selected.val();
			
				
			
            //
            if( $selectedVal == $metval ){
                
                $Content.css('display', 'none');
                $Contentdual.css('display', 'block');
            
            }else{
                $Content.css('display', 'block');
                $Contentdual.css('display', 'none');
            }
            
        });  
     
        // Flat Content checked 
		if( $selectedVal == $metval ){
			$Content.css( 'display', 'none' );
			$Contentdual.css( 'display', 'block' );
		}else{
			$Content.css( 'display', 'block' );
			$Contentdual.css( 'display', 'none' );
		}

          
    };
	

    /********** Header Options Plugin ************/
    $.headerSelectbox = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            selector:  "",
            matchval:  "",
            contdual:  "",
            contdualsame:  "",
            cont	:  ""
            
        }, options );

        
        //
        var $seltor  = $( settings.selector ),
        $Content     = $( settings.cont ),
        $Contentdual = $( settings.contdual ),
        $metval      = settings.matchval;
	  
       	var $selected =  $seltor.select();
			
		var $selectedVal = $selected.val();
    
        $( $seltor ).change( function(){
			
       		var $selected =  $( this ).select();
			
			var $selectedVal = $selected.val();
			
				
			
            //
            if( $selectedVal == $metval ){
                
                $Content.css('display', 'block');
               
            
            }else{
                $Content.css('display', 'none');
            }
            
        });  
     
        // Flat Content checked 
		if( $selectedVal == $metval ){
			$Content.css( 'display', 'block' );
		}else{
			$Content.css( 'display', 'none' );
		}

          
    }; // End Header Options  Plugin


	
	// Select box global setting / page settings option
	$.metaplugSelectbox({
		
		selector  : "#_hoskia_page_header_settings",
		matchval  : "global",
		cont	  : ".page-setting",
		
	});
	
	
	// Header Options 
	$.headerSelectbox({
		selector  : "#_hoskia_slide_header_active",
		matchval  : "slider",
		cont	  : ".slider-settings",
	});
	$.headerSelectbox({
		selector  : "#_hoskia_slide_header_active",
		matchval  : "page_header",
		cont	  : ".page-header-settings",
	});
	$.headerSelectbox({
		selector  : "#_hoskia_slide_header_active",
		matchval  : "customslider",
		cont	  : ".slider-customShortcode",
	});
	
	// slider type
	$.headerSelectbox({
		selector  : "#_hoskia_slider-type",
		matchval  : "banner",
		cont	  : ".slider-ofb",
	});
	$.headerSelectbox({
		selector  : "#_hoskia_slider-type",
		matchval  : "slider",
		cont	  : ".slider-typeopt",
	});
	

	// Page template select condition
	var $selector = $( '#page_template' );
	function page_template_meta_box(){
		
		var $selector = $( '#page_template' ),
		$pageLayout = $( '#_hoskiapage_sliderPageheader_section' ),
		$pageLayoutSection = $( '#_hoskiapage_page_layout_section' );
		
		if( 'template-builder.php' == $selector.val() ){
				$pageLayout.show();
				$pageLayoutSection.show();
		}else{
			$pageLayout.hide();
			$pageLayoutSection.hide();
		}
		
	}
	// Default 
	page_template_meta_box();
	// Onchange 
	$selector.on( 'change', function(){
		page_template_meta_box();
	} );
	



});