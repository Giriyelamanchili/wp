<?php 
/**
 * @Packge 	   : Hoskia
 * @Version    : 1.0
 * @Author 	   : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	// Final Class
	final class Hoskia_Host{

		// Theme Version
		private $hoskia_version = '1.0';

		// Minimum WordPress Version required
		private $min_wp = '4.0';

		// Minimum PHP version required 
		private $min_php = '5.6.25';
		
		
		// Theme init
		public function init(){
			
			$this->setup();
		}

		// Theme setup
		private function setup(){
		
			// Create enqueue class instance
			$enqueu = new SSDHost_Enqueue();
			$enqueu->scripts = $this->enqueue() ;
			$enqueu->hoskia_scripts_enqueue_init() ;
		}

		// Theme Support
		public function support(){
			// content width
	        $GLOBALS['content_width'] = apply_filters( 'hoskia_content_width', 751 );

	        
	        // text domain for translation.
	        load_theme_textdomain( 'hoskia', HOSKIA_DIR_PATH . '/languages' );
	        
	        // support title tage
	        add_theme_support( 'title-tag' );
	        
	        // support logo
	        add_theme_support( 'custom-logo' );
	        
	        //  support post format
	        add_theme_support( 'post-formats', array( 'video','audio' ) );
	        
	        // support post-thumbnails
	        add_theme_support( 'post-thumbnails', array( 'post' ) );

			add_image_size( 'hoskia_post_widget_thum_size', 110, 110, true );
			
	        // support custom background 
	        add_theme_support( 'custom-background' );
	        
	        // support custom header
	        add_theme_support( 'custom-header' );
	        
	        // support automatic feed links
	        add_theme_support( 'automatic-feed-links' );
	        
	        // support html5
	        add_theme_support( 'html5' );
			
			// woocommerce support
			add_theme_support('woocommerce');
			
			// woo product gallery zoom, lightbox, slider support
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
	                
	        // register nav menu
	        register_nav_menus( array(
	            'primary-menu'   => esc_html__( 'Primary Menu', 'hoskia' ),
				'footer-menu'   => esc_html__( 'Footer Menu', 'hoskia' ),
	        ) );  
			
	        // editor style
	        add_editor_style('css/editor-style.css');

		} // end support method

		// enqueue theme style and script
		private function enqueue(){

			$cssPath = HOSKIA_DIR_CSS_URI;
			$jsPath  = HOSKIA_DIR_JS_URI;
			$apiKey	 = hoskia_opt('hoskia_map_apikey');
						
			$scripts = array(
				'style' => array(
					array(
						'handler'		=> 'google-font',
						'file' 			=> $this->google_font(),
					),
					array(
						'handler'		=> 'font-awesome',
						'file' 			=> $cssPath.'font-awesome.min.css',
						'dependency' 	=> array(),
						'version' 		=> '4.7.0',
					),
					array(
						'handler'		=> 'bootstrap',
						'file' 			=> $cssPath.'bootstrap.min.css',
						'dependency' 	=> array(),
						'version' 		=> '3.3.7',
					),
					array(
						'handler'		=> 'jquery-ui',
						'file' 			=> $cssPath.'jquery-ui.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.2.0',
					),
					array(
						'handler'		=> 'owl-carousel',
						'file' 			=> $cssPath.'owl.carousel.min.css',
						'dependency' 	=> array(),
						'version' 		=> '2.2.0',
					),
					array(
						'handler'		=> 'animate-css',
						'file' 			=> $cssPath.'animate.min.css',
						'dependency' 	=> array(),
						'version' 		=> '3.5.1',
					),
					array(
						'handler'		=> 'hoskia-woo',
						'file' 			=> $cssPath.'hoskia-woo.css',
						'dependency' 	=> array(),
						'version' 		=> $this->hoskia_version,
					),
					array(
						'handler'		=> 'hoskia',
						'file' 			=> $cssPath.'hoskia.css',
						'dependency' 	=> array(),
						'version' 		=> $this->hoskia_version,
					),
					array(
						'handler'		=> 'hoskia-responsive',
						'file' 			=> $cssPath.'responsive-style.css',
						'dependency' 	=> array(),
						'version' 		=> $this->hoskia_version,
					),
					array(
						'handler'		=> 'hoskia-style',
						'file' 			=> get_stylesheet_uri(),
					),
				),
				'scripts' => array(
					array(
						'handler'		=> 'html5shiv',
						'file' 			=> $jsPath.'html5shiv.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.7.3',
						'in_footer' 	=> false,
						'condition' 	=> 'lt IE 9'
					),
					array(
						'handler'		=> 'respond',
						'file' 			=> $jsPath.'respond.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.4.2',
						'in_footer' 	=> '',
						'condition' 	=> 'lt IE 9'
					),
					array(
						'handler'		=> 'maps-googleapis',
						'register'		=> true,
						'file' 			=> '//maps.googleapis.com/maps/api/js?key='.$apiKey,
					),
					array(
							'handler'		=> 'bootstrap',
							'file' 			=> $jsPath.'bootstrap.min.js',
							'dependency' 	=> array( 'jquery' ),
							'version' 		=> '3.3.7',
							'in_footer' 	=> true,
							'template_not' 	=> 'template-whmcs.php'
					),
					array(
						'handler'		=> 'jquery-sticky',
						'file' 			=> $jsPath.'jquery.sticky.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0.4',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'tubular',
						'file' 			=> $jsPath.'jquery.tubular.1.0.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'owl-carousel',
						'file' 			=> $jsPath.'owl.carousel.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '2.2.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'isotope',
						'file' 			=> $jsPath.'isotope.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.0.2',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'hoverIntent',
						'file' 			=> $jsPath.'jquery.hoverIntent.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'waypoints',
						'file' 			=> $jsPath.'jquery.waypoints.min.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '4.0.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'counterup',
						'file' 			=> $jsPath.'jquery.counterup.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'countdown',
						'file' 			=> $jsPath.'jquery.countdown.min.js',
						'dependency' 	=> array( 'jquery' ),
						'register'		=> true,
						'version' 		=> '2.2.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'animatescroll',
						'file' 			=> $jsPath.'animatescroll.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '1.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'parallax',
						'file' 			=> $jsPath.'parallax.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.1',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'scrollreveal',
						'file' 			=> $jsPath.'scrollreveal.min.js',
						'dependency' 	=> array( 'jquery' ),
						'version' 		=> '3.4.0',
						'in_footer' 	=> true
					),
					array(
						'handler'		=> 'hoskia-main',
						'file' 			=> $jsPath.'main.js',
						'dependency' 	=> array( 'jquery', 'jquery-ui-slider' ),
						'version' 		=> $this->hoskia_version,
						'in_footer' 	=> true
					),
				)
			);

			return $scripts;

		} // end enqueu method 

		// Google Font  
		private function google_font(){
			
			$fontUrl = '';
			
			if ( 'off' !== _x( 'on', 'Google font: on or off', 'hoskia' ) ) {
			
				$font_families = array(
					'Montserrat:400,400i,700',
					'Poppins:400,500,700'
				);

				$familyArgs = array(
					'family' => htmlentities( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin, latin-text' ),
				);

				$fontUrl = add_query_arg( $familyArgs, '//fonts.googleapis.com/css' );
			
			}
			
			return esc_url_raw( $fontUrl );

		} //End google_font method

	} // End Hoskia_Host Class

	
	
	
?>