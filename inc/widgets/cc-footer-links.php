<?php

class CreativeCommons_Footer_Links extends WP_Widget {
	var $default_title, $default_size;

	/**
	* Registers the widget with WordPress.
	*/
	function __construct() {
		parent::__construct(false, $name = __("CC Footer Links <span></span>", 'creativecommons'));
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
		$cc_footer_links_title = isset($instance['cc_footer_links_title']) ? $instance['cc_footer_links_title'] : null;
		$cc_footer_links_content = isset($instance['cc_footer_links_content']) ? $instance['cc_footer_links_content'] :null;
		// add  $cc_footer_links_theme to section classes 
        
        echo $cc_footer_links_content;
	}

    public function form( $instance ) {

        $cc_footer_links_title = (!empty($instance[ 'cc_footer_links_title' ])) ? $instance[ 'cc_footer_links_title' ] : __( '', 'wpb_widget_domain' );
        $cc_footer_links_content = (!empty($instance[ 'cc_footer_links_content' ])) ? $instance[ 'cc_footer_links_content' ] : __( '<div class="cc-footer-contact"><h6><a href="/about/contact">We\'d love to hear from you!</a></h6><address>Creative Commons<br />PO Box 1866, Mountain View, CA 94042</address><ul><li><a href="mailto:info@creativecommons.org" class="mail">info@creativecommons.org</a></li><li><a href="tel:1-415-429-6753">1-415-429-6753</a></li><li><a style="color: white" href="/faq">Frequently Asked Questions</a></li></ul></div>', 'wpb_widget_domain' );
        ?>
        <p><label for="<?php echo $this->get_field_id( 'cc_footer_links_title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'cc_footer_links_title' ); ?>" name="<?php echo $this->get_field_name( 'cc_footer_links_title' ); ?>" type="text" value="<?php echo esc_attr( $cc_footer_links_title ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'cc_footer_links_content' ); ?>"><?php _e( 'Description:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'cc_footer_links_content' ); ?>" name="<?php echo $this->get_field_name( 'cc_footer_links_content' ); ?>" type="text"><?php echo esc_attr( $cc_footer_links_content ); ?></textarea></p>
        <?php
    }
  /**
   * Save the options.
   */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
	//	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : null;
		$instance['cc_footer_links_title'] = ( ! empty( $new_instance['cc_footer_links_title'] ) ) ? strip_tags( $new_instance['cc_footer_links_title'],"<br>" ) : null;
		$instance['cc_footer_links_content'] = ( ! empty( $new_instance['cc_footer_links_content'] ) ) ? $new_instance['cc_footer_links_content']  : '<div class="cc-footer-contact"><h6><a href="/about/contact">We\'d love to hear from you!</a></h6><address>Creative Commons<br />PO Box 1866, Mountain View, CA 94042</address><ul><li><a href="mailto:info@creativecommons.org" class="mail">info@creativecommons.org</a></li><li><a href="tel:1-415-429-6753">1-415-429-6753</a></li><li><a style="color: white" href="/faq">Frequently Asked Questions</a></li></ul></div>';
		return $instance;
	}
}


function cc_homepage_footer_links_widget_init() {
  register_widget( 'CreativeCommons_Footer_Links' );
}

add_action( 'widgets_init', 'cc_homepage_footer_links_widget_init', 1 );
