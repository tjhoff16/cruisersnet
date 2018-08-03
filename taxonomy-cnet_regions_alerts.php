<?php
session_start();
$file_version = isset($_SESSION['version']) ? '-' . $_SESSION['version'] : '';
get_header();

?>

	<!-- Begin Content -->
	<div class="container main-wrap">

		<div class="row">
			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">
<?php
if (isset($file_version)) get_template_part('part', 'home_top' . $file_version);
if (isset($_GET['showquery'])):
    echo '<div style="width:765px; padding:20px; border: 2px solid #C2EAFA; background: #E2F7FC; word-wrap: break-word;"><strong>SQL Query:</strong><br />' . $GLOBALS['wp_query']->request . '</div>';
endif;
?>

				<div class="article-list-wrapper clearfix">
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">

						<?php
$sort = $_GET['sort'];
if ($sort == 'date') {
    // sort by date in cronological order
    query_posts($query_string . '&orderby=date&order=DESC');
}

if (isset($_SESSION['version'])):
    while (have_posts()):
        the_post();
        get_template_part('part', 'loop-' . $_SESSION['version']);
    endwhile;
elseif (have_posts()):
    while (have_posts()):
        the_post();
        get_template_part('part', 'loop');
    endwhile;
else:
    _e('Sorry, no posts matched your criteria.');
endif;
?>

					</ul><!--article-list-->

					<?php
wp_reset_query();
?>
					<?php
twentyfourteen_paging_nav();
?>

				</div> <!-- /. article-list-wrapper -->

			</div><!-- /.left-wrap -->
			<!-- End Left Content Column -->

			<!-- Begin Right Sidebar Column -->
			<div class="col-xs-3 right-wrap">
				<?php
get_sidebar();
?>
			</div><!-- /.right-wrap -->
			<!-- End Right Sidebar Column -->

		</div><!-- /.row -->

	</div><!-- /.main-wrap -->
	<!-- End Content -->

<?php
get_footer();
?>
