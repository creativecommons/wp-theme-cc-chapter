<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if ( class_exists( 'coauthors_plus' ) ) { // Get the Co-Authors for the post
	$co_authors = get_coauthors();
} else {
	$co_authors = array();
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<div class="author-wrapper">
		
	  <div class="author-info-group">
		
		<div class="author-date"><?php the_date(); ?></div>
		</div>
	</div>
	<div class="entry-content">
		<?php
		if ( get_field( 'featured_video_link' ) ) {
			echo do_shortcode( '[video stretching="responsive" src="' . get_field( 'featured_video_link' ) . '"]' );
		}
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);

			?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
