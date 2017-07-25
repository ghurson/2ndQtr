<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Create Pro
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses create_header_style()
 * @uses create_admin_header_style()
 * @uses create_admin_header_image()
 */
function create_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'create_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'cfa205',
		'width'                  => 1024,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'create_header_style',
		'admin-head-callback'    => 'create_admin_header_style',
		'admin-preview-callback' => 'create_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'create_custom_header_setup' );

if ( ! function_exists( 'create_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see create_custom_header_setup().
 */
function create_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // create_header_style

if ( ! function_exists( 'create_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see create_custom_header_setup().
 */
function create_admin_header_style() {
?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( 'blank' == get_header_textcolor() ) :
		?>
			.site-title,
			.site-description {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo get_header_textcolor(); ?>;
			}
		<?php endif; ?>																										

		.appearance_page_custom-header #headimg {
			border: none;
		}
	</style>
<?php
}
endif; // create_admin_header_style

if ( ! function_exists( 'create_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see create_custom_header_setup().
 */
function create_admin_header_image() {
?>
	<div class="site-branding">
		<h1 class="site-title"><a id="name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<p class="site-description" id="desc"><?php bloginfo( 'description' ); ?></p>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // create_admin_header_image

if ( ! function_exists( 'create_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own create_featured_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_featured_image() {
		$header_image 	= get_header_image();
		
		if ( '' != $header_image ) {				
			// Header Image Link and Target
			$featured_header_image_url	= get_theme_mod( 'featured_header_image_url', create_get_default_theme_options( 'featured_header_image_url' ) );

			$featured_header_image_base	= get_theme_mod( 'featured_header_image_base', create_get_default_theme_options( 'featured_header_image_base' ) );
			
			if ( '' != $featured_header_image_url ) {
				//support for qtranslate custom link
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$link = qtrans_convertURL( $featured_header_image_url );
				}
				else {
					$link = esc_url( $featured_header_image_url );
				}
				//Checking Link Target
				if ( '1' == $featured_header_image_base ) {
					$target = '_blank'; 	
				}
				else {
					$target = '_self'; 	
				}
			}
			else {
				$link = '';
				$target = '';
			}
			
			$featured_header_image_alt	= get_theme_mod( 'featured_header_image_alt', create_get_default_theme_options( 'featured_header_image_alt' ) );
			// Header Image Title/Alt
			if ( '' != $featured_header_image_alt ) {
				$title = esc_attr( $featured_header_image_alt ); 	
			}
			else {
				$title = '';
			}
			
			// Header Image
			$feat_image = '<img class="wp-post-image" alt="' . $title . '" src="'.esc_url(  $header_image ).'" />';
			
			$create_featured_image = '<div id="header-featured-image">';
				// Header Image Link 
				if ( '' != $featured_header_image_url ) :
					$create_featured_image .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="'.$target.'">' . $feat_image . '</a>'; 	
				else:
					// if empty featured_header_image on theme options, display default
					$create_featured_image .= $feat_image;
				endif;
			$create_featured_image .= '</div><!-- #header-featured-image -->';
		
			echo $create_featured_image;
		}
	} // create_featured_image
endif;


if ( ! function_exists( 'create_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own create_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_featured_page_post_image() {
		global $post;

		if( has_post_thumbnail( ) ) {
			// Header Image Link and Target
			$featured_header_image_url	= get_theme_mod( 'featured_header_image_url', create_get_default_theme_options( 'featured_header_image_url' ) );

			$featured_header_image_base	= get_theme_mod( 'featured_header_image_base', create_get_default_theme_options( 'featured_header_image_base' ) );
			
			if ( '' != $featured_header_image_url ) {
				//support for qtranslate custom link
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$link = qtrans_convertURL( $featured_header_image_url );
				}
				else {
					$link = esc_url( $featured_header_image_url );
				}
				//Checking Link Target
				if ( '1' == $featured_header_image_base ) {
					$target = '_blank';
				}
				else {
					$target = '_self'; 	
				}
			}
			else {
				$link = '';
				$target = '';
			}
			
			$featured_header_image_alt	= get_theme_mod( 'featured_header_image_alt', create_get_default_theme_options( 'featured_header_image_alt' ) );
			// Header Image Title/Alt
			if ( '' != $featured_header_image_alt ) {
				$title = esc_attr( $featured_header_image_alt ); 	
			}
			else {
				$title = '';
			}
			
			$featured_image_size	= get_theme_mod( 'featured_image_size', create_get_default_theme_options( 'featured_image_size' ) );

            /*
			if ( 'featured-image' ==  $featured_image_size ) {
				$feat_image = get_the_post_thumbnail( $post->ID, 'create-header', array('id' => 'main-feat-img'));
			}
			else if ( 'full' ==  $featured_image_size ) {
				$feat_image = get_the_post_thumbnail( $post->ID, 'full', array('id' => 'main-feat-img'));
			}
			else {
				$feat_image = get_the_post_thumbnail( $post->ID, 'large', array('id' => 'main-feat-img'));
            }
            */
            $feat_image = get_the_post_thumbnail( $post->ID, 'single-banner', array('id' => 'main-feat-img'));

            $create_featured_image = '<div id="header-featured-image" class =' . $featured_image_size . '>';
				// Header Image Link 
				if ( '' != $featured_header_image_url ) :
					$create_featured_image .= '<a title="'. esc_attr( $title ).'" href="'. esc_url( $link ) .'" target="'.$target.'">' . $feat_image . '</a>'; 	
				else:
					// if empty featured_header_image on theme options, display default
					$create_featured_image .= $feat_image;
				endif;
			$create_featured_image .= '</div><!-- #header-featured-image -->';
			
			echo $create_featured_image;
		}
		else {
			create_featured_image();
		}		
	} // create_featured_page_post_image
endif;

if ( ! function_exists( 'create_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own create_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Create 1.0
	 */
	function create_featured_overall_image() {
		global $post, $wp_query;
		$enableheaderimage	= get_theme_mod( 'enable_featured_header_image', create_get_default_theme_options( 'enable_featured_header_image' ) );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		
		$page_for_posts = get_option('page_for_posts'); 

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_page() || is_single() ) {
			//Individual Page/Post Image Setting
			$individual_featured_image = get_post_meta( $post->ID, 'create-header-image', true ); 

			if ( $individual_featured_image == 'disable' || ( $individual_featured_image == 'default' && $enableheaderimage == 'disable' ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			}
			elseif ( $individual_featured_image == 'enable' && $enableheaderimage == 'disable' ) {
				create_featured_page_post_image();
			}
		}

		// Check Homepage 
		if ( $enableheaderimage == 'homepage' ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				create_featured_image();
			}
		}
		// Check Excluding Homepage 
		if ( $enableheaderimage == 'exclude-home' ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			}
			else {
				create_featured_image();	
			}
		}
		// Check Entire Site
		elseif ( $enableheaderimage == 'entire-site' ) {
			create_featured_image();
		}
		// Check Entire Site (Post/Page)
		elseif ( $enableheaderimage == 'entire-site-page-post' ) {
			if ( is_page() || is_single() ) {
				create_featured_page_post_image();
			}
			else {
				create_featured_image();
			}
		}	
		// Check Page/Post
		elseif ( $enableheaderimage == 'pages-posts' ) {
			if ( is_page() || is_single() ) {
				create_featured_page_post_image();
			}
		}
		else {
			echo '<!-- Disable Header Image -->';
		}
	} // create_featured_overall_image
endif;