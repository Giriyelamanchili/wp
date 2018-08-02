<?php
// Cmb 2 Admin Script
add_action( 'admin_enqueue_scripts', 'hoskia_cmb2_admin_scripts' );
function hoskia_cmb2_admin_scripts(){
	
	
	wp_enqueue_script( 'hoskia-admin',  plugins_url( 'js/hoskia-admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-slider' ), '1.0', true );
	
}
// Switch Field 
require_once ( HOSKIA_PLUGIN_PATH.'cmb2-ext/switch_metafield.php');
// Switch Slider 
require_once ( HOSKIA_PLUGIN_PATH.'cmb2-ext/slider_metafield.php');