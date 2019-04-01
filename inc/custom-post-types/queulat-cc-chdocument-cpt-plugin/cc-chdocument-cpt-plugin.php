<?php
/**
 * Plugin Name: Documents Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */

function cc_chdocument_register_post_type() {
	require_once __DIR__ .'/class-cc-chdocument-post-type.php';
	Cc_Chdocument_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-chdocument-post-type.php';
	require_once __DIR__ .'/class-cc-chdocument-post-query.php';
	require_once __DIR__ .'/class-cc-chdocument-post-object.php';
	require_once __DIR__ .'/class-cc-chdocument-metabox.php';
}
add_action('init', 'cc_chdocument_register_post_type');
