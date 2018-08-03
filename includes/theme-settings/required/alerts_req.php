<?php

// alerts post type
register_post_type('nav_alerts', array(	'label' => 'Nav Alerts','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'page','hierarchical' => false,'has_archive'=>true,'rewrite'=>array('slug'=>'nav-alerts'),'supports' => array('title','editor','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),'menu_icon' => 'dashicons-flag','labels' => array (
  'name' => 'Nav Alerts',
  'singular_name' => 'Nav Alert',
  'menu_name' => 'Nav Alerts',
  'add_new' => 'Add Nav Alerts',
  'add_new_item' => 'Add New Nav Alert',
  'edit' => 'Edit',
  'edit_item' => 'Edit Nav Alert',
  'new_item' => 'New Nav Alert',
  'view' => 'View Nav Alert',
  'view_item' => 'View Nav Alert',
  'search_items' => 'Search Nav Alerts',
  'not_found' => 'No Nav Alerts Found',
  'not_found_in_trash' => 'No Nav Alerts Found in Trash',
  'parent' => 'Parent Nav Alert',
),) );

/* Reginal Taxonomy for Nav Alerts */
register_taxonomy('cnet_regions_alerts', array('nav_alerts','post'), array('label'=>'Regions', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true,'query_var'=>true,'rewrite'=>array('slug'=>'alert-region'), 'show_tagcloud'=>false, 'hierarchical'=>true, 'labels'=>array(
	'name' => 'Alert Regions',
	'singular_name' => 'Alert Regions',
	'search_items' => 'Search Alert Regions',
	'popular_items' => 'Popular Alert Regions',
	'all_items' => 'All Alert Regions',
	'parent_item' => 'Parent Alert Region',
	'parent_item_colon' => 'Parent Alert Region:',
	'edit_item' => 'Edit Alert Region',
	'update_item' => 'Edit Alert Region',
	'add_new_item' => 'Add New Alert Region',
	'new_item_name' => 'New Alert Region Name',
	'separate_items_with_commas' => 'Separate Alert Regions with commas',
	'add_or_remove_items' => 'Add or remove Alert Regions',
	'choose_from_most_used' => 'Choose from the most used Alert Regions',
	'menu_name' => 'Alert Regions',
)));