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

if ( ! function_exists( 'hoskia_breadcrumbs' ) ) {
    function hoskia_breadcrumbs( $args = array() ) {
        if ( is_front_page() ) {
            return;
        }
        if ( get_theme_mod( 'ct_ignite_show_breadcrumbs_setting' ) == 'no' ) {
            return;
        }
        global $post;
        $defaults  = array(
            'breadcrumbs_id'      => '',
            'breadcrumbs_classes' => esc_html( 'breadcrumb' ),
            'home_title'          => esc_html__( 'Home', 'hoskia' )
        );
        $args      = apply_filters( 'hoskia_breadcrumbs_args', wp_parse_args( $args, $defaults ) );
                
        $args_el = array();
        
        if( $args['breadcrumbs_id'] ){
            
            $args_el[] =  'id="'.esc_attr( $args['breadcrumbs_id'] ).'"';
        }
        
        if( $args['breadcrumbs_classes'] ){
            
            $args_el[] =  'class="'.esc_attr( $args['breadcrumbs_classes'] ).'"';
            
        }
        
        /*
        * Begin Markup 
        */
        
        // Open the breadcrumbs
        $html  = '<div class="page-header--breadcrumb">';
        $html .= '<ul '.implode( ' ',  $args_el ).'>';
        // Add Homepage link (always present)
        $html .= '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( get_home_url('/') ) . '" title="' . esc_attr( $args['home_title'] ) . '">' . esc_attr( $args['home_title'] ) . '</a></li>';
        // Post
        if ( is_singular( 'post' ) ) {
            $category = get_the_category();
            $category_values = array_values( $category );
            $last_category = end( $category_values );
            $cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
            $cat_parents = explode( ',', $cat_parents );
            foreach ( $cat_parents as $parent ) {
                $html .= '<li class="item-cat ">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</li>';
                
            }
            $html .= '<li class="active bread-' . esc_attr( $post->ID ) . '" title="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</li>';
        } elseif ( is_singular( 'page' ) ) {
            if ( $post->post_parent ) {
                $parents = get_post_ancestors( $post->ID );
                $parents = array_reverse( $parents );
                foreach ( $parents as $parent ) {
                    $html .= '<li class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . esc_url( get_permalink( $parent ) ) . '" title="' . esc_attr( get_the_title( $parent ) ) . '">' . esc_html( get_the_title( $parent ) ) . '</a></li>';
                }
            }
            $html .= '<li class="active" title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</li>';
        } elseif ( is_singular( 'attachment' ) ) {
            $parent_id        = $post->post_parent;
            $parent_title     = get_the_title( $parent_id );
            $parent_permalink = esc_url( get_permalink( $parent_id ) );
            $html .= '<li class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . esc_attr( $parent_title ) . '</a></li>';
            $html .= '<li title="' . esc_attr( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</li>';
        } elseif ( is_singular() ) {
            $post_type         = get_post_type();
            $post_type_object  = get_post_type_object( $post_type );
            $post_type_archive = get_post_type_archive_link( $post_type );
            $html .= '<li class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></li>';
            $html .= '<li class="active bread-' . $post->ID . '" title="' . $post->post_title . '">' . $post->post_title . '</li>';
        } elseif ( is_category() ) {
            $parent = get_queried_object()->category_parent;
            if ( $parent !== 0 ) {
                $parent_category = get_category( $parent );
                $category_link   = get_category_link( $parent );
                $html .= '<li class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_attr( $parent_category->name ) . '</a></li>';
            }
            $html .= '<li class="active bread-cat" title="' . $post->ID . '">' . single_cat_title( '', false ) . '</li>';
        } elseif ( is_tag() ) {
            $html .= '<li class="active bread-tag">' . single_tag_title( '', false ) . '</li>';
        } elseif ( is_author() ) {
            $html .= '<li class="active bread-author">' . get_queried_object()->display_name . '</li>';
        } elseif ( is_day() ) {
            $html .= '<li class="active bread-day">' . get_the_date() . '</li>';
        } elseif ( is_month() ) {
            $html .= '<li class="active bread-month">' . get_the_date( 'F Y' ) . '</li>';
        } elseif ( is_year() ) {
            $html .= '<li class="active bread-year">' . get_the_date( 'Y' ) . '</li>';
        } elseif ( is_archive() ) {			
            $custom_tax_name = get_queried_object()->name;
            $html .= '<li class="active bread-archive">' . esc_attr( $custom_tax_name ) . '</li>';
        } elseif ( is_search() ) {
            $html .= '<li class="active bread-search">'.esc_html__('Search results for: ','hoskia') . get_search_query() . '</li>';
        } elseif ( is_404() ) {
            $html .= '<li>' . esc_html__( 'Error 404', 'hoskia' ) . '</li>';
        } elseif ( is_home() ) {
            $html .= '<li class="active">' . get_the_title( get_option( 'page_for_posts' ) ) . '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        $html = apply_filters( 'hoskia_breadcrumbs_filter', $html );
		
		if( is_hoskia_woocommerce_activated() && is_shop() ){
			woocommerce_breadcrumb(
				array(
					'delimiter'   => '',
					'home' => esc_html__( 'Home', 'hoskia' )
				)
			);
		}else{
			echo wp_kses_post( $html );	
		}
        
    }
}
