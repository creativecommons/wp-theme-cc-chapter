<?php

use Queulat\Post_Type;

class Cc_Chfeature_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chfeature';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Featured', 'cpt_cc_chfeature'),
			'labels'                => [
				'name'                     => __('Featured', 'cpt_cc_chfeature'),
				'singular_name'            => __('Featured', 'cpt_cc_chfeature'),
				'add_new'                  => __('Add New', 'cpt_cc_chfeature'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chfeature'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chfeature'),
				'new_item'                 => __('New Page', 'cpt_cc_chfeature'),
				'view_item'                => __('View Page', 'cpt_cc_chfeature'),
				'view_items'               => __('View Pages', 'cpt_cc_chfeature'),
				'search_items'             => __('Search Pages', 'cpt_cc_chfeature'),
				'not_found'                => __('No pages found.', 'cpt_cc_chfeature'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chfeature'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chfeature'),
				'all_items'                => __('Featured', 'cpt_cc_chfeature'),
				'archives'                 => __('Featured', 'cpt_cc_chfeature'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chfeature'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chfeature'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chfeature'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chfeature'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chfeature'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chfeature'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chfeature'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chfeature'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chfeature'),
				'items_list'               => __('Pages list', 'cpt_cc_chfeature'),
				'item_published'           => __('Page published.', 'cpt_cc_chfeature'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chfeature'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chfeature'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chfeature'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chfeature'),
				'menu_name'                => __('Featured', 'cpt_cc_chfeature'),
				'name_admin_bar'           => __('Featured', 'cpt_cc_chfeature'),
			],
			'description'           => __('', 'cpt_cc_chfeature'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-star-filled',
			'capability_type'       => [
				0 => 'cc_chfeature',
				1 => 'cc_chfeatures',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => false,
			'query_var'             => 'cc_chfeature',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => false,
			'supports'              => [
				0 => 'title',
				2 => 'editor'
			],
			'show_in_rest'          => true,
			'rest_base'             => false,
			'rest_controller_class' => false
		];
	}
}
