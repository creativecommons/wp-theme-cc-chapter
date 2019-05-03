<?php
/**
 * Manage New blog default content
 */


function cc_chapter_setup_default_install($blog_id)
{
    // Switch the newly created blog.
    switch_to_blog($blog_id);

    // Change to a different theme.
    switch_theme("cc-chapter");

    // Set country code
    if (!empty($_POST['blog']['country_code'])) {
        $new_field_value = strtoupper($_POST['blog']['country_code']);
        update_option('country_code', $new_field_value);
    }

    // Setup tags and categories
    cc_chapter_create_tags();

    $hero_term = term_exists('hero', 'cc_highlight');
    $featured_term = term_exists('featured', 'cc_highlight');

    // ###  IMPORT DEFAULT PAGES
    switch_to_blog(1);
    $the_query = cc_get_default_pages_query();
    $default_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    restore_current_blog();
    //switch_to_blog($blog_id);
    while ($the_query->have_posts()) {
        // set page creation vars
        $the_query->the_post();
        $page_content = get_the_content();
        $page_title = get_the_title();
        $page_excerpt = get_the_excerpt();
        $page_name = str_replace(" ", "-", strtolower($page_title));

        // create page
        $page_id = cc_chapter_create_default_page($page_content, $page_title, $page_name, $page_excerpt);

        // attache featured image
        $caption = '';
        cc_chapter_attach_featured_image_to_post($default_img_url, $page_id, $caption);
    }

    // assign homepage
    $homepage = $page_id;
    if ($homepage) {
        update_option('page_on_front', $homepage);
        update_option('show_on_front', 'page');
    }

    // Delete default placeholders
    wp_delete_post(1, true);
    wp_delete_post(2, true);

    // look into this
    // move create categories here
    $cats = array('home-hero', 'links', 'news', 'program', 'video', 'work');
    $terms = array('hero', 'highlight');

    // IMPORT POSTS
    foreach ($cats as $cat) {
        switch_to_blog(1);
        $the_query = cc_widgets::get_featured_posts_by_taxonomy_query($cat, 'default', 5);
        // returned objects do not include cat or terms
        // need to take a post_id (while in blog 1) and query it for Hero and Highlight and assign them if neccessary

        switch_to_blog($blog_id);
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $default_post_id = get_the_ID();

            switch_to_blog(1);
            $termsObj = get_the_terms($default_post_id, 'cc_highlight');
            $termsIds =  wp_list_pluck($termsObj, 'id');
            $heroCheck = "false";
            if (has_term('hero', 'cc_highlight')) {
                $heroCheck = "true";
            }

            $default_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $caption = "";

            //if(!$default_img_url){$default_img_url = "no url";}

            switch_to_blog($blog_id);

            $catObj = get_category_by_slug($cat);
            $post_category_id = $catObj->term_id;

            // create the pages
            $post_id = cc_chapter_create_default_post(
                get_the_content(),
                get_the_title(),
                get_the_excerpt(),
                "publish",
                "post",
                str_replace(" ", "-", strtolower(get_the_title())),
                $post_category_id,
                $heroCheck
            );


            // attache featured image
            cc_chapter_attach_featured_image_to_post($default_img_url, $post_id, $caption);
        }
    }


    // Setup menus
    cc_chapter_create_menus();
}
add_action('wpmu_new_blog', 'cc_chapter_setup_default_install');


function cc_chapter_setup_widgets()
{ }
add_action('widgets_init', 'cc_chapter_setup_widgets', 11);


function cc_chapter_render_template($template_file, $variables = array())
{
    // Extract the variables to a local namespace
    extract($variables, EXTR_SKIP);
    // Start output buffering
    ob_start();
    // Include the template file
    include 'templates/' . $template_file;
    // End buffering and return its contents
    return ob_get_clean();
}
function cc_get_default_pages_query() {
    $default_pages = new WP_Query(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'category_name' => 'default-page'
    ));
    return $default_pages;
}

function cc_chapter_create_default_page($page_content, $page_title, $page_name, $page_excerpt)
{
    remove_all_filters("content_save_pre");

    $page_id = -1;
    $page_id = wp_insert_post(
        array(
            'post_author'    => 1,
            'post_content'   => $page_content,
            'post_title'     => $page_title,
            'post_excerpt'   => $page_excerpt,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_name'      => $page_name,
            'comment_status' => 'closed'
        )
    );
    return $page_id;
}


