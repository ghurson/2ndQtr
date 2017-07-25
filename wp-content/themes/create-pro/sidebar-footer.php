<?php
/**
 * The sidebar containing footer widget areas.
 *
 * @package Create Pro
 */

/* 
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'footer-1'  )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3'  )
) {
	return;
}
// If we get this far, we have widgets. Let do this.
?>
    <div id="supplementary" <?php create_footer_sidebar_class(); ?>>
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
        <div id="first" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-1' ); ?>
        </div><!-- #first .widget-area -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
        <div id="second" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-2' ); ?>
        </div><!-- #second .widget-area -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
        <div id="third" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'footer-3' ); ?>
        </div><!-- #third .widget-area -->
        <?php endif; ?>
    </div><!-- #supplementary -->
