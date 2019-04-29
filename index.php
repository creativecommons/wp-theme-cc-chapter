<?php get_header(); 
    $search = new search_filter();
    $the_search = isset($_GET['search']) ? esc_attr($_GET['search']) : '';
    $the_month = isset($_GET['date_month']) ? esc_attr($_GET['date_month']) : '';
    $the_year = isset($_GET['date_year']) ? esc_attr($_GET['date_year']) : '';
		if (get_class(get_queried_object()) == 'WP_Post_Type') {
			$search->set_post_type(get_queried_object()->name);
		} else if (get_class(get_queried_object()) != 'WP_Term_Object') {
			$search->set_post_type('post');
		}
		if ( get_query_var('paged') ) {
			$search->set_page(get_query_var('paged'));
		}
		if ( isset($_GET['action']) ) {
			if (isset($_GET['search'])) {
				$search->set_search_text( $the_search ) ;
			}
			$date = array();
			if ( isset($_GET['date_month'])) {
				$date['month'] = $the_month;
			}
			if ( isset( $_GET['date_year'] ) ) {
				$date['year'] = $the_year;
			}
			if ( !empty($date) ) {
				$search->set_date($date);
			}
		}
		$query = $search->search();
?>
<div id="primary" class="content-area">
    <div id="wrapper-main" class="wrapper-main">
    <?php if ($query->have_posts()) { ?>
        <div class="filter-form">
            <form action="" method="GET">
                <div class="filter-row">
                    <div class="item search-description">
                        <h5>Filter</h5>
                    </div>
                    <div class="item search-key">
                        <input type="text" placeholder="Keyword" value="<?php echo $the_search ?>" class="input-type" name="search">
                    </div>
                    <div class="item search-month">
                        <?php echo $search->get_months_select(array( 
                            'name' => 'date_month',
                            'class' => 'input-type'
                        ), $the_month); ?>
                    </div>
                    <div class="item search-year">
                        <?php echo $search->get_years_select(array( 
                            'name' => 'date_year',
                            'class' => 'input-type'
                        ), $the_year); ?>
                    </div>
                    <div class="item search-button">
                        <input type="submit" class="button secondary" value="Search">
                        <input type="hidden" name="action" value="send">
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
    <main id="main" class="site-main" role="main">
        <?php 
        if ($query->have_posts()) {
            ?>
            <header class="page-header">
                <h1 class="entry-title"><?php echo get_the_title(get_queried_object()->ID); ?></h1>
                <div class="taxonomy-description"><?php echo apply_filters('the_content', get_queried_object()->post_content) ?></div>
            </header><!-- .page-header -->
            <div class="grid-container total-cols-2">
            <?php
                while( $query->have_posts() ) {
                    $query->the_post();
                    get_template_part('template-parts/content', get_post_format());
                }
            ?>
            </div>
            <?php
            the_posts_pagination(
				array(
					'prev_text'          => __('Previous page', 'twentysixteen'),
					'next_text'          => __('Next page', 'twentysixteen'),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>',
				)
			);
        } else {
            get_template_part('template-parts/content', 'none');
        }
         ?>
    </main><!-- .site-main -->
    </div>
</div>
<?php get_footer(); ?>