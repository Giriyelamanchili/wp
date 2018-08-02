<?php 
/**
 * Hoskia feature v2 Element
 */
class WPBakeryShortCode_featurevtwo extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// helper class
		$this->helper = new hoskia_helper() ;
		
		// maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_featuretwo_maping' ) );
		
		// shortcode
		add_shortcode( 'ssdhostfeaturesvtwo', array( $this, 'hoskia_featurevtwo_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_featuretwo_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Feature Version two", "hoskia" ),
		  "base" 		=> "ssdhostfeaturesvtwo",
		  "class" 		=> "",
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(
		  	array(
				"type" => "param_group",
				'param_name' => 'featurevtwo',
				'heading' => esc_html__('Features Version Two',"hoskia"),
				'params' => array(
				array(
					"type" 			=> "checkbox",
					"heading" 		=> esc_html__( "Active", "hoskia" ),
					"param_name" 	=> "active",
					"description" 	=> esc_html__( "Check this check box if you want to active this step.", "hoskia" )
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
					'emptyIcon' 	=> true, // default true, display an "EMPTY" icon?
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
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Step", "hoskia" ),
					"param_name" 	=> "step",
					"description" 	=> esc_html__( "Set step.", "hoskia" )
				),
				array(
					"type" 			=> "textarea",
					"heading" 		=> esc_html__( "Descriptions", "hoskia" ),
					"param_name" 	=> "description",
					"description" 	=> esc_html__( "Set feature descriptions.", "hoskia" )
				),
			)
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
	public function hoskia_featurevtwo_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'featurevtwo'  	   => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'iconcolor' 	   => '',
				'titlecolor' 	   => '',
				'desccolor' 	   => '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid( 'feature' );
		
		$features = vc_param_group_parse_atts( $featurevtwo );
		
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
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostfeatures', $atts );
		
		ob_start();
		?>	

		<div id="<?php echo esc_attr( $uniqId ); ?>" class="features-grid--items">
			<div class="features-grid--left text-right col-md-4">
				<div class="features-grid--item-wrap vc--parent <?php echo esc_attr( $css_class.$animation ); ?>">
					<div class="vc--child">
						<?php 
						$feature = current( $features );
																		
						$icon = ( !empty( $feature['icon_fontawesome'] ) ) ? $feature['icon_fontawesome'] : '';
						
						$imgicon = ( !empty( $feature['imgicon'] ) ) ? $feature['imgicon'] : '';
							
						if( !empty( $feature['icontype'] ) && 
						$feature['icontype'] == 'imageicon' ){
							
							$seticon = $imgicon;
						}else{
							$seticon = $icon;
						}
						
						
						$fontIcons = array( $seticon );
						
						$icon = $this->helper->hoskia_font_icon_process( $feature['icontype'], $fontIcons, $iconstyle );
						
						?>
						
						<div class="features-grid--item">
							<?php 
							if( !empty( $feature['step'] ) ){
								
								echo '<span class="step">';
									echo $feature['step'];
								echo '</span>';
							}
							//
							if( $icon ){
								echo '<div class="features-grid--icon">';
									echo $icon;
								echo '</div>';
							}
							?>
							<div class="features-grid--content">
								<?php 
								// 
								if( !empty( $feature['title'] ) ){
									echo '<h3 class="h4" '.$titletags.'>'.esc_html( $feature['title'] ).'</h3>';
								}
								//
								if( !empty( $feature['description'] ) ){
									echo '<p '.$desctags.'>'.esc_html( $feature['description'] ).'</p>';
								}
								?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="features-grid--right col-md-8">
				<div class="row">
				
				<?php 
				$col = array( '5', '5', '7', '7', '5' );
				foreach( $features as $key => $value ){
					if( $key < 1 ) continue;
							
					$icon = ( !empty( $value['icon_fontawesome'] ) ) ? $value['icon_fontawesome'] : '';
					
					$imgicon = ( !empty( $value['imgicon'] ) ) ? $value['imgicon'] : '';
					
					
					if( !empty( $value['icontype'] ) && 
					$value['icontype'] == 'imageicon' ){
						
						$seticon = $imgicon;
					}else{
						$seticon = $icon;
					}
					
					
					$fontIcons = array( $seticon );
										
					$icon = $this->helper->hoskia_font_icon_process( $value['icontype'], $fontIcons, $iconstyle );
					
					$active = ( !empty( $value['active'] ) ) ? 'active ': '';
							
					echo '<div class="col-md-'.esc_attr( $col[$key] ).'">';
						echo '<div class="features-grid--item-wrap '.esc_attr( $active.$css_class.$animation ).'">';
							echo '<div class="features-grid--item">';
							
								if( !empty( $value['step'] ) ){
									
									echo '<span class="step">';
										echo $value['step'];
									echo '</span>';
								}
								if( $icon ){
									echo '<div class="features-grid--icon">';
										echo $icon;
									echo '</div>';
								}
							
								echo '<div class="features-grid--content">';
									
									// 
									if( !empty( $value['title'] ) ){
										echo '<h3 class="h4" '.$titletags.'>'.esc_html( $value['title'] ).'</h3>';
									}
									//
									if( !empty( $value['description'] ) ){
										echo '<p '.$desctags.'>'.esc_html( $value['description'] ).'</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
						
					
				}
				
				?>
				</div>
			</div>
		</div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
}

$sectheading = new WPBakeryShortCode_featurevtwo();


?>