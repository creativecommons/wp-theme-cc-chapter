<?php
class WP_Widget_title extends WP_Widget {
    /** constructor */
    function __construct() {
        $widget_ops = array('classname' => 'cc-title', 'description' => 'Shows a title and an optional description');
        $control_ops = array();
        parent::__construct('cc-title', 'CC Widget Title', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract( $instance );
        extract( $args );
        if (!empty($title)) {
            echo '<div class="widget title">';
                echo '<div class="grid-container total-3-cols">';
                    echo '<div class="cell">';
                        echo '<h4 class="widget-title">'.$title.'</h4>';
                    echo '</div>';
                    if ( !empty( $instance['description'] ) ) {
                        echo '<div class="cell use-2-cols">';
                            echo '<p>'.esc_attr($instance['description']).'</p>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        }
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form( $instance ) {
        extract( $instance );
        echo '<p><label for="'.$this->get_field_id('title').'">Title: <input type="text" name="'. $this->get_field_name('title') .'" id="'.$this->get_field_id('title').'" value="'.$instance['title'].'" class="widefat" /></label></p>';
        echo '<p><label for="'.$this->get_field_id('description').'">Description: <textarea name="'. $this->get_field_name('description') .'" id="'.$this->get_field_id('description').'" class="widefat">'.$instance['description'].'</textarea></label></p>';
       } 
}

function cc_title_widget_init()
{
    register_widget( 'WP_Widget_title');
}

add_action('widgets_init', 'cc_title_widget_init');