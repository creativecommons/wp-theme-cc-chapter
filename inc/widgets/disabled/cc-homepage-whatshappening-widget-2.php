<?php

class cc_Homepage_WhatsHappening_Widget_2 extends WP_Widget {
  var $default_title, $default_size;

  /**
   * Registers the widget with WordPress.
   */
  function __construct() {
    parent::__construct(false, $name = __("CC Homepage What's Happening Widget", 'creativecommons'));
    $this->default_category  = 'homepage';
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  function widget( $args, $instance ) {

    //Load the options into variables
    $cc_whatshappening_title = isset($instance['cc_whatshappening_title']) ? $instance['cc_whatshappening_title'] : "What's <br />Happening!!!";
    $cc_whatshappening_more = isset($instance['cc_whatshappening_more']) ? $instance['cc_whatshappening_more'] : "Read More";

    echo $args['before_widget'];

    ?>

      <div class="homepage-whatshappening-widget">
        <div class="homepage-whatshappening-widget-inner">
          <h2 class="txt-hero"><?php print $cc_whatshappening_title; ?></h2>
          <div class="post-hero">
            <?php
            // The hero feature
            $the_query = cc_widgets_get_homepage_features_query('hero', 1);
            while ( $the_query->have_posts() ){
              $the_query->the_post();
              $hero_post_id = get_the_ID();
              $url = get_permalink();
              $categories = get_the_category();
              if ( ! empty( $categories ) ) {
                $category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
              } else {
                $category_link = NULL;
              }
              ?>
                <div class="item">
                  <div class="thumbnail">
                    <a href="<?php print $url; ?>"><?php print the_post_thumbnail('large'); ?></a>
                  </div>
                  <div class="teaser">
                    <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                    <div class="excerpt"><?php print the_excerpt(); ?></div>
                    <div class="category"><?php print $category_link; ?></div>
                  </div>
                </div>
             <?php } ?>
          </div>
          <div class="posts-featured">
            <?php
            // The four other features.
            // If we have a special feature, then it is 3 featured and 1 special feature.
            // Otherwise, it is 4 features.
            $have_special_feature = FALSE;
            $the_special_query = cc_widgets_get_homepage_features_query('special-feature', 1);
            if ($the_special_query->have_posts()){
              $have_special_feature = TRUE;
            }

            $the_query = cc_widgets_get_homepage_features_query('featured', 5);
            $posts_displayed = 0;
            while ( $the_query->have_posts() ){
              $the_query->the_post();
              if (isset($hero_post_id) && get_the_ID() == $hero_post_id){
                continue;
              } else {
                $posts_displayed++;
              }
              $url = get_permalink();
              $categories = get_the_category();
              if ( ! empty( $categories ) ) {
                $category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
              } else {
                $category_link = NULL;
              }
              ?>
                <div class="item">
                  <div class="thumbnail">
                    <a href="<?php print $url; ?>"><?php print the_post_thumbnail(); ?></a>
                  </div>
                  <div class="teaser">
                    <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                    <div class="category"><?php print $category_link; ?></div>
                  </div>
                </div>
                <?php if ($posts_displayed == 4 || ($posts_displayed == 3 && $have_special_feature == TRUE)) break; ?>
             <?php } ?>
            <?php if ($have_special_feature == TRUE): ?>
            <?php
              $the_special_query->the_post();
              $url = get_permalink();
              $categories = get_the_category();
              if ( ! empty( $categories ) ) {
                $category_link  ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
              } else {
                $category_link = NULL;
              }
              ?>
                <div class="item">
                  <div class="thumbnail">
                    <a href="<?php print $url; ?>"><?php print the_post_thumbnail(); ?></a>
                  </div>
                  <div class="teaser">
                    <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                    <div class="category"><?php print $category_link; ?></div>
                  </div>
                </div>
            <?php endif; // $have_special_feature == TRUE ?>

          </div>
          <div class="more"><a href="/?post_type=post"><?php print $cc_whatshappening_more; ?><i class="cc-icon-right-dir"></i></a></div>
        </div>
      </div>

    <?php

    echo $args['after_widget'];
  }

  public function form( $instance ) {
      if ( isset( $instance[ 'cc_whatshappening_title' ] ) ) {
          $cc_whatshappening_title = $instance[ 'cc_whatshappening_title' ];
      }
      else {
          $cc_whatshappening_title = __( 'new cc_whatshappening_title', 'wpb_widget_domain' );
      }
      //Repeat for option2
      if ( isset( $instance[ 'cc_whatshappening_more' ] ) ) {
          $cc_whatshappening_more = $instance[ 'cc_whatshappening_more' ];
      }
      else {
          $cc_whatshappening_more = __( 'new cc_whatshappening_more', 'wpb_widget_domain' );
      }
      ?>
          <p>
          <label for="<?php echo $this->get_field_id( 'cc_whatshappening_title' ); ?>"><?php _e( 'Title:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'cc_whatshappening_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_whatshappening_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_whatshappening_title ); ?>" />
          </p>
          <p>
          <label for="<?php echo $this->get_field_id( 'cc_whatshappening_more' ); ?>"><?php _e( 'More Text:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'cc_whatshappening_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_whatshappening_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_whatshappening_more ); ?>" />
          </p>
      <?php
  }

  /**
   * Save the options.
   */
  public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['cc_whatshappening_title'] = ( ! empty( $new_instance['cc_whatshappening_title'] ) ) ? strip_tags( $new_instance['cc_whatshappening_title'] ) : "What's Happening";
      $instance['cc_whatshappening_more'] = ( ! empty( $new_instance['cc_whatshappening_more'] ) ) ? strip_tags( $new_instance['cc_whatshappening_more'] ) : "Read More";
      return $instance;
  }
}


function cc_homepage_whatshappening_widget2_init() {
  register_widget( 'cc_Homepage_WhatsHappening_Widget_2' );
}

add_action( 'widgets_init', 'cc_homepage_whatshappening_widget2_init' );
