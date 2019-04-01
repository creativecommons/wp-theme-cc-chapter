<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'homepage-content-widgets' ) ) : ?>
	<div id="home-content-below" class="widget-area">
		<?php
		// $the_query = cc_widgets_get_featured_posts_by_taxonomy_query('links','highlight', $cc_links_numposts);
		// print_r($the_query);
		?>
		<?php dynamic_sidebar( 'homepage-content-widgets' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>