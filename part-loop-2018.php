<?php
    // $bg = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : '');
    $bg_post = (get_field('background_color') ? 'post-bg-'.get_field('background_color') : 'post-bg-normal');
    $bg_alert = ( in_category('icw-problem-areas')  ? ' post-bg-blue'   : ''        );
    $bg_alert = ( get_post_type() == 'nav_alerts'   ? ' post-bg-yellow' : $bg_alert );
    $bg = $bg_post.$bg_alert;
    $postID = get_the_ID();  // Must keep this
    $postTitle = get_the_title(); // Must keep this
    //
    //  Unique Stuff For Post Types
    //
    $postType = $post->post_type;
    if ( $postType === 'cnet_marinas' ) {
        $label_terms = wp_get_post_terms($post->ID,'cnet_marina_settings',array('fields'=>'names'));
        if ( ! empty($label_terms) || $label_terms[0]=='Not A Marina (Fuel Only)' ) return;
    } else {
        $assigned_sponsor = get_field('sponsor_assign_to_post');
    }
    ?>


<li <?php post_class($bg); ?> >
<article class="article-no-thumb clearfix">
<div class="entry-content">

<?php
    get_template_part('part','article-header-2018');
    
    if ( ! empty($label_terms)) { // the label terms are not empty, meaning we want to display differenty 
        if ( get_field('label_disclaimer') == 'enable' ) the_field('disclaimer_text');
    }
    //
    //  PREVIEW STUFF
    //
    $isDisclaimer = strpos(get_the_content(), '#disclaimer') !== false ? TRUE : FALSE;
    $outputFullOnly = $isDisclaimer || $wp_query->post_count==1;
    if ( ! $outputFullOnly ) {
        echo '<!-- PREVIEW DIV -->';
        echo "\n<div id=\"preview-$postID\" class=\"preview\">\n";
        get_template_part('part', $postType=='cnet_marinas' ? 'marina-preview-2018' : 'post-preview-2018');
        echo '</div><!-- END OF PREVIEW DIV -->';
    }
    //
    //  FULL ARTICLE STUFF
    //
    echo '<!-- FULL ARTICLE DIV -->';
    if ( $wp_query->post_count==1 ) echo '<div><button class="comment_button" onclick="goBack();">Back</button></div>';
    $fullStyle = $outputFullOnly ? 'display:block;' : 'display:none;';
    echo "\n<div id=\"fullarticle-$postID\" class=\"full-article\" style=\"$fullStyle\">\n";
    get_template_part('part', $postType=='cnet_marinas' ? 'marina-full-2018' : 'post-full-2018');
    if ( ! $isDisclaimer ) {
        get_template_part('part','full-bottom-buttons-2018');
        get_template_part('part','comments-2018');
    }
    echo '<!-- END OF FULL ARTICLE DIV -->';
    ?>
</div><!-- End of entry-content -->
</article>
</li>
