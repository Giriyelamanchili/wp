<?php 
/**
 * Hoskia Section Element
 */
class WPBakeryShortCode_section extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		$this->helper = new hoskia_helper();
		
		// Qfix section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_section_maping' ) );
		
		// Qfix Section shortcode
		add_shortcode( 'ssdhostsection', array( $this, 'hoskia_section_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_section_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
			"name" => esc_html__( "Hoskia Section", "hoskia" ),
			"base" => "ssdhostsection",
			"icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
			"content_element" => true,
			"show_settings_on_create" => false,
			"is_container"	=> true,
			"category"	=> esc_html__( "Hoskia", "hoskia" ),
			"params" => array(
				// add params same as with any other content element
				array(
					"type" => "css_editor",
					"heading" => esc_html__( "Design Settings Options", "hoskia" ),
					"param_name" => "css"
				),
				array(
					"type" => "checkbox",
					"heading" => esc_html__( "Video Background", "hoskia" ),
					"param_name" => "videobg",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__( "Video ID", "hoskia" ),
					"param_name" => "videoid",
					'dependency' => array(
						'element' => 'videobg',
						'not_empty' => true,
					),
				),
				array(
					"type" => "checkbox",
					"heading" => esc_html__( "Parallax", "hoskia" ),
					"param_name" => "parallax",
				),
				array(
					"type" => "checkbox",
					"heading" => esc_html__( "Background Bottom Position", "hoskia" ),
					"param_name" => "bgposbotm",
				),
				array(
					"type" => "checkbox",
					"heading" => esc_html__( "Active Overlay", "hoskia" ),
					"param_name" => "overlay",
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__( "Background Overlay Color", "hoskia" ),
					"param_name" => "overlaycolor",
				),
				array(
					'type' => 'floatnumber',
					'holder' => 'div',
					'class' => 'text-class',
					'heading' => esc_html__( 'Background Opacity', 'hoskia' ),
					'param_name' => 'bgopacity',
					'step'	=> '0.1',
					'max'	=> '1',
					'admin_label' => false,
					'weight' => 0,
				),

				array(
					'type' => 'animation_style',
					'heading' => esc_html__( 'Animation Style', 'hoskia' ),
					'param_name' => 'animation',
					'description' => esc_html__( 'Choose your animation style', 'hoskia' ),
					'admin_label' => false,
					'weight' => 0,
				),


			),
			"js_view" => 'VcColumnView'
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_section_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'css'  		   => '',
				'overlay'  	   => '',
				'overlaycolor' => '',
				'bgopacity'    => '',
				'bgposbotm'    => '',
				'parallax'     => '',
				'animation'    => '',
			),
		$atts
		) );
		
		// Font settings
		$animation  = $this->getCSSAnimation( $animation );
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostsection', $atts );

		$uniqID = uniqid( 'hoskia-section' ).'-'.rand( 1, 9999 );
		$Css = '';
		// Overlay
		if( $overlay ){
			$bgoverlay = ' bg--overlay';
			
			// section  Css
			if( $overlaycolor || $bgopacity ){
				
				$Css .= '#'.esc_attr( $uniqID ).'.bg--overlay:before {background-color:'.esc_attr( $overlaycolor ).';opacity:'.esc_attr( $bgopacity ).';}';
			}
			
			
		}else{
			$bgoverlay = '';
		}
		
		//Parallax
		if( $parallax ){
			$Css .= '#'.esc_attr( $uniqID ).'{background-attachment:fixed!important;}';
		}
		//Background bottom position
		if( $bgposbotm ){
			$Css .= '#'.esc_attr( $uniqID ).'{background-position:bottom!important;}';
		}

		
		ob_start();		
		?>
        <div id="<?php echo esc_attr( $uniqID ); ?>" class="hoskia--section <?php echo esc_attr( $css_class.$bgoverlay.$animation ); ?>">
            <div class="container">
			<?php
				echo do_shortcode( $content );
			?>
			</div>
		</div>
		<?php
		
		if( $Css ){
			echo $this->helper->hoskia_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
}

$sectheading = new WPBakeryShortCode_section();


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_ssdhostsection extends WPBakeryShortCodesContainer {
		
    }

}


?>