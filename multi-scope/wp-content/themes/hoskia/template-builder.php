<?php 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 * @Packge    : Hoskia
 * @version   : 1.0
 * @Author    : ThemeLooks
 * @Author URI: https://www.themelooks.com/
 * Template Name: Template Builder
 */
 
get_header();


// Container or wrapper div
$layout = hoskia_meta( 'custom_page_layout' );

$padding = hoskia_meta( 'custom_page_padding' );

if( $padding ){
	$padding = 'style="padding-top:'.esc_attr( $padding ).'px;padding-bottom:'.esc_attr( $padding ).'px;"';
}else{
	$padding = '';
}

if( $layout == '1' ){
	echo '<div class="container">';
	echo '<div class="row">';
	echo '<div class="col-sm-12">';
}elseif( $layout == '2' ){
	echo '<div class="container-fluid">';
	echo '<div class="row">';
	echo '<div class="col-sm-12">';
}else{
	echo '<div class="hoskia-fluid">';
}
	echo '<div class="builder-page-wrapper" '.wp_kses_post( $padding ).'>';
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
	}

	echo '</div>';
if( $layout == '1' ){
	echo '</div></div></div>';
}elseif( $layout == '2' ){
	echo '</div></div></div>';
}else{
	echo '</div>';
}
// Container or wrapper div end


get_footer();
?>