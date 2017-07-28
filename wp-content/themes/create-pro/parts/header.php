<nav id="site-navigation" class="main-navigation create-menu" role="navigation">
    <button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', 'create' ); ?></button>
    <?php wp_nav_menu( array(
            'theme_location' => 'primary' )
    );
    ?>
</nav><!-- #site-navigation -->

<?php
$jetpack_logo  = get_option( 'site_logo' );

if ( !empty( $jetpack_logo['id'] ) && function_exists( 'jetpack_the_site_logo' ) ) {
    jetpack_the_site_logo();
}
else {
    create_display_logo();
}
?>
<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<p class="site-description updated-description">Content Marketing</p>

<ul class="header-description">
    <li>Real Estate</li>
    <li>Non-Profits</li>
    <li>Social Media</li>
</ul>