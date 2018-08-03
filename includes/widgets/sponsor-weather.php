<?php

/**
 * Sponsor_Weather widget class
 */
class WP_Widget_Sponsor_Weather extends WP_Widget {
    function WP_Widget_Sponsor_Weather() {
        $widget_ops = array('classname' => 'widget_sponsor_weather', 'description' => __( "Display a weather widget in the sponsors time-zone.", 'sponsor_weather_widget') );
        $this->WP_Widget('sponsor-weather', __('Premium Sponsor: Weather Widget', 'sponsor_weather_widget'), $widget_ops);
    }
 
    function widget($args, $instance) {
        extract($args);
 
        $title = empty($instance['title']) ? __('Premium Sponsor: Weather Widget', 'sponsor_weather_widget') : apply_filters('widget_title', $instance['title']);
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
        	
        	<div style='float: left; width: 240px; height: 420px; background-image: url( http://vortex.accuweather.com/adcbin/netweather_v2/backgrounds/blue_240x420_bg.jpg ); background-repeat: no-repeat; background-color: #346797;' ><div id='NetweatherContainer' style='height: 405px;' ><script src='http://netweather.accuweather.com/adcbin/netweather_v2/netweatherV2ex.asp?partner=netweather&tStyle=whteYell&logo=1&zipcode=<?php echo get_post_meta($postid,'sponsor_zip',true); ?>&lang=&size=12&theme=blue&metric=&target=_self'></script></div><div style='text-align: center; font-family: arial, helvetica, verdana, sans-serif; font-size: 10px; line-height: 15px; color: #FFFFFF;' ><a style='font-size: 10px; color: #FFFFFF' href='http://www.accuweather.com/us///-999/city-weather-forecast.asp?partner=accuweather' >Weather Forecast</a>Ê|Ê<a style='color: #FFFFFF' href='http://www.accuweather.com/maps-satellite.asp' >Weather Maps</a>Ê|Ê<a style='color: #FFFFFF' href='http://www.accuweather.com/index-radar.asp?partner=accuweather&zipcode=<?php echo get_post_meta($postid,'sponsor_zip',true); ?>' >Weather Radar</a></div></div>
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
function registerSponsorWeatherWidget() {
    register_widget('WP_Widget_Sponsor_Weather');
}
add_action('widgets_init', 'registerSponsorWeatherWidget');

?>