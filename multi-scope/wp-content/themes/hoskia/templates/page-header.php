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
 

    // Overlay 
	$overlay = hoskia_opt( 'hoskia_allHeader_overlay' );
    if( $overlay ){
    	$overlay = 'bg--overlay';
    }else{
    	$overlay = '';
    }

    // Background Image
    $bg = '';
    if( get_header_image() ){
 		$bg = hoskia_data_bg_attr( get_header_image() );
    }
   

    $globalHeader = 'globpageheader'.' ';

    $class = 'class="'.esc_attr( $globalHeader.$overlay ).'"';
?>

<!-- Page Header Area Start -->
<div id="pageHeader" <?php echo wp_kses_post( $class.$bg ); ?> >
    <div class="container">
        <?php 
		// Page Header Title	
		echo '<div class="page-header--title">';	
		if(  is_hoskia_woocommerce_activated() && is_shop() ){
			echo '<h1 class="h1">';
				woocommerce_page_title();
			echo '</h1>';
			
		}else{

			if ( is_archive() ){
				the_archive_title('<h1 class="h1">', '</h1>');
			}elseif ( is_home() ){
				echo '<h1 class="h1">'.esc_html__( 'Blog', 'hoskia' ).'</h1>';
			}elseif(is_search()){
				echo '<h1 class="h1">'.esc_html__( 'Search Result', 'hoskia' ).'</h1>';
			} else{
				$posttitle_position = hoskia_opt('hoskia_blog_posttitle_position');
				$postTitlePos = false;
				if( is_single() ){

					if( $posttitle_position && $posttitle_position != '1' ){

						$postTitlePos = true;
					}
				}

				if( $postTitlePos != true ){
					the_title( '<h1 class="h1">', '</h1>' );
				}
				
			}
		}
		echo '</div>';

    	// Page Header Breadcrumb
    	if( hoskia_opt( 'hoskia_enable_breadcrumb' ) ){
	    	hoskia_breadcrumbs(
	    		array(
	    			'breadcrumbs_classes' => 'breadcrumb',
	    		)
	    	);
    	}
    	?>
    </div>
</div>