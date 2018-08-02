<?php
/**
 * @version  1.0
 * @package  Hoskia
 * @author   Themelooks <support@themelooks.com>
 *
 * Websites: http://www.themelooks.com
 *
 */
 
 
/**************************************
*Creating social the widget
***************************************/
 
class hoskia_social_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'hoskia_social_widget', 


// Widget name will appear in UI
esc_html__( 'Find Us On', 'quickfix' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer find us on widget', 'quickfix' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 	= apply_filters( 'widget_title', $instance['title'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
    
	//

	echo '<div class="social--widget">';
		echo '<p class="social--widget__sub-title">'.esc_html__( 'FOLLOW US:' , 'hoskia' ).'</p>';

		echo hoskia_social(
			array(
				'ul_class' => 'nav widget-social--nav',
			)
		);
	echo '</div>';
	
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Find Us On', 'quickfix' );
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p><?php echo sprintf( __( 'To set social link follow us on widget go to social from quickfix Options or <a href="%s" target="_blank">Click Here</a>.', 'quickfix' ), admin_url('?page=quickfix&tab=9') ); ?></p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

return $instance;
}
} // Class hoskia_social_widget ends here


// Register and load the widget
function hoskia_social_load_widget() {
	register_widget( 'hoskia_social_widget' );
}
add_action( 'widgets_init', 'hoskia_social_load_widget' );