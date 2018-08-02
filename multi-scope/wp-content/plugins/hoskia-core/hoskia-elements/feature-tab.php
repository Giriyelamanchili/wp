<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_featuretab extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
				
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_featuretab_maping' ) );
		
		// Hoskia Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_tabelement_maping' ) );
		
		// Hoskia Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_ssdhostcontent_maping' ) );
		
		// Hoskia Feature Tab Content Wrapper Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_ssdhostcontentwrapper_maping' ) );
		
		
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostfeaturetab', array( $this, 'hoskia_featuretab_shortcode' ) );
		
		// Hoskia Feature Tab Element shortcode
		add_shortcode( 'ssdhostfte', array( $this, 'hoskia_tabelement_shortcode' ) );
		
		// Hoskia Feature Tab Content Wrapper Element shortcode
		add_shortcode( 'ssdhostcontentwrapper', array( $this, 'hoskia_ssdhostcontentwrapper_shortcode' ) );
		
		// Hoskia Feature Tab Element shortcode
		add_shortcode( 'ssdhostcontent', array( $this, 'hoskia_ssdhostcontent_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_featuretab_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Feature Tab", "hoskia" ),
		  "base" => "ssdhostfeaturetab",
		  "as_parent" => array('only' => 'ssdhostfte, ssdhostcontentwrapper,ssdhostsectheading' ), // Use only|except 
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "content_element" => true,
		  "is_container" => true,
		  "show_settings_on_create" => false,
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(

		  ),
		  "js_view" => 'VcColumnView'
		  
		) );
		
		
	}
	
	
	
	// Feature Tab vc Param
	public function hoskia_tabelement_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Feature Element Tab", "hoskia" ),
		  "base" => "ssdhostfte",
		  "as_child" => array('only' => 'ssdhostfeaturetab'),
		  "content_element" => true,
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  	array(
			"type"		 => "param_group",
			'param_name' => 'featuretabs',
			"group"		 => esc_html__( "Set Tab Name", "hoskia" ),
			'heading' 	 => esc_html__( 'Set Content', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Title", "hoskia" ),
					"param_name"  => "title",
					"description" => esc_html__( "Set title.", "hoskia" )
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
					
			),
			),	
			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
			),		

		  )
		) );
		
		
	}
	
	// Feature Tab vc Param
	public function hoskia_ssdhostcontentwrapper_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Feature Content Wrapper", "hoskia" ),
		  "base" => "ssdhostcontentwrapper",
		  "as_child" => array('only' => 'ssdhostfeaturetab'),
		  "as_parent" => array('only' => 'ssdhostcontent' ), // Use only|except 
		  "content_element" => true,
		  "is_container" => true,
		  "show_settings_on_create" => false,
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  
			
		  ),
		  "js_view" => 'VcColumnView'
		) );
		
		
	}
	
	// Feature Tab vc Param
	public function hoskia_ssdhostcontent_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Feature Content Element", "hoskia" ),
		  "base" => "ssdhostcontent",
		  "as_child" => array('only' => 'ssdhostcontentwrapper'),
		  "content_element" => true,
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  
			array(
				"type" 		 => "checkbox",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Active", "hoskia" ),
				"param_name" => "active",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Tab Name", "hoskia" ),
				"param_name" => "tabname",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
				"description"	=> esc_html__( "Set tab name which is set in Feature Element Tab Settings.", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Title", "hoskia" ),
				"param_name" => "title",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),
			array(
				"type" 		 => "textarea_html",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Content", "hoskia" ),
				"param_name" => "content",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),
			array(
				"type" 		 => "dropdown",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Image Position", "hoskia" ),
				"value" 	 => array( 'Default' => '', 'Left' => 'pull-right', 'Right'=> 'pull-left' ),
				"param_name" => "position",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),	
			array(
				"type" 		  => "attach_image",
				"holder" 	  => "div",
				"heading" 	  => esc_html__( "Image", "hoskia" ),
				"param_name"  => "img",
				"description" => esc_html__( "Set image.", "hoskia" ),
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button Text", "hoskia" ),
				"param_name" => "btntext",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button URL", "hoskia" ),
				"param_name" => "btnurl",
				"group"		 => esc_html__( "Feature Content", "hoskia" ),
			),

			//
			array(
				"type" 		 => "css_editor",
				"heading" 	 => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		 => esc_html__( "Design Option", "hoskia" ),
			),
			
		  )
		) );
		
		
	}
	
	
	
	// Shortcode and markup
	public function hoskia_featuretab_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
			),
		$atts
		) );
				
		ob_start();
		?>	
	    <!-- Services Tab Area Start -->
        <div id="servicesTab">
            <div class="container">
				<?php 
				echo do_shortcode( $content );
				?>
            </div>
        </div>
        <!-- Services Tab Area End -->
		
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	// Feature Tab Element Shortcode and markup
	public function hoskia_tabelement_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'featuretabs'     => '',
				'css' 	   		  => '',
			),
		$atts
		) );
		

		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostfte', $atts );

		$featuretabs = vc_param_group_parse_atts( $featuretabs );

		
		ob_start();

		//
		
		global $tabid;
			
		
			if( is_array( $featuretabs ) && count( $featuretabs ) > 0 ):
			$tabid = array();

			?>
			<div class="services-tab--nav <?php echo esc_attr( $css_class ); ?>" data-scroll-reveal="bottom">
				<ul class="nav">
					<?php 
					$i = 0;
					foreach( $featuretabs as $tab ):
					$title = sanitize_title( $tab['title'] );
					$title_id = $title.rand();
					$tabid[$title] = $title_id;
					
					if( $i == 0 ){
						$active = 'active';
					}else{
						$active = '';
					}
					?>
					<li class="<?php echo esc_attr( $active ); ?>">
						<a href="#<?php echo esc_attr( $title_id ); ?>" data-toggle="tab" title="<?php echo esc_attr( $tab['title'] ); ?>">
						
						<?php 
						
						//$tab['icon_fontawesome']
						//$tab['imgicon']
						// fontawesome
						
						
						$type = ( !empty( $tab['icontype'] ) ) ? $tab['icontype'] : '';
						
						$imgicon = ( !empty( $tab['imgicon'] ) ) ? $tab['imgicon'] : '';
						
						
						$fontawesome = ( !empty( $tab['icon_fontawesome'] ) ) ? $tab['icon_fontawesome'] : '';
						
						if( $type != 'imageicon' ){
							
							echo '<i class="'.esc_attr( $fontawesome ).'"></i>';
						
						}else{
							$imgiconurl = wp_get_attachment_image_src( $imgicon, 'full' );
							
							echo '<i>';
							echo hoskia_img_tag(
								array(
									'url' => esc_url( $imgiconurl[0] )
								)
							);
							echo '</i>';
							
						}
						
						?>
						
						
						
							
							
						</a>
					</li>
					<?php 
					$i++;
					endforeach;
					?>
				</ul>
			</div>
			<?php 
			endif;
			?>
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	// Tab Content Shortcode and markup
	public function hoskia_ssdhostcontentwrapper_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(

			),
		$atts
		) );
		
	
		
		ob_start();
		?>	
		<div class="services-tab--items tab-content" data-scroll-reveal="bottom">
			<?php 
			echo do_shortcode( $content );
			?>
		</div>	
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	// Tab Content Shortcode and markup
	public function hoskia_ssdhostcontent_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'active'   => '',
				'tabname'  => '',
				'btnurl'   => '',
				'btntext'  => '',
				'position' => '',
				'img'      => '',
				'title'    => '',
				'css' 	   => '',
			),
		$atts
		) );
		
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostcontent', $atts );

		
		global $tabid;
		$tabname = sanitize_title( $tabname );
		
		if( !empty( $tabid[$tabname] ) ){
			$tab_id = $tabid[$tabname];
		}else{
			$tab_id = '';
		}
		//
		if( $active ){
			$active = ' in active '; 
		}else{
			$active = '';
		}
		
		//$img
		$imgurl = wp_get_attachment_image_src( $img , 'full' );
		ob_start();
		?>	

			<div class="services-tab--item tab-pane fade<?php echo esc_attr( $active.$css_class ); ?>" id="<?php echo esc_attr( $tab_id ); ?>">
				<div class="row row--vc">
					<div class="services-tab--content col-md-6 <?php echo esc_attr( $position ); ?>">
						<?php 
						if( $title ){
							echo '<h3 class="h3">'.esc_html( $title ).'</h3>';
						}
						//
						echo hoskia_get_textareahtml_output( $content ) ;
						//
						if( $btnurl && $btntext ){
							echo '<a href="'.esc_url( $btnurl ).'" class="btn btn-primary">'.esc_html( $btntext ).'<i class="fa flm fa-long-arrow-right"></i></a>';
						}
						?>
					</div>
					<?php 
					if( !empty( $imgurl[0] ) ):
					?>
					<div class="services-tab--img col-md-6">
						<img src="<?php echo esc_url( $imgurl[0] ); ?>" alt="<?php echo esc_attr( hoskia_image_alt( $imgurl[0] ) ); ?>" class="img-responsive" />
					</div>
					<?php 
					endif;
					?>
				</div>
			</div>
	
		<?php

		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
}

$sectheading = new WPBakeryShortCode_featuretab();


class WPBakeryShortCode_ssdhostfeaturetab extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_ssdhostcontentwrapper extends WPBakeryShortCodesContainer{}

?>