<?php

use Queulat\Post_Type;

class Cc_Chwork_Post_Type extends Post_Type {
	public function get_post_type() : string {
		return 'cc_chwork';
	}
	public function get_post_type_args() : array {
		return [
			'label'                 => __('Local Works', 'cpt_cc_chwork'),
			'labels'                => [
				'name'                     => __('Local Works', 'cpt_cc_chwork'),
				'singular_name'            => __('Local Works', 'cpt_cc_chwork'),
				'add_new'                  => __('Add New', 'cpt_cc_chwork'),
				'add_new_item'             => __('Add New Page', 'cpt_cc_chwork'),
				'edit_item'                => __('Edit Page', 'cpt_cc_chwork'),
				'new_item'                 => __('New Page', 'cpt_cc_chwork'),
				'view_item'                => __('View Page', 'cpt_cc_chwork'),
				'view_items'               => __('View Pages', 'cpt_cc_chwork'),
				'search_items'             => __('Search Pages', 'cpt_cc_chwork'),
				'not_found'                => __('No pages found.', 'cpt_cc_chwork'),
				'not_found_in_trash'       => __('No pages found in Trash.', 'cpt_cc_chwork'),
				'parent_item_colon'        => __('Parent Page:', 'cpt_cc_chwork'),
				'all_items'                => __('Local Works', 'cpt_cc_chwork'),
				'archives'                 => __('Local Works', 'cpt_cc_chwork'),
				'attributes'               => __('Page Attributes', 'cpt_cc_chwork'),
				'insert_into_item'         => __('Insert into page', 'cpt_cc_chwork'),
				'uploaded_to_this_item'    => __('Uploaded to this page', 'cpt_cc_chwork'),
				'featured_image'           => __('Featured Image', 'cpt_cc_chwork'),
				'set_featured_image'       => __('Set featured image', 'cpt_cc_chwork'),
				'remove_featured_image'    => __('Remove featured image', 'cpt_cc_chwork'),
				'use_featured_image'       => __('Use as featured image', 'cpt_cc_chwork'),
				'filter_items_list'        => __('Filter pages list', 'cpt_cc_chwork'),
				'items_list_navigation'    => __('Pages list navigation', 'cpt_cc_chwork'),
				'items_list'               => __('Pages list', 'cpt_cc_chwork'),
				'item_published'           => __('Page published.', 'cpt_cc_chwork'),
				'item_published_privately' => __('Page published privately.', 'cpt_cc_chwork'),
				'item_reverted_to_draft'   => __('Page reverted to draft.', 'cpt_cc_chwork'),
				'item_scheduled'           => __('Page scheduled.', 'cpt_cc_chwork'),
				'item_updated'             => __('Page updated.', 'cpt_cc_chwork'),
				'menu_name'                => __('Local Works', 'cpt_cc_chwork'),
				'name_admin_bar'           => __('Local Works', 'cpt_cc_chwork'),
			],
			'description'           => __('', 'cpt_cc_chwork'),
			'public'                => true,
			'hierarchical'          => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => true,
			'show_in_admin_bar'     => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-portfolio',
			'capability_type'       => [
				0 => 'cc_chwork',
				1 => 'cc_chworks',
			],
			'map_meta_cap'          => true,
			'register_meta_box_cb'  => null,
			'taxonomies'            => [ 'post_tag' ],
			'has_archive'           => true,
			'query_var'             => 'cc_chwork',
			'can_export'            => true,
			'delete_with_user'      => true,
			'rewrite'               => [
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
				'slug'       => 'work',
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
