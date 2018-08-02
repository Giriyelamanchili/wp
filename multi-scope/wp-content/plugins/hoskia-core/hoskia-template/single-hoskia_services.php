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
        <!-- Page Content Area Start -->
        <div id="pageContent" class="pd--100-0">
            <div class="container">
                <div class="row">
                    <!-- Page Main Content Start -->
                    <article class="page--main-content col-md-9">
                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
							<?php 
							if( have_posts() ):
							while( have_posts() ):
							the_post();

								if( has_post_thumbnail() ){
									the_post_thumbnail();
								}
								//
								the_content();

							endwhile;
							endif;
							?>
                            <!-- Tab Pane End -->
                            
                        </div>
                        <!-- Tab Content End -->
                    </article>
                    <!-- Page Main Content End -->
                    
                    <!-- Page Sidebar Start -->
					<?php 
					$args = array(
						'taxonomy'   => 'services_cat',
						'hide_empty' => true
					);
					$terms = get_terms( $args );
					if( is_array( $terms ) && count( $terms ) > 0 ):
										
					?>
                    <aside class="page--sidebar col-md-3">
                        <!-- Page Sidebar Nav Start -->
                        <nav class="page--sidebar-nav bg-color--alabaster">
                            <ul class="nav">
								<?php 
								foreach( $terms as $term ){
									echo '<li>';
										echo '<a href="'.esc_url( get_term_link( $term->term_id ) ).'"><i class="fa fa-paint-brush"></i>'.esc_html( $term->name ).'</a>';
									echo '</li>';
								}
								?>
                            </ul>
                        </nav>
                        <!-- Page Sidebar Nav End -->
                    </aside>
					<?php 
					endif;
					?>
                    <!-- Page Sidebar End -->
                </div>
            </div>
        </div>
        <!-- Page Content Area End -->
<?php 
// Call Footer
get_footer();
?>