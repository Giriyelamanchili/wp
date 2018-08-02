<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "hoskia_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( get_template_directory() . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( get_template_directory(). '/info-html.html' );
    }
	
	$alowhtml = array(
		'p' => array(
			'class' => array()
		),
		'span' => array()
	);

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Hoskia Options', 'hoskia' ),
        'page_title'           => esc_html__( 'Hoskia Options', 'hoskia' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS 
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'hoskia' ),
            'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'hoskia' ), $alowhtml )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'hoskia' ),
            'content' => wp_kses( __( '<p>This is the tab content, HTML is allowed.</p>', 'hoskia' ), $alowhtml )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses( __('<p>This is the sidebar content, HTML is allowed.</p>', 'hoskia' ), $alowhtml );
    Redux::setHelpSidebar( $opt_name, $content );

    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'hoskia' ),
        'id'               => 'hoskia_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array(
            
            array(
                'id'       => 'hoskia_display_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Preloader', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch On to Display Preloader.', 'hoskia' ),
                'default'  => true,
            ),
            array(
                'id'       => 'hoskia_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Back To Top Button', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'hoskia' ),
                'default'  => true,
            ),
            array(
                'id'          => 'hoskia_hoskia_body_fonts',
                'type'        => 'typography', 
                'title'       => esc_html__('Body Typography', 'hoskia'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array( 'body', 'p' ),
                'units'       =>'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'hoskia'),
                'text-align'  => false,
                'line-height' => false,
                'font-backup' => false,
                'color'       => false,
                'font-size'   => false,
                'subsets'     => false,
                'line-height' => false,
                'default'     => array(
                    'font-family' => 'Roboto', 
                    'google'      => true,
                ),
            ),
            array(
                'id'          => 'hoskia_hoskia_header_fonts',
                'type'        => 'typography', 
                'title'       => esc_html__('Heading Typography', 'hoskia'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.whmcs-template-five h1', '.whmcs-template-five h2', '.whmcs-template-five h3', '.whmcs-template-five h4', '.whmcs-template-five h5', '.whmcs-template-five h6' ),
                'units'       => 'px',
                'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'hoskia'),
                'text-align'  => false,
                'line-height' => false,
                'font-backup' => false,
                'color'       => false,
                'font-size'   => false,
                'subsets'     => false,
                'line-height' => false,
                'default'     => array(
                    'font-family' => 'Roboto', 
                    'google'      => true,

                ),
            ),
            array(
                'id'       => 'hoskia_unlimited-color',
                'type'     => 'color',
                'title'    => esc_html__('Custom Theme Color', 'hoskia'), 
                'subtitle' => esc_html__('Pick a unlimited main color for the theme (default: #3f5efb).', 'hoskia'),
                'default'  => '#3f5efb',
                'validate' => 'color'
            ),
            array(
                'id'       => 'hoskia_unlimited-secondarycolor',
                'type'     => 'color',
                'title'    => esc_html__('Custom Theme Secondary Color', 'hoskia'), 
                'subtitle' => esc_html__('Pick a unlimited secondary color for the theme (default: #3f5efb).', 'hoskia'),
                'default'  => '#fc466b',
                'validate' => 'color'
            ),
			array(
                'id'       => 'hoskia_map_apikey',
                'type'     => 'text',
                'title'    => __( 'API Key', 'hoskia' ),
                'subtitle' => __( 'Set your google map api key', 'hoskia' )              
            ),
         
        )
    ) );
    
    /* End General Fields */


    
    // -> START Header / Menu
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'hoskia'),
        'id'         => 'hoskia_header_option',
        'icon'       => 'el el-credit-card',
        'fields'     => array(    
            array(
                'id'       => 'hoskia_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'hoskia' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'hoskia' ),
            ),  
            array(
                'id'       => 'hoskia_sticky_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Sticky Logo', 'hoskia' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for sticky header ( recommendation png format ).', 'hoskia' ),
            ),
			array(
                'id'       => 'hoskia_site_logo_dimensions',
                'type'     => 'dimensions',
                'output'   => array( '.header--logo img' ),
                'units'    => array('em','px','%'),
                'title'    => __('Logo Dimensions (Width/Height).', 'hoskia'),
                'subtitle' => __('Set logo dimensions to choose width, height, and unit.', 'hoskia'),
                'default'  => array(
                    'Width'   => '100', 
                    'Height'  => '50'
                ),
            ),
			array(
                'id'       => 'hoskia_site_logomargin_dimensions',
                'type'     => 'spacing',
				'mode'           => 'margin',
                'output'   => array( '.header--logo' ),
				'units_extended' => 'false',
                'units'    => array('em','px' ),
                'title'    => __('Logo Top and Bottom Margin.', 'hoskia'),
				'left'     => false,
                'right'    => false,
                'subtitle' => __('Set logo top and bottom margin.', 'hoskia'),
                'default'            => array(
                    'units'           => 'px' 
                )
            ),
            array( 
                'id'       => 'hoskia_site_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'hoskia' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'hoskia' ),
                'default'  => wp_kses( __( 'Hoskia', 'hoskia' ), $alowhtml ),
            ),
            array(
                'id'       => 'hoskia_header_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Header Top', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch on to display header top.', 'hoskia' ),
                'default'  => false,
            ),
            array(
                'id'       => 'hoskia_header_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Header Social', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch on to display header social media.', 'hoskia' ),
                'default'  => false,
                'required' => array( 'hoskia_header_top', 'equals', true  ),
            ),
			array(
                'id'       => 'hoskia_header_topcontact',
                'type'     => 'switch',
                'required' => array( 'hoskia_header_top', 'equals', true  ),
                'title'    => esc_html__( 'Display Header Top Contact', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch on to display header top contact.', 'hoskia' ),
                'default'  => false,
            ),
            array(
                'id'       => 'hoskia_header_top_dividercolor',
                'type'     => 'border',
                'output'   => array( '.header--contact-info > li' ),
                'title'    => esc_html__( 'Header Top contact divider Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header top contact divider color.', 'hoskia' ),
                'required' => array( 'hoskia_header_topcontact', 'equals', true ),
                'right'    => false,
                'bottom'   => false,
                'top'      => false,
            ),
            array(
                'id'       => 'hoskia_header_mobile',
                'type'     => 'text',
				'required' => array( 'hoskia_header_topcontact', 'equals', true ),
                'title'    => esc_html__( 'Header top phone Number', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header top phone number.', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_header_email',
                'type'     => 'text',
				'required' => array( 'hoskia_header_topcontact', 'equals', true ),
                'title'    => esc_html__( 'Header top email', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header top email.', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_header_top_bg',
                'type'     => 'background',
                'output'   => array( '.header--topbar' ),
                'required' => array( 'hoskia_header_top', 'equals', true  ),
                'title'    => esc_html__( 'Header Top Background Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header top background color.', 'hoskia' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),
            array(
                'id'       => 'hoskia_headertop_color',
                'type'     => 'color',
                'required' => array( 'hoskia_header_top', 'equals', true  ),
                'output'   => array( '.header--topbar .nav > li > a', '.header--social > li > span' ),
                'title'    => esc_html__( 'Header Top Text Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header top color.', 'hoskia' ),
                'required' => array( 'hoskia_header_top', 'equals', true  ),
            ),
            // Header to end
            array(
                'id'       => 'hoskia_header_shopcart',
                'type'     => 'switch',
                'title'    => esc_html__( 'Display Header Shopping Cart', 'hoskia' ),
                'subtitle' => esc_html__( 'Switch on to display header shopping cart.', 'hoskia' ),
                'default'  => false,
            ),
			// Cart Icon
			array(
                'id'       => 'hoskia_cart_imgicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Cart Image Icon', 'hoskia' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your cart icon for header ( recommendation png format ).', 'hoskia' ),
				'required' => array( 'hoskia_header_shopcart', 'equals', true )
            ), 
			array(
                'id'       => 'header-cart-icon',
                'type'     => 'select',
                'title'    => esc_html__('Select Cart Icon', 'hoskia'), 
                'subtitle' => esc_html__('Select font awesome icon.', 'hoskia'),
                // Must provide key => value pairs for select options
                'options'  => hoskia_fa_icons(),
				'required' => array( 'hoskia_header_shopcart', 'equals', true )
            ),
			//
			array(
                'id'       => 'hoskia_logbtn_imgicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Login Button Image Icon', 'hoskia' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload header login button icon ( recommendation png format ).', 'hoskia' ),
            ), 
			array(
                'id'       => 'header-logbtn-icon',
                'type'     => 'select',
                'title'    => esc_html__('Login Button Icon', 'hoskia'), 
                'subtitle' => esc_html__('Select font awesome icon.', 'hoskia'),
                // Must provide key => value pairs for select options
                'options'  => hoskia_fa_icons(),
            ),
            array(
                'id'       => 'hoskia_header_btnurl',
                'type'     => 'text',
                'title'    => esc_html__( 'Login Button Url', 'hoskia' ),
                'subtitle' => esc_html__( 'Set login button url.', 'hoskia' ),
            ),
            array(
                'id'       => 'header-logbtn-tooltip',
                'type'     => 'text',
                'title'    => esc_html__( 'Login Button Tool Tip', 'hoskia' ),
                'subtitle' => esc_html__( 'Set login button tool tip text.', 'hoskia' ),
            ),

			//

            array(
                'id'   =>'divider_headermenu',
                'type' => 'divide',
				'required' => array( 'hoskia_header_top', 'equals', true  ),
            ),
            array(
                'id'       => 'hoskia_headermenu_bgcolor',
                'type'     => 'background',
                'output'   => array( '#sticky-wrapper .bg-color--alabaster' ),
                'title'    => esc_html__( 'Header Menu Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header menu background color.', 'hoskia' ),
                'background-image'      => false,
                'background-size'       => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
                'default'  => array(
                    'background-color' => '#fff',
                ),
            ),
            array(
                'id'       => 'hoskia_sticky_headermenu_bgcolor',
                'type'     => 'background',
                'output'   => array( '#sticky-wrapper.is-sticky .bg-color--alabaster' ),
                'title'    => esc_html__( 'Sticky header Menu Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Set sticky header menu background color.', 'hoskia' ),
				'background-image' 		=> false,
				'background-size' 		=> false,
				'background-attachment' => false,
				'background-repeat' 	=> false,
				'background-position' 	=> false,
				'preview' 				=> false,
                'default'  => array(
                    'background-color' => '#fff',
                ),
            ),
            array(
                'id'       => 'hoskia_header_menu_color',
                'output'   => array( '.header--nav-links > li > a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header menu color.', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_header_hov_menu_color',
                'output'   => array( '.header--nav-links > li > a:hover', '.header--nav-links > li > a:focus', '.header--nav-links > li.active > a', '.header--nav-links > li.active > a', '.header--nav-links > li.open > a' ),
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set header menu hover color.', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_sticky_header_menu_color',
                'type'     => 'color',
                'output'   => array( '.is-sticky .header--nav-links > li > a' ),
                'title'    => esc_html__( 'Sticky Menu Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set sticky header menu color.', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_sticky_header_menuhov_color',
                'type'     => 'color',
                'output'   => array( '.is-sticky .header--nav-links > li > a:hover', '.is-sticky .header--nav-links > li > a:focus', '.is-sticky .header--nav-links > li.active > a', '.is-sticky .header--nav-links > li.active > a', '.is-sticky .header--nav-links > li.open > a' ),
                'title'    => esc_html__( 'Sticky Menu Hover Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set sticky header menu hover color.', 'hoskia' ),
            ),

    
        ),

    ) );
    
    /* End Header */ 
    
    // -> START Page Header
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Header', 'hoskia'),
        'id'         => 'hoskia_pageheader_option',
        'icon'       => 'el el-credit-card',
        'fields'     => array(    
            array(
                'id'       => 'hoskia_allHeader_bg',
                'type'     => 'background',
				'output'   => array( '#pageHeader.globpageheader' ),
                'title'    => esc_html__( 'Common Header Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Set common header background.', 'hoskia' ),
				'default'  => array(
					'background-color' => '#555'
				)
            ),
            array(
                'id'       => 'hoskia_allHeader_overlay',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Page Header Overlay', 'hoskia' ),
                'subtitle' => esc_html__( 'Check this check box to use overlay.', 'hoskia' ),
            ),                   
            array(
                'id'       => 'hoskia_allHeader_ovbg',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Header Overlay Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Set overlay background.', 'hoskia' ),
            ),                                      
            array(
                'id' => 'hoskia_allHeader_ovopacity',
                'type' => 'slider',
                'title' => esc_html__('Overlay Opacity', 'hoskia'),
                'subtitle' => esc_html__('Set overlay opacity.', 'hoskia'),
                "default" => .5,
                "min" => 0,
                "step" => .1,
                "max" => 1,
                'resolution' => 0.1,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'hoskia_allHeader_textcolor',
                'type'     => 'color',
				'output'   => array( '#pageHeader', '.page-header--breadcrumb .breadcrumb li a' ),
                'title'    => esc_html__( 'Page Header Text Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set page header text color.', 'hoskia' ),
            ),  
            array(
                'id'       => 'hoskia_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'hoskia' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all page and post ( Default settings hide ).', 'hoskia' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ), 
            array(
                'id'       => 'hoskia_allHeader_dividercolor',
                'type'     => 'color',
                'output'   => array( '.breadcrumb > li + li:before' ),
                'title'    => esc_html__( 'Breadcrumb divider Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set breadcrumb divider color.', 'hoskia' ),
            ),           
        ),

    ) );
    
    /* End Header */    
    
    // -> START Blog Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'hoskia' ),
        'id'         => 'hoskia_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(
      
            array(
                'id'       => 'hoskia_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select blog layout', 'hoskia' ),
                'subtitle' => esc_html__( 'Choose your blog sidebar layout ', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'hoskia_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Blog Post Column', 'hoskia' ),
                'subtitle' => esc_html__( 'Choose your blog post column.', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),

                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'hoskia_blog_postExcerpt',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog Posts Excerpt', 'hoskia' ),
                'subtitle' => esc_html__( 'How many word you want to show per post in blog ', 'hoskia' ),
                'default'  => '30',
            ), 
            array(
                'id'       => 'hoskia_blog_posttitle_position',
                'type'     => 'button_set',
                'title'    => esc_html__('Single post title display position', 'hoskia'),
                'subtitle' => esc_html__('Set single post title display position.', 'hoskia'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'On Header', 'hoskia' ), 
                    '2' => esc_html__( 'Below Post Thumbnail', 'hoskia' )
                 ), 
                'default' => '1'
            ),
			array(
				'id'       => 'hoskia_blog_pagination',
				'type'     => 'button_set',
				'title'    => esc_html__('Blog Pagination Settings', 'hoskia'),
				'subtitle' => esc_html__('Set blog pagination.', 'hoskia'),
				//Must provide key => value pairs for options
				'options' => array(
					'1' => esc_html__( 'Number Pagination', 'hoskia' ), 
					'2' => esc_html__( 'Link Pagination', 'hoskia' )
				 ), 
				'default' => '2'
			),
            array(
                'id'       => 'hoskia_hide_shareBox',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'social share box show/hide', 'hoskia' ),
                'subtitle' => esc_html__( 'Uncheck to hide social share-box in single post view', 'hoskia' ),
                'default'  => '0'// 1 = on | 0 = off
            ),          
        ),
    ) );
    
    /* End blog Page */    
    
    // -> START Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'hoskia' ),
        'id'         => 'hoskia_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
			array(
				'id'       => 'hoskia_page_layoutopt',
				'type'     => 'button_set',
				'title'    => esc_html__('Page Sidebar Settings', 'hoskia'),
				'subtitle' => esc_html__('Set page sidebar.', 'hoskia'),
				//Must provide key => value pairs for options
				'options' => array(
					'1' => esc_html__( 'No sidebar', 'hoskia' ), 
					'2' => esc_html__( 'Page Sidebar', 'hoskia' ), 
					'3' => esc_html__( 'Blog Sidebar', 'hoskia' )
				 ), 
				'default' => '2'
			),
            array(
                'id'       => 'hoskia_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Page layout', 'hoskia' ),
                'subtitle' => esc_html__( 'Choose your page sidebar layout ', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),

        ),
    ) );
    
    /* End Page option */
    
    // -> START Woo Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce Page', 'hoskia' ),
        'id'         => 'hoskia_woo_page_page',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'hoskia_woo_shoppage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Shop Page Sidebar.', 'hoskia' ),
                'subtitle' => esc_html__( 'Choose shop page sidebar', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'hoskia_woo_singlepage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Single Page sidebar', 'hoskia' ),
                'subtitle' => esc_html__( 'Choose product single page sidebar.', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'hoskia_woo_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Column', 'hoskia' ),
                'subtitle' => esc_html__( 'Set your woocommerce product column.', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    ),

                ),
                'default'  => '4'
            ),
			array(
                'id'       => 'hoskia_woo_product_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Per Page', 'hoskia' ),
				'default' => '10'
            ),
			array(
                'id'       => 'hoskia_woo_shoptitle_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Shop page title on/off', 'hoskia' ),
                'subtitle' => esc_html__( 'Use switch to show or hide WooCommerce shop page title .', 'hoskia' ),
                'default'  => false,
            ),
			array(
                'id'       => 'hoskia_woo_relproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products number', 'hoskia' ),
                'subtitle' => esc_html__( 'Set how many related products you want to show in single product page.', 'hoskia' ),
                'default'  => 3,
            ),


        ),
    ) );
    
    /* End Woo Page option */
    
    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'hoskia' ),
        'id'         => 'hoskia_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'hoskia_fof_text',
                'type'     => 'text',
                'title'    => esc_html__( '404 Text', 'hoskia' ),
                'subtitle' => esc_html__( 'Set 404 text ', 'hoskia' ),
                'default'  => esc_html__( 'Ooops 404 Error !', 'hoskia' ),                
            ),
            array(
                'id'       => 'hoskia_fof_sorry_text',
                'type'     => 'text',
                'title'    => esc_html__( '404 Sorry Text', 'hoskia' ),
                'subtitle' => esc_html__( 'Set 404 sorry text.', 'hoskia' ),
                'default'  => wp_kses_post( __( 'Ooops ! sorry we can&rsquo;t find the page.', 'hoskia' ) )             
            ),
            array(
                'id'       => 'hoskia_fof_desc',
                'type'     => 'text',
                'title'    => esc_html__( '404 Description', 'hoskia' ),
                'subtitle' => esc_html__( 'Set 404 description text ', 'hoskia' ),
                'default'  => wp_kses_post( __( 'Either something went wrong or the page dosen&rsquo;t exist anymore.', 'hoskia' ) )            
            ),
            array(
                'id'       => 'hoskia_fof_img',
                'type'     => 'media',
                'title'    => esc_html__( 'Image', 'hoskia' ),
                'subtitle' => esc_html__( 'Set image', 'hoskia' ),               
            ),
            array(
                'id'       => 'hoskia_fof_background',
                'type'     => 'background',
                'output'   => array( '#f0f' ),
                'title'    => esc_html__( '404 Background', 'hoskia' ),
                'subtitle' => esc_html__( '404 page background with image, color, etc.', 'hoskia' ),
                'default'  => array(
                    'background-color' => '#ffffff',
                ),
            ),
            array(
                'id'       => 'hoskia_fof_bgoverlay',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Background Overlay', 'hoskia' ),
                'subtitle' => esc_html__( 'Set background overlay.', 'hoskia' ),
            ),
			array(
                'id'       => 'hoskia_fof_overlay_color',
                'type'     => 'background',
                'output'   => array( '#f0f.bg--overlay:before' ),
                'title'    => esc_html__( 'Overlay Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set overlay color.', 'hoskia' ),
				'background-image' 		=> false,
				'background-size' 		=> false,
				'background-attachment' => false,
				'background-repeat' 	=> false,
				'background-position' 	=> false,
				'preview' 				=> false,
                'default'  => array(
                    'background-color' => '#303030',
                ),
            ),
			array(
				'id' => 'hoskia_fof_ovopacity',
				'type' => 'slider',
				'title' => esc_html__('Overlay Opacity', 'hoskia'),
				'subtitle' => esc_html__('set overlay opacity.', 'hoskia'),
				"default" => .5,
				"min" => 0,
				"step" => .1,
				"max" => 1,
				'resolution' => 0.1,
				'display_value' => 'text'
			),
            array(
                'id'       => 'hoskia_fof_text_color',
                'type'     => 'color',
                'output'   => array( '#f0f' ),
                'title'    => esc_html__('Text Color', 'hoskia'), 
                'subtitle' => esc_html__('Pick a text color', 'hoskia'),
                'default'  => '#333333',
                'validate' => 'color'
            ),
        ),
    ) );
    
    /* End 404 Page */
    
    // -> START Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'hoskia' ),
        'id'         => 'hoskia_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(
            array(
                'id'       => 'hoskia_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'hoskia' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'hoskia' )              
            ),
            array(
                'id'       => 'hoskia_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'hoskia' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'hoskia' )              
            ),

        ),
    ) );
    
    /* End Page */
    

    // -> START Contact Page   
    
    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'hoskia' ),
        'id'         => 'hoskia_social_media',
        'icon'  => 'el el-globe',
        'fields'     => array(
            array(
                'id'       => 'hoskia_facebook_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'hoskia' ),
                'subtitle' => esc_html__( 'Add Facebook URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_twitter_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'hoskia' ),
                'subtitle' => esc_html__( 'Add Twitter URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_google_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Plus', 'hoskia' ),
                'subtitle' => esc_html__( 'Add google plus URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_youtube_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'hoskia' ),
                'subtitle' => esc_html__( 'Add youtube URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_instagram_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'hoskia' ),
                'subtitle' => esc_html__( 'Add Instagram URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_vimeo_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo', 'hoskia' ),
                'subtitle' => esc_html__( 'Add vimeo plus URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_linkedin_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'hoskia' ),
                'subtitle' => esc_html__( 'Add linkedin plus URL', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_behance_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Behance', 'hoskia' ),
                'subtitle' => esc_html__( 'Add behance plus URL', 'hoskia' ),
            ),          
            array(
                'id'       => 'hoskia_pinterest_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'hoskia' ),
                'subtitle' => esc_html__( 'Add pinterest plus URL', 'hoskia' ),
            ),          
            array(
                'id'       => 'hoskia_dribbble_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble', 'hoskia' ),
                'subtitle' => esc_html__( 'Add dribbble plus URL', 'hoskia' ),
            ),          
            array(
                'id'       => 'hoskia_github_link',
                'type'     => 'text',
                'title'    => esc_html__( 'Github', 'hoskia' ),
                'subtitle' => esc_html__( 'Add github URL', 'hoskia' ),
            ), 
        ),
    ) );
    
    /* End social Media */
    
    // -> START Footer Top Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Top ( Contact Info Section )', 'hoskia' ),
        'id'         => 'hoskia_footertop_section',
        'icon'  => 'el el-photo',
        'fields'     => array(

            array(
                'id'       => 'hoskia_footertop_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Top Enabled/Disabled', 'hoskia' ),
                'subtitle' => esc_html__( 'Enabled/Disabled footer top section for all page.', 'hoskia' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'hoskia_footertop_supports_contact_col',
                'type'     => 'select',
                'title'    => esc_html__('Column', 'hoskia'), 
                'subtitle' => esc_html__('Set footer top support contact info column.', 'hoskia'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '12'   => 'Column 1',
                    '6'    => 'Column 2',
                    '4'    => 'Column 3',
                    '3'    => 'Column 4',
                ),
                'default'  => '4',
            ),
            array(
                'id'          => 'hoskia_footertop_supports_contact',
                'type'        => 'slides',
                'title'       => esc_html__('Contact Info', 'hoskia'),
                'subtitle'    => esc_html__('Set footer top support contact info.', 'hoskia'),
                   'placeholder' => array(
                    'title'           => esc_html__('Text, number, email or others', 'hoskia'),
					'progress'             => esc_html__( 'info or others 1', 'hoskia' ),
                    'url'             => esc_html__( 'info or others 2', 'hoskia' ),
                    
                    ),
                'show'        => array( 
                    'title'          => true,
                    'description'    => false,
                    'progress'       => true,
                    'icon'           => true,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3' 	 => false,
                    'facts-number-3' => false,
                    'project-button' => false,
                    'url'            => true,
                    'image_upload'   => true,
                )
            ),
            array(
                'id'       => 'hoskia_footertop_background',
                'type'     => 'background',
                'output'   => array( '.contact-info--item' ),
                'title'    => esc_html__( 'Footer Top Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Footer top section background color.', 'hoskia' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),

            array(
                'id'       => 'hoskia_footertop_color',
                'type'     => 'color',
                'output'   => array( '.contact-info--item' ),
                'title'    => esc_html__( 'Footer Top Text Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set footer top text color.', 'hoskia' )
            ),

            array(
                'id'       => 'hoskia_footertop_hover_background',
                'type'     => 'background',
                'output'   => array( '.contact-info--item:hover' ),
                'title'    => esc_html__( 'Footer Top Hover Background', 'hoskia' ),
                'subtitle' => esc_html__( 'Footer top section background with image, color, etc.', 'hoskia' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),

            array(
                'id'       => 'hoskia_footertop_hover_color',
                'type'     => 'color',
				'output'   => array( '.contact-info--item:hover' ),
                'title'    => esc_html__( 'Footer Top Hover Text Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set footer top hover text color.', 'hoskia' )
            ),
		)
    ) );
    
    /* End Footer Top Media */

    
    // -> START Footer Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'hoskia' ),
        'id'         => 'hoskia_footer_section',
        'icon'  => 'el el-photo',
        'fields'     => array(    
            array(
                'id'       => 'hoskia_footerwidget_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Widget Enabled/Disabled', 'hoskia' ),
                'default'  => 1,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'hoskia_footercol_switch',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select Widget Column', 'hoskia' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '3 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),

                    '3' => array(
                        'alt' => '4 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    ),

                ),
                'default'  => '3'
            ), 
            array(
                'id'       => 'hoskia_footer_widget_background',
                'type'     => 'background',
                'output'   => array( '.footer--widgets' ),
                'title'    => esc_html__( 'Footer widget background color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set footer widget background color.', 'hoskia' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),  
            array(
                'id'       => 'hoskia_footer_widget_title_color',
                'type'     => 'color',
                'output'   => array( '.footer--widget h4.footer--title' ),
                'title'    => esc_html__( 'Footer widget title color', 'hoskia' ),
            ),  
            array(
                'id'       => 'hoskia_footer_widget_color',
                'type'     => 'color',
                'output'   => array( '.footer--widget', '.footer--widget > ul > li > a', 'caption' ),
                'title'    => esc_html__( 'Footer widget color', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_footer_widget_icon_color',
                'type'     => 'color',
                'output'   => array( '.footer--widget > ul > li:before' ),
                'title'    => esc_html__( 'Footer widget anchor icon color', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_footer_widget_hov_color',
                'type'     => 'color',
                'output'   => array( '.footer--widget > ul > li:hover > a','.footer--widget > ul > li:hover:before' ),
                'title'    => esc_html__( 'Footer widget anchor hover color', 'hoskia' ),
            ),
            array(
                'id'       => 'hoskia_copyright_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Copyright', 'hoskia' ),
                'subtitle' => esc_html__( 'Add Copyright ', 'hoskia' ),
                'default'  => sprintf( 'Copyright &copy; %s <a href="%s">Hoskia</a>. All Rights Reserved.', '2018' ,'#' ),
            ),
            array(
                'id'       => 'hoskia_footer_copyright_bg',
                'type'     => 'background',
                'output'   => array( '.footer--copyright' ),
                'title'    => esc_html__( 'Footer Copyright Background Color', 'hoskia' ),
                'background-size'       => false,
                'background-image'      => false,
                'background-attachment' => false,
                'background-repeat'     => false,
                'background-position'   => false,
                'preview'               => false,
            ),
            array(
                'id'       => 'hoskia_footer_copyright_color',
                'type'     => 'color',
                'output'   => array( '.footer--copyright p' ),
                'title'    => esc_html__( 'Footer Copyright Text Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set footer copyright text color', 'hoskia' )
            ),
            array(
                'id'       => 'hoskia_footer_copyright_acolor',
                'type'     => 'color',
                'output'   => array( '.footer--copyright p a' ),
                'title'    => esc_html__( 'Footer Copyright Link Color', 'hoskia' ),
                'subtitle' => esc_html__( 'Set footer copyright link color', 'hoskia' )
            ),
            
        ),
    ) );
    
    /* End Footer Media */

    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>'.esc_html__( 'The compiler hook has run!', 'hoskia' ).'</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = esc_html__( 'your custom error message', 'hoskia' );
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = esc_html__( 'your custom warning message', 'hoskia' );
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'hoskia' ),
                'desc'   => wp_kses( __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'hoskia' ), $alowhtml),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'hoskia' );

            return $defaults;
        }
    }
