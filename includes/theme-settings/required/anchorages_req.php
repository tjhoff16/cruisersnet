<?php

// anchorages post type
register_post_type('cnet_anchorages', array(	'label' => 'Anchorages','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','ngg_tag',),'menu_icon' => 'dashicons-location-alt','labels' => array (
  'name' => 'Anchorages',
  'singular_name' => 'Anchorage',
  'menu_name' => 'Anchorages',
  'add_new' => 'Add Anchorages',
  'add_new_item' => 'Add New Anchorage',
  'edit' => 'Edit',
  'edit_item' => 'Edit Anchorage',
  'new_item' => 'New Anchorage',
  'view' => 'View Anchorage',
  'view_item' => 'View Anchorage',
  'search_items' => 'Search Anchorages',
  'not_found' => 'No Anchorages Found',
  'not_found_in_trash' => 'No Anchorages Found in Trash',
  'parent' => 'Parent Anchorage',
),) );

/* Reginal Taxonomy for Anchorages */
register_taxonomy('cnet_regions_anchorage', array('cnet_anchorages','post'), array('label'=>'Regions', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true, 'show_tagcloud'=>false, 'hierarchical'=>true, 'labels'=>array(
	'name' => 'A Regions',
	'singular_name' => 'Regions',
	'search_items' => 'Search Regions',
	'popular_items' => 'Popular Regions',
	'all_items' => 'All Regions',
	'parent_item' => 'Parent Region',
	'parent_item_colon' => 'Parent Region:',
	'edit_item' => 'Edit Region',
	'update_item' => 'Edit Region',
	'add_new_item' => 'Add New Region',
	'new_item_name' => 'New Region Name',
	'separate_items_with_commas' => 'Separate Regions with commas',
	'add_or_remove_items' => 'Add or remove Regions',
	'choose_from_most_used' => 'Choose from the most used Regions',
	'menu_name' => 'A Regions',
)));

// HIDE THE EDITOR ON CERTAIN CUSTOM POST TYPES 
add_action('init', 'anchorage_remove_editor'); 
function anchorage_remove_editor() { 
	remove_post_type_support( 'cnet_anchorages', 'editor' );
}