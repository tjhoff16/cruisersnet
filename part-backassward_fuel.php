			<li>
				<h2>Non-Reporting Marinas</h2>
			</li>
						
			<?php
			$fuel_query = new WP_Query($args);
			print_r($args);
			?>
			<li>
				
				<article class="article-no-thumb clearfix">
					
					<div class="entry-content">
                
                <header class="entry-header">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
					
					<?php
					// Check if the price is numeric, if not, set generic labels
					$check_gas_price = get_post_meta($post->ID,'gas_price',true);
					$check_diesel_price = get_post_meta($post->ID,'diesel_price',true);
					
					// Gas Check
					if (is_numeric($check_gas_price)) { 
						$print_gas_price = '$' . $check_gas_price;
						$print_gas_field = '$' . $check_gas_price . ' <span class="fuel-taxes">(All Taxes Included)</span>';
					} else {
						$print_gas_price = 'N/A';
						$print_gas_field = $check_gas_price;
					}
					
					// Diesel Check
					if (is_numeric($check_diesel_price)) { 
						$print_diesel_price = '$' . $check_diesel_price;
						$print_diesel_field = '$' . $check_diesel_price . ' <span class="fuel-taxes">(All Taxes Included)</span>';
					} else {
						$print_diesel_price = 'N/A';
						$print_diesel_field = $check_diesel_price;
					}
					?>
					
                    <div class="entry-meta-box">
                        <div class="entry-meta-box-inner">
                            <span class="entry-date"><span class="icon-clock-4 entry-icon"></span>Reported: <?php echo get_post_meta($post->ID,'marina_reporting_date',true); ?></span>
                            
                            <?php if (get_post_meta($post->ID,'mcf-gas',true)) : ?>
                            <span class="entry-author"><span class="icon-dollar entry-icon"></span>Gas: <?php echo $print_gas_price; ?></span>
                            <?php endif; ?>
                            
                            <?php if (get_post_meta($post->ID,'mcf-diesel',true)) : ?>
                            <span class="entry-author"><span class="icon-dollar entry-icon"></span>Diesel: <?php echo $print_diesel_price; ?></span>
                            <?php endif; ?>
                            
                            <?php if (get_post_meta($post->ID,'marina_sponsor_url',true)) { ?>
                            <span class="entry-comment sponsor-span"><span class="icon-star-2 entry-icon"></span>SSECN SPONSOR</span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                            <?php } ?>   
                            
                            <span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span><a href="<?php the_permalink(); ?>#comments" title="<?php the_title_attribute(); ?> Reviews"><?php comments_number( 'No Reviews', '1 Review', '% Reviews' ); ?></a></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            
                                                       
                        </div>
                        <span class="entry-meta-circle"></span>
                        <span class="entry-meta-icon" data-icon="&#xe034;"></span>
                    </div>

                </header>
                
                
                <!-- marina content begin -->
        	
        	
        	
        	<div class="marina-info">
        		
        		<?php if(get_post_meta($post->ID,'marina_sponsor_ad_id',true)) : ?>
        		<div class="sponsor-banner">
                    <?php adrotate_ad( get_post_meta($post->ID,'marina_sponsor_ad_id',true) ); ?>
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
        			
        			
        			<?php if (get_post_meta($post->ID,'marina_statute_mile',true)) { ?>
        			<tr>
        				<td><strong>Statute Mile:</strong></td>
        				<td><a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><?php echo get_post_meta($post->ID,'marina_statute_mile',true); ?></a></td>
        			</tr>
        			<?php } ?>
        			
        			
        			<?php if (get_post_meta($post->ID,'marina_reporting_date',true)) : ?>
        				<tr>
        					<td width="192"><strong>Reporting Date:</strong></td>
        					<td><?php echo get_post_meta($post->ID,'marina_reporting_date',true); ?></td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'fuel_notes',true)) : ?>
        				<tr>
        					<td width="192"><strong>Notes:</strong></td>
        					<td><?php echo get_post_meta($post->ID,'fuel_notes',true); ?></td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'mcf-gas',true)) : ?>
        				<tr>
        					<td><strong>Gasoline Price:</strong></td>
        					<td>
        						<?php echo $print_gas_field; ?> 
        					</td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'mcf-diesel',true)) : ?>
        				<tr>
        					<td><strong>Diesel Fuel Price:</strong></td>
        					<td>
        						<?php echo $print_diesel_field; ?>
        					</td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'marina_quantity_discount',true)) : ?>
        				<tr>
        					<td><strong>Any Quantity Discount:</strong></td>
        					<td><?php echo get_post_meta($post->ID,'marina_quantity_discount_notes',true); ?></td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'boatus_discount_only',true)) : ?>
        				<tr>
        					<td><strong>Any Boat/US Discount:</strong></td>
        					<td><?php echo get_post_meta($post->ID,'marina_boatus_notes',true); ?></td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'marina_seatow_discount',true)) : ?>
        				<tr>
        					<td><strong>Any SeaTow Discount:</strong></td>
        					<td><?php echo get_post_meta($post->ID,'marina_seatow_notes',true); ?></td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'valvtech_only',true)) : ?>
        				<tr>
        					<td><strong>ValvTect Dealer:</strong></td>
        					<td>Yes</td>
        				</tr>
        				<?php endif; ?>
        				
        			</table>
        		<div class="clear"></div>
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
	<?php } ?>