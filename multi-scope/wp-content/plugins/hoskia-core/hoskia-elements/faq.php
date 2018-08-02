<?php 
/**
 * Hoskia testimonial section elements
 */
class WPBakeryShortCode_faq extends WPBakeryShortCode {
	
	public $helper;
	
	function __construct(){
		
		// Quickfix helper class
		$this->helper = new hoskia_helper() ;
		
		// Hoskia feature section maping
		add_action( 'vc_build_admin_page' , array( $this, 'hoskia_faq_maping' ) );
		
		// Hoskia feature shortcode
		add_shortcode( 'ssdhostfaq', array( $this, 'hoskia_faq_shortcode' ) );
		
	}
	
	// vc Param
	public function hoskia_faq_maping(){
		
		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		
		vc_map( array(
		  "name" => __( "Faq", "hoskia" ),
		  "base" => "ssdhostfaq",
		  "icon"  => HOSKIA_PLUGDIRURI .'hoskia-elements/img/logoicon.png',
		  "category" => __( "Hoskia", "hoskia"),
		  "params" => array(	
		  
		  	array(
			"type"		 => "param_group",
			'param_name' => 'faq_group',
			"group"		 => esc_html__( "Faq", "hoskia" ),
			'heading' 	 => esc_html__( 'Set Content', 'hoskia' ),
			'params' 	 => array(
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Tab Title", "hoskia" ),
					"param_name" => "tab_title",
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
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"heading" 	 => esc_html__( "Title", "hoskia" ),
					"param_name" => "title",
				),
			
				array(
				"type"		 => "param_group",
				'param_name' => 'faq_content',
				"group"		 => esc_html__( "Faq Content", "hoskia" ),
				'heading' 	 => esc_html__( 'Set Content', 'hoskia' ),
				'params' 	 => array(
				
					array(
						"type" 		 => "textfield",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Title", "hoskia" ),
						"param_name" => "title",
					),	
					array(
						"type" 		 => "textarea",
						"holder" 	 => "div",
						"heading" 	 => esc_html__( "Description", "hoskia" ),
						"param_name" => "description",
					),	
				
				
					)
				),
			
			)
				
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
	public function hoskia_faq_shortcode( $atts, $content = null ){
		
		extract( shortcode_atts(
			array(
				'faq_group' => '',
				'css' 	  	=> '',
			),
		$atts
		) );
		
		// Unique ID
		$uid = uniqid();
		
		// Design Settings Options class
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'ssdhostfaq', $atts );
		
		$faq_group = vc_param_group_parse_atts( $faq_group );
		
		ob_start();
		?>	
        <div id="pageContent" class="faq-page pd--100-0">
            <div class="container">
                <div class="row">
                    <!-- Page Main Content Start -->
                    <article class="page--main-content col-md-9">
						<?php 
						if( is_array( $faq_group ) && count( $faq_group ) > 0 ):
						foreach( $faq_group as $faq ):
							
							if( !empty( $faq['tab_title'] ) ){
								$pgt_id = $faq['tab_title'];
							}else{
								$pgt_id = '';
							}
						
							$panelId = sanitize_title( $pgt_id.$uid );
						
						?>
                        <!-- Panel Group Start -->
                        <div class="panel-group" id="<?php echo esc_attr( $panelId ); ?>">
							<?php 
							// Page Content Title Start
							if( !empty( $faq['title'] ) ){
								echo '<div class="page--main-content-title">';
									echo '<h3 class="h3">'.esc_html( $faq['title'] ).'</h3>';
								echo '</div>';		
							}
							
							//Panel Item Start
							if( !empty( $faq['faq_content'] ) ):
							
							$faq_content = vc_param_group_parse_atts( $faq['faq_content'] );
							$i = 0;
							foreach( $faq_content as $content ):
							$fuid = uniqid().rand();
							$in =  '';
							$collapsed =  'collapsed';
							if( $i == 0 ){
								$in = 'in';
								$collapsed =  '';
							}
							?>
                            
                            <div class="panel">
								<?php 
								if( !empty( $content['title'] ) ):
								?>
                                <div class="panel-heading">
                                    <h4 class="panel-title h4">
                                        <a href="#faqItem<?php echo esc_attr( $fuid ); ?>" class="<?php echo esc_attr( $collapsed ); ?>" data-toggle="collapse" data-parent="#<?php echo esc_attr( $panelId ); ?>"><?php echo esc_html( $content['title'] ); ?></a>
                                    </h4>
                                </div>
								<?php 
								endif;
								?>
                                
                                <div id="faqItem<?php echo esc_attr( $fuid ); ?>" class="panel-collapse collapse <?php echo esc_attr( $in ); ?>">
									<?php 
									if( !empty( $content['description'] ) ):
									?>
                                    <div class="panel-body">
                                        <p><?php echo wp_kses_post( $content['description'] ); ?></p>
                                    </div>
									<?php 
									endif;
									?>
                                </div>
                            </div>
							<?php 
							$i++;
							endforeach;
							endif;
							?>
                        </div>
                        <!-- Panel Group End -->
						<?php 
						endforeach;
						endif;
						?>
						
                    </article>
					<?php 
					// Page Main Content Start
					if( is_array( $faq_group ) && count( $faq_group ) > 0 ):
					
					?>
                    <aside class="page--sidebar col-md-3 hidden-sm hidden-xs">
                        <!-- Page Sidebar Nav Start -->
                        <nav class="page--sidebar-nav bg-color--alabaster AnimateScrollList">
                            <ul class="nav">
								<?php 
								foreach( $faq_group as $tab ):
								if( !empty( $tab['tab_title'] ) ):
								
								$icon = '';
								if( !empty( $tab['icon_fontawesome'] ) ){
									$icon = '<i class="'.esc_attr( $tab['icon_fontawesome'] ).'"></i>';
								}
								
								
								$panelID = sanitize_title( $tab['tab_title'].$uid );
								?>
                                <li>
                                    <a href="#<?php echo esc_attr( $panelID ); ?>">
									<?php 
									echo wp_kses_post( $icon );
									echo esc_html( $tab['tab_title'] ); 
									?></a>
                                </li>
								<?php 
								endif;
								endforeach;
								?>
                            
							</ul>
                        </nav>
                        <!-- Page Sidebar Nav End -->
                    </aside>
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

$sectheading = new WPBakeryShortCode_faq();


?>