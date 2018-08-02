<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */

?>
<div id="page_<?php the_ID(); ?>" <?php post_class( 'post--item' ); ?>>
	<div class="page--details">
		<?php 

		/**
		 * page content 
		 * Comments Template
		 * @Hook  hoskia_page_content
		 *
		 * @Hooked hoskia_page_content_cb
		 * 
		 *
		 */
		do_action( 'hoskia_page_content' );

		?>
	</div>
</div>