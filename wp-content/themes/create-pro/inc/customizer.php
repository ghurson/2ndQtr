<?php
/**
 * Create Theme Customizer
 *
 * @package Create Pro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function create_customize_register( $wp_customize ) {

	$defaults = create_get_default_theme_options();

	//Rename title_tagline section to Site Title, Tagline and Logo
	$wp_customize->get_section( 'title_tagline' )->title 		= __( 'Site Title, Tagline and Logo', 'create' );
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$jetpack_logo  = get_option( 'site_logo' );

	//If there logo present from jetpack, the $jetpack_logo['id'] becomes not empty, hence,  the check
    if ( empty( $jetpack_logo['id'] ) ) {
		// Custom Logo (added to Site Title and Tagline section in Theme Customizer)
		$wp_customize->add_setting( 'logo', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo'],
			'sanitize_callback'	=> 'esc_url_raw'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
			'label'		=> __( 'Logo', 'create' ),
			'priority'	=> 100,
			'section'   => 'title_tagline',
	        'settings'  => 'logo',
	    ) ) );

	    $wp_customize->add_setting( 'logo_alt_text', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['logo_alt_text'],
			'sanitize_callback'	=> 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'logo_alt_text', array(
			'label'    	=> __( 'Logo Alt Text', 'create' ),
			'priority'	=> 102,
			'section' 	=> 'title_tagline',
			'settings' 	=> 'logo_alt_text',
			'type'     	=> 'text',
		) );
		// Custom Logo End
	}

	//Header Options
	require get_template_directory() . '/inc/customizer-includes/customizer-header-options.php';

	//Color Options
	
	// Moved from Default Color Control to background Image Options
   	$wp_customize->get_control( 'background_color' )->section	= 'background_image';
	
	// Moved from Default Color Control to Catbase Color Options
	$wp_customize->get_control( 'header_textcolor' )->section	= 'create_header_color_options';
	$wp_customize->get_control( 'header_textcolor' )->priority 	= '10.5';

	require get_template_directory() . '/inc/customizer-includes/customizer-color-options.php';
	
	//Theme Options
	require get_template_directory() . '/inc/customizer-includes/customizer-theme-options.php';

	// Reset all settings to default
	$wp_customize->add_section( 'create_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'catchbase' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'catchbase' ),
	) );

	$wp_customize->add_setting( 'reset_all_settings', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'create_reset_all_settings',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'reset_all_settings', array(
		'label'    => __( 'Check to reset all settings to default', 'catchbase' ),
		'section'  => 'create_reset_all_settings',
		'settings' => 'reset_all_settings',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end
	

	//Important Links
	class CreateImportantLinks extends WP_Customize_Control {
        public $type = 'important-links'; 
        
        public function render_content() {
        	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
            $important_links = array(
							'theme_instructions' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/theme-instructions/create-pro/' ),
								'text' 	=> __( 'Theme Instructions', 'create' ),
								),
							'support' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/support/' ),
								'text' 	=> __( 'Support', 'create' ),
								),
							'changelog' => array( 
								'link'	=> esc_url( 'http://catchthemes.com/changelogs/create-pro-theme/' ),
								'text' 	=> __( 'Changelog', 'create' ),
								),
							'review' => array( 
								'link'	=> esc_url( 'https://wordpress.org/support/view/theme-reviews/create-pro' ),
								'text' 	=> __( 'Review', 'create' ),
								),
							'facebook' => array( 
								'link'	=> esc_url( 'https://www.facebook.com/catchthemes/' ),
								'text' 	=> __( 'Facebook', 'create' ),
								),
							'twitter' => array( 
								'link'	=> esc_url( 'https://twitter.com/catchthemes/' ),
								'text' 	=> __( 'Twitter', 'create' ),
								),
							'gplus' => array( 
								'link'	=> esc_url( 'https://plus.google.com/+Catchthemes/' ),
								'text' 	=> __( 'Google+', 'create' ),
								),
							'pinterest' => array( 
								'link'	=> esc_url( 'http://www.pinterest.com/catchthemes/' ),
								'text' 	=> __( 'Pinterest', 'create' ),
								),
							);
			foreach ( $important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . $important_link['text'] .' </a></p>';
			}
        }
    }

	$wp_customize->add_section( 'important_links', array(
		'priority' 		=> 999,
		'title'   	 	=> __( 'Important Links', 'create' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'create_sanitize_important_link',
	) );

	$wp_customize->add_control( new CreateImportantLinks( $wp_customize, 'important_links', array(
        'label'   	=> __( 'Important Links', 'create' ),
        'section'  	=> 'important_links',
        'settings' 	=> 'important_links',
        'type'     	=> 'important_links',
    ) ) );  
    //Important Links End

}
add_action( 'customize_register', 'create_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function create_customize_preview_js() {
	wp_enqueue_script( 'create_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
	
	//Flush transients
	create_flush_transients();
}
add_action( 'customize_preview_init', 'create_customize_preview_js' );

/**
 * Sanitizes Checkboxes
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } 
    else {
        return '';
    }
}

/**
 * Sanitizes Custom CSS 
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_sanitize_custom_css( $input ) {
	if ( $input != '' ) { 
        $input = str_replace( '<=', '&lt;=', $input ); 
        
        $input = wp_kses_split( $input, array(), array() ); 
        
        $input = str_replace( '&gt;', '>', $input ); 
        
        $input = strip_tags( $input ); 

        return $input;
 	}
    else {
    	return '';
    }
}

/**
 * Sanitizes post_id in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_sanitize_post_id( $input ) {
    //check if post exists
	if( get_post_status( $input ) ) {
		return $input;
    }
    else {
    	return '';
    }
}


/**
 * Sanitizes and Make options default for font family options
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_reset_typography( $input ) {
    if ( $input == 1 ) {
    	$font_family_options	=	array(
										'title_font',
										'body_font',
										'tagline_font',
										'content_title_font',
										'content_font',
										'headings_font',
										'forms_navigation'
									);

		foreach ( $font_family_options as $font_family_option ) {
			 remove_theme_mod( $font_family_option );
		}

       
    }

    return '';
}

/**
 * Sanitizes footer code
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_sanitize_footer_code( $input ) {
	return ( stripslashes( wp_filter_post_kses( addslashes ( $input ) ) ) );
}

/**
 * Sanitizes and Make options default for footer editor options
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_sanitize_reset_footer_content( $input ) {
    if ( $input == '1' ) {
    	//Reset Footer Editor Options
        set_theme_mod( 'footer_left_content', create_get_default_theme_options( 'footer_left_content' ) );
    	set_theme_mod( 'footer_right_content', create_get_default_theme_options( 'footer_right_content' ) );
    }

    return '';
}

/**
 * Dummy Sanitizaition function as it contains no value to be sanitized
 */
function create_sanitize_important_link() {
	return false;
}

/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since  Create 1.0
 */
function create_reset_all_settings( $input ) {
	if ( $input == 1 ) {
		//Remove all set values
		remove_theme_mods();

        // Flush out all transients	
        create_flush_transients();
    } 
    else {
        return '';
    }
}
