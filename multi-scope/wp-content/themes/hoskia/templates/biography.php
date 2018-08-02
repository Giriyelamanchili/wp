<?php 
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}
/**
 *
 * @Packge      Singara
 * @Author      ThemeLooks
 * @Author URL  https//www.themelooks.com
 * @version     1.0
 *
 */
 
 
 $author = get_the_author();
?>
<div class="post-author-metadata">
	<h4 class="post-author--name h4">
	<?php echo sprintf(  __('%s %s', 'hoskia' ), 'Published by', $author ); ?>
	 
	</h4>

	<div class="post-author--inner">
		<div class="post-author--img">
			<?php 
			// show avatar
			$avatar = get_avatar( get_the_author_meta( 'ID' ),70 );
			if( $avatar  ){
				echo wp_kses_post( $avatar );
			}
			?>
		</div>
		
		<div class="post-author--info">
			<p class="post-author--desc"><?php esc_html( the_author_meta('description') ); ?></p>

			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="post-author--action"><?php echo sprintf( __( '%s %s', 'hoskia' ), 'All Posts of', $author ); ?><i class="fa fa-long-arrow-right"></i></a>
		</div>
	</div>
</div>