<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Hoskia
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

// Sidebar
if( is_active_sidebar( 'hoskia-post-sidebar' ) ){
	
	echo '<aside class="page--sidebar col-md-3">';
		dynamic_sidebar( 'hoskia-post-sidebar' );
	echo '</aside>';
}
 

?>