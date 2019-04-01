<?php
/**
 * THEME WIDGETS
 */
require STYLESHEETPATH . '/inc/widgets/cc-links.php';
require STYLESHEETPATH . '/inc/widgets/cc-programs.php';
require STYLESHEETPATH . '/inc/widgets/cc-works.php';
require STYLESHEETPATH . '/inc/widgets/cc-videos.php';
require STYLESHEETPATH . '/inc/widgets/cc-news.php';
require STYLESHEETPATH . '/inc/widgets/cc-header-links.php';
require STYLESHEETPATH . '/inc/widgets/cc-footer-links.php';
require STYLESHEETPATH . '/inc/widgets/cc-text-banner.php';
require STYLESHEETPATH . '/inc/widgets/cc-news-widget.php';
require STYLESHEETPATH . '/inc/widgets/cc-columns-widgets.php';
require STYLESHEETPATH . '/inc/widgets/cc-widget-title.php';
require STYLESHEETPATH . '/inc/widgets/cc-widget-programs.php';
require STYLESHEETPATH . '/inc/widgets/cc-widget-work.php';
require STYLESHEETPATH . '/inc/widgets/cc-widget-event.php';
require STYLESHEETPATH . '/inc/widgets/cc-widget-video-list.php';

class cc_widgets {
	private static $instance;

	private function __construct() {
		$this->actions_manager();
	}
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			$c              = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}
	public function __clone() {
		trigger_error( 'Clone is not allowed.', E_USER_ERROR );
	}
	public function actions_manager() {
		add_action( 'after_setup_theme', array( $this, 'image_sizes' ) );
		add_filter( 'widget_text', 'shortcode_unautop' );
		add_filter( 'widget_text', 'do_shortcode', 11 );
	}
	public function image_sizes() {
		add_image_size( 'cc_feature_thumbnail', 270, 155, false );
		add_image_size( 'cc_list_post_thumbnail', 440, 250, array( 'right', 'bottom' ) );
	}
	public static function get_homepage_features_query( $term, $count ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'tax_query'      => array(
				array(
					'taxonomy' => 'cc_highlight',
					'field'    => 'slug',
					'terms'    => array( $term ),
				),
			),
		);
		return new WP_Query( $args );
	}
	public static function get_featured_posts_query( $cat, $term, $count ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'category_name'  => $cat,
			'tax_query'      => array(
				array(
					'taxonomy' => 'cc_highlight',
					'field'    => 'slug',
					'terms'    => array( $term ),
				),
			),
		);
		return new WP_Query( $args );
	}
	public static function get_featured_posts_by_taxonomy_query( $cat, $term, $count ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'category_name'  => $cat,
			'tax_query'      => array(
				array(
					'taxonomy' => 'cc_highlight',
					'field'    => 'slug',
					'terms'    => array( $term ),
				),
			),
		);
		return new WP_Query( $args );
	}
	public static function get_cat_pages_query( $cat, $count ) {
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'category'       => $cat,
		);
		return new WP_Query( $args );
	}
	public static function get_default_pages_query() {
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => -1,
			'category_name'  => 'default-page',
		);
		return new WP_Query( $args );
	}
	public static function get_featured_posts_by_category_query( $cat, $count ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'category_name'  => $cat,
		);
		return new WP_Query( $args );
	}
	function get_related_news_query( $term, $count ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'tax_query'      => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => array( $term ),
				),
			),
		);
		return new WP_Query( $args );
	}
	/*
	* function cc_widgets_get_featured_post_ids()
	*
	* Get the featured/hero post_ids so we can reduce repetitive post displays.
	*
	* return @array post_ids
	*
	*/
	public static function cc_widgets_get_featured_post_ids() {
		$all_widgets             = wp_get_sidebars_widgets();
		$featured_post_ids       = array();
		$suppress_featured_posts = false;

		foreach ( $all_widgets as $region => $widgets ) {
			if ( is_array( $widgets ) && count( $widgets ) ) {
				foreach ( $widgets as $i => $widget_title ) {
					if ( strpos( $widget_title, 'creativecommons_news_features_widget' ) !== false ) {
						$suppress_featured_posts = true;
						break;
					}
				}
			}
			if ( $suppress_featured_posts == true ) {
				break;
			}
		}

		if ( $suppress_featured_posts == true ) {
			$the_query = cc_widgets_get_homepage_features_query( 'hero', 1 );
			if ( $the_query->have_posts() ) {
				$posts = $the_query->get_posts();
				foreach ( $posts as $post ) {
					$featured_post_ids[] += $post->ID;
					$hero_post_id         = $post->ID;
				}
			}
			$the_query = cc_widgets_get_homepage_features_query( 'featured', 5 );
			if ( $the_query->have_posts() ) {
				$posts = $the_query->get_posts();
				foreach ( $posts as $post ) {
					if ( $post->ID == $hero_post_id ) {
						continue;
					}
					$featured_post_ids[] += $post->ID;
					if ( count( $featured_post_ids ) == 5 ) {
						break;
					}
				}
			}
			wp_reset_postdata();
		}
		return $featured_post_ids;
	}
}

/**
 * Instantiate the class object
 * */

$_widgets = cc_widgets::get_instance();
