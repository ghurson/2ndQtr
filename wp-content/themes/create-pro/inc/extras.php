<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Create Pro
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function create_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'create_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function create_body_classes( $classes ) {
	// #1 Adds a class of group-blog to blogs with more than 1 published author.
	// #2 Adds a class of masonry home.php only.
    // #3 Adds a class of content-area-full when widget is not in use.

    global $post;

	$default_layout 	= get_theme_mod( 'theme_layout', create_get_default_theme_options( 'theme_layout' ) );


	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( is_singular() ) {
 		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			
			$layout = get_post_meta( $parent,'create-layout-option', true );
		} else {
			$layout = get_post_meta( $post->ID,'create-layout-option', true ); 
		}
	}

	//Default layout for singular: post, page, attachment
	if ( is_singular() ) {
		if ( 'default' == $layout ) {
			$classes[] = $default_layout;
		}
		else {
			$classes[] = $layout;
		}
	}

	//Masonry and default layout for archive only
    if ( is_archive() && !is_home() ) {
    	if ( 'no-sidebar-full-width' == $default_layout ) {
	    	$classes[] = 'create-masonry';
	    	$classes[] = 'no-sidebar-full-width';
	    }
	    else {
	    	$classes[] = $default_layout;
	    }
    }
	
    //Masonry and homepage layout for homepage
    if ( is_home() && is_front_page() ) {
		$homepage_layout 	= get_theme_mod( 'homepage_layout', create_get_default_theme_options( 'homepage_layout' ) );
 		if ( 'no-sidebar-full-width' == $homepage_layout ) {
			$classes[] = 'create-masonry';
			$classes[] = 'no-sidebar-full-width';
		}
		else {
	    	$classes[] = $homepage_layout;
	    }
    }

    //Social Icon's Brand Color Options 
    $social_icon_brand_color 	= get_theme_mod( 'social_icon_brand_color', create_get_default_theme_options( 'social_icon_brand_color' ) );
    if( 'hover' == $social_icon_brand_color ) {
		$classes[] = 'social-brand-hover';	
	}
	elseif( 'hover-static' == $social_icon_brand_color ) {
		$classes[] = 'social-brand-static';
	}  

	return $classes;
}
add_filter( 'body_class', 'create_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	* Filters wp_title to print a neat <title> tag based on what is being viewed.
	*
	* @param string $title Default title text for current view.
	* @param string $sep Optional separator.
	* @return string The filtered title.
	*/
	function create_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}
		
		global $page, $paged;
		
		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );
		
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		
		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
		}
		
		return $title;
		
	}
		
	add_filter( 'wp_title', 'create_wp_title', 10, 2 );
	
	/**
	* Title shim for sites older than WordPress 4.1.
	*
	* @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	* @todo Remove this function when WordPress 4.3 is released.
	*/
	function create_render_title() {
	?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
	}
	add_action( 'wp_head', 'create_render_title' );
endif;

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function create_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'create_setup_author' );


/**
 * Create is using [...] string in the excerpt.
 */
function create_excerpt_more( $more ) {
	return '<span class="more-dots"><a href="'. get_permalink( get_the_ID() ) . '">[ . . . ]</span>' . '</a>';
}
add_filter( 'excerpt_more', 'create_excerpt_more' );

if ( ! function_exists( 'create_sidebar' ) ) :
/**
 * End Content wrap
 *
 * @since Create 0.2
 */
function create_sidebar() { 
	get_sidebar();
}
endif; //create_sidebar
add_action( 'create_before_footer', 'create_sidebar', 10 );

if ( ! function_exists( 'create_content_end' ) ) :
/**
 * End Content wrap
 *
 * @since Create 0.2
 */
function create_content_end() { ?>
	</div><!-- #content -->
<?php
}
endif; //create_content_end
add_action( 'create_before_footer', 'create_content_end', 20 );

if ( ! function_exists( 'create_footer_start' ) ) :
/**
 * Start Footer wrap
 *
 * @since Create 0.2
 */
