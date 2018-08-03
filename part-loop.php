			<?php 
			$bg_post = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : 'post-bg-normal'); 
			$bg_alert = ( in_category('icw-problem-areas')  ? ' post-bg-blue'   : ''        );
			$bg_alert = ( get_post_type() == 'nav_alerts'   ? ' post-bg-yellow' : $bg_alert );
			$bg = $bg_post.$bg_alert;
			$assigned_sponsor = get_field('sponsor_assign_to_post');
			?>
			<li <?php post_class($bg); ?>>
				
				<article class="article-no-thumb clearfix">
					
					<div class="entry-content">
						
						<header class="entry-header">
						
							<a href="<?php the_permalink(); ?>">
								<?php if ($assigned_sponsor) { ?>
								<div class="sponsored-listing">
	            					<span class="marina-meta-icon" data-icon="&#xe0ce;"></span>
	            				</div>
	            				<?php } ?>
								<h2 class="entry-title"><?php the_title(); ?></h2>
							</a>

							<div class="entry-meta-box" >
								<div class="entry-meta-box-inner" <?php if ( strpos(get_the_content(), '#disclaimer') !== false ) echo 'style="display: none;"'; ?> >
									<span class="entry-date"><span class="icon-clock-4 entry-icon"></span><?php echo get_the_date(); ?></span>
									<span class="entry-author"><span class="icon-user entry-icon"></span>by: <?php the_author(); ?></span>
									<span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><span><a href="<?php the_permalink(); ?>#respond"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span></span>                           
								</div>
								
								<span class="entry-meta-circle"></span>
								<span class="entry-meta-icon"><i class="<?php icon_class(); ?>"></i></span>
									
							</div>
								
						</header>
						
						<?php 
						if (get_post_meta($post->ID,'display_in_post',true) == 'enable')
							//get_template_part('part','chartlet-post');
							get_template_part('part','post-features');
							
						the_content(); 
						
						get_template_part('part','post_marrina_info'); 
						?>
					</div><!--entry-content-->
						
				</article>
				
			</li>