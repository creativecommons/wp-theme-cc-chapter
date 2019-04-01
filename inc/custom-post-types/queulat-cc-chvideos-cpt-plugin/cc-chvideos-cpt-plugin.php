<?php
/**
 * Plugin Name: Chapters Videos Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */

function cc_chvideos_register_post_type() {
	require_once __DIR__ .'/class-cc-chvideos-post-type.php';
	Cc_Chvideos_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-chvideos-post-type.php';
	require_once __DIR__ .'/class-cc-chvideos-post-query.php';
	require_once __DIR__ .'/class-cc-chvideos-post-object.php';
}
add_action('init', 'cc_chvideos_register_post_type');
