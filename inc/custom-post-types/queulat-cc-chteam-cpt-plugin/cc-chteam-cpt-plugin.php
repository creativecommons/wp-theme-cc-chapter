<?php
/**
 * Plugin Name: Team members Custom Post Type Plugin
 * Plugin URI:
 * Description: 
 * Version: 0.1.0
 * Author:
 * Author URI:
 * License: GPL-3.0-or-later
 */

register_activation_hook( __FILE__, function(){
	
});

add_action('plugins_loaded', function(){
	require_once __DIR__ .'/class-cc-chteam-post-type.php';
	require_once __DIR__ .'/class-cc-chteam-post-query.php';
	require_once __DIR__ .'/class-cc-chteam-post-object.php';
});
function cc_chteam_register_post_type() {
	require_once __DIR__ .'/class-cc-chteam-post-type.php';
	Cc_Chteam_Post_Type::activate_plugin();
	require_once __DIR__ .'/class-cc-chteam-post-type.php';
	require_once __DIR__ .'/class-cc-chteam-post-query.php';
	require_once __DIR__ .'/class-cc-chteam-post-object.php';
	require_once __DIR__ .'/class-cc-chteam-metabox.php';
}
add_action('init', 'cc_chteam_register_post_type');
