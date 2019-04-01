<?php
/**
 * Plugin Name: Featured Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */

function cc_chfeature_register_post_type() {
	require_once __DIR__ .'/class-cc-chfeature-post-type.php';
	Cc_Chfeature_Post_Type::activate_plugin();

	require_once __DIR__ .'/class-cc-chfeature-post-type.php';
	require_once __DIR__ .'/class-cc-chfeature-post-query.php';
	require_once __DIR__ .'/class-cc-chfeature-post-object.php';
	//require_once __DIR__ .'/class-cc-chfeature-metabox.php';
}

add_action('init', 'cc_chfeature_register_post_type');
