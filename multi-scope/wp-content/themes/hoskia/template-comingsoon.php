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
 * Template Name: Template Coming Soon
 */
 
get_header();


// Container or wrapper div
echo '<div id="comingSoon">';
	echo '<div class="row reset-gutter">';
   
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
	}

  echo '</div>';
echo '</div>';
// Container or wrapper div end


get_footer();
?>