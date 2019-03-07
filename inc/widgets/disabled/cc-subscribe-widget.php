<?php

class CreativeCommons_CCSubscribe_Widget extends WP_Widget {
	var $default_title, $default_size;

	/**
	 * Registers the widget with WordPress.
	 */
	function __construct() {
		parent::__construct( false, $name = __( 'CC Subscribe Widget: <span></span>', 'creativecommons' ) );
		$this->default_category           = 'homepage';
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	SIMPLE WIDGET TO DISPLAY CC SEARCH AS PER
	https://creativecommons.org/use-remix/  SENDING TO EITHER
	https://search.creativecommons.org/?query=GREG  OR
	https://ccsearch.creativecommons.org/search?q=GREG
	 */
	function widget( $args, $instance ) {

		// Load the options into variables
		$cc_subscribe_title       = isset( $instance['cc_subscribe_title'] ) ? $instance['cc_subscribe_title'] : null;
		$cc_subscribe_description = isset( $instance['cc_subscribe_description'] ) ? $instance['cc_subscribe_description'] : null;

		// $cc_subscribe_show_excerpt = $instance[ 'cc_subscribe_show_excerpt' ] ? 'true' : 'false';
		echo $args['before_widget'];

		?>
<section class="featured <?php print $cc_subscribe_theme; ?> num-cols-<?php echo $cc_subscribe_numposts; ?>">
	<header>
		<?php
		if ( $cc_subscribe_title ) {
			?>
			<h2><?php print $cc_subscribe_title; ?></h2><?php } ?>
		<?php
		if ( $cc_subscribe_description ) {
			?>
			<div class="widget-description"><?php print $cc_subscribe_description; ?></div><div style="clear:both;"></div><?php } ?>
	</header>
		<?php
		// The hero feature
			$the_query = cc_widgets_get_featured_posts_query( $cc_subscribe_category, 'hero', 1 );
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

			?>
		<article class="hero">
			<div class="item">
				<div class="thumbnail ratio_<?php print $cc_subscribe_aspect_ratio; ?>" style="background-image:url(<?php print the_post_thumbnail_url( 'large' ); ?>)">
					<a href="<?php print $url; ?>"><img src="/wp-content/themes/cc-chapter<?php // bloginfo('template_url'); ?>/images/ratio_<?php print $cc_subscribe_aspect_ratio; ?>.png" /></a>
				</div>
				<div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
					<div class="excerpt" 
					<?php
					if ( $cc_subscribe_hero_content_display == 'hide' ) {
						?>
						 style="display:none;" <?php } ?>>
																					 <?php
																						if ( $cc_subscribe_hero_content_display == 'excerpt' ) {
																							print the_excerpt(); } else {
																																								print the_content(); }
																							?>
					</div>
					<?php
					if ( $cc_subscribe_post_read_more ) {
						?>
						<div class="more"><a href="<?php print $url; ?>"><?php print $cc_subscribe_post_read_more; ?></a></div><?php } ?>
				</div>
			</div>
		</article>
			<?php } ?>
	<div class="widget-inner">
		<?php

		// The other features
			$the_query = cc_widgets_get_featured_posts_query( $cc_subscribe_category, 'highlight', $cc_subscribe_numposts );
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$hero_post_id = get_the_ID();
			$url          = get_permalink();
			$categories   = get_the_category();

			if ( ! empty( $categories ) ) {
				$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">???' . esc_html( $categories[0]->name ) . '</a>';
			} else {
				$category_link = null;
			}
			$custom = get_post_custom();

			?>
		<article>
			<div class="item">
				<div class="thumbnail">
				<?php
				if ( isset( $custom['featured_video_link'] ) ) {
					?>
					<div class="video">
					<?php
					echo do_shortcode( '[video  src="' . $custom['featured_video_link'][0] . '"]' );
					?>
					</div>
					<?php
				} else {
					?>

					<a href="<?php print $url; ?>"><?php print the_post_thumbnail( 'large' ); ?></a>
					<?php } ?>
				</div>
				<div class="teaser">
					<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
					<div class="excerpt" 
					<?php
					if ( $cc_subscribe_content_display == 'hide' ) {
						?>
						 style="display:none;" <?php } ?>>
																				<?php
																				if ( $cc_subscribe_content_display == 'excerpt' ) {
																					print the_excerpt(); } else {
																																				print the_content(); }
																					?>
					</div>					
					<?php
					if ( $cc_subscribe_post_read_more ) {
						?>
						<div class="more"><a href="<?php print $url; ?>"><?php print $cc_subscribe_post_read_more; ?></a></div><?php } ?>
				</div>
			</div>
		</article>
			<?php
		}

