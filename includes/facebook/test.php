<?php
define('ABSPATH', '/var/www/vhosts/cruisersnet.net/httpdocs/');
require(ABSPATH . '/vendor/autoload.php');
require('config.php');
	
// Start Facebook integration	
$fb = new Facebook\Facebook([
  'app_id' => $fb_app_id,
  'app_secret' => $fb_app_secret,
  'default_graph_version' => 'v2.2',
]);

$fb->setDefaultAccessToken($fb_app_token);

//echo '<pre>';
//print_r($fb);
//echo '</pre>';

$fb_post_data = [
  'link' => 'http://www.cruisersnet.net',
  'picture' => 'http://www.cruisersnet.net/images/banners/intracoastalyachtsales.jpg',
  'message' => 'Test Post Content'
];

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/' . $fb_app_endpoint . '/feed', $fb_post_data, $fb_app_token);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graph_node = $response->getGraphNode();

echo 'Posted with id: ' . $graph_node['id'];