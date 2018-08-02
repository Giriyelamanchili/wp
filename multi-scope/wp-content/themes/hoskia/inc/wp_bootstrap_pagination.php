<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 *
 * @Packge      Hoskia
 * @Author      ThemeLooks
 * @Author URL  https//www.themelooks.com
 * @version     1.0
 *
 */

function hoskia_pagination( $args = array() ) {
    
    $defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => esc_html__( '&laquo;', 'hoskia' ),
        'next_string'     => esc_html__( '&raquo;', 'hoskia' ),
        'before_output'   => '<div class="post-nav"><ul class="pagination">',
        'after_output'    => '</ul></div>'
    );
    
    $args = wp_parse_args( 
        $args, 
        apply_filters( 'hoskia_pagination_defaults', $defaults )
    );
    
    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = isset( $GLOBALS['wp_query'] ) ? $GLOBALS['wp_query'] : '';
	
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );
    
    if ( $count <= 1 )
        return FALSE;
    
    if ( !$page )
        $page = 1;
    
    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }
    
    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    
    $firstpage = esc_attr( get_pagenum_link(1) );
    if ( $firstpage && (1 != $page) )
        $echo .= '<li class="previous"><a href="' . esc_attr( $firstpage ) . '"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a></li>';

    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . esc_attr( $previous ) . '" title="' . esc_html__( 'previous', 'hoskia' ) . '">' . esc_html( $args['previous_string'] ) . '</a></li>';
    
    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ( $page == $i ) {
                $echo .= '<li class="active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
    
    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . esc_attr( $next ) . '" title="' . esc_html__( 'next', 'hoskia') . '">' . esc_html( $args['next_string'] ) . '</a></li>';
    
    $lastpage = esc_attr( get_pagenum_link($count) );
    if ( $lastpage ) {
        $echo .= '<li class="next"><a href="' . esc_attr( $lastpage ) . '"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>';
    }

    if ( isset($echo) )
        echo wp_kses_post( $args['before_output'] . $echo . $args['after_output'] ) ;
}
