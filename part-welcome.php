			<li>
				<article class="article-no-thumb clearfix welcome-box">
					<div class="entry-content">
						<header class="entry-header">
							<h2 class="entry-title"><?php the_field('welcome_box_title','option'); ?></h2>

							<!--<div class="entry-meta-box">
								<div class="entry-meta-box-inner">
									<span class="entry-date"><span class="icon-clock-4 entry-icon"></span><?php echo date('M. j, Y'); ?></span>
									<span class="entry-author"><span class="icon-user entry-icon"></span>by:&nbsp;<a href="http://v2.cruisersnet.net/author/claiborne/">Claiborne</a></span>
									<span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><span>Comments Off</span></span>                              
								</div>
								<span class="entry-meta-circle"></span>
								<span class="entry-meta-icon"><i class="fa fa-star-half-o"></i></span>
							</div>-->
							
						</header>
						
						<?php the_field('welcome_box_body','option'); ?>
						
						<div class="clear clear-20"></div>
						
						<?php if( have_rows('welcome_box_buttons','option') ): ?>
						<?php while ( have_rows('welcome_box_buttons','option') ) : the_row(); ?>
						
						<a href="<?php the_sub_field('button_url','option'); ?>" target="_<?php the_sub_field('button_target','option'); ?>">
							<div class="cnet-button cnet-button-full blue">
								<?php the_sub_field('button_text','option'); ?>
							</div>
						</a>
						
						<?php endwhile; ?>
						<?php endif; ?>	
						
						
					</div><!--entry-content-->
				</article>
			</li>