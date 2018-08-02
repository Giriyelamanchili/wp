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

$gridOpt	= hoskia_blog_grid();

$colStert = '<div class="col-sm-12">';
$colEnd   = '</div>';
if( $gridOpt && $gridOpt != '1' ){

	if( $gridOpt != '2' ){
		$gridOpt = '4';
	}else{
		$gridOpt = '6';
	}

	$colStert = '<div class="col-sm-'.esc_attr( $gridOpt ).'">';
	$colEnd   = '</div>';
}

// Post Item Start

echo wp_kses_post( $colStert ); // Column start for blog grid
?>
<div id="<?php the_ID(); ?>" <?php post_class( 'post--item' ); ?>>
	<?php 
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
	<div class="post--summery">
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
		 * Blog Post title
		 * @Hook  hoskia_blog_posts_title
		 *
		 * @Hooked hoskia_blog_posts_title_cb
		 * 
		 *
		 */
		do_action( 'hoskia_blog_posts_title' );

		/**
		 * Blog Excerpt With read more button
		 * @Hook  hoskia_blog_posts_excerpt
		 *
		 * @Hooked hoskia_blog_posts_excerpt_cb
		 * 
		 *
		 */
		do_action( 'hoskia_blog_posts_excerpt' );

		?>
	</div>
</div>
<?php 
// Post Item End
echo wp_kses_post( $colEnd ); // Column end for blog grid
?>