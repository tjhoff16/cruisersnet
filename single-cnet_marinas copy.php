<?php get_header(); ?>

	<!-- Begin Content -->
	<div class="container main-wrap">
	
		<div class="row">
		
			<!-- Begin Left Content Column -->
			<div class="col-xs-9 left-wrap">
				
				
				
				
				
				<div id="main-col">
				
				
				<section class="single-wrapper">
                    <div class="single-line"></div>
                    <div class="single-bullet"></div>

                        <div <?php post_class(); ?>>  
         
							<header class="entry-header">
        
                            	<?php if (get_post_meta($post->ID,'marina_sponsor_url',true)) { ?>
                            	<div class="sponsored-listing-wrap">
                            		<strong style="color: #0F0B65; font-family: 'Rokkitt', serif;">SPONSOR</strong>
                            		<a class="ttip" data-toggle="tooltip" title="Click Here to Visit this Sponsors Website" href="<?php echo get_post_meta($post->ID,'marina_sponsor_url',true); ?>" target="_blank" class="marina-visit">
                            			<div class="sponsored-listing">
                            				<span class="marina-meta-icon" data-icon="&#xe0ce;"></span>
                            			</div>
                            		</a>
                            	</div> <!-- .sponsored-listing-wrap -->
                            	<?php } ?>
                            
                            <h2 class="entry-title" style="color: #0F0B65;"><?php the_title(); ?></h2>
                        
                        <div class="entry-meta-box">
                <div class="entry-meta-box-inner">
                    <span class="entry-date" style="border: 1px solid #E5E5E5; background: #FFFFFF; padding: 5px;"><span class="icon-clock-4 entry-icon"></span>Updated: <?php the_modified_date('M j, Y'); ?></span>
                    
                    <?php if (get_post_meta($post->ID,'marina_gallery',true)) : ?>
                    <span class="entry-comment" style="border: 1px solid #E5E5E5; background: #FFFFFF; padding: 5px;"><span class="icon-image entry-icon"></span><a href="<?php echo get_post_meta($post->ID,'marina_gallery',true); ?>" title="<?php the_title_attribute(); ?> Photo Gallery">Photo Gallery</a></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endif; ?>
                    
                    <span class="entry-comment" style="border: 1px solid #E5E5E5; background: #FFFFFF; padding: 5px;"><span class="icon-bubbles-4 entry-icon"></span><a href="#comments" title="<?php the_title_attribute(); ?> Reviews"><?php comments_number( 'No Reviews', '1 Review', '% Reviews' ); ?></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                     <span class="entry-comment" style="border: 1px solid #E5E5E5; background: #FFFFFF; padding: 5px;"><span class="icon-bubbles-4 entry-icon"></span><a href="#comment" title="Comment on 28. The City Marina">Review This Marina</a></span>  
                    
                     
                                                 
                </div>
            </div>
        </header>
		
		<!-- marina content begin -->
		<div class="marina-content">
        	
        	<div class="service-icons">																							
        		<?php service_icons($post->ID); ?>
        	</div>
        	<br />
        	
        	<div class="marina-info">
        		
        		<h3>Basic Marina Information:</h3>
        		
        		
        		<?php if(get_post_meta($post->ID,'marina_sponsor_ad_id',true)) : ?>
        		<div class="sponsor-banner">
                    <?php echo adrotate_ad(get_post_meta($post->ID,'marina_sponsor_ad_id', true)); ?>
        		</div>
        		<?php endif; ?>
        		
        		<table class="info-table" <?php if(get_post_meta($post->ID,'marina_sponsor_graphic',true)) { ?> style="width: 80%;" <?php } else { ?>style="width: 100%;"<?php } ?>>
        			
        			<?php if (get_post_meta($post->ID,'marina_phone',true)) : ?>
        			<tr>
        				<td width="192"><strong>Phone:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_phone',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_url',true)) : ?>
        			<tr>
        				<td><strong>Website:</strong></td>
        				<td>
        				<?php if (get_post_meta($post->ID,'marina_sponsor_url',true)) { ?>
        					<a target="_blank" href="<?php echo get_post_meta($post->ID,'marina_sponsor_url',true); ?>"><?php echo get_post_meta($post->ID,'marina_url',true); ?></a>
        				<?php } else { ?>
        					<?php echo get_post_meta($post->ID,'marina_url',true); ?>
        				<?php } ?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_statute_mile',true)) : ?>
        			<tr>
        				<td><strong>Statute Mile:</strong></td>
        				<td><a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><?php echo get_post_meta($post->ID,'marina_statute_mile',true); ?></a></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'cvcf-latitude_dec',true)) : ?>
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
        			<?php endif; ?>
        			
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
        		<br />
        		
        		<div class="marina-featured">
        			<div class="marina-chartlet" style="margin: 10px 20px 0 0;">
        				<iframe width="320" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php bloginfo('template_directory'); ?>/includes/v3_demo/chartlet.php?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-chartletzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>;output=embed"></iframe><br />
        				<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>">View this Marina on a Full Sized ChartView Page</a>
        			</div>
        		
        			<div class="marina-chartlet">
        				<iframe width="320" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php bloginfo('template_directory'); ?>/includes/v3_demo/chartlet.php?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-satzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>&amp;map=hybrid"></iframe><br />
        				<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-satzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>&amp;map=hybrid">View this Marina on a Full Sized ChartView/Satellite Page</a>
        			</div>
        		</div>
        		
        		<div class="clear"></div>
        		
        		<br />
        		<div class="service-details">
        		<h3>Service Details:</h3>
        		<div class="clear"></div>
        		<table class="info-table" style="width: 100%;">
        			
        			<?php if (get_post_meta($post->ID,'mcf-transient-dock',true)) : ?>
        			<tr>
        				<td width="192"><strong>Transient dockage:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-transient-dock-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-transient-dock-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-transient-dock-reservation_DISABLED',true)) : ?>
        			<tr>
        				<td><strong>MarinaLife Reservation:</strong></td>
        				<td><a target="_blank" href="<?php echo get_post_meta($post->ID,'mcf-transient-dock-reservation',true); ?>"><img src="/images/SiteGraphics/makeReservation.jpg" /></a></td>
        			</tr>
        			<?php endif; ?>
        		
        			<?php if (get_post_meta($post->ID,'mcf-transient-dock-rate',true)) : ?>
        			<tr>
        				<td><strong>Transient dockage rate:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-transient-dock-rate',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			
        			
        			<?php if (get_post_meta($post->ID,'mcf-boatus-discount',true)) : ?>
        			<tr>
        				<td><strong>Boat/US Dockage Discount:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-boatus-discount-notes',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-marinalife-discount_DISABLED',true)) : ?>
        			<tr>
        				<td><strong>MarinaLife Dockage Discount:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-marinalife-discount-notes',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-seatow-discount',true)) : ?>
        			<tr>
        				<td><strong>SeaTow Dockage Discount:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-seatow-discount-notes',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			
        			
        			
        			
        			<?php if (get_post_meta($post->ID,'mcf-transient-dock-type',true)) : ?>
        			<tr>
        				<td><strong>Type of dockage:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-transient-dock-type',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-transient-dock-slips',true)) : ?>
        			<tr>
        				<td><strong>Total number of slips/berths:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'mcf-transient-dock-slips',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-power-20-30',true) || 
        					  get_post_meta($post->ID,'mcf-power-20-30-50',true) || 
        					  get_post_meta($post->ID,'mcf-power-30',true) || 
        					  get_post_meta($post->ID,'mcf-power-50',true) || 
        					  get_post_meta($post->ID,'mcf-power-30-50',true) || 
        					  get_post_meta($post->ID,'mcf-power-30-50-100',true)) : ?>
        			<tr>
        				<td><strong>Dockside Power Connections:</strong></td>
        				<td>
        					<?php if (get_post_meta($post->ID,'mcf-power-20-30',true)) { echo '20/30'; } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-20-30-50',true)) { echo '20/30/50'; } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30',true)) { echo '30'; } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-50',true)) { echo '50'; } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30-50',true)) { echo '30/50'; } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30-50-100',true)) { echo '30/50/100'; } ?> 
        					
        					amp power hookups available<br /><br />
        					
        					<?php if (get_post_meta($post->ID,'mcf-power-20-30-notes',true)) { echo get_post_meta($post->ID,'mcf-power-20-30-notes',true); } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-20-30-50-notes',true)) { echo get_post_meta($post->ID,'mcf-power-20-30-50-notes',true); } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30-notes',true)) { echo get_post_meta($post->ID,'mcf-power-30-notes',true); } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-50-notes',true)) { echo get_post_meta($post->ID,'mcf-power-50-notes',true); } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30-50-notes',true)) { echo get_post_meta($post->ID,'mcf-power-30-50-notes',true); } ?> 
        					<?php if (get_post_meta($post->ID,'mcf-power-30-50-100-notes',true)) { echo get_post_meta($post->ID,'mcf-power-30-50-100-notes',true); } ?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-fresh-water',true)) : ?>
        			<tr>
        				<td><strong>Dock. Fresh Water Connections:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-fresh-water-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-fresh-water-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-shower',true)) : ?>
        			<tr>
        				<td><strong>Showers:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-shower-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-shower-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-laundry',true)) : ?>
        			<tr>
        				<td><strong>Laundromat:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-laundry-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-laundry-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-swimming-pool',true)) : ?>
        			<tr>
        				<td><strong>Swimming Pool:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-swimming-pool-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-swimming-pool-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_rest',true)) : ?>
        			<tr>
        				<td><strong>Restaurant:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_rest',true); ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_restreqs',true)) : ?>
        			<tr>
        				<td><strong>Restaurant Recommendations:</strong></td>
        				<td><p><?php echo get_post_meta($post->ID,'marina_restreqs',true); ?></p></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_provisioning',true)) : ?>
        			<tr>
        				<td><strong>Provisioning Possibilities:</strong></td>
        				<td><?php echo get_post_meta($post->ID,'marina_provisioning',true); ?></td>
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
        			
        			<?php if (get_post_meta($post->ID,'mcf-wifi',true)) : ?>
        			<tr>
        				<td><strong>Wi-Fi Internet Access:</strong></td>
        				<td>
        					<?php if (get_post_meta($post->ID,'mcf-wifi-fvp',true)) { ?>
        					
        						<?php echo ucfirst(get_post_meta($post->ID,'mcf-wifi-fvp',true)); ?> Wifi Available<?php if (get_post_meta($post->ID,'mcf-wifi-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-wifi-notes',true); } ?>
        					
        					<?php } else { ?>
        					Available
        					<?php } ?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-waste',true)) : ?>
        			<tr>
        				<td><strong>Waste pump-out:</strong></td>
        				<td>Available<?php if (get_post_meta($post->ID,'mcf-waste-notes',true)) { echo ', '.get_post_meta($post->ID,'mcf-waste-notes',true); } ?></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'mcf-gas',true) || get_post_meta($post->ID,'mcf-diesel',true)) : ?>
        			<tr>
        				<td><strong>Gasoline and diesel fuel:</strong></td>
        				<td>
        					<?php
        					if (get_post_meta($post->ID,'mcf-gas',true) && get_post_meta($post->ID,'mcf-diesel',true) == '') {
        						echo 'Gas Available';
        					} elseif (get_post_meta($post->ID,'mcf-gas',true) == '' && get_post_meta($post->ID,'mcf-diesel',true)) {
        						echo 'Diesel Available';
        					} else {
        						echo 'Gas & Diesel Available';
        					}
        					?>
        				</td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_nav_detail',true)) : ?>
        			<tr>
        				<td><strong>Navigational Detail:</strong></td>
        				<td><a href="<?php echo get_post_meta($post->ID,'marina_nav_detail',true); ?>">Read Details</a></td>
        			</tr>
        			<?php endif; ?>
        			
        			<?php if (get_post_meta($post->ID,'marina_claiborne_review',true)) : ?>
        			<tr>
        				<td><strong>Claiborne's Review:</strong></td>
        				<td><a href="<?php echo get_post_meta($post->ID,'marina_claiborne_review',true); ?>">Read Review</a></td>
        			</tr>
        			<?php endif; ?>
        			
        		</table>
        		</div>
        		<br />
        		
        		<div class="clear"></div>
        		
        		
        		<?php if (get_post_meta($post->ID,'gas_price',true) || get_post_meta($post->ID,'diesel_price',true)) : ?>
        		<br />
        		<div class="fuel-table">
        			
        			<h3>Fuel Prices (All Taxes Included)</h3>
        			<table class="info-table">
        				
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
        						$<?php echo get_post_meta($post->ID,'gas_price',true); ?>
        					</td>
        				</tr>
        				<?php endif; ?>
        				
        				<?php if (get_post_meta($post->ID,'mcf-diesel',true)) : ?>
        				<tr>
        					<td><strong>Diesel Fuel Price:</strong></td>
        					<td>
        						$<?php echo get_post_meta($post->ID,'diesel_price',true); ?>
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
        		
        		</div> <!-- end fuel-table -->
        		<?php endif; ?>
        		
        	</div>
        	
        	<br />
        	
        	<div class="clear"></div>
           	
           	<?php if (get_post_meta($post->ID,'marina_gallery',true)) : ?>
           	<a class="post-button-link" href="<?php echo get_post_meta($post->ID,'marina_gallery',true); ?>"><div class="post-button button-full gallery-button">
            	<div style=" float: left; width: 30px; height: 30px; margin: -5px 0 0 0; background: url(/dev/images/gallery-button-bg.png) no-repeat;"></div>CLICK HERE TO VIEW PHOTO GALLERY FOR THIS MARINA
            </div></a>
            <?php endif; ?>
           	
           	<a class="post-button-link" href="#"><div class="post-button button-full review-button">
            	<div style=" float: left; width: 40px; height: 30px; margin: -5px 0 0 0; background: url(/dev/images/review-button-bg.png) no-repeat;"></div>CLICK HERE TO REVIEW THIS MARINA
            </div></a>
                	
        	<div class="clear"></div>
        	
        	<?php edit_post_link('<div style="float: right; padding: 10px; font-weight: bold; color: #FFFFFF; background: #002366; width: 140px; text-align: center;">Edit This Marina</div>'); ?>
        	<div class="clear"></div>
        	
        </div>
        <!-- marina content end -->

               

        
    </div>

            
        
          
        <div id="comments">
            <h3>
                <?php comments_number( 'No Reviews', '1 Review', '% Reviews' ); ?>                
            </h3>
            
            <?php //comments_template('/comments-v3.php'); ?>
            <h4>Reviews Currently Disabled</h4>
            
            <center class="pagination kopa-comment-pagination"></center>
        </div>
    	  
    								<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">Review This Marina<small><a rel="nofollow" id="cancel-comment-reply-link" href="/28-the-city-marina/#respond" style="display:none;">Cancel</a></small></h3>
									<form action="http://v2.cruisersnet.net/wp-comments-post.php" method="post" id="comments-form" class="comment-form">
																			<p class="log-in-out">Logged in as <a href="http://v2.cruisersnet.net/wp-admin/profile.php" title="admin">admin</a>. <a href="http://v2.cruisersnet.net/wp-login.php?action=logout&amp;redirect_to=http%3A%2F%2Fv2.cruisersnet.net%2F28-the-city-marina%2F&amp;_wpnonce=0827cd6c78" title="Log out of this account">Log out &raquo;</a></p><!-- .log-in-out -->																			<div class="comment-right"><p class="textarea-block">
        <label class="required" for="comment_message">Message <span>(required):</span></label>        
        <textarea name="comment" id="comment_message"></textarea>
        </p></div><div class="clear"></div>
        
        
        <p><strong>All "Comments/Reviews" submitted to the Salty Southeast Cruisers' Net are reviewed by our editorial staff before being published.</strong></p>
        												<p class="form-submit">
							<input name="submit" type="submit" id="submit-comment" value="Submit" />
							<input type='hidden' name='comment_post_ID' value='4992' id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
						</p>
						<input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="2138d2430f" /><script>(function(){if(window===window.parent){document.getElementById('_wp_unfiltered_html_comment_disabled').name='_wp_unfiltered_html_comment';}})();</script>
<p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="5568b65cbb" /></p>					</form>
							</div><!-- #respond -->
							<a name="comment">&nbsp;</a>
						

        
                </section>
                
                
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

<?php get_footer(); ?>
