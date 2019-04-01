<?php

use Queulat\Post_Type;

class Cc_Charea_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_charea';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Program Areas', 'cpt_cc_charea'),
			'labels'                => [
				'name'                     => __('Program Areas', 'cpt_cc_charea'),
				'singular_name'            => __('Program Areas', 'cpt_cc_charea'),
				'add_new'                  => __('Add New', 'cpt_cc_charea'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_charea'),
				'edit_item'                => __('Edit Page', 'cpt_cc_charea'),
				'new_item'                 => __('New Page', 'cpt_cc_charea'),
				'view_item'                => __('View Page', 'cpt_cc_charea'),
				'view_items'               => __('View Pages', 'cpt_cc_charea'),
				'search_items'             => __('Search Pages', 'cpt_cc_charea'),
				'not_found'                => __('No pages found.', 'cpt_cc_charea'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_charea'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_charea'),
				'all_items'                => __('Program Areas', 'cpt_cc_charea'),
				'archives'                 => __('Program Areas', 'cpt_cc_charea'),
				'attributes'               => __('Page Attributes', 'cpt_cc_charea'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_charea'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_charea'),
				'featured_image'           => __('Featured Image', 'cpt_cc_charea'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_charea'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_charea'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_charea'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_charea'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_charea'),
				'items_list'               => __('Pages list', 'cpt_cc_charea'),
				'item_published'           => __('Page published.', 'cpt_cc_charea'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_charea'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_charea'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_charea'),
				'item_updated'             => __('Page updated.', 'cpt_cc_charea'),
				'menu_name'                => __('Program Areas', 'cpt_cc_charea'),
				'name_admin_bar'           => __('Program Areas', 'cpt_cc_charea'),
			],
			'description'           => __('', 'cpt_cc_charea'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-welcome-learn-more',
			'capability_type'       => [
				0 => 'cc_charea',
				1 => 'cc_chareas',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => true,
			'query_var'             => 'cc_charea',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => [
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
				'slug'       => 'area',
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
