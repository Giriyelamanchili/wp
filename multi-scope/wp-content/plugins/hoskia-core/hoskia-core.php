<?php 
/**
Plugin Name: Hoskia Core
Plugin URI:  http://themelooks.com/
Description: Hoskia theme Core plugin
Version:     1.0
Author: 	 ThemeLooks
Author URI:  http://themelooks.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: hoskia
*/

// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit ( 'Direct access denied.' );
}

// Define Constant
define( 'HOSKIA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'HOSKIA_PLUGIN_TEMP', dirname( __FILE__ ).'/hoskia-template/' );

// load textdomain
load_plugin_textdomain( 'hoskia', false, basename( dirname( __FILE__ ) ) . '/languages' );


//include file.

require_once dirname( __FILE__ ) . '/inc/class-post-type.php';
require_once dirname( __FILE__ ) . '/inc/hoskiacore-functions.php';
require_once dirname( __FILE__ ) . '/inc/slider.php';
require_once dirname( __FILE__ ) . '/inc/MCAPI.class.php';
require_once dirname( __FILE__ ) . '/inc/hoskiacore-social-share.php';
require_once dirname( __FILE__ ) . '/cmb2-ext/cmb2ext-init.php';
require_once dirname( __FILE__ ) . '/inc/about-widget.php';
require_once dirname( __FILE__ ) . '/inc/subscribe-widget.php';
require_once dirname( __FILE__ ) . '/inc/social-widget.php';
require_once dirname( __FILE__ ) . '/inc/recent-post-thumb.php';


//Subscribe 
add_action( 'wp_enqueue_scripts', 'hoskia_subscribe_scripts' );
function hoskia_subscribe_scripts(){
	
	wp_enqueue_script( 'subscribe-main', plugins_url( 'js/subscribe-main.js', __FILE__ ), array('jquery'), '1.0', true );
	
	
	wp_enqueue_script( 'subscribe-main' );
	wp_localize_script(
		'subscribe-main',
		'subscribeajax',
		array(
			'action_url' => admin_url( 'admin-ajax.php' )
		)
	);
}


//Add a meta box to the 'pages' post type
function hoskia_shortcode() {
	
	add_meta_box(
		'shoetcode_meta_box', //unique ID
		esc_html__('Shortcode','hoskia'), //Name shown in the backend
		'hoskia_shortcode_meta_box', //function to output the meta box
		'hoskia_slider', //post type this box will attach to
		'side', //position (side,advanced, normal etc)
		'high' //priority (high, default, low etc)
	);

}
add_action( 'add_meta_boxes','hoskia_shortcode' );


//defines the output for our pages meta box
function hoskia_shortcode_meta_box( $post ){
//create nonce
wp_nonce_field( 'shortcode_meta_box','shortcode_meta_box_nonce' );
	
//collect related pages (if we already have some)

    
    $data = '[slider id=&quot;'. esc_html( get_the_ID() ) .'&quot;]';


echo '<input type="text" readonly name="shortcode_meta" value="'.esc_attr( $data ).'" />';
	
}

//
add_filter( 'manage_edit-hoskia_slider_columns', 'hoskia_edit_hoskia_slider_columns' ) ;

function hoskia_edit_hoskia_slider_columns( $columns ) {

	$columns = array(
		'cb' 		 => '<input type="checkbox" />',
		'title' 	 => esc_html__( 'Slider Name', 'hoskia' ),
		'shortcode'  => esc_html__( 'Shortcode', 'hoskia' ),
		'date'		 => esc_html__( 'Date', 'hoskia' )
	);

	return $columns;
}

add_action( 'manage_hoskia_slider_posts_custom_column', 'hoskia_manage_slider_columns', 10, 2 );

function hoskia_manage_slider_columns( $column, $post_id ) {
	
	global $post;
	
	switch( $column ) {
		
		/* If displaying the 'duration' column. */
		case 'shortcode' :
			echo '<code>'.esc_html( '[slider id="'.$post_id.'"]' ).'</code>';
			break;
		default :
			break;
	}
}


// Visual Composer Constant

define('HOSKIA_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define('HOSKIA_PLUGVPATHTEMPDIR', dirname( __FILE__ ) );
define('HOSKIA_ELEMENTS', dirname( __FILE__ ).'/hoskia-elements/' );

// Elements File include
function hoskia_wpb_elements_inc(){

	// Check is visual composer active
	if( defined( 'WPB_VC_VERSION' ) ){

	// Visual Composer Custom Param Shortcode
	require_once( HOSKIA_PLUGVPATHTEMPDIR  . '/hoskia-vc-shortcode-param/hoskia-vc-adons.php' );
	// Visual Composer helper function
	require_once( HOSKIA_PLUGVPATHTEMPDIR . '/vc-include/class-vc-helper.php' );

	// VC Elements Include

	require_once( HOSKIA_ELEMENTS . 'hoskia-section.php' );
	require_once( HOSKIA_ELEMENTS . 'section-heading.php' );
	require_once( HOSKIA_ELEMENTS . 'feature.php' );
	require_once( HOSKIA_ELEMENTS . 'pricing.php' );
	require_once( HOSKIA_ELEMENTS . 'counter.php' );
	require_once( HOSKIA_ELEMENTS . 'service.php' );
	require_once( HOSKIA_ELEMENTS . 'testimonial.php' );
	require_once( HOSKIA_ELEMENTS . 'feature-v2.php' );
	require_once( HOSKIA_ELEMENTS . 'team-slider.php' );
	require_once( HOSKIA_ELEMENTS . 'domain-search.php' );
	require_once( HOSKIA_ELEMENTS . 'domain-extension.php' );
	require_once( HOSKIA_ELEMENTS . 'pricing-filter.php' );
	require_once( HOSKIA_ELEMENTS . 'pricing-feature-list.php' );
	require_once( HOSKIA_ELEMENTS . 'horizontal-table.php' );
	require_once( HOSKIA_ELEMENTS . 'single-img.php' );
	require_once( HOSKIA_ELEMENTS . 'text-area.php' );
	require_once( HOSKIA_ELEMENTS . 'faq.php' );
	require_once( HOSKIA_ELEMENTS . 'feature-tab.php' );
	require_once( HOSKIA_ELEMENTS . 'horizontal-table-tab.php' );
	require_once( HOSKIA_ELEMENTS . 'gallery.php' );
	require_once( HOSKIA_ELEMENTS . 'datacenter.php' );
	require_once( HOSKIA_ELEMENTS . 'map.php' );
	require_once( HOSKIA_ELEMENTS . 'comingsoon.php' );
	require_once( HOSKIA_ELEMENTS . 'service-type.php' );
	require_once( HOSKIA_ELEMENTS . 'vps-slider.php' );
	require_once( HOSKIA_ELEMENTS . 'team-single-el.php' );
	require_once( HOSKIA_ELEMENTS . 'nav.php' );

	} // End Check visual composer

}
add_action( 'init', 'hoskia_wpb_elements_inc', 9 );


// Megamenu Data Import
function megamenu_add_theme_hoskia_1526713718($themes) {
    $themes["hoskia_1526713718"] = array(
        'title' => 'hoskia',
        'container_background_from' => 'rgba(255, 255, 255, 0.1)',
        'container_background_to' => 'rgba(255, 255, 255, 0.1)',
        'menu_item_align' => 'right',
        'menu_item_background_hover_from' => 'rgba(255, 255, 255, 0.1)',
        'menu_item_background_hover_to' => 'rgba(255, 255, 255, 0.1)',
        'menu_item_link_font_size' => '16px',
        'menu_item_link_color' => 'rgba(255, 255, 255, 0.1)',
        'menu_item_link_text_align' => 'right',
        'menu_item_link_color_hover' => 'rgba(255, 255, 255, 0.1)',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'flyout_width' => '164px',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'toggle_background_from' => '#222',
        'toggle_background_to' => '#222',
        'toggle_font_color' => 'rgba(255, 255, 255, 0.1)',
        'mobile_background_from' => '#222',
        'mobile_background_to' => '#222',
        'mobile_menu_item_link_font_size' => '14px',
        'mobile_menu_item_link_color' => '#ffffff',
        'mobile_menu_item_link_text_align' => 'left',
        'mobile_menu_item_link_color_hover' => 'rgba(255, 255, 255, 0.1)',
        'mobile_menu_item_background_hover_from' => 'rgba(255, 255, 255, 0.1)',
        'mobile_menu_item_background_hover_to' => 'rgba(255, 255, 255, 0.1)',
        'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_hoskia_1526713718");
?>