<?php
    $assigned_sponsor = get_field('sponsor_assign_to_post');
    if ($assigned_sponsor) echo '<div class="sponsored-listing"><span class="marina-meta-icon" data-icon="&#xe0ce;"></span></div>';
    echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
    if (get_post_meta($post->ID,'display_in_post',true) == 'enable') get_template_part('part','post-features-2018');
    the_content();
?>
