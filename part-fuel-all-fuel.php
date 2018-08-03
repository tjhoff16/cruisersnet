<?php
global $post;
$label_terms = wp_get_post_terms($post->ID,'cnet_marina_settings',array('fields'=>'names'));
if (strpos($label_terms[0],'Label') !== false) {
	
	// is label post
	get_template_part('part', 'fuel-label');

} else { 
	
	// is normal marina listing listing 
	get_template_part('part', 'fuel-data');
	
}