<?php
/**
 * The template for displaying the front page.
 */

get_header(); 
global $_set;
$settings = $_set->settings;

?>

<!-- header-below -->
<?php get_template_part( 'template-parts/sidebar/sidebar','header-below' ); ?>
<!-- END header-below -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <section class="home-feature">
        <?php
            $last_feature = front::get_last_featured();
            echo apply_filters('the_content',$last_feature->post_content);
        ?>
        </section>
    </main><!-- .site-main -->
    <?php if (is_active_sidebar('homepage-space-1')): ?>
        <section class="homepage-space-1 widget-area<?php echo front::get_sidebar_class('sidebar-1'); ?>">
            <div class="main-content-area">
                <?php dynamic_sidebar( 'homepage-space-1' ); ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_active_sidebar('homepage-space-2')): ?>
        <section class="homepage-space-2 widget-area<?php echo front::get_sidebar_class('sidebar-2'); ?>">
            <div class="main-content-area">
                <?php dynamic_sidebar( 'homepage-space-2' ); ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_active_sidebar('homepage-space-3')): ?>
        <section class="homepage-space-3 widget-area<?php echo front::get_sidebar_class('sidebar-3'); ?>">
            <div class="main-content-area">
                <?php dynamic_sidebar( 'homepage-space-3' ); ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_active_sidebar('homepage-space-4')): ?>
        <section class="homepage-space-4 widget-area<?php echo front::get_sidebar_class('sidebar-4'); ?>">
            <div class="main-content-area">
                <?php dynamic_sidebar( 'homepage-space-4' ); ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if (is_active_sidebar('homepage-space-5')): ?>
        <section class="homepage-space-5 widget-area<?php echo front::get_sidebar_class('sidebar-5'); ?>">
            <div class="main-content-area">
                <?php dynamic_sidebar( 'homepage-space-5' ); ?>
            </div>
        </section>
    <?php endif; ?>
    <?php get_template_part( 'template-parts/sidebar/sidebar','content-bottom' ); ?>

</div><!-- .content-area -->
<!-- home-content-below -->
    <?php get_template_part( 'template-parts/sidebar/sidebar','homepage-content-widgets' ); ?>
<!-- END home-content-below -->
<?php get_footer(); ?>
