<?php
/**
 * @version  1.0
 * @package  Hoskia
 * @author   Themelooks <support@themelooks.com>
 *
 * Websites: http://www.themelooks.com
 *
 */
 
 
/******************************************
*Creating recent post widget width thumb
*******************************************/
 
class hoskia_recent_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'hoskia_recent_widget', 


// Widget name will appear in UI
esc_html__( 'Thumbnail Recent Post', 'quickfix' ), 

// Widget description
array( 'description' => esc_html__( 'Add recent post with thumbnail', 'quickfix' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 	= apply_filters( 'widget_title', $instance['title'] );
$post_number = apply_filters( 'widget_post_number', $instance['post_number'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
    
	//
	$arrya = array(
		'post_type' 	 => 'post',
		'posts_per_page' => esc_html( $post_number ),
	);
	
	$loop = new WP_Query( $arrya );
	
	if( $loop->have_posts() ){
		echo '<div class="recent-posts--widget">';
			echo '<ul class="nav">';
		while( $loop->have_posts() ){
			$loop->the_post();
	?>

			<li>
				<?php 
				if( has_post_thumbnail() ){
					echo '<a href="'.esc_url( get_the_permalink() ).'" class="img">';
						the_post_thumbnail( 'hoskia_post_widget_thum_size' );
					echo '</a>';
				}
				?>
				<div class="content">
					<p><?php esc_html_e( 'by', 'hoskia' ); ?> <a href="<?php the_author_link(); ?> "><?php the_author(); ?></a>  <?php echo esc_html__( ' / ', 'hoskia' ).get_the_date(); ?></p>
					<h3 class="h6"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
			</li>
				
	<?php 
		}
		wp_reset_postdata();
		echo '</ul>';
	echo '</div>';
	}
	
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Recent Post', 'quickfix' );
}
//	
if ( isset( $instance[ 'post_number' ] ) ) {
	$post_number = $instance[ 'post_number' ];
}else {
	$post_number = esc_html__( 3 );
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'post_number' ); ?>"><?php _e( 'Posts Number:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'post_number' ); ?>" name="<?php echo $this->get_field_name( 'post_number' ); ?>" type="number" value="<?php echo esc_attr( $post_number ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['post_number'] = ( ! empty( $new_instance['post_number'] ) ) ? strip_tags( $new_instance['post_number'] ) : '';

return $instance;
}
} // Class hoskia_social_widget ends here


// Register and load the widget
function hoskia_recent_post_load_widget() {
	register_widget( 'hoskia_recent_widget' );
}
add_action( 'widgets_init', 'hoskia_recent_post_load_widget' );