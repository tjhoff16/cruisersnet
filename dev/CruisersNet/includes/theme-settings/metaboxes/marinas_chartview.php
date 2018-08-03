<?php

function marinachartview_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'cnet_marinas', 'normal', 'high' );
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'cnet_bridges', 'normal', 'high' );
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'cnet_anchorages', 'normal', 'high' );
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'post', 'normal', 'high' );
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'nav_alerts', 'normal', 'high' );
	add_meta_box( 'marinachartview', 'Chartview Information', 'marinachartview_metabox_cb', 'info_icons', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'marinachartview_metabox_add' );

function marinachartview_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);
	
	$mlat = isset( $values['cvcf-latitude_dec'] ) ? esc_attr( $values['cvcf-latitude_dec'][0] ) : '';
	$mlon = isset( $values['cvcf-longitude_dec'] ) ? esc_attr( $values['cvcf-longitude_dec'][0] ) : '';
	$mchartlet = isset( $values['marina_chartlet'] ) ? esc_attr( $values['marina_chartlet'][0] ) : '';
	$mzoom = isset( $values['cvcf-zoomlevel'] ) ? esc_attr( $values['cvcf-zoomlevel'][0] ) : '';
	$msatzoom = isset( $values['cvcf-satzoomlevel'] ) ? esc_attr( $values['cvcf-satzoomlevel'][0] ) : '';
	$mchartletzoom = isset( $values['cvcf-chartletzoomlevel'] ) ? esc_attr( $values['cvcf-chartletzoomlevel'][0] ) : '';
	
	$cvlatdeg = isset( $values['cvcf-lat_deg'] ) ? esc_attr( $values['cvcf-lat_deg'][0] ) : '';
	$cvlatmin = isset( $values['cvcf-lat_min'] ) ? esc_attr( $values['cvcf-lat_min'][0] ) : '';
	$cvlatdir = isset( $values['cvcf-lat_dir'] ) ? esc_attr( $values['cvcf-lat_dir'][0] ) : '';
	
	$cvlondeg = isset( $values['cvcf-lon_deg'] ) ? esc_attr( $values['cvcf-lon_deg'][0] ) : '';
	$cvlonmin = isset( $values['cvcf-lon_min'] ) ? esc_attr( $values['cvcf-lon_min'][0] ) : '';
	$cvlondir = isset( $values['cvcf-lon_dir'] ) ? esc_attr( $values['cvcf-lon_dir'][0] ) : '';
	
	$mhighlight = isset( $values['marina_highlight'] ) ? esc_attr( $values['marina_highlight'][0] ) : '';
	
	if ($mhighlight == 'yes') {
		$mhl = '&highlight=1';
	}

	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		
		<tr>
			<td class="label">Latitude:</td>
			<td>
				Degrees: <input class="cv-deg" type="text" name="cvcf-lat_deg" id="cvcf-lat_deg" value="' . $cvlatdeg . '" /> &nbsp;&nbsp; 
				Minutes: <input class="cv-min" type="text" name="cvcf-lat_min" id="cvcf-lat_min" value="' . $cvlatmin . '" /> &nbsp;&nbsp;
				Direction: <select name="cvcf-lat_dir" id="cvcf-lat_dir"><option value="1" ' . selected($cvlatdir, 1, false) . '>N</option><option value="-1" ' . selected($cvlatdir, -1, false) . '>S</option></select> &nbsp;&nbsp; 
				Decimal: <input type="text" class="cv-convert" name="cvcf-latitude_dec" id="cvcf-latitude_dec" value="' . $mlat . '" /> <div class="refresh-lat"></div> <div class="clear-lat"></div>
			</td>
		</tr>
		
		<tr>
			<td class="label">Longitude:</td>
			<td>
				Degrees: <input class="cv-deg" type="text" name="cvcf-lon_deg" id="cvcf-lon_deg" value="' . $cvlondeg . '" /> &nbsp;&nbsp; 
				Minutes: <input class="cv-min" type="text" name="cvcf-lon_min" id="cvcf-lon_min" value="' . $cvlonmin . '" /> &nbsp;&nbsp;
				Direction: <select name="cvcf-lon_dir" id="cvcf-lon_dir"><option value="-1" ' . selected($cvlondir, -1, false) . '>W</option><option value="1" ' . selected($cvlondir, 1, false) . '>E</option></select> &nbsp;&nbsp; 
				Decimal: <input type="text" class="cv-convert" name="cvcf-longitude_dec" id="cvcf-longitude_dec" value="' . $mlon . '" /> <div class="refresh-lon"></div> <div class="clear-lon"></div>
			</td>
		</tr>
		<tr>
			<td class="label">Chart View Zoom Level:</td>
			<td>
				<input type="text" name="cvcf-zoomlevel" id="cvcf-zoomlevel" value="' . $mzoom . '" />
			</td>
		</tr>
		
		<tr>
			<td class="label">Chartlet Zoom Level:</td>
			<td>
				<input type="text" name="cvcf-chartletzoomlevel" id="cvcf-chartletzoomlevel" value="' . $mchartletzoom . '" />
			</td>
		</tr>
		
		<tr>
			<td class="label">Chartlet Satellite Zoom Level:</td>
			<td>
				<input type="text" name="cvcf-satzoomlevel" id="cvcf-satzoomlevel" value="' . $msatzoom . '" />
			</td>
		</tr>
		<tr>
			<td class="label">Chartlet Image:</td>
			<td><input type="text" name="marina_chartlet" id="marina_chartlet" value="' . $mchartlet . '" /></td>
		</tr>
		<tr>
			<td class="label">Highlight:</td>
			<td><input class="highlight" type="checkbox" name="marina_highlight" id="marina_highlight" value="yes" ' . checked($mhighlight,'yes',false) . ' /></td>
		</tr>
		<tr>
			<td class="label">Charview URL:</td>
			<td><input readonly="readonly" type="text" style="width: 588px;" name="cvlink" id="cvlink" value="' . get_bloginfo('url') . '/cruisersnet-marine-map/?ll=' . $mlat . ',' . $mlon . '&z=' . $mzoom . $mhl . '" /><div class="url-refresh"></div></td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'chartview_metabox_save' );
