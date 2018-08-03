		<?php if (get_post_meta($post->ID,'mcf-propane-ng',true) || get_post_meta($post->ID,'mcf-natural-gas',true)) : ?>
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
                            
                            <?php if (get_post_meta($post->ID,'mcf-propane-ng',true)) { ?>
                            <span class="entry-author"><span class="fa fa-check-square-o entry-icon"></span>LPG: Yes</span>
                            <?php } else { ?>
                            <span class="entry-author"><span class="fa fa-square-o entry-icon"></span>LPG: No</span>
                            <?php } ?>
                            
                            <?php if (get_post_meta($post->ID,'mcf-natural-gas',true)) { ?>
                            <span class="entry-author"><span class="fa fa-check-square-o entry-icon"></span>CNG: Yes</span>
                            <?php } else { ?>
                            <span class="entry-author"><span class="fa fa-square-o entry-icon"></span>CNG: No</span>
                            <?php } ?>

                            <span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><a href="#comments" title="<?php the_title_attribute(); ?> Reviews"><?php comments_number( 'No Reviews', '1 Review', '% Reviews' ); ?></a></span>
                                                        
                        </div>
                        <span class="entry-meta-circle"></span>
                        <span class="entry-meta-icon" data-icon="&#xe034;"></span>
                    </div>

                </header>
                
                
                <!-- marina content begin -->
        	
        	
        	
        	<div class="marina-info">
        		
        		<?php if( get_post_meta($post->ID,'marina_sponsor_ad_id',true) ) : ?>
        		<div class="sponsor-banner">
                    <?php echo adrotate_ad(get_post_meta($post->ID,'marina_sponsor_ad_id',true)); ?>
        		</div>
        		<?php endif; ?>
        		
        		<div class="fuel-table">
        		
        			<table class="info-table" <?php if(get_post_meta($post->ID,'marina_sponsor_graphic',true)) { ?> style="width: 80%;" <?php } else { ?>style="width: 100%;"<?php } ?>>
        			
        			<?php if (get_post_meta($post->ID,'marina_phone',true)) : ?>
        			<tr>
        				<td width="192"><strong>Phone:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_phone',true); ?></td>
        			</tr>
        			<?php endif; ?>
					
        			
        			<?php if (get_post_meta($post->ID,'mcf-propane-ng',true)) : ?>
        			<tr>
        				<td><strong>LPG (Propane) Availability:</strong></td>
        				<td>
        					Available
        					<?php if (get_post_meta($post->ID,'mcf-propane-ng-notes',true)) { echo '<br /><br />'.get_post_meta($post->ID,'mcf-propane-ng-notes',true); } ?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-natural-gas',true)) : ?>
        			<tr>
        				<td><strong>CNG (Compressed Natural Gas) Availability:</strong></td>
        				<td>
        					Available
        					<?php if (get_post_meta($post->ID,'mcf-natural-gas-notes',true)) { echo '<br /><br />'.get_post_meta($post->ID,'mcf-natural-gas-notes',true); } ?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        		</table>
        		
        		</div> <!-- end fuel-table -->
        		
        		<div class="clearfix"></div>
               	
               	<a href="<?php the_permalink(); ?>#respond"><div class="marina-full">Review This Marina</div></a>
               	<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><div class="marina-full">View In Chartview</div></a>
               	<a href="<?php the_permalink(); ?>"><div class="marina-full">View Full Marina Info</div></a>
               	
        	<div class="clear"></div>
        <!-- marina content end -->
                
                
            </div><!--entry-content-->
						
				</article>
				
			</li>
		<?php endif; ?>