<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_map extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
		
		// Hoskia Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_map_maping' ) );
				
		// Hoskia Feature Tab Element shortcode
		add_shortcode( 'ssdhostmap', array( $this, 'hoskia_map_shortcode' ) );
		
	}
	
	
	// Feature Tab vc Param
	public function hoskia_map_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Map", "hoskia" ),
		  "base" => "ssdhostmap",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Latitude", "hoskia" ),
				"param_name"  => "latitude",
				"description" => esc_html__( "Set latitude.", "hoskia" ),
				"group"		 => esc_html__( "Center Marker", "hoskia" ),
			),
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Longitude", "hoskia" ),
				"param_name"  => "longitude",
				"description" => esc_html__( "Set longitude.", "hoskia" ),
				"group"		 => esc_html__( "Center Marker", "hoskia" ),
			),
			array(
				"type" 		  => "textfield",
				"heading" 	  => esc_html__( "Zoom", "hoskia" ),
				"param_name"  => "zoom",
				"description" => esc_html__( "Set zoom.", "hoskia" ),
				"group"		 => esc_html__( "Zoom", "hoskia" ),
			),
		  	array(
			"type"		 => "param_group",
			'param_name' => 'multimarker',
			"group"		 => esc_html__( "Multi Marker", "hoskia" ),
			'heading' 	 => esc_html__( 'Set Latitude and Longitude.', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Latitude", "hoskia" ),
					"param_name"  => "latitude",
					"description" => esc_html__( "Set latitude.", "hoskia" )
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Longitude", "hoskia" ),
					"param_name"  => "longitude",
					"description" => esc_html__( "Set longitude.", "hoskia" )
				),
			),
			),
		  )
		) );
		
		
	}
	
	// Feature Tab Element Shortcode and markup
	public function hoskia_map_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'longitude' 	=> '',
				'latitude'		=> '',
				'zoom' 	   		=> '',
				'multimarker'	=> '',
			),
		$atts
		) );
		
		// Enqueue google map api
		wp_enqueue_script( 'maps-googleapis' );
		
		//
		$multimarker = vc_param_group_parse_atts( $multimarker );

		$markers = array();
		foreach( $multimarker as $marker ){
			$markers[] = array_values( $marker );
		}
				
		$markers = json_encode( $markers, false );
		
		
		wp_localize_script(
			'hoskia-main',
			'mapdata',
			array(
				'latitude'  	=> $latitude,
				'longitude' 	=> $longitude,
				'zoom' 	    	=> $zoom,
				'multimarkup' 	=> $markers
			)

			
		);
				
		ob_start();

		?>
        <div id="map"></div>
		<?php
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
	
}

$datacenterslider = new WPBakeryShortCode_map();


?>