<?php

// anchorages post type
register_post_type('cnet_anchorages', array(	'label' => 'Anchorages','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','ngg_tag',),'menu_icon' => get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/anchor_icon.png','labels' => array (
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

?>