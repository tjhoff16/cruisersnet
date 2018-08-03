<?php
	/*
	Template Name: Home Page
	*/
	session_start();
    $version='';
    if ( isset($_GET['version']) ) {
        $_SESSION['version'] = $_GET['version'];
        $version = $_SESSION['version'];
    } else {
        $_SESSION['version'] = null;
    }
	$paged = get_query_var('page') ? get_query_var('page') : 1;
?>
	<!DOCTYPE html>
<i id="spinner" class="fa fa-circle-o-notch fa-5x fa-spin" aria-label="This section is currently loading"></i>
<div class="container main-wrap">
<?php
    get_header($version);
    // <div id="premium-sponsor">
	// echo adrotate_group('29');
    // </div>
    get_template_part('part-home_top', $version );
	get_template_part('part-filter-buttons', $version);
    $qargs = [
    'paged' => $paged,
    'post_type' => ['post','nav_alerts'],
    'tax_query' => [
    'relation' => 'OR',
    ['taxonomy' => 'category',            'field' => 'id', 'terms' => 385],
    ['taxonomy' => 'cnet_regions_alerts', 'field' => 'id', 'terms' => 734]
    ],
    'showposts' => 10
    ];
    $wp_query = new WP_Query($qargs);
?>
    <div class="row" id="row">
    <!-- Begin Left Content Column -->
    <div class="col-xs-9 left-wrap">
        <div class="article-list-wrapper clearfix" id="article-list-wrapper" style="top-margin:15;">
            <div class="article-list-line"></div>
            <ul class="article-list clearfix">
    <?php
        //  FOR DEBUGGING
        $debugOutput=false;
        if ( $debugOutput ) {
            echo '<div style="width:765px; padding:20px; border: 2px solid #C2EAFA; background: #E2F7FC; word-wrap: break-word;">';
            var_dump($_SESSION);
            echo '</div>';

            echo '<div style="width:765px; padding:20px; border: 2px solid #C2EAFA; background: #E2F7FC; word-wrap: break-word;">';
            var_dump($_POST);
            echo '</div>';

            echo '<div style="width:765px; padding:20px; border: 2px solid #C2EAFA; background: #E2F7FC; word-wrap: break-word;">';
            echo $wp_query->request;
            echo '</div>';
        }
        if ( ! $wp_query->have_posts() ) _e('Sorry, no posts matched your criteria.');
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
            get_template_part('part-loop', $version);
        }
        wp_reset_postdata(); //VERY VERY IMPORTANT, restes the $post global back to the main query
        ?>
            </ul> <!--article-list-->
            <?php twentyfourteen_paging_nav(); ?>
        </div> <!-- /. article-list-wrapper -->
    </div>  <!-- /.left-wrap -->
<!-- End Left Content Column -->

<!-- Begin Right Sidebar Column -->
    <div class="col-xs-3 right-wrap">
        <?php get_sidebar(); ?>
    </div> <!-- /.right-wrap -->
<!-- End Right Sidebar Column -->

    </div> <!-- /.row -->

<?php get_footer(); ?>
</div> <!-- /.main-wrap -->
<!-- End Content -->
