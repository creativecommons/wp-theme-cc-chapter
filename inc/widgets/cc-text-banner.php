<?php
class WP_Widget_text_banner_simple extends WP_Widget {
    /** constructor */
    function __construct() {
        $widget_ops = array('classname' => 'text-banner', 'description' => 'Shows a simple text banner with link');
        $control_ops = array();
        parent::__construct('text-banner', 'Text banner', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract( $instance );
        extract( $args );
        $color = ( !empty( $color ) ) ? $color : 'light';
        if ($is_col) {
            $spaces = (!empty($spaces)) ? 'use-'.$spaces.'-cols' : '';
            echo '<div class="cell '.$spaces.'">';
        }
        echo '<div class="widget text '.$color.'">';
            echo '<a href="'.$url.'">';
                echo '<h4 class="widget-title">'.$title.'</h4>';
                if ( !empty( $instance['description'] ) ) {
                    echo '<p>'.esc_attr($instance['description']).'</p>';
                }
                if ( !empty( $instance['mini-text'] ) ) {
                    echo '<span class="mini-text">'.esc_attr($instance['mini-text']).'</span>';
                }
            echo '</a>';
        echo '</div>';
        if ($is_col) {
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
        echo '<p><label for="'.$this->get_field_id('mini-text').'">Tiny text (optional): <textarea name="'. $this->get_field_name('mini-text') .'" id="'.$this->get_field_id('mini-text').'" class="widefat">'.$instance['mini-text'].'</textarea></label></p>';
        echo '<p><label for="'.$this->get_field_id('url').'">Url: <input type="text" name="'. $this->get_field_name('url') .'" id="'.$this->get_field_id('url').'" value="'.$instance['url'].'" class="widefat" /></label></p>';
        echo '<h3>Display</h3>';
        echo '<p><label for="'. $this->get_field_name('is_col').'">Part of column container? </label><input type="checkbox" id="'. $this->get_field_id('is_col').'"'.( ( !empty( $is_col ) ) ? ' checked="checked" ' : '' ).' name="'.$this->get_field_name('is_col').'" value="1"></p>';
        echo '<p><label>Spaces: </label>';
            echo '<select class="widefat" id="'.$this->get_field_id('spaces').'" name="'.$this->get_field_name('spaces').'">';
                echo '<option value="">1</option>';
                echo '<option value="2" '.(($spaces == '2') ? 'selected="selected"' : '') .'>2</option>';
                echo '<option value="3" '.(($spaces == '3') ? 'selected="selected"' : '') .'>3</option>';
                echo '<option value="4" '.(($spaces == '4') ? 'selected="selected"' : '') .'>4</option>';
            echo '</select>';
        echo '</p>';
        echo '<p><label>Color: </label>';
        echo '<select class="widefat" id="'.$this->get_field_id('color').'" name="'.$this->get_field_name('color').'">';
            echo '<option value="">Select</option>';
                echo '<option value="blue"'. (($color == 'blue') ? 'selected="selected"' : '') .'>Blue</option>';
                echo '<option value="green" '.(($color == 'green') ? 'selected="selected"' : '') .'>Green</option>';
                echo '<option value="orange" '.(($color == 'orange') ? 'selected="selected"' : '') .'>orange</option>';
                echo '<option value="dark" '.(($color == 'dark') ? 'selected="selected"' : '') .'>Dark</option>';
                echo '<option value="light" '.(($color == 'light') ? 'selected="selected"' : '') .'>Light</option>';
            echo '</select>';
        echo '</p>';
       } 
}

function cc_text_banner_widget_init()
{
    register_widget( 'WP_Widget_text_banner_simple');
}

add_action('widgets_init', 'cc_text_banner_widget_init');