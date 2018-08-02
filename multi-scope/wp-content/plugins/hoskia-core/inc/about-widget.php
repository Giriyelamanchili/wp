<?php
/**
 * @version  1.0
 * @package  SSDHostloud
 * @author   Themelooks <support@themelooks.com>
 *
 * Websites: http://www.themelooks.com
 *
 */
 
 
/**************************************
*Creating About Widget
***************************************/
 
class hoskia_about_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'hoskia_about_widget', 


// Widget name will appear in UI
esc_html__( 'About Widget', 'hoskia' ), 

// Widget description
array( 'description' => esc_html__( 'Add footer About Content', 'hoskia' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
	
$title 		= apply_filters( 'widget_title', $instance['title'] );
$image 		= apply_filters( 'widget_image', $instance['image'] );
$textarea 	= apply_filters( 'widget_textarea', $instance['textarea'] );
$buttontext = apply_filters( 'widget_buttontext', $instance['buttontext'] );
$buttonurl 	= apply_filters( 'widget_buttonurl', $instance['buttonurl'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

    
?>

	<div class="footer-about">
		<?php 
		//
		if( $image ){
			echo '<div class="footer--title h4">';
				echo '<img src="'.esc_url( $image ).'" alt="'.hoskia_image_alt( $image ).'">';
			echo '</div>';
			
		}
		//
		echo '<div class="about--widget">';
			if( $textarea ){
				echo '<p>'.wp_kses_post( $textarea).'</p>';
			}
			// Button
			if( $buttonurl ){
				echo '<a href="'.esc_url( $buttonurl ).'" class="btn-link">'.esc_html( $buttontext ).'<i class="fa flm fa-long-arrow-right"></i></a>';
			}
		echo '</div>';

		?>
	</div>
	
	
<?php
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	
if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
}else {
	$title = esc_html__( 'About', 'hoskia' );
}
//	logo
if ( isset( $instance[ 'image' ] ) ) {
	$image = $instance[ 'image' ];
}else {
	$image = '';
}

//	Text Area
if ( isset( $instance[ 'textarea' ] ) ) {
	$textarea = $instance[ 'textarea' ];
}else {
	$textarea = '';
}
//	Button Text
if ( isset( $instance[ 'buttontext' ] ) ) {
	$buttontext = $instance[ 'buttontext' ];
}else {
	$buttontext = 'Learn More';
}
//	Button URL
if ( isset( $instance[ 'buttonurl' ] ) ) {
	$buttonurl = $instance[ 'buttonurl' ];
}else {
	$buttonurl = '';
}

// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'hoskia'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
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


<p>
<label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Text Area:' ,'hoskia'); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>"><?php echo esc_attr( $textarea ); ?></textarea>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e( 'Button Text:' ,'hoskia'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" type="text" value="<?php echo esc_attr( $buttontext ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'buttonurl' ); ?>"><?php _e( 'Button Url:' ,'hoskia'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'buttonurl' ); ?>" name="<?php echo $this->get_field_name( 'buttonurl' ); ?>" type="text" value="<?php echo esc_attr( $buttonurl ); ?>" />
</p>


<!-- Widgets - Media Upload Css -->
<style>
.hoskia-media-container {
	width: 98%;
}

.hoskia-media-inner {
	border: 1px solid #ddd;
	padding: 10px;
	text-align: center;
	border-radius: 2px;
	margin-bottom: 10px;
}

.widget-description img,
.hoskia-media-inner img {
	max-width: 100%;
	height: auto;
}

.hoskia-media-url {
	display: none;
}

.hoskia-media-remove {
	float: left;
	width: 48%;
}

.hoskia-media-upload {
	float: right;
	width: 48%;
}
</style>

<script>
jQuery(function($){
    'use strict';
	/**
	 *
	 * About Widget Logo upload
	 *
	 */
	$( function(){
	    // Upload / Change Image
    function wpshed_image_upload( button_class ) {
        
        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $( 'body' ).on( 'click', button_class, function(e) {

            var button_id           = '#' + $( this ).attr( 'id' ),
                self                = $( button_id),
                send_attachment_bkp = wp.media.editor.send.attachment,
                button              = $( button_id ),
                id                  = button.attr( 'id' ).replace( '-button', '' );

            _custom_media = true;

            wp.media.editor.send.attachment = function( props, attachment ){

                if ( _custom_media ) {

                    $( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
                    $( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
                    $( '#' + id + '-noimg' ).css( 'display', 'none' );
                    $( '#' + id ).val( attachment.url ).trigger( 'change' );  

                } else {

                    return _orig_send_attachment.apply( button_id, [props, attachment] );

                }
            }

            wp.media.editor.open( button );

            return false;
        });
    }
    wpshed_image_upload( '.hoskia-media-upload' );

    // Remove Image
    function wpshed_image_remove( button_class ) {

        $( 'body' ).on( 'click', button_class, function(e) {

            var button              = $( this ),
                id                  = button.attr( 'id' ).replace( '-remove', '' );

            $( '#' + id + '-preview' ).css( 'display', 'none' );
            $( '#' + id + '-noimg' ).css( 'display', 'block' );
            button.css( 'display', 'none' );
            $( '#' + id ).val( '' ).trigger( 'change' );

        });
    }
    wpshed_image_remove( '.hoskia-media-remove' );
	
	});
});
</script>
<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	
	$allowhtml = array(
		'span' 	 => array(),
		'class'  => array(),
		'strong' => array(),
		'i' => array(
			'class' => array()
		),
	);
	
$instance = array();
$instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['image']  	  = ( ! empty( $new_instance['image'] ) ) ? wp_kses( $new_instance['image'], $allowhtml ) : '';
$instance['textarea'] = ( ! empty( $new_instance['textarea'] ) ) ? strip_tags( $new_instance['textarea'] ) : '';
$instance['buttontext'] = ( ! empty( $new_instance['buttontext'] ) ) ? strip_tags( $new_instance['buttontext'] ) : '';
$instance['buttonurl']  = ( ! empty( $new_instance['buttonurl'] ) ) ? strip_tags( $new_instance['buttonurl'] ) : '';


return $instance;
}
} // Class quickfix_subscribe_widget ends here


// Register and load the widget
function hoskia_about_load_widget() {
	register_widget( 'hoskia_about_widget' );
}
add_action( 'widgets_init', 'hoskia_about_load_widget' );