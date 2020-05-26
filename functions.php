<?php


/*
 * Release serial number - Used to bust the cache. Please update
 *                         any time you change CSS or JS.
 */
define( 'CC_CSS_RELEASE_SERIAL_NUMBER', '2020.05.1' );
/**
 * Include telated files
*/
require STYLESHEETPATH . '/inc/taxonomies.php';
require STYLESHEETPATH . '/inc/search_filter.php';
require STYLESHEETPATH . '/inc/helpers.php';
require STYLESHEETPATH . '/inc/site.php';
require STYLESHEETPATH . '/inc/render.php';
require STYLESHEETPATH . '/inc/widgets.php';
require STYLESHEETPATH . '/inc/blog_install.php';
require STYLESHEETPATH . '/inc/settings.php';

// CUSTOM POST TYPES
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chfeature-cpt-plugin/cc-chfeature-cpt-plugin.php';
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chvideos-cpt-plugin/cc-chvideos-cpt-plugin.php';
//require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chdocument-cpt-plugin/cc-chdocument-cpt-plugin.php';
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chevent-cpt-plugin/cc-chevent-cpt-plugin.php';
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chteam-cpt-plugin/cc-chteam-cpt-plugin.php';
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-chwork-cpt-plugin/cc-chwork-cpt-plugin.php';
require STYLESHEETPATH. '/inc/custom-post-types/queulat-cc-charea-cpt-plugin/cc-charea-cpt-plugin.php';

// Define custom thumbnail sizes
add_image_size('squared', 300, 300, true);
add_image_size('landscape-small', 360, 200, true);


function twentysixteen_entry_meta() {

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		twentysixteen_entry_date();
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf(
			'<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( 'post' === get_post_type() ) {
		twentysixteen_entry_taxonomies();
	}

}

/**
 * Theme specific stuff
 * --------------------
 * */

/**
 * Theme singleton class
 * ---------------------
 * Stores various theme and site specific info and groups custom methods
 **/
class site
{
	private static $instance;

	protected $settings;

