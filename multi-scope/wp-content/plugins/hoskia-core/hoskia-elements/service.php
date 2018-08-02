<?php 
/**
 * Hoskia Service Element
 */
class WPBakeryShortCode_service extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_service_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostservice', array( $this, 'hoskia_service_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_service_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Service", "hoskia" ),
		  "base" => "ssdhostservice",
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
						'tooltip'	=> esc_attr__('Icon Left Side','hoskia'),
						'src'		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/testi-style-3.png'
					),
					'style-2'	=> array(
						'tooltip'	=> esc_attr__('Icon Top Center','hoskia'),
						'src'		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/counter-style-2.png'
					)
				),
			),
		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Icon Type', "hoskia" ),
				'param_name' 	=> 'icontype',
				'value' 		=> array( 'None' => 'none' ,'Font Awesome Icon' => 'fontawesome', 'Image Icon' 	  => 'imageicon'  ),
				'description' 	=> esc_html__( 'Choose your animation style', "hoskia" ),
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Font Awesome Icon', "hoskia" ),
				'param_name' 	=> 'icon_fontawesome',
				'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'fontawesome',
				'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'dependency' 	=> array(
					'element' => 'icontype',
					'value'   => 'fontawesome',
				),
				'description' 	=> esc_html__( 'Select icon from library.', "hoskia" ),
			),
			array(
				"type" 			=> "attach_image",
				"holder" 		=> "div",
				"heading" 		=> esc_html__( "Image Icon", "hoskia" ),
				"param_name" 	=> "imgicon",
				"description" 	=> esc_html__( "Set feature image icon.", "hoskia" ),
				'dependency' 	=> array(
					'element' => 'icontype',
					'value'   => 'imageicon',
				),
			),
			array(
				"type" => "textfield",
				"heading" => __( "Title", "hoskia" ),
				"param_name" => "title",
				"description" => __( "Set feature title.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Step", "hoskia" ),
				"param_name" => "step",
				"description" => __( "Set step.", "hoskia" ),
				'dependency' 	=> array(
					'element' => 'service_style',
					'value'   => 'style-2',
				),
			),
			array(
				"type" => "textfield",
				"heading" => __( "Title Url", "hoskia" ),
				"param_name" => "titleurl",
				"description" => __( "Set title url.", "hoskia" )
			),
			array(
				"type" => "textarea",
				"heading" => __( "Descriptions", "hoskia" ),
				"param_name" => "description",
				"description" => __( "Set feature descriptions.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Button Text", "hoskia" ),
				"param_name" => "btntext",
				"description" => __( "Set button text.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Button Url", "hoskia" ),
				"param_name" => "btnurl",
				"description" => __( "Set button url.", "hoskia" )
			),
			array(
				"type" => "css_editor",
				"heading" => __("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Color", "hoskia" ),
				"param_name" 	=> "iconcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Border Color", "hoskia" ),
				"param_name" 	=> "iconbordercolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Text Color", "hoskia" ),
				"param_name" 	=> "textcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Hover Text Color", "hoskia" ),
				"param_name" 	=> "btnhovtextcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Hover Border Color", "hoskia" ),
				"param_name" 	=> "btnhovbordcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => __( 'Animation Style', 'quickfix' ),
				'param_name' => 'animation',
				'description' => __( 'Choose your animation style', 'quickfix' ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> __( "Design Option", "hoskia" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_service_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title'  		   => '',
				'service_style'    => '',
				'step'  	   	   => '',
				'titleurl'  	   => '',
				'description'  	   => '',
				'icontype'    	   => '',
				'iconbordercolor'  => '',
				'textcolor'  	   => '',
				'btnhovtextcolor'  => '',
				'btnhovbordcolor'  => '',
				'imgicon'  		   => '',
				'iconcolor'  	   => '',
				'icon_fontawesome' => '',
				'btntext'  	   	   => '',
				'btnurl'  	   	   => '',
				'animation' 	   => '',
				'css' 	   		   => '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = 'service_'.uniqid();
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostservice', $atts );
		
		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';"';
			
		}else{
			$iconstyle = '';
		}
		
		// Font type and settings
		$fontIcons = array( $icon_fontawesome, $imgicon );
		$icon = $this->helper->hoskia_font_icon_process( $icontype, $fontIcons, $iconstyle );
		
		// Service Style
		if( $service_style != 'style-1' ){
			$style = 'affiliate--services';
			$ov = ' text-center';
		}else{
			$style = 'services';
			$ov = '';
		}
		
		$css = '';
		//Icon Border Color
		if( $iconbordercolor ){
			$css .= '#'.esc_attr( $uniqId ).' .service--icon{border-color:'.esc_attr( $iconbordercolor ).'!important;}';
		}
		//Text Color
		if( $textcolor ){
			$css .= '#'.esc_attr( $uniqId ).' .service--content{color:'.esc_attr( $textcolor ).'!important;}#'.esc_attr( $uniqId ).' .service--content h2 a{color:'.esc_attr( $textcolor ).'}#'.esc_attr( $uniqId ).' .service--content .btn-default{color:'.esc_attr( $textcolor ).';border-color:'.esc_attr( $textcolor ).'}';
		}
		
		//Button Hover Color
		if( $btnhovtextcolor || $btnhovbordcolor ){
			$css .= '#'.esc_attr( $uniqId ).' .service--content .btn-default:hover{color:'.esc_attr( $btnhovtextcolor ).';border-color:'.esc_attr( $btnhovbordcolor ).'}';
		}
				
		ob_start();
		?>
		
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="<?php echo esc_attr( $style ); ?>">
			<div class="service--item <?php echo esc_attr( $animation.$css_class.$ov ); ?>">
				<?php 
				if( $step ){
					echo '<span class="service--count">'.esc_html( $step ).'</span>';
				}
				?>
				<div class="service--icon">
					<?php 
					echo $icon;
					?>
				</div>
				
				<div class="service--content">
					<?php 
					if( $title ){
						if( $titleurl ){
							$titleurl = $titleurl;
						}else{
							$titleurl = '#';
						}
						
						echo '<h2 class="h3"><a href="'.esc_url( $titleurl ).'">'.esc_html( $title ).'</a></h2>';
					}
					//
					if( $description ){
						echo '<p>'.wp_kses_post( $description ).'</p>';
					}
					//
					if( $btntext && $btnurl ){
						echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-default btn-sm">'.esc_html( $btntext ).'<i class="fa flm fa-long-arrow-right"></i></a>';
					}
					?>
				</div>
			</div>
		</div>
		<?php
		
		if( $css ){
			echo $this->helper->hoskia_inline_css( $css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_service();


?>