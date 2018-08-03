<?php
// boat brokers post type
register_post_type('brokers', array(	'label' => 'Boat Brokers','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'has_archive'=>true,'rewrite'=>array('slug'=>'brokers'),'supports' => array('title','editor','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),'menu_icon' => 'dashicons-awards','labels' => array (
  'name' => 'Boat Brokers',
  'singular_name' => 'Boat Broker',
  'menu_name' => 'Boat Brokers',
  'add_new' => 'Add Boat Broker',
  'add_new_item' => 'Add New Boat Broker',
  'edit' => 'Edit',
  'edit_item' => 'Edit Boat Broker',
  'new_item' => 'New Boat Broker',
  'view' => 'View Boat Broker',
  'view_item' => 'View Boat Broker',
  'search_items' => 'Search Boat Brokers',
  'not_found' => 'No Boat Brokers Found',
  'not_found_in_trash' => 'No Boat Brokers Found in Trash',
  'parent' => 'Parent Boat Broker',
),) );

?>