			<?php $bg = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : ''); ?>
			<li <?php post_class($bg); ?>>
				<article class="article-no-thumb clearfix">
					<div class="entry-content">
		                <header class="entry-header">
		                    <h2 class="entry-title">
		                       <?php the_title(); ?>
		                    </h2>
		                    <div class="entry-meta-box">
		                        <div class="entry-meta-box-inner"></div>
		                        <span class="entry-meta-circle"></span>
		                        <span class="entry-meta-icon" data-icon="&#xe034;"></span>
		                    </div>
		                </header>
					</div>
				</article>
			</li>