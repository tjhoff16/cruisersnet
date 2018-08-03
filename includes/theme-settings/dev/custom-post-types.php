<?php

// Reginal taxonomy for marinas
register_taxonomy('cnet_regions_marinas', array('cnet_marinas','post'), array('label'=>'Regions', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true, 'show_tagcloud'=>false, 'hierarchical'=>true, 'labels'=>array(
	'name' => 'M Regions',
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
	'menu_name' => 'M Regions',
)));

// Reginal taxonomy for achorages
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

// Reginal taxonomy for bridges
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

// Reginal taxonomy for nav alerts
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