<?php

class CreativeCommons_Programs extends WP_Widget {
	var $default_title, $default_size;

	/**
	* Registers the widget with WordPress.
	*/
	function __construct() {
		parent::__construct(false, $name = __("CC Programs <span></span>", 'creativecommons'));
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
		$cc_programs_title = isset($instance['cc_programs_title']) ? $instance['cc_programs_title'] : null;
		$cc_programs_more = isset($instance['cc_programs_more']) ? $instance['cc_programs_more'] :null;
		$cc_programs_post_read_more = isset($instance['cc_programs_post_read_more']) ? $instance['cc_programs_post_read_more'] : null;
		$cc_programs_numposts = isset($instance['cc_programs_numposts']) ? $instance['cc_programs_numposts'] : "4";
		$cc_programs_description = isset($instance['cc_programs_description']) ? $instance['cc_programs_description'] : null;
		$cc_programs_show_excerpt = isset($instance['cc_programs_show_excerpt']) ? $instance['cc_programs_show_excerpt'] : false;
		$cc_programs_content_display = isset($instance['cc_programs_content_display']) ? $instance['cc_programs_content_display'] : "excerpt";
 
		//$cc_programs_show_excerpt = $instance[ 'cc_programs_show_excerpt' ] ? 'true' : 'false';

		echo $args['before_widget'];
		$noheader = "no-header";
		if(isset($cc_programs_title) || isset($cc_programs_description)){
			$noheader = false;
		}
		// add  $cc_links_theme to section classes 
        ?>
        <section class="featured-programs widget  num-cols-<?php echo $cc_programs_numposts;?>  <?php echo $noheader;?>">

            <?php 
            if(!$noheader){ ?>
                <header>
                    <?php if($cc_programs_title) { ?><h2><?php print $cc_programs_title; ?></h2><?php } ?>
                    <?php if($cc_programs_description){ ?><div class="widget-description"><?php print $cc_programs_description; ?></div><div style="clear:both;"></div><?php } ?>
                </header>
            <?php }  ?>
            <div class="widget-inner">
                <?php 
                    
                // The other features
                $the_query = cc_widgets_get_featured_posts_by_taxonomy_query("program", 'highlight', $cc_programs_numposts);
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
                    $custom = get_post_custom();	
                    ?>
                    <article>
                        <div class="item">
                            <div class="thumbnail">
                                <?php 
                                    if(isset($custom['featured_video_link'])) {
                                ?><div class="video"><?php
                                    echo do_shortcode( '[video  src="' . $custom['featured_video_link'][0] . '"]' );
                                ?></div><?php
                                    } else { 
                                ?>

                                <a href="<?php print $url; ?>"><?php print the_post_thumbnail('large'); ?></a>
                                    <?php } ?>
                            </div>
                            <div class="teaser">
                                <h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title() ?></a></h3>
                                <div class="excerpt" <?php if($cc_programs_content_display == 'hide'){ ?> style="display:none;" <?php } ?>><?php 
                                    if($cc_programs_content_display == 'excerpt'){ print the_excerpt(); } 
                                    else { print the_content(); } ?>
                                </div>
                                <?php if($cc_programs_post_read_more) { ?><div class="more"><a href="<?php print $url; ?>"><?php print $cc_programs_post_read_more; ?></a></div><?php } ?>
                            </div>
                        </div>
                    </article>
                    <?php 
                    }
                    // The four other features.
                    // If we have a special feature, then it is 3 featured and 1 special feature.
                    // Otherwise, it is 4 features.
                    $have_special_feature = FALSE;
                    $the_special_query = cc_widgets_get_homepage_features_query('program', 0);
                    if ($the_special_query->have_posts()){
                    $have_special_feature = TRUE;
                    }
                ?>
            </div>

            <!-- fix more link... category/type  -->
            <?php if($cc_programs_more) { ?><div class="more"><a href="/?post_type=post"><?php print $cc_programs_more; ?><i class="cc-icon-right-dir"></i></a></div><?php } ?>
        </section>

