<?php
/**
 * Plugin Name: Local Works Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */
function cc_chwork_register_post_type() {
	require_once __DIR__ .'/class-cc-chwork-post-type.php';
	Cc_Chwork_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-chwork-post-type.php';
	require_once __DIR__ .'/class-cc-chwork-post-query.php';
	require_once __DIR__ .'/class-cc-chwork-post-object.php';
}

add_action('init', 'cc_chwork_register_post_type');
