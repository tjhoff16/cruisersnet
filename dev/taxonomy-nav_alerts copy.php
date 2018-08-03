<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<div class="nextprevpage"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?></div>
		test
		<?php
		$sort = $_GET['sort']; 
		if ($sort == 'date') {
			// sort by date in cronological order
			query_posts($query_string.'&orderby=date&order=DESC');
		}
		if ($sort = 'geo') {
			// sort by menu order/geo order
			query_posts($query_string.'$orderby=menu_order&order=ASC');
		}
		?>
		<?php  ?>
		<?php if (have_posts()) : ?>

		<?php $i=0; while (have_posts()) : the_post(); $i++; ?>

			<div class="post" id="post-<?php the_ID(); ?>">
                <div class="post-top">
                    <div class="post-title">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if ( function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a></h2>
						<h3>
							Posted by <span><?php the_author() ?></span> |  Posted on <?php the_time('m-d-Y') ?>
						</h3>

                    </div>
					
                </div>

				<div class="entry" <?php if (in_category('br-yellow-background-nav-alert')) { ?> style="background: #FFFF00;" <?php } elseif (in_category('br-blue-background-aicw-problem-stretch-postings')) { ?> style="background: #CCFFFF;" <?php } else {}?>>
					
					<?php the_content('',FALSE,''); ?>
				</div>

                <div class="postmetadata">
<p><?php comments_popup_link( 'Click Here to Comment on This Nav Alert', 'Click Here to Comment on This Nav Alert <br />Click Here To Read Comments From Fellow Cruisers About This Nav Alert (1 Comment &#187;)', 'Click Here to Comment on This Nav Alert <br />Click Here To Read Comments From Fellow Cruisers About This Nav Alert (% Comments &#187;)', 'comments-link', '&nbsp;'); ?></p>                </div>
			</div>

		<?php endwhile; ?>

		<div class="nextprevpage"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?></div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_footer(); ?>