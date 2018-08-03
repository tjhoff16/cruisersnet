<?php
/* 
	Template Name: Query Test
*/

$test = $wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS wp_posts.*, wp_sticky.sticky_status FROM wp_posts INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_sticky ON wp_sticky.sticky_post_id = wp_posts.ID WHERE 1=1 AND ( wp_term_relationships.term_taxonomy_id IN (62) ) AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish') GROUP BY wp_posts.ID ORDER BY (wp_sticky.sticky_status = 2 AND wp_sticky.sticky_status IS NOT NULL) DESC, DATE_FORMAT(wp_posts.post_date,'%Y-%m-%d') DESC, (wp_sticky.sticky_status = 1 AND wp_sticky.sticky_status IS NULL) DESC, DATE_FORMAT(wp_posts.post_date,'%T') DESC");

echo '<pre>';
print_r($test);
echo '</pre>';