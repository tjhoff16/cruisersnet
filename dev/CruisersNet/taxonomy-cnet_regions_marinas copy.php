<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-md-9 left-wrap">
				
				<?php if ( isset($_GET['fuel']) ) : get_template_part('part','fuel-sort'); endif; ?>
					
					<div class="clearfix"></div>
				
				<div classs="article-list-wrapper clearfix">
				
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">
					
						<?php
						global $query_string;
						$paged = get_query_var('paged');
						
						// check to see if this is a fuel or lpg/cng listing, if not, exclude "not_a_marina" listings
						if (isset($_GET['fuel'])) {
						
							$sort = $_GET['sort'];
							if ( $sort == 'gas' ) {
								query_posts('meta_key=gas_price&orderby=meta_value_num&order=ASC&cnet_regions_marinas='.$term.'&paged=' . $paged);
							} elseif ( $sort == 'diesel' ) {
								query_posts('meta_key=diesel_price&orderby=meta_value_num&order=ASC&cnet_regions_marinas='.$term.'&paged=' . $paged);
							} elseif ( $sort == 'vtechg' ) {
								query_posts(array('cnet_regions_marinas' => $term, 'meta_key' => 'gas_price', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_query' => array('relation' => 'AND', array('key' => 'valvtech_only','value' => 'yes', 'compare' => '='))));
							} elseif ( $sort == 'vtechd' ) {
								query_posts(array('cnet_regions_marinas' => $term, 'meta_key' => 'diesel_price', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_query' => array('relation' => 'AND', array('key' => 'valvtech_only','value' => 'yes', 'compare' => '='))));
							} elseif ( $sort == 'boatusg' ) {
								query_posts(array('cnet_regions_marinas' => $term, 'meta_key' => 'gas_price', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_query' => array('relation' => 'AND', array('key' => 'boatus_discount_only','value' => 'yes', 'compare' => '='))));
							} elseif ( $sort == 'boatusd' ) {
								query_posts(array('cnet_regions_marinas' => $term, 'meta_key' => 'diesel_price', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_query' => array('relation' => 'AND', array('key' => 'boatus_discount_only','value' => 'yes', 'compare' => '='))));
							}
						
						} elseif (isset($_GET['lpg-cng'])) {
						
							// currently no special query
							
						} else {
						
							$term = get_query_var('cnet_regions_marinas');
							$args = array(
								'posts_per_page' => 10,
								'post_type' => 'cnet_marinas',
								'tax_query' => array(
									'relation' => 'OR',
									array(
										'taxonomy' => 'cnet_regions_marinas',
										'field' => 'slug',
										'terms' => $term
									)
								)
							);
							query_posts($args);
						
						}
						
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							
							// if fuel listing
							if (isset($_GET['fuel'])) {
							
								get_template_part('part','fuel');
							
							// if lpg/cng listing
							} elseif (isset($_GET['lpg-cng'])) {
								
								get_template_part('part','lpg-cng');
							
							// anything else (plain marina listings)
							} else {
								
								get_template_part('part','marina');
								
							}

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