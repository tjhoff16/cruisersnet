<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-md-9 left-wrap">
				
				<div id="premium-sponsor">
					<?php echo adrotate_banner(29,0,1); ?>
				</div>
				<div class="clear"></div>
				
				<div class="article-list-wrapper clearfix">
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">
					
						<?php
						$paged = (get_query_var('page')) ? get_query_var('page') : 1;
						//echo 'Page: '.$paged.'<br /><br /><br /><br /><br /><br />';
						if ($paged == 1) :
							get_template_part('part','welcome'); 
						endif;
						
						$home_args = array(
							'post_type' => 'post',
							'cat' => 385,
							'posts_per_page' => 10,
							'paged' => $paged
						);
						query_posts($home_args);
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							get_template_part('part','loop');
						endwhile; else:
							_e('Sorry, no posts matched your criteria.');
						endif;
						?>
					</ul><!--article-list-->

					<?php twentyfourteen_paging_nav(); ?>
					<?php wp_reset_query(); ?>
						
				</div> <!-- /. article-list-wrapper -->
				
			</div><!-- /.left-wrap -->
			<!-- End Left Content Column -->
			
			<!-- Begin Right Sidebar Column -->
			<div class="col-md-3 right-wrap">
				<?php get_sidebar(); ?>
			</div><!-- /.right-wrap -->
			<!-- End Right Sidebar Column -->
			
		</div><!-- /.row -->
		
	</div><!-- /.main-wrap -->
	<!-- End Content -->

<?php get_footer(); ?>