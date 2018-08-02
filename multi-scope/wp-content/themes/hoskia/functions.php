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

	/**
	 *
	 * Define constant
	 *
	 */
	
	// Base URI
	if( !defined( 'HOSKIA_DIR_URI' ) )
		define( 'HOSKIA_DIR_URI', get_template_directory_uri().'/' );
	
	// Css File URI
	if( !defined( 'HOSKIA_DIR_CSS_URI' ) )
		define( 'HOSKIA_DIR_CSS_URI', HOSKIA_DIR_URI .'css/' );
	
	// Js File URI
	if( !defined( 'HOSKIA_DIR_JS_URI' ) )
		define( 'HOSKIA_DIR_JS_URI', HOSKIA_DIR_URI .'js/' );
	
	// Base Directory
	if( !defined( 'HOSKIA_DIR_PATH' ) )
		define( 'HOSKIA_DIR_PATH', get_parent_theme_file_path().'/' );
	
	//Inc Folder Directory
	if( !defined( 'HOSKIA_DIR_PATH_INC' ) )
		define( 'HOSKIA_DIR_PATH_INC', HOSKIA_DIR_PATH.'inc/' );
	
	//hoskia-framework Folder Directory
	if( !defined( 'HOSKIA_DIR_PATH_FRAM' ) )
		define( 'HOSKIA_DIR_PATH_FRAM', HOSKIA_DIR_PATH_INC.'hoskia-framework/' );
	
	//Classes Folder Directory
	if( !defined( 'HOSKIA_DIR_PATH_CLASSES' ) )
		define( 'HOSKIA_DIR_PATH_CLASSES', HOSKIA_DIR_PATH_INC.'classes/' );
	
	//Hooks Folder Directory
	if( !defined( 'HOSKIA_DIR_PATH_HOOKS' ) )
		define( 'HOSKIA_DIR_PATH_HOOKS', HOSKIA_DIR_PATH_INC.'hooks/' );
	
	//Demo Folder Directory
	if( !defined( 'HOSKIA_PATHDEMO' ) )
		define( 'HOSKIA_PATHDEMO', HOSKIA_DIR_PATH_FRAM.'demo-data/' );
	
	//Demo CSS Folder Directory URI
	if( !defined( 'HOSKIA_PATHDEMOURI' ) )
		define( 'HOSKIA_PATHDEMOURI', HOSKIA_DIR_URI.'inc/hoskia-framework/demo-data/' );
		
	// Include Files
	require_once( HOSKIA_DIR_PATH_INC . 'hoskia-breadcrumbs.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'hoskia-widgets-reg.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'wp_bootstrap_navwalker.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'hoskia-functions.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'hoskia-commoncss.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'support-functions.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'wp-html-helper.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'wp_bootstrap_pagination.php' );
	require_once( HOSKIA_DIR_PATH_INC . 'hoskia-woo-functions.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'hoskia-meta/hoskia-config.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'plugins-activation/hoskia-active-plugins.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'redux-custom-field/fa-icons.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'redux-custom-field/hoskia-option-slide-add-field.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'hoskia-options/hoskia-option.php' );
	require_once( HOSKIA_DIR_PATH_FRAM . 'demo-data/demo-import.php' );
	require_once( HOSKIA_DIR_PATH_CLASSES . 'Class-Enqueue.php' );
	require_once( HOSKIA_DIR_PATH_HOOKS . 'hooks.php' );
	require_once( HOSKIA_DIR_PATH_HOOKS . 'hooks-functions.php' );
	require_once( HOSKIA_DIR_PATH_CLASSES . 'Class-Config.php' );
	
	
	
	// Hoskia global variable define
	global $hoskia;
	$hoskia['hoskiaobj'] = new Hoskia_Host();
	
	// Hoskia theme support
	add_action( 'after_setup_theme', 'hoskia_themesupport' );
	function hoskia_themesupport(){
		global $hoskia;
		$hoskiaHost = $hoskia['hoskiaobj'];
		$hoskiaHost->support();
	}
	
	// Hoskia theme init
	add_action( 'init', 'hoskia_init' );
	function hoskia_init(){
		global $hoskia;
		$hoskiaHost = $hoskia['hoskiaobj'];
		$hoskiaHost->init();
	}
			
?>