<?php 
/**
 * Hoskia Service Element
 */
class WPBakeryShortCode_servicetype extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_servicetype_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostservicetype', array( $this, 'hoskia_servicetype_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_servicetype_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Service Type", "hoskia" ),
		  "base" => "ssdhostservicetype",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  	array(
				'heading'    => esc_html__( 'Choose Style', 'hoskia' ),
				'type'       => 'radio_image_select',
				'param_name' => 'service_style',
				'simple_mode'		=> false,
				'options'    => array(
					'style-1'	=> array(
						'tooltip'	=> esc_attr__('Simple','hoskia'),
						'src'		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/testi-style-3.png'
					),
					'style-2'	=> array(
						'tooltip'	=> esc_attr__('Bordered','hoskia'),
						'src'		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/counter-style-2.png'
					)
				),
			),
			array(
				"type" => "textfield",
				"heading" => __( "Services Per Page", "hoskia" ),
				"param_name" => "perpage",
				"description" => __( "Set how many service show in section.", "hoskia" )
			),
			array(
				"type" => "css_editor",
				"heading" => __("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		=> __( "Design Option", "hoskia" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_servicetype_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'service_style'  => '',
				'perpage'  		 => '',
				'css'  	 		 => '',
			),
		$atts
		) );
		
	
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostservicetype', $atts );
		
		// Service Style
		if( $service_style != 'style-1' ){
			$style = 'affiliate--services';
			$ov = ' text-center';
		}else{
			$style = 'services';
			$ov = '';
		}
				
		ob_start();
		?>
		<div class="service--items row AdjustRow">
			<?php 
			$args = array(
				'post_type' => 'hoskia_services', 
				'posts_per_page' => $perpage, 
			);
			
			$loop = new WP_Query( $args );
			
			if( $loop->have_posts() ):
				echo '<div class="'.esc_attr( $style ).'" data-scroll-reveal="group">';
				while( $loop->have_posts() ):
				$loop->the_post();
			?>
				<div class="service--item col-md-4 col-sm-6 <?php echo esc_attr( $css_class.$ov ); ?>">
					<?php 
					if( hoskia_meta( 'service-icon' ) ){
						echo '<div class="service--icon">';
							echo '<i class="fa '.esc_attr( hoskia_meta( 'service-icon' ) ).'"></i>';
						echo '</div>';
					}
					?>
					<div class="service--content">
						<h2 class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						 <?php the_excerpt(); ?>
						
						<a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm"><?php esc_html_e( 'View Details', 'hoskia' ); ?><i class="fa flm fa-long-arrow-right"></i></a>
					</div>
				</div>
			<?php 
				endwhile;
				wp_reset_postdata();
				echo '</div>';
			endif;
			?>					
		</div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_servicetype();


?>