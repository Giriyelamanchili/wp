<?php 
/**
 * Hoskia feature  Element
 */
class WPBakeryShortCode_horizontaltblel extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper();
		
		// Qfix feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_horizontaltbl_maping' ) );
		
		// Qfix feature shortcode
		add_shortcode( 'horizontaltbl', array( $this, 'hoskia_horizontaltbl_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_horizontaltbl_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" 		=> esc_html__( "Horizontal Pricing Table", "hoskia" ),
		  "base" 		=> "horizontaltbl",
		  "class" 		=> "",
		  "icon"  		=> HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" 	=> esc_html__( "Hoskia", "hoskia" ),
		  "params" 		=> array(		
			
			array(
				"type" 		 => "dropdown",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Table Heading", "hoskia" ),
				"value"		 => array( 'Style 1' => 'style1', 'Style 2' => 'style2' ), 
				"param_name" => "style",
			),	
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button Text", "hoskia" ),
				"param_name" => "tblbtntext",
			),	
			array(
				"type" 		 => "textfield",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Button Url", "hoskia" ),
				"param_name" => "tblbtnurl",
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
							"type" 		 => "textfield",
							"holder" 	 => "div",
							"heading" 	 => esc_html__( "Content", "hoskia" ),
							"param_name" => "content",
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
			array(
				"type" 		 => "colorpicker",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Table Header Background Color", "hoskia" ),
				"group"		 => esc_html__( "Design", "hoskia" ),
				"param_name" => "thbc",
			),
			array(
				"type" 		 => "colorpicker",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Table Header Border Color", "hoskia" ),
				"group"		 => esc_html__( "Design", "hoskia" ),
				"param_name" => "thbordc",
			),	
			array(
				"type" 		 => "colorpicker",
				"holder" 	 => "div",
				"heading" 	 => esc_html__( "Table Header Text Color", "hoskia" ),
				"group"		 => esc_html__( "Design", "hoskia" ),
				"param_name" => "thtc",
			),	
			
			
		  )
		) );
		
		
	}
	
	// Shortcode and markup
	public function hoskia_horizontaltbl_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'tableheadings' => '',
				'htblcontent' 	=> '',
				'tblbtnurl' 	=> '',
				'tblbtntext' 	=> '',
				'style' 		=> '',
				'thbc' 			=> '',
				'thtc' 			=> '',
				'thbordc' 		=> '',
			),
		$atts
		) );
		
		// uniq id
		$uniqId = uniqid('pricing--table');
		// array variable define
		$titlestl = $descstl = array();
		
		$desctags = $this->helper->hoskia_style_tag( $descstl );
							
		$tableheadings = vc_param_group_parse_atts( $tableheadings );
		$htblcontent   = vc_param_group_parse_atts( $htblcontent );
		
		if( $style == 'style2' ){
			$style = 'stylev2 ';
		}else{
			$style = '';
		}
			
		// Inline Css
		$inlineCss = '';
		if( $thbc ){
			$inlineCss .= '#'.$uniqId.'.pricing--table th:before{background-color:'.esc_attr( $thbc ).';}';
		}
		if( $thbordc ){
			$inlineCss .= '#'.$uniqId.'.pricing--table th:before{border-color:'.esc_attr( $thbordc ).';}';
		}
		if( $thtc ){
			$inlineCss .= '#'.$uniqId.'.pricing--table th{color:'.esc_attr( $thtc ).';}';
		}
		
		
		
		ob_start();
		
		?>
        <div id="pricingTable" class="<?php echo esc_attr( $style ); ?>">
			<!-- Pricing Table Start -->
			<table id="<?php echo esc_attr( $uniqId ); ?>" class="pricing--table table PricingTable" data-scroll-reveal="bottom">
				<?php 
				if( is_array( $tableheadings ) && count( $tableheadings ) > 0 ){
					$html = '';
					$html .= '<thead>';
						$html .= '<tr>';
						foreach( $tableheadings as $tableheading ){
							$html .= '<th>'.esc_html( $tableheading['tblheading'] ).'</th>';
						}
						$html .= '</tr>';
					$html .= '</thead>';
					
					echo $html;
				}
				?>
				<tbody>
				
					<?php 
					if( is_array( $htblcontent ) && count( $htblcontent ) > 0 ):
					foreach( $htblcontent as $content ):
					?>
					<tr>
						<?php
						$tblcontent = vc_param_group_parse_atts( $content['tblcontent'] );
						if( is_array( $tblcontent ) && count( $tblcontent ) > 0 ){
							foreach( $tblcontent as $val ){
								if( !empty( $val['content'] ) ){
									echo '<td>'.esc_html( $val['content'] ).'</td>';
								}
							}
						}
						
						//
						if( !empty( $content['btntext'] ) && !empty( $content['btnurl'] ) ){
							echo '<td><a href="'.esc_url( $content['btnurl'] ).'" class="btn btn-default">'.esc_html( $content['btntext'] ).'</a></td>';
						}
						?>
					</tr>
					<?php 
					endforeach;
					endif;
					?>

				</tbody>
			</table>
			<?php 
			//Pricing Table End
			
			if( $tblbtnurl && $tblbtntext ){
				echo '<div class="section--footer text-center m--40-0-0">';
                    echo '<a href="'.esc_url( $tblbtnurl ).'" class="btn btn-default">'.esc_html( $tblbtntext ).'</a>';
                echo '</div>';	
			}
			?>
        </div>
		<?php
		if($inlineCss){
			echo $this->helper->hoskia_inline_css( $inlineCss );
		}
		$html = ob_get_clean();
		
		return $html;
		
	
	}
	
}

$horizontaltbl = new WPBakeryShortCode_horizontaltblel();
?>