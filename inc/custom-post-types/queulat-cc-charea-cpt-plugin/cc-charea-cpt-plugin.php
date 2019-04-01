<?php
/**
 * Plugin Name: Program Areas Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */

function cc_charea_register_post_type() {
	require_once __DIR__ .'/class-cc-charea-post-type.php';
	Cc_Charea_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-charea-post-type.php';
	require_once __DIR__ .'/class-cc-charea-post-query.php';
	require_once __DIR__ .'/class-cc-charea-post-object.php';
}
add_action('init', 'cc_charea_register_post_type');
