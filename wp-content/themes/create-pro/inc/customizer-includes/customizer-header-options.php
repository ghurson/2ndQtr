<?php
/**
 * The template for adding Additional Header Option in Customizer
 *
 * @package Create Pro
 */

	// Header Options
	$wp_customize->add_setting( 'enable_featured_header_image', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['enable_featured_header_image'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$create_enable_featured_header_image_options = create_enable_featured_header_image_options();
	$choices = array();
	foreach ( $create_enable_featured_header_image_options as $create_enable_featured_header_image_option ) {
		$choices[$create_enable_featured_header_image_option['value']] = $create_enable_featured_header_image_option['label'];
	}

	$wp_customize->add_control( 'enable_featured_header_image', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Enable Featured Header Image on ', 'create' ),
			'section'   => 'header_image',
	        'settings'  => 'enable_featured_header_image',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'featured_image_size', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_image_size'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$create_featured_image_size_options = create_featured_image_size_options();
	$choices = array();
	foreach ( $create_featured_image_size_options as $create_featured_image_size_option ) {
		$choices[$create_featured_image_size_option['value']] = $create_featured_image_size_option['label'];
	}

	$wp_customize->add_control( 'featured_image_size', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Page/Post Featured Image Size', 'create' ),
			'section'   => 'header_image',
			'settings'  => 'featured_image_size',
			'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'featured_header_image_alt', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_alt'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'featured_header_image_alt', array(
			'label'		=> __( 'Featured Header Image Alt/Title Tag ', 'create' ),
			'section'   => 'header_image',
	        'settings'  => 'featured_header_image_alt',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'featured_header_image_url', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_url'],
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'featured_header_image_url', array(
			'label'		=> __( 'Featured Header Image Link URL', 'create' ),
			'section'   => 'header_image',
	        'settings'  => 'featured_header_image_url',
	        'type'	  	=> 'text',
	) );

	$wp_customize->add_setting( 'featured_header_image_base', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_header_image_base'],
		'sanitize_callback' => 'create_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'featured_header_image_base', array(
		'label'    	=> __( 'Check to Open Link in New Window/Tab', 'create' ),
		'section'  	=> 'header_image',
		'settings' 	=> 'featured_header_image_base',
		'type'     	=> 'checkbox',
	) );	
	// Header Options End