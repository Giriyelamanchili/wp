<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_datacenterslider extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
		
		// Hoskia Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_datacenterslid_maping' ) );
				
		// Hoskia Feature Tab Element shortcode
		add_shortcode( 'ssdhostdatacenterslid', array( $this, 'hoskia_datacenterslid_shortcode' ) );
		
	}
	
	
	// Feature Tab vc Param
	public function hoskia_datacenterslid_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Datacenter Slider", "hoskia" ),
		  "base" => "ssdhostdatacenterslid",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  	array(
			"type"		 => "param_group",
			'param_name' => 'dcsliders',
			"group"		 => esc_html__( "Sliders", "hoskia" ),
			'heading' 	 => esc_html__( 'Set Content', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 			=> "attach_image",
					"holder" 		=> "div",
					"heading" 		=> esc_html__( "Image", "hoskia" ),
					"param_name" 	=> "img",
					"description" 	=> esc_html__( "Set image.", "hoskia" ),
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Title", "hoskia" ),
					"param_name"  => "title",
					"description" => esc_html__( "Set title.", "hoskia" )
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Sub Title", "hoskia" ),
					"param_name"  => "subtitle",
					"description" => esc_html__( "Set sub title.", "hoskia" )
				),
				array(
					"type" 		  => "textarea",
					"heading" 	  => esc_html__( "Description", "hoskia" ),
					"param_name"  => "description",
					"description" => esc_html__( "Set description.", "hoskia" )
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Button Label", "hoskia" ),
					"param_name"  => "btnlabel",
					"description" => esc_html__( "Set button label.", "hoskia" )
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Button Url", "hoskia" ),
					"param_name"  => "btnurl",
					"description" => esc_html__( "Set button url.", "hoskia" )
				),

	
			),
			),	
			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
			),		

		  )
		) );
		
		
	}
	


	// Feature Tab Element Shortcode and markup
	public function hoskia_datacenterslid_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'dcsliders'	=> '',
				'css' 	   	=> '',
			),
		$atts
		) );
		// Enqueue owl carousel
		wp_enqueue_script( 'owl-carousel' );

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostdatacenterslid', $atts );

		$dcsliders = vc_param_group_parse_atts( $dcsliders );

		
		$tab 		= '';
		$tabContent = '';
		$i = 0;
		foreach( $dcsliders as $key => $dcslider ){
			
			$id = uniqid().rand();
			$active = '';
			if( $i == 0 ){
				$active = 'in active';
			}
					
			
			// Tab
			$imgurl = wp_get_attachment_image_src( $dcslider['img'] , 'full' );
			
			$tab .= '
			<a  href="#datacenterItem'.esc_attr( $id ).'" data-toggle="tab">
			<img src="'.esc_url( $imgurl[0] ).'" alt="'.esc_attr( hoskia_image_alt( $imgurl[0] ) ).'"  />
			</a>';
			
			// Tab Content
		
			$tabContent .= '<div class="tab-pane fade '.esc_attr( $active ).'" id="datacenterItem'.esc_attr( $id ).'">
				<div class="datacenter--title">
				'.( !empty( $dcslider['title'] ) ? 
				'<h2 class="h3">'.esc_html( $dcslider['title'] ).'</h2>' : '' ).
				( !empty( $dcslider['subtitle'] ) ? 
				'<p>'.esc_html( $dcslider['subtitle'] ).'</p>' : '' ).'
				</div>
				'.( !empty( $dcslider['description'] ) ?
					'<div class="datacenter--text"><p>'.wp_kses_post( $dcslider['description'] ).'</p></div>' :''
				).
				( !empty( $dcslider['btnurl'] ) && !empty( $dcslider['btnlabel'] )  ?
				'<div class="datacenter--footer"><a href="'.esc_url( $dcslider['btnurl'] ).'" class="btn btn-default">'.esc_html( $dcslider['btnlabel'] ).'</a></div>' : '' ).
				
			'</div>';
		$i++;		
		}
		
		
		ob_start();

			//
			if( is_array( $dcsliders ) && count( $dcsliders ) > 0 ):

			?>
			<div id="datacenter" class="pd--100-0">
				<div class="container">
					<div class="row">
						<div class="datacenter--img col-md-5">
							<div class="datacenter--slider owl-carousel" data-carousel-autoplay="true" data-carousel-items="1" data-carousel-nav="true">
							<?php 
							echo wp_kses_post( $tab );
							?>
							</div>
						</div>
						<div class="datacenter--content col-md-7">
							<div class="tab-content">
								<?php 
								echo wp_kses_post( $tabContent );
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php 
			endif;
			?>
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	
}

$datacenterslider = new WPBakeryShortCode_datacenterslider();


?>