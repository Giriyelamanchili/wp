<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit( 'Direct script access denied.' );
}

/**
 * @Packge     : Hoskia
 * @Version    : 1.0
 * @Author     : ThemeLooks
 * @Author URI : https://www.themelooks.com/
 *
 */
 
    
function hoskia_widgets_init() {
    // sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'hoskia' ),
        'id'            => 'hoskia-post-sidebar',
        'before_widget' => '<div class="page--sidebar-widget" data-scroll-reveal="bottom">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4">',
        'after_title'   => '</h4>',
    ) );
    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'hoskia' ),
        'id'            => 'hoskia-page-sidebar',
        'before_widget' => '<div class="page--sidebar-widget" data-scroll-reveal="bottom">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4">',
        'after_title'   => '</h4>',
    ) );
    // Woo page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Woo Page Sidebar', 'hoskia' ),
        'id'            => 'hoskia-woo-sidebar',
        'before_widget' => '<div class="page--sidebar-widget" data-scroll-reveal="bottom">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4">',
        'after_title'   => '</h4>',
    ) );
    
    // footer widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Footer One', 'hoskia' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer--widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4 footer--title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Two', 'hoskia' ),
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer--widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4 footer--title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Three', 'hoskia' ),
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer--widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4 footer--title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Four', 'hoskia' ),
        'id'            => 'footer-4',
        'before_widget' => '<div class="footer--widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h4 footer--title">',
        'after_title'   => '</h4>',
    ) );
    
    
}
add_action( 'widgets_init', 'hoskia_widgets_init' );
