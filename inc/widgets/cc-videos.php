<?php

class CreativeCommons_Videos extends WP_Widget {
	var $default_title, $default_size;

	/**
	 * Registers the widget with WordPress.
	 */
	function __construct() {
		parent::__construct( false, $name = __( 'CC Videos <span></span>', 'creativecommons' ) );
		$this->default_category           = 'homepage';
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

		// Load the options into variables
		$cc_video_title                = isset( $instance['cc_video_title'] ) ? $instance['cc_video_title'] : null;
		$cc_video_more                 = isset( $instance['cc_video_more'] ) ? $instance['cc_video_more'] : null;
		$cc_video_post_read_more       = isset( $instance['cc_video_post_read_more'] ) ? $instance['cc_video_post_read_more'] : null;
		$cc_video_numposts             = isset( $instance['cc_video_numposts'] ) ? $instance['cc_video_numposts'] : '4';
		$cc_video_description          = isset( $instance['cc_video_description'] ) ? $instance['cc_video_description'] : null;
		$cc_video_show_excerpt         = isset( $instance['cc_video_show_excerpt'] ) ? $instance['cc_video_show_excerpt'] : false;
		$cc_video_hero_content_display = isset( $instance['cc_video_hero_content_display'] ) ? $instance['cc_video_hero_content_display'] : 'excerpt';
		$cc_video_content_display      = isset( $instance['cc_video_content_display'] ) ? $instance['cc_video_content_display'] : 'excerpt';
		// $cc_video_aspect_ratio = isset($instance['cc_video_aspect_ratio']) ? $instance['cc_video_aspect_ratio'] : "3_2";
		// $cc_video_show_excerpt = $instance[ 'cc_video_show_excerpt' ] ? 'true' : 'false';
		echo $args['before_widget'];
		$noheader = 'no-header';
		if ( isset( $cc_video_title ) || isset( $cc_video_description ) ) {
			$noheader = false;
		}
		// add  $cc_video_theme to section classes
		?>
	<section class="featured-videos widget  num-cols-<?php echo $cc_video_numposts; ?>  <?php echo $noheader; ?>">
		<?php
		if ( ! $noheader ) {
			?>
			<header>
				<?php
				if ( $cc_video_title ) {
					?>
					<h2><?php print $cc_video_title; ?></h2><?php } ?>
				<?php
				if ( $cc_video_description ) {
					?>
					<div class="widget-description"><?php print $cc_video_description; ?></div><div style="clear:both;"></div><?php } ?>
			</header>
		<?php } ?>
		<div class="widget-inner">
		<?php

		// The other features
			$the_query = cc_widgets::get_featured_posts_by_taxonomy_query( 'video', 'highlight', $cc_video_numposts );
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$hero_post_id = get_the_ID();
			$url          = get_permalink();
			$categories   = get_the_category();

			if ( ! empty( $categories ) ) {
				$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			} else {
				$category_link = null;
			}
			$custom = get_post_custom();
			?>
				<article>
					<div class="item">
						<div class="teaser">
							<div class="thumbnail" 
							<?php
							if ( $cc_video_content_display == 'hide' ) {
								?>
								 style="display:none;" <?php } ?>><div class="video">
								<?php
								if ( $cc_video_content_display == 'excerpt' ) {
									print the_excerpt(); 
								} else {
									print the_content(); 
								}
									?>
							</div>
							</div>
							<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
							<?php
							if ( $cc_video_post_read_more ) {
								?>
								<div class="more"><a href="<?php print $url; ?>"><?php print $cc_video_post_read_more; ?></a></div><?php } ?>
						</div>
					</div>
				</article>
			<?php
		}
			// The four other features.
			// If we have a special feature, then it is 3 featured and 1 special feature.
			// Otherwise, it is 4 features.
			$have_special_feature = false;
			$the_special_query    = cc_widgets::get_homepage_features_query( 'program', 0 );
		if ( $the_special_query->have_posts() ) {
			$have_special_feature = true;
		}
		?>
		</div>

