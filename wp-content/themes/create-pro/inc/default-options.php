<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Create Pro
 */


/**
 * Returns the default options for create.
 *
 * @since Create 1.0
 */
function create_get_default_theme_options( $parameter = null ) {
	
	$default_theme_options = array(
		//Site Title an Tagline
		'logo'												=> get_template_directory_uri() . '/images/logo.png',
		'logo_alt_text' 									=> '',
		'logo_disable'										=> 1,

		//Header Image
		'enable_featured_header_image'						=> 'disable',
		'featured_header_image_position'					=> 'before-menu',
		'featured_image_size'								=> 'full',
		'featured_header_image_url'							=> home_url( '/ ' ),
		'featured_header_image_alt'							=> '',
		'featured_header_image_base'						=> 0,
		
		//Intro Widget Options
		'enable_intro_widget'								=> 'homepage',

		//Layout
		'homepage_layout'									=> 'no-sidebar-full-width',
		'theme_layout' 										=> 'left-sidebar',
		'content_layout'									=> 'excerpt-featured-image',
		'single_post_image_layout'							=> 'featured-image',

		//Comment Options
		'comment_option'									=> 'use-wordpress-setting',
		'disable_website_field'								=> 0,

		//Custom CSS
		'custom_css'										=> '',

		//Scrollup Options
		'disable_scrollup'									=> 0,
		
		//Excerpt Options
		'excerpt_length'									=> '30',
		'excerpt_more_text'									=> __( '[ . . . ]', 'create' ),
		
		//Pagination Options
		'pagination_type'									=> 'default',

		//Search Options
		'search_text'										=> __( 'Search...', 'create' ),
		
		//Feed Redirect
		'feed_redirect'										=> '',

		//Font Family Options
		'body_font' 										=> 'bitter',
		'title_font' 										=> 'josefin-sans',
		'tagline_font' 										=> 'bitter',
		'content_title_font' 								=> 'bitter',
		'content_font' 										=> 'bitter',
		'headings_font' 									=> 'bitter',
		'forms_navigation'									=> 'varela',
		'reset_typography'									=> 0,

		//Footer Editor Options		
		'footer_left_content'								=> '<span class="site-copyright">' . sprintf( _x( 'Copyright &copy; %1$s %2$s' , '1: Year, 2: Site Title with home URL', 'create' ), date( 'Y' ), '<a href="' . esc_url( home_url( '/' ) ) . '"> ' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' ) . '</span>',
		'footer_right_content'								=> '<span class="theme-name">'. esc_attr( 'Create Pro&nbsp;' ) . sprintf( _x( 'by', 'attribution', 'create' ) ) . '</span>&nbsp;<span class="theme-author"><a href="' . esc_url( 'http://catchthemes.com/' ) . '" target="_blank">' . esc_attr( 'Catch Themes' ) . '</a></span>',
		'reset_footer_content'								=> 0,	

		//Update Notifier
		'update_notifier'									=> 0,

		//Background Color 
		'background_color'									=> '#eee',
		
		//Header Colors
		'header_background_color'							=> '#090401',
		'site_title_color'									=> '#cfa205',
		'site_title_hover_color'							=> '#e7b507',
		'tagline_color'										=> '#cfa205',
		'text_color'										=> '#7a7a7a',
		'link_color'										=> '#9a9a9a',
		'link_hover_color'									=> '#e7b507',
		
		//Conent Colors
		'content_wrapper_background_color'					=> '#fff',
		'content_background_color'							=> '#fff',
		'content_title_color'								=> '#090401',
		'content_title_hover_color'							=> '#e7b507',
		'content_meta_color'								=> '#7a7a7a',
		'content_meta_link_color'							=> '#9a9a9a',
		'content_meta_hover_color'							=> '#e7b507',

		//Social Colors
		'social_menu_background_color'						=> '#e8e8e8',
		'social_icon_color'									=> '#9a9a9a',
		'social_icon_hover_color'							=> '#7b7b7b',
		'social_icon_brand_color'							=> 'disable',
		
		//Sidebar Colors
		'sidebar_background_color'							=> '#fff',
		'sidebar_widget_title_color'						=> '#090401',
		'sidebar_widget_title_hover_color'					=> '#e7b507',
		'sidebar_widget_text_color'							=> '#7a7a7a',
		'widget_link_color'									=> '#9a9a9a',
		'widget_link_hover_color'							=> '#e7b507',

		//Footer Sidebar Colors
		'footer_sidebar_background_color'					=> '#e8e8e8',
		'footer_sidebar_widget_title_color'					=> '#090401',
		'footer_sidebar_widget_title_hover_color'			=> '#e7b507',
		'footer_sidebar_widget_text_color'					=> '#7a7a7a',
		'footer_widget_link_color'							=> '#9a9a9a',
		'footer_widget_link_hover_color'					=> '#e7b507',
		
		//Footer Colors
		'footer_background_color'							=> '#090401',
		'footer_text_color'									=> '#7f7f7f',
		'footer_link_color'									=> '#9a9a9a',
		'footer_link_hover_color'							=> '#e7b507',


		//Reset all settings
		'reset_all_settings'								=> 0,
	);

	if ( null == $parameter ) {
		return apply_filters( 'create_default_theme_options', $default_theme_options );
	}
	else {
		return $default_theme_options[ $parameter ];
	}
}

/**
 * Returns an array of feature header enable options
 *
 * @since Create 1.0
 */
function create_enable_featured_header_image_options() {
	$enable_featured_header_image_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'create' ),
		),
		'exclude-homepage' 		=> array(
			'value'	=> 'exclude-home',
			'label' => __( 'Excluding Homepage', 'create' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'create' ),
		),
		'entire-site-page-post' 	=> array(
			'value' => 'entire-site-page-post',
			'label' => __( 'Entire Site, Page/Post Featured Image', 'create' ),
		),
		'pages-posts' 	=> array(
			'value' => 'pages-posts',
			'label' => __( 'Pages and Posts', 'create' ),
		),
		'disable'		=> array(
			'value' => 'disable',
			'label' => __( 'Disabled', 'create' ),
		),
	);

	return apply_filters( 'create_enable_featured_header_image_options', $enable_featured_header_image_options );
}

