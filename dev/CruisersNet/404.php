<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-md-9 left-wrap">
				
				<div class="404">
					<section class="error-404 clearfix">
                <div class="left-col">
                    <p>404</p>
                </div><!--left-col-->
                <div class="right-col">
                    <h1>Page not found...</h1>
                    <p>We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:</p>
                    <ul class="arrow-list">
                        <li>&#10095; <a href="javascript: history.go(-1);">Go back to previous page</a></li>
                        <li>&#10095; <a href="http://v2.cruisersnet.net">Go to homepage</a></li>
                    </ul>
                </div><!--right-col-->
            </section>
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