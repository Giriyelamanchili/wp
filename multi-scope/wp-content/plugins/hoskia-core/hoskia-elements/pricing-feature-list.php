<?php 
/**
 * Hoskia pricing Element
 */
class WPBakeryShortCode_pricingvtwo extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// ssdhost helper class
		$this->helper = new hoskia_helper() ;
		
		// ssdhost feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_pricingvtwo_maping' ) );
		
		// ssdhost feature shortcode
		add_shortcode( 'ssdhostpricingvtwo', array( $this, 'hoskia_pricingvtwo_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_pricingvtwo_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => esc_html__( "Pricing Table Feature List", "hoskia" ),
		  "base" => "ssdhostpricingvtwo",
		  "class" => "",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => esc_html__( "Hoskia", "hoskia"),
		  "params" => array(
		  
		  	array(
				"type" => "param_group",
				'param_name' => 'pricingtables',
				'heading' => esc_html__('Pricing Tables',"hoskia"),
				'params' => array(
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Type', "hoskia" ),
						'param_name' 	=> 'type',
						'value' 		=> array( 'Pricing Table' => 'pricingtbl' ,'Feature List' => 'featurelist'),
						'description' 	=> esc_html__( 'Choose your animation style', "hoskia" ),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Feature List Title", "hoskia" ),
						"param_name" => "fltitle",
						"description" => esc_html__( "Set feature list table title.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'featurelist',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Title", "hoskia" ),
						"param_name" => "title",
						"description" => esc_html__( "Set pricing table title.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),				
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Sub Title", "hoskia" ),
						"param_name" => "subtitle",
						"description" => esc_html__( "Set pricing table sub title.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Price", "hoskia" ),
						"param_name" => "price",
						"description" => esc_html__( "Set price.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Duration", "hoskia" ),
						"param_name" => "duration",
						"description" => esc_html__( "Set duration.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
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
						'description' => esc_html__( 'Select icon from library.', "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					array(
						"type" => "checkbox",
						"heading" => esc_html__( "Active", "hoskia" ),
						"param_name" => "active",
						"description" => esc_html__( "Set active pricing table.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					array(
						"type" => "param_group",
						'param_name' => 'featuresgroup',
						'heading' => esc_html__('Pricing Features',"hoskia"),
						'params' => array(
							array(
								"type" => "textfield",
								"holder" => "div",
								"heading" => esc_html__( "Feature", "hoskia" ),
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
						)	
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Button Text", "hoskia" ),
						"param_name" => "btntext",
						"description" => esc_html__( "Set button text.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( "Button Url", "hoskia" ),
						"param_name" => "btnurl",
						"description" => esc_html__( "Set button url.", "hoskia" ),
						'dependency' 	=> array(
							'element' => 'type',
							'value'   => 'pricingtbl',
						),
					),
					
				)	
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Column", "hoskia" ),
				"param_name" => "col",
				"group" => esc_html__( "Settings", "hoskia" ),
				'value'	=> array( 'Default' => '', '2 Column' => '6', '3 Column' => '4', '4 Column' => '3' ),
				"description" => esc_html__( "Set button url.", "hoskia" ),
			),
			
			
		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_pricingvtwo_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'pricingtables'    => '',
				'col'    		   => '3',
			),
		$atts
		) );
		
		$pricingtables = vc_param_group_parse_atts( $pricingtables );
		
		ob_start();
		?>			
		<!-- Pricing Items Start -->
		<div id="pricingIncluded" class="pricing--items row reset-gutter border--on shadow--off" data-scroll-reveal="bottom">	<?php 
			if( is_array( $pricingtables ) && count( $pricingtables ) > 0 ):
			foreach( $pricingtables as $pricingtable ):
			
			$active = '';
			if( !empty( $pricingtable['active'] ) ){
				$active = ' active';
			}
			
			?>
			<div class="pricing--item col-md-<?php echo esc_attr( $col );?>">
				<div class="pricing--content <?php echo esc_attr( $active ); ?>">
					<?php 
					$flClass = $title = '';
					if( !empty( $pricingtable['type'] ) &&  $pricingtable['type'] != 'featurelist' ){
					?>
						<div class="pricing--header">
							<?php 
							if( !empty( $pricingtable['title'] ) ){
								echo '<h3 class="h4">'.esc_html( $pricingtable['title'] ).'</h3>';
							}
							?>
							<h4 class="h5">
							<?php 
							if( !empty( $pricingtable['subtitle'] ) ){
								echo esc_html( $pricingtable['subtitle'] );
							}
							?>
							<strong>
							<?php 
							//
							if( !empty( $pricingtable['price'] ) ){
								echo esc_html( $pricingtable['price'] );
							}
							if( !empty( $pricingtable['duration'] ) ){
								echo '<small>'.esc_html( $pricingtable['duration'] ).'</small>';
							}
							?>
							</strong></h4>
						</div>
					<?php 
						if( !empty( $pricingtable['icon_fontawesome'] ) ){
							echo '<div class="pricing--icon">';
								echo '<i class="'.esc_attr( $pricingtable['icon_fontawesome'] ).'"></i>';
							echo '</div>';
						}
						
					}else{
					
						$flClass = ' text-left text-color--default';
						if( !empty( $pricingtable['fltitle'] ) ){
							$title = '<li><h3 class="h3">'.esc_html( $pricingtable['fltitle'] ).'</h3></li>';
						}
					}
					?>
					
					<div class="pricing--features <?php echo esc_attr( $flClass ); ?>">
						<ul>
							<?php 
							echo wp_kses_post( $title );
							$features = vc_param_group_parse_atts( $pricingtable['featuresgroup'] );
							foreach( $features as $feature ){
																
								if( !empty( $feature['feature'] ) ){
									echo '<li>'.esc_html( $feature['feature'] ).'</li>';
								}else{
									echo '<li><i class="'.esc_html( $feature['icon_fontawesome'] ).'"></i></li>';
								}
							}
							?>
						</ul>
					</div>
					<?php 					
					if( !empty( $pricingtable['btntext'] ) && !empty( $pricingtable['btnurl'] ) ){
						echo '<div class="pricing--footer">';
							echo '<a href="'.esc_url( $pricingtable['btnurl'] ).'" class="btn btn-primary">'.esc_html( $pricingtable['btntext'] ).'</a>';
						echo '</div>';
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
		
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
	
}

$sectheading = new WPBakeryShortCode_pricingvtwo();


?>
