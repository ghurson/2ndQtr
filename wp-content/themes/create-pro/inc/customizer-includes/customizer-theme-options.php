<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Create Pro
 */
	
	//Theme Options
	$wp_customize->add_panel( 'create_theme_options', array(
	    'description'    => __( 'Basic theme Options', 'create' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => 200,
	    'title'    		 => __( 'Theme Options', 'create' ),
	) );

   	// Comment Option
	$wp_customize->add_section( 'create_comment_option', array(
		'description'	=> __( 'Comments can also be disabled on a per post/page basis when creating/editing posts/pages.', 'create' ),
		'panel' 		=> 'create_theme_options',
		'priority'		=> 202,
		'title'   		=> __( 'Comment Options', 'create' ),
	) );

	$wp_customize->add_setting( 'comment_option', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['comment_option'],
		'sanitize_callback' => 'sanitize_key',
	) );

	
	$comment_option_types = create_comment_options();
	$choices = array();
	foreach ( $comment_option_types as $comment_option_type ) {
		$choices[$comment_option_type['value']] = $comment_option_type['label'];
	}

	$wp_customize->add_control( 'comment_option', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Comment Option', 'create' ),
	        'priority'	=> 1,
			'section'   => 'create_comment_option',
	        'settings'  => 'comment_option',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'disable_website_field', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['disable_website_field'],
		'sanitize_callback' => 'create_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_website_field', array(
		'label'		=> __( 'Check to Disable Website Field', 'create' ),
		'section'   => 'create_comment_option',
        'settings'  => 'disable_website_field',
		'type'		=> 'checkbox',
	) );
   	// Comment End
   	
   	// Custom CSS Option
	$wp_customize->add_section( 'create_custom_css', array(
		'description'	=> __( 'Custom/Inline CSS', 'create'),
		'panel'  		=> 'create_theme_options',
		'priority' 		=> 203,
		'title'    		=> __( 'Custom CSS Options', 'create' ),
	) );

	$wp_customize->add_setting( 'custom_css', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['custom_css'],
		'sanitize_callback' => 'create_sanitize_custom_css',
	) );

	$wp_customize->add_control( 'custom_css', array(
			'label'		=> __( 'Enter Custom CSS', 'create' ),
	        'priority'	=> 1,
			'section'   => 'create_custom_css',
	        'settings'  => 'custom_css',
			'type'		=> 'textarea',
	) ) ;
   	// Custom CSS End

   	// Excerpt Options
	$wp_customize->add_section( 'create_excerpt_options', array(
		'panel'  	=> 'create_theme_options',
		'priority' 	=> 204,
		'title'    	=> __( 'Excerpt Options', 'create' ),
	) );

	$wp_customize->add_setting( 'excerpt_length', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_length'],
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'create_excerpt_length', array(
		'description' => __('Excerpt length. Default is 40 words', 'create'),
		'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
        'label'    => __( 'Excerpt Length (words)', 'create' ),
		'section'  => 'create_excerpt_options',
		'settings' => 'excerpt_length',
		'type'	   => 'number',
		)
	);

	$wp_customize->add_setting( 'excerpt_more_text', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_more_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'create_excerpt_more_text', array(
		'label'    => __( 'Read More Text', 'create' ),
		'section'  => 'create_excerpt_options',
		'settings' => 'excerpt_more_text',
		'type'	   => 'text',
	) );
	// Excerpt Options End

	// Feed Redirect
	$wp_customize->add_section( 'create_feed_redirect', array(
		'panel'			=> 'create_theme_options',
		'description'	=> __( 'If your custom feed(s) are not handled by Feedblitz or Feedburner, do not use the redirect options.', 'create' ),	
		'priority' 		=> 205,
		'title'    		=> __( 'Feed Redirect', 'create' ),
	) );

	$wp_customize->add_setting( 'feed_redirect', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['feed_redirect'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'create_feed_redirect', array(
		'label'    => __( 'Feed Redirect', 'create' ),
		'section'  => 'create_feed_redirect',
		'settings' => 'feed_redirect',
		'type'	   => 'text',
	) );
	// Feed Redirect End

	// Font Family Options
	$wp_customize->add_section( 'create_font_family', array(
		'panel'  => 'create_theme_options',
		'priority'	=> 206,
		'title'    	=> __( 'Font Family Options', 'create' ),
	) );

	$avaliable_fonts = create_avaliable_fonts();
	
	$choices = array();
	
	foreach ( $avaliable_fonts as $avaliable_font ) {
		$choices[ $avaliable_font[ 'value' ] ] = str_replace( '"', '', $avaliable_font[ 'label' ] );
	}

	$font_family_options	=	array(
										'title_font' 		=> __( 'Site Title Font Family', 'create' ),
										'body_font' 		=> __( 'Default Font Family', 'create' ),
										'tagline_font' 		=> __( 'Site Tagline Font Family', 'create' ),
										'content_title_font'=> __( 'Content Title Font Family', 'create' ),
										'content_font' 		=> __( 'Content Body Font Family', 'create' ),
										'headings_font' 	=> __( 'Headings Tags from h1 to h6 Font Family', 'create' ),
										'forms_navigation' 	=> __( 'Forms and Navigation', 'create' )  
									);

	foreach ( $font_family_options as $key => $font_family_option ) {
		$wp_customize->add_setting( $key, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $key ],
			'sanitize_callback' => 'sanitize_key',
		) );

		$wp_customize->add_control( $key, array(
			'choices'  => $choices,
			'label'    => $font_family_option,
			'section'  => 'create_font_family',
			'settings' => $key,
			'type'	   => 'select',
		) );
	}

	$wp_customize->add_setting( 'reset_typography', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_typography'],
		'sanitize_callback' => 'create_reset_typography'
	) );

	$wp_customize->add_control( 'reset_typography', array(
		'label'		=> __( 'Check to reset fonts', 'create' ),
		'section'	=> 'create_font_family',
		'settings'	=> 'reset_typography',
		'type'		=> 'checkbox',
	) );
	// Font Family Options End

	// Footer Editor Options
	$wp_customize->add_section( 'create_footer_options', array(
		'description'	=> __( 'You can either add html or plain text', 'create'),
		'panel'  => 'create_theme_options',
		'priority' 		=> 207,
		'title'    		=> __( 'Footer Editor Options', 'create' ),
	) );

	$wp_customize->add_setting( 'footer_left_content', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['footer_left_content'],
		'sanitize_callback'	=> 'create_sanitize_footer_code',
	) );

	$wp_customize->add_control( 'footer_left_content', array(
			'label'		=> __( 'Footer Left Content', 'create' ),
	        'priority'	=> 1,
			'section'   => 'create_footer_options',
	        'settings'  => 'footer_left_content',
			'type'		=> 'textarea',
	) ) ;

	$wp_customize->add_setting( 'footer_right_content', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['footer_right_content'],
		'sanitize_callback'	=> 'create_sanitize_footer_code',
	) );

	$wp_customize->add_control( 'footer_right_content', array(
			'label'		=> __( 'Footer Right Content', 'create' ),
	        'priority'	=> 2,
			'section'   => 'create_footer_options',
	        'settings'  => 'footer_right_content',
			'type'		=> 'textarea',
	) ) ;

	$wp_customize->add_setting( 'reset_footer_content', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_footer_content'],
		'sanitize_callback' => 'create_sanitize_reset_footer_content'
	) );
	
	$wp_customize->add_control( 'reset_footer_content', array(
		'label'		=> __( 'Check to reset Footer Content', 'create' ),
		'priority'	=> 3,
		'settings'	=> 'reset_footer_content',
		'section'	=> 'create_footer_options',
		'type'		=> 'checkbox',
	) );
	// Footer Options End

	// Icon Options
	$wp_customize->add_section( 'create_icons', array(
		'description'	=> __( 'Remove Icon images to disable. <br/> Web Clip Icon for Apple devices. Recommended Size - Width 144px and Height 144px height, which will support High Resolution Devices like iPad Retina.', 'create'),
		'panel'  		=> 'create_theme_options',
		'priority' 		=> 210,
		'title'    		=> __( 'Icon Options', 'create' ),
	) );

	$wp_customize->add_setting( 'favicon', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon', array(
		'label'		=> __( 'Select/Add Favicon', 'create' ),
		'section'    => 'create_icons',
        'settings'   => 'favicon',
	) ) );

	$wp_customize->add_setting( 'web_clip', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'web_clip', array(
		'label'		=> __( 'Select/Add Web Clip Icon', 'create' ),
		'section'    => 'create_icons',
        'settings'   => 'web_clip',
	) ) );
	// Icon Options End

	// Intro Widget Options
	$wp_customize->add_section( 'create_intro_widget', array(
		'capability'=> 'edit_theme_options',
		'panel'		=> 'create_theme_options',
		'priority'	=> 210.5,
		'title'		=> __( 'Intro Widget Options', 'create' ),
	) );

	$wp_customize->add_setting( 'enable_intro_widget', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_intro_widget'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$create_intro_widget_options = create_intro_widget_options();
	$choices = array();
	foreach ( $create_intro_widget_options as $create_intro_widget_option ) {
		$choices[ $create_intro_widget_option['value'] ] = $create_intro_widget_option['label'];
	}

	$wp_customize->add_control( 'enable_intro_widget', array(
		'choices'	=> $choices,
		'label'		=> __( 'Enable Intro Widget On', 'create' ),
		'section'	=> 'create_intro_widget',
		'settings'  => 'enable_intro_widget',
		'type'		=> 'select',
	) );

	// Intro Widget End

	// Layout Options
	$wp_customize->add_section( 'create_layout', array(
		'capability'=> 'edit_theme_options',
		'panel'		=> 'create_theme_options',
		'priority'	=> 211,
		'title'		=> __( 'Layout Options', 'create' ),
	) );

	$wp_customize->add_setting( 'homepage_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['homepage_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$create_homepage_layouts = create_homepage_layouts();
	$choices = array();
	foreach ( $create_homepage_layouts as $create_homepage_layout ) {
		$choices[ $create_homepage_layout['value'] ] = $create_homepage_layout['label'];
	}

	$wp_customize->add_control( 'homepage_layout', array(
		'choices'	=> $choices,
		'label'		=> __( 'Frontpage Posts Layout', 'create' ),
		'section'	=> 'create_layout',
		'settings'  => 'homepage_layout',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'theme_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['theme_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = create_layouts();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'theme_layout', array(
		'choices'	=> $choices,
		'label'		=> __( 'Default Layout', 'create' ),
		'section'	=> 'create_layout',
		'settings'  => 'theme_layout',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'content_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['content_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$layouts = create_get_archive_content_layout();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'content_layout', array(
		'choices'   => $choices,
		'label'		=> __( 'Archive Content Layout', 'create' ),
		'section'   => 'create_layout',
		'settings'  => 'content_layout',
		'type'      => 'select',
	) );

	$wp_customize->add_setting( 'single_post_image_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['single_post_image_layout'],
		'sanitize_callback' => 'sanitize_key',
	) );

	
	$single_post_image_layouts = create_single_post_image_layout_options();
	$choices = array();
	foreach ( $single_post_image_layouts as $single_post_image_layout ) {
		$choices[$single_post_image_layout['value']] = $single_post_image_layout['label'];
	}

	$wp_customize->add_control( 'single_post_image_layout', array(
			'label'		=> __( 'Single Page/Post Image Layout ', 'create' ),
			'section'   => 'create_layout',
	        'settings'  => 'single_post_image_layout',
	        'type'	  	=> 'select',
			'choices'  	=> $choices,
	) );
   	// Layout Options End
	
	// Pagination Options
	$pagination_type	= get_theme_mod( 'pagination_type' );

	$create_navigation_description = '';

	/**
	 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	 */
	if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
		if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			$create_navigation_description = sprintf( __( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'create' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );
		}
	}

	$wp_customize->add_section( 'create_pagination_options', array(
		'description'	=> $create_navigation_description,
		'panel'  		=> 'create_theme_options',
		'priority'		=> 212,
		'title'    		=> __( 'Pagination Options', 'create' ),
	) );

	$wp_customize->add_setting( 'pagination_type', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['pagination_type'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$pagination_types = create_get_pagination_types();
	$choices = array();
	foreach ( $pagination_types as $pagination_type ) {
		$choices[$pagination_type['value']] = $pagination_type['label'];
	}

	$wp_customize->add_control( 'create_pagination_options', array(
		'choices'  => $choices,
		'label'    => __( 'Pagination type', 'create' ),
		'section'  => 'create_pagination_options',
		'settings' => 'pagination_type',
		'type'	   => 'select',
	) );
	// Pagination Options End

	// Scrollup
	$wp_customize->add_section( 'create_scrollup', array(
		'panel'    => 'create_theme_options',
		'priority' => 215,
		'title'    => __( 'Scrollup Options', 'create' ),
	) );

	$wp_customize->add_setting( 'disable_scrollup', array(
		'capability'		=> 'edit_theme_options',
        'default'			=> $defaults['disable_scrollup'],
		'sanitize_callback' => 'create_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_scrollup', array(
		'label'		=> __( 'Check to disable Scroll Up', 'create' ),
		'section'   => 'create_scrollup',
        'settings'  => 'disable_scrollup',
		'type'		=> 'checkbox',
	) );
	// Scrollup End

	// Update Notifier
	$wp_customize->add_section( 'create_update_notifier', array(
		'title'    => __( 'Update Notifier', 'create' ),
		'priority' => 217,
		'panel'    => 'create_theme_options',
	) );

	$wp_customize->add_setting( 'update_notifier', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['update_notifier'],
		'sanitize_callback' => 'create_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'update_notifier', array(
		'label'		=> __( 'Check to disable update notifications', 'create' ),
		'section'   => 'create_update_notifier',
        'settings'  => 'update_notifier',
		'type'		=> 'checkbox',
	) );
	// Update Notifier End
	//Theme Option End