<?php

use Queulat\Post_Type;

class Cc_Chteam_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chteam';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Team members', 'cpt_cc_chteam'),
			'labels'                => [
				'name'                     => __('Team members', 'cpt_cc_chteam'),
				'singular_name'            => __('Team members', 'cpt_cc_chteam'),
				'add_new'                  => __('Add New', 'cpt_cc_chteam'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chteam'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chteam'),
				'new_item'                 => __('New Page', 'cpt_cc_chteam'),
				'view_item'                => __('View Page', 'cpt_cc_chteam'),
				'view_items'               => __('View Pages', 'cpt_cc_chteam'),
				'search_items'             => __('Search Pages', 'cpt_cc_chteam'),
				'not_found'                => __('No pages found.', 'cpt_cc_chteam'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chteam'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chteam'),
				'all_items'                => __('Team members', 'cpt_cc_chteam'),
				'archives'                 => __('Team members', 'cpt_cc_chteam'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chteam'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chteam'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chteam'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chteam'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chteam'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chteam'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chteam'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chteam'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chteam'),
				'items_list'               => __('Pages list', 'cpt_cc_chteam'),
				'item_published'           => __('Page published.', 'cpt_cc_chteam'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chteam'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chteam'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chteam'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chteam'),
				'menu_name'                => __('Team members', 'cpt_cc_chteam'),
				'name_admin_bar'           => __('Team members', 'cpt_cc_chteam'),
			],
			'description'           => __('', 'cpt_cc_chteam'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-groups',
			'capability_type'       => [
				0 => 'cc_chteam',
				1 => 'cc_chteams',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => true,
			'query_var'             => 'cc_chteam',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => false,
			'supports'              => [
				0 => 'title',
				1 => 'editor',
				2 => 'thumbnail',
				3 => 'excerpt',
			],
			'show_in_rest'          => true,
			'rest_base'             => false,
			'rest_controller_class' => false
		];
	}
}
