<?php
// Register Custom Taxonomy
function cc_taxonomy_highlight() {
	$labels = array(
		'name'                       => _x( 'Highlight Post', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Highlight', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Highlight', 'text_domain' ),
		'all_items'                  => __( 'Type', 'text_domain' ),
		'parent_item'                => __( 'Parent Highlights', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Highlight:', 'text_domain' ),
		'new_item_name'              => __( 'New Highlight Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Highlight', 'text_domain' ),
		'edit_item'                  => __( 'Edit Highlight', 'text_domain' ),
		'update_item'                => __( 'Update Highlight', 'text_domain' ),
		'view_item'                  => __( 'View Highlight', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Highlight with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Highlights', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Highlight', 'text_domain' ),
		'search_items'               => __( 'Search Highlight', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Highlight', 'text_domain' ),
		'items_list'                 => __( 'Highlight list', 'text_domain' ),
		'items_list_navigation'      => __( 'Highlight list navigation', 'text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'cc_highlight', array( 'post' ), $args );

	// Register Team group taxonomy

	$labels = array(
		'name'                       => _x('Team Groups', 'Taxonomy General Name', 'cc_chapters'),
		'singular_name'              => _x('Team Group', 'Taxonomy Singular Name', 'cc_chapters'),
		'menu_name'                  => __('Team Groups', 'cc_chapters'),
		'all_items'                  => __('Team Groups', 'cc_chapters'),
		'parent_item'                => __('Parent Item', 'cc_chapters'),
		'parent_item_colon'          => __('Parent Item:', 'cc_chapters'),
		'new_item_name'              => __('New Team Group', 'cc_chapters'),
		'add_new_item'               => __('Add New Team Group', 'cc_chapters'),
		'edit_item'                  => __('Edit Team Group', 'cc_chapters'),
		'update_item'                => __('Update Team Group', 'cc_chapters'),
		'view_item'                  => __('View Team Group', 'cc_chapters'),
		'separate_items_with_commas' => __('Separate items with commas', 'cc_chapters'),
		'add_or_remove_items'        => __('Add or remove items', 'cc_chapters'),
		'choose_from_most_used'      => __('Choose from the most used', 'cc_chapters'),
		'popular_items'              => __('Popular Items', 'cc_chapters'),
		'search_items'               => __('Search Items', 'cc_chapters'),
		'not_found'                  => __('Not Found', 'cc_chapters'),
		'no_terms'                   => __('No Team Groups', 'cc_chapters'),
		'items_list'                 => __('Items list', 'cc_chapters'),
		'items_list_navigation'      => __('Items list navigation', 'cc_chapters'),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => false,
		'show_in_rest'               => true,
	);
	register_taxonomy('Team Group', array('cc_chteam'), $args);

}
add_action( 'init', 'cc_taxonomy_highlight', 0 );


function cc_add_taxonomies_to_pages() {
	 register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'cc_add_taxonomies_to_pages' );
