<?php get_header();  ?>
<!--                                -->
<!-- Template Name: Chart View Page -->
<!--                                -->
<!-- Begin Content                  -->
	<div class="container main-wrap">
        <section class="single-wrapper">
            <header class="entry-header">
                <div class="primary-options hidden-xs">
                    <a href="<?php bloginfo('url'); ?>"><div class="cnet-button blue cnet-button-small cnet-button-right">SSECN Home Page</div></a>
                    <a href="javascript:history.go(-1)"><div class="cnet-button blue cnet-button-small cnet-button-right">Previous Page</div></a>
                </div>
                <h2 class="entry-title" style="color:#00266;"><?php the_title(); ?></h2>
            </header>
        </section>
    </div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.5/css/weather-icons.min.css">
<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css"> -->
<!-- Custom styles -->
<link rel="stylesheet" href="/charts/css/earthnc_v3.css"  media="screen" type="text/css" />
<link rel="stylesheet" href="/charts/weather/css/weather.css">

<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3&amp;key=AIzaSyC7d-LKrHTDVMoWoeDdDBCHOjElj3d1MuE&libraries=geometry,weather"></script>
<!-- JQUERY LOADED ELSEWHERE -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script> -->

<!-- For Tide Charting -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://openlayers.org/api/OpenLayers.js"></script>
<script src="https://openweathermap.org/js/OWM.OpenLayers.1.3.4.js"></script>

<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnhydro.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnutils.js?ver=2"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnchartview.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/markerwithlabel.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnrouting.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnwaterways.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecncookie.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecntide.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/wmsMapType.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/suncalc.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/ssecnweatheroverlay.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/zoomTMSLayer.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/weather/js/skycons.js?ver=1"></script>

<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/heatmap/build/heatmap.min.js?ver=1"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/charts/js/heatmap/plugins/gmaps-heatmap.js?ver=1"></script>

<a id="download" download="CanvasDemo.png">Download as image</a>

    <div class="mapcanvas">
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
                    <button type="button" class="cnet-button blue cnet-button-small cnet-button-right" onclick="uploadRoute('gpx')" data-dismiss="modal">Upload</button><BR>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
    </div>
	<div class="container main-wrap">
        <section class="single-wrapper">
            <?php get_template_part('part','social'); ?>
        </section>
    </div>
	<!-- End Content -->
<?php get_footer(); ?>
