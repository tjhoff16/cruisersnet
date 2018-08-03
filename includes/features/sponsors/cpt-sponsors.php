<?php
// Register Custom Post Type
function cnet_register_sponsors() {

	$labels = array(
		'name'                => _x( 'Sponsors', 'Post Type General Name', 'cnet' ),
		'singular_name'       => _x( 'Sponsor', 'Post Type Singular Name', 'cnet' ),
		'menu_name'           => __( 'Sponsors', 'cnet' ),
		'name_admin_bar'      => __( 'Sponsors', 'cnet' ),
		'parent_item_colon'   => __( 'Parent Sponsor:', 'cnet' ),
		'all_items'           => __( 'All Sponsors', 'cnet' ),
		'add_new_item'        => __( 'Add New Sponsor', 'cnet' ),
		'add_new'             => __( 'Add New', 'cnet' ),
		'new_item'            => __( 'New Sponsor', 'cnet' ),
		'edit_item'           => __( 'Edit Sponsor', 'cnet' ),
		'update_item'         => __( 'Update Sponsor', 'cnet' ),
		'view_item'           => __( 'View Sponsor', 'cnet' ),
		'search_items'        => __( 'Search Sponsors', 'cnet' ),
		'not_found'           => __( 'Not found', 'cnet' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'cnet' ),
	);
	$args = array(
		'label'               => __( 'Sponsor', 'cnet' ),
		'description'         => __( 'Custom post type for CNET Sponsors', 'cnet' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'cnet_sponsor_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-star-half',
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,		
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cnet_sponsors', $args );

}
add_action( 'init', 'cnet_register_sponsors', 0 );

// Register Custom Taxonomy
function cnet_register_sponsor_groups() {

	$labels = array(
		'name'                       => _x( 'Sponsor Groups', 'Taxonomy General Name', 'cnet' ),
		'singular_name'              => _x( 'Sponsor Group', 'Taxonomy Singular Name', 'cnet' ),
		'menu_name'                  => __( 'Sponsor Groups', 'cnet' ),
		'all_items'                  => __( 'All Sponsor Groups', 'cnet' ),
		'parent_item'                => __( 'Parent Sponsor Group', 'cnet' ),
		'parent_item_colon'          => __( 'Parent Sponsor Group:', 'cnet' ),
		'new_item_name'              => __( 'New Sponsor Group Name', 'cnet' ),
		'add_new_item'               => __( 'Add New Sponsor Group', 'cnet' ),
		'edit_item'                  => __( 'Edit Sponsor Group', 'cnet' ),
		'update_item'                => __( 'Update Sponsor Group', 'cnet' ),
		'view_item'                  => __( 'View Sponsor Group', 'cnet' ),
		'separate_items_with_commas' => __( 'Separate Sponsor Groups with commas', 'cnet' ),
		'add_or_remove_items'        => __( 'Add or remove Sponsor Groups', 'cnet' ),
		'choose_from_most_used'      => __( 'Choose from the most used Sponsor Groups', 'cnet' ),
		'popular_items'              => __( 'Popular Sponsor Groups', 'cnet' ),
		'search_items'               => __( 'Search Sponsor Groups', 'cnet' ),
		'not_found'                  => __( 'Sponsor Group Not Found', 'cnet' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'cnet_sponsor_groups', array( 'cnet_sponsors' ), $args );

}
add_action( 'init', 'cnet_register_sponsor_groups', 0 );