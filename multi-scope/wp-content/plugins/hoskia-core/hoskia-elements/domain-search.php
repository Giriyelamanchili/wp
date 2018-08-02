<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_domainsearch extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_domainsearch_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostdomainsearch', array( $this, 'hoskia_domainsearch_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_domainsearch_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		vc_map( array(
		  "name" => __( "Domain Search Form", "hoskia" ),
		  "base" => "ssdhostdomainsearch",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Search Action Url", "hoskia" ),
				"param_name" => "search_url",
			),	
		  	array(
			"type"		 => "param_group",
			'param_name' => 'extensions',
			'heading' 	 => esc_html__( 'Extensions', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Extension", "hoskia" ),
					"param_name" => "extension",
				),
				
			)
				
			),	
			//
			array(
				'type' 		  => 'animation_style',
				'heading' 	  => esc_html__( 'Animation Style', 'hoskia' ),
				'param_name'  => 'animation',
				'description' => esc_html__( 'Choose your animation style', 'hoskia' ),
				'admin_label' => false,
				'weight' 	  => 0,
				"group"		  => esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Search Border Color", "hoskia" ),
				"param_name" 	=> "searchbordercolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Background Color", "hoskia" ),
				"param_name" 	=> "btnbgcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),
			array(
				"type" 			=> "colorpicker",
				"heading" 		=> esc_html__( "Button Text Color", "hoskia" ),
				"param_name" 	=> "btntextcolor",
				"group"			=> esc_html__( "Design Option", "hoskia" ),
			),

		  )
		) );
		
	}
	
	// Shortcode and markup
	public function hoskia_domainsearch_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'search_url'     	=> '',
				'extensions'     	=> '',
				'searchbordercolor' => '',
				'btnbgcolor' 		=> '',
				'btntextcolor' 		=> '',
				'animation' 	 	=> '',
			),
		$atts
		) );
		
		$uniqId = uniqId('domainsearch');
		
		// Animation settings
		$animation  = $this->getCSSAnimation( $animation );
				
		$extensions = vc_param_group_parse_atts( $extensions );
		
		$css = '';
		
		//Search Input Fields Background Color
		if( $searchbordercolor ){
			$css .= '#'.esc_attr( $uniqId ).'.domain-search--form .input-group{background-color:'.esc_attr( $searchbordercolor ).';}';
		}
		
		if( $btnbgcolor || $btntextcolor ){
			$css .= '#'.esc_attr( $uniqId ).' .btn-default.active{background-color:'.esc_attr( $btnbgcolor ).';border-color:'.esc_attr( $btnbgcolor ).';color:'.esc_attr( $btntextcolor ).';}';
		}
		
		ob_start();
		?>				
			<!-- Domain Search Form Start -->
			<div id="<?php echo esc_attr( $uniqId ); ?>" class="domain-search--form <?php echo esc_attr( $animation ); ?>">
				<form action="<?php echo esc_url( $search_url ); ?>" method="post">
					<div class="input-group">
						<input type="text" name="domain" class="form-control" placeholder="<?php esc_html_e( 'Enter Your Domain Name Here', 'hoskia' ); ?>" required />
						<span class="input-group-addon">
							<select name="ext">
								<?php 
								$option = '';
								foreach( $extensions as $extension ){
									
									$option .= '<option value="'.esc_attr( $extension['extension'] ).'">'.esc_html__( $extension['extension'] ).'</option>';
																		
								}
								echo  $option;
								?>
							</select>
						</span>
					</div>
					<div class="action--button">
						<button type="submit" class="btn btn-default active"><?php esc_html_e( 'Search Now', 'hoskia' ); ?></button>
					</div>
				</form>
			</div>
			<!-- Domain Search Form End -->
		<?php

		if( $css ){
			echo $this->helper->hoskia_inline_css( $css );
		}
		
		$html = ob_get_clean();
		
		return $html;
		
	}
	
	
}

$domainsearch = new WPBakeryShortCode_domainsearch();


?>