<!-- Close Article and Comment Button DIV -->
<div class="col-xs-12 row-no-padding">
<div class="col-xs-3 row-no-padding">
<?php if ( $post->post_type==='cnet_marinas' && get_post_meta($post->ID,'marina_gallery',true) ) : ?>
<a class="post-button-link" href="<?php echo get_post_meta($post->ID,'marina_gallery',true); ?>"><div class="post-button button-full gallery-button">
<div style=" float: left; width: 30px; height: 30px; margin: -5px 0 0 0; background: url(/dev/images/gallery-button-bg.png) no-repeat;"></div>PHOTO GALLERY</div></a>
<?php endif; ?>
</div>
<ul class="col-xs-6 socials-link row-no-padding>" style="margin:0; background-color: transparent;">
<li class="socials-link" style="width:80px; list-style:none; background-color: transparent;">
<h4>SHARE:</h4></li>
<li class="socials-link social-icon facebook-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="Facebook" target="_blank"><span class="icon-facebook social-icon" aria-hidden="true"></span></a>
</li>
<li class="socials-link social-icon twitter-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="http://twitter.com/home?status=<?php the_title(); ?>:+<?php the_permalink(); ?>" title="Twitter" target="_blank"><span class="social-icon icon-twitter" aria-hidden="true"></span></a>
</li>
<li class="socials-link social-icon google-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" title="Google" target="_blank"><span class="social-icon icon-google-plus" aria-hidden="true"></span></a>
</li>
<li class="socials-link social-icon linkedin-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php the_excerpt(); ?>&amp;source=Cruiser%26%23039%3Bs+Net" title="Linkedin" target="_blank"><span class="social-icon icon-linkedin" aria-hidden="true"></span></a>
</li>
<li class="socials-link social-icon pinterest-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=&amp;description=<?php the_title(); ?>" title="Pinterest" target="_blank"><span class="social-icon icon-pinterest" aria-hidden="true"></span></a>
</li>
<li class="socials-link social-icon facebook-icon" style="width:40px; list-style:none; background-color: transparent;">
<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_excerpt(); ?>" title="Email" target="_self"><span class="social-icon icon-envelope" aria-hidden="true"></span></a>
</li>
</ul>
<div class="col-xs-3 row-no-padding">
<button class="comment_button" onclick="openComment(<?php echo get_the_ID(); ?>)">Add Comment</button>
</div>
</div>
<!-- END OF Close Article and Comment Button DIV -->
<div id="<?php echo $commentID; ?>" class="col-xs-12 dialog_newsletter_div" style="display:none;"> </div>
<?php
    comments_template();
?>

