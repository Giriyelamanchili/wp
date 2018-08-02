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
        <!-- Services Area Start -->
        <div id="services" class="pd--100-0-40">
            <div class="container">
                <!-- Service Items Start -->
                <div class="service--items row AdjustRow">
                    <?php 
					if( have_posts() ):
						while( have_posts() ):
						the_post();
					?>
                    <div class="service--item col-md-4 col-sm-6">
						<?php 
						if( hoskia_meta( 'service-icon' ) ){
							echo '<div class="service--icon">';
								echo '<i class="fa '.esc_attr( hoskia_meta( 'service-icon' ) ).'"></i>';
							echo '</div>';
						}
						?>
                        <div class="service--content">
                            <h2 class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php the_excerpt(); ?></p>
                            
                            <a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm"><?php esc_html_e( 'View Details', 'hoskia' ); ?><i class="fa flm fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php 
						endwhile;
					endif;
					?>					
                </div>
                <!-- Service Items End -->
            </div>
        </div>
        <!-- Services Area End -->
<?php 
// Call Footer
get_footer();
?>