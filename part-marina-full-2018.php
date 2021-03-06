<!-- entry content begin -->
<h2 class="entry-title"> <?php the_title(); ?> </h2>
<div class="entry-content marina-content">
<div class="service-icons">
<?php service_icons($post->ID); ?>
</div>
<br />

<div class="marina-info">

<h3>Basic Marina Information:</h3>

<?php if(get_post_meta($post->ID,'marina_sponsor_ad_id',true)) : ?>
<div class="sponsor-banner">
<?php echo adrotate_ad(get_post_meta($post->ID,'marina_sponsor_ad_id',true)); ?>
</div>
<?php endif; ?>

<table class="info-table" <?php if(get_post_meta($post->ID,'marina_sponsor_graphic',true)) { ?> style="width: 80%;" <?php } else { ?>style="width: 100%;"<?php } ?>>

<?php if (get_post_meta($post->ID,'marina_phone',true)) : ?>
<tr>
<td width="192"><strong>Phone:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_phone',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_vhf_monitored',true) || get_post_meta($post->ID,'marina_vhf_working',true)) : ?>
<tr>
<td width="192"><strong>VHF:</strong></td>
<td>Monitored: <?php echo get_post_meta($post->ID,'marina_vhf_monitored',true); ?>
&nbsp; &nbsp; &nbsp; &nbsp; Working: <?php echo get_post_meta($post->ID,'marina_vhf_working',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_email',true)) : ?>
<tr>
<td width="192"><strong>EMail:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_email',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_fax',true)) : ?>
<tr>
<td width="192"><strong>Fax:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_fax',true); ?></td>
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

<?php if ( strlen(get_post_meta($post->ID,'marina_statute_mile',true))>0 ) : ?>
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

<?php if ( get_post_meta($post->ID,'marina_address1',true) ||
          get_post_meta($post->ID,'marina_address2',true) ||
          get_post_meta($post->ID,'marina_city',true)     ||
          get_post_meta($post->ID,'marina_state',true)    ||
          get_post_meta($post->ID,'marina_zipcode',true)
          ) : ?>
<tr>
<td width="192"><strong>Address:</strong></td>
<td>
<?php
    if (get_post_meta($post->ID,'marina_address1',true)) echo get_post_meta($post->ID,'marina_address1',true) . "<BR>";
    if (get_post_meta($post->ID,'marina_address2',true)) echo get_post_meta($post->ID,'marina_address2',true) . "<BR>";
    if (get_post_meta($post->ID,'marina_city',true)) echo get_post_meta($post->ID,'marina_city',true) . "&nbsp;";
    if (get_post_meta($post->ID,'marina_state',true)) echo get_post_meta($post->ID,'marina_state',true) . "&nbsp;&nbsp;";
    if (get_post_meta($post->ID,'marina_zipcode',true)) echo get_post_meta($post->ID,'marina_zipcode',true);
    ?>
</td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_gm',true)) : ?>
<tr>
<td width="192"><strong>General Manager:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_gm',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_dockmaster',true)) : ?>
<tr>
<td width="192"><strong>Dockmaster:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_dockmaster',true); ?></td>
</tr>
<?php endif; ?>

</table>
<br />

<div class="marina-featured">
<div class="marina-chartlet" style="margin: 10px 20px 0 0;">
<iframe class="chartlet-iframe" width="380" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="" data-src="<?php bloginfo('template_directory'); ?>/includes/features/chartlet-2018.php?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-chartletzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>&amp;output=embed"></iframe><br />
<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>">Click Here For a Full Sized ChartView Page</a>
</div>

<div class="marina-chartlet">
<iframe class="chartlet-iframe" width="380" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="" data-src="<?php bloginfo('template_directory'); ?>/includes/features/chartlet-2018.php?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-satzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>&amp;map=hybrid"></iframe><br />
<a href="<?php bloginfo('url'); ?>/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-satzoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>&amp;map=hybrid">Click Here For a Full Sized ChartView Page</a>
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
<?php
    $ml_url = get_post_meta($post->ID,'mcf-transient-dock-reservation',true);
    if (strpos($ml_url, 'http://') == false) {
        $ml_url = 'http://'.$ml_url;
    }
    ?>
