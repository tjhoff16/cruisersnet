<?php
include_once('../../../../../wp-blog-header.php');

echo '<h1>Anchorage Export</h1>';


$anchorages = get_posts('posts_per_page=-1&cat=110,145,166,291,58,242');

echo 'total anchorages found: '.count($anchorages).'<br /><hr /><br />';

global $wpdb;
echo "<pre>";
print_r( $wpdb->queries );
echo "</pre>";