<?php
/**
 * Create functions and definitions
 *
 * @package Create Pro
 */

require_once(get_template_directory() . '/class/Display.php');
require_once(get_template_directory() . '/gh_functions.php');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 650; /* pixels */
}

if ( ! function_exists( 'create_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function create_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Create, use a find and replace
	 * to change 'create' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'create', get_template_directory() . '/languages' );
	
	// Create styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', create_fonts_url() ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	// Set default size.
	set_post_thumbnail_size( 650, 488, true );

    // custom banner size

    add_image_size( 'single-banner', '1024', '9999', false );

    // Add default size for single pages.
	add_image_size( 'create-single', '650', '9999', false );

	// Add default size for homepage.
	add_image_size( 'create-home', '261', '196', true );

	// Add default size for header image for post and page.
	add_image_size( 'create-header', '1024', '350', true );
		
	// Add default logo size for Jetpack.
	add_image_size( 'create-site-logo', '300', '9999', false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu', 'create' ),
		'secondary'	=> __( 'Secondary Menu', 'create' ),
		'social'  	=> __( 'Social Menu', 'create' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support( 'custom-background', apply_filters( 'create_custom_background_args', array(
		'default-color'       => 'f5f5f5',
		'default-attachment'  => 'fixed',
		'default-repeat'      => 'no-repeat',
		'default-image'       => '%s/images/default-background.jpg',
	) ) );

	/**
	 * Setup title support for theme
	 * Supported from WordPress version 4.1 onwards 
	 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 */
	add_theme_support( 'title-tag' );

	// Load up our new theme update notifier
	$update_notifier = get_theme_mod( 'update_notifier', create_get_default_theme_options( 'update_notifier' ) );
	
	if ( $update_notifier ) {
		require( get_template_directory() . '/inc/update-notifier.php' );	
	}
}
endif; // create_setup
add_action( 'after_setup_theme', 'create_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function create_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'create' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'create' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Intro Widget', 'create' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional widget that appears only on your default homepage.', 'create' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	//Optional Sidebar for Hompeage instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Homepage Sidebar', 'create' ),
		'id' 				=> 'sidebar-optional-homepage',
		'description'		=> __( 'This is Optional Sidebar for Homepage', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar for Archive instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Archive Sidebar', 'create' ),
		'id' 				=> 'sidebar-optional-archive',
		'description'		=> __( 'This is Optional Sidebar for Archive', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar for Page instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Page Sidebar', 'create' ),
		'id' 				=> 'sidebar-optional-page',
		'description'		=> __( 'This is Optional Sidebar for Page', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar for Post instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Post Sidebar', 'create' ),
		'id' 				=> 'sidebar-optional-post',
		'description'		=> __( 'This is Optional Sidebar for Post', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar one for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar One', 'create' ),
		'id' 				=> 'sidebar-optional-one',
		'description'		=> __( 'This is Optional Sidebar One', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar two for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Two', 'create' ),
		'id' 				=> 'sidebar-optional-two',
		'description'		=> __( 'This is Optional Sidebar Two', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar Three for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Three', 'create' ),
		'id' 				=> 'sidebar-optional-three',
		'description'		=> __( 'This is Optional Sidebar Three', 'create' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );		
	
	// Registering 404 Error Page Content
	register_sidebar( array(
		'name'					=> __( '404 Page Not Found Content', 'create' ),
		'id' 					=> 'sidebar-notfound',
		'description'			=> __( 'Replaces the default 404 Page Not Found Content', 'create' ),
		'before_widget'			=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'			=> '</aside>',
		'before_title'			=> '<h2 class="widget-title">',
		'after_title'			=> '</h2>',
	) );		

	$footer_sidebar_number = 3; //Number of footer sidebars
	
	for( $i=1; $i <= $footer_sidebar_number; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( __( 'Footer Area %d', 'create' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- #widget-default-search -->',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'description'	=> sprintf( __( 'Footer %d widget area.', 'create' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'create_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function create_scripts() {
	
	// Enqueue masonry	
	wp_enqueue_script( 'masonry');

	// Localize script (only few lines in helpers.js)
    wp_localize_script( 'create-helpers', 'create-vars', array(  
 	    'author'   => __( 'Your Name', 'create' ), 
 	    'email'    => __( 'E-mail', 'create' ),
		'url'      => __( 'Website', 'create' ),
		'comment'  => __( 'Your Comment', 'create' ) 
 	) );	
	
	// Enqueue default style + insert gh-style for additional markup

	wp_enqueue_style( 'google-font-voces', 'http://fonts.googleapis.com/css?family=Voces' );

    wp_enqueue_style( 'create-style', get_stylesheet_uri() );
    wp_enqueue_style( 'gh-style-edits', get_template_directory_uri() . '/css/gh_edit.css' );


    // Google fonts
	wp_enqueue_style( 'create-fonts', create_fonts_url(), array(), '1.0.0' );
	
	//For genericons
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons/genericons.css', false, '3.3' );

    // JS helpers (This is also the place where we call the jQuery in array)
	wp_enqueue_script( 'create-helpers', get_template_directory_uri() . '/js/helpers.js', array( 'jquery' ), '1.0.0', true );

	// Mobile navigation
	wp_enqueue_script( 'create-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );

	// Skip link fix
	wp_enqueue_script( 'create-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Cycle2
	wp_enqueue_script( 'cycle2', 'http://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/20140415/jquery.cycle2.min.js', array('jquery'), '1.0.0' );

	/**
	 * Loads up Scroll Up script
	 */
	$disable_scrollup = get_theme_mod( 'disable_scrollup', create_get_default_theme_options( 'disable_scrollup' ) );
	
	if ( '1' != $disable_scrollup ) { 
		wp_enqueue_script( 'create-scrollup', get_template_directory_uri() . '/js/scrollup.js', array( 'jquery' ), '20141223	', true  );
	}
}
add_action( 'wp_enqueue_scripts', 'create_scripts' );


/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_register_script, wp_enqueue_script, and  wp_enqueue_style
 *
 * @action admin_print_scripts-post-new, admin_print_scripts-post, admin_print_scripts-page-new, admin_print_scripts-page
 *
 * @since Create 1.0
 */
function create_enqueue_metabox_scripts() {
    //Scripts
    wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js' );
	wp_enqueue_script( 'create-metabox', get_template_directory_uri() . '/js/metabox.js', array( 'jquery-ui-tabs', 'jquery-cookie' ), '2013-10-05' );
	
	//CSS Styles
	wp_enqueue_style( 'create-metabox-tabs', get_template_directory_uri() . '/css/metabox-tabs.css' );
}
add_action( 'admin_print_scripts-post-new.php', 'create_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-post.php', 'create_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page-new.php', 'create_enqueue_metabox_scripts', 11 );
add_action( 'admin_print_scripts-page.php', 'create_enqueue_metabox_scripts', 11 );

/**
 * Register Google fonts.
 *
 */
function create_fonts_url() {
	$font_url = '';

	$create_fonts 	= array();	
	$create_fonts[]	= get_theme_mod( 'body_font', create_get_default_theme_options( 'body_font' ) );
	$create_fonts[]	= get_theme_mod( 'title_font', create_get_default_theme_options( 'title_font' ) );
	$create_fonts[]	= get_theme_mod( 'tagline_font', create_get_default_theme_options( 'tagline_font' ) );
	$create_fonts[]	= get_theme_mod( 'content_title_font', create_get_default_theme_options( 'content_title_font' ) );
	$create_fonts[]	= get_theme_mod( 'content_font', create_get_default_theme_options( 'content_font' ) );
	$create_fonts[]	= get_theme_mod( 'headings_font', create_get_default_theme_options( 'headings_font' ) );
	$create_fonts[]	= get_theme_mod( 'forms_navigation', create_get_default_theme_options( 'forms_navigation' ) );

	$web_fonts = array(
		'allan'					=> 'Allan',
		'allerta'				=> 'Allerta',
		'amaranth'				=> 'Amaranth',
		'bitter'				=> 'Bitter',
		'cabin'					=> 'Cabin',
		'cantarell'				=> 'Cantarell',
		'crimson-text'			=> 'Crimson+Text',
		'cuprum'				=> 'Cuprum',
		'dancing-script'		=> 'Dancing+Script',
		'droid-sans'			=> 'Droid+Sans',
		'droid-serif'			=> 'Droid+Serif',
		'exo'					=> 'Exo',
		'exo-2'					=> 'Exo+2',
		'istok-web'				=> 'Istok+Web',
		'josefin-sans'			=> 'Josefin+Sans',
		'lato'					=> 'Lato',
		'lobster'				=> 'Lobster',
		'lora'					=> 'Lora',
		'montserrat'			=> 'Montserrat',
		'nobile'				=> 'Nobile',
		'noto-serif'			=> 'Noto+Serif',
		'neuton'				=> 'Neuton',
		'open-sans'				=> 'Open+Sans',
		'oswald'				=> 'Oswald',
		'patua-one'				=> 'Patua+One',
		'playfair-display'		=> 'Playfair+Display',
		'pt-sans'				=> 'PT+Sans',
		'pt-serif'				=> 'PT+Serif',
		'quattrocento-sans' 	=> 'Quattrocento+Sans',
		'roboto'				=> 'Roboto',
		'roboto-slab'			=> 'Roboto+Slab',
		'source-sans-pro'		=> 'Source+Sans+Pro',
		'ubuntu'				=> 'Ubuntu',
		'varela'				=> 'Varela',
		'yanone-kaffeesatz' 	=> 'Yanone+Kaffeesatz'
	);

	$create_fonts = array_unique( $create_fonts ); // Make the array of fonts unique so that same font is not loaded twice

	$create_fonts = array_intersect( $create_fonts, array_keys( $web_fonts ) ); // Intersect selected fonts and webfonts to only recover fonts that need loading 

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'create' ) ) {
		$web_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

		$i	=	0;
		foreach( $create_fonts as $create_font ) {
			if( $i ) {
				// only set | to $web_fonts_stylesheet from second loop onwards 
				$web_fonts_stylesheet .='|';
			}
			$web_fonts_stylesheet .= $web_fonts[ $create_font ] . ':300,300italic,regular,italic,600,600italic';	
			
			$i = 1;
		}	

		$web_fonts_stylesheet .= '&subset=latin';
	}

	return $web_fonts_stylesheet;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function create_admin_fonts() {
	wp_enqueue_style( 'create-font', create_fonts_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'create_admin_fonts' );




/**
 * Include Default Options for Create
 */
require get_template_directory() . '/inc/default-options.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include metabox options
 */
require get_template_directory() . '/inc/metabox.php';