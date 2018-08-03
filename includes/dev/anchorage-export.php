<?php
include_once('../../../../../wp-blog-header.php');

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('CNET_ID', 'ANCHORAGE_NAME', 'CONTENT'));

//echo '<h1>Anchorage Export</h1>';


$anchorages = get_posts('posts_per_page=-1&cat=110,145,166,291,58,242');

//echo 'total anchorages found: '.count($anchorages).'<br /><hr /><br />';

foreach ($anchorages as $anchorage) {

	fputcsv($output, array($anchorage->ID, $anchorage->post_title, $anchorage->post_content));

}