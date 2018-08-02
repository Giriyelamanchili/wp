<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_testimonial extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_testimonial_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhosttestimonial', array( $this, 'hoskia_testimonial_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_testimonial_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Testimonial", "hoskia" ),
		  "base" => "ssdhosttestimonial",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
			array(
				"type" 		 => "floatnumber",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Per Slide Number ( On Desktop )", "hoskia" ),
				"param_name" => "slidenumber",
				"group"		 => esc_html__( "Testimonial", "hoskia" ),
			),
			array(
				"type" 		 => "floatnumber",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Per Slide Number ( On Mobile 768px )", "hoskia" ),
				"param_name" => "slidenumbermob",
				"group"		 => esc_html__( "Testimonial", "hoskia" ),
			),	
		  	array(
			"type"		 => "param_group",
			'param_name' => 'testimonials',
			"group"		 => esc_html__( "Testimonial", "hoskia" ),
			'heading' 	 => esc_html__( 'Set Content', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Title", "hoskia" ),
					"param_name" => "title",
				),	
				array(
					"type" 		  => "attach_image",
					"holder" 	  => "div",
					"heading" 	  => esc_html__( "Image", "hoskia" ),
					"param_name"  => "img",
					"description" => esc_html__( "Set service image.", "hoskia" ),
				),

				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Name", "hoskia" ),
					"param_name" => "name",
				),	
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Designation/Address", "hoskia" ),
					"param_name"  => "designation",
					"description" => esc_html__( "Set designation.", "hoskia" )
				),
				array(
					"type" 		 => "textarea",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Description", "hoskia" ),
					"param_name" => "description",
				),	
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Rating', 'hoskia' ),
					'value' => array(
						esc_attr__( 'Select Star', 'hoskia' ) => '',
						esc_attr__( '1', 'hoskia' ) 			=> '1',
						esc_attr__( '1.5', 'hoskia' ) 		=> '1.5',
						esc_attr__( '2', 'hoskia' ) 			=> '2',
						esc_attr__( '2.5', 'hoskia' ) 		=> '2.5',
						esc_attr__( '3', 'hoskia' ) 			=> '3',
						esc_attr__( '3.5', 'hoskia' ) 		=> '3.5',
						esc_attr__( '4', 'hoskia' ) 			=> '4',
						esc_attr__( '4.5', 'hoskia' ) 		=> '4.5',
						esc_attr__( '5', 'hoskia' ) 			=> '5',
						
					),
					'param_name' => 'rating'
				),				
			)
				
			),	
			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' 		  => 'animation_style',
				'heading' 	  => esc_html__( 'Animation Style', 'hoskia' ),
				'param_name'  => 'animation',
				'description' => esc_html__( 'Choose your animation style', 'hoskia' ),
				'admin_label' => false,
				'weight' 	  => 0,
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),


		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_testimonial_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'testimonials'     => '',
				'slidenumber'      => '',
				'slidenumbermob'   => '',
				'animation' 	   => '',
				'css' 	   		   => '',
			),
		$atts
		) );
		
		// Enqueue owl carousel
		wp_enqueue_script( 'owl-carousel' );
		
		// Uniq ID
		$uniqID = uniqid( 'testimonial' ).'-'.rand( 1, 9999 );

		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhosttestimonial', $atts );

		if( $slidenumber ){
			$slidenumber = $slidenumber;
		}else{
			$slidenumber = 2;
		}
		
		// 768 regulation
		if( $slidenumbermob ){
			$slidenumbermob = $slidenumbermob;
		}else{
			$slidenumbermob = 1;
		}
		
		$testimonials = vc_param_group_parse_atts( $testimonials );
		
		ob_start();
		?>	

			<!-- Testimonial Slider Start -->
			<div id="<?php echo esc_attr( $uniqID ); ?>" class="testimonial--slider owl-carousel owl--dots" data-carousel-items="<?php echo esc_attr( $slidenumber ); ?>" data-carousel-autoplay="true" data-carousel-nav="true" data-carousel-responsive='{"0": {"items": "1"}, "768": {"items": "<?php echo esc_attr( $slidenumbermob ); ?>"},"992": <?php echo esc_attr( $slidenumber ); ?>}' data-scroll-reveal="bottom">
				
				<?php 
				// Testimonial Item Start
				if( $testimonials ):
				foreach( $testimonials as $testimonial ):				
				?>
				<div class="testimonial--item">
					<?php 
					// 
					if( !empty( $testimonial['title'] ) ){
						echo '<h3 class="h3">'.esc_html( $testimonial['title'] ).'</h3>';
					}
					// Rating
					if( !empty( $testimonial['rating'] ) ){
						hoskia_client_rating( $testimonial['rating'] );
					}
					//
					if( !empty( $testimonial['description'] ) ):
					?>
						<blockquote>
							<p><?php echo esc_html( $testimonial['description'] ); ?></p>
						</blockquote>
					<?php 
					endif;					
					?>
					
					<div class="testimonial--recommender">
						<?php 
						// Image
						if( !empty( $testimonial['img'] ) ){
							$imgurl = wp_get_attachment_image_src( $testimonial['img'] , 'full' );
							
							echo '<div class="photo">';
								echo '<img src="'.esc_url( $imgurl[0] ).'" alt="'.esc_attr( hoskia_image_alt( $imgurl[0] ) ).'">';
							echo '</div>';
							
						}
						
						// Content
						if( !empty( $testimonial['name'] ) || !empty( $testimonial['designation'] ) ):
						?>
						<div class="info">
							<?php 
							// Name
							if( !empty( $testimonial['name'] ) ){
								echo '<h4 class="h4">'.esc_html( $testimonial['name'] ).'</h4>';
							}
							// Designation
							if( !empty( $testimonial['designation'] ) ){
								echo '<p>'.esc_html( $testimonial['designation'] ).'</p>';
							}
							?>
						</div>
						<?php 
						endif;
						?>	
						
					</div>
				</div>
				
				<?php 
				endforeach;
				endif;
				// Testimonial Item End
				?>

			</div>


		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_testimonial();


?>