<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Create Pro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php create_single_content_image(); ?> 

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

        <?php Display::blog() ?>
        <?php Display::resources() ?>
        <?php Display::engage() ?>
	</header><!-- .entry-header -->

    <div class="entry-content">
        <?php Display::testimonials() ?>
        <?php Display::content() ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'create' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
