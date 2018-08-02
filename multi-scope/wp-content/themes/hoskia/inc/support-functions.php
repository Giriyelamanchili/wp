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

// Blog Post content 
function hoskia_blog_content(){
?>
	<div class="post--info">
	<?php 
	// Title
	if( get_the_title() ){
		echo '<h2 class="h5"><a href="'.esc_url( get_the_permalink() ).'">'.esc_html( get_the_title() ).'</a></h2>';
	}
	?>

		<p><?php esc_html_e( 'By', 'hoskia' ) ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>"><?php the_author(); ?></a><span class="divider"><?php esc_html_e( '/', 'hoskia' ) ?></span><a href="<?php echo esc_url( hoskia_blog_date_permalink() ); ?>"><?php echo esc_html( get_the_date() ); ?></a><span class="divider"><?php esc_html_e( '/', 'hoskia' ) ?></span><?php echo hoskia_posted_comments(); ?></p>
	</div>

	<div class="post--content">
		<?php 
		// Post Excerpt
		echo hoskia_excerpt_length( hoskia_opt('hoskia_blog_postExcerpt') );
		// link page
		hoskia_link_pages();
		?>
	</div>

	<div class="post--footer">
		<a href="<?php the_permalink(); ?>" class="btn btn-default"><?php esc_html_e( 'Read More', 'hoskia' ); ?></a>
	</div>
<?php
}

// Post Category
function hoskia_post_cats(){
	
	$cats = hoskia_get_category_cash();
	$categories = '';
    if( is_array( $cats ) && count( $cats ) > 0 ){

        $categories .= '<div class="posts--cat m--30-0-0">';
        $categories .= '<ul class="nav"><li><span><i class="fa fm fa-th-list"></i>'.esc_html( 'Catagory :', 'hoskia' ).'</span></li>';
        
        foreach( $cats as $cat ){
           $categories .= '<li><a href="'.esc_url( get_category_link( $cat->term_id ) ).'" class="category-link">'.esc_html( $cat->name ).'</a></li>';
        }
        
        $categories .= '</ul>';
        $categories .= '</div>';
    }
	
	return $categories;
	
}

// Post Tags
function hoskia_post_tags(){
	
	$tags = get_the_tags();
	
	$getTags = '';
	
	if( $tags ){

		$getTags .= '<div class="posts--tags m--30-0-0">';
		$getTags .= '<ul class="nav">';

		$getTags .= '<li><span><i class="fa fm fa-tags"></i>'.esc_html__( 'Tag :', 'hoskia' ).'</span></li>';
			foreach( $tags as $tag ){
				$getTags .= '<li><a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.esc_html( $tag->name ).'</a></li>';
			}
	
		$getTags .= '</ul>';
		$getTags .= '</div>';
	}
	
	return $getTags;
	
}

// quickfix comment template callback
function hoskia_comment_callback( $comment, $args, $depth ) {
    
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment--item">
    <?php endif; ?>
	
	<div class="post--commenter-img">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	</div>
	
	
    <div class="post--commenter-content">
		<h4 class="post--commenter-name h4"><?php printf( __( '<span class="comment-author-name">%s</span> ', 'hoskia' ), get_comment_author_link() ); ?><small><?php printf( __('%1$s at %2$s', 'hoskia'), get_comment_date(),  get_comment_time() ); ?></small> <?php edit_comment_link( esc_html__( '(Edit)', 'hoskia' ), '  ', '' ); ?></h4>
        <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'hoskia' ); ?></em>
          <br />
        <?php endif; ?>

		<div class="post--commenter-reply-btn"><?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => '<i class="fa fa-reply"></i> '.esc_html__( 'Reply', 'hoskia' ) ) ) ); ?></div>
    </div>

    <div class="post--content">
		<?php comment_text(); ?>
	</div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php  
}
// add class comment reply link
add_filter('comment_reply_link', 'hoskia_replace_reply_link_class');
function hoskia_replace_reply_link_class( $class ){
    $class = str_replace("class='comment-reply-link", "class='reply", $class);
    return $class;
}

// Back To Top 
function hoskia_backtotop(){
?>
	<div class="back-to-top-btn">
		<a href="#" class="btn btn-default active"><i class="fa fa-angle-up"></i></a>
	</div>
<?php
}

// Section Title
function hoskia_section_title( $args = array() ){
	
	$default = array(
		'wrapper_class' => '',
		'title' 		=> '',
		'sub_title'		=> ''
	);
	
	
	$args = wp_parse_args( $args , $default );
	
	if( $args['title'] || $args['sub_title']  ){
		echo '<div class="section--title mb--80 '.esc_attr( $args['wrapper_class'] ).'">';
			if( $args['title'] ){
				echo '<h2 class="h2">'.esc_html( $args['title'] ).'</h2>';
			}
			//
			if( $args['sub_title'] ){
				echo '<p>'.esc_html( $args['sub_title'] ).'</p>';
			}
		echo '</div>';
	}
}

