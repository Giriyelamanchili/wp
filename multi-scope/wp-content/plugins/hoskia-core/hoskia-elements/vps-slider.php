<?php 
/**
 * Hoskia feature  Element
 */
class WPBakeryShortCode_Vpsslider extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_vpsslider_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'ssdhostvpsslider', array( $this, 'hoskia_vpsslider_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_vpsslider_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Vps Slider", "hoskia" ),
		  "base" 		=> "ssdhostvpsslider",
		  "class" 		=> "",
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(
			// General
			array(
				"type" 		 => "checkbox",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Show Custom Order Button", "hoskia" ),
				"group"		 => esc_html__( "General", "hoskia" ),
				"param_name" => "scbtnactive",
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Custom Order Button Text", "hoskia" ),
				"group"		 => esc_html__( "General", "hoskia" ),
				"param_name" => "btntext",
				'dependency' => array(
					'element' => 'scbtnactive',
					'not_empty' => true,
				),
				
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Custom Order Button Text", "hoskia" ),
				"group"		 => esc_html__( "General", "hoskia" ),
				"param_name" => "btnurl",
				'dependency' => array(
					'element' => 'scbtnactive',
					'not_empty' => true,
				),
			),
			array(
				"type" 		 => "checkbox",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Show Order Button", "hoskia" ),
				"group"		 => esc_html__( "General", "hoskia" ),
				"param_name" => "ordbtnactive",
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Order Button Text", "hoskia" ),
				"group"		 => esc_html__( "General", "hoskia" ),
				"param_name" => "orderbtntext",
				'dependency' => array(
					'element' => 'ordbtnactive',
					'not_empty' => true,
				),
			),

			// Features
			array(
			"type"		 => "param_group",
			'param_name' => 'features',
			"group"		 => esc_html__( "Plan Features", "hoskia" ),
			'heading' 	 => esc_html__( 'Set plan features', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Title", "hoskia" ),
					"param_name" => "title",
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
				'description' 	=> esc_html__( 'Select icon from library.', "hoskia" ),
				),
				
			)
				
			),
			
			// Features Content
			array(
			"type"		 => "param_group",
			'param_name' => 'features_content',
			"group"		 => esc_html__( "Plan Features Content", "hoskia" ),
			'heading' 	 => esc_html__( 'Set plan features content', 'hoskia' ),
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
					"heading" 	 => esc_html__( "Price", "hoskia" ),
					"param_name" => "price",
				),	
				array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Font Awesome Icon', "hoskia" ),
				'param_name' 	=> 'icon',
				'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'fontawesome',
				'iconsPerPage'  => 200, // default 100, how many icons per/page to display
				),
				'description' 	=> esc_html__( 'Select icon from library.', "hoskia" ),
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "URL", "hoskia" ),
					"param_name" => "url",
				),
				// Features
				array(
				"type"		 => "param_group",
				'param_name' => 'features',
				"group"		 => esc_html__( "Features Value", "hoskia" ),
				'heading' 	 => esc_html__( 'Set features value', 'hoskia' ),
				'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Value", "hoskia" ),
						"param_name" => "title",
					),	
					
				)
					
				),
				
			)
				
			),
			
			//
			array(
				"type" 			=> "css_editor",
				"heading" 		=> esc_html__("Design Settings Options", "hoskia"),
				"param_name" 	=> "css",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_vpsslider_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'features'  	   => '',
				'features_content' => '',
				'animation' 	   => '',
				'css' 	   		   => '',
				'scbtnactive' 	   => '',
				'ordbtnactive' 	   => '',
				'btntext' 	   	   => 'Customize Order',
				'btnurl' 	   	   => '',
				'orderbtntext' 	   => 'Order Now',
				
			),
		$atts
		) );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostvpsslider', $atts );
		
		/*************************
			Features and other
		*************************/
		$features = vc_param_group_parse_atts( $features );
		
		$PuttitleArray = array();
		
		$optimizeFeature = array();
		
		foreach( $features as $feature ){
			
			$title = $feature['title'];
			$puttitlSanitizee = sanitize_title( $title );
			$puttitleSlug = str_replace( '-', '' , $puttitlSanitizee );
			
			$PuttitleArray[] = $puttitleSlug;
			
			$optimizeFeature[] = array(
			
				'title' 	=> $title,
				'icon' 		=> $feature['icon_fontawesome'],
				'puttitle'  => $puttitleSlug,
			
			);
			
			
		
		}
				
		/*************************
			Features Content
		*************************/
		
		$features_content = vc_param_group_parse_atts( $features_content );
		
		$gedata = array();
		
		foreach( $features_content as $content ){
			
			$sliceContent = array_slice( $content, 0, -1 );
					
			$featuresvalue = vc_param_group_parse_atts( $content['features'] );
			
			$fvl = array();
			foreach( $featuresvalue as $val ){
				
				$fvl[] = $val['title'];

				
			}
			
			$fvl = array_combine( $PuttitleArray, $fvl );
			
			$gedata[] = array_merge( $sliceContent, $fvl );
			
			
		}
		
		$sendJson = wp_json_encode( $gedata );
		
		wp_localize_script(
			'hoskia-main',
			'vpsdataobj',
			array(
				'vpsdata' => $sendJson
			)
		);
		
		ob_start();
		?>
        <div id="vpsPricing" class="<?php echo esc_attr( $css_class ); ?>" data-scroll-reveal="group">
			<div id="vpsPricingSlider" class="vps-pricing--slider"></div>
			
			<div class="vps-pricing--ruler bg--overlay-off" data-bg-img="<?php echo plugins_url( '../img/ruler.png' , __FILE__ ); ?>"></div>
			
			<div class="vps-pricing--items row AdjustRow">
			
				<?php 
				if( is_array( $optimizeFeature ) && count( $optimizeFeature ) > 0 ):
				foreach( $optimizeFeature as $feature ):
									
				?>
				<div class="vps-pricing--item col-md-3 col-xs-6">
					<div class="vps-pricing--content">
						<?php 
						//
						if( !empty( $feature['icon'] ) ){
							echo '<i class="fa '.esc_html( $feature['icon'] ).'"></i>';
						}
						//
						if( !empty( $feature['title'] ) ){
							echo '<h4 class="h4">'.esc_html( $feature['title'] ).'</h4>';								
							echo '<h5 class="h5" data-put-value="'.esc_attr( $feature['puttitle'] ).'">2 CORE</h5>';
						}
						?>
					</div>
				</div>
				<?php 
				endforeach;
				endif;
				?>
			</div>
			<?php 
			if( $scbtnactive || $ordbtnactive ):
			?>
			<div class="vps-pricing--action">
				<?php 
				//
				if( $ordbtnactive ){
					
					echo '<a href="#" class="btn btn-primary" data-put-href="url">'. esc_html(  $orderbtntext ).'</a>';
				}
				//
				if( $scbtnactive  ){
					echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-primary">'. esc_html__( $btntext ).'</a>';
				}
				?>
			</div>
			<?php 
			endif;
			?>
        </div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_Vpsslider();


?>