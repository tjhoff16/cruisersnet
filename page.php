<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">

		<div class="row">

			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">

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
									<div class="entry-meta-box-inner" <?php if ( get_post_type( get_the_ID() ) == 'page' ) echo 'style="display: none;"'; ?> >
										<span class="entry-date"><span class="icon-clock-4 entry-icon"></span>&nbsp;<?php the_date(); ?></span>
										<span class="entry-author"><span class="icon-user entry-icon"></span>by:&nbsp;<?php the_author(); ?></span>

										<span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><span><a href="<?php the_permalink(); ?>#comments"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a></span></span>
									</div>
								</div>
							</header>

							<!-- entry content begin -->
							<div class="entry-content marina-content">
								<?php the_content(); ?>
							</div>
							<!-- entry content end -->
						</div>

						<?php get_template_part('part','social'); ?>

                </section>

                <?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				</div>
				</div>

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
<script>
var docTitle = document.getElementsByClassName('entry-title')[0].textContent;
if (docTitle == 'Fuel Update') {
	document.getElementsByClassName('socials-link-container')[0].style.display = 'none';
	document.getElementsByClassName('right-wrap')[0].style.display = 'none';
	document.getElementsByClassName('header-low')[0].style.display = 'none';
	document.getElementsByClassName('entry-meta-box-inner')[0].style.display = 'none';
}
</script>
<?php get_footer(); ?>