// social media
if ( ! function_exists( 'hoskia_social' ) ) {
	function hoskia_social( $args = array() ){

		$default = array(
			'wrapper_before' 	=> '',
			'wrapper_after' 	=> '',
			'after_ul_start' 	=> '',
			'ul_class'  		=> '',
			'li_class'  		=> '',
			'a_class'     		=> ''
		);

		$class = wp_parse_args( $args, $default );

		if( $class['ul_class'] ){
		   $ul_class = 'class="'.esc_attr( $class['ul_class'] ).'"';
		}else{
		   $ul_class = ''; 
		}

		if( $class['li_class'] ){
			$li_class = 'class="'.esc_attr( $class['li_class'] ).'"';
		}else{
		   $li_class = ''; 
		}
		// 
		if( $class['a_class'] ){
		  $aclass = 'class="'.esc_attr( $class['a_class'] ).'"';
		}else{
		   $aclass = ''; 
		}
		// After ul start
		if( $class['after_ul_start'] ){
		  $after_ul_start = $class['after_ul_start'];
		}else{
		   $after_ul_start = ''; 
		}

		// Social Media Icon

		$icons = array(
			
			array(
				'url'  => hoskia_opt('hoskia_facebook_link'),
				'icon' => 'fa-facebook',
			),
			array(
				'url'  => hoskia_opt('hoskia_twitter_link'),
				'icon' => 'fa-twitter',
			),
			array(
				'url'  => hoskia_opt('hoskia_google_link'),
				'icon' => 'fa-google-plus',
			),
			array(
				'url'  => hoskia_opt('hoskia_youtube_link'),
				'icon' => 'fa-youtube',
			),
			array(
				'url'  => hoskia_opt('hoskia_instagram_link'),
				'icon' => 'fa-instagram',
			),
			array(
				'url'  => hoskia_opt('hoskia_vimeo_link'),
				'icon' => 'fa-vimeo',
			),
			array(
				'url'  => hoskia_opt('hoskia_linkedin_link'),
				'icon' => 'fa-linkedin',
			),
			array(
				'url'  => hoskia_opt('hoskia_behance_link'),
				'icon' => 'fa-behance',
			),
			array(
				'url'  => hoskia_opt('hoskia_pinterest_link'),
				'icon' => 'fa-pinterest-p',
			),
			array(
				'url'  => hoskia_opt('hoskia_dribbble_link'),
				'icon' => 'fa-dribbble',
			),
			array(
				'url'  => hoskia_opt('hoskia_github_link'),
				'icon' => 'fa-github',
			)

		);

		// Array Filtering 
		$findUrlKey = array_column( $icons, 'url' );
		$filterEmpty = array_filter( $findUrlKey );
		//
		$html  = '';
		if( count( $filterEmpty ) > 0 ){
			
			// Wrapper Before Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_before'] );
			}
			
			$html .= '<ul '.wp_kses_post( $ul_class ).'>';
					$html .= wp_kses_post( $after_ul_start );

					foreach( $icons as $icon ){

					
						if( !empty( $icon['url'] ) && !empty( $icon['icon'] ) ){

							$html .= '<li '.wp_kses_post( $li_class ).'><a href="'.esc_url( $icon['url'] ).'" '.wp_kses_post( $aclass ).' target="_blank"><i class="fa '.esc_attr( $icon['icon'] ).'"></i></a></li>';

						}
						
					}
					
				

				

			$html .= '</ul>';
			// Wrapper After Block
			if( $class['wrapper_before'] && $class['wrapper_after'] ){
				$html .= wp_kses_post( $class['wrapper_after'] );
			}
		
		}
		return $html;

	}
}

// Client Rating
function hoskia_client_rating( $rating ){
	
	$star 	   = '<i class="fa fa-star"></i>';
	$halfstar  = '<i class="fa fa-star-half-o"></i>';
	$emptystar = '<i class="fa fa-star-o"></i>';

	$html = '';
	
	$html .= '<div class="stars">';

		switch( $rating ){
			
			case '5' :
				$html .= $star.$star.$star.$star.$star;
				break;
			case '4.5' :
				$html .= $star.$star.$star.$star.$halfstar;
				break;
			case '4' :
				$html .= $star.$star.$star.$star.$emptystar;
				break;
			case '3.5' :
				$html .= $star.$star.$star.$halfstar.$emptystar;
				break;
			case '3' :
				$html .= $star.$star.$star.$emptystar.$emptystar;
				break;
			case '2.5' :
				$html .= $star.$star.$halfstar.$emptystar.$emptystar;
				break;
			case '2' :
				$html .= $star.$star.$emptystar.$emptystar.$emptystar;
				break;
			case '1.5' :
				$html .= $star.$halfstar.$emptystar.$emptystar.$emptystar;
				break;
			case '1' :
				$html .= $star.$emptystar.$emptystar.$emptystar.$emptystar;
				break;
			
			
		}
		
	$html .= '</div>';
	
	
	echo wp_kses_post( $html );
	
}


?>