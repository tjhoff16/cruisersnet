<?php get_header(); ?>
<?php 
$term = get_query_var('cnet_regions_marinas'); 
$term_obj = get_term_by('slug',$term,'cnet_regions_marinas');
$mtax_label = get_option('taxonomy_'.$term_obj->parent);

if ($term_obj->parent != 0) {
	$mtax_label = get_option('taxonomy_'.$term_obj->parent);
	$mtax_label = $mtax_label['cnet_tax_state'].' ';
	$label = 'Sub-Region Listings For: ';
} else {
	$label = 'Region Listings For: ';
}
?>
	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">
			
				<?php if (isset($_GET['showquery'])) : ?>
				<?php echo '<div style="width:765px; padding:20px; border: 2px solid #C2EAFA; background: #E2F7FC; word-wrap: break-word;"><strong>SQL Query:</strong><br />' . $GLOBALS['wp_query']->request . '</div>'; ?>
				<?php endif; ?>
			
				<?php if ( isset($_GET['fuel']) ) : get_template_part('part','fuel-sort'); endif; ?>
					
				<h1>
					<?php if (isset($_GET['fuel'])) { ?>
					<?php echo $mtax_label; ?> Fuel Price
					<?php } elseif (isset($_GET['lpg-cng'])) { ?>
					<?php echo $mtax_label; ?> LPG/CNG
					<?php } else { ?>
					<?php echo $mtax_label; ?> Marina			
					<?php } ?>
					<?php echo $label; ?>
					<?php echo $term_obj->name; ?>
				</h1>
				
				<div class="clearfix"></div>
				
				<?php 
				if (!isset($_GET['sort'])) :
					//twentyfourteen_paging_nav(); 
				endif;
				?>
				
				<div class="clearfix"></div>
				
				<div class="article-list-wrapper clearfix">
					<div class="article-list-line"></div>
					<ul class="article-list clearfix">
					
						<?php
						global $query_string;
						$paged = (get_query_var('page')) ? get_query_var('page') : 1;
						
							$term = get_query_var('cnet_regions_marinas');
							$args = array(
								'posts_per_page' => -1,
								'post_type' => 'cnet_marinas',
								'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'cnet_regions_marinas',
										'field' => 'slug',
										'terms' => $term
									)
								),
								'paged' => $paged
							);
							//query_posts($query_string.'&posts_per_page=10&post_type=cnet_marinas&paged='.$paged);
						
						if (isset($_GET['fuel']) && $_GET['sort'] == 'diesel' ) :
							$args = $query_string.'&meta_key=diesel_price&orderby=meta_value_num&order=ASC&posts_per_page=-1';
						endif;
						
						if (isset($_GET['fuel']) && $_GET['sort'] == 'gas' ) :
							$args = $query_string.'&meta_key=gas_price&orderby=meta_value_num&order=ASC&posts_per_page=-1';
						endif;
						
						if ($_GET['sort'] == 'vtechd') :
							$args = array('posts_per_page'=>-1,'meta_key' => 'diesel_price', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_query' => array('relation' => 'AND', array('key' => 'valvtech_only','value' => 'yes', 'compare' => '=')));
							$args = array_merge($args,array_filter($wp_query->query_vars));
							
						endif;
						
						if ($_GET['sort'] == 'vtechg') :
							$args = array('posts_per_page'=>-1,'meta_key' => 'gas_price', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_query' => array('relation' => 'AND', array('key' => 'valvtech_only','value' => 'yes', 'compare' => '=')));
							$args = array_merge($args,array_filter($wp_query->query_vars));
							
						endif;	
						
						if ($_GET['sort'] == 'boatusd') :
							$args = array('posts_per_page'=>-1,'meta_key' => 'diesel_price', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_query' => array('relation' => 'AND', array('key' => 'boatus_discount_only','value' => 'yes', 'compare' => '=')));
							$args = array_merge($args,array_filter($wp_query->query_vars));
							
						endif;
						
						if ($_GET['sort'] == 'boatusg') :
							$args = array('posts_per_page'=>-1,'meta_key' => 'gas_price', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_query' => array('relation' => 'AND', array('key' => 'boatus_discount_only','value' => 'yes', 'compare' => '=')));
							$args = array_merge($args,array_filter($wp_query->query_vars));
							
						endif;	
						
						$marina_query = new WP_Query($args);
						while ($marina_query->have_posts()) : $marina_query->the_post();
							
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
							
						endwhile;
						?>
					</ul><!--article-list-->

					<?php wp_reset_query(); ?>

					<?php 
					if (!isset($_GET['sort'])) :
						//twentyfourteen_paging_nav(); 
					endif;
					?>
					
											
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