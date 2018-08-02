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
 * Template Name: Template WHMCS
 */
 
get_header();
    echo '<div id="hoskiaWhmcsPage">';
        if( have_posts() ){
            while( have_posts() ){
                the_post();
                
                the_content();
            }

        }
    echo '</div>';

get_footer();
?>