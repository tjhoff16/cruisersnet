<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">
				
				<h1>Archive For: <?php single_cat_title(); ?></h1>
				
				<?php if ($_SERVER['REMOTE_ADDR'] == '45.36.106.156') : ?>
				<?php echo $GLOBALS['wp_query']->request; ?>
				<?php endif; ?>
				
				<?php twentyfourteen_paging_nav(); ?>
				
				<div class="article-list-wrapper clearfix">
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">
						
						<?php
						global $query_string;
						$catid = get_query_var('cat');
						$catq = get_category($catid);
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						$args = array(
							'post_type' => array('post','nav_alerts'),
							'posts_per_page' => 20,
							'paged' => $paged,
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => array($catq->slug)
								),
								array(
									'taxonomy' => 'cnet_regions_alerts',
									'field' => 'slug',
									'terms' => array('nav-'.$catq->slug)
								)
							)
						);
						
						query_posts($args);
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							get_template_part('part','loop');
						endwhile; else:
							_e('Sorry, no posts matched your criteria.');
						endif;
						?>
					</ul><!--article-list-->
					
					<?php twentyfourteen_paging_nav(); ?>
						
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