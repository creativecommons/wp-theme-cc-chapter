<?php

use Queulat\Post_Type;

class Cc_Chevent_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chevent';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Events', 'cpt_cc_chevent'),
			'labels'                => [
				'name'                     => __('Events', 'cpt_cc_chevent'),
				'singular_name'            => __('Events', 'cpt_cc_chevent'),
				'add_new'                  => __('Add New', 'cpt_cc_chevent'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chevent'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chevent'),
				'new_item'                 => __('New Page', 'cpt_cc_chevent'),
				'view_item'                => __('View Page', 'cpt_cc_chevent'),
				'view_items'               => __('View Pages', 'cpt_cc_chevent'),
				'search_items'             => __('Search Pages', 'cpt_cc_chevent'),
				'not_found'                => __('No pages found.', 'cpt_cc_chevent'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chevent'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chevent'),
				'all_items'                => __('Events', 'cpt_cc_chevent'),
				'archives'                 => __('Events', 'cpt_cc_chevent'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chevent'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chevent'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chevent'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chevent'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chevent'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chevent'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chevent'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chevent'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chevent'),
				'items_list'               => __('Pages list', 'cpt_cc_chevent'),
				'item_published'           => __('Page published.', 'cpt_cc_chevent'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chevent'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chevent'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chevent'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chevent'),
				'menu_name'                => __('Events', 'cpt_cc_chevent'),
				'name_admin_bar'           => __('Events', 'cpt_cc_chevent'),
			],
			'description'           => __('', 'cpt_cc_chevent'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-calendar-alt',
			'capability_type'       => [
				0 => 'cc_chevent',
				1 => 'cc_chevents',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => true,
			'query_var'             => 'cc_chevent',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => [
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
				'slug'       => 'event',
				'ep_mask'    => 1,
			],
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