add_action( 'plugins_loaded', 'chartview_metabox_save' );
function chartview_metabox_save( $post_id ) {
	// bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array(
		'a' => array( // on allow a tags
			'href' => array() // and those anchors can only have href attribute
		)
	);

	// make sure your data is set before trying to save it
	if( isset( $_POST['cvcf-latitude_dec'] ) )
		update_post_meta( $post_id, 'cvcf-latitude_dec', wp_kses( $_POST['cvcf-latitude_dec'], $allowed ) );
	
	if( isset( $_POST['cvcf-longitude_dec'] ) )
		update_post_meta( $post_id, 'cvcf-longitude_dec', wp_kses( $_POST['cvcf-longitude_dec'], $allowed ) );
	
	if( isset( $_POST['marina_chartlet'] ) )
		update_post_meta( $post_id, 'marina_chartlet', wp_kses( $_POST['marina_chartlet'], $allowed ) );
	
	if( isset( $_POST['cvcf-zoomlevel'] ) )
		update_post_meta( $post_id, 'cvcf-zoomlevel', wp_kses( $_POST['cvcf-zoomlevel'], $allowed ) );
		
	if( isset( $_POST['cvcf-satzoomlevel'] ) )
		update_post_meta( $post_id, 'cvcf-satzoomlevel', wp_kses( $_POST['cvcf-satzoomlevel'], $allowed ) );
		
	if( isset( $_POST['cvcf-chartletzoomlevel'] ) )
		update_post_meta( $post_id, 'cvcf-chartletzoomlevel', wp_kses( $_POST['cvcf-chartletzoomlevel'], $allowed ) );
		
	if( isset( $_POST['cvcf-lat_deg'] ) )
		update_post_meta( $post_id, 'cvcf-lat_deg', wp_kses( $_POST['cvcf-lat_deg'], $allowed ) );
	
	if( isset( $_POST['cvcf-lat_min'] ) )
		update_post_meta( $post_id, 'cvcf-lat_min', wp_kses( $_POST['cvcf-lat_min'], $allowed ) );
	
	if( isset( $_POST['cvcf-lat_dir'] ) )
		update_post_meta( $post_id, 'cvcf-lat_dir', wp_kses( $_POST['cvcf-lat_dir'], $allowed ) );
		
	if( isset( $_POST['cvcf-lon_deg'] ) )
		update_post_meta( $post_id, 'cvcf-lon_deg', wp_kses( $_POST['cvcf-lon_deg'], $allowed ) );
	
	if( isset( $_POST['cvcf-lon_min'] ) )
		update_post_meta( $post_id, 'cvcf-lon_min', wp_kses( $_POST['cvcf-lon_min'], $allowed ) );
	
	if( isset( $_POST['cvcf-lon_dir'] ) )
		update_post_meta( $post_id, 'cvcf-lon_dir', wp_kses( $_POST['cvcf-lon_dir'], $allowed ) );
		
	if( isset( $_POST['marina_highlight'] ) )
		update_post_meta( $post_id, 'marina_highlight', wp_kses( $_POST['marina_highlight'], $allowed ) );
	
}

?>