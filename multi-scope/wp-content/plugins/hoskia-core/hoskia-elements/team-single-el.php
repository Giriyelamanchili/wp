<?php 
/**
 * Team Element Element
 */
class WPBakeryShortCode_team_singleel extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Helper class
		$this->helper = new hoskia_helper();
		
		// Feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_teammember_maping' ) );
		
		// Feature shortcode
		add_shortcode( 'ssdhostteammember', array( $this, 'hoskia_teammember_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_teammember_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => esc_html__( "Team Member", "hoskia" ),
		  "base" => "ssdhostteammember",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => esc_html__( "Hoskia", "hoskia"),
		  "params" => array(
		 
			//
			array(
				"type" => "attach_image",
				"holder" => "div",
				"heading" => esc_html__( "Image", "hoskia" ),
				"param_name" => "img",
				"description" => esc_html__( "Set service image.", "hoskia" ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Name", "hoskia" ),
				"param_name" => "name",
				"description" => esc_html__( "Set feature title.", "hoskia" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Expert In", "hoskia" ),
				"param_name" => "expertin",
				"description" => esc_html__( "Set title url.", "hoskia" )
			),
			array(
				"type" => "param_group",
				'param_name' => 'teamsocial',
				'heading' => esc_html__('Member Social Media',"hoskia"),
				'params' => array(
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Fonta Wesome Icon', "hoskia" ),
						'param_name' => 'icon',
						'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'fontawesome',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
						),
						'description' => esc_html__( 'Select icon from library.', "hoskia" ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('URL',"hoskia"),
						'param_name' => 'url',
					),
				)
					
			),

			//
			array(
				"type" => "css_editor",
				"heading" => esc_html__("Design Settings Options", "hoskia"),
				"param_name" => "css",
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				'type' => 'animation_style',
				'heading' => esc_html__( 'Animation Style', "hoskia" ),
				'param_name' => 'animation',
				'description' => esc_html__( 'Choose your animation style', "hoskia" ),
				'admin_label' => false,
				'weight' => 0,
				"group"		=> esc_html__( "Design Option", "hoskia" ),
			),

		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_teammember_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'img'  	   	   => '',
				'name'  	   => '',
				'expertin'     => '',
				'teamsocial'   => '',
				'animation'    => '',
				'css' 	   	   => '',
			),
		$atts
		) );
				
		// Animition settings
		$animation  = $this->getCSSAnimation( $animation );
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostteammember', $atts );
		
		$imgurl = wp_get_attachment_image_src( $img , 'full' );
		
		ob_start();
		?>
		<div class="team--member <?php echo esc_attr( $animation.$css_class ); ?>">
			<div class="team--member-img">
				<?php 
				if( !empty( $imgurl[0] ) ){
					echo hoskia_img_tag(
						array(
							'url' => esc_url( $imgurl[0] )
						)
					);
					
				}
				?>
				<div class="team--member-info bg--overlay">
					<?php 
					// 
					if( !empty( $name ) ){
						echo '<h3 class="h4">'.esc_html( $name ).'</h3>';
					}
					//
					if( !empty( $expertin ) ){
						echo '<p>'.esc_html( $expertin ).'</p>';
					}
										
					$teamsocial = vc_param_group_parse_atts( $teamsocial );
					
					
					// Team Social
					if( is_array( $teamsocial ) && count( $teamsocial ) > 0 ):
					?>
					<div class="team--member-socai">
						<ul class="nav">
							<?php 
							$html = '';
							foreach( $teamsocial as $social ){
								$html .= '<li><a href="'.esc_url( $social['url'] ).'"><i class="fa '.esc_attr( $social['icon'] ).'"></i></a></li>';
							}
							echo wp_kses_post( $html );
							?>
						</ul>
					</div>
					<?php 
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_team_singleel();


?>