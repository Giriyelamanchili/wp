<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_Comingsoon extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_comingsoon_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostcomingsoon', array( $this, 'hoskia_comingsoon_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_comingsoon_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "ComingSoon", "hoskia" ),
		  "base" => "ssdhostcomingsoon",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  
			array(
			"type"		 => "param_group",
			'param_name' => 'sliders',
			"group"		 => esc_html__( "Slider Settings", "hoskia" ),
			'heading' 	 => esc_html__( 'Set sliders', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Title", "hoskia" ),
					"param_name" => "title",
					"group"		 => esc_html__( "Slider Settings", "hoskia" ),
				),	
				array(
					"type" 		  => "attach_image",
					"holder" 	  => "div",
					"heading" 	  => esc_html__( "Image", "hoskia" ),
					"param_name"  => "img",
					"description" => esc_html__( "Set image.", "hoskia" ),
					"group"		 => esc_html__( "Slider Settings", "hoskia" ),
				),
			)
				
			),
			//
			array(
				"type" 		  => "attach_image",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Logo", "hoskia" ),
				"param_name"  => "logo",
				"description" => esc_html__( "Upload Logo.", "hoskia" ),
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Logo Url", "hoskia" ),
				"param_name" => "logourl",
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Title", "hoskia" ),
				"param_name" => "contenttitle",
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Sub Title", "hoskia" ),
				"param_name" => "subtitle",
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Starting Date", "hoskia" ),
				"param_name" => "starting",
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
				"type" 		 => "textarea",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Descriptions", "hoskia" ),
				"param_name" => "descriptions",
				"group"		 => esc_html__( "Content", "hoskia" ),
			),
			array(
			"type"		 => "param_group",
			'param_name' => 'social',
			"group"		 => esc_html__( "Content", "hoskia" ),
			'heading' 	 => esc_html__( 'Social Icon', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "URL", "hoskia" ),
					"param_name" => "url",
					"group"		 => esc_html__( "Set url", "hoskia" ),
				),	
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Font Awesome Icon', "hoskia" ),
					'param_name' => 'icon_fontawesome',
					'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'type' => 'fontawesome',
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'description' => esc_html__( 'Select icon from library.', "hoskia" ),
				),
			)
				
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_comingsoon_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'sliders'     	=> '',
				'logo'      	=> '',
				'logourl'      	=> '#',
				'contenttitle' 	=> '',
				'subtitle' 		=> '',
				'starting' 		=> '',
				'descriptions' 	=> '',
				'social' 		=> '',
			),
		$atts
		) );
		
		// Enqueue owl carousel
		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_script( 'countdown' );
				
		$sliders = vc_param_group_parse_atts( $sliders );
		
		ob_start();
		?>	
        <div id="comingSoon">
            <div class="row reset-gutter">
                <div class="col-md-6">
					<?php 
					if( is_array( $sliders ) && count( $sliders ) > 0 ):
					
					?>
                    <div class="coming-soon--slider owl-carousel" data-carousel-items="1" data-carousel-nav="true">
					
						<?php 
						foreach( $sliders as $slider ):
						$imgurl = '';
						if( !empty( $slider['img'] ) ){
							$imgurl = wp_get_attachment_image_src( $slider['img'] , 'full' );
						}
						//
						if( !empty( $imgurl[0] ) ):
						?>
                        <div class="item bg--overlay-off" data-bg-img="<?php echo esc_url( $imgurl[0] ); ?>">
							<?php 
							if( $slider['title'] ):
							?>
                            <div class="vc--parent">
                                <div class="vc--child">
                                    <h1><?php echo esc_html( $slider['title'] ); ?></h1>
                                </div>
                            </div>
							<?php 
							endif;
							?>
                        </div>
                        <?php 
						endif;
						endforeach;
						?>
					</div>
					<?php 
					endif;
					?>
                </div>
                <div class="col-md-6">
                    <div class="coming-soon--content text-center pd--100-0" data-scroll-reveal="group">
						<?php
						$imgurl = wp_get_attachment_image_src( $logo , 'full' );						
						if( !empty( $imgurl[0] ) ){
							
							echo '<a href="'.esc_url( $logourl ).'" class="logo">';
								echo '<img src="'.esc_url( $imgurl[0] ).'" alt="'.esc_attr( hoskia_image_alt( $imgurl[0] ) ).'" />';
							echo '</a>';
                        }
						//
						if( $contenttitle ){
							echo '<h2 class="h1">'.esc_html( $contenttitle ).'</h2>';
						}
						//
						if( $subtitle ){
							echo '<p class="h4">'.esc_html( $subtitle ).'</p>';
						}
						//
					
						if( $starting ){
							
							echo '<div class="counter" data-counter-down="'.esc_attr( $starting ).'"></div>';
							
						}
						//
						if( $descriptions ){
							echo '<div class="clearfix">';
								echo '<div class="col-md-10 col-md-offset-1">';
									echo '<p>'.esc_html( $descriptions ).'</p>';
								echo '</div>';
							echo '</div>';
						}
						?>
                        
                        <div class="clearfix">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div class="subscribe--widget">
                                    <form action="#" method="post" id="coming_subscribe">
                                        <div class="input-group">
                                            <input type="email" name="email" id="comingsoon_email" class="form-control" placeholder="<?php esc_html_e( 'Enter Your E-mail Address', 'hoskia' ); ?>" required />
                                            <span class="input-group-addon">
                                                <button type="submit" class="btn btn-default"><?php esc_html_e( 'Subscribe', 'hoskia' ); ?></button>
                                            </span>
                                        </div>
										<div id="alert-comingmessage"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php 
						$social = vc_param_group_parse_atts( $social );
						if( is_array( $social ) && count( $social ) > 0 ){
							echo '<div class="social">';
								echo '<h5>'.esc_html__( 'Follow Us', 'hoskia' ).'</h5>';
								echo '<ul class="nav">';
									foreach( $social as $val ){
																				
										if( !empty( $val['url'] ) && !empty( $val['icon_fontawesome'] ) ){
											echo '<li><a href="'.esc_url( $val['url'] ).'"><i class="'.esc_attr( $val['icon_fontawesome'] ).'"></i></a></li>';
											
										}
										
									}
								
								echo '</ul>';
							echo '</div>';
						}
						?>						
                    </div>
                </div>
            </div>
        </div>
		
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_Comingsoon();


?>