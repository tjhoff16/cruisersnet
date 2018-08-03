<?php
    $lat  = 0;
    $lon  = 0;
    if ( isset($_GET['ll']) ) {
        $latlng = explode(',',$_GET['ll']);
        if ( count($latlng)==2 ) {
            if ( is_numeric($latlng[0]) && is_numeric($latlng[1]) ) {
                $lat  = $latlng[0];
                $lon  = $latlng[1];
            }
        }
    }
    $output = isset($_GET['output']) ? $_GET['output'] : 'no-output';
    $map    = isset($_GET['map'])    ? $_GET['map']    : 'no-map';
    $zoom   = isset($_GET['z']) && is_numeric($_GET['z']) ? $_GET['z'] : 12;
    $pID    = isset($_GET['post'])   ? $_GET['post']   : 'no-post';
    // To Test: https://cruisersnet-dev.net/wp-content/themes/CruisersNet/includes/features/chartlet-2018.php?ll=35.9005,-76.0083&z=14&amp;output=embed&amp;post=171291
?>
<html>
<head>
<style>
#map{width:100%;height:100%;border:2px solid #0090DF;}
.chartlet_canvas #map{width:100% !important;height:100% !important;}
</style>
<script defer type="text/javascript">
var lat=<?php echo $lat; ?>;
var lon=<?php echo $lon; ?>;
var zoom=<?php echo $zoom; ?>;
</script>
<script defer type='text/javascript' src="https://maps.google.com/maps/api/js?v=3&key=AIzaSyAFzxALh-sHYXmXE2f4AC8jBmSGD6t5VCA"></script>
<script defer type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script defer type='text/javascript' src="/charts/js/earthncjs.min.js" ></script>
</head>
<body>
<div style="position:relative">
<div class="chartlet_canvas">
<div id="map"></div>
</div>
</div>
</body>
</html>

