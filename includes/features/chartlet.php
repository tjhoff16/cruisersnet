<?php $coords = explode(',',$_GET['ll']); ?>
<script type="text/javascript">
// <![CDATA[ 
var lat=<?php echo $coords[0]; ?>;
var lon=<?php echo $coords[1]; ?>; 
var zoom=12; // ]]>
</script>

<link rel="stylesheet" href="/charts/css/earthnc_v3.css" type="text/css" media="screen" />
<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3&key=AIzaSyAFzxALh-sHYXmXE2f4AC8jBmSGD6t5VCA"></script>
<script type='text/javascript' src='/charts/js/jquery.js'></script>
<script src="/charts/js/earthncjs.js" type="text/javascript"></script></script>


<div style="position:relative">
	<div class="chartlet_canvas">
		<div id="map"></div>
	</div>
</div>
