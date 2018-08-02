<?php 
/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
	
	/**
	 * Remove Hooks
	 *
	 */
	
	// Remove Add to cart Button 
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0 );
	
	// Remove loop product link open
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	
	// Remove loop product link close
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	
	// Remove woocommerce shop page product title
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	
	// Remove woocommerce shop loop rating
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	
	// Remove woocommerce shop loop price
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	
	// Remove woocommerce shop loop price
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	
	// Remove template single Title
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	
	// Remove template single rating
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	
	// Remove template single price
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	
	// Remove template single excerpt
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	
	// Remove template single add to cart
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	
	// Remove template single meta
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	
	// Remove template single related product from after summery 
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	
	// Remove cross sell from cart page 
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );	
	
	/**
	 * Woo Hook customization
	 * 
	 */
	
	
	/****************
		Shop Page
	****************/
	
	/**
	 * woo_hide_page_title
	 *
	 * Removes the "shop" title on the main shop page
	 */

	add_filter( 'woocommerce_show_page_title' , 'hoskia_hide_woo_page_title' );
	function hoskia_hide_woo_page_title() {
		
		if( hoskia_opt('hoskia_woo_shoptitle_switch') == false ){
			return false;
		}else{
			return true;
		}
		
	}
	// woo related products posts per page number
	add_filter( 'woocommerce_output_related_products_args', 'hoskia_related_products_args' );
	  function hoskia_related_products_args( $args ) {
		$args['posts_per_page'] = esc_html( hoskia_opt('hoskia_woo_relproduct_num') ); // 4 related products
		
		return $args;
	}
	
	// Shop Page Product per page 

	add_filter( 'loop_shop_per_page', 'hoskia_loop_shop_per_page', 20 );
	function hoskia_loop_shop_per_page( $cols ) {

	  // Return the number of products you wanna show per page.
	  
		if( hoskia_opt( 'hoskia_woo_product_perpage' ) ){
			$num = hoskia_opt( 'hoskia_woo_product_perpage' );
		}else{
			$num = 10;
		}
	  
	  $cols = esc_html( $num );
	  return $cols;
	}
	
	
	// Override woocommerce_after_shop_loop_item_title hook
	add_action( 'woocommerce_after_shop_loop_item_title', 'hoskia_shop_loop_details' );
	function hoskia_shop_loop_details(){
		?>
		<div class="product--details">
			<?php 
			hoskia_woocommerce_template_loop_product_title();
			?>
			<div class="clearfix">
				<div class="product--price pull-left">
					<?php woocommerce_template_loop_price(); ?>
				</div>
				
				<div class="product--rating pull-right">
				<?php woocommerce_template_loop_rating(); ?>
				</div>
			</div>
		</div>
		<?php
	}
		

	//Show the product title in the product loop. hooked in ## hoskia_shop_loop_details
	function hoskia_woocommerce_template_loop_product_title() {
		echo '<h2 class="h4"><a href="'.esc_url( get_the_permalink() ).'">' . get_the_title() . '</a></h2>';
	}

	//Show shop loop product thumbnail.
	add_action( 'woocommerce_before_shop_loop_item_title', 'hoskia_before_shop_loop_item_title' );
	function hoskia_before_shop_loop_item_title() {
		?>
		<div class="product--img">
			<figure>
			<?php 
			woocommerce_show_product_loop_sale_flash();
			woocommerce_template_loop_product_thumbnail();
			?>				
			<figcaption class="bg--overlay">
				<div class="vc--parent">
					<div class="vc--child">
						<ul class="nav nav-justified">
							
							<?php 
							hoskia_shop_loop_add_to_cart_button(); 

							//
							hoskia_compare_btn();

							//
							hoskia_quickview_btn();
							//
							hoskia_wishlist_btn();
							?>
						</ul>
					</div>
				</div>
			</figcaption>
			</figure>
		</div>
                                
		<?php 
	}
	// shop loop add to cart button
	function hoskia_shop_loop_add_to_cart_button(){
		
		global $product;
		//is_type
		
		$class = '';
		
		if( $product->is_type('simple') ){
			$class = 'btn btn-default button product_type_simple add_to_cart_button ajax_add_to_cart';
		}elseif( $product->is_type('variable') ){
			$class = 'btn btn-default button product_type_variable add_to_cart_button';
		}
		
		//
		echo apply_filters( 'woocommerce_loddop_add_to_cart_link',
			sprintf( '<li><span data-toggle="tooltip" title="Add to cart"><a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa fa-cart-arrow-down"></i></a></span></li>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'btn btn-default' ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
		
	}

	// Handle cart in header fragment for ajax add to cart
	add_filter('woocommerce_add_to_cart_fragments', 'hoskia_header_add_to_cart_fragment');
	function hoskia_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
	 
		ob_start();
	 
		echo hoskia_woocommerce_cart_count();
	 
		$fragments['a.cart-button'] = ob_get_clean();
	 
		return $fragments;
	 
	}
		// Cart header fragment CallBack 
	function hoskia_woocommerce_cart_count() {
		global $woocommerce;
		
		$imgicon = hoskia_opt( 'hoskia_cart_imgicon' );
		$faicon  = hoskia_opt( 'header-cart-icon' );
				
		$icon = '';
		
		if( !empty( $imgicon['url'] ) ){
			$icon .= hoskia_img_tag(
				array(
					'url' => esc_url( $imgicon['url'] )
				)
			);
			
		}else{
			$icon .= '<i class="fa '.esc_attr( $faicon ).'"></i>';
		}
		
		//
		$catrCount = '<a href="'.esc_url( wc_get_cart_url() ).'" class="cart-button">'.wp_kses_post( $icon ).'<span>'.sprintf ( _n( '%d', '%d', $woocommerce->cart->cart_contents_count, 'hoskia' ), $woocommerce->cart->cart_contents_count ).'</span></a>';
		
		return $catrCount;
		
	}
	
	// Custom wishlist button
	function hoskia_wishlist_btn(){
		if( function_exists( 'YITH_WCWL' ) ){
			global $product;

			// get product type
			$product_id = $product->get_id();
			$current_product = wc_get_product( $product_id );
			$product_type = $current_product->get_type();
			
			// default wishlist id
			$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

			if( ! empty( $default_wishlists ) ){
				$default_wishlist = $default_wishlists[0]['ID'];
			}
			else{
				$default_wishlist = false;
			}

			// exists in default wishlist
			$exists = YITH_WCWL()->is_product_in_wishlist( $product_id, $default_wishlist );
			
			$wishlist_url = YITH_WCWL()->get_wishlist_url();
				

				$tag = 'li';
			
		?>
			<!-- wishlist alert -->

			<<?php echo esc_attr( $tag ); ?> class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?>">
				
				<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" class="add_to_wishlist yith-wcwl-add-button btn btn-default button <?php echo ( $exists ) ? 'hide': 'show' ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" title="Wishlist" data-toggle="tooltip" style="display:<?php echo esc_attr( ( $exists ) ? 'none': 'inline-block' ); ?>"><i class="fa fa-heart-o"></i></a>
				
					<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
						<span class="feedback"><?php esc_html_e( 'Product added!', 'hoskia' )  ?> </span>
						<a href="<?php echo esc_url( $wishlist_url )?>" rel="nofollow">
							<?php echo apply_filters( 'yith-wcwl-browse-wishlist-label', esc_html__( 'Browse Wishlist', 'hoskia' ) )?>
						</a>
					</div>

					<div class="yith-wcwl-wishlistexistsbrowse <?php echo ( $exists  ) ? 'show' : 'hide' ?>" style="display:<?php echo esc_attr( ( $exists ) ? 'block' : 'none' ); ?>">
						<span class="feedback"><?php esc_html_e( 'The product is already in the wishlist!', 'hoskia' ) ?></span>
						<a href="<?php echo esc_url( $wishlist_url ) ?>" rel="nofollow">
							<?php echo apply_filters( 'yith-wcwl-browse-wishlist-label', esc_html__( 'Browse Wishlist', 'hoskia' ) )?>
						</a>
					</div>

					<div style="clear:both"></div>
					<div class="yith-wcwl-wishlistaddresponse"></div>
			</<?php echo esc_attr( $tag ); ?>>

		<!-- End wishlist alert -->
	<?php
		}
		
	}	
	
	// Custom compare button
	function hoskia_compare_btn(){
		
		global $product;

		// get product type
		$product_id = $product->get_id();
	
		if ( ! $product_id ) {
			global $product;
			$product_id = ! is_null( $product ) ? yit_get_prop( $product, 'id', true ) : 0;
		}

		// return if product doesn't exist
		if ( empty( $product_id ) || apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) )
			return;

		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'hoskia' ) );
			do_action ( 'wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			$button_text = apply_filters( 'wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text' );
		}
		
		if( !is_product() ){
			printf( '<li><a href="%s" data-toggle="tooltip" title="Compare" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-exchange"></i></a></li>','' , 'compare' . ( $is_button == 'button' ? ' button' : '' ), $product_id );
		}else{
			printf( '<li><a href="button"  class="btn btn-default %s" data-product_id="%d" rel="nofollow" data-toggle="button"><i class="fa fa-exchange"></i></a></li>','compare' . ( $is_button == 'button' ? ' button' : '' ), $product_id );
		}
		
		
	
	}	
	
	// Custom quick view button
	function hoskia_quickview_btn(){
		
			global $product;
			
			// get product type
			$product_id = $product->get_id();
		
			if ( ! $product_id ) {
				global $product;
				$product_id = ! is_null( $product ) ? yit_get_prop( $product, 'id', true ) : 0;
			}
			
			// get product id
			! $product_id && $product_id = yit_get_prop( $product, 'id', true );

			$button = '<li><a href="#" data-toggle="tooltip" title="Quick View" class="button on-block yith-wcqv-button" data-product_id="' . $product_id . '"><i class="fa fa-eye"></i></a></li>';
			
            echo apply_filters( 'yith_add_quick_view_button_html', $button, $product );

			
	
	}	
	
	/************************
		Single Product Page
	************************/
	
	// Product Summary
	add_action( 'woocommerce_single_product_summary', 'hoskia_single_product_summary' );
	function hoskia_single_product_summary(){
		global $product;
		?>
		<div class="product--single-summery">
			
			<?php woocommerce_template_single_title(); ?>
			
			<div class="product--single-summery-links">
				<?php woocommerce_template_single_rating(); ?>
			</div>
			
			<div class="product--single-summery-text">
				<?php woocommerce_template_single_excerpt(); ?>
			</div>
			
			<div class="product--single-summery-meta">
				<form action="#" method="get">
					<table class="table">
						<?php 
						if( $stock =  wc_get_stock_html( $product ) ){
							echo '<tr>';
								echo '<th>'.esc_html__( 'Availability', 'hoskia' ).'</th>';
								echo '<td>'.wc_get_stock_html( $product ).'</td>';
							echo '</tr>';
						}
						//
						if ( $price_html = $product->get_price_html() ) : 
						?>
						<tr>
							<th><?php esc_html_e( 'Price', 'hoskia' ); ?></th>
							<td>
								<div class="product--price pull-left">
									<?php woocommerce_template_single_price(); ?>
								</div>
							</td>
						</tr>
						<?php 
						endif;
						?>
						<tr>
							<th class="middle"><?php esc_html_e( 'Quantity', 'hoskia' ); ?></th>
							<?php woocommerce_template_single_add_to_cart(); ?>
						</tr>
						<?php 
						// Product Suk
						hoskia_product_suk();
						// Product Category
						hoskia_product_cat();
						// product Tags
						hoskia_product_tag();
						?>
					</table>
				</form>
			</div>
		</div>
		<?php 
	}
	
	// Product Category
	function hoskia_product_cat(){
		global $product;
		// Cat
		if( wc_get_product_category_list( $product->get_id() ) ){
			echo '<tr>';
				echo '<th>'.esc_html__( 'Category', 'hoskia' ).'</th>';
				echo '<td>';
					echo wc_get_product_category_list( $product->get_id(), ', ' );
				echo '</td>';
			echo '</tr>';
		}
	}
	// Product Tag
	function hoskia_product_tag(){
		global $product;
			
		if( wc_get_product_tag_list( $product->get_id() ) ){
			echo '<tr>';
				echo '<th>'.esc_html__( 'Tags', 'hoskia' ).'</th>';
				echo '<td>';
				echo '<div class="tags">';
					echo ' <li><span><i class="fa fa-tags"></i></span></li>';
					echo wc_get_product_tag_list( $product->get_id(), ', ' );
				echo '</div>';
				echo '</td>';
			echo '</tr>';
		}
	
	}
	// Product SUK
	function hoskia_product_suk(){
		global $product;
		
		if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : 
		echo '<tr>';
			 echo '<th>'.esc_html__( 'SKU', 'hoskia' ).'</th>';
			 if( $sku = $product->get_sku() ){
				echo '<td>'.esc_html( $sku ).'</td>'; 
			 }
			 

		echo '</tr>';
		endif; 
	
	}
	//  WooCommerce Breadcrumb
	add_filter( 'woocommerce_breadcrumb_defaults', 'hoskia_woocommerce_breadcrumbs' );
	function hoskia_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' &#47; ',
				'wrap_before' => '<div class="page-header--breadcrumb"><ul class="breadcrumb" itemprop="breadcrumb"><li><span><i class="fa fa-home"></i></span></li>',
				'wrap_after'  => '</ul></div>',
				'before'      => '<li>',
				'after'       => '</li>',
				'home'        => esc_html_x( 'Home', 'breadcrumb', 'hoskia' ),
			);
	}
	
	// Check cart, checkout, my account page
	function hoskia_is_ccap(){
		if( is_hoskia_woocommerce_activated() ){
			if( is_cart() || 
			is_checkout() || 
			is_account_page() ){
				return true;
			}
		}else{
			return false;
		}

	}

?>