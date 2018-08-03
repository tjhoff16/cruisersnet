<?php

// register statute mile post type
register_post_type('cnet_miles', array(	'label' => 'Statute Miles','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category'),'menu_icon' => 'dashicons-location','labels' => array (
  'name' => 'Statute Miles',
  'singular_name' => 'Statute Mile',
  'menu_name' => 'Statute Miles',
  'add_new' => 'Add Statute Mile',
  'add_new_item' => 'Add New Statute Mile',
  'edit' => 'Edit',
  'edit_item' => 'Edit Statute Mile',
  'new_item' => 'New Statute Mile',
  'view' => 'View Statute Mile',
  'view_item' => 'View Statute Mile',
  'search_items' => 'Search Statute Miles',
  'not_found' => 'No Statute Miles Found',
  'not_found_in_trash' => 'No Statute Miles Found in Trash',
  'parent' => 'Parent Statute Mile',
),) );


// waterway taxonomy
register_taxonomy('cnet_waterways', array('cnet_miles'), array('label'=>'Waterways', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true,'query_var'=>true,'rewrite'=>array('slug'=>'waterways'), 'show_tagcloud'=>false, 'hierarchical'=>false, 'labels'=>array(
	'name' => 'Waterways',
	'singular_name' => 'Waterways',
	'search_items' => 'Search Waterways',
	'popular_items' => 'Popular Waterways',
	'all_items' => 'All Waterways',
	'parent_item' => 'Parent Waterway',
	'parent_item_colon' => 'Parent Waterway:',
	'edit_item' => 'Edit Waterway',
	'update_item' => 'Edit Waterway',
	'add_new_item' => 'Add New Waterway',
	'new_item_name' => 'New Waterway Name',
	'separate_items_with_commas' => 'Separate Waterways with commas',
	'add_or_remove_items' => 'Add or remove Waterways',
	'choose_from_most_used' => 'Choose from the most used Waterways',
	'menu_name' => 'Waterways',
)));

add_action('admin_menu','remove_waterway_box');
function remove_waterway_box() {
	remove_meta_box('cnet_waterwaysdiv','cnet_miles','side');
}


// save title as custom field
add_action( 'save_post', 'update_statute_mile_data' );
function update_statute_mile_data($post_id) {

	// verify post is not a revision & is a statute mile post
	if ( !wp_is_post_revision($post_id) && get_post_type() == 'cnet_miles' ) {
		
		// get the title, which should be the statute mile (num only)
		$post_title = get_the_title($post_id);
		
		// update the custom field with the title
		update_post_meta($post_id,'statute_mile',$post_title);
		
	}
}

// change title placeholder text
add_filter( 'enter_title_here', 'change_miles_title' );
function change_miles_title( $title ){
     $screen = get_current_screen();
     if  ( 'cnet_miles' == $screen->post_type ) {
          $title = 'Enter Statute Mile Here (Numerical Value Only)';
     }
     return $title;
}

// custom message at the top of cnet_miles post screen
add_action( 'admin_notices', 'my_random_thing' );
function my_random_thing() {
	global $pagenow;
    $ptype = isset($_GET['post_type']) ? $_GET['post_type'] : '';
	if( $pagenow == 'edit.php' && $ptype == 'cnet_miles' ) {
		echo '<div class="miles_alert">';
		echo 'This is an experimental post type. The current aim is to facilitate the user statute mile/Chart View search, however it can possibly be used for more expansive integration in the future. The goal is to have another set of reference data stored in WordPress that we can use to pull, query, or associate statute mile information with other reference data.';
		echo '</div>';
	}
}

// Register the column
function mile_column_register( $columns ) {
    
    unset($columns['author']);
    unset($columns['date']);
    unset($columns['expirationdate']);
    unset($columns['comments']);
    $columns['title'] = __( 'Title', 'my-plugin');
    $columns['mile'] = __( 'Statute Mile', 'my-plugin' );

    return $columns;
}
add_filter( 'manage_edit-cnet_miles_columns', 'mile_column_register' );

// Display the column content
function mile_column_display( $column_name, $post_id ) {
    if ( 'mile' != $column_name )
        return;

    $mile = get_post_meta($post_id, 'statute_mile', true);
    if ( !$mile )
        $mile = '<em>' . __( 'undefined', 'my-plugin' ) . '</em>';

    echo $mile;
}
add_action( 'manage_posts_custom_column', 'mile_column_display', 10, 2 );

// Register the column as sortable
function mile_column_register_sortable( $columns ) {
    $columns['mile'] = 'mile';

    return $columns;
}
add_filter( 'manage_edit-cnet_miles_sortable_columns', 'mile_column_register_sortable' );

function mile_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'mile' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'statute_mile',
            'orderby' => 'meta_value_num'
        ) );
    }
 
    return $vars;
}
add_filter( 'request', 'mile_column_orderby' );

?>
