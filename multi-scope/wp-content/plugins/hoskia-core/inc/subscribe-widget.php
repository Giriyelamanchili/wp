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
*Creating Recent Post the widget
***************************************/
 
class hoskia_subscribe_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'hoskia_subscribe_widget', 


// Widget name will appear in UI
esc_html__( 'Subscribe', 'quickfix' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer subscribe form', 'quickfix' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 			= apply_filters( 'widget_title', $instance['title'] );
$shortDesc 		= apply_filters( 'widget_shortdesc', $instance['shortdesc'] );
$weaccepttext 	= apply_filters( 'widget_weaccepttext', $instance['weaccepttext'] );
$image 	= apply_filters( 'widget_image', $instance['image'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
	
?>

	<!-- Footer Subscribe Widget Start -->
	<div class="subscribe--widget--wrap">
		<?php 
		if( $shortDesc ){
			echo '<p>'.esc_html( $shortDesc ).'</p>';
		}
		?>
		<div class="subscribe--widget">
			<form action="#" method="post" id="footer_subscribe" >
				<div class="input-group">
					<input type="email" name="footer_email" id="footer_email" class="form-control" placeholder="<?php esc_attr_e( 'E-mail Address', 'quickfix' ); ?>" required>
					
					<span class="input-group-addon">
						<button type="submit" class="btn btn-primary">Subscribe</button>
					</span>
				</div>
				<div id="alert-footermessage"></div>
			</form>
		</div>
	</div>
	<?php 
	if( $weaccepttext || $image ){
		echo '<div class="payment-info--widget">';
			if( $weaccepttext ){
				echo '<h5 class="h5">'.esc_html( $weaccepttext ).'</h5>';
			}
			//
			if( $image ){
				echo '<img src="'.esc_url( $image ).'" alt="'.hoskia_image_alt( esc_url( $image ) ).'"  />';
			}
			
		echo '</div>';
	}

	
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'Subscribe', 'quickfix' );
}	
if ( isset( $instance[ 'shortdesc' ] ) ) {
	$shortDesc = $instance[ 'shortdesc' ];
}else {
	$shortDesc = '';
}	
if ( isset( $instance[ 'weaccepttext' ] ) ) {
	$weaccepttext = $instance[ 'weaccepttext' ];
}else {
	$weaccepttext = '';
}	
if ( isset( $instance[ 'image' ] ) ) {
	$image = $instance[ 'image' ];
}else {
	$image = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'shortdesc' ); ?>"><?php _e( 'Short Descriptions:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'shortdesc' ); ?>" name="<?php echo $this->get_field_name( 'shortdesc' ); ?>" type="text" value="<?php echo esc_attr( $shortDesc ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'weaccepttext' ); ?>"><?php _e( 'We Accept Text:' ,'quickfix'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'weaccepttext' ); ?>" name="<?php echo $this->get_field_name( 'weaccepttext' ); ?>" type="text" value="<?php echo esc_attr( $weaccepttext ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image', 'hoskia' ); ?>:</label>
	<div class="hoskia-media-container">
		<div class="hoskia-media-inner">
			<?php $img_style = ( $image != '' ) ? '' : 'style="display:none;"'; ?>
			<img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $image ); ?>" <?php echo $img_style; ?> />
			<?php $no_img_style = ( $image != '' ) ? 'style="display:none;"' : ''; ?>
			<span class="hoskia-no-image" id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'hoskia' ); ?></span>
		</div>
	
	<input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $image ); ?>" class="hoskia-media-url" />

	<input type="button" value="<?php echo _e( 'Remove', 'hoskia' ); ?>" class="button hoskia-media-remove" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $img_style; ?> />

	<?php $button_text = ( $image != '' ) ? __( 'Change Image', 'hoskia' ) : __( 'Select Image', 'hoskia' ); ?>
	<input type="button" value="<?php echo $button_text; ?>" class="button hoskia-media-upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" />
	<br class="clear">
	</div>
</p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['shortdesc'] = ( ! empty( $new_instance['shortdesc'] ) ) ? strip_tags( $new_instance['shortdesc'] ) : '';
$instance['weaccepttext'] = ( ! empty( $new_instance['weaccepttext'] ) ) ? strip_tags( $new_instance['weaccepttext'] ) : '';
$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';

return $instance;
}
} // Class quickfix_subscribe_widget ends here


// Register and load the widget
function hoskia_subscribe_load_widget() {
	register_widget( 'hoskia_subscribe_widget' );
}
add_action( 'widgets_init', 'hoskia_subscribe_load_widget' );