<td><a target="_blank" href="<?php echo $ml_url; ?>"><img src="/images/SiteGraphics/makeReservation.jpg" /></a></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'mcf-transient-dock-rate',true)) : ?>
<tr>
<td><strong>Transient dockage rate:</strong></td>
<td><?php echo get_post_meta($post->ID,'mcf-transient-dock-rate',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'mcf-ssecn-discount',true)) : ?>
<tr>
<td><strong>Cruisers Net Dockage Discount:</strong></td>
<td><?php echo get_post_meta($post->ID,'mcf-ssecn-discount-notes',true); ?></td>
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

<?php if (get_post_meta($post->ID,'mcf-other-discount',true)) : ?>
<tr>
<td><strong>Other Dockage Discount:</strong></td>
<td><?php echo get_post_meta($post->ID,'mcf-other-discount-notes',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'mcf-transient-dock-type',true)) : ?>
<tr>
<td><strong>Type of dockage:</strong></td>
<td><?php echo get_post_meta($post->ID,'mcf-transient-dock-type',true); ?></td>
</tr>
<?php endif; ?>



<tr>
<td><strong>Live Aboards Allowed:</strong></td>
<td><?php the_field('marina_liveaboard'); ?></td>
</tr>

<?php if (get_post_meta($post->ID,'marina_liveaboard',true) == 'yes') : ?>

<?php if (get_field('marina_liveaboard_notes')) : ?>
<tr>
<td><strong>Live Aboard Notes:</strong></td>
<td><?php the_field('marina_liveaboard_notes'); ?></td>
</tr>
<?php endif; ?>

<?php if (get_field('marina_monthly_rate')) : ?>
<tr>
<td><strong>Monthly Dockage Rate:</strong></td>
<td><?php the_field('marina_monthly_rate'); ?></td>
</tr>
<?php endif; ?>

<?php if (get_field('marina_monthly_rate_notes')) : ?>
<tr>
<td><strong>Monthly Dockage Rate Notes:</strong></td>
<td><?php the_field('marina_monthly_rate_notes'); ?></td>
</tr>
<?php endif; ?>

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


<?php if (get_post_meta($post->ID,'mcf-cable',true)) : ?>
<tr>
<td><strong>Dockside Cable Television Connection:</strong></td>
<td>
Available
<?php if (get_post_meta($post->ID,'mcf-cable-notes',true)) { echo '<br /><br />'.get_post_meta($post->ID,'mcf-natural-gas-notes',true); } ?>
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
<?php if (get_post_meta($post->ID,'mcf-OnSpotWiFi',true)=='yes') { ?>
<BR><a target="_blank" href="http://onspotwifi.com"><img src="/images/SiteGraphics/OnSpotWiFi_200x36px.jpg" /></a>
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
<div id="fuel-div" class="fuel-table">

<h3>Fuel Prices (All Taxes Included)</h3>
<table class="info-table">

<?php
    $gaspos    = strstr(strtoupper(get_post_meta($post->ID,'gas_price',true)),    'CALL');
    $dieselpos = strstr(strtoupper(get_post_meta($post->ID,'diesel_price',true)), 'CALL');
    if (get_post_meta($post->ID,'marina_reporting_date',true) && ! $gaspos && ! $dieselpos ) : ?>
<tr>
<td width="192"><strong>Reporting Date:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_reporting_date',true) ; ?></td>
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

<?php if (get_post_meta($post->ID,'marina_other_discount',true)) : ?>
<tr>
<td><strong>Other Discount:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_other_notes',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_quantity_discount',true)) : ?>
<tr>
<td><strong>Any Quantity Discount:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_quantity_discount_notes',true); ?></td>
</tr>
<?php endif; ?>

<?php if (get_post_meta($post->ID,'marina_ssecn_discount',true)) : ?>
<tr>
<td><strong>Any CruisersNet Discount:</strong></td>
<td><?php echo get_post_meta($post->ID,'marina_ssecn_notes',true); ?></td>
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

<?php edit_post_link('<div style="float: right; padding: 10px; font-weight: bold; color: #FFFFFF; background: #002366; width: 140px; text-align: center;">Edit This Marina</div>'); ?>
<div class="clear"></div>
    
</div><!-- entry content end -->


