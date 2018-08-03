<?php $coords = explode(',',$_GET['ll']); ?>
<script type="text/javascript">
// <![CDATA[ 
var lat=<?php echo $coords[0]; ?>;
var lon=<?php echo $coords[1]; ?>; 
var zoom=12; // ]]>
</script>

<link rel="stylesheet" href="http://cruisersnet.net/charts/css/earthnc_v3.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=false"></script>
<script src="http://earthnc.com/chartviewer/js/jquery.js" type="text/javascript"></script>
<script src="http://cruisersnet.net/charts/js/earthncjs.js" type="text/javascript"></script></script>


<div style="position:relative">
	<div class="chartlet_canvas">
		<div id="map"></div>
	</div>
</div>