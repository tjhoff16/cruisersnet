<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../../../../../../wp-blog-header.php');
//require_once(ABSPATH . '/wp-content/themes/CruisersNet/includes/lib/simple_html_dom.php');

$query_all = "SELECT * FROM wp_adrotate";

$adrotate_sponsors = $wpdb->get_results($query_all);
foreach ($adrotate_sponsors as $sponsor) {
	
	// search for groups so we can assign ctax term
	//$group_query = "SELECT * FROM wp_adrotate_groups WHERE wp_adrotate_groups.id = " . $sponsor->group . ";";
	//$assigned_group = $wpdb->get_results($group_query);
	
	
	// setup existing search
	$args = array(
		'post_type' => 'cnet_sponsors',
		'posts_per_page' => 1,
		'meta_query' => array(
			array(
				'key' => 'sponsor_id',
				'value' => $sponsor->id,
				'compare' => '='
			)
		)
	);
	
	$existing = get_posts($args);
	$existingID = $existing[0]->ID;
	// check if $sponsor is active or not
	// Was: if ($sponsor->active == 'no' && $existing) {
	if ( $sponsor->type != 'active' && existing ) { 
		if ( $existingID!='' ) wp_delete_post($existingID, true);
	} else {
		// setup wp_insert_post
		$new_args = array(
			'post_type' => 'cnet_sponsors',
			'post_title' => $sponsor->title,
			'post_status' => 'publish',
			'ping_status' => 'closed'
		);
		
		// if there is an existing post, assign id so wp_insert_post will update instead of add
		if ( $existingID!='' )
			$new_args['ID'] = $existing[0]->ID;
		
		if ($sponsor->type == 'active') {
			
			// insert/update post
			$sponsor_post = wp_insert_post($new_args);
		
			// update post meta
			update_post_meta($sponsor_post, 'sponsor_id', $sponsor->id);
			update_post_meta($sponsor_post, 'sponsor_banner_html', $sponsor->bannercode);
			update_post_meta($sponsor_post, 'sponsor_thetime', $sponsor->thetime);
			update_post_meta($sponsor_post, 'sponsor_updated', $sponsor->updated);
			update_post_meta($sponsor_post, 'sponsor_startshow', $sponsor->startshow);
			update_post_meta($sponsor_post, 'sponsor_endshow', $sponsor->endshow);
			update_post_meta($sponsor_post, 'sponsor_link', $sponsor->link);
			update_post_meta($sponsor_post, 'sponsor_shown', $sponsor->shown);
			update_post_meta($sponsor_post, 'sponsor_clicks', $sponsor->clicks);
			update_post_meta($sponsor_post, 'sponsor_group', $sponsor->group);
			
			// extract banner url and alt text
			$sponsor_banner_html = str_get_html(html_entity_decode($sponsor->bannercode));
			$sponsor_banner_find_src = $sponsor_banner_html->find('img');
			$sponsor_banner_src = $sponsor_banner_find_src[0]->attr['src'];
			$sponsor_banner_alt = $sponsor_banner_find_src[0]->attr['alt'];
			update_post_meta($sponsor_post, 'sponsor_src', $sponsor_banner_src);
			update_post_meta($sponsor_post, 'sponsor_alt', $sponsor_banner_alt);
			
			echo '<pre>';
			print_r($sponsor_banner_find_src[0]->attr);
			echo '</pre><br /><br />';
			
		}
		
		
	}
	
	//echo '<pre>';
	//print_r($sponsor);
	//echo '</pre><br /><br />';
	
}

//echo '<pre>';
//print_r($adrotate_sponsors);
//echo '</pre>';
