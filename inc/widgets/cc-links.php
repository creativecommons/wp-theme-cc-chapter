<?php

class CreativeCommons_Links extends WP_Widget {
	var $default_title, $default_size;

	/**
	 * Registers the widget with WordPress.
	 */
	function __construct() {
		parent::__construct( false, $name = __( 'CC Links: <span></span>', 'creativecommons' ) );
		$this->default_category           = 'homepage';
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {
		// Load the options into variables
		$cc_links_title          = isset( $instance['cc_links_title'] ) ? $instance['cc_links_title'] : null;
		$cc_links_more           = isset( $instance['cc_links_more'] ) ? $instance['cc_links_more'] : null;
		$cc_links_post_read_more = isset( $instance['cc_links_post_read_more'] ) ? $instance['cc_links_post_read_more'] : null;
		$cc_links_numposts       = isset( $instance['cc_links_numposts'] ) ? $instance['cc_links_numposts'] : '3';
		$cc_links_description    = isset( $instance['cc_links_description'] ) ? $instance['cc_links_description'] : null;

		echo $args['before_widget'];
		$noheader = 'no-header';
		if ( isset( $cc_links_title ) || isset( $cc_links_description ) ) {
			$noheader = false;
		}
		// add  $cc_links_theme to section classes
		?>
		<section class="featured-links widget  num-cols-<?php echo $cc_links_numposts; ?>  <?php echo $noheader; ?>">
		<?php
		if ( ! $noheader ) {
			?>
			<header>
				<?php
				if ( $cc_links_title ) {
					?>
					<h2><?php print $cc_links_title; ?></h2><?php } ?>
				<?php
				if ( $cc_links_description ) {
					?>
					<div class="widget-description"><?php print $cc_links_description; ?></div><div style="clear:both;"></div><?php } ?>
			</header>
			<?php } ?>
			<div class="widget-inner">
				<?php
				// Featured Links Posts
				// $blog_id = get_current_blog_id();
				// switch_to_blog($blog_id);
				$the_query = cc_widgets::get_featured_posts_by_taxonomy_query( 'links', 'highlight', $cc_links_numposts );
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$url        = get_permalink();
					$categories = get_the_category();

					if ( ! empty( $categories ) ) {
						$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
					} else {
						$category_link = null;
					}
					$custom = get_post_custom();

					?>
					<article>
						<div class="item">
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="thumbnail">
								<a href="<?php print $url; ?>"><?php print the_post_thumbnail( 'large' ); ?></a>
							</div>
						<?php } ?>
							<div class="teaser">
								<h3 class="title"><a href="<?php print $url; ?>"><?php print get_the_title(); ?></a></h3>
								<div class="excerpt">
									<?php print the_content(); ?>
								</div>
							</div>
						</div>
					</article>
				<?php } ?>
			</div>
		</section>

		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$cc_links_title       = ( ! empty( $instance['cc_links_title'] ) ) ? $instance['cc_links_title'] : __( '', 'wpb_widget_domain' );
		$cc_links_description = ( ! empty( $instance['cc_links_description'] ) ) ? $instance['cc_links_description'] : __( '', 'wpb_widget_domain' );
		$cc_links_numposts    = ( ! empty( $instance['cc_links_numposts'] ) ) ? $instance['cc_links_numposts'] : __( '3', 'wpb_widget_domain' );
		?>
	<!-- WIDGET INTERFACE -->
	<p>Displays the content of posts with the category of <strong>Link</strong>.
	The posts content should be formated as a short list of links.</p>

	<p><label for="<?php echo $this->get_field_id( 'cc_links_title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_links_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_links_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_links_title ); ?>" /></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_links_description' ); ?>"><?php _e( 'Description:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_links_description' ); ?>" name="<?php echo $this->get_field_name( 'cc_links_description' ); ?>" type="text"><?php echo esc_attr( $cc_links_description ); ?></textarea></p>
	<p><label for="<?php echo $this->get_field_id( 'cc_links_numposts' ); ?>"><?php _e( 'Number of Posts:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cc_links_numposts' ); ?>" name="<?php echo $this->get_field_name( 'cc_links_numposts' ); ?>" type="text" value="<?php echo esc_attr( $cc_links_numposts ); ?>" /></p>
		<?php
	}
	/**
	 * Save the options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                          = array();
		$instance['cc_links_title']        = ( ! empty( $new_instance['cc_links_title'] ) ) ? strip_tags( $new_instance['cc_links_title'], '<br>' ) : null;
		$instance['cc_links_description']  = ( ! empty( $new_instance['cc_links_description'] ) ) ? $new_instance['cc_links_description'] : null;
		$instance['cc_links_numposts']     = ( ! empty( $new_instance['cc_links_numposts'] ) ) ? strip_tags( $new_instance['cc_links_numposts'] ) : '3';
		$instance['cc_links_show_excerpt'] = ( ! empty( $new_instance['cc_links_show_excerpt'] ) ) ? strip_tags( $new_instance['cc_links_show_excerpt'] ) : false;

		return $instance;
	}
}


function cc_homepage_links_widget_init() {
	register_widget( 'CreativeCommons_Links' );
}

add_action( 'widgets_init', 'cc_homepage_links_widget_init', 1 );
