			<?php $bg = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : ''); ?>
			<li <?php post_class($bg); ?>>
				
				<article class="article-no-thumb clearfix">
					
					<div class="entry-content">
                <header class="entry-header">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="entry-meta-box">
                        <div class="entry-meta-box-inner">
                            <span class="entry-date"><span class="icon-clock-4 entry-icon"></span>Updated: <?php the_modified_date('F j, Y'); ?></span>
                            
                            <?php if (get_post_meta($post->ID,'marina_sponsor_url',true)) { ?>
                            <span class="entry-comment"><span class="icon-star-2 entry-icon"></span>SSECN SPONSOR</span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                            <?php } ?>
                            
                            <span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?> Reviews"><?php comments_number( 'No Reviews', '1 Review', '% Reviews' ); ?></a></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><a href="<?php the_permalink(); ?>#respond" title="<?php the_title_attribute(); ?>">Review This Marina</a></span>   
                                                         
                        </div>
                        <span class="entry-meta-circle"></span>
                        <span class="entry-meta-icon" data-icon="&#xe034;"></span>
                    </div>

                </header>
                
                
                <!-- marina content begin -->
        	
        	<div class="service-icons">
        		<?php service_icons($post->ID); ?>
        	</div>
        	<br />
        	
        	<div class="marina-info">
        		
        		<?php if (get_post_meta($post->ID,'marina_sponsor_graphic',true)) { ?>
        		<div class="sponsor-banner">
        			<a href="<?php echo get_post_meta($post->ID,'marina_sponsor_url',true); ?>"><img src="<?php echo get_post_meta($post->ID,'marina_sponsor_graphic',true); ?>" /></a>
        		</div>
        		<?php } ?>
        		
        		<table class="info-table" style="<?php if (get_post_meta($post->ID,'marina_sponsor_graphic',true)) { echo 'width: 80%;'; } else { echo 'width: 100%'; } ?>">
        			
        			<?php if (get_post_meta($post->ID,'marina_phone',true)) { ?>
        			<tr>
        				<td width="190"><strong>Phone:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_phone',true); ?></td>
        			</tr>
        			<?php } ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_url',true)) { ?>
        			<tr>
        				<td><strong>Website:</strong></td>
        				<td>
        					<?php if (get_post_meta($post->ID,'marina_sponsor_url',true)) { ?>
        						<a href="<?php echo get_post_meta($post->ID,'marina_sponsor_url',true); ?>"><?php echo get_post_meta($post->ID,'marina_url',true); ?></a>
        					<?php } else { ?>
        						<?php echo get_post_meta($post->ID,'marina_url',true); ?>
        					<?php } ?>
        				</td>
        			</tr>
        			<?php } ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_statute_mile',true)) { ?>
        			<tr>
        				<td><strong>Statute Mile:</strong></td>
        				<td><a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><?php echo get_post_meta($post->ID,'marina_statute_mile',true); ?></a></td>
        			</tr>
        			<?php } ?>
        			
        			<tr>
        				<td><strong>Lat/Lon:</strong></td>
        				<td>
        					<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>">
        						Near 
        						<?php echo get_post_meta($post->ID,'cvcf-lat_deg',true); ?> 
        						<?php echo get_post_meta($post->ID,'cvcf-lat_min',true); ?> 
        						<?php if (get_post_meta($post->ID,'cvcf-lat_dir',true) == 1) { echo 'North'; } else { echo 'South'; } ?> / 
        						
        						<?php echo get_post_meta($post->ID,'cvcf-lon_deg',true); ?>
        						<?php echo get_post_meta($post->ID,'cvcf-lon_min',true); ?> 
        						<?php if (get_post_meta($post->ID,'cvcf-lon_dir',true) == 1) { echo 'East'; } else { echo 'West'; } ?> 
        					</a>
        				</td>
        			</tr>
        			
        			<?php if (get_post_meta($post->ID,'marina_location',true)) : ?>
        			<tr>
        				<td><strong>Location:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_location',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_depth_min',true) || get_post_meta($post->ID,'marina_depth_max',true)) : ?>
        			<tr>
        				<td><strong>Depths:</strong></td>
        				<td>
        					<?php 
        					if (get_post_meta($post->ID,'marina_depth_min',true) && get_post_meta($post->ID,'marina_depth_max',true) == '') {
        						echo get_post_meta($post->ID,'marina_depth_min',true).' ft.';
        					} elseif (get_post_meta($post->ID,'marina_depth_min',true) == '' && get_post_meta($post->ID,'marina_depth_max',true)) {
        						get_post_meta($post->ID,'marina_depth_max',true).' ft.';
        					} else {
        						echo get_post_meta($post->ID,'marina_depth_min',true).'ft. to '.get_post_meta($post->ID,'marina_depth_max',true).' ft.';
        					} 
        					?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        		</table>
               	<div class="clear"></div>
               	<a href="<?php the_permalink(); ?>#respond"><div class="marina-full">Review This Marina</div></a>
               	<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><div class="marina-full">View In Chartview</div></a>
               	<a href="<?php the_permalink(); ?>"><div class="marina-full">View Full Marina Info</div></a>
               	
               	
               	
        	<div class="clear"></div>
        <!-- marina content end -->
                
                
            </div><!--entry-content-->
						
				</article>
				
			</li>