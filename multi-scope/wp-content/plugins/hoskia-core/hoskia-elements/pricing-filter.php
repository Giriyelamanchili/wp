<?php 
/**
 * Hoskia feature  Element
 */
class WPBakeryShortCode_pricingfilter extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_pricingfilter_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostpricingfilter', array( $this, 'hoskia_pricingfilter_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_pricingfilter_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Pricing Table Filter", "hoskia" ),
		  "base" 		=> "ssdhostpricingfilter",
		  "class" 		=> "",
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(		
			array(
				"type" 		 => "dropdown",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Column", "hoskia" ),
				"value"      => array( 'Column 2' => '6', 'Column 3' => '4', 'Column 4' => '3' ),
				"group"		 => esc_html__( "Pricing Table Settings", "hoskia" ),
				"param_name" => "column",
			),
			array(
			"type"		 => "param_group",
			'param_name' => 'pricingtablesset',
			"group"		 => esc_html__( "Pricing Table Settings", "hoskia" ),
			'heading' 	 => esc_html__( 'Pricing Table Settings', 'hoskia' ),
			'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Tab Name", "hoskia" ),
						"param_name" => "tabname",
					),	

					array(
					"type"		 => "param_group",
					'param_name' => 'pricingtabls',
					'heading' 	 => esc_html__( 'Pricing Tables', 'hoskia' ),
					'params' 	 => array(
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Title", "hoskia" ),
								"param_name" => "title",
							),
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Sub Title", "hoskia" ),
								"param_name" => "subtitle",
							),	
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "price", "hoskia" ),
								"param_name" => "price",
							),
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Duration", "hoskia" ),
								"param_name" => "duration",
							),	
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
								'emptyIcon' => true, // default true, display an "EMPTY" icon?
								'type' => 'fontawesome',
								'iconsPerPage' => 200, // default 100, how many icons per/page to display
								),
								'description' => esc_html__( 'Select icon from library.', "hoskia" ),
								'dependency' => array(
									'element' => 'icontype',
									'value' => 'fontawesome',
								),
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
								"type" 		 => "checkbox",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Active", "hoskia" ),
								"param_name" => "active",
							),
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Ribbon Text", "hoskia" ),
								"param_name" => "ribbon",
							),
							array(
							"type"		 => "param_group",
							'param_name' => 'features',
							'heading' 	 => esc_html__( 'Features', 'hoskia' ),
							'params' 	 => array(
									array(
										"type" 		 => "textfield",
										"holder" 	 => "div",
										"heading" 	 => esc_html__( "Feature", "hoskia" ),
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
									array(
										"type" => "colorpicker",
										"heading" => esc_html__( " Price Color", "hoskia" ),
										"param_name" => "iconcolor",
										"group"		=> esc_html__( "Design Option", "hoskia" ),
									),
									
								)
								
							),
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Button Text", "hoskia" ),
								"param_name" => "buttontext",
							),
							array(
								"type" 		 => "textfield",
								"holder" 	 => "div",
								"heading" 	 => esc_html__( "Button Url", "hoskia" ),
								"param_name" => "btnurl",
							),	

						),
												
					),
								
				)
				
			),
			
		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_pricingfilter_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'column' 		   => '3',
				'pricingtablesset' => '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = 'feature_'.uniqid();
		// array variable define
		$titlestl = $descstl = array();
		
		$desctags = $this->helper->hoskia_style_tag( $descstl );
							
		$pricingtablesset = vc_param_group_parse_atts( $pricingtablesset );
		
		ob_start();
		
		?>
		<div class="pricing--filter">
			<ul>
				<li class="indicator"></li>
				<?php 
				$html = '';
				$i = 0;
				foreach( $pricingtablesset as $tab ){
					$active = '';
					if( $i == 0 ){
						$active = 'active';
					}
					
					if( !empty( $tab['tabname'] ) ){
						$html .= '<li class="'.esc_attr( $active ).'"><a href="#pricingTab'.esc_attr( sanitize_title( $tab['tabname'] ) ).'" role="tab" data-toggle="tab">'.esc_html( $tab['tabname'] ).'</a></li>';
					}
					$i++;
				}
								
				echo $html;
				?>
			</ul>
		</div>
		
		<div class="tab-content" data-scroll-reveal="bottom">
			<?php 
			if( is_array( $pricingtablesset ) ):
				$i = 0;
				foreach( $pricingtablesset as $pricingtable ):
				$active = '';
				if( $i == 0 ){
					$active = ' active';
				}
				
				$pricingtabls = vc_param_group_parse_atts( $pricingtable['pricingtabls'] );
			?>
			<div class="tab-pane <?php echo esc_attr( $active ); ?>" id="pricingTab<?php echo esc_attr( sanitize_title( $pricingtable['tabname'] ) ); ?>">
				<div class="pricing--items row">
					<?php 
					foreach( $pricingtabls as $pricingtabl ):
					$tblactive = '';
					if( !empty( $pricingtabl['active'] ) ){
						$tblactive = ' active';
					}
					
					?>
					<div class="pricing--item col-md-<?php echo esc_attr( $column ); ?> col-sm-6">
						<div class="pricing--content <?php echo esc_attr( $tblactive ); ?>">
							<?php 
							if( !empty( $pricingtabl['ribbon'] ) ){
								echo '<span class="pricing--ribbon">'.esc_html( $pricingtabl['ribbon'] ).'</span>';
							}
							?>
							<div class="pricing--header">
								<?php 
								if( !empty( $pricingtabl['title'] ) ){
									echo '<h3 class="h4">'.esc_html( $pricingtabl['title'] ).'</h3>';
								}
								?>
								<h4 class="h5">
								<?php 
								if( !empty( $pricingtabl['subtitle'] ) ){
									echo esc_html( $pricingtabl['subtitle'] );
								}
								?>
								<strong>
								<?php 
								if( !empty( $pricingtabl['price'] ) ){
									echo esc_html( $pricingtabl['price'] );
								}
								//
								if( !empty( $pricingtabl['duration'] ) ){
									echo '<small>'.esc_html( $pricingtabl['duration'] ).'</small>';
								}
								?>
								</strong>
								</h4>
							</div>
							<?php 
							
							$icontype = ( !empty( $pricingtabl['icontype'] ) ) ? $pricingtabl['icontype'] : '';
							
							$fontawesome = ( !empty( $pricingtabl['icon_fontawesome'] ) ) ? $pricingtabl['icon_fontawesome'] : '';
							
							$imgicon = ( !empty( $pricingtabl['imgicon'] ) ) ? $pricingtabl['imgicon'] : '';
							$imgiconurl = wp_get_attachment_image_src( $imgicon, 'full' );
							
							
							if( $icontype == 'fontawesome' ){
								$getIcon = '<i class="'.esc_attr( $fontawesome ).'"></i>';
							}else{
								$getIcon = hoskia_img_tag(
									array(
										'url' => esc_url( $imgiconurl[0] )
									)
								);
							}
							//	
							if( $getIcon ){
								echo '<div class="pricing--icon"><i>';
									echo wp_kses_post( $getIcon );
								echo '</i></div>';
							}
							?>
							<?php 
							if( !empty( $pricingtabl['features'] ) ):
							$features = vc_param_group_parse_atts( $pricingtabl['features'] );
							?>
							<div class="pricing--features">
								<ul>
								<?php 
								foreach( $features as $feature ){
									$color = '';
									if( !empty( $feature['iconcolor'] ) ){
										$color = $feature['iconcolor'];
									}
									
									
									echo '<li>
									<i style="color:'.esc_attr( $color ).';" class="fa fm '.$feature['icon_fontawesome'].'"></i>
									'.$feature['feature'].'
									</li>';
								}
								?>
								</ul>
							</div>
							<?php 
							endif;
							?>
							<?php 
							if( !empty( $pricingtabl['buttontext'] ) && !empty( $pricingtabl['btnurl'] ) ):
							?>
							<div class="pricing--footer">
								<a href="<?php echo esc_url( $pricingtabl['btnurl'] ); ?>" class="btn btn-primary"><?php echo esc_html( $pricingtabl['buttontext'] ); ?></a>
							</div>
							<?php 
							endif;
							?>
						</div>
					</div>
					<?php 
					endforeach;
					?>
				</div>
			</div>
			<?php 
				$i++;
				endforeach;
			endif;
			?>
		</div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
}

$sectheading = new WPBakeryShortCode_pricingfilter();
?>