			// The four other features.
			// If we have a special feature, then it is 3 featured and 1 special feature.
			// Otherwise, it is 4 features.
			$have_special_feature = false;
			$the_special_query    = cc_widgets_get_homepage_features_query( 'program', 0 );
		if ( $the_special_query->have_posts() ) {
			$have_special_feature = true;
		}
		?>
		<!-- fix more link... category/type  -->
		<?php
		if ( $cc_subscribe_more ) {
			?>
			<div class="more"><a href="/?post_type=post"><?php print $cc_subscribe_more; ?><i class="cc-icon-right-dir"></i></a></div><?php } ?>
	</div>
</section>

		<?php
		echo $args['after_widget'];
	}
	/*
	TEXT		TITLE
	TEXTAREA	DESCRIPTION (WYSIWYG EDITOR)
	TEXT		MORE ARTICLES
	CATAGORY
	COLOR SCHEME (later)
	NUMBER OF POSTS
	Has Hero?

	*/
	public function form( $instance ) {
		// TITLE
		if ( isset( $instance['cc_subscribe_title'] ) ) {
						$cc_subscribe_title = $instance['cc_subscribe_title'];} else {
			$cc_subscribe_title = __( '', 'wpb_widget_domain' );}
						// DESCRIPTION
						if ( isset( $instance['cc_subscribe_description'] ) ) {
										$cc_subscribe_description = $instance['cc_subscribe_description'];} else {
							$cc_subscribe_description = __( '', 'wpb_widget_domain' ); }
										// MORE ARTICLES
										if ( isset( $instance['cc_subscribe_more'] ) ) {
														$cc_subscribe_more = $instance['cc_subscribe_more']; } else {
											$cc_subscribe_more = __( '', 'wpb_widget_domain' ); }
														// READ MORE
														if ( isset( $instance['cc_subscribe_post_read_more'] ) ) {
																		$cc_subscribe_post_read_more = $instance['cc_subscribe_post_read_more'];} else {
															$cc_subscribe_post_read_more = __( '', 'wpb_widget_domain' ); }
																		// Repeat for number of posts
																		if ( isset( $instance['cc_subscribe_numposts'] ) ) {
																						$cc_subscribe_numposts = $instance['cc_subscribe_numposts'];
																		} else {
																			$cc_subscribe_numposts = __( '3', 'wpb_widget_domain' );}
																		// CATEGORY
																		if ( isset( $instance['cc_subscribe_category'] ) ) {
																						$cc_subscribe_category = $instance['cc_subscribe_category'];
																		} else {
																			$cc_subscribe_category = __( '', 'wpb_widget_domain' );}
																		// show excerpt
																		if ( isset( $instance['cc_subscribe_show_excerpt'] ) ) {
																						$cc_subscribe_show_excerpt = $instance['cc_subscribe_show_excerpt'];
																		} else {
																			$cc_subscribe_show_excerpt = __( '', 'wpb_widget_domain' );}
																		// Content Display Type
																		if ( isset( $instance['cc_subscribe_content_display'] ) ) {
																						$cc_subscribe_content_display = $instance['cc_subscribe_content_display'];
																		} else {
																			$cc_subscribe_content_display = __( 'excerpt', 'wpb_widget_domain' );}

																		if ( isset( $instance['cc_subscribe_hero_content_display'] ) ) {
																						$cc_subscribe_hero_content_display = $instance['cc_subscribe_hero_content_display'];
																		} else {
																			$cc_subscribe_hero_content_display = __( 'excerpt', 'wpb_widget_domain' );}
																		// Image Ratio
																		if ( isset( $instance['cc_subscribe_aspect_ratio'] ) ) {
																						$cc_subscribe_aspect_ratio = $instance['cc_subscribe_aspect_ratio'];
																		} else {
																			$cc_subscribe_aspect_ratio = __( '3_2', 'wpb_widget_domain' );}
																		// Widget Title
																		if ( isset( $instance['title'] ) ) {
																						$title = $instance['title'];
																		} else {
																			$title = __( 'TEST', 'wpb_widget_domain' );}

																		?>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="hidden" value="<?php echo esc_attr( $cc_subscribe_category ); ?>" />
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_title ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_category' ); ?>"><?php _e( 'Highlight Category:' ); ?></label>
		<input class="widefat cc_subscribe_category" id="<?php echo $this->get_field_id( 'cc_subscribe_category' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_category' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_category ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_description' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_description' ); ?>" type="text"><?php echo esc_attr( $cc_subscribe_description ); ?></textarea></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_more' ); ?>"><?php _e( 'More Articles Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_more ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_post_read_more' ); ?>"><?php _e( 'Read More Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_post_read_more' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_post_read_more' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_post_read_more ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_numposts ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_subscribe_aspect_ratio' ); ?>"><?php _e( 'Aspect Ratio:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_aspect_ratio' ); ?>" name="<?php echo $this->get_field_name( cc_subscribe_aspect_ratio ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_aspect_ratio ); ?>" /></p>
		
	<div style="column-count: 2;">	
		<div>
			<label for="<?php echo $this->get_field_id( 'cc_subscribe_hero_content_display' ); ?>">Hero Content Display:</label>
			<p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_subscribe_hero_content_display' ); ?>" <?php checked( $cc_subscribe_hero_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_subscribe_hero_content_display' ); ?>" <?php checked( $cc_subscribe_hero_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_subscribe_hero_content_display' ); ?>" <?php checked( $cc_subscribe_hero_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_hero_content_display' ); ?>" />
				<?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
		</p>	
		</div>	
		<div>
			<label for="<?php echo $this->get_field_id( 'cc_subscribe_content_display' ); ?>">Content Display:</label>
			<p><label><input type="radio" value="excerpt" name="<?php echo $this->get_field_name( 'cc_subscribe_content_display' ); ?>" <?php checked( $cc_subscribe_content_display, 'excerpt' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_content_display' ); ?>" />
				<?php esc_attr_e( 'Show the Excerpt', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="content" name="<?php echo $this->get_field_name( 'cc_subscribe_content_display' ); ?>" <?php checked( $cc_subscribe_content_display, 'content' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_content_display' ); ?>" />
				<?php esc_attr_e( 'Show Full Content', 'text_domain' ); ?></label></p>
			<p><label><input type="radio" value="hide" name="<?php echo $this->get_field_name( 'cc_subscribe_content_display' ); ?>" <?php checked( $cc_subscribe_content_display, 'hide' ); ?> id="<?php echo $this->get_field_id( 'cc_subscribe_content_display' ); ?>" />
				<?php esc_attr_e( 'Hide Content', 'text_domain' ); ?></label></p>
			<!-- <input class="widefat" id="<?php echo $this->get_field_id( 'cc_subscribe_show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'cc_subscribe_show_excerpt' ); ?>" type="text" value="<?php echo esc_attr( $cc_subscribe_show_excerpt ); ?>" /></p> -->
		</p>	
		</div>	
	</div>	
	<script>jQuery("#<?php echo $this->get_field_id( 'cc_subscribe_category' ); ?>").parent().parent().parent().parent().parent().children(".widget-top").children(".widget-title").children("h3").children(".in-widget-title:after").css( "content","testtoo" );</script>
		<?php

		$args = array(
			'taxonomy'         => 'cc_highlight',
			'name'             => $this->get_field_name( 'cc_subscribe_category' ),
			'id'               => $this->get_field_id( 'cc_subscribe_category' ),
			'selected'         => $category->slug,
			'show_option_none' => 'Select Category',
			'hide_if_empty'    => false,
			'value_field'      => 'slug',
		);
		// wp_dropdown_categories($args );
	}

	/**
	 * Save the options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                                      = array();
		$instance['title']                             = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_subscribe_title']                = ( ! empty( $new_instance['cc_subscribe_title'] ) ) ? strip_tags( $new_instance['cc_subscribe_title'] ) : null;
		$instance['cc_subscribe_description']          = ( ! empty( $new_instance['cc_subscribe_description'] ) ) ? strip_tags( $new_instance['cc_subscribe_description'] ) : null;
		$instance['cc_subscribe_more']                 = ( ! empty( $new_instance['cc_subscribe_more'] ) ) ? strip_tags( $new_instance['cc_subscribe_more'] ) : null;
		$instance['cc_subscribe_post_read_more']       = ( ! empty( $new_instance['cc_subscribe_post_read_more'] ) ) ? strip_tags( $new_instance['cc_subscribe_post_read_more'] ) : null;
		$instance['cc_subscribe_numposts']             = ( ! empty( $new_instance['cc_subscribe_numposts'] ) ) ? strip_tags( $new_instance['cc_subscribe_numposts'] ) : '3';
		$instance['cc_subscribe_category']             = ( ! empty( $new_instance['cc_subscribe_category'] ) ) ? strip_tags( $new_instance['cc_subscribe_category'] ) : null;
		$instance['cc_subscribe_show_excerpt']         = ( ! empty( $new_instance['cc_subscribe_show_excerpt'] ) ) ? strip_tags( $new_instance['cc_subscribe_show_excerpt'] ) : false;
		$instance['cc_subscribe_content_display']      = ( ! empty( $new_instance['cc_subscribe_content_display'] ) ) ? strip_tags( $new_instance['cc_subscribe_content_display'] ) : 'excerpt';
		$instance['cc_subscribe_hero_content_display'] = ( ! empty( $new_instance['cc_subscribe_hero_content_display'] ) ) ? strip_tags( $new_instance['cc_subscribe_hero_content_display'] ) : 'excerpt';
		$instance['cc_subscribe_aspect_ratio']         = ( ! empty( $new_instance['cc_subscribe_aspect_ratio'] ) ) ? strip_tags( $new_instance['cc_subscribe_aspect_ratio'] ) : '3_2';

		// $instance[ 'cc_subscribe_show_excerpt' ] = $new_instance[ 'cc_subscribe_show_excerpt' ];
		return $instance;
	}
}


function cc_homepage_widget_name_widget_init() {
	register_widget( 'CreativeCommons_CCSubscribe_Widget' );
}

add_action( 'widgets_init', 'cc_homepage_widget_name_widget_init' );
