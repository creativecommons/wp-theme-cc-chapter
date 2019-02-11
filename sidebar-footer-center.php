<?php
/**
 * The template for the sidebar containing the footer center widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php if ( is_active_sidebar( 'footer-center' )  ) : ?>
  <div id="footer-center" class="widget-area footer-center">
    <?php dynamic_sidebar( 'footer-center' ); ?>
  </div><!-- .sidebar .widget-area -->
<?php endif; ?>