<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Create Pro
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function create_jetpack_setup() {

    $pagination_type    = get_theme_mod( 'pagination_type', create_get_default_theme_options( 'pagination_type' ) );
        
    if ( 'infinite-scroll-scroll' == $pagination_type ) {
        add_theme_support( 'infinite-scroll', array(
            'type'          => 'scroll',
            'container'     => 'main',
            'footer'        => 'colophon',
            'wrapper'       => false,
        ) );
    }
	
    //Check for JetPack logo, if it already has value, support JetPack logo, else don't support it
    $jetpack_logo  = get_option( 'site_logo' );
    
    if ( !empty( $jetpack_logo['id'] ) ){
        add_theme_support( 'site-logo', array( 'size' => 'create-site-logo' ) );
    }
	 
    /**
     * Add theme support for responsive videos.
     */
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'create_jetpack_setup' );