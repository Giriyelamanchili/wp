<?php 
class hoskia_helper{
	
	// Constructor
	function __construct(){
		
	}
	
	// Typography helper function
	public function hoskia_fontcontainer( $string ){
		
		$fontsettings = explode( '|', $string ); 

		$fontperam = array();
		if( is_array( $fontsettings ) ){
			foreach( $fontsettings as $fontsetting ){
						$fontperam[] = explode( ':', $fontsetting );
			}
		}
		
		$tag =  '';
		$styleattr = '';
		foreach( $fontperam as $value ){
			
			if( !empty( $value[0] ) && $value[0] != 'tag' ){
				if( !empty( $value[0] ) && !empty( $value[1] ) ){

					if( $value[0] == 'font_size' || $value[0] == 'letter_spacing' || $value[0] == 'line_height' ){
						$unit = 'px';
					}else{
						$unit = '';
					}

					$styleattr .= str_replace( '_', '-', $value[0] ) .':'.str_replace( '%23','#',$value[1] ) .$unit.';';
				}
			}else{
				if( !empty( $value[1] ) ){
					$tag .= $value[1];
				}
				
			}

		}
		//
		if( $styleattr ){
			$style = 'style="'.esc_attr( $styleattr ).'"';
		}else{
			$style = '';
		}
		// 
		if( $tag ){
			$tag = $tag;
		}else{
			$tag = '';
		}
		//
		$style = array(
				'tag' 	=> $tag,
				'style' => $style
			);


		return $style;
	}
	// Overlay helper function
	public function hoskia_overlay( $string ){
		
		
		$fontsettings = explode( '|', $string ); 

		$fontperam = array();
		if( is_array( $fontsettings ) ){
			foreach( $fontsettings as $fontsetting ){
						$fontperam[] = explode( ':', $fontsetting );
			}
		}
				
		
		
		$styleattr = array();
		foreach( $fontperam as $value ){
			
			if( !empty( $value[0] ) ){
				
				$styleattr[$value[0]] = str_replace( '%23','#',$value[1] );
				
			}

		}

		return $styleattr;
	}
	
	// Font Icon Helper Function
	public function hoskia_font_icon_process( $type, $attr, $style = '' ){

		$icon = '';

		foreach( $attr as $value ){

			if( $value ){
				$icon .= $value;
				break;
			}
		}
		//
		switch( $type ){

			case 'openiconic' :
				return '<span class="'.esc_attr( $icon ).'"></span>';
				break;          
			case 'fontawesome' :
				return '<i '.$style.' class="'.esc_attr( $icon ).'"></i>';
				break;          
			case 'typicons' :   
				return '<span class="'.esc_attr( $icon ).'"></span>';
				break;          
			case 'entypo' :     
				return '<span class="'.esc_attr( $icon ).'"></span>';
				break;          
			case 'linecons' :   
				return '<span class="'.esc_attr( $icon ).'"></span>';
				break;          
			case 'imageicon' :  
				$url = wp_get_attachment_image_src( $icon, 'full' );

				if( !empty( $url[0] ) ){
					return '<img src="'.esc_url( $url[0] ).'" alt="'.esc_attr( hoskia_image_alt( $url[0] ) ).'" />';
				}else{
					return;
				}
				
				break;
			default :
				#.......
				break;

		}

	}
	
	// Inline css style tag 
	public function hoskia_style_tag( $args = array() ){
				
		if( count( $args ) > 0 ){
			
		$tags = implode( '', $args );
		
		$Styletag = 'style="'.$tags.'"'; 
		
		}else{
			$Styletag = '';
		}
		
		return $Styletag;

	}
	
	// Inline css helper function
	public function hoskia_inline_css( $css = '' ){
		
		$inlinestyle = '';
		if( $css ):

		$inlinestyle .= '<script type="text/javascript">';
			$inlinestyle .= '( function($){
				$("head").append( "<style>'.$css.'</style>" );
			})(jQuery);';
		$inlinestyle .= '</script>';
		

		endif;
		return $inlinestyle;
	}

	
	
}


?>