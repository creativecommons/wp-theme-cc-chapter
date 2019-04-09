<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

	get_header();
    the_post();
    global $post;
?>
<section class="main-content">
    <div class="main-content-area">
        <header class="entry-header">
            <div class="grid-columns">
                <div class="use-12-columns align-center">
                    <h1 class="entry-title"><?php the_title() ?></h1>
                </div>
            </div>
        </header>
        <section class="entry-main-content">
            <div class="grid-columns">
                <aside class="use-3-columns grid-sidebar left">
                    <div class="entry-date-container no-thumb">
                        <div class="entry-date ">
                            <span class="weekday"><?php echo mysql2date( 'l', $post->event_dtstart_date ); ?></span>
                            <span class="day"><?php echo mysql2date( 'd', $post->event_dtstart_date ); ?></span>
                            <span class="month"><?php echo mysql2date( 'F', $post->event_dtstart_date ); ?></span>
                        </div>
                    </div>
                    <div class="entry-meta event-meta">
                    <?php if (!empty($post->event_location)): ?>
                        <div class="item-meta">
                            <strong>Location</strong>
                            <span class="meta-data"><?php echo $post->event_location; ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($post->event_dtstart_time)): ?>
                        <div class="item-meta">
                            <strong>From</strong>
                            <span class="meta-data"><?php echo mysql2date('g:ia',$post->event_dtstart_time); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($post->event_dtend_time)): ?>
                        <div class="item-meta">
                            <strong>To</strong>
                            <span class="meta-data"><?php echo mysql2date('g:ia',$post->event_dtend_time); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($post->event_signups)): ?>
                        <div class="item-meta">
                            <a href="<?php echo $post->event_signups ?>" class="button">Sign up event</a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($post->event_url)): ?>
                        <div class="item-meta">
                            <a href="<?php echo $post->event_url ?>" class="button">More info</a>
                        </div>
                    <?php endif; ?>
                    </div>
                </aside>
                <div class="use-9-columns">
                    <div class="entry-post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<?php get_footer(); ?>
