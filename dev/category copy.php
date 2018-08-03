<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">
				
				<div class="article-list-wrapper clearfix">
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">
					
						<?php
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
			<div class="col-xs-3 right-wrap">
				<?php get_sidebar(); ?>
			</div><!-- /.right-wrap -->
			<!-- End Right Sidebar Column -->
			
		</div><!-- /.row -->
		
	</div><!-- /.main-wrap -->
	<!-- End Content -->

<?php get_footer(); ?>