/**
 * Returns an array of layout options registered for create.
 *
 * @since Create 1.0
 */
function create_homepage_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}

/**
 * Returns an array of layout options registered for create.
 *
 * @since Create 1.0
 */
function create_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for create.
 *
 * @since Create 1.0
 */
function create_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-featured-image' => array(
			'value' => 'excerpt-featured-image',
			'label' => __( 'Show Excerpt', 'create' ),
		),		
		'full-content' => array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content (No Featured Image)', 'create' ),
		),
	);

	return apply_filters( 'create_get_archive_content_layout', $layout_options );
}

/**
 * Returns an array of feature image size
 *
 * @since Create 1.0
 */
function create_featured_image_size_options() {
	$featured_image_size_options = array(
		'featured-image'		=> array(
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' ),
		),
		'full' 		=> array(
			'value'	=> 'full',
			'label' => __( 'Full Image', 'create' ),
		),
		'large' 	=> array(
			'value' => 'large',
			'label' => __( 'Large Image', 'create' ),
		),
	);

	return apply_filters( 'create_featured_image_size_options', $featured_image_size_options );
}

/**
 * Returns an array of intro widget options
 *
 * @since Create 1.0
 */
function create_intro_widget_options() {
	$create_intro_widget_options = array(
		'homepage' 		=> array(
			'value'	=> 'homepage',
			'label' => __( 'Homepage / Frontpage', 'create' ),
		),
		'exclude-homepage' 		=> array(
			'value'	=> 'exclude-home',
			'label' => __( 'Excluding Homepage', 'create' ),
		),
		'entire-site' 	=> array(
			'value' => 'entire-site',
			'label' => __( 'Entire Site', 'create' ),
		),
		'disable'		=> array(
			'value' => 'disable',
			'label' => __( 'Disabled', 'create' ),
		),
	);

	return apply_filters( 'create_intro_widget_options', $create_intro_widget_options );
}

/**
 * Returns an array of pagination schemes registered for create.
 *
 * @since Create 1.0
 */
