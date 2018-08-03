<?php

function icon_class() {
	
	$post_type = get_post_type();
	
	if ('cnet_marinas' == $post_type) {
	
		if (get_post_meta($post->ID,'marina_sponsor_graphic',true) != '') {
		
			$class = 'fa fa-star-half-o';
			
		} else {
		
			$class = 'glyphicon glyphicon-boat';
			
		}
		
	} elseif ('cnet_anchorages' == $post_type) {
	
		$class = 'glyphicon glyphicon-anchor';
		
	} elseif ('cnet_bridges' == $post_type) {
	
		$class = 'glyphicon glyphicon-clock';
		
	} elseif ('nav_alerts' == $post_type) {
	
		$class = 'glyphicon glyphicon-warning_sign';
		
	} elseif ('info_icons' == $post_type) {
	
		$class = 'glyphicon glyphicon-circle_info';
		
	} elseif ('post' == $post_type) {
	
		$class = 'glyphicon glyphicon-notes';
		
	} else {
	
		$class = 'glyphicon glyphicon-star';
		
	}
	
	echo $class;
	
}