<?php

function marinabasic_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'marinabasic', 'Marina Basic Information', 'marinabasic_metabox_cb', 'cnet_marinas', 'normal', 'high' );
	add_meta_box( 'marinabasic', 'Marina Basic Information', 'marinabasic_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'marinabasic_metabox_add' );

function marinabasic_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);
	
	$mphone = isset( $values['marina_phone'] ) ? esc_attr( $values['marina_phone'][0] ) : '';
	$murl = isset( $values['marina_url'] ) ? esc_attr( $values['marina_url'][0] ) : '';
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
	
	$mliveaboard = isset( $values['marina_liveaboard'] ) ? esc_attr( $values['marina_liveaboard'][0] ) : '';
	$mmonthlyrate = isset( $values['marina_monthly_rate'] ) ? esc_attr( $values['marina_monthly_rate'][0] ) : '';
	$mmonthlyratenotes = isset( $values['marina_monthly_rate_notes'] ) ? esc_attr( $values['marina_monthly_rate_notes'][0] ) : '';
	
	$mgallery = isset( $values['marina_gallery'] ) ? esc_attr( $values['marina_gallery'][0] ) : '';
	
	$mfeatured = isset( $values['marina_featured_photo'] ) ? esc_attr( $values['marina_featured_photo'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		<tr>
			<td class="label">Phone Number:</td>
			<td><input type="text" name="marina_phone" id="marina_phone" value="' . $mphone . '" /></td>
		</tr>
		<tr>
			<td class="label">Website:</td>
			<td><input type="text" name="marina_url" id="marina_url" value="' . $murl . '" /></td>
		</tr>
		<tr>
			<td class="label">Sponsor Panel Image:</td>
			<td><input type="text" name="marina_sponsor_graphic" id="marina_sponsor_graphic" value="' . $msponsorgraphic . '" /></td>
		</tr>
		<tr>
			<td class="label">Sponsor Panel URL:</td>
			<td><input type="text" name="marina_sponsor_url" id="marina_sponsor_url" value="' . $msponsorurl . '" /></td>
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
			<td class="label">Liveaboards Allowed:</td>
			<td><input class="mradio" type="radio" name="marina_liveaboard" id="marina_liveaboard" value="yes" ' . checked($mliveaboard,'yes',false) . ' /> yes &nbsp;&nbsp; <input class="mradio" type="radio" name="marina_liveaboard" id="marina_liveaboard" value="no" ' . checked($mliveaboard,'no',false) . ' /> no <br /><br /> Notes: <input class="mlivenotes" type="text" name="marina_liveaboard_notes" id="marina_liveaboard_notes" value="' . $mlivenotes . '" /></td>
		</tr>
		<tr>
			<td class="label">Monthly Dockage Rate:</td>
			<td>
				Rate: &nbsp; <input class="mrate" type="text" name="marina_monthly_rate" id="marina_monthly_rate" value="' . $mmonthlyrate . '" />
				Notes: <input class="mratenotes" type="text" name="marina_monthly_rate_notes" id="marina_monthly_rate_notes" value="' . $mmonthlyratenotes . '" />
			</td>
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
		<tr>
			<td class="label">Featured Photo URL:</td>
			<td><input type="text" name="marina_featured_photo" id="marina_featured_photo" value="' . $mfeatured . '" /></td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'marinabasic_metabox_save' );
add_action( 'plugins_loaded', 'marinabasic_metabox_save' );
function marinabasic_metabox_save( $post_id ) {
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
	if( isset( $_POST['marina_url'] ) )
		update_post_meta( $post_id, 'marina_url', wp_kses( $_POST['marina_url'], $allowed ) );
	if( isset( $_POST['marina_sponsor_graphic'] ) )
		update_post_meta( $post_id, 'marina_sponsor_graphic', wp_kses( $_POST['marina_sponsor_graphic'], $allowed ) );
	if( isset( $_POST['marina_sponsor_url'] ) )
		update_post_meta( $post_id, 'marina_sponsor_url', wp_kses( $_POST['marina_sponsor_url'], $allowed ) );
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
	if( isset( $_POST['marina_liveaboard'] ) )
		update_post_meta( $post_id, 'marina_liveaboard', wp_kses( $_POST['marina_liveaboard'], $allowed ) );
	if( isset( $_POST['marina_monthly_rate'] ) )
		update_post_meta( $post_id, 'marina_monthly_rate', wp_kses( $_POST['marina_monthly_rate'], $allowed ) );
	if( isset( $_POST['marina_monthly_rate_notes'] ) )
		update_post_meta( $post_id, 'marina_monthly_rate_notes', wp_kses( $_POST['marina_monthly_rate_notes'], $allowed ) );
	if( isset( $_POST['marina_featured_photo'] ) )
		update_post_meta( $post_id, 'marina_featured_photo', wp_kses( $_POST['marina_featured_photo'], $allowed ) );
	
}

?>