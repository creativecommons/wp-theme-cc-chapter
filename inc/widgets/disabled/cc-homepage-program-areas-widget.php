<?php

class CreativeCommons_Homepage_Program_Areas_Widget extends WP_Widget {
  var $default_title, $default_size;

  /**
   * Registers the widget with WordPress.
   */
  function __construct() {
    parent::__construct(false, $name = __("CC Homepage Program Area Widget", 'creativecommons'));
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
    $cc_program_area_title = isset($instance['cc_program_area_title']) ? $instance['cc_program_area_title'] : "Featured Program Areas";
    $cc_program_area_more = isset($instance['cc_program_area_more']) ? $instance['cc_program_area_more'] : "Read More";

    echo $args['before_widget'];

    ?>
	
	<!--
	<div class="homepage-featured-program-areas-widget-inner">
<div class="column">
<div class="service-box">
<p><img class="alignnone size-full" src="https://creativecommons.org/wp-content/uploads/2016/06/book-6.png" alt="icon_share" width="90" height="82"></p>
<h3>Open Education</h3>
<p>The Open Education program at Creative Commons works to minimize barriers to educational lorem ipsum dolor sit arnet adpiscing alt nonummy.</p>
</div>
</div>
<div class="column">
<div class="service-box">
<p><img class="alignnone size-full" src="https://creativecommons.org/wp-content/uploads/2016/06/photo-6.png" alt="icon_share" width="90" height="82"></p>
<h3>Arts &amp; Culture</h3>
<p>Our goal at Creative Commons is to increase cultural creativity in “the commons” – the body of work freely available to the public for legal use, sharing, repurposing and remixing.</p>
</div>
</div>
<div class="column">
<div class="service-box">
<p><img class="alignnone size-full" src="https://creativecommons.org/wp-content/uploads/2016/06/scientific-research.png" alt="icon_share" width="90" height="82"></p>
<h3>Open Science</h3>
<p>Allowing scientists to collaborate and build on each others findings, speeding up the discover and understanding of solutions to planetary and societal needs.</p>
</div>
</div>
<div class="column">
<div class="service-box">
<p><img class="alignnone size-full" src="https://creativecommons.org/wp-content/uploads/2016/06/technology.png" alt="icon_share" width="90" height="82"></p>
<h3>Technology</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed vehicula libero. Vivamus rhoncus rhoncus turpis, sed fringilla lacus sollicitudin convallis.</p>
</div>
</div>
</div>
	-->
	
	<div class="homepage-featured-program-areas-widget">
		<div class="textwidget">
			<div class="widget-header">
				<h2 class="txt-hero"><?php print $cc_program_area_title; ?></h2>
			</div>
			<div class="homepage-featured-program-areas-widget-inner">
          
            <?php
            // The hero feature
            $the_query = cc_widgets_get_homepage_features_query('program', 1);
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
				<div class="column">
					<div class="service-box">
						<div class="thumbnail">
							<a href="<?php print $url; ?>"><?php print the_post_thumbnail('medium'); ?></a>
						</div>
						<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
						<div class="excerpt"><?php print the_excerpt(); ?></div>
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
            $the_special_query = cc_widgets_get_homepage_features_query('program', 0);
            if ($the_special_query->have_posts()){
              $have_special_feature = TRUE;
            }

            $the_query = cc_widgets_get_homepage_features_query('program', 4);
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
                    <div class="excerpt"><?php print the_excerpt(); ?></div>
                  </div>
                </div>
                <?php if ($posts_displayed == 4 || ($posts_displayed == 3 && $have_special_feature == TRUE)) break; ?>
             <?php } ?>
			 
			 


          </div>
          <div class="more"><a href="/?post_type=post"><?php print $cc_program_area_more; ?><i class="cc-icon-right-dir"></i></a></div>
        </div>
      </div>

    <?php

    echo $args['after_widget'];
  }

  public function form( $instance ) {
      if ( isset( $instance[ 'cc_program_area_title' ] ) ) {
          $cc_program_area_title = $instance[ 'cc_program_area_title' ];
      }
      else {
          $cc_program_area_title = __( 'new cc_program_area_title', 'wpb_widget_domain' );
      }
      //Repeat for option2
      if ( isset( $instance[ 'cc_program_area_more' ] ) ) {
          $cc_program_area_more = $instance[ 'cc_program_area_more' ];
      }
      else {
          $cc_program_area_more = __( 'new cc_program_area_more', 'wpb_widget_domain' );
      }
      //Repeat for number of posts
      if ( isset( $instance[ 'cc_program_area_numposts' ] ) ) {
          $cc_program_area_numposts = $instance[ 'cc_program_area_numposts' ];
      }
      else {
          $cc_program_area_numposts = __( '3', 'wpb_widget_domain' );
      }
      ?>
          <p>
          <label for="<?php echo $this->get_field_id( 'cc_program_area_title' ); ?>"><?php _e( 'Title:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'cc_program_area_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_program_area_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_program_area_title ); ?>" />
          </p>
          <p>
          <label for="<?php echo $this->get_field_id( 'cc_program_area_more' ); ?>"><?php _e( 'More Text:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'cc_program_area_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_program_area_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_program_area_more ); ?>" />
          </p>
          <p>
          <label for="<?php echo $this->get_field_id( 'cc_program_area_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'cc_program_area_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_program_area_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_program_area_numposts ); ?>" />
          </p>
      <?php
  }

  /**
   * Save the options.
   */
  public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['cc_program_area_title'] = ( ! empty( $new_instance['cc_program_area_title'] ) ) ? strip_tags( $new_instance['cc_program_area_title'] ) : "What's Happening";
      $instance['cc_program_area_more'] = ( ! empty( $new_instance['cc_program_area_more'] ) ) ? strip_tags( $new_instance['cc_program_area_more'] ) : "Read More";
      $instance['cc_program_area_numposts'] = ( ! empty( $new_instance['cc_program_area_numposts'] ) ) ? strip_tags( $new_instance['cc_program_area_numposts'] ) : "3";
      return $instance;
  }
}


function cc_homepage_program_area_widget_init() {
  register_widget( 'CreativeCommons_Homepage_Program_Areas_Widget' );
}

add_action( 'widgets_init', 'cc_homepage_program_area_widget_init' );
