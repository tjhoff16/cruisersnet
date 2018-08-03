<?php

// Review post type
register_post_type('cnet_reviews', array(	'label' => 'Reviews','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','ngg_tag',),'menu_icon' => 'dashicons-format-chat','labels' => array (
  'name' => 'Reviews',
  'singular_name' => 'Review',
  'menu_name' => 'Reviews',
  'add_new' => 'Add Reviews',
  'add_new_item' => 'Add New Review',
  'edit' => 'Edit',
  'edit_item' => 'Edit Review',
  'new_item' => 'New Review',
  'view' => 'View Review',
  'view_item' => 'View Review',
  'search_items' => 'Search Reviews',
  'not_found' => 'No Reviews Found',
  'not_found_in_trash' => 'No Reviews Found in Trash',
  'parent' => 'Parent Review',
),) );

/* Reginal Taxonomy for Reviews */
register_taxonomy('cnet_reviews_category', array('cnet_reviews','post'), array('label'=>'Review Categories', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true, 'show_tagcloud'=>false, 'hierarchical'=>true, 'labels'=>array(
	'name' => 'Review Category',
	'singular_name' => 'Review Category',
	'search_items' => 'Search Review Categories',
	'popular_items' => 'Popular Review Categories',
	'all_items' => 'All Review Categories',
	'parent_item' => 'Parent Region Category',
	'parent_item_colon' => 'Parent Region Category:',
	'edit_item' => 'Edit Region Category',
	'update_item' => 'Edit Region Category',
	'add_new_item' => 'Add New Region Category',
	'new_item_name' => 'New Region Name Category',
	'separate_items_with_commas' => 'Separate Review Categories with commas',
	'add_or_remove_items' => 'Add or remove Review Categories',
	'choose_from_most_used' => 'Choose from the most used Review Categories',
	'menu_name' => 'Review Categories',
)));