<?php
/**
 * The template for adding color options in Customizer
 *
 * @package Create Pro
 */
	
	//Color Options
	$wp_customize->add_panel( 'create_color_options', array(
	    'capability'     => 'edit_theme_options',
	    'description'    => __( 'Color Options', 'create' ),
	    'priority'       => 300,			
	    'title'    		 => __( 'Color Options', 'create' ),
	) );

	//Header Color Option
	$wp_customize->add_section( 'create_header_color_options', array(
		'panel'	   => 'create_color_options',
		'priority' => 302,
		'title'    => __( 'Header Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_header_color_options();

	$i = 10;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_header_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}

	//Content Color Option
	$wp_customize->add_section( 'create_content_color_options', array(
		'panel'	   => 'create_color_options',
		'priority' => 303,
		'title'    => __( 'Content Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_content_color_options();

	$i = 10;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_content_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}

	//Social Color Option
	$wp_customize->add_section( 'create_social_color_options', array(
		'panel'	   => 'create_color_options',
		'priority' => 303,
		'title'    => __( 'Social Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_social_color_options();

	$i = 10;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_social_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}

	$wp_customize->add_setting( 'social_icon_brand_color', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['social_icon_brand_color'],
		'sanitize_callback' => 'sanitize_key',
	) );

	$wp_customize->add_control( 'social_icon_brand_color', array(
		'choices'=> array( 
						'disable' 		=> '--'. __( 'Select', 'create' ). '--', 
						'hover' 		=> __( 'hover', 'create' ), 
						'hover-static' 	=> __( 'hover and static', 'create' )
						),
		'label'		=> __( 'Enable Social Icon\'s Brand Color on', 'create' ),
		'priority'	=> 100,
		'section'   => 'create_social_color_options',
        'settings'  => 'social_icon_brand_color',
		'type'		=> 'select',
	) );

	//Sidebar Color Option
	$wp_customize->add_section( 'create_sidebar_color_options', array(
		'description'	=> __( 'Only for Primary and Secondary Sidebars', 'create' ),
		'panel'	   		=> 'create_color_options',
		'priority' 		=> 304,
		'title'    		=> __( 'Sidebar Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_sidebar_color_options();

	$i = 1;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_sidebar_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}

	//Footer Sidebar Color Option
	$wp_customize->add_section( 'create_footer_sidebar_color_options', array(
		'panel'	   => 'create_color_options',
		'priority' => 306,
		'title'    => __( 'Footer Sidebar Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_footer_sidebar_color_options();

	$i = 1;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_footer_sidebar_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}

	//Footer Color Option
	$wp_customize->add_section( 'create_footer_color_options', array(
		'panel'	   => 'create_color_options',
		'priority' => 306,
		'title'    => __( 'Footer Color Options', 'create' ),
	) );

	$create_color_options	=	create_get_footer_color_options();

	$i = 1;
	foreach ( $create_color_options as $color_option ) {
		$lower_color_option	=	str_replace( ' ', '_', strtolower( $color_option ) );

		$wp_customize->add_setting( $lower_color_option, array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults[ $lower_color_option ],
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $lower_color_option, array(
			'label'		=> $color_option,
			'priority'	=> $i,
			'section'	=> 'create_footer_color_options',
			'settings'	=> $lower_color_option,
		) ) );

		$i++;
	}
	//Color Options End