<?php

class CreativeCommons_Header_Links extends WP_Widget {
	var $default_title, $default_size;

	/**
	 * Registers the widget with WordPress.
	 */
	function __construct() {
		parent::__construct( false, $name = __( 'CC Header Links <span></span>', 'creativecommons' ) );
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
		$cc_header_links_title   = isset( $instance['cc_header_links_title'] ) ? $instance['cc_header_links_title'] : null;
		$cc_header_links_content = isset( $instance['cc_header_links_content'] ) ? $instance['cc_header_links_content'] : null;
		// add  $cc_header_links_theme to section classes
		echo $cc_header_links_content;
	}

	public function form( $instance ) {
		$cc_header_links_title   = ( ! empty( $instance['cc_header_links_title'] ) ) ? $instance['cc_header_links_title'] : __( '', 'wpb_widget_domain' );
		$cc_header_links_content = ( ! empty( $instance['cc_header_links_content'] ) ) ? $instance['cc_header_links_content'] : __( '<a href="htt://creativecommons.org" class="link_to_cc_org">Visit International Site <i class="cc-icon-right-dir"></i></a><a class="button donate arrow" href="https://creativecommons.org/donate?ea.tracking.id=top-of-page-banner">Donate <span class="hide-on-mobile">Now</span></a>', 'wpb_widget_domain' );
		?>
		<p><label for="<?php echo $this->get_field_id( 'cc_header_links_title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cc_header_links_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_header_links_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_header_links_title ); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'cc_header_links_content' ); ?>"><?php _e( 'Description:' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_header_links_content' ); ?>" name="<?php echo $this->get_field_name( 'cc_header_links_content' ); ?>" type="text"><?php echo esc_attr( $cc_header_links_content ); ?></textarea></p>
		<?php
	}
	/**
	 * Save the options.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		// $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_header_links_title']   = ( ! empty( $new_instance['cc_header_links_title'] ) ) ? strip_tags( $new_instance['cc_header_links_title'], '<br>' ) : null;
		$instance['cc_header_links_content'] = ( ! empty( $new_instance['cc_header_links_content'] ) ) ? $new_instance['cc_header_links_content'] : '<a href="http://creativecommons.org" class="link_to_cc_org">Visit International Site <i class="cc-icon-right-dir"></i></a><a class="button donate arrow" href="https://creativecommons.org/donate?ea.tracking.id=top-of-page-banner">Donate <span class="hide-on-mobile">Now</span></a>';
		return $instance;
	}
}


function cc_homepage_header_links_widget_init() {
	register_widget( 'CreativeCommons_Header_Links' );
}

add_action( 'widgets_init', 'cc_homepage_header_links_widget_init', 1 );
