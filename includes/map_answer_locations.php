<?php
    $path = $_SERVER['DOCUMENT_ROOT'] . '/charts/php/includes/db_v3.php';
    if ( ! file_exists($path) ) $path='/var/www/vhosts/cruisersnet.net/httpdocs/charts/php/includes/db_v3.php';
    include_once($path);
    $Locs = array(); // Array of results IP, Lat/Lon (string, comma separated)
    if ( isset($dbCharts) ) {
        if ( $result = mysqli_query($dbCharts, 'SELECT DISTINCT IP FROM Answers') ) {
            while ($row = mysqli_fetch_assoc($result)) {
                $details = json_decode(file_get_contents('http://ipinfo.io/'.$row['IP'].'/json'));
                $latlon = explode(",", $details->loc);
                $Locs[]=array("ip"=>$row['IP'], "lat"=>(float)$latlon[0], "lon"=>(float)$latlon[1] );
            }
        }
    }
    //var_dump($Locs);
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Map</title>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
<style>
/* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
#map_canvas {
height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
height: 100%;
margin: 0;
padding: 0;
}
</style>
</head>
<body>
<!-- Begin Constant Contact Inline Form Code -->
<div id="signupDiv" class="ctct-inline-form" data-form-id="911257e5-f6b9-4044-86bf-92e5eabf26a5"></div>
<!-- End Constant Contact Inline Form Code -->
<div id="map_canvas"></div>
<script type='text/javascript' src='/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='/wp-includes/js/jquery/jquery-migrate.js?ver=1.4.1'></script>
<script>
var mutationObserver = new MutationObserver(function(mutations) {
                                            var formElement = document.getElementById("ctct_form_0");
                                            if ( formElement != null && formElement.style.display == "none" ) {
                                                mutationObserver.disconnect();
                                                setTimeout(function() { document.getElementById("signupDiv").style.display="none"; }, 2000);
                                            }
                                            });
mutationObserver.observe(document.documentElement, {
                         attributes: true,
                         characterData: false,
                         childList: false,
                         subtree: true,
                         attributeOldValue: true,
                         characterDataOldValue: false
                         });
// Takes all changes which haven’t been fired so far.
//var changes = mutationObserver.takeRecords();
// Stops the MutationObserver from listening for changes.
//mutationObserver.disconnect();

var map;
function initMap() {
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(35.2271,-80.8431),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    
    var infowindow =  new google.maps.InfoWindow({
                                                 content: ''
                                                 });
    
    var jArray= <?php echo json_encode($Locs ); ?>;
    for(var i=0; i<jArray.length; i++){
        var pt = jArray[i];
        var marker = new google.maps.Marker( {
                                            position: new google.maps.LatLng( pt['lat'],pt['lon'] ),
                                            map: map,
                                            title: pt['ip']
                                            } );
        // add an event listener for this marker
        var infohtml = "<p>" + pt['ip'] + "</p>";
        bindInfoWindow(marker, map, infowindow, infohtml);
        marker.addListener('mouseover', function(infohtml) {
                           infowindow.setContent(infohtml);
                           infowindow.open(map, this);
                           });
        // assuming you also want to hide the infowindow when user mouses-out
        marker.addListener('mouseout', function() {
                           infowindow.close();
                           });
    }
}
function bindInfoWindow(marker, map, infowindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
                                  infowindow.setContent(html);
                                  infowindow.open(map, marker);
                                  });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFzxALh-sHYXmXE2f4AC8jBmSGD6t5VCA&callback=initMap" async defer></script>
</body>
<footer>
<!-- Begin Constant Contact Active Forms -->
<script> var _ctct_m = "702562fd485569797bdd7327ee122cd8"; </script>
<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>
<!-- End Constant Contact Active Forms -->
</footer>
</html>