//function cc_chapter_create_default_post($title, $slug, $post_content, $cat, $post_type, $template = null) {
function cc_chapter_create_default_post($post_content, $post_title, $post_excerpt, $post_status, $post_type, $post_name, $post_category_id, $isHero)
{
    remove_all_filters("content_save_pre");

    $hero = 'Hero';
    $highlight = 'Highlight';

    // Check if the highlight exists
    $highlight_term = term_exists($highlight, 'cc_highlight', 0);
    if (!$highlight_term) {
        $highlight_term = wp_insert_term($highlight, 'cc_highlight', array('parent' => 0));
    }

    // Check if the hero exists
    $hero_term = term_exists($hero, 'cc_highlight', $highlight_term['term_taxonomy_id']);
    if (!$hero_term) {
        $hero_term = wp_insert_term($hero, 'cc_highlight', array('parent' => $highlight_term['term_taxonomy_id']));
    }

    if ($isHero == "true") {
        $custom_tax = array(
            'cc_highlight' => array($highlight_term['term_taxonomy_id'], $hero_term['term_taxonomy_id'])
        );
    } else {
        $custom_tax = array('cc_highlight' => array($highlight_term['term_taxonomy_id']));
    }

    $page_id = wp_insert_post(
        array(
            'post_author'    => 1,
            'post_content'   => $post_content,
            'post_title'     => $post_title,
            'post_excerpt'   => $post_excerpt,
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'post_name'      => $post_name,
            'comment_status' => 'closed',
            'post_category'  => array($post_category_id),
            'tax_input'      => $custom_tax
        )
    );

    return $page_id;
}


// ####################   OLD CREATE FUNCTIONS - DELETE AFTER Switch

/**
 * Programmatically creates a WordPress post based on the incoming parameters.
 *
 * Note: This function may need some additional work if you're dealing with non-English languages.
 *
 * @param string  $title    The title of the page as presented to the users
 * @param string  $slug   The slug used to access the page via the URL
 * @param string  $post_content  The content of the post
 * @param string  $post_type  The type of post to create. Can be either 'page' or 'post'
 * @param string  $template The template to apply to the page.
 * @return  int     The ID of the page that was created. -1 if the page already exists.
 */
function cc_chapter_create_post($title, $slug, $post_content, $cat, $post_type, $template = null)
{
    debug_to_console('cc_chapter_create_post', true);
    // Initialize the page ID so we know if it's been created
    $page_id = -1;

    remove_all_filters("content_save_pre");
    $page_id = wp_insert_post(
        array(
            'post_author'    => 1, // Administrator is creating the page
            'post_title'     => $title,
            'post_name'      => strtolower($slug),
            'comment_status' => 'closed',
            'post_status'    => 'publish',
            'post_content'   => $post_content,
            'post_type'      => strtolower($post_type),
            'filter'         => true,
            'post_category'  => array('category_name' => $cat),
        )
    );

    // If a template is specified in the function arguments, let's apply it
    if (null != $template) {
        update_post_meta(get_the_ID(), '_wp_page_template', $template);
    }
    return $page_id;
}


function cc_chapter_create_tags()
{
    $parent_term = term_exists('cc_highlight'); // array is returned if taxonomy is given
    $parent_term_id = $parent_term['term_id']; // get numeric term id

    // INSERT HIGHLIGHT TAXONOMY
    //wp_insert_term('Default','cc_highlight',array('description' => '','slug' => 'default','parent' => $parent_term_id));
    //wp_insert_term('Hero','cc_highlight',array('description' => '','slug' => 'hero','parent' => $parent_term_id));
    //wp_insert_term('Highlight','cc_highlight',array('description' => '','slug' => 'highlight','parent' => $parent_term_id));

    wp_insert_term('Hero', 'cc_highlight', array('description' => '', 'slug' => 'hero'));
    wp_insert_term('Highlight', 'cc_highlight', array('description' => '', 'slug' => 'highlight'));

    // INSERT CATEGORIES
    wp_insert_category(array('cat_name' => 'Home Hero', 'category_description' => '', 'category_nicename' => 'home-hero'));
    wp_insert_category(array('cat_name' => 'Links', 'category_description' => '', 'category_nicename' => 'links'));
    wp_insert_category(array('cat_name' => 'News', 'category_description' => '', 'category_nicename' => 'news'));
    wp_insert_category(array('cat_name' => 'Program', 'category_description' => '', 'category_nicename' => 'program'));
    wp_insert_category(array('cat_name' => 'Video', 'category_description' => '', 'category_nicename' => 'video'));
    wp_insert_category(array('cat_name' => 'Work', 'category_description' => '', 'category_nicename' => 'work'));
}

