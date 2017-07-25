<?php

// Register Custom Post Type
function add_resource_post_type() {

    $labels = array(
        'name'                => _x( 'Resources', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Resource', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Resources', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Resource:', 'text_domain' ),
        'all_items'           => __( 'All Resources', 'text_domain' ),
        'view_item'           => __( 'View Resource', 'text_domain' ),
        'add_new_item'        => __( 'Add New Resource', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Resource', 'text_domain' ),
        'update_item'         => __( 'Update Resource', 'text_domain' ),
        'search_items'        => __( 'Search Resource', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'resource', 'text_domain' ),
        'description'         => __( 'Resources for Clients', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'resource', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_resource_post_type', 0 );


function add_engage_post_type() {

    $labels = array(
        'name'                => _x( 'Engage', 'Post Type General Name', 'text_domain' ),
        'singular_name'       => _x( 'Engage', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'           => __( 'Engage', 'text_domain' ),
        'parent_item_colon'   => __( 'Parent Engage:', 'text_domain' ),
        'all_items'           => __( 'All Engages', 'text_domain' ),
        'view_item'           => __( 'View Engage', 'text_domain' ),
        'add_new_item'        => __( 'Add New Engage', 'text_domain' ),
        'add_new'             => __( 'Add New', 'text_domain' ),
        'edit_item'           => __( 'Edit Engage', 'text_domain' ),
        'update_item'         => __( 'Update Engage', 'text_domain' ),
        'search_items'        => __( 'Search Engage', 'text_domain' ),
        'not_found'           => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'               => __( 'engage', 'text_domain' ),
        'description'         => __( 'Engageing with Clients', 'text_domain' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
        'taxonomies'          => array( '' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-book',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'engage', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_engage_post_type', 0 );


// [bartag foo="foo-value"]
function featured_img_sc_function( ) {

    print 'test';
    return 'testing';

}
add_shortcode( 'featured_img', 'featured_img_sc_function' );