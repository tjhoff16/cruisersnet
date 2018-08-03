<?php

// info icon post type
register_post_type('info_icons', array(	'label' => 'Info Icons','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'has_archive'=>true,'rewrite'=>array('slug'=>'info-icons'),'supports' => array('title','editor','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),'menu_icon' => 'dashicons-info','labels' => array (
  'name' => 'Info Icons',
  'singular_name' => 'Info Icon',
  'menu_name' => 'Info Icons',
  'add_new' => 'Add Info Icons',
  'add_new_item' => 'Add New Info Icon',
  'edit' => 'Edit',
  'edit_item' => 'Edit Info Icon',
  'new_item' => 'New Info Icon',
  'view' => 'View Info Icon',
  'view_item' => 'View Info Icon',
  'search_items' => 'Search Info Icons',
  'not_found' => 'No Info Icons Found',
  'not_found_in_trash' => 'No Info Icons Found in Trash',
  'parent' => 'Parent Info Icon',
),) );

?>