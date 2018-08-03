<?php
require('../../../wp-blog-header.php');
echo '<h1>Terms List</h1>';
$args = array(
	'hide_empty' => false,
	'fields' => 'all'
);
$terms = get_terms('cnet_regions_marinas', $args);

foreach ($terms as $term) {
	
	echo $term->name . ', ' . $term->term_id . '<br />';
	
}