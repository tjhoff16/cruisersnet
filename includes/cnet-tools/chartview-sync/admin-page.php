<?php
function render_chartview_sync_page() { ?>	
	
	<style type="text/css">
	.link-list li { margin-bottom: 20px; font-size: 19px; line-height: 23px; }
	</style>
	
	<div class="wrap">
		
		<h1>Chartview Sync Options</h1>
		
		<ul class="link-list">
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=alert">Update Alerts</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=anchorage">Update Anchorages</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=bridge">Update Bridges</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=marina">Update Marinas</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=fuel">Update Fuel Prices</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=problems">Update ICW Problem Areas</a></li>
			<li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=information">Update Information Icons</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=lntm">Update LNTM</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=wxbuoy">Update Weather Buoys</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=tidestation">Update Tide Stations</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=currentstation">Update Current Stations</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=noaa">Update NOAA Weather Stations</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=expired">Update Expired Posts</a></li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=load_llnr">Update LLNRs</a></li>
            <li> &nbsp; </li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=all">Update ALL</a></li>
            <li> &nbsp; </li>
            <li><a target="_blank" href="/charts/php/UpdateDB/chartviewSync.php?categories=datacheck&validate=all&age=2&types=post&ID=all&&feedback">Validate Database</a></li>
		</ul>
		
	</div>
	
<?php }
function register_chartview_sync_page() {
	add_submenu_page('contributions-search', 'Chartview Sync', 'Chartview Sync', 'manage_options', 'chartview-sync', 'render_chartview_sync_page', 'dashicons-controls-repeat', 100);
}
add_action('admin_menu', 'register_chartview_sync_page');
