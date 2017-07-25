<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Create Pro
 */
?>
	
	<?php get_sidebar(); ?>

	<?php                
	    /** 
	     * create_before_footer hook
	     *
	     * @hooked create_sidebar - 10
	     * @hooked create_content_end - 20
	     *
	     */
	    do_action( 'create_before_footer' );
	?>

	<?php                
	    /** 
	     * create_footer hook
	     *
	     * @hooked create_footer_start - 10
	     * @hooked create_footer_sidebar - 20
	     * @hooked create_footer_info - 30
	     * @hooked create_footer_end - 50
	     * @hooked create_page_end - 100
	     * @hooked create_scrollup - 110
	     */
	    do_action( 'create_footer' );
	?>

<?php wp_footer(); ?>

</body>
</html>
