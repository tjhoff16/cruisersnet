<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="google-site-verification" content="uZWrju0erGbDur7CkYGeUSrqw5JteSCG05V2UBV7A94" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/images/icons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/images/icons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/images/icons/manifest.json">
<link rel="mask-icon" href="/images/icons/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="/images/icons/favicon.ico">
<meta name="apple-itunes-app" content="app-id=964496104, affiliate-data=myAffiliateData, app-argument=myURL">
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="msapplication-TileImage" content="/images/icons/mstile-144x144.png">
<meta name="msapplication-config" content="/images/icons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<script>
window.fbAsyncInit = function() {
    FB.init({
            appId      : '1654303928178383',
            xfbml      : true,
            version    : 'v2.4'
            });
};

(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Begin Lat/Lon Widget Overlay -->
<?php get_template_part('part','widget'); ?>
<!-- End Lat/Lon Widget Overlay -->

<!-- Begin Header -->
<header>


<div class='col-xs-12 head'>

<div class="header-mid col-xs-3">
<img id='logo' src="<?php bloginfo('template_directory'); ?>/images/cnet_logo_2018.png" alt="SSECN Logo" />
<div class="col-xs-6 col-xs-push-2">
<a id="apple_app_link" href="https://itunes.apple.com/ml/app/ssecn/id964496104?mt=8" target="_blank"><img alt="SSECN iOS App" src="https://linkmaker.itunes.apple.com/images/badges/en-us/badge_appstore-lrg.svg" width="150" height="62"/></a>
<a href="https://play.google.com/store/apps/details?id=net.cruisersnet.ssecn.beta&hl=en" target="_blank"><img alt="SSECN Android App" src="/images/google-play-badge.png" width="150" height="62"/></a>
</div>
</div> <!-- /.header-mid -->


<div class="ads_top_row col-xs-9">
<nav id="top-nav" class='header-top col-xs-12'>
<div class="top-nav-wrap">
<?php wp_nav_menu(array('menu'=>'Top Menu','container'=>false,'menu_class'=>'nav nav-pills pull-right','walker'=>new CNet_Top_Nav_Walker)); ?>
</div>
<div class="clear"></div>
</nav>
<!-- /.header-top (desktop/tablet) -->
<div class="col-xs-12 sponsors sponsor-blocker text-center header-low" id="header-low">

<?php get_template_part('part','sponsors'); ?>
</div>
</div>
</div>
</header>

<div id="chartview" style="display:none;">
<button id="chartviewBackButton" class="comment_button" onclick="closeChartview();">Close ChartView</button>
<div class="mapcanvas" id="mapcanvas">
<div id="map"></div>
<div id="placeDetails"></div>
<b>Not for Navigation</b> Google Satellite View will show when Charts are not available at a specific Zoom or Location.
<div class="modal fade" id="uploadRouteFile" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">GPX Route File Upload</h4>
</div>
<div class="modal-body">
<form action="upload.php" method="post" enctype="multipart/form-data">
<input id="fileToUpload" type="file" name="fileToUpload" id="fileToUpload">
<button type="button" class="cnet-button blue cnet-button-small cnet-button-right" onclick="uploadRoute('gpx')" data-dismiss="modal">Upload</button>
<BR>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
</div>
</div>

<!-- End Header -->

