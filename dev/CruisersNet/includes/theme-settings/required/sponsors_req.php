<?php
/* Hosted Sponsors (Previously Premium - These aren't really "premium" sponsors. They just don't have a website so we give them a simple landing page. */
register_post_type('sponsors', array(	'label' => 'Hosted Sponsors','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'page','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','ngg_tag',),'labels' => array (
  'name' => 'Hosted Sponsors',
  'singular_name' => 'Hosted Sponsor',
  'menu_name' => 'Hosted Sponsors',
  'add_new' => 'Add Hosted Sponsor',
  'add_new_item' => 'Add New Hosted Sponsor',
  'edit' => 'Edit',
  'edit_item' => 'Edit Hosted Sponsor',
  'new_item' => 'New Hosted Sponsor',
  'view' => 'View Hosted Sponsor',
  'view_item' => 'View Hosted Sponsor',
  'search_items' => 'Search Hosted Sponsors',
  'not_found' => 'No Hosted Sponsors Found',
  'not_found_in_trash' => 'No Hosted Sponsors Found in Trash',
  'parent' => 'Parent Hosted Sponsor',
),
'capabilities' => array(
    'edit_post'          => 'update_core',
    'read_post'          => 'update_core',
    'delete_post'        => 'update_core',
    'edit_posts'         => 'update_core',
    'edit_others_posts'  => 'update_core',
    'publish_posts'      => 'update_core',
    'read_private_posts' => 'update_core'
)
) );