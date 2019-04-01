<?php

use Queulat\Post_Type;

class Cc_Chvideos_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chvideos';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Chapters Videos', 'cpt_cc_chvideos'),
			'labels'                => [
				'name'                     => __('Chapters Videos', 'cpt_cc_chvideos'),
				'singular_name'            => __('Chapters Videos', 'cpt_cc_chvideos'),
				'add_new'                  => __('Add New', 'cpt_cc_chvideos'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chvideos'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chvideos'),
				'new_item'                 => __('New Page', 'cpt_cc_chvideos'),
				'view_item'                => __('View Page', 'cpt_cc_chvideos'),
				'view_items'               => __('View Pages', 'cpt_cc_chvideos'),
				'search_items'             => __('Search Pages', 'cpt_cc_chvideos'),
				'not_found'                => __('No pages found.', 'cpt_cc_chvideos'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chvideos'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chvideos'),
				'all_items'                => __('Chapters Videos', 'cpt_cc_chvideos'),
				'archives'                 => __('Chapters Videos', 'cpt_cc_chvideos'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chvideos'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chvideos'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chvideos'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chvideos'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chvideos'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chvideos'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chvideos'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chvideos'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chvideos'),
				'items_list'               => __('Pages list', 'cpt_cc_chvideos'),
				'item_published'           => __('Page published.', 'cpt_cc_chvideos'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chvideos'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chvideos'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chvideos'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chvideos'),
				'menu_name'                => __('Chapters Videos', 'cpt_cc_chvideos'),
				'name_admin_bar'           => __('Chapters Videos', 'cpt_cc_chvideos'),
			],
			'description'           => __('', 'cpt_cc_chvideos'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-video-alt',
			'capability_type'       => [
				0 => 'cc_chvideo',
				1 => 'cc_chvideos',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => true,
			'query_var'             => 'cc_chvideos',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => [
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
				'slug'       => 'cc_chvideos',
				'ep_mask'    => 1,
			],
			'supports'              => [
				0 => 'title',
				1 => 'editor',
				2 => 'thumbnail',
			],
			'show_in_rest'          => true,
			'rest_base'             => false,
			'rest_controller_class' => false
		];
	}
}
