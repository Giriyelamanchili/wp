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

// Call Header
get_header();
?>
	<div class="gallery--section pd--100-0-70">
		<div class="container">
			<div class="gallery--items row">
				<?php 

					if( have_posts() ):
					while( have_posts() ): the_post();

				?>
				<div class="gallery--item col-sm-6 col-md-4 col-xs-6 col-xxs-12">
					<figure>
						<a href="<?php the_permalink(); ?>">
						<?php 
						$imgUrl = get_the_post_thumbnail_url();
						if( $imgUrl ){
							echo '<img src="'.esc_url( $imgUrl ).'" alt="'.esc_attr( hoskia_image_alt( $imgUrl ) ).'" >';
						}
						?>
						<div class="figcaption bg--overlay">
							<div class="vc--parent">
								<div class="vc--child">
									<i class="fa fa-link"></i>
									<h3 class="h4"><?php the_title(); ?></h3>
								</div>
							</div>
						</div>
						</a>
					</figure>
				</div>
				<?php 
				endwhile;
				wp_reset_postdata();
				endif;
				?>					
			</div>
		</div>
	</div>
<?php 
// Call Footer
get_footer();
?>