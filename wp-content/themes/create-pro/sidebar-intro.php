<?php
/**
 * The sidebar containing the intro widget area.
 *
 * @package Create Pro
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}

// Get Page ID outside Loop
$create_page_id = $wp_query->get_queried_object_id();

// Front page displays in Reading Settings
$create_page_on_front = get_option('page_on_front') ;
$create_page_for_posts = get_option('page_for_posts'); 
 
$create_enable_intro_widget	= get_theme_mod( 'enable_intro_widget', create_get_default_theme_options( 'enable_intro_widget' ) );

if ( 'exclude-home' == $create_enable_intro_widget ) {
	if ( is_front_page() || ( is_home() && $create_page_for_posts != $create_page_id ) ) {
		return;
	}
}

if ( 'entire-site' == $create_enable_intro_widget || ( ( is_front_page() || ( is_home() && $create_page_for_posts != $create_page_id ) ) && 'homepage' == $create_enable_intro_widget  ) ) : 
?>
	<div id="intro-widget-area" class="widget-area widget-area-intro" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #supplementary -->

<?php
endif;
?>
