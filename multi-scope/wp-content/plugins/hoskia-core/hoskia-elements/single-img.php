<?php 
/**
 * Hoskia Single Image section elements
 */
class WPBakeryShortCode_Ssdhost_Single_Img extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Hoskia helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_singleimg_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostsingleimg', array( $this, 'hoskia_singleimg_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_singleimg_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Single Image", "hoskia" ),
		  "base" => "ssdhostsingleimg",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  
			array(
				"type" 		  => "attach_image",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Image", "hoskia" ),
				"param_name"  => "img",
				"description" => esc_html__( "Set service image.", "hoskia" ),
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Text", "hoskia" ),
				"param_name"  => "text",
				"description" => esc_html__( "Set text.", "hoskia" ),
			),

			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 		  => "floatnumber",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Margin Top", "hoskia" ),
				"param_name"  => "textmt",
				"description" => esc_html__( "Set margin top.", "hoskia" ),
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 		  => "floatnumber",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Margin Bottom", "hoskia" ),
				"param_name"  => "textmb",
				"description" => esc_html__( "Set margin bottom.", "hoskia" ),
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' 		  => 'animation_style',
				'heading' 	  => esc_html__( 'Animation Style', 'hoskia' ),
				'param_name'  => 'animation',
				'description' => esc_html__( 'Choose your animation style', 'hoskia' ),
				'admin_label' => false,
				'weight' 	  => 0,
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),


		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_singleimg_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'img'     	=> '',
				'text'      => '',
				'animation' => '',
				'textmb' 	=> '',
				'textmt' 	=> '',
				'css' 	   	=> '',
			),
		$atts
		) );
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		// text margin
		$textmargin = array();
		
		if( absint( $textmt ) ){
			$textmargin[] = 'margin-top:'.esc_attr( $textmt ).'px;';
		}
		if( $textmb ){
			$textmargin[] = 'margin-bottom:'.esc_attr( $textmb ).'px;';
		}
		
		$textmargintags = $this->helper->hoskia_style_tag( $textmargin );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostsingleimg', $atts );
		
		$imgurl = wp_get_attachment_image_src( $img , 'full' );
		ob_start();
		?>	
		<div class="hoskia-single-img <?php echo esc_html( $css_class ); ?>">
			<?php 
			if( $text ){
				echo '<h2 '.$textmargintags.'>'.esc_html( $text ).'</h2>';
			}
			//
			if( !empty( $imgurl[0] ) ){
				
				echo hoskia_img_tag(
					array(
						'url' 	=> esc_url( $imgurl[0] ),
						'class' => 'shadow--on'
					)
				);
				
			}
			?>
		</div>
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_Ssdhost_Single_Img();


?>