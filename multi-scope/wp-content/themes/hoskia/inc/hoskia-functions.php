<?php 
/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

 // theme option callback
function hoskia_opt( $id = null, $url = null ){
    global $hoskia_opt;
    
    if( $id && $url ){
        
        if( isset( $hoskia_opt[$id][$url] ) && $hoskia_opt[$id][$url] ){
            return $hoskia_opt[$id][$url];
        }
        
    }else{
        
        if( isset( $hoskia_opt[$id] )  && $hoskia_opt[$id] ){
            return $hoskia_opt[$id];
        } 
    }
	
}

// custom meta id callback
function hoskia_meta( $id = '' ){
    
    $value = get_post_meta( get_the_ID(), '_hoskia_'.$id, true );
    
    return $value;
}
// Blog Date Permalink
function hoskia_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}
// Blog Excerpt Length
if ( ! function_exists( 'hoskia_excerpt_length' ) ) {
	function hoskia_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
		
		
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = '<p>'.preg_replace('`\[[^\]]*\]`','',$excerpt).'</p>';
		return $excerpt;

	}
}
// Comment number and Link
if ( ! function_exists( 'hoskia_posted_comments' ) ) :
    function hoskia_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','hoskia');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','hoskia');
            } else {
                $comments = esc_html__( '1 Comment','hoskia' );
            }
            $comments = '<a href="' . esc_url( get_comments_link() ) . '">'. $comments .'</a>';
        } else {
            $comments = esc_html__( 'Comments are closed', 'hoskia' );
        }
        
        return $comments;
    }
endif;
//audio format iframe match 
function hoskia_iframe_match(){   
    $audio_content = hoskia_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}

//Post embedded media
function hoskia_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
   
}
// WP post link pages
function hoskia_link_pages(){
    
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'hoskia' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'hoskia' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}
// Category cash
function hoskia_get_category_cash(){
	return get_the_category();
}
// theme logo
function hoskia_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array( 
            'href' => array()
        ),
        'span' => array(),
        'i'    => array( 
            'class' => array() 
        )
    );
    $siteUrl = home_url('/');
    // site logo
    if( !hoskia_opt('hoskia_site_title') && hoskia_opt('hoskia_site_logo', 'url' )  ){

        $stickyLogo = '';
        if( hoskia_opt( 'hoskia_sticky_site_logo', 'url' ) ){
           
        $siteLogo = '
        <img src="'.esc_url( hoskia_opt('hoskia_sticky_site_logo', 'url' ) ).'" class="sticky-logo" alt="'.esc_attr__( 'logo', 'hoskia' ).'" />
        <img src="'.esc_url( hoskia_opt('hoskia_site_logo', 'url' ) ).'" class="non-sticky-logo" alt="'.esc_attr__( 'logo', 'hoskia' ).'" />
        ';

        }else{
            $siteLogo = '<img src="'.esc_url( hoskia_opt('hoskia_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'hoskia' ).'" />';
        }


        return '<a href="'.esc_url( $siteUrl ).'" class="header--logo navbar-brand">'.wp_kses_post( $siteLogo ).'</a>';
        
         
    }elseif( hoskia_opt('hoskia_site_title') ){
        return '<a class="text-logo header--logo navbar-brand" href="'.esc_url( $siteUrl ).'">'.wp_kses( hoskia_opt('hoskia_site_title'), $allowhtml ).'</a>';   
    }else{
        return '<a class="text-logo header--logo navbar-brand" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a>';
    }
}

// Blog grid  callback
function hoskia_blog_grid( ){
    
    $grid = hoskia_opt( 'hoskia_blog_grid' );

    if( $grid ){
        return $grid;
    }else{
        return;
    }
    
}
// Blog pull right class callback
function hoskia_pull_right( $id = '', $condation ){
    
    if( $id == $condation ){
        return ' '.'pull-right';
    }else{
        return;
    }
    
}
// wp kses allow html
function hoskia_wp_kses_allow( $data = '' ){
    
    $allow = array(
        'a' => array(
            'href' => array()
        ),
        'span' => array(),
        'br'   => array(),
        'strong'   => array(),
    
    
    );
    
    return wp_kses( $data, $allow );
    
}
// Data Background image attr
function hoskia_data_bg_attr( $imgUrl = '' ){
        
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
    
}
// image alt tag
function hoskia_image_alt( $url = '' ){

    if( $url != '' ){
        // attachment id by url 
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag 
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
    
            $alt = str_replace( '-', ' ', $filename['filename'] );
            
            return $alt;
        }
   
    }else{
       return; 
    }

}

// Flat Content wysiwyg output with meta key and post id
function hoskia_get_textareahtml_output( $content ) {
    
	global $wp_embed;

	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}

// 
// Woocommerce Check
if ( ! function_exists( 'is_hoskia_woocommerce_activated' ) ) {
	function is_hoskia_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

// VC Animation 
if( class_exists( 'WPBakeryShortCode' ) ){
	class Clsvwpbshortcode extends WPBakeryShortCode{
		
		 function __construct() {}
		
	}

}
function hoskia_animation_class( $animation ){
	
	if( class_exists('Clsvwpbshortcode') ){
		$obj = new Clsvwpbshortcode();
		return $animation_classes = $obj->getCSSAnimation( $animation );
	}else{
		return;
	}
	

}

// Slider list ( Shortcode ) select Options
function hoskia_get_slider_shortcode_options( $field ) {
    $args = $field->args( 'get_post_type' );
	
	
    $args = is_array( $args ) ? $args : array();

    $args = wp_parse_args( $args, array( 'post_type' => 'post' ) );

    $postType = $args['post_type'];

	//

	$args = array(
		'post_type'        => $postType,
		'post_status'      => 'publish',
	);

	$posts_array = get_posts( $args );	

	// Initate an empty array
	$term_options = array();
		
		foreach( $posts_array as $post ){
			
			$term_options[ $post->post_name ] = $post->post_title;
			
		}
	
    return $term_options;

}

?>