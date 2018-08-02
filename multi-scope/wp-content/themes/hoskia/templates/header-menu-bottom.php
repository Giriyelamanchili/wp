<?php 

// Page Title Area Start
$header = hoskia_meta( 'slide_header_active' );
if( $header && 
	( is_page_template( 'template-builder.php' ) || 
	is_page() ) )
	{
	
	if( $header && $header!= 'noheader' ){
		
		if( hoskia_meta( 'slide_header_active' ) == 'page_header' ){
			
			get_template_part( 'templates/page', 'header' );
			
		}elseif( hoskia_meta( 'slide_header_active' ) == 'slider' ){
			
			if( hoskia_meta( 'slider-shortcode' ) ){
				
				$slug = hoskia_meta( 'slider-shortcode' );
										
				$postId = get_page_by_path( $slug, OBJECT , 'hoskia_slider' );
					
				$shortcode = '[slider id="'. esc_html( $postId->ID ) .'"]';
				
				echo do_shortcode( $shortcode );
			}
			
		}else{
			
			if( hoskia_meta( 'slider-customshortcode' ) ){
				echo do_shortcode( hoskia_meta( 'slider-customshortcode' ) );
			}
			
		}
	}
	
}else{
	get_template_part( 'templates/page', 'header' );
}
		

?>