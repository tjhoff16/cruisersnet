<?php

function marinabasic_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'marinabasic', 'Marina Basic Information', 'marinabasic_metabox_cb', 'cnet_marinas', 'normal', 'high' );
	//add_meta_box( 'marinabasic', 'Marina Basic Information', 'marinabasic_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'marinabasic_metabox_add' );

function marinabasic_metabox_cb($post) {
	
	global $post, $wpdb;
	
	$values = get_post_custom($post->ID);
	
	$mphone = isset( $values['marina_phone'] ) ? esc_attr( $values['marina_phone'][0] ) : '';
	$murl = isset( $values['marina_url'] ) ? esc_attr( $values['marina_url'][0] ) : '';
    
    $mfax = isset( $values['marina_fax'] ) ? esc_attr( $values['marina_fax'][0] ) : '';
    $memail = isset( $values['marina_email'] ) ? esc_attr( $values['marina_email'][0] ) : '';
	$maddress1 = isset( $values['marina_address1'] ) ? esc_attr( $values['marina_address1'][0] ) : '';
    $maddress2 = isset( $values['marina_address2'] ) ? esc_attr( $values['marina_address2'][0] ) : '';
    $mcity = isset( $values['marina_city'] ) ? esc_attr( $values['marina_city'][0] ) : '';
    $mstate = isset( $values['marina_state'] ) ? esc_attr( $values['marina_state'][0] ) : '';
    $mzipcode = isset( $values['marina_zipcode'] ) ? esc_attr( $values['marina_zipcode'][0] ) : '';
    
    $mvhfmonitored = isset( $values['marina_vhf_monitored'] ) ? esc_attr( $values['marina_vhf_monitored'][0] ) : '';
    $mvhfworking = isset( $values['marina_vhf_working'] ) ? esc_attr( $values['marina_vhf_working'][0] ) : '';
    $mgm = isset( $values['marina_gm'] ) ? esc_attr( $values['marina_gm'][0] ) : '';
    $mdockmaster = isset( $values['marina_dockmaster'] ) ? esc_attr( $values['marina_dockmaster'][0] ) : '';

    $msponsoradid = isset( $values['marina_sponsor_ad_id'] ) ? esc_attr( $values['marina_sponsor_ad_id'][0] ) : '';
    
    $msponsorgraphic = isset( $values['marina_sponsor_graphic'] ) ? esc_attr( $values['marina_sponsor_graphic'][0] ) : '';
	$msponsorurl = isset( $values['marina_sponsor_url'] ) ? esc_attr( $values['marina_sponsor_url'][0] ) : '';
	$mstatutemile = isset( $values['marina_statute_mile'] ) ? esc_attr( $values['marina_statute_mile'][0] ) : '';
	$mlocation = isset( $values['marina_location'] ) ? esc_attr( $values['marina_location'][0] ) : '';
	$mdepthmin = isset( $values['marina_depth_min'] ) ? esc_attr( $values['marina_depth_min'][0] ) : '';
	$mdepthmax = isset( $values['marina_depths_max'] ) ? esc_attr( $values['marina_depths_max'][0] ) : '';
	$mprovisioning = isset( $values['marina_provisioning'] ) ? esc_attr( $values['marina_provisioning'][0] ) : '';
	$mnavdetail = isset( $values['marina_nav_detail'] ) ? esc_attr( $values['marina_nav_detail'][0] ) : '';
	$mclaibornereview = isset( $values['marina_claiborne_review'] ) ? esc_attr( $values['marina_claiborne_review'][0] ) : '';
	$mnavdetail = isset( $values['marina_nav_detail'] ) ? esc_attr( $values['marina_nav_detail'][0] ) : '';
	$mrest = isset( $values['marina_rest'] ) ? esc_attr( $values['marina_rest'][0] ) : '';
	$mrestreqs = isset( $values['marina_restreqs'] ) ? esc_attr( $values['marina_restreqs'][0] ) : '';
	
	$mgallery = isset( $values['marina_gallery'] ) ? esc_attr( $values['marina_gallery'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    
    //
    //  Generate banner options
    //
    $query_active = "SELECT * FROM wp_adrotate WHERE type='active' ORDER BY title ";
    
    $activebanners = $wpdb->get_results($query_active);

    $bannercode = "";
    $bannerhref = "";
    $bannerimage = "";
    $banneroptions = "<select name='marina_sponsor_ad_id'>\n";
    $banneroptions .= "<option value=''>- Not A Sponsor -</option>\n";
    $strippedbannercode="";
    $strippedbannercode_decoded="";
    if ( $activebanners ) {
        foreach($activebanners as $banner) {
            $bannerid=$banner->id;
            $bannertitle=html_entity_decode($banner->title);
            $grouplist = function_exists(adrotate_ad_is_in_groups) ? adrotate_ad_is_in_groups($banner->id) : "";
            $selected="";
            if ( $bannerid==$msponsoradid ) {
                $selected = "selected";
                $bannercode=$banner->bannercode;
                $strippedbannercode = stripcslashes($bannercode);
                $strippedbannercode_decoded = htmlspecialchars_decode($strippedbannercode);
                // Extract href from banner code
                $href="";
                preg_match_all('/<a[^>]+href=([\'"])(.+?)\1[^>]*>/i', $strippedbannercode_decoded, $result);
                if ( ! empty($result) ) $href=$result[2][0];
                $bannerhref=filter_var($href, FILTER_SANITIZE_URL); // Remove all illegal characters from a url
                
                $src="";
                preg_match_all('/src="([^"]*)"/i', $strippedbannercode_decoded, $result2);
                if ( ! empty($result2) ) $src=$result2[1][0];
                $bannerimage=filter_var($src, FILTER_SANITIZE_URL); // Remove all illegal characters from a url
                
            }
            $banneroptions .= "<option $selected value='$bannerid'>$bannerid: $bannertitle / $grouplist</option>\n";
        }
    }
    $banneroptions .= "</select>\n";
    
    $stateoptions = '
    <select name="marina_state">
    <option value="">Select State</option>
    <option value="AL">Alabama</option>
    <option value="AK">Alaska</option>
    <option value="AZ">Arizona</option>
    <option value="AR">Arkansas</option>
    <option value="CA">California</option>
    <option value="CO">Colorado</option>
    <option value="CT">Connecticut</option>
    <option value="DE">Delaware</option>
    <option value="DC">District Of Columbia</option>
    <option value="FL">Florida</option>
    <option value="GA">Georgia</option>
    <option value="HI">Hawaii</option>
    <option value="ID">Idaho</option>
    <option value="IL">Illinois</option>
    <option value="IN">Indiana</option>
    <option value="IA">Iowa</option>
    <option value="KS">Kansas</option>
    <option value="KY">Kentucky</option>
    <option value="LA">Louisiana</option>
    <option value="ME">Maine</option>
    <option value="MD">Maryland</option>
    <option value="MA">Massachusetts</option>
    <option value="MI">Michigan</option>
    <option value="MN">Minnesota</option>
    <option value="MS">Mississippi</option>
    <option value="MO">Missouri</option>
    <option value="MT">Montana</option>
    <option value="NE">Nebraska</option>
    <option value="NV">Nevada</option>
    <option value="NH">New Hampshire</option>
    <option value="NJ">New Jersey</option>
    <option value="NM">New Mexico</option>
    <option value="NY">New York</option>
    <option value="NC">North Carolina</option>
    <option value="ND">North Dakota</option>
    <option value="OH">Ohio</option>
    <option value="OK">Oklahoma</option>
    <option value="OR">Oregon</option>
    <option value="PA">Pennsylvania</option>
    <option value="RI">Rhode Island</option>
    <option value="SC">South Carolina</option>
    <option value="SD">South Dakota</option>
    <option value="TN">Tennessee</option>
    <option value="TX">Texas</option>
    <option value="UT">Utah</option>
    <option value="VT">Vermont</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
    </select>
    ';
    $findState = '"' . $mstate . '"';
    $replaceState = '"' . $mstate . '" selected';
    $stateoptions = str_replace($findState, $replaceState, $stateoptions);

    /*  REMOVED 07/29/16
     <tr>
     <td class="label">Sponsor Panel Image:</td>
     <td><input type="text" name="marina_sponsor_graphic" id="marina_sponsor_graphic" value="' . $msponsorgraphic . '" /></td>
     </tr>
     <tr>
     <td class="label">Sponsor Panel URL:</td>
     <td>' . $msponsorurl . '</td>
     </tr>
     */
    echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="label">VHF:</td>
            <td>
                Working:
                <input type="text" style="width: 100px;" name="marina_vhf_monitored" id="marina_vhf_monitored" placeholder="Monitored" value="' . $mvhfmonitored . '" />
                &nbsp;&nbsp;Working:
                <input type="text" style="width: 100px;" name="marina_vhf_working"   id="marina_vhf_working"   placeholder="Working"   value="' . $mvhfworking . '" />
            </td>
        </tr>
		<tr>
			<td class="label">Phone Numbers:</td>
			<td>
                 <input type="text" style="width: 200px;" name="marina_phone" id="marina_phone" placeholder="Phone Number" value="' . $mphone . '" />
                 &nbsp;&nbsp;Fax:
                 <input type="text" style="width: 200px;" name="marina_fax"   id="marina_fax"   placeholder="Fax Number"   value="' . $mfax . '" />
            </td>
		</tr>
        <tr>
            <td class="label">Contacts:</td>
            <td>
            General Manager:
            <input type="text" style="width: 200px;" name="marina_gm" id="marina_gm" placeholder="General Manager" value="' . $mgm . '" />
            &nbsp;&nbsp;Dockmaster:
            <input type="text" style="width: 200px;" name="marina_dockmaster"   id="marina_dockmaster"   placeholder="Dockmaster"   value="' . $mdockmaster . '" />
            </td>
    </tr>
       <tr>
            <td class="label">Address:</td>
            <td>
                <input type="text"                       name="marina_address1" id="marina_address1" placeholder="Address line 1" value="' . $maddress1 . '" /><BR>
                <input type="text"                       name="marina_address2" id="marina_address2" placeholder="Address line 2" value="' . $maddress2 . '" /><BR>
                <input type="text" style="width: 300px;" name="marina_city"     id="marina_city"     placeholder="City"           value="' . $mcity     . '" />&nbsp;&nbsp;
                ' . $stateoptions . '&nbsp;&nbsp;
                <input type="text" style="width: 100px;" name="marina_zipcode"  id="marina_zipcode"  placeholder="Zip Code"       value="' . $mzipcode  . '" />
            </td>
        </tr>
		<tr>
			<td class="label">Website:</td>
			<td><input type="text" name="marina_url" id="marina_url" placeholder="Marina website" value="' . $murl . '" /></td>
		</tr>
        <tr>
            <td class="label">EMail:</td>
            <td><input type="text" name="marina_email" id="marina_email" placeholder="Email address" value="' . $memail . '" /></td>
        </tr>
        <tr>
            <td class="label">Sponsor Panel Ad:<BR>Image:<BR>URL:<BR>Link:</td>
            <td>' . $banneroptions . '<BR>' . $bannerimage . '<BR>' . $msponsorurl . '<BR>' . $bannerhref . '</td>
        </tr>
        <tr>
            <td class="label">Sponsor Panel Image:</td>
            <td>' . $strippedbannercode_decoded . '</td>
        </tr>
		<tr>
			<td class="label">Statute Mile:</td>
			<td><input type="text" name="marina_statute_mile" id="marina_statute_mile" value="' . $mstatutemile . '" /></td>
		</tr>
		<tr>
			<td class="label">Location Description:</td>
			<td><input type="text" name="marina_location" id="marina_location" value="' . $mlocation . '" /></td>
		</tr>
		<tr>
			<td class="label">Depth:</td>
			<td><input class="mdepth" type="text" name="marina_depth_min" id="marina_depths_min" value="' . $mdepthmin . '" /> &nbsp; to &nbsp <input class="mdepth" type="text" name="marina_depth_max" id="marina_depth_max" value="' . $mdepthmax .'" /></td>
		</tr>
		<tr>
			<td class="label">Provisioning:</td>
			<td><input type="text" name="marina_provisioning" id="marina_provisioning" value="' . $mprovisioning . '" /></td>
		</tr>
		<tr>
			<td class="label">Restaurant:</td>
			<td><input type="text" name="marina_rest" id="marina_rest" value="' . $mrest . '" /></td>
		</tr>
		<tr>
			<td class="label">Restaurant Recommendations:</td>
			<td><input type="text" name="marina_restreqs" id="marina_restreqs" value="' . $mrestreqs . '" /></td>
		</tr>
		<tr>
			<td class="label">Navigational Detail URL:</td>
			<td><input type="text" name="marina_nav_detail" id="marina_nav_detail" value="' . $mnavdetail . '" /></td>
		</tr>
		<tr>
			<td class="label">Claiborne\'s Review URL:</td>
			<td><input type="text" name="marina_claiborne_review" id="marina_claiborne_review" value="' . $mclaibornereview . '" /></td>
		</tr>
		<tr>
			<td class="label">Photo Gallery URL:</td>
			<td><input type="text" name="marina_gallery" id="marina_gallery" value="' . $mgallery . '" /></td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'marinabasic_metabox_save' );
add_action( 'plugins_loaded', 'marinabasic_metabox_save' );
function marinabasic_metabox_save( $post_id ) {
    global $wpdb;
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
	if( isset( $_POST['marina_phone'] ) )
		update_post_meta( $post_id, 'marina_phone', wp_kses( $_POST['marina_phone'], $allowed ) );
    
    if( isset( $_POST['marina_fax'] ) )
        update_post_meta( $post_id, 'marina_fax', wp_kses( $_POST['marina_fax'], $allowed ) );
    
	if( isset( $_POST['marina_url'] ) )
		update_post_meta( $post_id, 'marina_url', wp_kses( $_POST['marina_url'], $allowed ) );
    
    if( isset( $_POST['marina_vhf_monitored'] ) )
        update_post_meta( $post_id, 'marina_vhf_monitored', wp_kses( $_POST['marina_vhf_monitored'], $allowed ) );
    if( isset( $_POST['marina_vhf_working'] ) )
        update_post_meta( $post_id, 'marina_vhf_working', wp_kses( $_POST['marina_vhf_working'], $allowed ) );
    if( isset( $_POST['marina_gm'] ) )
        update_post_meta( $post_id, 'marina_gm', wp_kses( $_POST['marina_gm'], $allowed ) );
    if( isset( $_POST['marina_vhf_working'] ) )
        update_post_meta( $post_id, 'marina_dockmaster', wp_kses( $_POST['marina_dockmaster'], $allowed ) );
    
    if( isset( $_POST['marina_email'] ) )
        update_post_meta( $post_id, 'marina_email', wp_kses( $_POST['marina_email'], $allowed ) );
    
    if( isset( $_POST['marina_address1'] ) )
        update_post_meta( $post_id, 'marina_address1', wp_kses( $_POST['marina_address1'], $allowed ) );
    if( isset( $_POST['marina_address2'] ) )
        update_post_meta( $post_id, 'marina_address2', wp_kses( $_POST['marina_address2'], $allowed ) );
    if( isset( $_POST['marina_city'] ) )
        update_post_meta( $post_id, 'marina_city', wp_kses( $_POST['marina_city'], $allowed ) );
    if( isset( $_POST['marina_state'] ) )
        update_post_meta( $post_id, 'marina_state', wp_kses( $_POST['marina_state'], $allowed ) );
    if( isset( $_POST['marina_zipcode'] ) )
        update_post_meta( $post_id, 'marina_zipcode', wp_kses( $_POST['marina_zipcode'], $allowed ) );
    
	//if( isset( $_POST['marina_sponsor_graphic'] ) )
	//	update_post_meta( $post_id, 'marina_sponsor_graphic', wp_kses( $_POST['marina_sponsor_graphic'], $allowed ) );
    
	//if( isset( $_POST['marina_sponsor_url'] ) )
	//	update_post_meta( $post_id, 'marina_sponsor_url', wp_kses( $_POST['marina_sponsor_url'], $allowed ) );
    
    $eraseSponsor = true;
    if( isset( $_POST['marina_sponsor_ad_id'] ) ) {
        $adID = trim( $_POST['marina_sponsor_ad_id'] );
        if ( $adID != ''  && is_numeric($adID) ) {
            $eraseSponsor=false;
            update_post_meta( $post_id, 'marina_sponsor_ad_id', wp_kses( $adID, $allowed ) );
            update_post_meta( $post_id, 'marina_sponsor_url',   wp_kses( 'http://cruisersnet.net/wp-content/plugins/adrotate/adrotate-out.php?trackerid='.$adID, $allowed ) );
            $query_active = "SELECT * FROM wp_adrotate WHERE type='active' ORDER BY title ";
            $activebanners = $wpdb->get_results($query_active);
            if ( $activebanners ) {
                foreach($activebanners as $banner) {
                    $bannerid=$banner->id;
                    if ( $bannerid==$adID ) {
                        $bannercode=$banner->bannercode;
                        // Extract link from banner code
                        $strippedbannercode = stripcslashes($bannercode);
                        $strippedbannercode_decoded = htmlspecialchars_decode($strippedbannercode);
                        $src="";
                        preg_match_all('/src="([^"]*)"/i', $strippedbannercode_decoded, $result2);
                        if ( ! empty($result2) ) $src=$result2[1][0];
                        update_post_meta( $post_id, 'marina_sponsor_graphic', wp_kses( $src, $allowed ) );
                    }
                }
            }
        }
    }
    if ( $eraseSponsor ) {
        update_post_meta( $post_id, 'marina_sponsor_ad_id',   wp_kses( '', $allowed ) );
        update_post_meta( $post_id, 'marina_sponsor_url',     wp_kses( '', $allowed ) );
        update_post_meta( $post_id, 'marina_sponsor_graphic', wp_kses( '', $allowed ) );
    }
    
	if( isset( $_POST['marina_statute_mile'] ) )
		update_post_meta( $post_id, 'marina_statute_mile', wp_kses( $_POST['marina_statute_mile'], $allowed ) );
	if( isset( $_POST['marina_location'] ) )
		update_post_meta( $post_id, 'marina_location', wp_kses( $_POST['marina_location'], $allowed ) );
	if( isset( $_POST['marina_depth_min'] ) )
		update_post_meta( $post_id, 'marina_depth_min', wp_kses( $_POST['marina_depth_min'], $allowed ) );
	if( isset( $_POST['marina_depth_max'] ) )
		update_post_meta( $post_id, 'marina_depth_max', wp_kses( $_POST['marina_depth_max'], $allowed ) );
	if( isset( $_POST['marina_provisioning'] ) )
		update_post_meta( $post_id, 'marina_provisioning', wp_kses( $_POST['marina_provisioning'], $allowed ) );
	if( isset( $_POST['marina_nav_detail'] ) )
		update_post_meta( $post_id, 'marina_nav_detail', wp_kses( $_POST['marina_nav_detail'], $allowed ) );
	if( isset( $_POST['marina_claiborne_review'] ) )
		update_post_meta( $post_id, 'marina_claiborne_review', wp_kses( $_POST['marina_claiborne_review'], $allowed ) );
	if( isset( $_POST['marina_restreqs'] ) )
		update_post_meta( $post_id, 'marina_restreqs', wp_kses( $_POST['marina_restreqs'], $allowed ) );
	if( isset( $_POST['marina_rest'] ) )
		update_post_meta( $post_id, 'marina_rest', wp_kses( $_POST['marina_rest'], $allowed ) );
	if( isset( $_POST['marina_gallery'] ) )
		update_post_meta( $post_id, 'marina_gallery', wp_kses( $_POST['marina_gallery'], $allowed ) );
	
}

?>
