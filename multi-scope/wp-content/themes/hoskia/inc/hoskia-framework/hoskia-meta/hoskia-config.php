<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/cmb2/init.php';
} elseif ( file_exists( get_template_directory() . '/CMB2/init.php' ) ) {
	require_once get_template_directory() . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function hoskia_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function hoskia_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function hoskia_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function hoskia_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo esc_html( $field->escaped_value() ); ?></p>
		<p class="description"><?php echo esc_attr( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function hoskia_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'hoskia_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function hoskia_register_metabox() {
	$prefix = '_hoskia_';
	$prefixpage = '_hoskiapage_';
    
    /********************************\
        page layout select meta 
    \********************************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'hoskia' ),
        'context' => 'side',
        'priority' => 'high',
		'object_types'  => array( 'page' ), // Post type
	) );

	$hoskia_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'hoskia' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => 'Container',
            '2' => 'Container Fluid',
            '3' => 'Fullwidth',
            ),
	) );
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Top and Bottom Padding', 'hoskia' ),
		'id'   => $prefix . 'custom_page_padding',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '500',
		'step'        => '1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Set page content wrapper top and bottom padding.', 'hoskia' ),
	));
    /********************************\
        Page Header and slider meta 
    \********************************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'sliderPageheader_section',
		'title'         => esc_html__( 'Page Header Settings', 'hoskia' ),
		'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$hoskia_meta->add_field( array(
            'name'             => esc_html__( 'Slider/Page Header Active', 'hoskia' ),
            'desc'             => 'Select an option',
            'id'               => $prefix . 'slide_header_active',
            'type'             => 'select',
            'show_option_none' => false,
            'default'          => 'page_header',
            'options'          => array(
                'noheader'     => esc_html__( 'No Header', 'hoskia' ),
                'slider'       => esc_html__( 'Slider', 'hoskia' ),
                'page_header'  => esc_html__( 'Page Header', 'hoskia' ),
                'customslider' => esc_html__( 'Custom Slider', 'hoskia' ),
            ),
        ) 
    
    );
	$hoskia_meta->add_field(  array(
        'name'           => esc_html__( 'Custom Slider', 'hoskia' ),
        'desc'           => esc_html__( 'Set custom slider shortcode.', 'hoskia' ),
        'classes'        => 'slider-customShortcode',
        'id'             => $prefix . 'slider-customshortcode',
        'type'           => 'text',
    ) );
	// Slider Select 
	$hoskia_meta->add_field(  array(
        'name'           => esc_html__( 'Slider', 'hoskia' ),
        'desc'           => esc_html__( 'Set slider.', 'hoskia' ),
        'classes'        => 'slider-settings',
        'id'             => $prefix . 'slider-shortcode',
        'type'           => 'select',
        // Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
        'options_cb'     => 'hoskia_get_slider_shortcode_options',
        // Same arguments you would pass to `get_terms`.
        'get_post_type' => array(
            	'post_type'   => 'hoskia_slider',
            ),
    ) );
	$hoskia_meta->add_field( array(
            'name'             => esc_html__( 'Page Header Settings', 'hoskia' ),
            'desc'             => 'Select page header settings type. Global settings set from theme options.',
            'id'               => $prefix . 'page_header_settings',
            'type'             => 'select',
            'classes'          => 'pageset page-header-settings',
            'show_option_none' => false,
            'default'          => 'global',
            'options'          => array(
                'pageset'       => esc_html__( 'Page Settings', 'hoskia' ),
                'global'        =>  esc_html__( 'Global Settings', 'hoskia' ),
            ),
        ) 
    
    );

	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Header Background Color', 'hoskia' ),
		'id'   => $prefix . 'header-bgcolor',
		'type' => 'colorpicker',
		'classes' => 'pageset page-setting',
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Background Image', 'hoskia' ),
		'desc' => esc_html__( 'Set background image.', 'hoskia' ),
		'id'   => $prefix . 'header_bgimg',
        'classes' => 'pageset page-setting',
		'type' => 'file',
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay.', 'hoskia' ),
		'id'   => $prefix . 'header_overlay',
        'classes' => 'pageset page-setting',
		'type' => 'checkbox',
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay Color', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay color.', 'hoskia' ),
		'id'   => $prefix . 'header_overlaycolor',
        'classes' => 'pageset page-setting',
		'type' => 'colorpicker',
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay Opacity', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay opacity.', 'hoskia' ),
		'id'   => $prefix . 'header_overlayopacity',
        'classes' => 'pageset page-setting',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '1',
		'step'        => '0.1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Default opacity 0.5', 'hoskia' ),
	));
	
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Header Text Color', 'hoskia' ),
		'id'   => $prefix . 'header-textcolor',
		'classes' => 'pageset page-setting',
		'type' => 'colorpicker',
	));
	
    /***************************************************************\
                            Post type meta
    \***************************************************************/
    
    
    /******************\
      Slider section 
    \******************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefix . 'slider_section',
		'title'         => esc_html__( 'Slider Settings', 'hoskia' ),
		'object_types'  => array( 'hoskia_slider' ), // Post type
        'closed'        => true
	) );
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Banner / Slider', 'hoskia' ),
		'id'   => $prefix . 'slider-type',
		'desc' => esc_html__( 'Select type slider or banner.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'select',
		'options' => array(
			'slider' => 'Slider',
			'banner' => 'Banner',
		)
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'General Background Image', 'hoskia' ),
		'id'   => $prefix . 'slider-genbg',
		'classes' => 'slider-opt',
		'type' => 'file',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'General Video Background', 'hoskia' ),
		'desc' => esc_html__( 'Set youtube video id.', 'hoskia' ),
		'id'   => $prefix . 'slider-videobg',
		'classes' => 'slider-opt',
		'type' => 'text',
	));	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay.', 'hoskia' ),
		'id'   => $prefix . 'slider-genbgov',
        'classes' => 'slider-media',
		'type' => 'checkbox',
	));
	
	$hoskia_meta->add_field( array(
		'name'    => esc_html__( 'Overlay', 'hoskia' ),
		'id'      => $prefix . 'slider-genbgov',
		'type'    => 'radio_inline',
		'desc' => esc_html__( 'Set overlay.', 'hoskia' ),
		'options' => array(
			'none' 		=> esc_html__( 'None', 'hoskia' ),
			'wrapperbg' => esc_html__( 'Slider Wrapper Overlay', 'hoskia' ),
			'singleov'  => esc_html__( 'Single Slider Overlay', 'hoskia' ),
		),
	));
	
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay Color', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay color.', 'hoskia' ),
		'id'   => $prefix . 'slider_genoverlaycolor',
        'classes' => 'slider-media',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Overlay Opacity', 'hoskia' ),
		'desc' => esc_html__( 'Set overlay opacity.', 'hoskia' ),
		'id'   => $prefix . 'slider_genoverlayopacity',
        'classes' => 'slider-media',
		'type' => 'own_slider',
		'min'         => '0',
		'max'         => '1',
		'step'        => '0.1',
		'default'     => '0', // start value
		'value_label' => 'Value:',
        'desc' => esc_html__( 'Default opacity 0.5', 'hoskia' ),
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Background Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidBgColor',
		'desc' => esc_html__( 'Set slider background color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));

	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Text Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidTextColor',
		'desc' => esc_html__( 'Set slider text color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	// Button media options
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Text Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidBtnTextColor',
		'desc' => esc_html__( 'Set slider button text color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Background Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidBtnBgColor',
		'desc' => esc_html__( 'Set slider button background color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Border Color', 'hoskia' ),
		'id'   => $prefix . 'slider-sliderbtnBorderColor',
		'desc' => esc_html__( 'Set slider button border color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	// Button hover media options
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Text Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidBtnhovTextColor',
		'desc' => esc_html__( 'Set slider button hover text color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Background Color', 'hoskia' ),
		'id'   => $prefix . 'slider-slidBtnhovBgColor',
		'desc' => esc_html__( 'Set slider button hover background color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Button Hover Border Color', 'hoskia' ),
		'id'   => $prefix . 'slider-sliderbtnhovBorderColor',
		'desc' => esc_html__( 'Set slider button hover border color.', 'hoskia' ),
		'classes'     => 'slider-opt',
		'type' => 'colorpicker',
	));
	$hoskia_meta->add_field( array(
        'name'             => esc_html__( 'Button Link Behaviour', 'hoskia' ),
        'id'               => $prefix . 'slider-linkbehaviour',
        'type'             => 'select',
        'classes'          => 'slider-opt',
        'default'          => 'samepage',
        'options'          => array(
            'samepage'     => esc_html__( 'Same Page', 'hoskia' ),
            'newtab'       => esc_html__( 'New Tab', 'hoskia' ),
        ),
    ));

	//
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Slider Speed', 'hoskia' ),
		'id'   => $prefix . 'slider-slidspeed',
		'desc' => esc_html__( 'Set slider speed. Default speed 2000.', 'hoskia' ),
		'classes'     => 'slider-opt slider-typeopt',
		'type' => 'text_small',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Active Mouse Drag', 'hoskia' ),
		'id'   => $prefix . 'slider-mousedrag',
		'desc' => esc_html__( 'To active mouse drag check this checkbox.', 'hoskia' ),
		'classes'     => 'slider-opt slider-typeopt',
		'type' => 'checkbox',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Active Autoplay', 'hoskia' ),
		'id'   => $prefix . 'slider-autoplay',
		'desc' => esc_html__( 'To active autoplay check this checkbox.', 'hoskia' ),
		'classes'     => 'slider-opt slider-typeopt',
		'type' => 'checkbox',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Active Slider Nav', 'hoskia' ),
		'id'   => $prefix . 'slider-navactive',
		'desc' => esc_html__( 'To active slider nav check this checkbox.', 'hoskia' ),
		'classes'     => 'slider-opt slider-typeopt',
		'type' => 'checkbox',
	));
	// Slider Group
	$group_field_id = $hoskia_meta->add_field( array(
		'id'          => $prefix . 'slider-group-options',
        'classes'     => 'slider-opt',
		'type'        => 'group',
		'description' => esc_html__( 'Add Slider', 'hoskia' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Slider {#}', 'hoskia' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Slider', 'hoskia' ),
			'remove_button' => esc_html__( 'Remove Slider', 'hoskia' ),
			'sortable'      => false, // beta
			'closed'     => true, // true to have the groups closed by default
            
		),
	) );
   
    // Slider Content group
	$hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Single Slider Background Image', 'hoskia' ),
		'id'   => $prefix . 'slider-bgimg',
		'classes' => 'slider-content',
		'type' => 'file',
	) );
	
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title', 'hoskia' ),
		'id'   => $prefix . 'slider-title',
		'classes' => 'slider-content',
		'type' => 'text',
	) );
	
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Descriptions', 'hoskia' ),
		'id'   => $prefix . 'slider-descriptions',
		'classes' => 'slider-content',
		'type' => 'textarea',
	) );
	
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Text', 'hoskia' ),
		'id'   => $prefix . 'sliderbutton-text',
		'classes' => 'slider-content',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Url', 'hoskia' ),
		'id'   => $prefix . 'sliderbutton-url',
		'classes' => 'slider-content',
		'type' => 'text',
	) );
	//
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Secondary Text', 'hoskia' ),
		'id'   => $prefix . 'sliderbutton-secondary-text',
		'classes' => 'slider-content',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Button Secondary Url', 'hoskia' ),
		'id'   => $prefix . 'sliderbutton-secondary-url',
		'classes' => 'slider-content',
		'type' => 'text',
	) );
	$hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Slider Image', 'hoskia' ),
		'id'   => $prefix . 'slider-img',
		'classes' => 'slider-content',
		'type' => 'file',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Image Position', 'hoskia' ),
		'id'   => $prefix . 'slider-imgpos',
		'classes' => 'slider-content',
		'type' => 'select',
		'options' => array(
			'right' => 'Right',
			'left'  => 'Left',
		),
	) );
	// Banner offer box
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Offer Box Text One', 'hoskia' ),
		'id'   => $prefix . 'slider-tone',
		'classes' => 'slider-ofb',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Offer Box Text Two', 'hoskia' ),
		'id'   => $prefix . 'slider-ttwo',
		'classes' => 'slider-ofb',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Offer Box Text Three', 'hoskia' ),
		'id'   => $prefix . 'slider-tthree',
		'classes' => 'slider-ofb',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Offer Box Button Text', 'hoskia' ),
		'id'   => $prefix . 'slider-ofbtntext',
		'classes' => 'slider-ofb',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Offer Box Button Url', 'hoskia' ),
		'id'   => $prefix . 'slider-ofbtnurl',
		'classes' => 'slider-ofb',
		'type' => 'text',
	) );	
	
	//
	
    // Slider Nav Content group
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nav Title', 'hoskia' ),
		'id'   => $prefix . 'slider-navtitle',
		'classes' => 'slider-content slider-typeopt',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nav Image Icon', 'hoskia' ),
		'id'   => $prefix . 'slider-imgnavicon',
		'classes' => 'slider-content slider-typeopt',
		'description' => esc_html__( 'Please empty the font awesome icon field when you use image icon.', 'hoskia' ),
		'type' => 'file',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nav Font Awesome Icon', 'hoskia' ),
		'id'   => $prefix . 'slider-navicon',
		'classes' => 'slider-content slider-typeopt',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Nav Descriptions', 'hoskia' ),
		'id'   => $prefix . 'slider-navdescriptions',
		'classes' => 'slider-content slider-typeopt',
		'type' => 'textarea',
	) );

    
   	/****************************\
      Service Pricing section 
    \****************************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefix . 'service_price_meta',
		'title'         => esc_html__( 'Service Pricing Info', 'hoskia' ),
		'object_types'  => array( 'service_price' ), // Post type
        'closed'        => true
	) );
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Small Title', 'hoskia' ),
		'id'   => $prefix . 'service-smalltitle',
		'type' => 'text',
	));
	// Slider Group
	$group_field_id = $hoskia_meta->add_field( array(
		'id'          => $prefix . 'service-price-group',
		'type'        => 'group',
		'description' => esc_html__( 'Add Pricing', 'hoskia' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Price {#}', 'hoskia' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Price', 'hoskia' ),
			'remove_button' => esc_html__( 'Remove Price', 'hoskia' ),
			'sortable'      => false, // beta
			'closed'     => true, // true to have the groups closed by default
            
		),
	) );
   
    // Slider Content group
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Title', 'hoskia' ),
		'id'   => $prefix . 'service-title',
		'type' => 'text',
	) );
    $hoskia_meta->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Price', 'hoskia' ),
		'id'   => $prefix . 'service-price',
		'type' => 'text',
	) );
	
	/****************************\
      Gallery Post type
    \****************************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_meta',
		'title'         => esc_html__( 'Gallery Info', 'hoskia' ),
		'object_types'  => array( 'gallery' ), // Post type
        'closed'        => true
	) );
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Sub Title', 'hoskia' ),
		'id'   => $prefix . 'gallery-sub-title',
		'type' => 'text',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Client Name', 'hoskia' ),
		'id'   => $prefix . 'clientname',
		'type' => 'text',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Project Done', 'hoskia' ),
		'id'   => $prefix . 'project-done',
		'type' => 'text_date',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Live Preview Button Label', 'hoskia' ),
		'id'   => $prefix . 'live-preview-label',
		'type' => 'text',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Live Preview', 'hoskia' ),
		'id'   => $prefix . 'gallery-preview-url',
		'type' => 'text_url',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Show Share Icons', 'hoskia' ),
		'id'   => $prefix . 'show-share-icon',
		'type' => 'checkbox',
	));
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Display More Project', 'hoskia' ),
		'id'   => $prefix . 'display-more-project',
		'type' => 'checkbox',
	));
	
	/****************************\
      Service Post type
    \****************************/
    
	$hoskia_meta = new_cmb2_box( array(
		'id'            => $prefix . 'services_meta',
		'title'         => esc_html__( 'Service Icon', 'hoskia' ),
		'context'       => 'side',
		'priority'      => 'low',
		'object_types'  => array( 'hoskia_services' ), // Post type
        'closed'        => false
	) );
	$hoskia_meta->add_field( array(
		'name' => esc_html__( 'Icon', 'hoskia' ),
		'id'   => $prefix . 'service-icon',
		'type' => 'text',
	));
	
	
	
        
}
