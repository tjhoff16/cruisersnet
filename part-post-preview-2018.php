<?php
    $postID = get_the_ID();  // Must keep this
    $postTitle = get_the_title(); // Must keep this
    $assigned_sponsor = get_field('sponsor_assign_to_post');
    
    preg_match('/<p class="claiborne-comments">(.+)<\/p>/', $post->post_content, $matches, PREG_OFFSET_CAPTURE);
    //
    // If Claiborne's comments not found, try using alternate approach for comment text
    //
    if ( count($matches)==0 ) preg_match('/<span style="color: #0000ff;"><strong>(.+)<\/strong><\/span>/', $post->post_content, $matches, PREG_OFFSET_CAPTURE);
    $claiborneComments = '<p class="claiborne-comments">' . (count($matches)>0 ? $matches[1][0] : '') . '</p>';
    
    if ($assigned_sponsor) echo '<div class="sponsored-listing"><span class="marina-meta-icon" data-icon="&#xe0ce;"></span></div>';
    if ( ! has_post_thumbnail() ) {
         echo '<div class="col-xs-12">';
    } else {
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
        $thumb_url = $thumb_url_array[0];
        echo <<<EOL
<div class="col-xs-3 featured_div">
 <div style="width:100px; height:100px;">
  <img style="max-width: 100%; max-height: 100%;" src="$thumb_url"/>
 </div>
</div>
<div class="col-xs-9" style="max-height:300">
EOL;
    }
    if ( $assigned_sponsor ) echo '<div class="sponsored-listing"><span class="marina-meta-icon" data-icon="&#xe0ce;"></span></div>';
    echo "<h2 class=\"entry-title\"> $postTitle </h2>";
    echo $claiborneComments;
    echo '</div> <!-- End of div class=col-xs-9 or 12 -->';
?>
