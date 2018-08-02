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
 

	//  Call Header
	get_header();

	/**
	 * 404 page
	 * @Hook hoskia_fof
	 * @Hooked hoskia_fof_cb
	 *
	 */

	do_action( 'hoskia_fof' );

	 // Call Footer
	 get_footer();
?>