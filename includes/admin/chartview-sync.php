<?php
function register_chartview_sync_page() {
	add_menu_page('Chartview Sync', 'Chartview Sync', 'manage_options', 'chartview-sync', 'render_chartview_sync_page', 'dashicons-controls-repeat', 100);
}
add_action( 'admin_menu', 'register_chartview_sync_page' );

function render_chartview_sync_page() { ?>	
	
	<style type="text/css">
	.link-list li { margin-bottom: 20px; font-size: 19px; line-height: 23px; }
	</style>
	
	<div class="wrap">
		
		<h1>Chartview Sync Options</h1>
		
		<ul class="link-list">
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/alerts2gp.php">Update Alerts</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/anchorages2gp.php">Update Anchorages</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/bridges2gp.php">Update Bridges</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/marinas2gp.php">Update Marinas</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/marinas2gp_fuel.php">Update Fuel Prices</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/problems2gp.php">Update ICW Problem Areas</a></li>
			<li><a target="_blank" href="http://www.cruisersnet.net/charts/info2gp.php">Update Information Icons</a></li>
		</ul>
		
	</div>
	
<?php } ?>