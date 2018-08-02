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
 


if ( post_password_required() ) 
{
    return;
}
?>

    <?php if ( have_comments() ) : ?>
		<div id="comments" class="post--comments"> <!-- Comment Item Start-->
        <div class="post--comments-title"><h3 class="h4"><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'hoskia' ), number_format_i18n( get_comments_number() ) ); ?></h3></div>
		
        <?php the_comments_navigation(); ?>
            <ul class="post--comments-list nav">
                <?php
                    wp_list_comments( array(
                        'style'       => 'ul',
                        'short_ping'  => true,
                        'avatar_size' => 70,
                        'callback'    => 'hoskia_comment_callback'
                    ) );
                ?>
            </ul><!-- .comment-list -->
        <?php the_comments_navigation(); ?>
		</div><!-- Comment Item End-->
    <?php endif; // Check for have_comments(). ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hoskia' ); ?></p>
    <?php endif; ?>
    
<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? "required='required'" : '' );
	$fields =  array(
	  'author' =>'<div class="form-group col-md-4"><input class="form-control" type="text" name="author" value="'. esc_attr( $commenter['comment_author'] ).'" id="commenterName" '.$aria_req.' placeholder="'.esc_html__( 'Name *', 'hoskia' ).'"></div>',
	  'email' =>'<div class="form-group col-md-4"><input class="form-control" type="text" name="email"  value="' . esc_attr(  $commenter['comment_author_email'] ) .'" id="commenterEmail" '.$aria_req.' placeholder="'.esc_html__( 'Email *', 'hoskia' ).'"></div>',
	  'url' =>'<div class="form-group col-md-4"><input class="form-control" type="text" name="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" id="commenterWebsite" placeholder="'.esc_attr__( 'Website', 'hoskia' ).'"></div>',
	);
	
    $subTitle = '<p>'.wp_kses_post( __( 'What&rsquo;s happening in your mind about this post !', 'hoskia' ) ).'</p>';

	$args=array(
	'comment_field'         =>'<div class="form-group"><textarea class="form-control" rows= "6" name="comment" placeholder="'.esc_html__( 'Your Comment *', 'hoskia' ).'"></textarea></div>',
	'id_form'               =>'',
    'class_form'            =>'',
	'title_reply'           =>'Leave A Comment',
	'title_reply_before'    =>'<div class="post--comments-title"><h3 class="h4">',
	'title_reply_after'     =>'</h3></div>'.$subTitle,
    'label_submit'          => esc_html__( 'Leave Comment', 'hoskia' ),
    'class_submit'          => 'btn btn-primary',
	'submit_button'         => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
	'fields'                =>$fields,
	
	);
    echo '<div class="post--comments-form">';
	   comment_form( $args );
    echo '</div>';
?>
<!-- .comments-area -->
