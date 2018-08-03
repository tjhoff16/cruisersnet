<?php

// add ACF custom option pages, documentation here: http://www.advancedcustomfields.com/add-ons/options-page/
add_filter('acf/options_page/settings','nsm_options');
function nsm_options($options) {
	$options['title'] = __('Theme Options');
	$options['pages'] = array(
		__('Global Options'),
		__('Homepage Options')
	);
	return $options;
}