function create_footer_start() { ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
<?php
}
endif; //create_footer_start
add_action( 'create_footer', 'create_footer_start', 10 );

if ( ! function_exists( 'create_footer_sidebar' ) ) :
/**
 * Start Footer wrap
 *
 * @since Create 0.2
 */
function create_footer_sidebar() { 
	get_sidebar( 'footer' );
}
endif; //create_footer_sidebar
add_action( 'create_footer', 'create_footer_sidebar', 20 );

if ( ! function_exists( 'create_footer_end' ) ) :
/**
 * End Footer wrap
 *
 * @since Create 0.2
 */
function create_footer_end() { ?>
	</footer><!-- #colophon -->
<?php
}
endif; //create_footer_end
add_action( 'create_footer', 'create_footer_end', 50 );

if ( ! function_exists( 'create_page_end' ) ) :
/**
 * End Page wrap
 *
 * @since Create 0.2
 */
function create_page_end() { ?>
	</div><!-- #page -->
<?php
}
endif; //create_page_end
add_action( 'create_footer', 'create_page_end', 100 );

if ( ! function_exists( 'create_copyright' ) ) :
/**
* Powered by Text
*
* @since Create 0.2
*/
function create_copyright() { 
	return get_theme_mod( 'footer_left_content', create_get_default_theme_options( 'footer_left_content' ) );
}
endif; //create_copyright


if ( ! function_exists( 'create_seperator' ) ) :
/**
 * Seperator
 *
 * @since Create 0.2
 */
function create_seperator() { 
	if ( '' == create_copyright() ||  '' == create_profile() ) {
			return;
	}
	?>
	<span class="sep"><?php echo esc_attr( '&nbsp;&bull;&nbsp;' ); ?></span>
	<?php
}
endif; //create_seperator

/**
 * Profile
 *
 * @since Create 0.2
 */
function create_profile() { 
	return get_theme_mod( 'footer_right_content', create_get_default_theme_options( 'footer_right_content' ) );
}

/**
 * Footer Information
 *
 * @since Create 0.2
 */
function create_footer_info() { ?>
	<div class="site-info">
		<?php echo wp_kses_post( create_copyright() ); ?>
		<?php create_seperator(); ?>
		<?php echo wp_kses_post( create_profile() ); ?>
	</div><!-- .site-info -->
	
<?php 
}
// Load footer content in  create_footer hook 
add_action( 'create_footer', 'create_footer_info', 30 );

/**
 * Flush out all transients
 *
 * @uses delete_transient 
 * 
 * @action customize_save, create_customize_preview (see create_customizer function: create_customize_preview)
 * 
 * @since  Create 1.0
 */
function create_flush_transients(){
	delete_transient( 'create_favicon' );

	delete_transient( 'create_webclip' );

	delete_transient( 'create_custom_css' );

	delete_transient( 'create_footer_content' );

	delete_transient( 'create_scrollup' );

	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'create_flush_transients' );

