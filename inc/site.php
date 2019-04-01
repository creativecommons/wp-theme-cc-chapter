<?php

class front {
    static function get_last_featured() {
        $query = new WP_Query(array(
            'post_type'        => 'cc_chfeature',
            'posts_per_page'    => 1,
            'post_status'       => 'publish',
            'orderby'           => 'date',
            'order'             => 'DESC'
        ));
        if ($query->have_posts()) {
            return $query->posts[0];
        } else {
            return false;
        }
    }
    static function get_sidebar_class($sidebar) {
        global $_set;
        $settings = $_set->settings;
        if (!empty($settings[$sidebar.'-background'])) {
            return ' '.$settings[$sidebar.'-background'];
        }
    }
}