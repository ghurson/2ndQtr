<?php
/**
 * The template for displaying all single posts.
 *
 * @package Create Pro
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php create_post_nav(); ?>

			<?php 
				/** 
				 * create_comment_section hook
				 *
				 * @hooked create_get_comment_section - 10
				 */
				do_action( 'create_comment_section' ); 
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
