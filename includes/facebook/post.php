<?php
// Load Composer Dependencies
require(ABSPATH . '/vendor/autoload.php');
//require_once(ABSPATH . '/wp-content/themes/CruisersNet/includes/facebook/lib/simple_html_dom.php');
//require(ABSPATH . '/wp-content/themes/cruisersnet/includes/facebook/config.php');

// Required Scripts
function cnet_facebook_scripts() {        
    wp_enqueue_script('cnet_facebook_scripts', get_bloginfo('template_directory') . '/includes/facebook/js/admin.js');
    wp_enqueue_style('cnet_facebook_styles', get_bloginfo('template_directory') . '/includes/facebook/css/admin.css');
}
add_action('admin_enqueue_scripts', 'cnet_facebook_scripts');

// Error Handling
function cnet_facebook_error_display($wp_post_id) {
    // TO DO: Need to send admin notices for FB API errors.
}
//add_action('admin_notices', 'cnet_facebook_error_display');

function cnet_facebook_new_post($wp_post_id) {
	
	// Application ID
	$fb_app_id = '544364362317385';
	
	// Application Secret
	$fb_app_secret = 'ccadfafafa61ba7870d3df99d10deac5';
	
	// App Token
	$fb_app_token = 'CAAHvGLRxvkkBAMB0qVfYIZChLKaWAdAaPNXDo05v6QUPDvPUIhbwXhGEtStEN2h71k6T4yZAQpka8qbhYAvNaOQME1nGcvZBS2Om0sAJFLFqvwPMiyvWhtOdZAM2WjtcLw6YlqFqvvIVJedbkDzm1PwXvYTqC9273N0VKuLxK1aPAcJUq0F9';
	
	// API Endpoint
	$fb_app_endpoint = 'cruisersnet';
	
	// Kill this script of it's not a 'post' post_type, or if this is a revision
	if (wp_is_post_revision($wp_post_id) || get_post_type($wp_post_id) != 'post')
		return;
	
	// Kill this script if the post status is not 'publish'
	$post_object = get_post($wp_post_id);
	if ($post_object->post_status != 'publish')
		return;
	
	// Kill this script if we explicitly don't want to post to Facebook
	$post_check = get_field('facebook_post_check', $wp_post_id);
	if (!$post_check)
		return;
	
	// Go ahead and setup the data we want to send to Facebook
	$post_init_type = get_field('facebook_init_type', $wp_post_id);
	$post_title = get_the_title($wp_post_id);
	$post_permalink = get_the_permalink($wp_post_id);
	$post_image = get_field('facebook_image', $wp_post_id);
	$post_image_description = get_field('facebook_image_description', $wp_post_id);
	$post_link_type = get_field('facebook_post_link_type', $wp_post_id);
	$post_link_external_url = get_field('facebook_external_link', $wp_post_id);
	
	$post_content = $post_object->post_content;
	$has_blue_comment = strpos($post_content, 'claiborne-comments');
	
	$post_custom_text = get_field('facebook_custom_post_text', $wp_post_id);
	
	// Setup Post Message
	$post_content_type = get_field('facebook_post_text_type', $wp_post_id);
	if ($post_content_type == 'blue-content' && $has_blue_comment !== false) {
		$html = str_get_html($post_content);
		$text = $html->find('p[class="claiborne-comments"]',0)->plaintext;
		$fb_post_data['message'] = $text;
	} elseif ($post_content_type == 'custom' && $post_custom_text) {
		$fb_post_data['message'] = strip_tags($post_custom_text);
	} else {
		$fb_post_data['message'] = strip_tags(wp_trim_words($post_content, 100)) . '...';
	}
	
	//update_post_meta($wp_post_id, 'facebook_content', $fb_post_data['message']);
	
	
	
	// Setup Post Image & Description
	if ($post_image) {
		// Setup Post Link (links require a photo, so we're setting the link here for photos, otherwise
		// we'll just add the link to the post message.
		if ($post_link_type == 'external' && $post_link_external_url) {
			$fb_post_data['link'] = $post_link_external_url;
		} else {
			$fb_post_data['link'] = $post_permalink;
		}
		
		$fb_post_data['picture'] = $post_image;
		if ($post_image_description) {
			$fb_post_data['description'] = $post_image_description;
		} else {
			$fb_post_data['description'] = $post_content_for_facebook;
		}
	} else {
		if ($post_link_type == 'external' && $post_link_external_url) {
			$link_for_facebook = $post_link_external_url;
		} else {
			$link_for_facebook = $post_permalink;
		}
		$fb_post_data['message'] .= "
		" . $link_for_facebook;
	}
	
	// Initialize Facebook API	
	$fb = new Facebook\Facebook([
	  'app_id' => $fb_app_id,
	  'app_secret' => $fb_app_secret,
	  'default_graph_version' => 'v2.2',
	]);
	
	$fb->setDefaultAccessToken($fb_app_token);

	// Check to see if this post is set to update an existing post. All else creates new FB post.
	$post_saved_fb_id = get_post_meta($wp_post_id, 'facebook_post_id', true);
	if ($post_init_type == 'update' && $post_saved_fb_id) {
		
		// Execute the Graph API Update Post Request
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post('/' . $post_saved_fb_id, $fb_post_data, $fb_app_token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  //echo 'Graph returned an error: ' . $e->getMessage();
		  update_post_meta($wp_post_id, 'facebook_graph_update_error', $e->getMessage());
		  //exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  update_post_meta($wp_post_id, 'facebook_graph_update_error', $e->getMessage());
		  //exit;
		}
		
	} else {
		
		// Execute the Graph API Post Request
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post('/' . $fb_app_endpoint . '/feed', $fb_post_data, $fb_app_token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  update_post_meta($wp_post_id, 'facebook_graph_post_error', $e->getMessage());
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  update_post_meta($wp_post_id, 'facebook_graph_post_error', $e->getMessage());
		  //exit;
		}
		
		$graph_node = $response->getGraphNode();
		
		//echo 'Posted with id: ' . $graph_node['id'];
		
		update_post_meta($wp_post_id, 'facebook_post_id', $graph_node['id']);
		update_post_meta($wp_post_id, 'facebook_graph_node', json_encode($graph_node));
		
	}
	
}
add_action('save_post', 'cnet_facebook_new_post');
