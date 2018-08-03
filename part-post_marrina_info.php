<?php $related_marinas = get_field('assign_directory_listing', $post->ID); ?>
<?php if ($related_marinas) : ?>
<hr class="directory-related-hr" />
<div class="directory-related">
	<h3>Related Directory Listings</h3>
	
	<?php foreach ($related_marinas as $marina) : ?>
	
	<table class="info-table">
	    
	    <tr>
		    <td colspan="2">
			    <h4><?php echo get_the_title($marina); ?></h4>
		    </td>
	    </tr>
	        			
		<?php if (get_post_meta($marina,'marina_phone',true)) { ?>
		<tr>
			<td width="190"><strong>Phone:</strong></td>
			<td><?php echo get_post_meta($marina,'marina_phone',true); ?></td>
		</tr>
		<?php } ?>
		
		<?php if (get_post_meta($marina,'marina_url',true)) { ?>
		<tr>
			<td><strong>Website:</strong></td>
			<td>
				<?php if (get_post_meta($marina,'marina_sponsor_url',true)) { ?>
					<a href="<?php echo get_post_meta($marina,'marina_sponsor_url',true); ?>"><?php echo get_post_meta($marina,'marina_url',true); ?></a>
				<?php } else { ?>
					<?php echo get_post_meta($marina,'marina_url',true); ?>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
		
		<?php if (get_post_meta($marina,'marina_statute_mile',true)) { ?>
		<tr>
			<td><strong>Statute Mile:</strong></td>
			<td><a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($marina,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($marina,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($marina,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($marina,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><?php echo get_post_meta($marina,'marina_statute_mile',true); ?></a></td>
		</tr>
		<?php } ?>
		
		<tr>
			<td><strong>Lat/Lon:</strong></td>
			<td>
				<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($marina,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($marina,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($marina,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($marina,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>">
					Near 
					<?php echo get_post_meta($marina,'cvcf-lat_deg',true); ?> 
					<?php echo get_post_meta($marina,'cvcf-lat_min',true); ?> 
					<?php if (get_post_meta($marina,'cvcf-lat_dir',true) == 1) { echo 'North'; } else { echo 'South'; } ?> / 
					
					<?php echo get_post_meta($marina,'cvcf-lon_deg',true); ?>
					<?php echo get_post_meta($marina,'cvcf-lon_min',true); ?> 
					<?php if (get_post_meta($marina,'cvcf-lon_dir',true) == 1) { echo 'East'; } else { echo 'West'; } ?> 
				</a>
			</td>
		</tr>
		
		<?php if (get_post_meta($marina,'marina_location',true)) : ?>
		<tr>
			<td><strong>Location:</strong></td>
			<td><?php echo get_post_meta($marina,'marina_location',true); ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (get_post_meta($marina,'marina_depth_min',true) || get_post_meta($marina,'marina_depth_max',true)) : ?>
		<tr>
			<td><strong>Depths:</strong></td>
			<td>
				<?php 
				if (get_post_meta($marina,'marina_depth_min',true) && get_post_meta($marina,'marina_depth_max',true) == '') {
					echo get_post_meta($marina,'marina_depth_min',true).' ft.';
				} elseif (get_post_meta($marina,'marina_depth_min',true) == '' && get_post_meta($marina,'marina_depth_max',true)) {
					get_post_meta($marina,'marina_depth_max',true).' ft.';
				} else {
					echo get_post_meta($marina,'marina_depth_min',true).'ft. to '.get_post_meta($marina,'marina_depth_max',true).' ft.';
				} 
				?>
			</td>
		</tr>
		<?php endif; ?>
		
	</table>
	<div class="clear"></div>
	<a href="<?php the_permalink(); ?>#respond"><div class="marina-full">Review This Marina</div></a>
	<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($marina,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($marina,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($marina,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($marina,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><div class="marina-full">View In Chartview</div></a>
	<a href="<?php the_permalink(); ?>"><div class="marina-full">View Full Marina Info</div></a>
	
	<?php endforeach; ?> 
</div>
<?php endif; ?>