function create_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default(Older Posts/Newer Posts)', 'create' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => __( 'Numeric', 'create' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => __( 'Infinite Scroll (Scroll)', 'create' ),
		),
	);

	return apply_filters( 'create_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of content featured image size.
 *
 * @since Create 1.0
 */
function create_single_post_image_layout_options() {
	$single_post_image_layout_options = array(
		'large' => array(
			'value' => 'large',
			'label' => __( 'Large', 'create' ),
		),		
		'full-size' => array(
			'value' => 'full-size',
			'label' => __( 'Full size', 'create' ),
		),
		'featured-image ' => array(
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' ),
		),		
		'disable' => array(
			'value' => 'disable',
			'label' => __( 'Disabled', 'create' ),
		),
	);
	return apply_filters( 'create_single_post_image_layout_options', $single_post_image_layout_options );
}


/**
 * Returns an array of comment options for create.
 *
 * @since Create 1.0
 */
function create_comment_options() {
	$comment_options = array(
		'use-wordpress-setting' => array(
			'value' => 'use-wordpress-setting',
			'label' => __( 'Use WordPress Setting', 'create' ),
		),
		'disable-in-pages' => array(
			'value' => 'disable-in-pages',
			'label' => __( 'Disable in Pages', 'create' ),
		),
		'disable-completely' => array(
			'value' => 'disable-completely',
			'label' => __( 'Disable Completely', 'create' ),
		),
	);

	return apply_filters( 'create_comment_options', $comment_options );
}

/**
 * Returns list of header color options currently supported
 *
 * @since Create 1.0
*/
function create_get_header_color_options() {
	$create_color_options =	array(  
									__( 'Header Background Color', 'create' ),
									__( 'Site Title Color', 'create' ), 
									__( 'Site Title Hover Color', 'create' ), 
									__( 'Tagline Color', 'create' ), 
								);

	return apply_filters( 'create_color_options', $create_color_options );
}

/**
 * Returns list of content color options currently supported
 *
 * @since Create 1.0
*/
function create_get_content_color_options() {
	$create_color_options =	array(  
									__( 'Content Wrapper Background Color', 'create' ), 
								    __( 'Content Background Color', 'create' ), 
								    __( 'Content Title Color', 'create' ), 
								    __( 'Content Title Hover Color', 'create' ), 
								    __( 'Content Meta Color', 'create' ), 
								    __( 'Content Meta Link Color', 'create' ), 
								    __( 'Content Meta Hover Color', 'create' ),
								    __( 'Text Color', 'create' ), 
								    __( 'Link Color', 'create' ),
									__( 'Link Hover Color', 'create' ),
								);

	return apply_filters( 'create_color_options', $create_color_options );
}

/**
 * Returns list of footer sidebar color options currently supported
 *
 * @since Create 1.0
*/
function create_get_social_color_options() {
	$create_color_options =	array(
									__( 'Social Menu Background Color', 'create' ), 
								    __( 'Social Icon Color', 'create' ), 
								    __( 'Social Icon Hover Color', 'create' ), 
								);

	return apply_filters( 'create_color_options', $create_color_options );
}

/**
 * Returns list of footer sidebar color options currently supported
 *
 * @since Create 1.0
*/
function create_get_sidebar_color_options() {
	$create_color_options =	array(
									__( 'Sidebar Background Color', 'create' ), 
								    __( 'Sidebar Widget Title Color', 'create' ), 
								    __( 'Sidebar Widget Title Hover Color', 'create' ), 
								    __( 'Sidebar Widget Text Color', 'create' ),
								    __( 'Widget Link Color', 'create' ),
								    __( 'Widget Link Hover Color', 'create' ),
								);

	return apply_filters( 'create_color_options', $create_color_options );
}

/**
 * Returns list of footer sidebar color options currently supported
 *
 * @since Create 1.0
*/
function create_get_footer_sidebar_color_options() {
	$create_color_options =	array(
									__( 'Footer Sidebar Background Color', 'create' ), 
								    __( 'Footer Sidebar Widget Title Color', 'create' ), 
								    __( 'Footer Sidebar Widget Title Hover Color', 'create' ), 
								    __( 'Footer Sidebar Widget Text Color', 'create' ),
								    __( 'Footer Widget Link Color', 'create' ),
								    __( 'Footer Widget Link Hover Color', 'create' ),
								);

	return apply_filters( 'create_color_options', $create_color_options );
}

/**
 * Returns list of footer color options currently supported
 *
 * @since Create 1.0
*/
function create_get_footer_color_options() {
	$create_color_options =	array(
									__( 'Footer Background Color', 'create' ), 
								    __( 'Footer Text Color', 'create' ), 
								    __( 'Footer Link Color', 'create' ), 
								    __( 'Footer Link hover color', 'create' ), 
								);

	return apply_filters( 'create_color_options', $create_color_options );
}


/**
 * Returns an array of avaliable fonts registered for create
 *
 * @since Create 1.2
 */
function create_avaliable_fonts() {
	$avaliable_fonts = array(
		'arial-black' => array(
			'value' => 'arial-black',
			'label' => '"Arial Black", Gadget, sans-serif',
		),
		'allan' => array(
			'value' => 'allan',
			'label' => '"Allan", sans-serif',
		),
		'allerta' => array(
			'value' => 'allerta',
			'label' => '"Allerta", sans-serif',
		),
		'amaranth' => array(
			'value' => 'amaranth',
			'label' => '"Amaranth", sans-serif',
		),
		'arial' => array(
			'value' => 'arial',
			'label' => 'Arial, Helvetica, sans-serif',
		),
		'bitter' => array(
			'value' => 'bitter',
			'label' => '"Bitter", sans-serif',
		),
		'cabin' => array(
			'value' => 'cabin',
			'label' => '"Cabin", sans-serif',
		),
		'cantarell' => array(
			'value' => 'cantarell',
			'label' => '"Cantarell", sans-serif',
		),
		'century-gothic' => array(
			'value' => 'century-gothic',
			'label' => '"Century Gothic", sans-serif',
		),
		'courier-new' => array(
			'value' => 'courier-new',
			'label' => '"Courier New", Courier, monospace',
		),
		'crimson-text' => array(
			'value' => 'crimson-text',
			'label' => '"Crimson Text", sans-serif',
		),
		'cuprum' => array(
			'value' => 'cuprum',
			'label' => '"Cuprum", sans-serif',
		),
		'dancing-script' => array(
			'value' => 'dancing-script',
			'label' => '"Dancing Script", sans-serif',
		),
		'droid-sans' => array(
			'value' => 'droid-sans',
			'label' => '"Droid Sans", sans-serif',
		),
		'droid-serif' => array(
			'value' => 'droid-serif',
			'label' => '"Droid Serif", sans-serif',
		),
		'exo' => array(
			'value' => 'exo',
			'label' => '"Exo", sans-serif',
		),	
		'exo-2' => array(
			'value' => 'exo-2',
			'label' => '"Exo 2", sans-serif',
		),				
		'georgia' => array(
			'value' => 'georgia',
			'label' => 'Georgia, "Times New Roman", Times, serif',
		),
		'helvetica' => array(
			'value' => 'helvetica',
			'label' => 'Helvetica, "Helvetica Neue", Arial, sans-serif',
		),
		'helvetica-neue' => array(
			'value' => 'helvetica-neue',
			'label' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
		),
		'istok-web' => array(
			'value' => 'istok-web',
			'label' => '"Istok Web", sans-serif',
		),
		'impact' => array(
			'value' => 'impact',
			'label' => 'Impact, Charcoal, sans-serif',
		),
		'josefin-sans' => array(
			'value' => 'josefin-sans',
			'label' => '"Josefin Sans", sans-serif',
		),
		'lato' => array(
			'value' => 'lato',
			'label' => '"Lato", sans-serif',
		),
		'lucida-sans-unicode' => array(
			'value' => 'lucida-sans-unicode',
			'label' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		),
		'lucida-grande' => array(
			'value' => 'lucida-grande',
			'label' => '"Lucida Grande", "Lucida Sans Unicode", sans-serif',
		),
		'lobster' => array(
			'value' => 'lobster',
			'label' => '"Lobster", sans-serif',
		),
		'lora' => array(
			'value' => 'lora',
			'label' => '"Lora", serif',
		),
		'monaco' => array(
			'value' => 'monaco',
			'label' => 'Monaco, Consolas, "Lucida Console", monospace, sans-serif',
		),
		'montserrat' => array(
			'value' => 'montserrat',
			'label' => '"Montserrat", sans-serif',
		),
		'nobile' => array(
			'value' => 'nobile',
			'label' => '"Nobile", sans-serif',
		),
		'noto-serif' => array(
			'value' => 'noto-serif',
			'label' => '"Noto Serif", serif',
		),
		'neuton' => array(
			'value' => 'neuton',
			'label' => '"Neuton", serif',
		),
		'open-sans' => array(
			'value' => 'open-sans',
			'label' => '"Open Sans", sans-serif',
		),
		'oswald' => array(
			'value' => 'oswald',
			'label' => '"Oswald", sans-serif',
		),
		'palatino' => array(
			'value' => 'palatino',
			'label' => 'Palatino, "Palatino Linotype", "Book Antiqua", serif',
		),
		'patua-one' => array(
			'value' => 'patua-one',
			'label' => '"Patua One", sans-serif',
		),
		'playfair-display' => array(
			'value' => 'playfair-display',
			'label' => '"Playfair Display", sans-serif',
		),
		'pt-sans' => array(
			'value' => 'pt-sans',
			'label' => '"PT Sans", sans-serif',
		),
		'pt-serif' => array(
			'value' => 'pt-serif',
			'label' => '"PT Serif", serif',
		),
		'quattrocento-sans' => array(
			'value' => 'quattrocento-sans',
			'label' => '"Quattrocento Sans", sans-serif',
		),
		'roboto' => array(
			'value' => 'roboto',
			'label' => '"Roboto", sans-serif',
		),
		'roboto-slab' => array(
			'value' => 'roboto-slab',
			'label' => '"Roboto Slab", serif',
		),
		'sans-serif' => array(
			'value' => 'sans-serif',
			'label' => 'Sans Serif, Arial',
		),
		'source-sans-pro' => array(
			'value' => 'source-sans-pro',
			'label' => '"Source Sans Pro", sans-serif',
		),
		'tahoma' => array(
			'value' => 'tahoma',
			'label' => 'Tahoma, Geneva, sans-serif',
		),
		'trebuchet-ms' => array(
			'value' => 'trebuchet-ms',
			'label' => '"Trebuchet MS", "Helvetica", sans-serif',
		),
		'times-new-roman' => array(
			'value' => 'times-new-roman',
			'label' => '"Times New Roman", Times, serif',
		),
		'ubuntu' => array(
			'value' => 'ubuntu',
			'label' => '"Ubuntu", sans-serif',
		),
		'varela' => array(
			'value' => 'varela',
			'label' => '"Varela", sans-serif',
		),
		'verdana' => array(
			'value' => 'verdana',
			'label' => 'Verdana, Geneva, sans-serif',
		),
		'yanone-kaffeesatz' => array(
			'value' => 'yanone-kaffeesatz',
			'label' => '"Yanone Kaffeesatz", sans-serif',
		),
	);

	return apply_filters( 'create_avaliable_fonts', $avaliable_fonts );
}


/**
 * Returns an array of metabox layout options registered for create.
 *
 * @since Create 1.0
 */
function create_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'create-layout-option',
			'value' => 'default',
			'label' => __( 'Default', 'create' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'create-layout-option',
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'create' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'create-layout-option',
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'create' ),
		),
		'no-sidebar-full-width' => array(
			'id' 	=> 'create-layout-option',
			'value' => 'no-sidebar-full-width',
			'label' => __( 'No Sidebar ( Full Width )', 'create' ),
		),
	);
	return apply_filters( 'create_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for create.
 *
 * @since Create 1.0
 */
function create_metabox_header_featured_image_options() {
	$header_featured_image_options = array(
		'default' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'default',
			'label' 	=> __( 'Default', 'create' ),
		),
		'enable' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'enable',
			'label' 	=> __( 'Enable', 'create' ),
		),	
		'disable' => array(
			'id'		=> 'create-header-image',
			'value' 	=> 'disable',
			'label' 	=> __( 'Disable', 'create' )
		)
	);
	return apply_filters( 'header_featured_image_options', $header_featured_image_options );
}


