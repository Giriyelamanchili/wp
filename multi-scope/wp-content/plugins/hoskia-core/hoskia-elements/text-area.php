<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_Ssdhost_Textarea extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Hoskia helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_text_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhosttext', array( $this, 'hoskia_text_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_text_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Hoskia Text Block", "hoskia" ),
		  "base" => "ssdhosttext",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  
			array(
				"type" 		  => "textarea_html",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Text Area", "hoskia" ),
				"param_name"  => "content",
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Title", "hoskia" ),
				"param_name"  => "text",
				"description" => esc_html__( "Set title.", "hoskia" ),
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Button Label", "hoskia" ),
				"param_name"  => "btnlabel",
				"description" => esc_html__( "Set button label.", "hoskia" ),
			),
			array(
				"type" 		  => "textfield",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Button Url", "hoskia" ),
				"param_name"  => "btnurl",
				"description" => esc_html__( "Set button url.", "hoskia" ),
			),

			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
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
				"type" 		  => "floatnumber",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Title Margin Top", "hoskia" ),
				"param_name"  => "textmt",
				"description" => esc_html__( "Set title margin top.", "hoskia" ),
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 		  => "floatnumber",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Title Margin Bottom", "hoskia" ),
				"param_name"  => "textmb",
				"description" => esc_html__( "Set title margin bottom.", "hoskia" ),
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_text_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'text'      => '',
				'textmb' 	=> '',
				'textmt' 	=> '',
				'fontsettings' 	=> '',
				'btnlabel' 	=> '',
				'btnurl' 	=> '',
				'css' 	   	=> '',
			),
		$atts
		) );
		
		
		// Font settings
		$style 		= $this->helper->hoskia_fontcontainer( $fontsettings );

		// Title Style attr
		if( !empty( $style['style'] ) ){
			$styleattr = $style['style'];
		}else{
			$styleattr = '';
		}
		
		// text margin
		$textmargin = array();
		
		if( $textmt ){
			$textmargin[] = 'margin-top:'.esc_attr( $textmt ).'px;';
		}
		if( $textmb ){
			$textmargin[] = 'margin-bottom:'.esc_attr( $textmb ).'px;';
		}
		
		$textmargintags = $this->helper->hoskia_style_tag( $textmargin );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostsingleimg', $atts );
		
		ob_start();
		?>	
		<div class="hoskia-textblock <?php echo esc_html( $css_class ); ?>">
			<?php 
			if( $text ){
				echo '<h2 class="h3" '.$textmargintags.'>'.esc_html( $text ).'</h2>';
			}
			//
			if( $content ){
				echo '<div class="textblock" '.$styleattr.'>';
				echo hoskia_get_textareahtml_output( $content );
				echo '</div>';
			}
			//
			if( $btnlabel && $btnurl ){
				echo '<div class="action">';
					echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-default">'.esc_html( $btnlabel ).'<i class="fa flm fa-long-arrow-right"></i></a>';
				echo '</div>';
			}
			?>
		</div>
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_Ssdhost_Textarea();


?>