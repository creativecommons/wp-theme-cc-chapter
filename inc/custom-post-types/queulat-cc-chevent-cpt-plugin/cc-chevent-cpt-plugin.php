<?php
/**
 * Plugin Name: Events Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */
function cc_chevent_register_post_type() {
	require_once __DIR__ .'/class-cc-chevent-post-type.php';
	Cc_Chevent_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-chevent-post-type.php';
	require_once __DIR__ .'/class-cc-chevent-post-query.php';
	require_once __DIR__ .'/class-cc-chevent-post-object.php';
	require_once __DIR__ .'/class-cc-chevent-metabox.php';
}

add_action('init', 'cc_chevent_register_post_type');
