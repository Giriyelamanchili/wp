<?php 
/**
 * Hoskia Horizontal tab  Element
 */
class WPBakeryShortCode_horizontaltbltabel extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// SsdHost helper class
		$this->helper = new hoskia_helper();
		
		// horizontal table tab section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_horizontaltblwrp_maping' ) );
		
		// horizontal table tab section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_horizontaltbltab_maping' ) );
		
		// horizontal table tab section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_horizontaltblcontentwrp_maping' ) );
		
		// horizontal table tab section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_horizontaltblcontent_maping' ) );
		
		//  shortcode
		add_shortcode( 'horizontaltbltabwrp', array( $this, 'hoskia_horizontaltblwrp_shortcode' ) );
		
		//  shortcode
		add_shortcode( 'horizontaltbltab', array( $this, 'hoskia_horizontaltbltab_shortcode' ) );
		
		//  shortcode
		add_shortcode( 'horizontaltbltabcontentwrp', array( $this, 'hoskia_horizontaltblcontentwrp_shortcode' ) );
		
		//  shortcode
		add_shortcode( 'horizontaltbltabcontent', array( $this, 'hoskia_horizontaltblcontent_shortcode' ) );
		
	}
	
	// vc horizontal table tab wrapper param
	public function hoskia_horizontaltblwrp_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Horizontal Pricing Table Tab", "hoskia" ),
		  "base" 		=> "horizontaltbltabwrp",
		  "as_parent" => array('only' => 'horizontaltbltab, horizontaltbltabcontentwrp, ssdhostsectheading' ), // Use only|except 
		  "content_element" => true,
		  "is_container" => true,
		  "show_settings_on_create" => false,
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(	
				array(
					"type" 		 => "css_editor",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Design Options", "hoskia" ),
					"param_name" => "css",
				),
		  ),
		  "js_view" => 'VcColumnView'
		) );
		
		
	}
	
	// vc horizontal table tab param
	public function hoskia_horizontaltbltab_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Horizontal Pricing Table Tab", "hoskia" ),
		  "base" 		=> "horizontaltbltab",
		  "as_child" => array('only' => 'horizontaltbltabwrp'),
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(		
			array(
			"type"		 => "param_group",
			'param_name' => 'tabletab',
			"group"		 => esc_html__( "Tabs", "hoskia" ),
			'heading' 	 => esc_html__( 'Horizontal Table Tabs', 'hoskia' ),
			'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Tab Name", "hoskia" ),
						"param_name" => "tabname",
					),	
					array(
						"type" 		 => "checkbox",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Active", "hoskia" ),
						"param_name" => "tabactive",
						"description" => esc_html( 'If it is first tab check this checkbox.', 'hoskia' ),
					),					
				)
				
			),
		  )
		) );
		
		
	}
	
	// vc horizontal table tab content param
	public function hoskia_horizontaltblcontentwrp_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" 		=> esc_html__( "Table Content Wrapper", "hoskia" ),
		  "base" 		=> "horizontaltbltabcontentwrp",
		  "as_parent" => array('only' => 'horizontaltbltabcontent'),
		  "as_child" => array('only' => 'horizontaltbltabwrp'),
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(	
			array(
				"type" 		 => "css_editor",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Design Options", "hoskia" ),
				"param_name" => "css",
			),			
			
		  ),
		  "js_view" => 'VcColumnView'
		) );
			
	}
	
	// vc horizontal table tab content param
	public function hoskia_horizontaltblcontent_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Horizontal Pricing Table Content", "hoskia" ),
		  "base" 		=> "horizontaltbltabcontent",
		  "as_child" => array('only' => 'horizontaltbltabcontentwrp'),
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(		
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Tab Name", "hoskia" ),
				"param_name" => "tabname",
				"description" => esc_html( 'Set tab name.', 'hoskia' ),
			),	
			array(
				"type" 		 => "checkbox",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Active", "hoskia" ),
				"param_name" => "active",
				"description" => esc_html( 'If it is first table check this checkbox.', 'hoskia' ),
			),
			array(
			"type"		 => "param_group",
			'param_name' => 'tableheadings',
			"group"		 => esc_html__( "Table Heading", "hoskia" ),
			'heading' 	 => esc_html__( 'Horizontal Table Heading', 'hoskia' ),
			'params' 	 => array(
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Table Heading", "hoskia" ),
						"param_name" => "tblheading",
					),				
				)
				
			),
			array(
			"type"		 => "param_group",
			'param_name' => 'htblcontent',
			"group"		 => esc_html__( "Table Content", "hoskia" ),
			'heading' 	 => esc_html__( 'Horizontal Table Content', 'hoskia' ),
			'params' 	 => array(
				array(
				"type"		 => "param_group",
				'param_name' => 'tblcontent',
				"group"		 => esc_html__( "Table Content", "hoskia" ),
				'heading' 	 => esc_html__( 'Horizontal Table Content', 'hoskia' ),
				'params' 	 => array(
						array(
							"type" 		 => "dropdown",
							"holder" 	 => "div",
							"heading" 	 => esc_html__( "Content Type", "hoskia" ),
							"param_name" => "contenttype",
							"value"		 => array( 'Select Type' => '' ,'Text' => 'text', 'Icon' => 'icon' ),
							'description' => esc_html__( 'Select content type.', "hoskia" ),
						),
						array(
							"type" 		 => "textfield",
							"holder" 	 => "div",
							"heading" 	 => esc_html__( "Content", "hoskia" ),
							"param_name" => "content",
							'description' => esc_html__( 'Use text or icon.', "hoskia" ),
							'dependency' 	=> array(
								'element' => 'contenttype',
								'value'   => 'text',
							),
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
							'description' => esc_html__( 'Use text or icon.', "hoskia" ),
							'dependency' 	=> array(
								'element' => 'contenttype',
								'value'   => 'icon',
							),
						),
					),
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Button Text", "hoskia" ),
					"param_name" => "btntext",
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Button URL", "hoskia" ),
					"param_name" => "btnurl",
				),	

				),
										
			),
			
			
		  )
		) );
		
		
	}
	
	// horizontal table tab wrapper Shortcode and markup
	public function hoskia_horizontaltblwrp_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'css' => ''
			),
		$atts
		) );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'horizontaltbltabwrp', $atts );
				
		ob_start();
		
		?>
        <div id="pricingTable" class="hoskia--section <?php echo esc_attr( $css_class ); ?>">
            <div class="container">
				<?php 
				echo do_shortcode( $content );
				?>
			</div>
		</div>
		
		<?php
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	// Shortcode and markup
	public function hoskia_horizontaltbltab_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
			
				'tabletab' => '',
			),
		$atts
		) );
		
		$tabletab	= vc_param_group_parse_atts( $tabletab );
				
		ob_start();
		
				
		// Pricing Filter Start
		if( is_array( $tabletab ) && count( $tabletab ) > 0 ):
		?>
		<div class="pricing--filter">
			<ul>
				<li class="indicator"></li>
				<?php 
				global $tabid;
				
				$tabid['httab'] = array();
				
				foreach( $tabletab as $key => $tab ):
				if( !empty( $tab['tabname'] ) ):
				
				$slug = sanitize_title( $tab['tabname'] );
				$tid  = $slug.rand();
				$tabid['httab'][$slug] = $tid;
				
				if( !empty( $tab['tabactive'] ) ){
					$active = 'active';
				}else{
					$active = '';
				}
				
				?>
				<li class="<?php echo esc_attr( $active ); ?>"><a href="#<?php echo esc_attr( $tid ); ?>" role="tab" data-toggle="tab"><?php echo esc_html( $tab['tabname'] ); ?></a></li>
				<?php 
				endif;
				endforeach;
				?>
			</ul>
		</div>
		<?php 
		endif; //Pricing Filter End
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	// Shortcode and markup
	public function hoskia_horizontaltblcontentwrp_shortcode( $atts, $content = null ){

		extract( shortcode_atts(
			array(
				'css' => '',
			),
		$atts
		) );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'horizontaltbltabcontentwrp', $atts );
		
		ob_start();
		
		?>
		<div class="tab-content <?php echo esc_attr( $css_class ); ?>" data-scroll-reveal="bottom">
			<?php 				
			echo do_shortcode( $content );
			?>
		</div>
		<?php
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
	// Shortcode and markup
	public function hoskia_horizontaltblcontent_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'tableheadings' => '',
				'htblcontent' 	=> '',
				'contenttype' 	=> '',
				'tabname' 		=> '',
				'active' 		=> '',
			),
		$atts
		) );
								
		$tableheadings = vc_param_group_parse_atts( $tableheadings );
		$htblcontent   = vc_param_group_parse_atts( $htblcontent );
		$tid = sanitize_title( $tabname );
		
		global $tabid;
		//		
		
		
		if( $active ){
			$active = ' active';
		}else{
			$active = '';
		}
				
		ob_start();
		
		?>
			<div class="tab-pane<?php echo esc_attr( $active ); ?>" id="<?php echo esc_attr( $tabid['httab'][$tid] ); ?>">
				<table class="pricing--table table PricingTable">
					<?php 
					if( is_array( $tableheadings ) && count( $tableheadings ) > 0 ):
					?>
					<thead>
						<tr>
							<?php 
							foreach( $tableheadings as $tabname ){
								echo '<th>'.esc_html( $tabname['tblheading'] ).'</th>';
							}
							?>
						</tr>
					</thead>
					<?php 
					endif;
					?>
					<tbody>
						<?php 
						if( is_array( $htblcontent ) && count( $htblcontent ) > 0 ):
						foreach( $htblcontent as $contents ):
												
						$tdcontents   = vc_param_group_parse_atts( $contents['tblcontent'] );
											
						?>
						<tr>
							<?php 
							foreach( $tdcontents  as $content ){
								if( !empty( $content['contenttype'] ) && $content['contenttype'] != 'icon' ){
									if( !empty( $content['content'] ) ){
										echo '<td>'.esc_html( $content['content'] ).'</td>';
									}
								}else{
									if( !empty( $content['icon_fontawesome'] ) ){
										echo '<td><i class="fa '.esc_attr( $content['icon_fontawesome'] ).'"></i></td>';
									}
								}
							
								

							}
							//
							if( !empty( $contents['btntext'] ) && !empty( $contents['btnurl'] ) ){
								
								echo '<td><a href="'.esc_url( $contents['btnurl'] ).'" class="btn btn-default">'.esc_html( $contents['btntext'] ).'</a></td>';
							}
							?>
						</tr>
						<?php 
						endforeach;
						endif;
						?>
						
					</tbody>
				</table>
			</div>

		<?php
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
}

$horizontaltbl = new WPBakeryShortCode_horizontaltbltabel();

class WPBakeryShortCode_horizontaltbltabwrp extends WPBakeryShortCodesContainer{}
class WPBakeryShortCode_horizontaltbltabcontentwrp extends WPBakeryShortCodesContainer{}
?>