<?php 
/**
 * Hoskia pricing Element
 */
class WPBakeryShortCode_pricing extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// ssdhost helper class
		$this->helper = new hoskia_helper() ;
		
		// ssdhost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_maping' ) );
		
		// ssdhost feature shortcode
		add_shortcode( 'ssdhostprice', array( $this, 'hoskia_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => esc_html__( "Pricing Table", "hoskia" ),
		  "base" => "ssdhostprice",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => esc_html__( "Hoskia", "hoskia"),
		  "params" => array(

		  	array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Type', "hoskia" ),
				'param_name' => 'icontype',
				'value' => array( 'None' => 'none' ,'Font Awesome Icon' => 'fontawesome', 'Image Icon' => 'imageicon'  ),
				'description' => esc_html__( 'Choose your animation style', "hoskia" ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome Icon', "hoskia" ),
				'param_name' => 'icon_fontawesome',
				'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'fontawesome',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'icontype',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', "hoskia" ),
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"heading" => esc_html__( "Image Icon", "hoskia" ),
				"param_name" => "imgicon",
				"description" => esc_html__( "Set feature image icon.", "hoskia" ),
				'dependency' => array(
					'element' => 'icontype',
					'value' => 'imageicon',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Title", "hoskia" ),
				"param_name" => "title",
				"description" => esc_html__( "Set pricing table title.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Sub Title", "hoskia" ),
				"param_name" => "subtitle",
				"description" => esc_html__( "Set pricing table sub title.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Price", "hoskia" ),
				"param_name" => "price",
				"description" => esc_html__( "Set price.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Duration", "hoskia" ),
				"param_name" => "duration",
				"description" => esc_html__( "Set duration.", "hoskia" )
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__( "Active", "hoskia" ),
				"param_name" => "active",
				"description" => esc_html__( "Set active pricing table.", "hoskia" )
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__( "Ribbon", "hoskia" ),
				"param_name" => "ribbon",
				"description" => esc_html__( "Set pricing table ribbon.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Ribbon Text", "hoskia" ),
				"param_name" => "ribbontext",
				"description" => esc_html__( "Set ribbon text.", "hoskia" )
			),
			array(
				"type" => "param_group",
				'param_name' => 'featuresgroup',
				'heading' => esc_html__('Pricing Features',"hoskia"),
				'params' => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => esc_html__( "Feature", "hoskia" ),
						"param_name" => "feature",
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Font Awesome Icon', "hoskia" ),
						'param_name' => 'icon_fontawesome',
						'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'fontawesome',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'description' => esc_html__( 'Select icon from library.', "hoskia" ),
					),					
				)	
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Text", "hoskia" ),
				"param_name" => "btntext",
				"description" => esc_html__( "Set button text.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Button Url", "hoskia" ),
				"param_name" => "btnurl",
				"description" => esc_html__( "Set button url.", "hoskia" )
			),
			array(
				"type" => "css_editor",
				"heading" => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => esc_html__( 'Animation Style', "hoskia" ),
				'param_name' => 'animation',
				'description' => esc_html__( 'Choose your animation style', "hoskia" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Icon Color", "hoskia" ),
				"param_name" => "iconcolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Features Color", "hoskia" ),
				"param_name" => "textcolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Title Color", "hoskia" ),
				"param_name" => "titlecolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Price Color", "hoskia" ),
				"param_name" => "pricecolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Button Text Color", "hoskia" ),
				"param_name" => "btntextcolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			)

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title'  		   => '',
				'subtitle'  	   => '',
				'price'  	   	   => '',
				'duration'  	   => '',
				'featuresgroup'    => '',
				'btntext'    	   => '',
				'btnurl'    	   => '',
				'active'    	   => '',
				'ribbon'    	   => '',
				'ribbontext'       => '',
				'icontype'    	   => '',
				'imgicon'  		   => '',
				'icon_fontawesome' => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'iconcolor' 	   => '',
				'textcolor' 	   => '',
				'titlecolor' 	   => '',
				'pricecolor' 	   => '',
				'btntextcolor' 	   => '',
			),
		$atts
		) );
		
		// array variable define
		$titlestl = $pricestl = $textstl = $btntextcolortl = array();
		
		// text Color
		if( $textcolor ){
			$textstl[] = 'color:'.esc_attr( $textcolor ).';';
		}
		
		$texttags = $this->helper->hoskia_style_tag( $textstl );
		
		// Title Color
		if( $titlecolor ){
			$titlestl[] = 'color:'.esc_attr( $titlecolor ).';';
		}
		
		$titletags = $this->helper->hoskia_style_tag( $titlestl );
		
		// Price Color
		if( $pricecolor ){
			$pricestl[] = 'color:'.esc_attr( $pricecolor ).';';
		}
		$pricetags = $this->helper->hoskia_style_tag( $pricestl );
		
		// Button text Color
		if( $btntextcolor ){
			$btntextcolortl[] = 'color:'.esc_attr( $btntextcolor ).';';
		}
		$btntextcolortags = $this->helper->hoskia_style_tag( $btntextcolortl );
				
		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';"';
		}else{
			$iconstyle = '';
		}
		// Active
		if( $active ){
			$active = ' active';
		}else{
			$active = '';
		}
		// Ribbon
		if( $ribbon ){
			$ribbon = ' ribbon';
		}else{
			$ribbon = '';
		}
	
		$features = vc_param_group_parse_atts( $featuresgroup );
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Font type and settings
		$fontIcons = array( $icon_fontawesome, $imgicon );
		$icon = $this->helper->hoskia_font_icon_process( $icontype, $fontIcons, $iconstyle );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostfeatures', $atts );
		
		
		ob_start();
		?>
			<!-- Pricing Item Start -->
			<div class="pricing--item <?php echo esc_attr( $animation ); ?>" <?php echo $texttags; ?>>
			<div class="pricing--content<?php echo esc_attr( $css_class.$active.$ribbon ); ?>">
				<div class="pricing--header">
					<?php 
					// Ribbon Text
					if( $ribbontext ){
						$ribbontext = $ribbontext;
					}else{
						$ribbontext = __( 'Recommended', 'hoskia' );
					}
					// Ribbon
					if( $ribbon ){
						echo '<span>'.esc_html( $ribbontext ).'</span>';
					}
					
					// Pricing Title
					if( $title ){
						echo '<h3 class="h4" '.$titletags.'>'.esc_html( $title ).'</h3>';
					}
					//
					if( $subtitle || $price ){
						echo '<h4 class="h5" '.$pricetags.'>';
						if( $subtitle ){
							echo esc_html( $subtitle );
						}
						//
						if( $price ){
							$durationSet = '';
							if( $duration ){
								$durationSet = '<small '.$pricetags.'>'.$duration.'</small>';
							}
							echo '<strong>'.esc_html( $price ).wp_kses_post( $durationSet ).'</strong>';
						}
						echo '</h4>';
					}
					?>
				</div>
				<?php 
				// Pricing Icon
				if( $icon ){
					echo '<div class="pricing--icon">';
						echo wp_kses_post( $icon );
					echo '</div>';
				}
				//  features
				if( $features ):
				echo '<div class="pricing--features"><ul>';
					foreach( $features as $feature ):
				
						if( !empty( $feature['feature'] ) ){
							echo '<li><i class="fm '.esc_attr( $feature['icon_fontawesome'] ).'"></i>'.wp_kses_post
							( $feature['feature'] ).'</li>';
						}

					endforeach;
				echo '</ul></div>';
				endif;
				
				// Button 
				if( $btntext && $btnurl ){
					echo '<div class="pricing--footer">';
						echo '<a href="'.esc_url( $btnurl ).'" '.$btntextcolortags.' class="btn btn-primary">'.esc_html( $btntext ).'</a>';
					echo '</div>';	
				}
				?>
			</div>
			</div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_pricing();


?>