if ( ! function_exists( 'create_display_logo' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @get logo from options
	 * 
	 * @display logo	
	 *
	 * @since Create 1.0
	 */
	function create_display_logo() {
		$logo 		= get_theme_mod( 'logo', create_get_default_theme_options( 'logo' ) );

		$logo_alt 	= get_theme_mod( 'logo_alt_text', create_get_default_theme_options( 'logo_alt_text' ) );
		if ( '' != $logo_alt ) {
			$logo_alt_text = $logo_alt;
		}
		else {
			$logo_alt_text = get_bloginfo( 'name', 'display' );
		}

		//Checking Logo
		if ( '' != $logo ) {
			echo '
			<a rel="home" class="site-logo-link" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">
				<img data-size="create-logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr(  $logo_alt_text ). '" class="site-logo attachment-create-logo">
			</a><!-- #site-logo -->';
		}
	}
endif; // create_display_logo

if ( ! function_exists( 'create_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action create_comment_section
	 *
	 * @since Create 1.0
	 */
	function create_get_comment_section() {

        // switched off by gh. we could add in conditions for it's release

        return false;

		$comment_option = get_theme_mod( 'comment_option', create_get_default_theme_options( 'comment_option' ) ); 

		if ( 'use-wordpress-setting' == $comment_option ) {
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
		else if ( 'disable-in-pages' == $comment_option ) {
			if( ! is_page() )
				if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
}
endif;
add_action( 'create_comment_section', 'create_get_comment_section', 10 );

if ( ! function_exists( 'create_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since Create 1.0 
	 */
	function create_comment_form_fields( $fields ) {
		// get data value from theme options
	    $disableurl = get_theme_mod( 'disable_website_field', create_get_default_theme_options( 'disable_website_field' ) ); 
		if ( isset( $fields['url'] ) && $disableurl == '1' ) {
			unset( $fields['url'] );
		}

		return $fields;

	}
endif; //create_comment_form_fields
add_filter( 'comment_form_default_fields', 'create_comment_form_fields' );

if ( ! function_exists( 'create_custom_css' ) ) :
	/**
	 * Enqueue Custon CSS
	 *
	 * @uses  set_transient, wp_head, wp_enqueue_style
	 *
	 * @action wp_enqueue_scripts
	 * 
	 * @since Create 1.0
	 */
	function create_custom_css() {
		//create_flush_transients();	
		
		if ( ( !$create_custom_css = get_transient( 'create_custom_css' ) ) ) {		
			$defaults 				= create_get_default_theme_options(); 

			$options['custom_css'] 	= get_theme_mod( 'custom_css', $defaults['custom_css'] );

			$options['background_color'] = get_theme_mod( 'background_color', $defaults['background_color'] );
			
			//Cackground Color Options
			if( $defaults[ 'background_color' ] != $options[ 'background_color' ] ) {
				$create_custom_css	.=  "body { background-color: ".  $options[ 'background_color' ] ."; }". "\n";
			}
			
			echo '<!-- refreshing cache -->' . "\n";
			
			$create_custom_css ='';

			//Get Header Color Options and Display Custom Css for it
			$create_color_options	=	create_get_header_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( $defaults[ 'header_background_color' ] != $options[ 'header_background_color' ] ) {
				$create_custom_css	.=  ".site-banner { background-color: ".  $options[ 'header_background_color' ] ."; }". "\n";
			}

			if( $defaults[ 'site_title_color' ] != $options[ 'site_title_color' ] ) {
				$create_custom_css	.=  ".site-title a { color: ".  $options[ 'site_title_color' ] ."; }". "\n";
			}
			
			if( $defaults[ 'site_title_hover_color' ] != $options[ 'site_title_hover_color' ] ) {
				$create_custom_css	.=  ".site-title a:hover { color: ".  $options[ 'site_title_hover_color' ] ."; }". "\n";
			}
			
			if( $defaults[ 'tagline_color' ] != $options[ 'tagline_color' ] ) {
				$create_custom_css	.=  ".site-description { color: ".  $options[ 'tagline_color' ] ."; }". "\n";
			}
			//End Header Color Options

			//Get Content Color Options and Display Custom Css for it
			$create_color_options	=	create_get_content_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( $defaults[ 'content_wrapper_background_color' ] != $options[ 'content_wrapper_background_color' ] ) {
				$create_custom_css	.=  "#content { background-color: ".  $options[ 'content_wrapper_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_background_color' ] != $options[ 'content_background_color' ] ) {
				$create_custom_css	.=  "#primary { background-color: ".  $options[ 'content_background_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_title_color' ] != $options[ 'content_title_color' ] ) {
				$create_custom_css	.=  ".page-title, #main .entry-title, #main .entry-title a { color: ".  $options[ 'content_title_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_title_hover_color' ] != $options[ 'content_title_hover_color' ] ) {
				$create_custom_css	.=  "#main .entry-title a:hover { color: ".  $options[ 'content_title_hover_color' ] ."; }". "\n";
			}

			if( $defaults[ 'content_meta_color' ] != $options[ 'content_meta_color' ] ) {
				$create_custom_css	.=  "#main .entry-meta { color: ".  $options[ 'content_meta_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_meta_link_color' ] != $options[ 'content_meta_link_color' ] ) {
				$create_custom_css	.=  "#main .entry-meta a { color: ".  $options[ 'content_meta_link_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'content_meta_hover_color' ] != $options[ 'content_meta_hover_color' ] ) {
				$create_custom_css	.=  "#main .entry-meta a:hover { color: ".  $options[ 'content_meta_hover_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'text_color' ] != $options[ 'text_color' ] ) {
				$create_custom_css	.=  "body { color: ".  $options[ 'text_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'link_color' ] != $options[ 'link_color' ] ) {
				$create_custom_css	.=  "a { color: ".  $options[ 'link_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'link_hover_color' ] != $options[ 'link_hover_color' ] ) {
				$create_custom_css	.=  "a:hover, a:focus, a:active { color: ".  $options[ 'link_hover_color' ] ."; }". "\n";	
			}
			//Content Color Options End

			//Get Social Color Options and Display Custom Css for it
			$create_color_options	=	create_get_social_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( $defaults[ 'social_menu_background_color' ] != $options[ 'social_menu_background_color' ] ) {
				$create_custom_css	.=  ".social-menu { background-color: ".  $options[ 'social_menu_background_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'social_icon_color' ] != $options[ 'social_icon_color' ] ) {
				$create_custom_css	.=  ".social-menu ul a { border-color: ".  $options[ 'social_icon_color' ] ."; color: ".  $options[ 'social_icon_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'social_icon_hover_color' ] != $options[ 'social_icon_hover_color' ] ) {
				$create_custom_css	.=  ".social-menu ul a:hover { border-color: ".  $options[ 'social_icon_hover_color' ] ."; color: ".  $options[ 'social_icon_hover_color' ] ."; }". "\n";	
			}
			//Social Color Options End

			//Get Sidebar Color Options and Display Custom Css for it
			$create_color_options	=	create_get_sidebar_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( $defaults[ 'sidebar_background_color' ] != $options[ 'sidebar_background_color' ] ) {
				$create_custom_css	.=  "#secondary { background-color: ".  $options[ 'sidebar_background_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'sidebar_widget_title_color' ] != $options[ 'sidebar_widget_title_color' ] ) {
				$create_custom_css	.=  "#secondary .widget-title, #secondary .widget-title a { color: ".  $options[ 'sidebar_widget_title_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'sidebar_widget_title_hover_color' ] != $options[ 'sidebar_widget_title_hover_color' ] ) {
				$create_custom_css	.=  "#secondary .widget-title a:hover { color: ".  $options[ 'sidebar_widget_title_hover_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'sidebar_widget_text_color' ] != $options[ 'sidebar_widget_text_color' ] ) {
				$create_custom_css	.=  "#secondary .widget { color: ".  $options[ 'sidebar_widget_text_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'widget_link_color' ] != $options[ 'widget_link_color' ] ) {
				$create_custom_css	.=  "#secondary .widget a { color: ".  $options[ 'widget_link_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'widget_link_hover_color' ] != $options[ 'widget_link_hover_color' ] ) {
				$create_custom_css	.=  "#secondary .widget a:hover, #secondary .widget a:focus, #secondary .widget a:active  { color: ".  $options[ 'widget_link_hover_color' ] ."; }". "\n";	
			}
			//Sidebar Color Options End

			//Get Footer Sidebar Color Options and Display Custom Css for it
			$create_color_options	=	create_get_footer_sidebar_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( $defaults[ 'footer_sidebar_background_color' ] != $options[ 'footer_sidebar_background_color' ] ) {
				$create_custom_css	.=  "#supplementary { background-color: ".  $options[ 'footer_sidebar_background_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_sidebar_widget_title_color' ] != $options[ 'footer_sidebar_widget_title_color' ] ) {
				$create_custom_css	.=  "#supplementary .widget-title, #supplementary .widget-title a { color: ".  $options[ 'footer_sidebar_widget_title_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_sidebar_widget_title_hover_color' ] != $options[ 'footer_sidebar_widget_title_hover_color' ] ) {
				$create_custom_css	.=  "#supplementary .widget-title a:hover { color: ".  $options[ 'footer_sidebar_widget_title_hover_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_sidebar_widget_text_color' ] != $options[ 'footer_sidebar_widget_text_color' ] ) {
				$create_custom_css	.=  "#supplementary .widget { color: ".  $options[ 'footer_sidebar_widget_text_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_widget_link_color' ] != $options[ 'footer_widget_link_color' ] ) {
				$create_custom_css	.=  "#supplementary .widget a { color: ".  $options[ 'footer_widget_link_color' ] ."; }". "\n";	
			}

			if( $defaults[ 'footer_widget_link_hover_color' ] != $options[ 'footer_widget_link_hover_color' ] ) {
				$create_custom_css	.=  "#supplementary .widget a:hover, #supplementary .widget a:focus, #supplementary .widget a:active { color: ".  $options[ 'footer_widget_link_hover_color' ] ."; }". "\n";	
			}
			//Footer Sidebar Color Options End

			//Get Footer Color Options and Display Custom Css for it
			$create_color_options	=	create_get_footer_color_options();

			foreach ( $create_color_options as $color_option ) {
				$lower_color_option				= str_replace( ' ', '_', strtolower( $color_option ) );
				
				$options[ $lower_color_option ] = get_theme_mod( $lower_color_option, $defaults[ $lower_color_option ] );
			}

			if( ( $defaults[ 'footer_background_color' ] != $options[ 'footer_background_color' ] ) || ( $defaults[ 'footer_text_color' ] != $options[ 'footer_text_color' ] ) ) {
				$create_custom_css	.=  ".site-info { background-color: ".  $options[ 'footer_background_color' ] ."; color: ".  $options[ 'footer_text_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_link_color' ] != $options[ 'footer_link_color' ] ) {
				$create_custom_css	.=  ".site-info a { color: ".  $options[ 'footer_link_color' ] ."; }". "\n";	
			}
			
			if( $defaults[ 'footer_link_hover_color' ] != $options[ 'footer_link_hover_color' ] ) {
				$create_custom_css	.=  ".site-info a:hover, .site-info a:focus, .site-info a:active { color: ".  $options[ 'footer_link_hover_color' ] ."; }". "\n";	
			}
			//Footer Color Options End

			// Typography (Font Family) Options
			$font_family_options	=	array(
										'title_font',
										'body_font',
										'tagline_font',
										'content_title_font',
										'content_font',
										'headings_font',
										'forms_navigation'
									);

			$fonts 		= create_avaliable_fonts();

			foreach ( $font_family_options as $font_family_option ) {
				$options[ $font_family_option ] 	= get_theme_mod(  $font_family_option, $defaults[  $font_family_option ] );
			}		

			if( $defaults[ 'body_font' ] != $options[ 'body_font' ] ) {
				$create_custom_css	.=  "body { font-family: ". $fonts [ $options[ 'body_font' ] ] [ 'label' ] ."; }". "\n";
			}

			if( $defaults[ 'title_font' ] != $options[ 'title_font' ] ) {
				$create_custom_css	.=  ".site-title { font-family: ". $fonts [ $options[ 'title_font' ] ] [ 'label' ] ."; }". "\n";
			}	
			if( $defaults[ 'tagline_font' ] != $options[ 'tagline_font' ] ) {
				$create_custom_css	.=  ".site-description { font-family: ". $fonts [ $options[ 'tagline_font' ] ] [ 'label' ] ."; }". "\n";
			}	
			if( $defaults[ 'content_title_font' ] != $options[ 'content_title_font' ] ) {
				$create_custom_css	.=  "#main .entry-title { font-family: ". $fonts [ $options[ 'content_title_font' ] ] [ 'label' ] ."; }". "\n";
			}
			if( $defaults[ 'content_font' ] != $options[ 'content_font' ] ) {
				$create_custom_css	.=  "#main { font-family: ". $fonts [ $options[ 'content_font' ] ] [ 'label' ] ."; }". "\n";
			}	
			if( $defaults[ 'headings_font' ] != $options[ 'headings_font' ] ) {
				$create_custom_css	.=  "h1, h2, h3, h4, h5, h6 { font-family: ". $fonts [ $options[ 'headings_font' ] ] [ 'label' ] ."; }". "\n";
			}
			if( $defaults[ 'forms_navigation' ] != $options[ 'forms_navigation' ] ) {
				$create_custom_css	.=  ".create-menu a, .navigation, button, .button, select, textarea, .site input { font-family: ". $fonts [ $options[ 'forms_navigation' ] ] [ 'label' ] ."; }". "\n";
			}

			//Custom CSS Option		
			if( !empty( $options[ 'custom_css' ] ) ) {
				$create_custom_css	.=  $options[ 'custom_css'] . "\n";
			}

			if ( '' != $create_custom_css ){
				echo '<!-- refreshing cache -->' . "\n";
				
				$create_custom_css = '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n" . $create_custom_css;
			
				$create_custom_css .= '</style>' . "\n";			
			}
		}
		
		echo $create_custom_css;
	}
endif; //create_custom_css
add_action( 'wp_head', 'create_custom_css', 101  );

if ( ! function_exists( 'create_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Create 1.0
	 */
	function create_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$length	= get_theme_mod( 'excerpt_length', create_get_default_theme_options( 'excerpt_length' ) );
		return $length;
	}
endif; //create_excerpt_length
add_filter( 'excerpt_length', 'create_excerpt_length', 999 );


if ( ! function_exists( 'create_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Create 1.0
	 */
	function create_continue_reading() {
		// Getting data from Customizer Options
		$more_tag_text	= get_theme_mod( 'excerpt_more_text', create_get_default_theme_options( 'excerpt_more_text' ) );
		
		return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' .  sprintf( __( '%s', 'create' ) , $more_tag_text ) . '</a>';
	}
endif; //create_continue_reading
add_filter( 'excerpt_more', 'create_continue_reading' );

if ( ! function_exists( 'create_rss_redirect' ) ) :
	/**
	 * Redirect WordPress Feeds To FeedBurner
	 *
	 * @action template_redirect
	 *
	 * @since Create 1.0
	 */
	function create_rss_redirect() {
	    if ( $feed_redirect	= get_theme_mod( 'feed_redirect' ) ) {
			$url = 'Location: '.$feed_redirect;
			if ( is_feed() && !preg_match('/feedburner|feedvalidator/i', $_SERVER['HTTP_USER_AGENT']))
			{
				header( esc_url( $url ) );
				header('HTTP/1.1 302 Temporary Redirect');
			}
		}
	}
endif; //create_rss_redirect
add_action( 'template_redirect', 'create_rss_redirect' );

if ( ! function_exists( 'create_favicon' ) ) :
	/**
	 * Get the favicon Image options
	 *
	 * @uses favicon 
	 * @get the data value of image from options
	 * @display favicon
	 *
	 * @uses set_transient
	 *
	 * @action wp_head, admin_head
	 *
	 * @since Create 1.0
	 */
	function create_favicon() {
		if( ( !$create_favicon = get_transient( 'create_favicon' ) ) ) {
			if ( $favicon = get_theme_mod( 'favicon' ) ) {
				echo '<!-- refreshing cache -->';
				
				// if not empty fav_icon on options
				$create_favicon = '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
			}

			set_transient( 'create_favicon', $create_favicon, 86940 );	
		}
		echo $create_favicon ;	
	}
endif; //create_favicon
//Load Favicon in Header Section
add_action( 'wp_head', 'create_favicon' );
//Load Favicon in Admin Section
add_action( 'admin_head', 'create_favicon' );


if ( ! function_exists( 'create_web_clip' ) ) :
	/**
	 * Get the Web Clip Icon Image from options
	 *
	 * @uses web_clip and remove_web_clip 
	 * @get the data value of image from theme options
	 * @display web clip
	 *
	 * @uses default Web Click Icon if web_clip field on theme options is empty
	 *
	 * @uses set_transient and delete_transient 
	 *
	 * @action wp_head
	 *
	 * @since Create 1.0
	 */
	function create_web_clip() {
		if( ( !$create_web_clip = get_transient( 'create_web_clip' ) ) ) {
			if ( $web_clip = get_theme_mod( 'web_clip' ) ) {
				echo '<!-- refreshing cache -->';
				
				$create_web_clip = '<link rel="apple-touch-icon-precomposed" href="'.esc_url( $create_web_clip ).'" />'; 	
			}
			
			set_transient( 'create_web_clip', $create_web_clip, 86940 );	
		}	
		echo $create_web_clip ;	
	}
endif; //create_web_clip
//Load Create Icon in Header Section
add_action('wp_head', 'create_web_clip');


if ( ! function_exists( 'create_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own create_archive_content_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_archive_content_image() {
		$featured_image = get_theme_mod( 'content_layout', create_get_default_theme_options( 'content_layout' ) );
		
		if ( has_post_thumbnail() && 'full-content' != $featured_image ) {
		?>
			<div class="entry-thumbnail">
				<a rel="bookmark" href="<?php the_permalink(); ?>">
	                <?php 
						the_post_thumbnail( 'create-home' );
					?>
				</a>
	        </div>
	   	<?php
		}
	}
endif; //create_archive_content_image

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Create 1.0
 */
function create_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'create_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own create_single_content_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_single_content_image() {
		global $post, $wp_query;
		
		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if( $post) {
	 		if ( is_attachment() ) { 
				$parent = $post->post_parent;
				$individual_featured_image = get_post_meta( $parent,'create-featured-image', true );
			} else {
				$individual_featured_image = get_post_meta( $page_id,'create-featured-image', true ); 
			}
		}

		if( empty( $individual_featured_image ) || ( !is_page() && !is_single() ) ) {
			$individual_featured_image = 'default';
		}
		
		$featured_image = get_theme_mod( 'single_post_image_layout', create_get_default_theme_options( 'single_post_image_layout' ) );
			
		if ( ( $individual_featured_image == 'disable' || '' == get_the_post_thumbnail() || ( $individual_featured_image=='default' && $featured_image == 'disable') ) ) {
			return false;
		}
		else { 
			if ( 'default' == $individual_featured_image ) {
				$image_class = $featured_image;
			}
			else {
				$image_class = $individual_featured_image;
			}
			?>
			<div class="entry-thumbnail <?php echo $image_class; ?>">
                <?php 
				if ( $individual_featured_image == 'featured-image' || ( $individual_featured_image=='default' && $featured_image == 'featured-image' ) ) {
					the_post_thumbnail( 'create-single' );
				}	
                elseif ( $individual_featured_image == 'large' || ( $individual_featured_image=='default' && $featured_image == 'large' ) ) {
                     the_post_thumbnail( 'large' );
                }
				else {
					the_post_thumbnail( 'full' );
				} ?>
	        </div><!-- .entry-thumbnail -->
	   	<?php
		}
	}
endif; //create_single_content_image

if ( ! function_exists( 'create_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action create_after action
	 * @uses set_transient and delete_transient
	 */
	function create_scrollup() {
		//create_flush_transients();
		if ( !$create_scrollup = get_transient( 'create_scrollup' ) ) {

			// get the data value from theme options
			echo '<!-- refreshing cache -->';	
			
			$disable_scrollup = get_theme_mod( 'disable_scrollup', create_get_default_theme_options( 'disable_scrollup' ) );
			
			if ( '1' != $disable_scrollup ) { 
				$create_scrollup =  '<a href="#masthead" id="scrollup" class="genericon"><span class="screen-reader-text">' . __( 'Scroll Up', 'create' ) . '</span></a>' ;
			}
				
			set_transient( 'create_scrollup', $create_scrollup, 86940 );
		}
		echo $create_scrollup;	
	}
}
add_action( 'create_footer', 'create_scrollup', 110 );