	const id = __CLASS__;
	const theme_ver = '2020.05.1';
	const theme_settings_permissions = 'edit_theme_options';
	private function __construct()
	{
		$this->actions_manager();
	}
	public function __get($key)
	{
		return isset($this->$key) ? $this->$key : null;
	}
	public function __isset($key)
	{
		return isset($this->$key);
	}
	public static function get_instance()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}
	public function __clone()
	{
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
	/**
	 * Setup theme actions, both in the front and back end
	 * */
	public function actions_manager()
	{
		add_action('after_setup_theme', array($this, 'setup_theme'),15);
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('wp_head', array($this,'dequeue_styles'));
		add_action('enqueue_scripts', array($this, 'enqueue_scripts'));
		//add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
		add_action('init', array($this, 'init_functions'));
		add_action('init', array($this, 'register_menus_locations'));

		add_action( 'enqueue_block_editor_assets', array($this, 'gutenberg_scripts' ));
	}
	public function init_functions()
	{
		add_post_type_support('page', 'excerpt');
	}
	/**
	 * Script to tweak the gutenberg a little
	*/
	function gutenberg_scripts() {
		wp_enqueue_script( 'cc-tweak-editor', get_stylesheet_directory_uri() . '/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ), true );
	}

	/**
	 * Enable theme's functionalities
	 * @return void
	 */
	public function setup_theme()
	{
		// enable post formats
		add_theme_support('post-formats', array('gallery', 'image', 'video', 'audio'));
		add_theme_support('post-thumbnails');
		add_theme_support('menus');
		remove_theme_support( 'custom-logo' );
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Red', 'cc-chapters' ),
				'slug'  => 'cc-red',
				'color'	=> '#f46b2c',
			),
			array(
				'name'  => __( 'Green', 'cc-chapters' ),
				'slug'  => 'cc-green',
				'color' => '#27a635',
			),
			array(
				'name'  => __( 'Orange', 'cc-chapters' ),
				'slug'  => 'cc-orange',
				'color' => '#ffae00',
			),
			array(
				'name'	=> __( 'Yellow', 'cc-chapters' ),
				'slug'	=> 'cc-yellow',
				'color'	=> '#efbe01',
			),
			array(
				'name'	=> __( 'Blue', 'cc-chapters' ),
				'slug'	=> 'cc-blue',
				'color'	=> '#35bbd8',
			),
		) );
	}

	public function register_menus_locations()
	{
		register_nav_menus(array(
			'mobile'       => __('Mobile Menu'),
			'secondary'    => __('Secondary Menu'),
			'footer-links' => __('Footer Links'),
			'social'       => __('Social Links Menu' ),
		));
	}
	public function dequeue_styles() {
		wp_dequeue_style('twentysixteen-fonts');
		wp_deregister_style('twentysixteen-fonts');
		wp_dequeue_style('genericons');
		wp_deregister_style('genericons' );
	}
	public function enqueue_styles()
	{
		// Front-end styles
		wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
		wp_enqueue_style('cc-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Roboto+Condensed:400,700');
		wp_enqueue_style('cc-fontello', get_stylesheet_directory_uri() . '/fonts/fontello/css/cc-fontello.css');
		wp_enqueue_style('cc-style', get_stylesheet_directory_uri() . '/css/app.css', array('parent-style', 'cc-google-fonts', 'cc-fontello'), CC_CSS_RELEASE_SERIAL_NUMBER );
		//wp_enqueue_style( 'dashicons' );
	}

	function admin_enqueue_scripts()
	{
		// admin scripts
	}

	function enqueue_scripts()
	{
		// front-end scripts
		wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
		wp_enqueue_style('cc-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|Roboto+Condensed:400,700');
		wp_enqueue_style('cc-fontello', get_stylesheet_directory_uri() . '/fonts/fontello/css/cc-fontello.css');
		wp_enqueue_style('cc-style', get_stylesheet_directory_uri() . '/css/app.css', array('parent-style', 'cc-google-fonts', 'cc-fontello'), CC_CSS_RELEASE_SERIAL_NUMBER);

		wp_enqueue_script('cc-breakpoint-body-class', get_stylesheet_directory_uri() . '/js/breakpoint-body-class.js', array('jquery'), CC_CSS_RELEASE_SERIAL_NUMBER, true);
		wp_enqueue_script('cc-common', get_stylesheet_directory_uri() . '/js/cc.js', array('jquery'), CC_CSS_RELEASE_SERIAL_NUMBER, true);
		wp_enqueue_script('cc-sticky-nav', get_stylesheet_directory_uri() . '/js/sticky-nav.js', array('cc-common', 'jquery'), CC_CSS_RELEASE_SERIAL_NUMBER, true);
		wp_enqueue_script('cc-toggle-search', get_stylesheet_directory_uri() . '/js/toggle-search.js', array('jquery'), CC_CSS_RELEASE_SERIAL_NUMBER, true);
		wp_enqueue_script('cc-donation', get_stylesheet_directory_uri() . '/js/donation.js', array('jquery'), CC_CSS_RELEASE_SERIAL_NUMBER, true );
		//attach data to main script
		$ajax_data = array(
			'url' => admin_url('admin-ajax.php') //just in case  we need ajax
		);
		wp_localize_script('cc-common', 'Ajax', $ajax_data);
	}
}

/**
 * Instantiate the class object
 * */

$_s = site::get_instance();

/**
 * Register custom sidebars and widgetized areas.
 */

$mandatory_sidebars = array(
	'Homepage Feature' => array(
		'name' => 'homepage-featured-widgets'
	),
	'Homepage space 1' => array(
		'name' => 'homepage-space-1'
	),
	'Homepage space 2' => array(
		'name' => 'homepage-space-2'
	),
	'Homepage space 3' => array(
		'name' => 'homepage-space-3'
	),
	'Homepage space 4' => array(
		'name' => 'homepage-space-4'
	),
	'Homepage space 5' => array(
		'name' => 'homepage-space-5'
	),
	'Homepage Content' => array(
		'name' => 'homepage-content-widgets'
	),
	'Content sidebar' => array(
		'name' => 'content-sidebar',
		'description' => 'Sidebar on each content type (pages, entries, videos, events)'
	),
	'Header - Right' => array(
		'name' => 'header-widget'
	),
	'Footer - Center' => array(
		'name' => 'footer-center'
	),
);
//custom filter if we need to attach more sidebars or to modify the existent
$mandatory_sidebars = apply_filters('intersecciones_base_mandatory_sidebars', $mandatory_sidebars);
foreach ($mandatory_sidebars as $sidebar => $id_sidebar) {
	register_sidebar(array(
		'name'          => $sidebar,
		'id'			=> $id_sidebar['name'],
		'description' 	=> (!empty($id_sidebar['description'])) ? $id_sidebar['description']: '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">' . "\n",
		'after_widget'  => '</section>',
		'before_title'  => '<header class="widget-header"><h3 class="widget-title">',
		'after_title'   => '</h3></header>'
	));
}

