<!-- entry content begin -->
<h2 class="entry-title"> <?php the_title(); ?> </h2>
<div class="service-icons"><?php service_icons($post->ID); ?></div>
<div class="marina-info">
<?php if (get_post_meta($post->ID,'marina_sponsor_ad_id',true)) { ?>
<div class="sponsor-banner"><?php echo adrotate_ad( get_post_meta($post->ID,'marina_sponsor_ad_id',true) );?></div>
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
<?php if (get_post_meta($post->ID,'marina_sponsor_ad_id',true)) { ?>
<a href="<?php echo get_post_meta($post->ID,'marina_sponsor_url',true); ?>"><?php echo get_post_meta($post->ID,'marina_url',true); ?></a>
<?php } else { ?>
<?php echo get_post_meta($post->ID,'marina_url',true); ?>
<?php } ?>
</td>
</tr>
<?php } ?>

<?php if ( strlen(get_post_meta($post->ID,'marina_statute_mile',true))>0 ) { ?>
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
</div><!-- END OF marina-info DIV -->

<div class="clear"></div>
<div class="col-xs-12">
<div class="col-xs-6">
<a href="/cruisersnet-marine-map/?ll=<?php echo get_post_meta($post->ID,'cvcf-latitude_dec',true); ?>,<?php echo get_post_meta($post->ID,'cvcf-longitude_dec',true); ?>&z=<?php echo get_post_meta($post->ID,'cvcf-zoomlevel',true); ?><?php if (get_post_meta($post->ID,'marina_highlight',true) == 'yes') { echo '&highlight=1'; } ?>"><div class="comment_button">View In Chartview</div></a>
</div>
<div class="col-xs-6">
<button class="comment_button" onclick="openComment(<?php echo get_the_ID(); ?>)">Review Marina</button>
</div>
</div>
<div class="clear"></div>

