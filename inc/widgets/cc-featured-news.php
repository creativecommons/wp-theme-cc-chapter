<?php

class CreativeCommons_Featured_News_Widget extends WP_Widget {
	var $default_title, $default_size;

	/**
	* Registers the widget with WordPress.
	*/
	function __construct() {
		parent::__construct(false, $name = __("CC Featured News Widget: <span></span>", 'creativecommons') );
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
	function widget($args, $instance) {
		$cc_featured_news_title = isset($instance['cc_featured_news_title']) ? $instance['cc_featured_news_title'] : null;
		$cc_featured_news_more = isset($instance['cc_featured_news_more']) ? $instance['cc_featured_news_more'] :null;
		$cc_featured_news_post_read_more = isset($instance['cc_featured_news_post_read_more']) ? $instance['cc_featured_news_post_read_more'] : null;
		$cc_featured_news_numposts = isset($instance['cc_featured_news_numposts']) ? $instance['cc_featured_news_numposts'] : "4";
		$cc_featured_news_category = isset($instance['cc_featured_news_category']) ? $instance['cc_featured_news_category'] : "";
		$cc_featured_news_description = isset($instance['cc_featured_news_description']) ? $instance['cc_featured_news_description'] : null;
		$cc_featured_news_show_excerpt = isset($instance['cc_featured_news_show_excerpt']) ? $instance['cc_featured_news_show_excerpt'] : false;
		$cc_featured_news_hero_content_display = isset($instance['cc_featured_news_hero_content_display']) ? $instance['cc_featured_news_hero_content_display'] : "excerpt";
		$cc_featured_news_content_display = isset($instance['cc_featured_news_content_display']) ? $instance['cc_featured_news_content_display'] : "excerpt";
		$cc_featured_news_aspect_ratio = isset($instance['cc_featured_news_aspect_ratio']) ? $instance['cc_featured_news_aspect_ratio'] : "3_2";
 
		//$cc_featured_news_show_excerpt = $instance[ 'cc_featured_news_show_excerpt' ] ? 'true' : 'false';

		echo $args['before_widget'];
        ?>
        <section class="widget featured-news <?php print $cc_featured_news_theme; ?> num-cols-<?php echo $cc_featured_news_numposts;?>">
            <div class="widget-wrapper">
                <header>
                    <?php if($cc_featured_news_title) { ?><h2><?php print $cc_featured_news_title; ?></h2><?php } ?>
                    <?php if($cc_featured_news_description){ ?><div class="widget-description"><?php print $cc_featured_news_description; ?></div><div style="clear:both;"></div><?php } ?>
                </header>
                <?php
                // The hero feature
                //START BACK HERE...
                // WRITE UOT THE FLOW THEN GO                             
                    $the_query = cc_widgets::get_homepage_features_query('querytest-hh', 1);
                    print_r($the_query);
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
                        <article class="hero">
                            <div class="item">
                                <div class="thumbnail ratio_<?php print $cc_featured_news_aspect_ratio; ?>" style="background-image:url(<?php print the_post_thumbnail_url('large'); ?>)">
                                    <a href="<?php print $url; ?>"><img src="/wp-content/themes/cc-chapter<?php //bloginfo('template_url'); ?>/images/ratio_<?php print $cc_featured_news_aspect_ratio; ?>.png" /></a>
                                </div>
                                <div class="teaser">
                                    <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                                    <div class="excerpt" <?php if($cc_featured_news_hero_content_display == 'hide'){ ?> style="display:none;" <?php } ?>><?php 
                                        if($cc_featured_news_hero_content_display == 'excerpt'){ print the_excerpt(); } 
                                        else { print the_content(); } ?>
                                    </div>
                                    <?php if($cc_featured_news_post_read_more) { ?><div class="more"><a href="<?php print $url; ?>"><?php print $cc_featured_news_post_read_more; ?></a></div><?php } ?>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                    <div class="widget-inner">
                    <?php 
                    // The other features
                        $the_query = cc_widgets::get_homepage_features_query($cc_featured_news_category, 'querytest', $cc_featured_news_numposts);
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
                            $custom = get_post_custom(); ?>
                            <article>
                                <div class="item">
                                <div class="thumbnail ratio_<?php print $cc_featured_news_aspect_ratio; ?>" style="background-image:url(<?php print the_post_thumbnail_url('large'); ?>)">
                                        <a href="<?php print $url; ?>"><img src="/wp-content/themes/cc-chapter<?php //bloginfo('template_url'); ?>/images/ratio_<?php print $cc_featured_news_aspect_ratio; ?>.png" /></a>
                                    </div>
                                    <!-- <div class="thumbnail">
                                        <?php 
                                            if(isset($custom['featured_video_link'])) {
                                        ?><div class="video"><?php
                                            echo do_shortcode( '[video  src="' . $custom['featured_video_link'][0] . '"]' );
                                        ?></div><?php
                                            } else { 
                                        ?>

                                        <a href="<?php print $url; ?>"><?php print the_post_thumbnail('large'); ?></a>
                                            <?php } ?>
                                    </div> -->
                                    <div class="teaser">
                                        <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                                        <div class="excerpt" <?php if($cc_featured_news_content_display == 'hide'){ ?> style="display:none;" <?php } ?>><?php 
                                            if($cc_featured_news_content_display == 'excerpt'){ print the_excerpt(); } 
                                            else { print the_content(); } ?>
                                        </div>
                                        <?php if($cc_featured_news_post_read_more) { ?><div class="more"><a href="<?php print $url; ?>"><?php print $cc_featured_news_post_read_more; ?></a></div><?php } ?>
                                    </div>
                                </div>
                            </article>
                            <?php 
                                }
                                // The four other features.
                                // If we have a special feature, then it is 3 featured and 1 special feature.
                                // Otherwise, it is 4 features.
                                $have_special_feature = FALSE;
                                $the_special_query = cc_widgets_get_homepage_features_query('querytest', 0);
                                if ($the_special_query->have_posts()){
                                $have_special_feature = TRUE;
                                }
                            ?>
                     </div>
                <!-- fix more link... category/type  -->
                <?php if($cc_featured_news_more) { ?><div class="more"><a href="/?post_type=post"><?php print $cc_featured_news_more; ?><i class="cc-icon-right-dir"></i></a></div><?php } ?>
            </div>
        </section>

    <?php
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        // TITLE
        extract($instance);
        $cc_featured_news_title = ( !empty( $instance['cc_featured_news_title'] ) ) ? $instance['cc_featured_news_title'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_description = ( !empty( $instance['cc_featured_news_description'] ) ) ? $instance['cc_featured_news_description'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_more = ( !empty( $instance['cc_featured_news_more'] ) ) ? $instance['cc_featured_news_more'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_post_read_more  = ( !empty( $instance['cc_featured_post_read_more'] ) ) ? $instance['cc_featured_post_read_more'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_numposts = ( !empty( $instance['cc_featured_news_numposts'] ) ) ? $instance['cc_featured_news_numposts'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_category = ( !empty( $instance['cc_featured_news_category'] ) ) ? $instance['cc_featured_news_category'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_show_excerpt  = ( !empty( $instance['cc_featured_news_show_excerpt'] ) ) ? $instance['cc_featured_news_show_excerpt'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_content_display = ( !empty( $instance['cc_featured_news_content_display'] ) ) ? $instance['cc_featured_news_content_display'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_hero_content_display  = ( !empty( $instance['cc_featured_news_hero_content_display'] ) ) ? $instance['cc_featured_news_hero_content_display'] : __( '', 'wpb_widget_domain' );
        $cc_featured_news_aspect_ratio = ( !empty( $instance['cc_featured_news_aspect_ratio'] ) ) ? $instance['cc_featured_news_aspect_ratio'] : __( '3_2', 'wpb_widget_domain' );
        $title = ( !empty( $instance['title'] ) ) ? $instance['title'] : __( '', 'wpb_widget_domain' );
        ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="hidden" value="<?php echo esc_attr( $cc_featured_news_category ); ?>" />
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_title ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_category' ); ?>"><?php _e( 'Highlight Category:' ); ?></label>
            <input class="widefat cc_featured_news_category" id="<?php echo $this->get_field_id( 'cc_featured_news_category' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_category' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_category ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_description' ); ?>" type="text"><?php echo esc_attr( $cc_featured_news_description ); ?></textarea></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_more' ); ?>"><?php _e( 'More Articles Link:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_more ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_post_read_more' ); ?>"><?php _e( 'Read More Link:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_post_read_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_post_read_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_post_read_more ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_numposts ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_featured_news_aspect_ratio' ); ?>"><?php _e( 'Aspect Ratio:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_aspect_ratio' ); ?>" name="<?php echo $this->get_field_name(cc_featured_news_aspect_ratio); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_aspect_ratio ); ?>" /></p>
            
        <div style="column-count: 2;">	
            <div>
                <label for="<?php echo $this->get_field_id( 'cc_featured_news_hero_content_display' ); ?>">Hero Content Display:</label>
                <p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_featured_news_hero_content_display' ); ?>" <?php checked( $cc_featured_news_hero_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_hero_content_display' ); ?>" />
                    <?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
                <p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_featured_news_hero_content_display' ); ?>" <?php checked( $cc_featured_news_hero_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_hero_content_display' ); ?>" />
                    <?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
                <p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_featured_news_hero_content_display' ); ?>" <?php checked( $cc_featured_news_hero_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_hero_content_display' ); ?>" />
                    <?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
            </p>	
            </div>	
            <div>
                <label for="<?php echo $this->get_field_id( 'cc_featured_news_content_display' ); ?>">Content Display:</label>
                <p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_featured_news_content_display' ); ?>" <?php checked( $cc_featured_news_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_content_display' ); ?>" />
                    <?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
                <p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_featured_news_content_display' ); ?>" <?php checked( $cc_featured_news_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_content_display' ); ?>" />
                    <?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
                <p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_featured_news_content_display' ); ?>" <?php checked( $cc_featured_news_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_featured_news_content_display' ); ?>" />
                    <?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
                <!-- <input class="widefat" id="<?php echo $this->get_field_id( 'cc_featured_news_show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'cc_featured_news_show_excerpt' ); ?>" type="text" value="<?php echo esc_attr( $cc_featured_news_show_excerpt ); ?>" /></p> -->
            </p>	
            </div>	
        </div>	<?php
    }
  /**
   * Save the options.
   */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_featured_news_title'] = ( ! empty( $new_instance['cc_featured_news_title'] ) ) ? strip_tags( $new_instance['cc_featured_news_title'],"<br>" ) : null;
		$instance['cc_featured_news_description'] = ( ! empty( $new_instance['cc_featured_news_description'] ) ) ? $new_instance['cc_featured_news_description']  : null;
		$instance['cc_featured_news_more'] = ( ! empty( $new_instance['cc_featured_news_more'] ) ) ? strip_tags( $new_instance['cc_featured_news_more'] ) : null;
		$instance['cc_featured_news_post_read_more'] = ( ! empty( $new_instance['cc_featured_news_post_read_more'] ) ) ? strip_tags( $new_instance['cc_featured_news_post_read_more'] ) : null;
		$instance['cc_featured_news_numposts'] = ( ! empty( $new_instance['cc_featured_news_numposts'] ) ) ? strip_tags( $new_instance['cc_featured_news_numposts'] ) : "3";
		$instance['cc_featured_news_category'] = ( ! empty( $new_instance['cc_featured_news_category'] ) ) ? strip_tags( $new_instance['cc_featured_news_category'] ) : null;
		$instance['cc_featured_news_show_excerpt'] = ( ! empty( $new_instance['cc_featured_news_show_excerpt'] ) ) ? strip_tags( $new_instance['cc_featured_news_show_excerpt'] ) : false;
		$instance['cc_featured_news_content_display'] = ( ! empty( $new_instance['cc_featured_news_content_display'] ) ) ? strip_tags( $new_instance['cc_featured_news_content_display'] ) : "excerpt";
		$instance['cc_featured_news_hero_content_display'] = ( ! empty( $new_instance['cc_featured_news_hero_content_display'] ) ) ? strip_tags( $new_instance['cc_featured_news_hero_content_display'] ) : "excerpt";
		$instance['cc_featured_news_aspect_ratio'] = ( ! empty( $new_instance['cc_featured_news_aspect_ratio'] ) ) ? strip_tags( $new_instance['cc_featured_news_aspect_ratio'] ) : "3_2";

		//$instance[ 'cc_featured_news_show_excerpt' ] = $new_instance[ 'cc_featured_news_show_excerpt' ];
		return $instance;
	}
}


function cc_featured_news_widget_init() {
  register_widget( 'CreativeCommons_Featured_News_Widget' );
}

add_action( 'widgets_init', 'cc_featured_news_widget_init', 1 );