// ##############################################################################
// ##############################################################################


// stop wp removing span tags
function cc_chapter_tinymce_fix( $init ) {
	$init['extended_valid_elements'] = 'span[*]';
	return $init;
}
add_filter( 'tiny_mce_before_init', 'cc_chapter_tinymce_fix' );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function cc_chapter_search_form( $form ) {
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
add_filter( 'get_search_form', 'cc_chapter_search_form' );

function cc_chapter_filter_add_tags_and_category( $content ) {
	if ( is_single() ) {
		$new_content     = '';
		$categories_list = get_the_category_list( ' ', ', ' );
		if ( $categories_list ) {
			$new_content .= '<div class="post-category"><span class="tags-label">Category:</span><span class="categories-links">' . $categories_list . '</span></div>';
		}
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$new_content .= '<div class="post-tags"><span class="tags-label">Tags:</span><span class="tags-links">' . $tag_list . '</span></div>';
		}

		$content .= $new_content;
	}
	return $content;
}
add_filter( 'the_content', 'cc_chapter_filter_add_tags_and_category' );

function cc_chapter_modify_read_more_link() {
	return sprintf( '<a class="more-link" href="' . get_permalink() . '">Read More<span class="screen-reader-text"> "%s"</span></a>', get_the_title( get_the_ID() ) );
}
add_filter( 'the_content_more_link', 'cc_chapter_modify_read_more_link' );

// Gotta keep the name as twentysixteen or else the base theme will override it.
function twentysixteen_excerpt_more() {
	$link = sprintf(
		'<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentysixteen_excerpt_more' );


add_filter( 'eat_exclude_types', 'cc_chapter_eat_excluded_types', 10, 1 );
function cc_chapter_eat_excluded_types( $exclude_types ) {
	$exclude_types[] = 'page';
	return $exclude_types;
}

// Allow shortcodes in html widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Add targeting classes to body-class
function add_category_to_single( $classes ) {
	if ( is_single() ) {
		global $post;
		foreach ( ( get_the_category( $post->ID ) ) as $category ) {
			// add category slug to the $classes array
			$classes[] = $category->category_nicename;
		}
	}
	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'add_category_to_single' );

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


// adds ability to embed any widget using a shortcode
function widget( $atts ) {
	global $wp_widget_factory;
	extract(
		shortcode_atts(
			array(
				'widget_name' => false,
			),
			$atts
		)
	);

	$widget_name = wp_specialchars( $widget_name );

	if ( ! is_a( $wp_widget_factory->widgets[ $widget_name ], 'WP_Widget' ) ) :
		$wp_class = 'WP_Widget_' . ucwords( strtolower( $class ) );

		if ( ! is_a( $wp_widget_factory->widgets[ $wp_class ], 'WP_Widget' ) ) :
			return '<p>' . sprintf( __( '%s: Widget class not found. Make sure this widget exists and the class name is correct' ), '<strong>' . $class . '</strong>' ) . '</p>';
		else :
			$class = $wp_class;
		endif;
	endif;

	ob_start();
	the_widget(
		$widget_name,
		$instance,
		array(
			'widget_id'     => 'arbitrary-instance-' . $id,
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

}
add_shortcode( 'widget', 'widget' );





// ##############################################################################
// ##############################################################################
// ##############################################################################
function debug_to_console_fn( $data, $type ) {
	if ( $type ) {
		$output = '<script>console.log(' . $data . ' );</script>';
	} else {
		$output = '<script>console.dir(' . json_encode( $data ) . ' );</script>';
	}
	// echo $output;
}

// add_filter( 'sidebars_widgets', 'disable_all_widgets' );
// add to settup to clear
function disable_all_widgets( $sidebars_widgets ) {

	$sidebars_widgets = array( false );

	return $sidebars_widgets;
}

// allow shortcodes in excerpts - for video tags
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );
add_filter( 'get_the_excerpt', 'do_shortcode', 5 );





