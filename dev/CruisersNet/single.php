<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-md-9 left-wrap">
				
				<div id="main-content">
				
				<div id="main-col">
				
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <section class="single-wrapper">
                    <div class="single-line"></div>
                    <div class="single-bullet"></div>
                    <div <?php post_class('clearfix'); ?>>  
         
							<header class="entry-header">
                            	<h2 class="entry-title"><?php the_title(); ?></h2>
								<div class="entry-meta-box">
									<div class="entry-meta-box-inner">
										<span class="entry-date"><span class="icon-clock-4 entry-icon"></span><?php echo get_the_date('F j, Y'); ?></span>
										<span class="entry-author"><span class="icon-user entry-icon"></span>by:&nbsp;<?php the_author(); ?></span>
                    
										<span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><span><a href="<?php the_permalink(); ?>#comments"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a></span></span>                               
									</div>
								</div>
							</header>
		
							<!-- entry content begin -->
							<div class="entry-content marina-content">
								
								<?php 
								if (get_field('chartlet') == 'enable') : get_template_part('part','chartlet-post'); endif;
								the_content(); 
								?>
								<div class="clearfix"></div>
								
								<?php if( have_rows('call_to_actions') ): while ( have_rows('call_to_actions') ) : the_row(); ?>
								<!-- Start new CTA button loop -->
								<a href="<?php the_sub_field('cta_link'); ?>">
									<div class="cnet-button cnet-button-full blue">
										<?php the_sub_field('cta_label'); ?>
									</div>
								</a>
								<!-- End new CTA button loop -->
								<?php endwhile; endif; ?>
								
								<div class="clearfix"></div>
									
							</div>
							<!-- entry content end -->
						</div>

						<?php get_template_part('part','social'); ?>
						
						
						
                </section>
                
                <?php comments_template(); ?>
                
                <?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
                            
				</div>
				</div>
				
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