		<!-- fix more link... category/type  -->
		<?php
		if ( $cc_video_more ) {
			?>
			<div class="more"><a href="/?post_type=post"><?php print $cc_video_more; ?><i class="cc-icon-right-dir"></i></a></div><?php } ?>
	</section>

		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$cc_video_title                = ( ! empty( $instance['cc_video_title'] ) ) ? $instance['cc_video_title'] : __( 'Videos', 'wpb_widget_domain' );
		$cc_video_description          = ( ! empty( $instance['cc_video_description'] ) ) ? $instance['cc_video_description'] : __( 'Here are some featured videos to help explain some of our focus areas and how CC works. <a href="https://www.youtube.com/user/creativecommons" target="_blank">Check out our youtube page for more videos</a>.', 'wpb_widget_domain' );
		$cc_video_more                 = ( ! empty( $instance['cc_video_more'] ) ) ? $instance['cc_video_more'] : __( '', 'wpb_widget_domain' );
		$cc_video_post_read_more       = ( ! empty( $instance['cc_video_post_read_more'] ) ) ? $instance['cc_video_post_read_more'] : __( '', 'wpb_widget_domain' );
		$cc_video_numposts             = ( ! empty( $instance['cc_video_numposts'] ) ) ? $instance['cc_video_numposts'] : __( '3', 'wpb_widget_domain' );
		$cc_video_content_display      = ( ! empty( $instance['cc_video_content_display'] ) ) ? $instance['cc_video_content_display'] : __( 'excerpt', 'wpb_widget_domain' );
		$cc_video_hero_content_display = ( ! empty( $instance['cc_video_hero_content_display'] ) ) ? $instance['cc_video_hero_content_display'] : __( 'hide', 'wpb_widget_domain' );
		$cc_video_show_excerpt         = ( ! empty( $instance['cc_video_show_excerpt'] ) ) ? $instance['cc_video_show_excerpt'] : __( 'true', 'wpb_widget_domain' );
		$title                         = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Videos', 'wpb_widget_domain' );

		?>
		<p><label for="<?php echo $this->get_field_id( 'cc_video_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cc_video_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_video_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_video_title ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'cc_video_description' ); ?>"><?php _e( 'Description:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_video_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_video_description' ); ?>" type="text"><?php echo esc_attr( $cc_video_description ); ?></textarea></p>
		<p><label for="<?php echo $this->get_field_id( 'cc_video_more' ); ?>"><?php _e( 'More Articles Link:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cc_video_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_video_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_video_more ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'cc_video_post_read_more' ); ?>"><?php _e( 'Read More Link:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cc_video_post_read_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_video_post_read_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_video_post_read_more ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'cc_video_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cc_video_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_video_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_video_numposts ); ?>" /></p>
			
		<div style="">	
			<div>
				<label for="<?php echo $this->get_field_id( 'cc_video_content_display' ); ?>">Content Display:</label>
				<p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_video_content_display' ); ?>" <?php checked( $cc_video_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_video_content_display' ); ?>" />
					<?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
				<p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_video_content_display' ); ?>" <?php checked( $cc_video_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_video_content_display' ); ?>" />
					<?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
				<p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_video_content_display' ); ?>" <?php checked( $cc_video_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_video_content_display' ); ?>" />
					<?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
			</p>	
			</div>	
		</div>	
		<?php
	}
	/**
	 * Save the options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                         = array();
		$instance['title']                = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_video_title']       = ( ! empty( $new_instance['cc_video_title'] ) ) ? strip_tags( $new_instance['cc_video_title'], '<br>' ) : null;
		$instance['cc_video_description'] = ( ! empty( $new_instance['cc_video_description'] ) ) ? $new_instance['cc_video_description'] : null;
		$instance['cc_video_numposts']    = ( ! empty( $new_instance['cc_video_numposts'] ) ) ? strip_tags( $new_instance['cc_video_numposts'] ) : '3';

		$instance['cc_video_more']                 = ( ! empty( $new_instance['cc_video_more'] ) ) ? strip_tags( $new_instance['cc_video_more'] ) : null;
		$instance['cc_video_post_read_more']       = ( ! empty( $new_instance['cc_video_post_read_more'] ) ) ? strip_tags( $new_instance['cc_video_post_read_more'] ) : null;
		$instance['cc_video_show_excerpt']         = ( ! empty( $new_instance['cc_video_show_excerpt'] ) ) ? strip_tags( $new_instance['cc_video_show_excerpt'] ) : true;
		$instance['cc_video_content_display']      = ( ! empty( $new_instance['cc_video_content_display'] ) ) ? strip_tags( $new_instance['cc_video_content_display'] ) : 'hide';
		$instance['cc_video_hero_content_display'] = ( ! empty( $new_instance['cc_video_hero_content_display'] ) ) ? strip_tags( $new_instance['cc_video_hero_content_display'] ) : 'hide';
		// $instance['cc_video_aspect_ratio'] = ( ! empty( $new_instance['cc_video_aspect_ratio'] ) ) ? strip_tags( $new_instance['cc_video_aspect_ratio'] ) : "3_2";
		// $instance[ 'cc_video_show_excerpt' ] = $new_instance[ 'cc_video_show_excerpt' ];
		return $instance;
	}
}


function cc_homepage_video_widget_init() {
	register_widget( 'CreativeCommons_Videos' );
}

add_action( 'widgets_init', 'cc_homepage_video_widget_init', 1 );
