<?php

/**
 * Photo_Week widget class
 */
class WP_Widget_Photo_Week extends WP_Widget {
    function WP_Widget_Photo_Week() {
        $widget_ops = array('classname' => 'widget_photo_week', 'description' => __( "Display a Photo of the Week widget.", 'photo_week_widget') );
        $this->WP_Widget('photo-week', __('Photo of the Week', 'photo_week_widget'), $widget_ops);
    }
 
    function widget($args, $instance) {
        extract($args);
 
        $title = empty($instance['title']) ? __('Photo of the Week', 'photo_week_widget') : apply_filters('widget_title', $instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 10;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 15 )
            $number = 15;
 
        $queryArgsPhoto = array(
            'showposts'         => $number,
            'post_type'      => 'posts',
            'post_status'       => 'publish',
            'category_name'		=> 'photo-of-the-week',
            'posts_per_page'	=> 1
        );
 
        $r = new WP_Query($queryArgsPhoto);
        if ($r->have_posts()) :
    ?>
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <ul>
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        <li>
        	<?php $thepostid = get_the_ID(); ?>
        	<div id="winner1">
				<a href="<?php bloginfo('url'); ?>/category/photo-of-the-week/"><img alt="<?php the_title(); ?>" src="<?php echo get_post_meta($thepostid,'photo_thumbnail',true); ?>" width="118" height="108" /></a>
			</div>
			<div id="winner_info1">
				<h2>"<?php the_title(); ?>"</h2>
				<span>by: <?php echo get_post_meta($thepostid,'photo_author',true); ?></span>
			</div>
			<div style="clear: both; height: 10px;">&nbsp;</div>
		</li>
        <?php endwhile; ?>
        </ul>
        <?php echo $after_widget; ?>
    <?php
        endif;
        wp_reset_query();  // Restore global post data stomped by the_post().
    }
 
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
 
        return $instance;
    }

}
function registerPhotoWeekWidget() {
    register_widget('WP_Widget_Photo_Week');
}
add_action('widgets_init', 'registerPhotoWeekWidget');

?>