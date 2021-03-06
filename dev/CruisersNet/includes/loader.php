<?php
/* ------------------------------------------------------------------
 * NOTES:
 *
 * All the includes below are required to manage the all custom
 * custom data for Cruisers' Net. Some of these are legacy, and
 * we'll try to phase them out over time. Just brining them over
 * for now to make sure we don't accidentally leave something out.
 *
 * --------------------------------------------------------------- */

// load required custom post type items
require_once('theme-settings/required/marinas_req.php');
require_once('theme-settings/required/anchorages_req.php');
require_once('theme-settings/required/bridges_req.php');
require_once('theme-settings/required/alerts_req.php');
require_once('theme-settings/required/info_req.php');
require_once('theme-settings/required/statute_miles_req.php');
require_once('theme-settings/required/brokers_req.php');
require_once('theme-settings/required/sponsors_req.php');

// load custom metaboxes
require_once('theme-settings/metaboxes/marinas_basic.php');
require_once('theme-settings/metaboxes/anchorages_basic.php');
require_once('theme-settings/metaboxes/bridges_basic.php');
require_once('theme-settings/metaboxes/marinas_services.php');
require_once('theme-settings/metaboxes/marinas_fuel.php');
require_once('theme-settings/metaboxes/marinas_chartview.php');

// load other theme settings
require_once('theme-settings/menus.php');
require_once('theme-settings/sidebars.php');
require_once('theme-settings/misc.php');

// load custom menu walkers
require_once('theme-settings/menu-walkers.php');

// legacy (we need to clean these up, decide what can go in ACF or be removed)
//require_once('theme-settings/legacy/legacy-slideshow.php');


// custom admin head stylesheet
function cnet_admin_styles() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/includes/theme-settings/inc/css/admin.css" />';
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/includes/theme-settings/inc/css/datepicker.css" />';
	echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/includes/theme-settings/inc/js/jquery.datepicker.js"></script>';
	echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/includes/theme-settings/inc/js/coords.js"></script>';
	echo '
	<script type="text/javascript">
	jQuery(function() {
		jQuery( "#datepicker" ).datepicker({ dateFormat: "MM d, yy" });
	});
	</script>
	';
}
add_action('admin_head', 'cnet_admin_styles');

// attach the built-in category taxonomy to our custom post types
function cpt_cats() {
    register_taxonomy_for_object_type('category', 'cnet_marinas');
    register_taxonomy_for_object_type('category', 'cnet_anchorages');
    register_taxonomy_for_object_type('category', 'cnet_bridges');
    register_taxonomy_for_object_type('category', 'nav_alerts');
}
add_action('init', 'cpt_cats');

