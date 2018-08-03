<?php
// Register Custom Post Type
function cnet_register_archive() {

	$labels = array(
		'name'                  => _x( 'Archives', 'Post Type General Name', 'cnet' ),
		'singular_name'         => _x( 'Archive', 'Post Type Singular Name', 'cnet' ),
		'menu_name'             => __( 'Archive', 'cnet' ),
		'name_admin_bar'        => __( 'Archive', 'cnet' ),
		'archives'              => __( 'Archives', 'cnet' ),
		'parent_item_colon'     => __( 'Parent Archive Item:', 'cnet' ),
		'all_items'             => __( 'All Archive Items', 'cnet' ),
		'add_new_item'          => __( 'Add New Archive Item', 'cnet' ),
		'add_new'               => __( 'Add New', 'cnet' ),
		'new_item'              => __( 'New Archive Item', 'cnet' ),
		'edit_item'             => __( 'Edit Archive Item', 'cnet' ),
		'update_item'           => __( 'Update Archive Item', 'cnet' ),
		'view_item'             => __( 'View Archive Item', 'cnet' ),
		'search_items'          => __( 'Search Archive Items', 'cnet' ),
		'not_found'             => __( 'Not found', 'cnet' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cnet' ),
		'featured_image'        => __( 'Featured Image', 'cnet' ),
		'set_featured_image'    => __( 'Set featured image', 'cnet' ),
		'remove_featured_image' => __( 'Remove featured image', 'cnet' ),
		'use_featured_image'    => __( 'Use as featured image', 'cnet' ),
		'insert_into_item'      => __( 'Insert into Archive item', 'cnet' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Archive item', 'cnet' ),
		'items_list'            => __( 'Archive list', 'cnet' ),
		'items_list_navigation' => __( 'Archive list navigation', 'cnet' ),
		'filter_items_list'     => __( 'Filter Archive list', 'cnet' ),
	);
	$args = array(
		'label'                 => __( 'Archive', 'cnet' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'cnet_archive', $args );

}
add_action( 'init', 'cnet_register_archive', 0 );