function cc_chapter_create_menus()
{

    // MAIN MENU Check if the menu exists
    $menu_name = 'Main Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);


    // Set up default menu items
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Licenses'),
            'menu-item-url'    => home_url('/share-your-work/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Find Resources'),
            'menu-item-url'    => home_url('/find-resources/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('About'),
            'menu-item-url'    => home_url('/about/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Local News'),
            'menu-item-url'    => home_url('/news/'),
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   =>  __('Contact'),
            'menu-item-classes' => 'contact',
            'menu-item-url'     => home_url('/contact/'),
            'menu-item-status'  => 'publish'
        ));
    }

    $locations = get_theme_mod('nav_menu_locations'); //get the menu locations
    $locations['primary'] = $menu_id; //set our new menu to be the main nav
    set_theme_mod('nav_menu_locations', $locations); //update

    $locations['mobile'] = $menu_id; //set our new menu to be the main nav
    set_theme_mod('nav_menu_locations', $locations); //update


    // SECONDARY MENU Check if the menu exists
    $menu_name = 'Social Links Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    // If it doesn't exist, let's create it.
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Set up default menu items
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Search the Commons'),
            'menu-item-type'   => 'custom',
            'menu-item-url'    => 'https://creativecommons.org/use-remix/search-the-commons/',
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   =>  __('Facebook'),
            'menu-item-classes' => 'social-navigation',
            'menu-item-type'    => 'custom',
            'menu-item-url'     => 'https://www.facebook.com/creativecommons',
            'menu-item-status'  => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   =>  __('Twitter'),
            'menu-item-classes' => 'social-navigation',
            'menu-item-type'    => 'custom',
            'menu-item-url'     => 'https://twitter.com/creativecommons',
            'menu-item-status'  => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'   =>  __('Email'),
            'menu-item-classes' => 'social-navigation',
            'menu-item-type'    => 'custom',
            'menu-item-url'     => 'mailto:info@creativecommons.org',
            'menu-item-status'  => 'publish'
        ));
    }

    $locations = get_theme_mod('nav_menu_locations'); //get the menu locations
    $locations['secondary'] = $menu_id; //set our new menu to be the main nav
    set_theme_mod('nav_menu_locations', $locations); //update

    // FOOTER MENU
    $menu_name = 'Footer Links';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    // If it doesn't exist, let's create it.
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Set up default menu items
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Policy'),
            'menu-item-url'    => '/policies/',
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Privacy'),
            'menu-item-url'    => '/privacy/',
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Terms'),
            'menu-item-url'    => '/terms/',
            'menu-item-status' => 'publish'
        ));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title'  =>  __('Contact'),
            'menu-item-url'    => '/contact/',
            'menu-item-status' => 'publish'
        ));
    }

    $locations = get_theme_mod('nav_menu_locations'); //get the menu locations
    $locations['footer-links'] = $menu_id; //set our new menu to be the main nav
    set_theme_mod('nav_menu_locations', $locations); //update
}


function cc_chapter_attach_featured_image_to_post($url, $post_id, $caption)
{

    $tmp = download_url($url);
    $file_array = array(
        'name' => basename($url),
        'tmp_name' => $tmp
    );
    if (is_wp_error($tmp)) {
        @unlink($file_array['tmp_name']);
        return $tmp;
    }
    $attachment_id = media_handle_sideload($file_array, $post_id);
    if (is_wp_error($attachment_id)) {
        @unlink($file_array['tmp_name']);
        return $id;
    }
    $value = wp_get_attachment_url($attachment_id);
    $attachment_data = array(
        'ID' => $attachment_id,
        'post_excerpt' => $caption
    );
    wp_update_post($attachment_data);
    set_post_thumbnail($post_id, $attachment_id);
}


function debug_to_console($data, $type)
{
    if ($type)
        $output = "<script>console.log(" . $data . " );</script>";
    else
        $output = "<script>console.dir(" . json_encode($data) . " );</script>";
    //echo $output;
}


/**
* Add new field in site signup form /wp-signup.php
*
* URI: http://wordpress.stackexchange.com/a/50550/12615
*/
function signup_blogform_extra_field()
{
    $txt = __('Country Code');
    echo '
    <table class="form-table"><tbody><tr class="form-field form-required">
    <th scope="row"><label for="admin-country-code">' . $txt . '</label></th>
    <td><input name="blog[country_code]" type="email" class="regular-text" id="admin-country-code" style="max-width: 25em;" autocomplete="off"></td></tr><tr><td colspan="2">Enter two letter country code or leave blank</td>
    </tr></tbody></table>
    ';
}

add_action('network_site_new_form', 'signup_blogform_extra_field');
