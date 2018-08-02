<?php 
/**
 * @Packge 	   : Hoskia
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
 get_header();
 

	if( !is_product() ){
		$sidebar = hoskia_opt('hoskia_woo_shoppage_sidebar');
	}else{
		$sidebar = hoskia_opt('hoskia_woo_singlepage_sidebar');
	}
 
 ?>
 
        <div id="products" class="pd--100-0-40">
            <div class="container">
                <div class="row">
				<!-- Blog Content Start -->
				<?php 
				if( $sidebar == '1' ){
					echo '<div class="col-md-12 pb--60">';
				}else{
					echo '<div class="col-md-9 '.esc_attr( hoskia_pull_right( $sidebar ,'2' ) ).' pb--60">';
				}
				?>
						<?php 
						if( have_posts() ){
							
							// Woocommerce Content
							woocommerce_content();
						
						}else{
							get_template_part( 'templates/content', 'none' );
						}
						
						?>
				</div>
				<?php 		
			
				// sidebar
				if( $sidebar != '1' ){
					get_sidebar( 'woo' );
				}
				?>
				
			</div>
			<?php 
			if( is_product() ){
				woocommerce_output_related_products();
			}
			
			?>
		</div>
	</div>
	<!-- Woocommerce Section End -->
<?php
 get_footer();
?>