<?php
// custom font icons for article lists
function icon_class() {
	global $post;
	$post_type = get_post_type();
	if ('cnet_marinas' == $post_type) {
		if (get_post_meta($post->ID,'marina_sponsor_graphic',true) != '') {
			$class = 'fa fa-star-half-o';
		} else {
			$class = 'fa fa-file-text-o';	
		}
	} elseif ('cnet_anchorages' == $post_type) {
		$class = 'fa fa-file-text-o';
	} elseif ('cnet_bridges' == $post_type) {
		$class = 'fa fa-file-text-o';
	} elseif ('nav_alerts' == $post_type) {
		$class = 'fa fa-file-text-o';
	} elseif ('info_icons' == $post_type) {
		$class = 'fa fa-file-text-o';
	} elseif ('post' == $post_type) {
		$class = 'fa fa-file-text-o';
	} else {
		$class = 'fa fa-file-text-o';	
	}
	echo $class;
}


if ( ! function_exists( 'twentyfourteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function twentyfourteen_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr;', 'cnet' ),
		'next_text' => __( '&rarr;', 'cnet' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- /.pagination -->
	</nav><!-- /.navigation -->
	<?php
	endif;
}
endif;


/**
 * 
 * Display service icons
 *
 */
function service_icons($pid) { 

	$customField = get_post_custom_values('mcf-transient-dock',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="transient-dock" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-transient-dock-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-20-30',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-20-30-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-20-30-50',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-20-30-50-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-30',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-30-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-50',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-50-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-30-50',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-30-50-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-power-30-50-100',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="power" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-power-30-50-100-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-fresh-water',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="fresh-water" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-fresh-water-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-shower',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="showers" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-shower-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-laundry',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="laundry" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-laundry-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-food',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="food" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-food-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-gas',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="gas" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-gas-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-diesel',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="diesel" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-diesel-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-propane-ng',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="propane/natural gas" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-propane-ng-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-waste',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="waste" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-waste-v3.png" />'; 
	} 

	$customField = get_post_custom_values('mcf-wifi',$pid); 
	if ($customField[0] != '') {
		echo '<img class="marina-services" alt="wifi" src="http://www.cruisersnet.net/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/mcf-wifi-v3.png" />'; 
	} 
} 