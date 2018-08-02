<?php 
/**
 * ssdhost Section Heading Element
 */
class WPBakeryShortCode_gallery extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_gallery_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostgallery', array( $this, 'hoskia_gallery_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_gallery_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Gallery", 'hoskia' ),
		  "base" => "ssdhostgallery",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", 'hoskia'),
		  "params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Section Title", 'hoskia' ),
				"param_name" => "secttitle",
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Section Sub Title", 'hoskia' ),
				"param_name" => "subtitle",
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "Post Per Page", 'hoskia' ),
				"param_name" => "postperpage",
			),
		  	array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__( "Column", 'hoskia' ),
				"param_name" => "col",
				"value" => array(  
						'Default Column' => '3',
						'Column 2' => '6',
						'Column 3' => '4',
						'Column 4' => '3',
						'Column 6' => '2',
					),
			),
		  	array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "See More Button Text", 'hoskia' ),
				"param_name" => "seebtntext",
			),
		  	array(
				"type" => "textfield",
				"holder" => "div",
				"heading" => esc_html__( "See More Button Url", 'hoskia' ),
				"param_name" => "seebtnurl",
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => esc_html__( "Link Target", 'hoskia' ),
				"param_name" => "link_target",
				"value"	=> array(
					'Self' 	=> '_self',
					'Blank' => '_blank'
				)
			),
			array(
				'type' => 'animation_style',
				'heading' => __( 'Animation Style', 'hoskia' ),
				'param_name' => 'animation',
				'description' => __( 'Choose your animation style', 'hoskia' ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> __( "Design Option", 'hoskia' ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_gallery_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'col'  		   => '',
				'secttitle'    => '',
				'subtitle'     => '',
				'postperpage'  => '',
				'seebtntext'   => __( 'See More', 'hoskia' ),
				'seebtnurl'    => '',
				'link_target'  => '_self',
				'animation'    => '',
			),
		$atts
		) );
		// Column
		if( $col ){
			$col = $col;
		}else{
			$col = '3';
		}
		//
		
		// 
		if( $postperpage ){
			$postperpage = $postperpage;
		}else{
			$postperpage = '-1';
		}	
		
		ob_start();
		?>
        <!-- Gallery Section Start -->
        <div class="gallery--section pd--100-0-70">
            <div class="container">
				<?php 
					// Section Title Start
					hoskia_section_title(
						array(
							'wrapper_class' => '',
							'title' 		=> $secttitle,
							'sub_title'		=> $subtitle
						)
					);
				?>
                <!-- Gallery Filter Nav Start -->
                <div class="gallery--filter">
                    <ul>
						<?php
						$terms = get_terms( 'tab', array( 'hide_empty' => true ) );
						echo '<li class="btn btn-default active" data-target="*">'.esc_html( 'All' ).'</li>';
						foreach( $terms as $val ){
							$id = $val->slug.'-'.$val->term_id;
							
							echo '<li class="btn btn-default" data-target="'.esc_attr( $id ).'">'.esc_html( $val->name ).'</li>';
						}
						?>
                    </ul>
                </div>
                <!-- Gallery Filter Nav End -->

                <!-- Gallery Items Start -->
                <div class="gallery--items row">
					<?php 
					
						$args = array(
							'post_type' => 'gallery',
							'posts_per_page' => esc_html( $postperpage ),
						);
						$query = new WP_Query( $args );
						if( $query->have_posts() ):
						while( $query->have_posts() ): $query->the_post();

						$terms = get_the_terms( get_the_ID(), 'tab' );
						$cat = array();
						$id = '';
						if( $terms ){
							foreach( $terms as $term ){
								$cat[] = $term->name.' ';
								$id  .= ' '.$term->slug.'-'.$term->term_id;
							}
						}
					?>
                    <!-- Gallery Item Start -->
                    <div class="gallery--item col-sm-6 col-md-<?php echo esc_attr( $col ); ?> col-xs-6 col-xxs-12" data-cat="<?php echo esc_attr( $id );  ?>">
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
                <!-- Gallery Items End -->
				<?php 
				// Section Footer Start
				if( $seebtnurl ):
				?>
                <div class="section--footer text-center mt--30">
                    <a href="<?php echo esc_url( $seebtnurl ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="btn btn-default"><?php echo esc_html( $seebtntext ); ?><i class="fa flm fa-angle-double-right"></i></a>
                </div>
				<?php 
				endif;
				?>
                
            </div>
        </div>
        <!-- Gallery Section End -->
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_gallery();


?>