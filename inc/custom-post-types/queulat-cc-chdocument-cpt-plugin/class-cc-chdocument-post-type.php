<?php

use Queulat\Post_Type;

class Cc_Chdocument_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chdocument';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Documents', 'cpt_cc_chdocument'),
			'labels'                => [
				'name'                     => __('Documents', 'cpt_cc_chdocument'),
				'singular_name'            => __('Documents', 'cpt_cc_chdocument'),
				'add_new'                  => __('Add New', 'cpt_cc_chdocument'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chdocument'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chdocument'),
				'new_item'                 => __('New Page', 'cpt_cc_chdocument'),
				'view_item'                => __('View Page', 'cpt_cc_chdocument'),
				'view_items'               => __('View Pages', 'cpt_cc_chdocument'),
				'search_items'             => __('Search Pages', 'cpt_cc_chdocument'),
				'not_found'                => __('No pages found.', 'cpt_cc_chdocument'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chdocument'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chdocument'),
				'all_items'                => __('Documents', 'cpt_cc_chdocument'),
				'archives'                 => __('Documents', 'cpt_cc_chdocument'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chdocument'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chdocument'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chdocument'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chdocument'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chdocument'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chdocument'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chdocument'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chdocument'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chdocument'),
				'items_list'               => __('Pages list', 'cpt_cc_chdocument'),
				'item_published'           => __('Page published.', 'cpt_cc_chdocument'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chdocument'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chdocument'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chdocument'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chdocument'),
				'menu_name'                => __('Documents', 'cpt_cc_chdocument'),
				'name_admin_bar'           => __('Documents', 'cpt_cc_chdocument'),
			],
			'description'           => __('', 'cpt_cc_chdocument'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-media-document',
			'capability_type'       => [
				0 => 'cc_chdocument',
				1 => 'cc_chdocuments',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [],
			'has_archive'           => true,
			'query_var'             => 'cc_chdocument',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => [
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
				'slug'       => 'document',
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
