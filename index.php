<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php 
        if (have_posts()) {
            ?>
            <header class="page-header">
                <h1 class="entry-title"><?php echo get_the_title(get_queried_object()->ID); ?></h1>
                <div class="taxonomy-description"><?php echo apply_filters('the_content', get_queried_object()->post_content) ?></div>
            </header><!-- .page-header -->
            <div class="grid-container total-cols-2">
            <?php
                while( have_posts() ) {
                    the_post();
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
<?php get_footer(); ?>