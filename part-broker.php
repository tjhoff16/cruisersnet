			<?php 
			$bg_post = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : 'post-bg-normal'); 
			$bg_alert = (get_post_type() == 'nav_alerts' ? ' post-bg-yellow' : '' );
			$bg = $bg_post.$bg_alert;
			?>
			<li <?php post_class($bg); ?>>
				
				<article class="article-no-thumb clearfix">
					
					<div class="entry-content">
						
						<header class="entry-header">
							
							<a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>

							<div class="entry-meta-box">
								
								<div class="entry-meta-box-inner">
									
									<span class="entry-date"><span class="icon-clock-4 entry-icon"></span><?php echo get_the_date(); ?></span>
									<span class="entry-author"><span class="icon-user entry-icon"></span>by: <?php the_author(); ?></span>
									<!-- <span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><span><a href="<?php the_permalink(); ?>#respond"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></span></span> -->                              
								
								</div>
								
								<span class="entry-meta-circle"></span>
								<span class="entry-meta-icon"><i class="<?php icon_class(); ?>"></i></span>
									
							</div>
								
						</header>
						
						<div class="broker">
							<div class="post-title"><?php the_title(); ?></div>
							<?php the_content(); ?>
							<!--<a href="<?php the_permalink(); ?>"><div class="broker-more">Learn More...</div></a>-->
							<div class="clearfix"></div>
							<?php edit_post_link('<div style="float: right; padding: 10px; font-weight: bold; color: #FFFFFF; background: #002366; width: 140px; text-align: center;">Edit This Broker</div>'); ?>
						</div> <!-- end .broker -->
						<div class="clearfix"></div>
							
					</div><!--entry-content-->
						
				</article>
				
			</li>