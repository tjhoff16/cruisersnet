<?php

function anchoragebasic_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'anchoragebasic', 'Anchorage Basic Information', 'anchoragebasic_metabox_cb', 'cnet_anchorages', 'normal', 'high' );
	add_meta_box( 'anchoragebasic', 'Anchorage Basic Information', 'anchoragebasic_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'anchoragebasic_metabox_add' );

function anchoragebasic_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);

	$aholding = isset( $values['anchorage_holding_ground_eval'] ) ? esc_attr( $values['anchorage_holding_ground_eval'][0] ) : '';
	$aswing = isset( $values['anchorage_swing_room'] ) ? esc_attr( $values['anchorage_swing_room'][0] ) : '';
	$afoul = isset( $values['anchorage_foul_weather'] ) ? esc_attr( $values['anchorage_foul_weather'][0] ) : '';
	$adinghy = isset( $values['anchorage_dinghy'] ) ? esc_attr( $values['anchorage_dinghy'][0] ) : '';
	$awaste = isset( $values['anchorage_waste'] ) ? esc_attr( $values['anchorage_waste'][0] ) : '';
	$apets = isset( $values['anchorage_pets'] ) ? esc_attr( $values['anchorage_pets'][0] ) : '';
	$astatutemile = isset( $values['anchorage_statute_mile'] ) ? esc_attr( $values['anchorage_statute_mile'][0] ) : '';
	$alocation = isset( $values['anchorage_location'] ) ? esc_attr( $values['anchorage_location'][0] ) : '';
	$adepths = isset( $values['anchorage_depths'] ) ? esc_attr( $values['anchorage_depths'][0] ) : '';
	$aprovisioning = isset( $values['anchorage_provisioning'] ) ? esc_attr( $values['anchorage_provisioning'][0] ) : '';
	$anavdetail = isset( $values['anchorage_nav_details'] ) ? esc_attr( $values['anchorage_nav_details'][0] ) : '';
	$aclaibornereview = isset( $values['anchorage_claiborne_review'] ) ? esc_attr( $values['anchorage_claiborne_review'][0] ) : '';
	$arating = isset( $values['anchorage_rating'] ) ? esc_attr( $values['anchorage_rating'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		
		<tr>
			<td class="label">Statute Mile:</td>
			<td><input type="text" name="anchorage_statute_mile" id="anchorage_statute_mile" value="' . $astatutemile . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Location Description:</td>
			<td><input type="text" name="anchorage_location" id="anchorage_location" value="' . $alocation . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Depths:</td>
			<td><input type="text" name="anchorage_depths" id="anchorage_depths" value="' . $adepths . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Navigational Detail URL:</td>
			<td><input type="text" name="anchorage_nav_details" id="anchorage_nav_details" value="' . $anavdetail . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Swing Room:</td>
			<td><input type="text" name="anchorage_swing_room" id="anchorage_swing_room" value="' . $aswing . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Holding Ground Eval:</td>
			<td><input type="text" name="anchorage_holding_ground_eval" id="anchorage_holding_ground_eval" value="' . $aholding . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Foul Weather Shelter:</td>
			<td><input type="text" name="anchorage_foul_weather" id="anchorage_foul_weather" value="' . $afoul . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Dinghy Dock Access:</td>
			<td><input type="text" name="anchorage_dinghy" id="anchorage_dinghy" value="' . $adinghy . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Provisioning:</td>
			<td><input type="text" name="anchorage_provisioning" id="anchorage_provisioning" value="' . $aprovisioning . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Waste Pump-Out:</td>
			<td><input type="text" name="anchorage_waste" id="anchorage_waste" value="' . $awaste . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Pet Friendly:</td>
			<td><input type="text" name="anchorage_pets" id="anchorage_pets" value="' . $apets . '" /></td>
		</tr>
		
		<tr>
			<td class="label">Claiborne\'s Review URL:</td>
			<td><input type="text" name="anchorage_claiborne_review" id="anchorage_claiborne_review" value="' . $aclaibornereview . '" /></td>
		</tr>

		<tr>
			<td class="label">Rating:</td>
			<td>
				<input class="mradio" type="radio" name="anchorage_rating" value="1" ' . checked($arating, 1, false) . ' /> 1 &nbsp;&nbsp;
				<input class="mradio" type="radio" name="anchorage_rating" value="2" ' . checked($arating, 2, false) . ' /> 2 &nbsp;&nbsp;
				<input class="mradio" type="radio" name="anchorage_rating" value="3" ' . checked($arating, 3, false) . ' /> 3 &nbsp;&nbsp;
				<input class="mradio" type="radio" name="anchorage_rating" value="4" ' . checked($arating, 4, false) . ' /> 4 &nbsp;&nbsp;
				<input class="mradio" type="radio" name="anchorage_rating" value="5" ' . checked($arating, 5, false) . ' /> 5 &nbsp;&nbsp;
			</td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'anchoragebasic_metabox_save' );
add_action( 'plugins_loaded', 'anchoragebasic_metabox_save' );
function anchoragebasic_metabox_save( $post_id ) {
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
	if( isset( $_POST['anchorage_holding_ground_eval'] ) )
		update_post_meta( $post_id, 'anchorage_holding_ground_eval', wp_kses( $_POST['anchorage_holding_ground_eval'], $allowed ) );
	if( isset( $_POST['anchorage_swing_room'] ) )
		update_post_meta( $post_id, 'anchorage_swing_room', wp_kses( $_POST['anchorage_swing_room'], $allowed ) );
	if( isset( $_POST['anchorage_foul_weather'] ) )
		update_post_meta( $post_id, 'anchorage_foul_weather', wp_kses( $_POST['anchorage_foul_weather'], $allowed ) );
	if( isset( $_POST['anchorage_statute_mile'] ) )
		update_post_meta( $post_id, 'anchorage_statute_mile', wp_kses( $_POST['anchorage_statute_mile'], $allowed ) );
	if( isset( $_POST['anchorage_location'] ) )
		update_post_meta( $post_id, 'anchorage_location', wp_kses( $_POST['anchorage_location'], $allowed ) );
	if( isset( $_POST['anchorage_depths'] ) )
		update_post_meta( $post_id, 'anchorage_depths', wp_kses( $_POST['anchorage_depths'], $allowed ) );
	if( isset( $_POST['anchorage_provisioning'] ) )
		update_post_meta( $post_id, 'anchorage_provisioning', wp_kses( $_POST['anchorage_provisioning'], $allowed ) );
		
	if( isset( $_POST['anchorage_claiborne_review'] ) )
		update_post_meta( $post_id, 'anchorage_claiborne_review', wp_kses( $_POST['anchorage_claiborne_review'], $allowed ) );
	if( isset( $_POST['anchorage_nav_details'] ) )
		update_post_meta( $post_id, 'anchorage_nav_details', wp_kses( $_POST['anchorage_nav_details'], $allowed ) );
	if( isset( $_POST['anchorage_waste'] ) )
		update_post_meta( $post_id, 'anchorage_waste', wp_kses( $_POST['anchorage_waste'], $allowed ) );
	if( isset( $_POST['anchorage_dinghy'] ) )
		update_post_meta( $post_id, 'anchorage_dinghy', wp_kses( $_POST['anchorage_dinghy'], $allowed ) );
	if( isset( $_POST['anchorage_pets'] ) )
		update_post_meta( $post_id, 'anchorage_pets', wp_kses( $_POST['anchorage_pets'], $allowed ) );
		
	if( isset( $_POST['anchorage_rating'] ) )
		update_post_meta( $post_id, 'anchorage_rating', wp_kses( $_POST['anchorage_rating'], $allowed ) );
	
}

?>