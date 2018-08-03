<?php

/**
 * Sponsor_Contact widget class
 */
class WP_Widget_Sponsor_Contact extends WP_Widget {
    function WP_Widget_Sponsor_Contact() {
        $widget_ops = array('classname' => 'widget_sponsor_contact', 'description' => __( "Display the contact and location information for premium sponsors.", 'sponsor_contact_widget') );
        $this->WP_Widget('sponsor-contact', __('Premium Sponsor: Contact & Location Info', 'sponsor_contact_widget'), $widget_ops);
    }
 
    function widget($args, $instance) {
        extract($args);
 
        $title = empty($instance['title']) ? __('Contact & Location Info', 'sponsor_contact_widget') : apply_filters('widget_title', $instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 10;
        else if ( $number < 1 )
            $number = 1;
        else if ( $number > 15 )
            $number = 15;
 
        $queryArgs = array(
            'showposts'         => 1,
            'post_type'      => 'sponsors',
            'nopaging'          => 0,
            'post_status'       => 'publish',
            'caller_get_posts'  => 1,
        );
 
        $r = new WP_Query($queryArgs);
        if ($r->have_posts()) :
    ?>
        <?php echo $before_widget; ?>
        <?php echo $before_title . $title . $after_title; ?>
        <ul>
        <?php  while ($r->have_posts()) : $r->the_post(); ?>
        <li>
        	<?php 
        	global $wp_query; 
        	$postid = $wp_query->post->ID;
        	?>
        	<p>Phone: <?php echo get_post_meta($postid,'sponsor_phone',true); ?></p>
        	<p>Address:<br />
        	<?php echo get_post_meta($postid,'sponsor_street_address',true); ?><br />
        	<?php echo get_post_meta($postid,'sponsor_city',true); ?>, 
        	<?php echo get_post_meta($postid,'sponsor_state',true); ?> 
        	<?php echo get_post_meta($postid,'sponsor_zip',true); ?></p>
        	<p>
        		<?php if ( has_post_thumbnail() ) { 
  					echo get_the_post_thumbnail($postid, array(240,240));
				} ?>
			</p>
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
    
    function form( $instance ) {
        $title = attribute_escape($instance['title']);
        if ( !$number = (int) $instance['number'] )
            $number = 5;
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title:'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
 
    <?php
    }
}
function registerSponsorContactWidget() {
    register_widget('WP_Widget_Sponsor_Contact');
}
add_action('widgets_init', 'registerSponsorContactWidget');

?>