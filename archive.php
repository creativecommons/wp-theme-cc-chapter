<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

	get_header();
	$search = new search_filter();
		if (get_class(get_queried_object()) == 'WP_Post_Type') {
			$search->set_post_type(get_queried_object()->name);
		} else if (get_class(get_queried_object()) != 'WP_Term_Object') {
			$search->set_post_type('any');
		}
		if ( get_query_var('paged') ) {
			$search->set_page(get_query_var('paged'));
		}
		if ( isset($_GET['action']) ) {
			if (isset($_GET['search'])) {
				$search->set_search_text( esc_attr( $_GET['search'] ) ) ;
			}
			$date = array();
			if ( !empty($_GET['date_month'])) {
				$date['month'] = esc_attr( $_GET['date_month'] );
			}
			if ( !empty( $_GET['date_year'] ) ) {
				$date['year'] = esc_attr( $_GET['date_year'] );
			}
			if ( !empty($date) ) {
				$search->set_date($date);
			}
		}
		$query = $search->search();
?>

<div id="primary" class="content-area">
    <div id="wrapper-main" class="wrapper-main">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php
			if (function_exists('bcn_display')) {
				bcn_display();
			}
			?>
        </div>
		<div class="filter-form">
			<form action="" method="GET">
				<div class="filter-row">
					<div class="item search-description">
						<h5>Filter</h5>
					</div>
					<div class="item search-key">
						<input type="text" placeholder="Keyword" value="<?php echo esc_attr($_GET['search']) ?>" class="input-type" name="search">
					</div>
					<div class="item search-month">
						<?php echo $search->get_months_select(array( 
							'name' => 'date_month',
							'class' => 'input-type'
						), $_GET['date_month']); ?>
					</div>
					<div class="item search-year">
						<?php echo $search->get_years_select(array( 
							'name' => 'date_year',
							'class' => 'input-type'
						), $_GET['date_year']); ?>
					</div>
					<div class="item search-button">
						<input type="submit" class="button secondary" value="Search">
						<input type="hidden" name="action" value="send">
					</div>
				</div>
			</form>
		</div>
        <main id="main" class="site-main" role="main">
            <?php if ($query->have_posts()) : ?>

            <header class="page-header">
                <?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="taxonomy-description">', '</div>');
				?>
            </header><!-- .page-header -->
            <?php get_template_part('template-parts/sidebar/sidebar','content-above-mobile'); ?>
            <?php get_template_part('template-parts/sidebar/sidebar','content-above'); ?>
			<div class="grid-container total-cols-2">
            <?php
				// Start the Loop.
			while ($query->have_posts()) :
				$query->the_post();

				/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
				get_template_part('template-parts/content', get_post_format());

			// End the loop.
			endwhile;?>
			</div>
			<?php

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => __('Previous page', 'twentysixteen'),
					'next_text'          => __('Next page', 'twentysixteen'),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>',
				)
			);

		// If no content, include the "No posts found" template.
		else :
			get_template_part('template-parts/content', 'none');

		endif;
		?>
        </main><!-- .site-main -->
        <?php get_template_part('template-parts/sidebar/sidebar','content-bottom'); ?>
    </div>
    <div id="wrapper-sidebar" class="wrapper-sidebar">
        <?php get_sidebar(); ?>
    </div>
</div><!-- .content-area -->
<!-- content-below -->
<?php get_template_part('template-parts/sidebar/sidebar','content-below'); ?>
<!-- END content-below -->

<?php get_footer(); ?> 