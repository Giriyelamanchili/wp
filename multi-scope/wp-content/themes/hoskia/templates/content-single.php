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
<!-- Post Item Start -->
<div id="<?php the_ID(); ?>" <?php post_class( 'post--item post--single' ); ?>>
	<?php 

	/**
	 * Blog Post Meta
	 * @Hook  hoskia_blog_posts_meta
	 *
	 * @Hooked hoskia_blog_posts_meta_cb
	 * 
	 *
	 */
	do_action( 'hoskia_blog_posts_meta' );

	/**
	 * Blog Post thumbnail
	 * @Hook  hoskia_blog_posts_thumb
	 *
	 * @Hooked hoskia_blog_posts_thumb_cb
	 * 
	 *
	 */
	do_action( 'hoskia_blog_posts_thumb' );

	?>
	<div class="post--details">
		<?php 
		/**
		 * Blog single page content 
		 * Post social share
		 * @Hook  hoskia_blog_posts_content
		 *
		 * @Hooked hoskia_blog_posts_content_cb
		 * 
		 *
		 */
		do_action( 'hoskia_blog_posts_content' );

		?>
	</div>
</div>
<?php 
/**
 * Blog single post meta category, tag, next - previous link and comments form
 * @Hook  hoskia_blog_single_meta
 *
 * @Hooked hoskia_blog_single_meta_cb
 * 
 *
 */
do_action( 'hoskia_blog_single_meta' );

?>