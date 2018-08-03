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
	$mzoom = isset( $values['cvcf-zoomlevel'] ) ? esc_attr( $values['cvcf-zoomlevel'][0] ) : '14';
	$msatzoom = isset( $values['cvcf-satzoomlevel'] ) ? esc_attr( $values['cvcf-satzoomlevel'][0] ) : '14';
	$mchartletzoom = isset( $values['cvcf-chartletzoomlevel'] ) ? esc_attr( $values['cvcf-chartletzoomlevel'][0] ) : '14';
	
	$cvlatdeg = isset( $values['cvcf-lat_deg'] ) ? esc_attr( $values['cvcf-lat_deg'][0] ) : '';
	$cvlatmin = isset( $values['cvcf-lat_min'] ) ? esc_attr( $values['cvcf-lat_min'][0] ) : '';
	$cvlatdir = isset( $values['cvcf-lat_dir'] ) ? esc_attr( $values['cvcf-lat_dir'][0] ) : '';
	
	$cvlondeg = isset( $values['cvcf-lon_deg'] ) ? esc_attr( $values['cvcf-lon_deg'][0] ) : '';
	$cvlonmin = isset( $values['cvcf-lon_min'] ) ? esc_attr( $values['cvcf-lon_min'][0] ) : '';
	$cvlondir = isset( $values['cvcf-lon_dir'] ) ? esc_attr( $values['cvcf-lon_dir'][0] ) : '';
	
	$mhighlight = isset( $values['marina_highlight'] ) ? esc_attr( $values['marina_highlight'][0] ) : '';
    $mhl = $mhighlight == 'yes' ? '&highlight=1' : '';
	
	$display = isset( $values['display_in_post'] ) ? esc_attr( $values['display_in_post'][0] ) : 'disable';
	$style = isset( $values['chartlet_style'] ) ? esc_attr( $values['chartlet_style'][0] ) : '';
	$height = isset( $values['chartlet_height'] ) ? esc_attr( $values['chartlet_height'][0] ) : '';
	$width = isset( $values['chartlet_width'] ) ? esc_attr( $values['chartlet_width'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    
    $chartlet_display = 'display: none;';
    $chartlet_url = '/images/chartlets/' . $post->ID . 'chartlet.jpg';
    if ( $mlat!=='' && $mlon!=='' && $mzoom!=='' ) $chartlet_display = 'display: block;';
    
    $si_type  = isset( $values['social_image_type'] )  ? esc_attr( $values['social_image_type'][0] )  : '';
    $si_ad_id = isset( $values['social_image_ad_id'] ) ? esc_attr( $values['social_image_ad_id'][0] ) : '';
    $si_media_library_id = isset( $values['social_image_media_library_id'] ) ? esc_attr( $values['social_image_media_library_id'][0] ) : '';
    $si_upload_file      = isset( $values['social_image_upload_file'] )      ? esc_attr( $values['social_image_upload_file'][0] )      : '';
    // Default Values
    $protocol = 'http';
    $host = 'CruisersNet.net';
    if ( isset($_SERVER['HTTPS']) )       $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    if ( isset($_SERVER['HTTP_HOST']) )   $host     =  $_SERVER['HTTP_HOST'];
    $start =  $protocol . "://" . $host;
    echo " $start ";
    // echo " $mlat : $mlon : $mzoom : $chartlet_display : $chartlet_url ";
    // echo " $si_type : $fb_none_checked : $fb_small_checked : $fb_large_checked : $fb_image_url : $fb_display";
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="label">LNM Search:</td>
            <td>
                <select class="cv-district" type="text" name="district_text" id="district_text">
                    <option value="5">5: DE,VA,NC</option>
                    <option value="7">7: SC,GA,FL</option>
                    <option value="8">8: Gulf Coast</option>
                </select> &nbsp;&nbsp;
                LLNR:     <input class="cv-llnr"     type="text" name="llnr_text"     id="llnr_text"     placeholder=""/> &nbsp;&nbsp;
                <input readonly="readonly" class="cv-llnrdesc" type="text" name="llnr_desc"     id="llnr_desc"     placeholder=""/>
            </td>
            <td><div class="convert-llnr"> </div></td>
            <td><div class="clear-llnr"></div></td>
        </tr>
        <tr>
            <td class="label">LNM Lat/Lon Conversion:</td>
            <td>
                LNM Format: <input class="cv-lnm" type="text" name="lnm_text" id="lnm_text" placeholder="??-??-??.???N/???-??-??.???W"/> &nbsp; ==> &nbsp;
                Decimal:    <input type="text" class="cv-lnmdec" name="lnm_dec"  id="lnm_dec"    />
    
            <td><div class="convert-lnm"></div></td>
            <td><div class="clear-lnm"></div></td>
        </tr>
    
		<tr>
			<td class="label">Latitude:</td>
			<td>
				Degrees: <input class="cv-deg" type="text" name="cvcf-lat_deg" id="cvcf-lat_deg" value="' . $cvlatdeg . '" /> &nbsp;&nbsp; 
				Minutes: <input class="cv-min" type="text" name="cvcf-lat_min" id="cvcf-lat_min" value="' . $cvlatmin . '" /> &nbsp;&nbsp;
				Direction: <select name="cvcf-lat_dir" id="cvcf-lat_dir"><option value="1" ' . selected($cvlatdir, 1, false) . '>N</option><option value="-1" ' . selected($cvlatdir, -1, false) . '>S</option></select> &nbsp;&nbsp; 
				Decimal: <input type="text" class="cv-convert" name="cvcf-latitude_dec" id="cvcf-latitude_dec" value="' . $mlat . '" />
			</td>
            <td><div class="refresh-lat"></div></td>
            <td><div class="clear-lat"></div></td>
		</tr>
		
		<tr>
			<td class="label">Longitude:</td>
			<td>
				Degrees: <input class="cv-deg" type="text" name="cvcf-lon_deg" id="cvcf-lon_deg" value="' . $cvlondeg . '" /> &nbsp;&nbsp; 
				Minutes: <input class="cv-min" type="text" name="cvcf-lon_min" id="cvcf-lon_min" value="' . $cvlonmin . '" /> &nbsp;&nbsp;
				Direction: <select name="cvcf-lon_dir" id="cvcf-lon_dir"><option value="-1" ' . selected($cvlondir, -1, false) . '>W</option><option value="1" ' . selected($cvlondir, 1, false) . '>E</option></select> &nbsp;&nbsp; 
				Decimal: <input type="text" class="cv-convert" name="cvcf-longitude_dec" id="cvcf-longitude_dec" value="' . $mlon . '" />
			</td>
            <td><div class="refresh-lon"></div></td>
            <td><div class="clear-lon"></div></td>
		</tr>
		<tr>
			<td class="label">Chart View Zoom Level:</td>
			<td>
				<input class="zoom-level-entry" type="text" name="cvcf-zoomlevel" id="cvcf-zoomlevel" value="' . $mzoom . '" />
			</td>
		</tr>
		
		<tr>
			<td class="label">Chartlet Zoom Level:</td>
			<td>
				<input class="zoom-level-entry" type="text" name="cvcf-chartletzoomlevel" id="cvcf-chartletzoomlevel" value="' . $mchartletzoom . '" />
			</td>
		</tr>
		
		<tr>
			<td class="label">Chartlet Satellite Zoom Level:</td>
			<td>
				<input class="zoom-level-entry" type="text" name="cvcf-satzoomlevel" id="cvcf-satzoomlevel" value="' . $msatzoom . '" />
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
			<td><input readonly="readonly" type="text" style="width: 588px;" name="cvlink" id="cvlink" value="' . get_bloginfo('url') . '/cruisersnet-marine-map/?ll=' . $mlat . ',' . $mlon . '&z=' . $mzoom . $mhl . '" /></td>
            <td><div class="url-refresh"></div></td>
		</tr>
        <tr>
            <td></td>
            <td><a href="' . $chartlet_url . '" id="chartlet_image_url" target="_blank"><img id="chartlet_image" name="chartlet_image" src="' . $chartlet_url . '"  alt="Loading ..." style="' . $chartlet_display . '" /></a> </td>
        </tr>
    
		<tr id="chartlet-display">
			<td class="label">Display Chartlet in Post:</td>
			<td>
				Enable <input class="chartlet-enable" type="radio" name="display_in_post" value="enable" '.checked($display,'enable',false).' /> &nbsp; &nbsp; &nbsp;	
				Disable <input class="chartlet-disable" type="radio" name="display_in_post" value="disable"'.checked($display,'disable',false).' />
			</td>
		</tr>
		<tr id="chartlet-style" class="chartlet-option">
			<td class="label">Chartlet Style:</td>
			<td>
				Chartview <input type="radio" name="chartlet_style" value="chartview" '.checked($style,'chartview',false).' /> &nbsp; &nbsp; &nbsp;
				Hybrid <input type="radio" name="chartlet_style" value="hybrid" '.checked($style,'hybrid',false).' />
			</td>
		</tr>
		<tr class="chartlet-option">
			<td class="label">Chartlet Width:&nbsp;&nbsp;<input type="text" name="chartlet_width" value="' . $width . '" /></td>
			<td></td>
		</tr>
		<tr class="chartlet-option">
			<td class="label">Chartlet Height:&nbsp;&nbsp;<input type="text" name="chartlet_height" value="' . $height . '" /></td>
			<td></td>
		</tr>
    
        <tr id="facebook-image-options">
        <td class="label">Facebook Featured Image</td>
            <td>
                <table style="vertical-align: middle;">
                    <tr style="vertical-align: middle;">
                        <td>None         <input class="fb-none"          type="radio" id="facebook_none"           name="facebook_chartlet" value="none"    '.checked($si_type,'none',   false).' /> </td>
                        <td>Chartlet:</td>
                        <td>Small        <input class="fb-charlet-small" type="radio" id="facebook_chartlet_small" name="facebook_chartlet" value="small"   '.checked($si_type,'small',  false).' /> </td>
                        <td>Large        <input class="fb-charlet-large" type="radio" id="facebook_chartlet_large" name="facebook_chartlet" value="large"   '.checked($si_type,'large',  false).' /> </td>
                    </tr>';

//  Note - have issues using jpg type here!
$images=array('Blank.png'       => 'Blank Image',
              'Alert.png'       => 'Alert Symbol',
              'Problem.png'     => 'Problem Symbol',
              'WeatherBuoy.png' => 'Weather Buoy',
              'NOAA.png'        => 'NOAA',
              'Gas.png'         => 'Gasoline',
              'Diesel.png'      => 'Diesel Fuel',
              'CoastGuard.png'  => 'Coast Guard',
              'CruisersNet.png' => 'Cruisers Net'
              );

$count=0;
$array_keys = array_keys($images);
$last_image = end($array_keys);
foreach ($images as $image=>$imagetext) {
    $path_parts = pathinfo($image);
    $image_lc = strtolower($path_parts['filename']);
    if ( $count++==0 ) echo str_repeat(' ',5).'<tr style="vertical-align: middle;">'."\n";
    echo str_repeat(' ',10).'<td><img src="/images/FeaturedImages/'.$image.'" style="padding:1px;border:thin solid silver;width:50px;height:50px;">'."\n";
    echo str_repeat(' ',10).'    <input class="fb-'.$image_lc.'"   type="radio" id="facebook_'.$image_lc.'"    name="facebook_chartlet" value="'.$image.'"'.checked($si_type,$image,false).' /> <br><span style="font-size: 8px;">' . $imagetext . '</span></td>' . "\n";
    if ( $count==8 || $image == $last_image) {
        $count=0;
        echo str_repeat(' ',8)."</tr>\n";
    }
}
    $url_post_for_facebook = 'http%3A%2F%2Fcruisersnet-dev.net%2F%3Fp%3D'.$post->ID;
    
echo '        <tr style="vertical-align: middle;">
                        <td>
                            Banner <input class="fb-adrotate" type="radio" id="facebook_adrotate" name="facebook_chartlet" value="adrotate"'.checked($si_type,'adrotate',false).' />
                        </td>
                        <td>
                            <div id="type_rotate_id" style="' . display_item($si_type,'adrotate',false) . '">ID:<input class="cv-ad_id" type="text" name="ad_id_text" id="ad_id_text" value="' . $si_ad_id . '" /></div>
                        </td>
                        <td>
                            <div class="refresh-ad_id" id="adrotate_refresh" style="' . display_item($si_type,'adrotate',false) . '"></div>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <td>
                            Upload <input class="fb-upload" type="radio" id="facebook_upload" name="facebook_chartlet" value="upload_file"'.checked($si_type,'upload',false).' />
                        </td>
                        <td  colspan="5">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <input type="file" id="upload_file" style="' . display_item($si_type,'upload_file',false) . '">
                            </form>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <td colspan="2">
                            Media Library <input class="fb-media-library" type="radio" id="facebook_media-library" name="facebook_chartlet" value="media-library"'.checked($si_type,'media-library',false).' />
                        </td>
                        <td  colspan="3">
                            <div id="type_media-library_select" style="' . display_item($si_type,'media-library',false) . '">
                                <a href="#" id="add-feature-image-from-media-library">Select</a>
                            </div>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <td  colspan="8">
                            <img id="loading_gif" src="/images/loading.gif" style="display: none;"/>
                            <span id="msg" style="color:red; width: 400px;"></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="label">Facebook Links/Tools</td>
            <td>
                <a href="https://developers.facebook.com/tools/debug/sharing/?q='.$url_post_for_facebook.'" target="_blank">
                    <div class="cnet-button cnet-button-full blue">View / Debug</div> </a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://developers.facebook.com/tools/debug/sharing/batch/?q='.$url_post_for_facebook.'" target="_blank">
                    <div class="cnet-button cnet-button-full blue"> Invalidator</div> </a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="https://www.facebook.com/pg/cruisersnet/posts/" target="_blank">
                    <div class="cnet-button cnet-button-full blue"> Cruisers&#39; Net Facebook Page</div> </a>
            </td>
        </tr>
    </table>
	';
    }
    
    function display_item($display, $current, $echo) {
        $result = (string) $display === (string) $current ? 'display: block;' : 'display: none;';
        if ( $echo ) echo $result;
        return $result;
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
	
	if( isset( $_POST['display_in_post'] ) )
		update_post_meta( $post_id, 'display_in_post', wp_kses( $_POST['display_in_post'], $allowed ) );
		
	if( isset( $_POST['chartlet_style'] ) )
		update_post_meta( $post_id, 'chartlet_style', wp_kses( $_POST['chartlet_style'], $allowed ) );
		
	if( isset( $_POST['chartlet_height'] ) )
		update_post_meta( $post_id, 'chartlet_height', wp_kses( $_POST['chartlet_height'], $allowed ) );
		
	if( isset( $_POST['chartlet_width'] ) )
		update_post_meta( $post_id, 'chartlet_width', wp_kses( $_POST['chartlet_width'], $allowed ) );
    /*
    if( isset( $_POST['facebook_chartlet'] ) ) {
        $si_type = $_POST['facebook_chartlet'] ;
        update_post_meta( $post_id, 'si_type', wp_kses( $si_type, $allowed ) );
        if ( $si_type=='none') {
            delete_post_meta($post_id, 'social_image');
        } else {
            $image_url = $start . '/images/chartlets/' . $post_id . $si_type . '.jpg';
            update_post_meta( $post_id, 'social_image', wp_kses( $image_url, $allowed ) );
        }
    }
	*/
	update_post_meta( $post_id, 'marina_highlight', wp_kses( $_POST['marina_highlight'], $allowed ) );
	
}

?>
