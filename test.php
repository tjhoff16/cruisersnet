<?php
/*
Template Name: Test Page
*/

$query = new WP_Query(array('post_type'=>'cnet_marinas','posts_per_page'=>50,'cnet_regions_marinas'=>'010-north-carolina'));
echo $query->request;