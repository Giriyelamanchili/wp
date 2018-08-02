<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_domainextension extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_domainsearch_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostdomainextension', array( $this, 'hoskia_domainsearch_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_domainsearch_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Domain Extension", "hoskia" ),
		  "base" => "ssdhostdomainextension",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(	
		  	array(
			"type"		 => "param_group",
			'param_name' => 'extensions',
			'heading' 	 => esc_html__( 'Extensions', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Extension", "hoskia" ),
					"param_name" => "extension",
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Rate and Duration", "hoskia" ),
					"param_name" => "rate_duration",
				),
				
			)
				
			),	
			//
			array(
				'type' 		  => 'animation_style',
				'heading' 	  => esc_html__( 'Animation Style', 'hoskia' ),
				'param_name'  => 'animation',
				'description' => esc_html__( 'Choose your animation style', 'hoskia' ),
				'admin_label' => false,
				'weight' 	  => 0,
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Text Color", "hoskia" ),
				"param_name" 	=> "extcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Border Color", "hoskia" ),
				"param_name" 	=> "bordercolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),


		  )
		) );
		
	}
	
	// Shortcode and markup
	public function hoskia_domainsearch_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'extensions'     => '',
				'extcolor' 	 	 => '',
				'bordercolor' 	 => '',
				'animation' 	 => '',
			),
		$atts
		) );
		
		$uniqID = uniqID('ext'); 
		
		// Enqueue owl carousel
		wp_enqueue_script( 'owl-carousel' );
		
		// 
		
		if( $extcolor ){
			$extcolor = 'style="color:'.$extcolor.'"';
		}else{
			$extcolor = '';
		}
		
		
		//Border color
		$Css = '';
		if( $bordercolor ){
			$Css .= '#'.esc_attr( $uniqID ).'.domain--ext ul li:before{border-color:'.esc_attr( $bordercolor ).'!important;}';
		}
		
		// Animation settings
		$animation  = $this->getCSSAnimation( $animation );
				
		$extensions = vc_param_group_parse_atts( $extensions );
		
		ob_start();
		?>				
                <!-- Domain Extensions Start -->
                <div id="<?php echo esc_attr( $uniqID ); ?>" class="domain--ext" <?php echo wp_kses_post( $extcolor ); ?>>
                    <ul class="owl-carousel" data-carousel-items="5" data-carousel-margin="10" data-carousel-autoplay="true" data-carousel-responsive='{"0": {"items": "1"}, "480": {"items": "3"}, "768": {"items": "5"}}'>
						
						<?php 
						foreach( $extensions as $extension ){
							echo '<li>
								<h3 class="h4">'.esc_html( $extension['extension'] ).'</h3>
								<p>'.esc_html( $extension['rate_duration'] ).'</p>
							</li>';
						}
						?>
                    </ul>
                </div>
                <!-- Domain Extensions End -->
		<?php

		if( $Css ){
			echo $this->helper->hoskia_inline_css( $Css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
}

$domainsearch = new WPBakeryShortCode_domainextension();


?>