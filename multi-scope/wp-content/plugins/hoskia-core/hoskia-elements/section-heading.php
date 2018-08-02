<?php 
/**
 * SSDHostloud Section Heading Element
 */
class WPBakeryShortCode_sectheading extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		$this->helper = new hoskia_helper();
		
		add_action( 'vc_before_init' , array( $this, 'hoskia_heading_maping' ) );
		
		add_shortcode( 'ssdhostsectheading', array( $this, 'hoskia_heading_shortcode' ) );

	}
	
	// vc Param
	public function hoskia_heading_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => esc_html__( "Section Heading", "hoskia" ),
		  "base" => "ssdhostsectheading",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => esc_html__( "Hoskia", "hoskia"),
		  "params" => array(
		  
		  //
		  	array(
				"type" => "textfield",
				"heading" => esc_html__( "Sub Heading", "hoskia" ),
				"holder" => "div",
				"param_name" => "subheading",
				"description" => esc_html__( "Set section sub heading.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Heading", "hoskia" ),
				"holder" => "div",
				"param_name" => "heading",
				"description" => esc_html__( "Set section heading.", "hoskia" )
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Margin Type", "hoskia" ),
				"holder" => "div",
				"value" => array(
					'Default' 		=> 'default',
					'Custom Margin' => 'custom',
				),
				"param_name" => "margtype",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' 		   => 'floatnumber',
				'holder' 	   => 'div',
				'heading' 	   => esc_html__( 'Margin Top', "hoskia" ),
				'param_name'   => 'margintop',
				'step'		   => '1',
				'admin_label'  => false,
				'weight' 	   => 0,
				"group"		   => esc_html__( "Design Option", "hoskia" ),
				'dependency' => array(
					'element' => 'margtype',
					'value'   => 'custom',
				),
			),
			array(
				'type' => 'floatnumber',
				'holder' => 'div',
				'heading' => esc_html__( 'Margin Bottom', "hoskia" ),
				'param_name' => 'marginbottom',
				'step'	=> '1',
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "hoskia" ),
				'dependency' => array(
					'element' => 'margtype',
					'value'   => 'custom',
				),
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Text Align", "hoskia" ),
				"holder" => "div",
				"value" => array(
					'Default' 		=> 'default',
					'Left' 			=> 'left',
					'Right' 		=> 'right',
					'Center' 		=> 'center',
				),
				"param_name" => "headingtextalign",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' 		   => 'divider',
				'holder' 	   => 'div',
				'heading' 	   => esc_html__( '', "hoskia" ),
				'divvider_title' => esc_html__( 'Section Heading Typography Settings', "hoskia" ),
				'param_name'   => 'secthfontsettings',
				"group"		   => esc_html__( "Design Option", "hoskia" ),
			),
			array(
			  'type' => 'hoskia_font_container',
			  'param_name' => 'fontsettings',
			  "heading" => esc_html__("Section Heading Typography", "hoskia"),
			  'settings'=>array(
				 'fields'=>array(
						'field_size' => 'xs-4',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_size_description' => esc_html__( 'Enter font size.', "hoskia" ),
						'line_height_description' => esc_html__( 'Enter line height.', "hoskia" ),
						'color_description' => esc_html__( 'Select color for your element.', "hoskia" ),
					),
				),
				"group"		=> esc_html__( "Design Option", "hoskia" ),
				"description" => esc_html__( "Default set font-size 36px, other auto.", "hoskia" ),
			),
			array(
				'type' 		   	 => 'divider',
				'holder' 	   	 => 'div',
				'heading' 	   	 => esc_html__( '', "hoskia" ),
				'divvider_title' => esc_html__( 'Section Sub Heading Typography Settings', "hoskia" ),
				'param_name'   	 => 'sectsubhfontsettings',
				"group"		   	 => esc_html__( "Design Option", "hoskia" ),
			),
			array(
			  'type' 		=> 'hoskia_font_container',
			  'param_name'  => 'subfontsettings',
			  "heading" => esc_html__("Section Sub Heading Typography", "hoskia"),
			  'settings'=>array(
				 'fields'=>array(
						'field_size' => 'xs-4',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'text_align_description' => esc_html__('Select text alignment.',"hoskia"),
						'font_size_description' => esc_html__('Enter font size.',"hoskia"),
						'line_height_description' => esc_html__('Enter line height.',"hoskia"),
						'color_description' => esc_html__('Select color for your element.',"hoskia"),
					),
				),
				"group"		=> esc_html__( "Design Option", "hoskia" ),
				"description" => esc_html__( "Default set font-size 14px, other auto.", "hoskia" ),
			),
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( " Border Color", "hoskia" ),
				"param_name" => "bordercolor",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => esc_html__( 'Animation Style', "hoskia" ),
				'param_name' => 'headinganimation',
				'description' => esc_html__( 'Choose your animation style', "hoskia" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_heading_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'heading'  			=> '',
				'subheading'  		=> '',
				'fontsettings'  	=> '',
				'subfontsettings'  	=> '',
				'bordercolor'  		=> '',
				'margtype'  		=> '',
				'margintop'  		=> '',
				'marginbottom'  	=> '',
				'textalign' 		=> '',
				'headinganimation' 	=> '',
				'headingtextalign' 	=> '',
			),
		$atts
		) );
		
		$uniqID = uniqID('heading');
		
		// Font settings
		$style 		= $this->helper->hoskia_fontcontainer( $fontsettings );
		$substyle 	= $this->helper->hoskia_fontcontainer( $subfontsettings );
		$animation  = $this->getCSSAnimation( $headinganimation );
				
		
		// Title Style attr
		if( !empty( $style['style'] ) ){
			$styleattr = $style['style'];
		}else{
			$styleattr = '';
		}
		// Sub title Style attr
		if( !empty( $substyle['style'] ) ){
			$substyle = $substyle['style'];
		}else{
			$substyle = '';
		}
		
		// Text Align
		if( $headingtextalign ){
			$talign = 'class="text-'.esc_attr( $headingtextalign ).'" ';
		}else{
			$talign = '';
		}
		
		// Section Title Margin
		$margstyle = '';
		$mbclass   = '';
		if( $margtype != 'custom' ){
			$mbclass = ' mb--68 ';
		}else{
			$margstyle = 'style="margin-top:'.esc_attr( $margintop ).'px;margin-bottom:'.esc_attr( $marginbottom ).'px;"';
		}
		
		// Custom css
		$Css = '';
		if( $bordercolor ){
			
			$Css .= '#'.esc_attr( $uniqID ).'.section--title h2:before{background-color:'.esc_attr( $bordercolor ).';}';
		
		}
		
		ob_start();
		
		$html  = '';
		
		$html .= '<div id="'.esc_attr( $uniqID ).'" class="section--title'.$mbclass.$animation.'" '.$margstyle.'>';
		
		if( $subheading ){
			$html .= '<p '.$talign.$substyle.'>'.esc_html( $subheading ).'</p>';
		}
		if( $heading ){
			$html .= '<h2 '.$talign.$styleattr.'>'.esc_html( $heading ).'</h2>';
		}
				
		$html .= '</div>';
		
		
		echo $html;
		
		if( $Css ){
			echo $this->helper->hoskia_inline_css( $Css );
		}
		
		
		$gethtml = ob_get_clean();
		
		return $gethtml;
		
	
	}
	
	
	
}

$sectheading = new WPBakeryShortCode_sectheading();


?>