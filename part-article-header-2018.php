<header class="entry-header">
<div class="entry-meta-box">
<div class="entry-meta-box-inner" <?php if ( $isDisclaimer ) echo 'style="display: none;"'; ?> >
<span class="entry-date"><span class="icon-clock-4 entry-icon"></span>
    <?php echo $post->post_type!=='cnet_marinas' ? get_the_date('M j, y') : the_modified_date('M j, y'); ?>
</span>
<?php if (get_post_meta($post->ID,'marina_sponsor_ad_id',true)) { ?>
    <span class="entry-comment sponsor-span"><span class="icon-star-2 entry-icon"></span>SSECN SPONSOR</span>
<?php } ?>
<span class="entry-author"><span class="icon-user entry-icon"></span>by:
    <?php the_author(); ?>
</span>
<span class="entry-comment"><span class="icon-bubbles-4 entry-icon"></span>
    <?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?>
</span>
<?php
    if ( isset($post->geo_query_lat) && isset($post->geo_query_lng) ) {
        $lat = $post->geo_query_lat;
        $lng = $post->geo_query_lng;
        $distance = round($post->geo_query_distance,1) . ' mi';
    } else {
        $metalat = get_post_meta( get_the_ID(), 'cvcf-latitude_dec', true);
        $metalng = get_post_meta( get_the_ID(), 'cvcf-longitude_dec', true);
        if ( ! empty( $metalat ) && ! empty( $metalat ) ) {
            $lat = $metalat;
            $lng = $metalng;
            $distance = 9999;
        }
    }
    if ( isset($lat) && isset($lng) && isset($distance) ) {
        $latlng = round($lat,4) . ',' . round($lng,4);
        echo '<span class="entry-comment"><span class="icon-compass entry-icon"></span>';
        echo "<a href='/cruisersnet-marine-map/?ll=$latlng&amp;z=13&amp;highlight=1'>
        <span class='post-latlng' id='latlng-{$post->ID}'>$latlng</span></a>";
        echo '</span>';
        echo '<span class="entry-comment"><span class="fa fa-arrows-h entry-icon"></span>';
        echo "<span class='post-distance' id='distance-{$post->ID}'>$distance</span>";
        echo '</span>';
    }
?>
</div> <!-- End of entry-meta-box-inner -->
<i class="fa fa-expand fa-2x fa_corner_button" title="Expand the article" aria-hidden="true" onclick="manipArticle(<?php echo get_the_ID(); ?>, event.target)"></i>
<span class="entry-meta-icon"><i class="<?php icon_class(); ?>" style="line-height:inherit;"></i></span>
</div> <!-- End of entry-meta-box -->
</header>
