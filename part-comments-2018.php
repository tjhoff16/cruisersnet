<?php
    if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die(__('Please do not load this page directly. Thanks!', 'cnet'));
    
    $commentArgs = ['post_id' => $post->ID, // use post_id, not post_ID
    'count' => false //return only the count
    ];
    $comments = get_comments($commentArgs);
    // if ( have_comments() ) {
        echo '<div id="comments"><h3>';
        if ( $post->post_type=='cnet_marinas')
            comments_number(__('Be the first to review this marina!', 'cnet'),
                    __('Reviews from the Cruisers\' Net Community (1)', 'cnet'),
                    __('Reviews from the Cruisers\' Net Community (%)', 'cnet'));

        else
            comments_number(__('Be the first to comment on this article!', 'cnet'),
                    __('Comments from the Cruisers\' Net Community (1)', 'cnet'),
                    __('Comments from the Cruisers\' Net Community (%)', 'cnet'));
        echo '</h3>';
        echo '<ol class="comments-list clearfix">';
        wp_list_comments(['walker' => null,
                         'style' => 'ul',
                         'callback' => 'kopa_comment_callback',
                         'end-callback' => null,
                         'type' => 'all'
                         ], $comments);
        echo '</ol>';
        echo '<center class="pagination kopa-comment-pagination">';
        paginate_comments_links();
        echo '</center>';
        echo '</div>';
    // }
    if ( ! function_exists('kopa_comment_callback') )   {
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
        </div><!--comment-body -->
    </article>
</li>

<?php
    }
    }
?>
