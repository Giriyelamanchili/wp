<?php 
/**
 * Counter section Element
 */
class WPBakeryShortCode_counter extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Hoskia helper class
		$this->helper = new hoskia_helper() ;
		
		// hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_maping' ) );
		
		// hoskia feature shortcode
		add_shortcode( 'ssdhostcounter', array( $this, 'hoskia_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Counter", "hoskia" ),
		  "base" => "ssdhostcounter",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(

			array(
				'heading'    => esc_html__( 'Choose Style', 'hoskia' ),
				'type'       => 'dropdown',
				'param_name' => 'counter_style',
				'value'		 => array( 'Select Style' => '', 'Style 1' => 'style-1', 'Style 2' => 'style-2', 'Style 3' => 'counter-style--3' ),
			),
		  	array(
				'type' => 'dropdown',
				'heading' => __( 'Icon Type', "hoskia" ),
				'param_name' => 'icontype',
				'value' => array( 'None' => 'none' ,'Font Awesome Icon' => 'fontawesome', 'Image Icon' => 'imageicon'  ),
				'description' => __( 'Choose your animation style', "hoskia" ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Font Awesome Icon', "hoskia" ),
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
				'description' => __( 'Select icon from library.', "hoskia" ),
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"heading" => __( "Image Icon", "hoskia" ),
				"param_name" => "imgicon",
				"description" => __( "Set feature image icon.", "hoskia" ),
				'dependency' => array(
					'element' => 'icontype',
					'value' => 'imageicon',
				),
			),
			array(
				"type" => "textfield",
				"heading" => __( "Title", "hoskia" ),
				"param_name" => "title",
				"description" => __( "Set counter title.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Count Number", "hoskia" ),
				"param_name" => "number",
				"description" => __( "Set counter number.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => __( "Symbol", "hoskia" ),
				"param_name" => "symbol",
				"description" => __( "Set counter symbol.", "hoskia" ),
				'dependency' => array(
					'element' => 'counter_style',
					'value' => 'style-2',
				),
			),
			array(
				"type" => "checkbox",
				"heading" => __( "Border", "hoskia" ),
				"param_name" => "border",
				"description" => __( "Set single counter right border.", "hoskia" ),
				'dependency' => array(
					'element' => 'counter_style',
					'value' => 'style-1',
				),
			),
			array(
				"type" => "css_editor",
				"heading" => __("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => __( 'Animation Style', "hoskia" ),
				'param_name' => 'animation',
				'description' => __( 'Choose your animation style', "hoskia" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Title Color", "hoskia" ),
				"param_name" => "titlecolor",
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Number Color", "hoskia" ),
				"param_name" => "numbercolor",
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Border Color", "hoskia" ),
				"param_name" => "bordercolor",
				"group"		=> __( "Design Option", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => __( " Box Background Color", "hoskia" ),
				"param_name" => "bgcolor",
				"group"		=> __( "Design Option", "hoskia" ),
				'dependency' => array(
					'element' => 'counter_style',
					'value' => 'style-2',
				),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'counter_style'    => '',
				'title'  		   => '',
				'symbol'  	   	   => '',
				'number'  	   	   => '',
				'icontype'    	   => '',
				'imgicon'  		   => '',
				'icon_fontawesome' => '',
				'animation' 	   => '',
				'bgcolor' 	   	   => '',
				'css' 	   		   => '',
				'iconcolor' 	   => '',
				'titlecolor' 	   => '',
				'numbercolor' 	   => '',
				'border' 	   	   => '',
				'bordercolor' 	   => '',
			),
		$atts
		) );
		
		// Enqueue waypoints counterup
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'counterup' );
		
		// Uniq ID 
		$uniqId = 'counter_'.uniqId();
		
		// array variable define
		$titlestl = $numstl = $bordstl = array();
		
		// Title Color
		if( $titlecolor ){
			$titlestl[] = 'color:'.esc_attr( $titlecolor ).';';
		}
		
		$titletags = $this->helper->hoskia_style_tag( $titlestl );
		
		// Number Color
		if( $numbercolor ){
			$numstl[] = 'color:'.esc_attr( $numbercolor ).';';
		}
		$numtags = $this->helper->hoskia_style_tag( $numstl );
		
		// Info Color
		if( $bordercolor ){
			$bordstl[] = 'color:'.esc_attr( $bordercolor ).';';
		}
		$bordtags = $this->helper->hoskia_style_tag( $bordstl );
		
		// Icon Style 
		if( $iconcolor ){
			$iconstyle = 'style="color:'.$iconcolor.';"';
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
		
				
		// Counter style content manage
		
		if( $counter_style == 'style-2' ){
			$styleClass = ' counter--box text-center ';
			
		}elseif( $counter_style == 'counter-style--3' ){
			$styleClass = ' counter-style--3 ';
		}else{
			$styleClass = '';
		}
				
		// Inline Css
		$inlineCss = '';
		if( $bgcolor || $bordercolor ){
			$inlineCss .= '#'.$uniqId.'.counter--item.counter--box{border-color:'.$bordercolor.';background-color:'.$bgcolor.';}';
		}
		
		
		ob_start();
		
		?>
	
			<div id="<?php echo esc_attr( $uniqId ); ?>" class="counter--item <?php echo esc_attr( $styleClass.$animation.$css_class ); ?>" <?php echo $titletags; ?>>
				<?php 
				if( $icon ) {
					echo '<div class="icon">';
						echo wp_kses_post( $icon );
					echo '</div>';
				}
				// title
				if( $styleClass == '' && $title ){
					echo '<h2 class="h3">'.esc_html( $title ).'</h2>';
				}
				// Counter number
				if( $number ){
					echo '<h3 class="h1" '.$numtags.'>'.esc_html( $symbol ).'<span data-counter-up="numbers">'.esc_attr(  $number ).'</span></h3>';
				}
				
				// title
				if( $styleClass != '' && $title ){
					echo '<h3 class="h4">'.esc_html( $title ).'</h3>';
				}
				
				
				//
				if( $border ){
					echo '<div class="counter--item-border"></div>';
					if( $bordercolor ){	
						$inlineCss .= '#'.$uniqId.' .counter--item-border:after{background-color:'.esc_attr( $bordercolor ).';}';
						
					}
				}
				?>
				
			</div>
		<?php
		if($inlineCss){
			echo $this->helper->hoskia_inline_css( $inlineCss );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_counter();


?>