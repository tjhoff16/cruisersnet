<?php
    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) die(__('Please do not load this page directly. Thanks!', 'cnet'));
    if ( post_password_required() || ! comments_open() ) return;
    
    if ( ! function_exists('kopa_comment_callback') ) {
        function kopa_comment_callback($comment, $args, $depth) {
            $GLOBALS['comment'] = $comment;
            ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<article id="comment-<?php comment_ID(); ?>" class="comment-wrap clearfix">
<div class="comment-avatar">
<?php echo get_avatar($comment->comment_author_email, 90); ?>
</div>
<div class="comment-body clearfix">
<div class="comment-meta">
<span class="author"><?php comment_author_link(); ?></span>
<span class="date">-&nbsp;&nbsp;<?php comment_time(get_option('date_format') . ' - ' . get_option('time_format')); ?></span>
</div><!-- end:comment-meta -->
<div><?php comment_text(true); ?></div>

<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
<?php edit_comment_link(__('Edit', 'cnet')) ?>

<!-- <a href="#" class="comment-reply-link small-button green-button">Reply</a> -->
</div><!--comment-body -->
</article>
</li>

<?php
    }  // End of function kopa_comment_callback($comment, $args, $depth)
    }  // End of  if ( ! function_exists('kopa_comment_callback') )
    if ( ! function_exists('kopa_comment_form_args') ) {
        function kopa_comment_form_args() {
            global $user_identity;
            $commenter = wp_get_current_commenter();
            
            $fields = array(
                            'author' => '<div class="clear"></div><div class="comment-left">
                            <p class="input-block">
                            <label class="required" for="comment_name" >' . __("Name <span>(required):</span>", 'cnet') . '</label>
                            <input type="text" name="author" id="comment_name"
                            value="' . esc_attr($commenter['comment_author']) . '">
                            </p>',
                            'email' => '
                            <p class="input-block">
                            <label for="comment_email" class="required">' . __("Email <span>(required):</span>", 'cnet') . '</label>
                            <input type="email" name="email" id="comment_email"
                            value="' . esc_attr($commenter['comment_author_email']) . '" >
                            </p>',
                            'url' => '
                            <p class="input-block">
                            <label for="comment_url" class="required">' . __("Website", 'cnet') . '</label>
                            <input type="url" name="url" id="comment_url"
                            value="' . esc_attr($commenter['comment_author_url']) . '" >
                            </p></div>'
                            );
            
            $comment_field = '<div class="comment-right"><p class="textarea-block">
            <label class="required" for="comment_message">' . __('Message <span>(required):</span>', 'cnet') . '</label>
                <textarea name="comment" id="comment_message"></textarea>
                </p></div><div class="clear"></div>';
                
                $args = array(
                              'fields' => apply_filters('comment_form_default_fields', $fields),
                              'comment_field' => $comment_field,
                              'must_log_in' => '<p class="alert">' . sprintf(__('You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'cnet'), wp_login_url(get_permalink())) . '</p><!-- .alert -->',
                              'logged_in_as' => '<p class="log-in-out">' . sprintf(__('You are currently logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'cnet'), admin_url('profile.php'), esc_attr($user_identity)) . ' <a href="' . wp_logout_url(get_permalink()) . '" title="' . esc_attr__('Log out of this account', 'cnet') . '">' . __('Log out &raquo;', 'cnet') . '</a></p><!-- .log-in-out -->',
                              'comment_notes_before' => '<span class="c-note">' . __('Your email address will not be published. Required fields are marked <span>(required)</span>. All "Comments/Reviews" submitted to the Salty Southeast Cruisers\' Net are reviewed by our editorial staff before being published.<br /><br />', 'cnet') . '</span>',
                              'comment_notes_after' => '',
                              'id_form' => 'comments-form',
                              'id_submit' => 'submit-comment',
                              'title_reply' => __('Add your comment to this discussion:', 'cnet'),
                              'title_reply_to' => __('Reply', 'cnet'),
                              'cancel_reply_link' => __('Cancel', 'cnet'),
                              'label_submit' => __('Submit', 'cnet'),
                              );
            
            return $args;
        }
    }
    ?>


<?php if (have_comments()) : ?>
<div id="comments">
<h3>
<?php comments_number(__('Be the first to comment on this article!', 'cnet'), __('Comments from the Cruisers\' Net Community (1)', 'cnet'), __('Comments from the Cruisers\' Net Community (%)', 'cnet')); ?>
</h3>
<ol class="comments-list clearfix">
<?php
    wp_list_comments(array(
                           'walker' => null,
                           'style' => 'ul',
                           'callback' => 'kopa_comment_callback',
                           'end-callback' => null,
                           'type' => 'all'
                           ));
    ?>
</ol>
<center class="pagination kopa-comment-pagination"><?php paginate_comments_links(); ?></center>
</div>
<?php // comment_form(kopa_comment_form_args()); ?>
<?php endif; ?>

