<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Create Pro
 */

global $post, $wp_query; 

// Front page displays in Reading Settings
$page_for_posts = get_option('page_for_posts'); 

// Get Page ID outside Loop
$page_id = $wp_query->get_queried_object_id();	

// Blog Page setting in Reading Settings
if ( $page_id == $page_for_posts ) {
	$layout 		= get_post_meta( $page_for_posts,'create-layout-option', true );
	$sidebaroptions = get_post_meta( $page_for_posts, 'create-sidebar-options', true );
}	

// Settings for page/post/attachment
if ( is_singular() ) {

	if ( is_attachment() ) { 
		$parent 		= $post->post_parent;
		$layout 		= get_post_meta( $parent, 'create-layout-option', true );
		$sidebaroptions = get_post_meta( $parent, 'create-sidebar-options', true );
		
	} 
	else {
		$layout 		= get_post_meta( $post->ID, 'create-layout-option', true ); 
		$sidebaroptions = get_post_meta( $post->ID, 'create-sidebar-options', true ); 
	}
}
else {
	$sidebaroptions = '';
}

if ( empty( $layout ) || ( !is_page() && !is_single() ) ) {
	$layout = 'default';
}

if ( is_archive() && !is_home() ) {
	$layout 	= get_theme_mod( 'theme_layout', create_get_default_theme_options( 'theme_layout' ) );
}

if ( is_home() && is_front_page() ) {
	$layout 	= get_theme_mod( 'homepage_layout', create_get_default_theme_options( 'homepage_layout' ) );
}

$themeoption_layout = get_theme_mod( 'theme_layout', create_get_default_theme_options( 'theme_layout' ) );

if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar' ) || ( $layout=='default' && $themeoption_layout == 'right-sidebar' ) ) { ?>

	<div id="secondary" class="widget-area" role="complementary">
		<?php 
		if ( is_active_sidebar( 'create_woocommerce_sidebar' ) && ( class_exists( 'Woocommerce' ) && is_woocommerce() ) ) {
				dynamic_sidebar( 'create_woocommerce_sidebar' );
			}	
		elseif ( is_active_sidebar( 'sidebar-optional-one' ) && $sidebaroptions == 'optional-sidebar-one' ) {
        	dynamic_sidebar( 'sidebar-optional-one' ); 
   		}
		elseif ( is_active_sidebar( 'sidebar-optional-two' ) && $sidebaroptions == 'optional-sidebar-two' ) {
        	dynamic_sidebar( 'sidebar-optional-two' ); 
   		}
		elseif ( is_active_sidebar( 'sidebar-optional-three' ) && $sidebaroptions == 'optional-sidebar-three' ) {
        	dynamic_sidebar( 'sidebar-optional-three' ); 
   		}
		elseif ( is_active_sidebar( 'sidebar-optional-homepage' ) && ( is_front_page() || ( is_home() && $page_id != $page_for_posts ) ) ) {
        	dynamic_sidebar( 'sidebar-optional-homepage' ); 
   		}
		elseif ( is_active_sidebar( 'sidebar-optional-archive' ) && ( $page_id == $page_for_posts || is_archive() || is_page_template( 'page-blog.php' ) ) ) {
        	dynamic_sidebar( 'sidebar-optional-archive' ); 
    	}					
		elseif ( is_page() && is_active_sidebar( 'sidebar-optional-page' ) ) {
			dynamic_sidebar( 'sidebar-optional-page' ); 
		}	
		elseif ( is_single() && is_active_sidebar( 'sidebar-optional-post' ) ) {
			dynamic_sidebar( 'sidebar-optional-post' ); 
		}	
		elseif ( is_active_sidebar( 'sidebar-1' ) ) {
        	dynamic_sidebar( 'sidebar-1' ); 
   		}	
		else { ?>
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>
	
			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'create' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
		
		<?php 
		} // end sidebar widget area ?>
	</div><!-- #secondary .widget-area -->
    
	<?php
}
