<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="home-feature">
        <?php
            $last_feature = front::get_last_featured();
            echo apply_filters('the_content',$last_feature->post_content);
        ?>
        </section>
    </main><!-- .site-main -->
</div>
<?php get_footer(); ?>