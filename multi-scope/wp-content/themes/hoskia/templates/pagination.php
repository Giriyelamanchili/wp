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
 
  //
 
    //Pagination
	if( get_next_posts_link() || get_previous_posts_link() ){

		echo '<div class="col-sm-12 posts--pager">';
		
			if( hoskia_opt( 'hoskia_blog_pagination' ) == 1 ){
				if ( function_exists('hoskia_pagination') ){
					echo '<nav class="blog-page--pagination">';
						hoskia_pagination();
					echo '</nav>';
				}

			}else{
					$newer 	= '<i class="fa fm fa-long-arrow-left"></i>'.esc_html__( 'Newer Post', 'hoskia' );
					$older 	= esc_html__( 'Older Post', 'hoskia' ).'<i class="fa flm fa-long-arrow-right"></i>';

                    echo '<ul class="pager">';
					
						echo '<li class="previous">';
						if( get_previous_posts_link() ){
							previous_posts_link( $newer );
						}else{
							echo wp_kses_post( '<span class="hidden">'.$newer.'</span>' );
						}
						echo '</li>';
						//
						echo '<li class="next">';
						if( get_next_posts_link() ){
							next_posts_link( $older );
						}else{
							echo wp_kses_post( '<span class="hidden">'.$older.'</span>' );
						}
						echo '</li>';
					echo '</ul>';
			}
		echo '</div>';
	}
	

	
	
    
?>