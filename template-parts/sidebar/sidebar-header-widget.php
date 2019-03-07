<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
	<div id="header-widget" class="widget-area">
		<?php dynamic_sidebar( 'header-widget' ); ?>
	</div><!-- .sidebar .widget-area -->
<?php endif; ?>
