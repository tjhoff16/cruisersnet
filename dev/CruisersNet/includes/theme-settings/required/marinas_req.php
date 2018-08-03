<?php

/* =========================================================
MARINA POST TYPE
============================================================ */
register_post_type('cnet_marinas', array(	'label' => 'Marinas','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => 'marina'),'query_var' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category'),'menu_icon' => 'dashicons-location-alt','labels' => array (
  'name' => 'Marinas',
  'singular_name' => 'Marina',
  'menu_name' => 'Marinas',
  'add_new' => 'Add Marinas',
  'add_new_item' => 'Add New Marina',
  'edit' => 'Edit',
  'edit_item' => 'Edit Marina',
  'new_item' => 'New Marina',
  'view' => 'View Marina',
  'view_item' => 'View Marina',
  'search_items' => 'Search Marinas',
  'not_found' => 'No Marinas Found',
  'not_found_in_trash' => 'No Marinas Found in Trash',
  'parent' => 'Parent Marina',
),) );

/* =========================================================
REGION TAXONOMY FOR MARINAS
============================================================ */
register_taxonomy('cnet_regions_marinas', array('cnet_marinas','post'), array('label'=>'Regions', 'public'=>true,'show_in_nav_menus'=>true, 'show_ui'=>true, 'show_tagcloud'=>false, 'hierarchical'=>true, 'rewrite' => array( 'slug' => 'marinas' ), 'labels'=>array(
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

/* =========================================================
REGION TAXONOMY CUSTOM FIELD FOR STATE LABEL
============================================================ */
// Add term page
function cnet_tax_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[cnet_tax_state]"><?php _e( 'Category State Label', 'cnet' ); ?></label>
		<input type="text" name="term_meta[cnet_tax_state]" id="term_meta[cnet_tax_state]" value="">
		<p class="description"><?php _e( 'Enter the state label for this category','cnet' ); ?></p>
	</div>
<?php
}
add_action( 'cnet_regions_marinas_add_form_fields', 'cnet_tax_add_new_meta_field', 10, 2 );


// Edit term page
function cnet_tax_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[cnet_tax_state]"><?php _e( 'Category State Label', 'cnet' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[cnet_tax_state]" id="term_meta[cnet_tax_state]" value="<?php echo esc_attr( $term_meta['cnet_tax_state'] ) ? esc_attr( $term_meta['cnet_tax_state'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the state label for this category','cnet' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'cnet_regions_marinas_edit_form_fields', 'cnet_tax_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_cnet_regions_marinas', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_cnet_regions_marinas', 'save_taxonomy_custom_meta', 10, 2 );

/* =========================================================
REGION TAXONOMY CUSTOM FIELD FOR STATE INITIAL LABEL
============================================================ */
// Add term page
function cnet_tax_add_new_meta_field_initial() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[cnet_tax_state_initial]"><?php _e( 'Category State Initial', 'cnet' ); ?></label>
		<input type="text" name="term_meta[cnet_tax_state_initial]" id="term_meta[cnet_tax_state_initial]" value="">
		<p class="description"><?php _e( 'Enter the state initial for this category','cnet' ); ?></p>
	</div>
<?php
}
add_action( 'cnet_regions_marinas_add_form_fields', 'cnet_tax_add_new_meta_field_initial', 10, 2 );


// Edit term page
function cnet_tax_edit_meta_field_initial($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[cnet_tax_state_initial]"><?php _e( 'Category State Initial', 'cnet' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[cnet_tax_state_initial]" id="term_meta[cnet_tax_state_initial]" value="<?php echo esc_attr( $term_meta['cnet_tax_state_initial'] ) ? esc_attr( $term_meta['cnet_tax_state_initial'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter the state initial for this category','cnet' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'cnet_regions_marinas_edit_form_fields', 'cnet_tax_edit_meta_field_initial', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta_initial( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_cnet_regions_marinas', 'save_taxonomy_custom_meta_initial', 10, 2 );  
add_action( 'create_cnet_regions_marinas', 'save_taxonomy_custom_meta_initial', 10, 2 );