    <?php
    echo $args['after_widget'];
	}

    public function form( $instance ) {
        $cc_programs_title = ( !empty( $instance[ 'cc_programs_title' ] ) ) ? $instance[ 'cc_programs_title' ] : __( 'Featured</br>Program Areas', 'wpb_widget_domain' );
        $cc_programs_description = ( !empty( $instance[ 'cc_programs_description' ] ) ) ? $instance[ 'cc_programs_description' ] : __( '', 'wpb_widget_domain' );
        $cc_programs_more = ( !empty( $instance[ 'cc_programs_more' ] ) ) ? $instance[ 'cc_programs_more' ] : __( 'See all program areas', 'wpb_widget_domain' );
        $cc_programs_post_read_more = ( !empty( $instance[ 'cc_programs_post_read_more' ] ) ) ? $instance[ 'cc_programs_post_read_more' ] : __( '', 'wpb_widget_domain' );
        $cc_programs_numposts = ( !empty( $instance[ 'cc_programs_numposts' ] ) ) ? $instance[ 'cc_programs_numposts' ] : __( '4', 'wpb_widget_domain' );
        $cc_programs_content_display = ( !empty( $instance[ 'cc_programs_content_display' ] ) ) ? $instance[ 'cc_programs_content_display' ] : __( 'excerpt', 'wpb_widget_domain' );
        $title = ( !empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'Programs', 'wpb_widget_domain' );
        ?>

        <p><label for="<?php echo $this->get_field_id( 'cc_programs_title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_programs_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_programs_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_programs_title ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_programs_description' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_programs_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_programs_description' ); ?>" type="text"><?php echo esc_attr( $cc_programs_description ); ?></textarea></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_programs_more' ); ?>"><?php _e( 'More Articles Link:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_programs_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_programs_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_programs_more ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_programs_post_read_more' ); ?>"><?php _e( 'Read More Link:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_programs_post_read_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_programs_post_read_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_programs_post_read_more ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_programs_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_programs_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_programs_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_programs_numposts ); ?>" /></p>
            

        <p>
            <label for="<?php echo $this->get_field_id( 'cc_programs_content_display' ); ?>">Content Display:</label>
            <p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_programs_content_display' ); ?>" <?php checked( $cc_programs_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_programs_content_display' ); ?>" />
                <?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
            <p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_programs_content_display' ); ?>" <?php checked( $cc_programs_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_programs_content_display' ); ?>" />
                <?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
            <p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_programs_content_display' ); ?>" <?php checked( $cc_programs_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_programs_content_display' ); ?>" />
                <?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
        </p>	
        <?php
    }
  /**
   * Save the options.
   */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_programs_title'] = ( ! empty( $new_instance['cc_programs_title'] ) ) ? strip_tags( $new_instance['cc_programs_title'],"<br>" ) : null;
		$instance['cc_programs_description'] = ( ! empty( $new_instance['cc_programs_description'] ) ) ? $new_instance['cc_programs_description']  : null;
		$instance['cc_programs_more'] = ( ! empty( $new_instance['cc_programs_more'] ) ) ? strip_tags( $new_instance['cc_programs_more'] ) : null;
		$instance['cc_programs_post_read_more'] = ( ! empty( $new_instance['cc_programs_post_read_more'] ) ) ? strip_tags( $new_instance['cc_programs_post_read_more'] ) : null;
		$instance['cc_programs_numposts'] = ( ! empty( $new_instance['cc_programs_numposts'] ) ) ? strip_tags( $new_instance['cc_programs_numposts'] ) : "4";
		$instance['cc_programs_content_display'] = ( ! empty( $new_instance['cc_programs_content_display'] ) ) ? strip_tags( $new_instance['cc_programs_content_display'] ) : "excerpt";

		return $instance;
	}
}


function cc_homepage_programs_widget_init() {
  register_widget( 'CreativeCommons_Programs' );
}

add_action( 'widgets_init', 'cc_homepage_programs_widget_init', 1 );
