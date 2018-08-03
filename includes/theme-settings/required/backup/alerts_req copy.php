<?php

// alerts post type
register_post_type('nav_alerts', array(	'label' => 'Nav Alerts','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'has_archive'=>true,'rewrite'=>array('slug'=>'nav-alerts'),'supports' => array('title','editor','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),'menu_icon' => get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/alert-icon.png','labels' => array (
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

?>