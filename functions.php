<?php


/*
 * Release serial number - Used to bust the cache. Please update
 *                         any time you change CSS or JS.
 */
define('CC_CSS_RELEASE_SERIAL_NUMBER', '20181120');

function twentysixteen_entry_meta() {

  if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
    twentysixteen_entry_date();
  }

  $format = get_post_format();
  if ( current_theme_supports( 'post-formats', $format ) ) {
    printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
      sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
      esc_url( get_post_format_link( $format ) ),
      get_post_format_string( $format )
    );
  }

  if ( 'post' === get_post_type() ) {
    twentysixteen_entry_taxonomies();
  }

}


function cc_affiliate_setup() {
  remove_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'cc_affiliate_setup', 9999 );

/**
 * Enqueue Scripts / Styles
 */
function cc_affiliate_enqueue_scripts() {
wp_enqueue_style( 	'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 	'cc-google-fonts','//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Roboto+Condensed:400,700');
wp_enqueue_style(	'cc-fontello', get_stylesheet_directory_uri() . '/fonts/fontello/css/cc-fontello.css' );
wp_enqueue_style(	'cc-style', get_stylesheet_directory_uri() . '/css/app.css', array( 'parent-style', 'cc-google-fonts', 'cc-fontello' ), CC_CSS_RELEASE_SERIAL_NUMBER ); 
wp_enqueue_style(	'header-style', get_stylesheet_directory_uri() . '/css/header.css', array(  ), CC_CSS_RELEASE_SERIAL_NUMBER ); 
wp_enqueue_style(	'nav-style', get_stylesheet_directory_uri() . '/css/navigation.css', array(  ), CC_CSS_RELEASE_SERIAL_NUMBER ); 

wp_enqueue_script(	'cc-breakpoint-body-class', get_stylesheet_directory_uri() . '/js/breakpoint-body-class.js', array( 'jquery' ), CC_CSS_RELEASE_SERIAL_NUMBER, true ); 
wp_enqueue_script(	'cc-common', get_stylesheet_directory_uri() . '/js/cc.js', array( 'jquery' ), CC_CSS_RELEASE_SERIAL_NUMBER, true ); 
wp_enqueue_script(	'cc-sticky-nav', get_stylesheet_directory_uri() . '/js/sticky-nav.js', array( 'cc-common', 'jquery' ), CC_CSS_RELEASE_SERIAL_NUMBER, true ); 
wp_enqueue_script(	'cc-toggle-search', get_stylesheet_directory_uri() . '/js/toggle-search.js', array( 'jquery' ), CC_CSS_RELEASE_SERIAL_NUMBER, true ); 
wp_enqueue_script(	'cc-donation', get_stylesheet_directory_uri() . '/js/donation.js', array( 'jquery' ), CC_CSS_RELEASE_SERIAL_NUMBER, true ); }

// wp_style_add_data( 	'cc-style', 'rtl', 'replace' );

add_action( 'wp_enqueue_scripts', 'cc_affiliate_enqueue_scripts' );

/**
 * Dequeue Styles
 */
function cc_affiliate_dequeue_styles() {
	wp_dequeue_style( 'twentysixteen-fonts');
	wp_deregister_style( 'twentysixteen-fonts');
	wp_dequeue_style( 'genericons');
	wp_deregister_style( 'genericons');
}
add_action( 'wp_enqueue_scripts', 'cc_affiliate_dequeue_styles', 9999 );
add_action( 'wp_head', 'cc_affiliate_dequeue_styles', 9999 );

/**
 * Register menus.
 *
 */
function cc_affiliate_register_menu() {
  register_nav_menus( array(
    'mobile' => __( 'Mobile Menu' ),
    'secondary' => __( 'Secondary Menu' ),
    'footer-links'  => __( 'Footer Links' ),
    'social'  => __( 'Social Links Menu' ),
  ) );
}
add_action('init', 'cc_affiliate_register_menu');


/**
 * Register custom sidebars and widgetized areas.
 *
 */
 
 
function cc_affiliate_widgets_init() {
	
	// Register three sidebars.
	$sidebars = array ( 
		'a' => 'header-widget',
		'b' => 'homepage-content-widgets', 
		'c' => 'footer-center'	
	);
	
			register_sidebar(
			array (
				'name'          => 'Homepage Content',
				'id'            => 'homepage-content-widgets',
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array (
				'name'          => 'Header - Right',
				'id'            => 'header-widget',
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
			register_sidebar(
			array (
				'name'          => 'Footer - Center',
				'id'            => 'footer-center',
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
		/*
	foreach ( $sidebars as $sidebar )
	{
		register_sidebar(
			array (
				'name'          => $sidebar,
				'id'            => $sidebar,
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
	}
	*/
	
	$active_widgets = get_option( 'sidebars_widgets' );
	
	
	
	if ( empty ( $active_widgets[ $sidebars['a'] ] ) ) {
		$counter = 1;
		$active_widgets[ $sidebars['a'] ][0] = 'creativecommons_header_links-' . $counter;
		$header_links_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_header_links', $header_links_widget_content );
	}	
		
	if ( empty ( $active_widgets[ $sidebars['b'] ] ) ) {
		$counter++;
		$active_widgets[ $sidebars['b'] ][] = 'creativecommons_links-' . $counter;
		$links_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_links', $links_widget_content );

		
		$counter++;
		$active_widgets[ $sidebars['b'] ][] = 'creativecommons_programs-' . $counter;
		$programs_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_programs', $programs_widget_content );

		
		$counter++;
		$active_widgets[ $sidebars['b'] ][] = 'creativecommons_news-' . $counter;
		$news_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_news', $news_widget_content );

		
		$counter++;
		$active_widgets[ $sidebars['b'] ][] = 'creativecommons_works-' . $counter;
		$works_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_works', $works_widget_content );

		
		$counter++;
		$active_widgets[ $sidebars['b'] ][] = 'creativecommons_videos-' . $counter;
		$videos_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_videos', $videos_widget_content );
	}	
		
	if ( empty ( $active_widgets[ $sidebars['c'] ] ) ) {
		
		$counter++;
		$active_widgets[ $sidebars['c'] ][] = 'creativecommons_footer_links-' . $counter;
		$footer_links_widget_content[ $counter ] = array (  'title' => 'WordPress Stack Exchange');
		update_option( 'widget_creativecommons_footer_links', $footer_links_widget_content );
	}
		update_option( 'sidebars_widgets', $active_widgets );


}



//  ##############################################################################
//  ##############################################################################



function cc_affiliate_remove_parent_sidebars(){
  unregister_sidebar('sidebar-2');
  unregister_sidebar('sidebar-3');
}

add_action( 'widgets_init', 'cc_affiliate_widgets_init',10 );
add_action( 'widgets_init', 'cc_affiliate_remove_parent_sidebars', 11 );

// stop wp removing span tags
function cc_affiliate_tinymce_fix($init) {
    $init['extended_valid_elements'] = 'span[*]';
    return $init;
}
add_filter('tiny_mce_before_init', 'cc_affiliate_tinymce_fix');

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function cc_affiliate_search_form( $form ) {
    $form  = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '">';
    $form .= '  <label>';
    $form .= '    <span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>';
    $form .= '    <input type="search" class="search-field"';
    $form .= '        placeholder="' . esc_attr_x( 'Search the website', 'placeholder' ) . '"';
    $form .= '        value="' . get_search_query() . '" name="s"';
    $form .= '        title="' . esc_attr_x( 'Search for:', 'label' ) . '" />';
    $form .= '  </label>';
    $form .= '  <button type="submit" class="search-submit" value="' . esc_attr_x( 'Search', 'submit button' ) . '">';
    $form .= '    <span class="screen-reader-text">Search</span>';
    $form .= '  </button>';
    $form .= '</form>';

    return $form;
}
add_filter( 'get_search_form', 'cc_affiliate_search_form' );

function cc_affiliate_filter_add_tags_and_category($content) {
  if(is_single()) {
    $new_content = '';
    $categories_list = get_the_category_list(' ', ', ');
    if ($categories_list) {
      $new_content .= '<div class="post-category"><span class="tags-label">Category:</span><span class="categories-links">' . $categories_list . '</span></div>';
    }
    $tag_list = get_the_tag_list('', ', ');
    if ($tag_list) {
      $new_content .= '<div class="post-tags"><span class="tags-label">Tags:</span><span class="tags-links">' . $tag_list . '</span></div>';
    }

    $content .= $new_content;
  }
  return $content;
}
add_filter('the_content', 'cc_affiliate_filter_add_tags_and_category');

function cc_affiliate_modify_read_more_link() {
  return sprintf('<a class="more-link" href="' . get_permalink() . '">Read More<span class="screen-reader-text"> "%s"</span></a>', get_the_title( get_the_ID() ));
}
add_filter( 'the_content_more_link', 'cc_affiliate_modify_read_more_link' );

// Gotta keep the name as twentysixteen or else the base theme will override it.

function twentysixteen_excerpt_more() {
  $link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
    esc_url( get_permalink( get_the_ID() ) ),
    /* translators: %s: Name of current post */
    sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ), get_the_title( get_the_ID() ) )
  );
  return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentysixteen_excerpt_more' );


add_filter ('eat_exclude_types', 'cc_affiliate_eat_excluded_types', 10, 1);
function cc_affiliate_eat_excluded_types ( $exclude_types ){
    $exclude_types[] = 'page';
    return $exclude_types;
}

// Allow shortcodes in html widgets.
add_filter('widget_text','do_shortcode');

// Add targeting classes to body-class

function add_category_to_single($classes) {
	if (is_single() ) {
		global $post;
		foreach((get_the_category($post->ID)) as $category) {
			// add category slug to the $classes array
			$classes[] = $category->category_nicename;
		}
	}
	// return the $classes array
	return $classes;
}
add_filter('body_class','add_category_to_single');

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


// adds ability to embed any widget using a shortcode
function widget($atts) {
    global $wp_widget_factory;
    extract(shortcode_atts(array(
        'widget_name' => FALSE
    ), $atts));
    
    $widget_name = wp_specialchars($widget_name);
    
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('widget','widget'); 





//  ##############################################################################
//  ##############################################################################
//  ##############################################################################

function debug_to_console_fn( $data,$type ) {
if ( $type )
 $output = "<script>console.log(". $data. " );</script>";
 else
 $output = "<script>console.dir(". json_encode($data) . " );</script>";
//echo $output;
} 

//add_filter( 'sidebars_widgets', 'disable_all_widgets' );
// add to settup to clear 
function disable_all_widgets( $sidebars_widgets ) {

  $sidebars_widgets = array( false );

  return $sidebars_widgets;
}

// allow shortcodes in excerpts - for video tags
add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter( 'get_the_excerpt', 'do_shortcode', 5 );




?>