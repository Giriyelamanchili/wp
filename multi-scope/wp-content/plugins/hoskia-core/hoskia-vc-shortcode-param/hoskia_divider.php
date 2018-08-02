<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	// Use
	//array(
	//	'type' 		   => 'divider',
	//	'holder' 	   => 'div',
	//	'heading' 	   => __( '', 'quickfix' ),
	//	'divvider_title' => __( 'This is Divider', 'quickfix' ),
	//	'param_name'   => 'dividertip',
	//	"group"		   => __( "Design Option", "quickfix" ),
	//	'dependency' => array(
	//		'element' => 'margtype',
	//		'value'   => 'custom',
	//	),
	//),



if(!class_exists('Virsky_Divider')) {
	class Virsky_Divider {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('divider' , array(&$this, 'divider_settings_field' ));
			}
		}
	
		function divider_settings_field($settings, $value){
			
			$title = isset( $settings['divvider_title'] ) ?  $settings['divvider_title'] : '';
			
			$output = '<div class="vc-divider ">'.esc_html( $title ).'</div>';
			
			return $output;
		}
		
	}
	

	$Virsky_Divider = new Virsky_Divider();


}
