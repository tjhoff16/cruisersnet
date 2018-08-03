<div class="article-list-wrapper clearfix">
		
	<div class="article-list-line"></div>

	<ul class="article-list clearfix">
			
		<?php 
		if (is_home() || is_front_page()) : 
			
			get_template_part('part','welcome'); 
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$home_args = array(
				'post_type' => 'post',
				'cat' => 385,
				'posts_per_page' => 10,
				'paged' => $paged
			);
			query_posts($home_args);
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				get_template_part('part','loop-inner');
			endwhile; else:
				_e('Sorry, no posts matched your criteria.');
			endif;
			
		endif; 
		?>
			
		<?php get_template_part('part','loop-inner'); ?>
			
	</ul><!--article-list-->

	<div class="pagination clearfix">
		<ul class="page-numbers">
			<li><span class="page-numbers current">1</span></li>

			<li><a class="page-numbers" href="http://v2.cruisersnet.net/page/2/">2</a></li>

			<li><span class="page-numbers dots">…</span></li>

			<li><a class="page-numbers" href="http://v2.cruisersnet.net/page/404/">404</a></li>

			<li><a class="page-numbers" href="http://v2.cruisersnet.net/page/405/">405</a></li>

			<li style="margin-right: 0px;"><a class="next page-numbers" href="http://v2.cruisersnet.net/page/2/">Next</a></li>
		</ul>
	</div>
	
</div>
