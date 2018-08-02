<?php 
 /**
  * @version    1.0
  * @package    SSDHostloud Theme Core Plugin
  * @author     Themelooks <support@themelooks.com>
  *
  * Websites: http://www.themelooks.com
  *
  */

// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit ( 'Direct access denied.' );
}


// Slider Post Type
$args = array(
	'publicly_queryable' => false,
	'menu_icon' 		 => 'dashicons-editor-insertmore',
    'supports'			 => array( 'title' )
);

$args = array(
    'post_type' 	=> 'hoskia_slider',
    'plural_name' 	=> 'Sliders',
    'singular_name' => 'Slider',
    'args'      	=> $args,
);

$type = new Voip_Posttype( $args );


// Gallery Post Type
$gallery = array(
	'publicly_queryable' => true,
	'menu_icon' => 'dashicons-screenoptions',
    'supports' => array( 'title','thumbnail','editor' )
);

$gallery = array(
    'post_type' => 'gallery',
	'plural_name' 	=> 'Gallery',
    'singular_name' => 'Gallery',
    'args'      => $gallery,
);

$type = new Voip_Posttype( $gallery );

$args = array(
    'taxname'   	=> 'tab',
	'plural_name' 	=> 'Tabs',
	'singular_name' => 'Tab',
);
$type->voip_register_taxonomy( $args );

$tagsArgs = array(
    'taxname'   	=> 'gallery_tag',
	'plural_name' 	=> 'Tags',
	'singular_name' => 'Tag',
	'taxargs' 		=> array(
		'hierarchical' => false,
	)
);
$type->voip_register_taxonomy( $tagsArgs );

// Services Post Type
$Services = array(
	'rewrite'            => array( 'slug' => 'services' ),
	'publicly_queryable' => true,
	'menu_icon' 		 => 'dashicons-screenoptions',
    'supports' 			 => array( 'title','editor','excerpt', 'thumbnail' )
);

$Services = array(
    'post_type' 	=> 'hoskia_services',
	'plural_name' 	=> 'Services',
    'singular_name' => 'Service',
    'args'      	=> $Services,
);

$type = new Voip_Posttype( $Services );
// Service category
$tagsArgs = array(
    'taxname'   	=> 'services_cat',
	'plural_name' 	=> 'Categories',
	'singular_name' => 'Category',

);
$type->voip_register_taxonomy( $tagsArgs );

// ssdhost subscribe ajax callback function
add_action( 'wp_ajax_hoskia_footer_subscribe_ajax', 'hoskia_footer_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_hoskia_footer_subscribe_ajax', 'hoskia_footer_subscribe_ajax' );

function hoskia_footer_subscribe_ajax( ){
    
    $apiKey = esc_html( hoskia_opt('hoskia_subscribe_apikey') );
    $listid = esc_html( hoskia_opt('hoskia_subscribe_listid') ); 
   
    $api = new MCAPI( $apiKey );
 
    $merge_vars = array(
        'FNAME'=> '',
        'LNAME'=>''
    );


        $retval = $api->listSubscribe( $listid, esc_html( $_POST['footer_email'] ), $merge_vars, 'html', false, true );

        if ($api->errorCode){
            echo '<div class="alert alert-danger" role="alert">'.esc_html__( 'Sorry something wrong. Please try again.', 'hoskia' ).'</div>';

        } else {
            echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'hoskia' ).'</div>';
        }
		
        die();    

    
}

// SSDHostloud subscribe ajax callback function
add_action( 'wp_ajax_comingsoon_subscribe_ajax', 'hoskia_comingsoon_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_comingsoon_subscribe_ajax', 'hoskia_comingsoon_subscribe_ajax' );

function hoskia_comingsoon_subscribe_ajax( ){
    
    $apiKey = esc_html( hoskia_opt( 'hoskia_subscribe_apikey' ) );
    $listid = esc_html( hoskia_opt( 'hoskia_subscribe_listid' ) ); 
   
    $api = new MCAPI( $apiKey );
 
    $merge_vars = array(
        'FNAME'=> '',
        'LNAME'=>''
    );


        $retval = $api->listSubscribe( $listid, esc_html( $_POST['coming_email'] ), $merge_vars, 'html', false, true );

        if ($api->errorCode){
            echo '<div class="alert alert-danger" role="alert">'.esc_html__( 'Sorry something wrong. Please try again.', 'hoskia' ).'</div>';

        } else {
            echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'hoskia').'</div>';
        }
		
        die();    

    
}

// Svg Support
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  //global $wp_version;
  //if ( $wp_version !== '4.7.1' ) {
  //   return $data;
  //}

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

// svg support
function hoskia_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'hoskia_mime_types' );

// Single Template
add_filter( 'single_template', 'hoskia_template_redirect' );
function hoskia_template_redirect( $single_template ){
	
	global $post;
		
	if( $post->post_type == 'gallery' ){
		$single_template = HOSKIA_PLUGIN_TEMP . 'single-gallery.php';
	}
	if( $post->post_type == 'hoskia_services' ){
		$single_template = HOSKIA_PLUGIN_TEMP . 'single-hoskia_services.php';
	}
	
	return $single_template;
}

// Archive Template
add_filter( 'archive_template', 'hoskia_archive_template' );
function hoskia_archive_template( $archive_template ){
	
	global $post;
		
	if( $post ){
		if( $post->post_type == 'gallery' ){
			$archive_template = HOSKIA_PLUGIN_TEMP . 'archive-gallery.php';
		}
		if( $post->post_type == 'hoskia_services' ){
			$archive_template = HOSKIA_PLUGIN_TEMP . 'archive-hoskia_services.php';
		}
	}
	return $archive_template;
}


?>