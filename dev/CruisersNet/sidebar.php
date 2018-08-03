<!-- Begin Submit News Button -->
<a href="<?php bloginfo('url'); ?>/contribute-cruising-news/">
	<div class="cnet-button cnet-button-full blue">
		Click here to submit cruising news
	</div>
</a>
<!-- End Submit News Button -->

<!-- Begin Lat/Lon Widget Overlay -->
<?php get_template_part('part','widget'); ?>
<!-- End Lat/Lon Widget Overlay -->

<!-- Begin Sidebar Top Sponsor -->
<div class="sidebar-sponsors">
	<?php  echo adrotate_banner(30,0,1); ?>
</div>
<!-- End Sidebar Top Sponsor -->

<!-- Begin Regional Menus/Primary Sidebar -->
<div id="regional_menu">
					
	<div class="cnet-button cnet-button-full blue no-hover bottom-flush">
		Cruising News and Reference Directories
	</div>
	
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>
</div>
<!-- End Regional Menus/Primary Sidebar -->

<!-- Begin Sidebar Mid Sponsor -->
<div class="sidebar-sponsors">
	<?php echo adrotate_banner(31,0,1); ?>
</div>
<!-- End Sidebar Mid Sponsor -->

<!-- Begin Sidebar CTA Buttons -->
<a href="<?php bloginfo('url'); ?>/boat-brokers/">
	<div class="cnet-button cnet-button-full blue">
		Boat Broker Partners
	</div>
</a>

<a class="cnet-join-toggle" href="javascript::void(0)">
	<div class="cnet-button cnet-button-full blue">
		Click Here To Join The Cruisers' Net Alert List
	</div>
	<div class="cnet-join-text">
	Enter your email address below to sign up for our Salty Southeast Cruisers' Alert List and receive notices of breaking news that affects the cruising community from North Carolina to New Orleans!
	
		<form name="ccoptin" action="http://visitor.constantcontact.com/d.jsp" target="_blank" method="post">
			<input name="ea" size="20" type="text" />
			<input name="go" value="Join" class="submit" type="submit" />
			<input name="m" value="1102046028641" type="hidden" />
			<input name="p" value="oi" type="hidden" />
		</form>
	
	</div>
</a>
<!-- End Sidebar CTA Buttons -->


<!-- Begin Sidebar Lower Sponsors -->
<div class="sidebar-sponsors">
	<?php echo adrotate_banner(32,0,1); ?>
	<br /><br />
	<?php echo adrotate_banner(33,0,1); ?>
</div>
<!-- End Sidebar Lower Sponsors -->


<!-- Begin of the Week -->		
<div class="sidebar-photoweek">
<?php
$the_query = new WP_Query( array( 'posts_per_page' => 1, 'category_name' => 'photo-of-the-week' ) );
while ( $the_query->have_posts() ) : $the_query->the_post();
?>
	<div class="cnet-button cnet-button-full red no-hover bottom-flush">
		Photo of the Week
	</div>
	<div id="winner">
		<a href="<?php bloginfo('url'); ?>/category/photo-of-the-week/">
			<?php 
			if (get_field('photo_thumbnail')) {
				$src = get_field('photo_thumbnail');
			} else {
				$src = get_field('photo_image');
			}
			?>
			<img alt="<?php the_title(); ?>" src="<?php bloginfo('template_directory'); ?>/cnetthumb.php?src=<?php echo $src; ?>&w=260" />
		</a>
	</div>

	<div id="winner_info" style="text-align: center;">
		<p><strong>"<?php the_title(); ?>"</strong></p>
		<p><em>by: <?php echo get_post_meta($post->ID,'photo_author',true); ?></em></p>
		</div>
		<center><span style="color:#CF0000; font-weight: bold;">Click the Image Above to See This Photo and Previous Winners.</center>
<?php endwhile; wp_reset_postdata(); ?>	
</div>
<!-- End Photo of the Week -->

<!-- Begin Lower Sidebar -->
<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php endif; ?>
<!-- End Lower Sidebar -->