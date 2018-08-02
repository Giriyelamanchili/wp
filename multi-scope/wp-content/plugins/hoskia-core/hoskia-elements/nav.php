<?php 
/**
 * Hoskia nav elements
 */
class WPBakeryShortCode_nav extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// helper class
		$this->helper = new hoskia_helper();
		
		// Hoskia Feature Tab Element maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_nav_maping' ) );
				
		// Hoskia Feature Tab Element shortcode
		add_shortcode( 'ssdhostnav', array( $this, 'hoskia_nav_shortcode' ) );
		
	}
	
	
	// Feature Tab vc Param
	public function hoskia_nav_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Custom Nav", "hoskia" ),
		  "base" => "ssdhostnav",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
		  	array(
			"type"		 => "param_group",
			'param_name' => 'navs',
			"group"		 => esc_html__( "Custom Nav", "hoskia" ),
			'heading' 	 => esc_html__( 'Set set custom nav and url.', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Nav Title", "hoskia" ),
					"param_name"  => "title",
					"description" => esc_html__( "Set latitude.", "hoskia" )
				),
				array(
					"type" 		  => "textfield",
					"heading" 	  => esc_html__( "Nav Url", "hoskia" ),
					"param_name"  => "url",
					"description" => esc_html__( "Set longitude.", "hoskia" )
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
					'description' 	=> esc_html__( 'Select icon from library.', "hoskia" ),
				),
			),
			),
		  )
		) );
		
		
	}
	
	// Feature Tab Element Shortcode and markup
	public function hoskia_nav_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'navs'	=> '',
			),
		$atts
		) );
		
		
		//
		$navs = vc_param_group_parse_atts( $navs );
		
		ob_start();

		?>
		<aside class="page--sidebar">
			<nav class="page--sidebar-nav bg-color--alabaster">
				<ul class="nav">
					<?php 
					foreach( $navs as $nav ){
						
						$url = ( !empty( $nav['url'] ) ) ? $nav['url'] : '';
						$title = ( !empty( $nav['title'] ) ) ? $nav['title'] : '';
						
						$fontawesome = ( !empty( $nav['icon_fontawesome'] ) ) ? $nav['icon_fontawesome'] : '';
						
						echo '<li>';
							echo '<a href="'.esc_url( $url ).'"><i class="'.esc_attr( $fontawesome ).'"></i>'.esc_html( $title ).'</a>';
						echo '</li>';
						
					}
					?>
				</ul>
			</nav>
		</aside>
		<?php
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
	
}

$datacenterslider = new WPBakeryShortCode_nav();


?>