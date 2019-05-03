<?php

class WP_Widget_news extends WP_Widget {
    /** constructor */
    function __construct() {
        $widget_ops = array('classname' => 'widget-news', 'description' => 'Show the last categorized news from the current site');
        $control_ops = array();
        parent::__construct('widget-news', 'CC Last news', $widget_ops, $control_ops);
    }
    function get_last_news($size, $category) {
        $args = array(
                'post_type' => 'post',
                'posts_per_page' => $size,
                'post_status' => 'publish'
            );
        if ( is_single() ) {
            global $post;
            $args['post__not_in'] = array($post->ID);
        }
        if (!empty($category)) {
            $args['cat'] = $category;
        }
        $news = new WP_Query($args);
        if ( $news->have_posts() ) {
            return $news->posts;
        } else {
            return false;
        }
    }
    function widget($args, $instance) {
        global $post;
        extract( $instance );
        extract( $args );
        $size = ( !empty( $instance['size'] ) ) ? $instance['size'] : 1;
        $grid = ( !empty( $instance['grid'] ) ) ? 'total-cols-'.$instance['grid'] : '';
        $the_category = ( !empty( $instance['category'] ) ) ? $instance['category'] : null;
        $link_text = ( !empty( $instance['link_text'] ) ) ? $instance['link_text'] : 'More news';
        $news = $this->get_last_news($size, $the_category);
        if ( !empty( $news ) ) {
            echo '<div class="widget news">';
                if ($show_title) {
                    echo '<h4 class="widget-title">'.$title.'</h4>';
                }
                echo '<div class="widget-content">';
                    echo '<div class="grid-container '.$grid.'">';
                        foreach ($news as $item) {
                            echo '<div class="cell">';
                                echo render::widget_news($item);
                            echo '</div>';
                        }
                    echo '</div>';
                    if ( !empty( $instance['is_link'] && (!empty($instance['category'] )) ) ) {
                        $link = get_category_link( $instance['category'] );
                        echo '<div class="align-right">';
                            echo '<a href="'.$link.'" class="secondary widget-more">'.$link_text.' <i class="cc-icon-right-dir"></i> </a>';
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
        echo '<p><label for="'. $this->get_field_name('show_title').'">Show title? </label><input type="checkbox" id="'. $this->get_field_id('show_title').'"'.( ( !empty( $show_title ) ) ? ' checked="checked" ' : '' ).' name="'.$this->get_field_name('show_title').'" value="1"></p>';
        echo '<p><label for="'. $this->get_field_name('is_link').'">Link to news archive? </label><input type="checkbox" id="'. $this->get_field_id('is_link').'"'.( ( !empty( $is_link ) ) ? ' checked="checked" ' : '' ).' name="'.$this->get_field_name('is_link').'" value="1"></p>';
        echo '<p><label for="'.$this->get_field_id('link_text').'">Link text: <input type="text" name="'. $this->get_field_name('link_text') .'" id="'.$this->get_field_id('link_text').'" value="'.$instance['link_text'].'" class="widefat"/></label></p>';
        echo '<p><label for="'.$this->get_field_id('size').'">Entries number: <input type="number" name="'. $this->get_field_name('size') .'" id="'.$this->get_field_id('size').'" value="'.$instance['size'].'"/></label></p>';
        echo '<p><label for="' . $this->get_field_id('category') . '">Category: ';
            wp_dropdown_categories(array('show_option_none' => 'Select', 'selected' => $instance['category'], 'class' => 'widefat', 'name' => $this->get_field_name('category'), 'id' => $this->get_field_id('category') ));
        echo '</label></p>';
        echo '<h3>Display</h3>';
        echo '<p><label>Columns: </label>';
            echo '<select class="widefat" id="'.$this->get_field_id('grid').'" name="'.$this->get_field_name('grid').'">';
                echo '<option value="">Select</option>';
                echo '<option value="auto" '.(($grid == 'auto')  ?  'selected="selected"' : '') .'>Auto fit</option>';
                echo '<option value="1" '.(($grid == '1') ? 'selected="selected"' : '') .'>1</option>';
                echo '<option value="2" '.(($grid == '2') ? 'selected="selected"' : '') .'>2</option>';
                echo '<option value="3" '.(($grid == '3') ? 'selected="selected"' : '') .'>3</option>';
                echo '<option value="4" '.(($grid == '4') ? 'selected="selected"' : '') .'>4</option>';
                echo '<option value="5" '.(($grid == '5') ? 'selected="selected"' : '') .'>5</option>';
                echo '<option value="6" '.(($grid == '6')  ?  'selected="selected"' : '') .'>6</option>';
            echo '</select>';
        echo '</p>';
       } 
}

function cc_text_news_widget_init()
{
    register_widget( 'WP_Widget_news');
}

add_action('widgets_init', 'cc_text_news_widget_init');