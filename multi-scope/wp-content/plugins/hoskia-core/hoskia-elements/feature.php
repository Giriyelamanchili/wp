<?php 
/**
 * Hoskia feature  Element
 */
class WPBakeryShortCode_feature extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_feature_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostfeatures', array( $this, 'hoskia_feature_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_feature_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Feature", "hoskia" ),
		  "base" 		=> "ssdhostfeatures",
		  "class" 		=> "",
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(

		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Icon Style', "hoskia" ),
				'param_name' 	=> 'iconst',
				'value' 		=> array( 'Default' => 'none' ,'Box' => 'box', 'Without Box' => 'no-box'  ),
				'description' 	=> esc_html__( 'Choose your animation style', "hoskia" ),
			),
		  	array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Icon Position', "hoskia" ),
				'param_name' 	=> 'iconpos',
				'value' 		=> array( 'Default' => 'none' ,'Right' => 'text-right', 'Center' => 'text-center', 'Left' => 'text-left'  ),
				'description' 	=> esc_html__( 'Choose your animation style', "hoskia" ),
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
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Title", "hoskia" ),
				"param_name" 	=> "title",
				"description" 	=> esc_html__( "Set feature title.", "hoskia" )
			),
			array(
				"type" 			=> "textarea",
				"heading" 		=> esc_html__( "Descriptions", "hoskia" ),
				"param_name" 	=> "description",
				"description" 	=> esc_html__( "Set feature descriptions.", "hoskia" )
			),
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "hoskia"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' 			=> 'animation_style',
				'heading' 		=> esc_html__( 'Animation Style', "hoskia" ),
				'param_name' 	=> 'animation',
				'description' 	=> esc_html__( 'Choose your animation style', "hoskia" ),
				'admin_label' 	=> false,
				'weight' 		=> 0,
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Color", "hoskia" ),
				"param_name" 	=> "iconcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Icon Box Color", "hoskia" ),
				"param_name" 	=> "iconboxcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=>	esc_html__( " Title Color", "hoskia" ),
				"param_name" 	=> "titlecolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( " Description Color", "hoskia" ),
				"param_name" 	=> "desccolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_feature_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'title'  		   => '',
				'description'  	   => '',
				'iconst'    	   => '',
				'iconpos'    	   => '',
				'icontype'    	   => '',
				'imgicon'  		   => '',
				'iconboxcolor'     => '',
				'icon_fontawesome' => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'iconcolor' 	   => '',
				'titlecolor' 	   => '',
				'desccolor' 	   => '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = 'feature_'.uniqid();
		
		// array variable define
		$titlestl = $descstl = array();
		
		// Title Color
		if( $titlecolor ){
			$titlestl[] = 'color:'.esc_attr( $titlecolor ).';';
		}
		
		$titletags = $this->helper->hoskia_style_tag( $titlestl );
		
		// Description Color
		if( $desccolor ){
			$descstl[] = 'color:'.esc_attr( $desccolor ).';';
		}
		$desctags = $this->helper->hoskia_style_tag( $descstl );
		
		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';border-color:'.$iconcolor.';"';
			
		}else{
			$iconstyle = '';
		}
	
		
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Font type and settings
		$fontIcons = array( $icon_fontawesome, $imgicon );
		$icon = $this->helper->hoskia_font_icon_process( $icontype, $fontIcons, $iconstyle );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostfeatures', $atts );
			
		$css = '';
		//Icon Box Color
		if( $iconboxcolor ){
			$css .= '#'.esc_attr( $uniqId ).' .box img{background-color:'.esc_attr( $iconboxcolor ).'!important;}';
		}
		
		ob_start();
		?>
		
		<div id="<?php echo esc_attr( $uniqId ); ?>" class="feature--item <?php echo esc_attr( $animation.$css_class ); ?>">
			<?php 
			// feature Icon
			if( $icon ){
				echo '<div class="feature--icon '.esc_attr( $iconst.' '.$iconpos ).'">'.wp_kses_post( $icon ).'</div>';
			}
			//Feature Description
			if( $description || $title ){
				//
				echo '<div class="feature--content">';
					// Feature title
					if( $title ){
						echo '<h3 class="h4" '.$titletags.'>'.esc_html( $title ).'</h3>';
					}
					//
					if( $description ){
						echo '<p '.$desctags.'>'.wp_kses_post( $description ).'</p>';
					}
					
				echo '</div>';
			}
			?>
		</div>
		
		<?php
		
		if( $css ){
			echo $this->helper->hoskia_inline_css( $css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_feature();


?>