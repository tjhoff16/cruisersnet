<?php

// bridges post type
register_post_type('cnet_bridges', array(	'label' => 'Bridges','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','ngg_tag',),'menu_icon' => 'dashicons-location-alt','labels' => array (
  'name' => 'Bridges',
  'singular_name' => 'Bridge',
  'menu_name' => 'Bridges',
  'add_new' => 'Add Bridges',
  'add_new_item' => 'Add New Bridge',
  'edit' => 'Edit',
  'edit_item' => 'Edit Bridge',
  'new_item' => 'New Bridge',
  'view' => 'View Bridge',
  'view_item' => 'View Bridge',
  'search_items' => 'Search Bridges',
  'not_found' => 'No Bridges Found',
  'not_found_in_trash' => 'No Bridges Found in Trash',
  'parent' => 'Parent Bridge',
),) );

/* Reginal Taxonomy for Bridges */
register_taxonomy('cnet_regions_bridges', array('cnet_bridges','post'), array('label'=>'Regions', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true, 'show_tagcloud'=>false, 'hierarchical'=>true, 'labels'=>array(
	'name' => 'B Regions',
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
	'menu_name' => 'B Regions',
)));