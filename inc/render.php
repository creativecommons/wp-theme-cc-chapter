<?php
/**
 * Layout render class for modularize elements
*/
class render {
    static function widget_news($post) {
        $out = '';
        if (!empty($post)) {
            $out .= '<article class="hentry entry-news">';
                $out .= '<a href="'.get_permalink($post->ID).'">';
                    $out .= get_the_post_thumbnail( $post->ID, 'landscape-small' );
                    $out .= '<div class="entry-info">';
                        $out .= '<h4 class="entry-title">'.get_the_title($post->ID).'</h4>';
                    $out .= '</div>';
                $out .= '</a>';
            $out .= '</article>';
        }
        return $out;
    }
    static function widget_program($post) {
        $out = '';
        $out .= '<article class="hentry entry-program">';
            $out .= '<div class="item">';
                $out .= '<div class="thumbnail">';
                    $out .= '<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail( $post->ID, 'large' ).'</a>';
                $out .= '</div>';
                $out .= '<div class="teaser">';
                    $out .= '<h3 class="title entry-title"><a href="'. get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a></h3>';
                    $out .= '<div class="excerpt">';
                        $out .= do_excerpt( $post );
                    $out .= '</div>';
                $out .= '</div>';
            $out .= '</div>';
        $out .= '</article>';
        return $out;
    }
    static function widget_work($post) {
        $out = '';
        $out .= '<article class="hentry entry-work">';
            $out .= '<div class="item">';
                $out .= '<div class="thumbnail">';
                    $out .= '<a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail( $post->ID, 'lanscape-small' ).'</a>';
                $out .= '</div>';
                $out .= '<div class="teaser">';
                    $out .= '<h3 class="title entry-title"><a href="'. get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a></h3>';
                    $out .= '<div class="excerpt">';
                        $out .= do_excerpt( $post );
                    $out .= '</div>';
                $out .= '</div>';
            $out .= '</div>';
        $out .= '</article>';
        return $out;
    }
    static function widget_event($post) {
        $out = '';
        if (!empty($post)) {
            $out .= '<article class="hentry entry-event">';
                $out .= '<a href="'.get_permalink($post->ID).'">';
                    $out .= '<div class="entry-date-content">';
                        if (has_post_thumbnail( $post->ID )) {
                            $out .= '<div class="entry-image">';
                                $out .= get_the_post_thumbnail( $post->ID, 'landscape-small' );
                                if (!empty($post->event_dtstart_date)) {
                                    $out .= '<div class="entry-date-container">';
                                        $out .= '<div class="entry-date">';
                                            $out .= '<span class="weekday">'.mysql2date( 'l', $post->event_dtstart_date ).'</span>';
                                            $out .= '<span class="day">'.mysql2date( 'd', $post->event_dtstart_date ).'</span>';
                                            $out .= '<span class="month">'.mysql2date( 'F', $post->event_dtstart_date ).'</span>';
                                        $out .= '</div>';
                                    $out .= '</div>';
                                }
                            $out .= '</div>';
                        } else {
                            $out .= '<div class="entry-date-container no-thumb">';
                                $out .= '<div class="entry-date ">';
                                    $out .= '<span class="weekday">'.mysql2date( 'l', $post->event_dtstart_date ).'</span>';
                                    $out .= '<span class="day">'.mysql2date( 'd', $post->event_dtstart_date ).'</span>';
                                    $out .= '<span class="month">'.mysql2date( 'F', $post->event_dtstart_date ).'</span>';
                                $out .= '</div>';
                            $out .= '</div>';
                        }
                        
                    $out .= '</div>';
                    $out .= '<div class="entry-info">';
                        $out .= '<h4 class="entry-title">'.get_the_title($post->ID).'</h4>';
                    $out .= '</div>';
                $out .= '</a>';
            $out .= '</article>';
        }
        return $out;
    }
    static function get_video_embed_url($post) {
        $entry_blocks = parse_blocks($post->post_content);
        foreach ($entry_blocks as $block) {
            if (($block['blockName'] == 'core-embed/youtube') || ($block['blockName'] == 'core-embed/vimeo')) {
                return $block['attrs']['url'];
            }
        }
    }
    static function widget_video($post) {
        $out = '';
        if (!empty($post)) {
            $out .= '<article class="hentry entry-video">';
                $out .= '<a href="'.get_permalink($post->ID).'">';
                    $video_url = self::get_video_embed_url($post);
                    $video_thumb = videos::get_video_thumb($video_url);
                    if (!empty($video_thumb)) {
                        $out .= '<img src="'.$video_thumb.'" alt="'.get_the_title($post->ID).'">';
                    } else {
                        $out .= get_the_post_thumbnail( $post->ID, 'landscape-small' );
                    }
                    $out .= '<div class="entry-info">';
                        $out .= '<h4 class="entry-title">'.get_the_title($post->ID).'</h4>';
                    $out .= '</div>';
                $out .= '</a>';
            $out .= '</article>';
        }
        return $out;
    }
}