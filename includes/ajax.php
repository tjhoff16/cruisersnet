<?php
// Remove Marina Life Data from Marina Listing
function remove_marina_life() {
	
	$marina_id = $_POST['marina_id'];
	update_post_meta($marina_id, 'mcf-transient-dock-reservation','');
	
	exit;
	
}
add_action( 'wp_ajax_remove_marina_life', 'remove_marina_life' );
add_action( 'wp_ajax_nopriv_remove_marina_life', 'remove_marina_life' );

// Marina Search Field
function add_marina_life() {
	
	$marina_id = $_POST['marina_id'];
	$marina_url = $_POST['marina_url'];
	
	update_post_meta($marina_id, 'mcf-transient-dock-reservation', $marina_url);
	
	exit;
	
}
add_action( 'wp_ajax_add_marina_life', 'add_marina_life' );
add_action( 'wp_ajax_nopriv_add_marina_life', 'add_marina_life' );