/**
 * Returns an array of metabox sidebar options registered for create.
 *
 * @since Create 1.0
 */
function create_metabox_sidebar_options() {
	$sidebar_options = array(
		'main-sidebar' => array(
			'id'		=> 'create-sidebar-options',
			'value' 	=> 'default-sidebar',
			'label' 	=> __( 'Default Sidebar', 'create' )
		),
		'optional-sidebar-one' => array(
			'id' 	=> 'create-sidebar-options',
			'value' => 'optional-sidebar-one',
			'label' => __( 'Optional Sidebar One', 'create' )
		),
		'optional-sidebar-two' => array(
			'id' 	=> 'create-sidebar-options',
			'value' => 'optional-sidebar-two',
			'label' => __( 'Optional Sidebar Two', 'create' )
		),
		'optional-sidebar-three' => array(
			'id' 	=> 'create-sidebar-options',
			'value' => 'optional-sidebar-three',
			'label' => __( 'Optional Sidebar three', 'create' )
		)
	);
	return apply_filters( 'sidebar_options', $sidebar_options );
}


/**
 * Returns an array of metabox featured image options registered for create.
 *
 * @since Create 1.0
 */
function create_metabox_featured_image_options() {
	$featured_image_options = array(
		'default' => array(
			'id'	=> 'create-featured-image',
			'value' => 'default',
			'label' => __( 'Default', 'create' ),
		),							   
		'large' => array(
			'id'	=> 'create-featured-image',
			'value' => 'large',
			'label' => __( 'Large', 'create' )
		),
		'full-size' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'full',
			'label' => __( 'Full Size', 'create' )
		),
		'featured-image' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'featured-image',
			'label' => __( 'Featured Image', 'create' )
		),
		'disable' => array(
			'id' 	=> 'create-featured-image',
			'value' => 'disable',
			'label' => __( 'Disable Image', 'create' )
		)
	);
	return apply_filters( 'featured_image_options', $featured_image_options );
}