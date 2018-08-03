<?php

function bridgebasic_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'bridgebasic', 'Bridge Basic Information', 'bridgebasic_metabox_cb', 'cnet_bridges', 'normal', 'high' );
	add_meta_box( 'bridgebasic', 'Bridge Basic Information', 'bridgebasic_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'bridgebasic_metabox_add' );

function bridgebasic_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);
	
	$bphone = isset( $values['bridge_phone'] ) ? esc_attr( $values['bridge_phone'][0] ) : '';
	$bstatutemile = isset( $values['bridge_statute_mile'] ) ? esc_attr( $values['bridge_statute_mile'][0] ) : '';
	$bvhf = isset( $values['bridge_vhf'] ) ? esc_attr( $values['bridge_vhf'][0] ) : '';
	$btype = isset( $values['bridge_type'] ) ? esc_attr( $values['bridge_type'][0] ) : '';
	$bclearance = isset( $values['bridge_clearance'] ) ? esc_attr( $values['bridge_clearance'][0] ) : '';
	$bschedule = isset( $values['bridge_schedule'] ) ? esc_attr( $values['bridge_schedule'][0] ) : '';
	$bicon = isset( $values['bridge_icon'] ) ? esc_attr( $values['bridge_icon'][0] ) : '';
	$blocation = isset( $values['bridge_location'] ) ? esc_attr( $values['bridge_location'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		<tr>
			<td class="label">Phone Number:</td>
			<td><input type="text" name="bridge_phone" id="bridge_phone" value="' . $bphone . '" /></td>
		</tr>
		<tr>
			<td class="label">Statute Mile:</td>
			<td><input type="text" name="bridge_statute_mile" id="bridge_statute_mile" value="' . $bstatutemile . '" /></td>
		</tr>
		<tr>
			<td class="label">Location Description:</td>
			<td><input type="text" name="bridge_location" id="bridge_location" value="' . $blocation . '" /></td>
		</tr>
		<tr>
			<td class="label">VHF Hailing Frequency:</td>
			<td><input type="text" name="bridge_vhf" id="bridge_vhf" value="' . $bvhf . '" /></td>
		</tr>
		<tr>
			<td class="label">Type of Bridge:</td>
			<td><input type="text" name="bridge_type" id="bridge_type" value="' . $btype . '" /></td>
		</tr>
		<tr>
			<td class="label">Closed Vertical Clearance:</td>
			<td><input type="text" name="bridge_clearance" id="bridge_clearance" value="' . $bclearance . '" /></td>
		</tr>
		<tr>
			<td class="label">Opening Schedule:</td>
			<td><input type="text" name="bridge_schedule" id="bridge_schedule" value="' . $bschedule . '" /></td>
		</tr>
		<tr>
			<td class="label">Bridge Icon:</td>
			<td class="bridge-icons">
				<input class="mradio" type="radio" name="bridge_icon" value="bicon1" ' . checked($bicon, 1, false) . ' /> 
				<img src="' . get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/bridge_icon2.jpg" width="32" /> &nbsp;&nbsp; &nbsp;&nbsp;
				<input class="mradio" type="radio" name="bridge_icon" value="bicon2" ' . checked($bicon, 2, false) . ' /> 
				<img src="' . get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/bridge_icon2.jpg" width="32" /> &nbsp;&nbsp; &nbsp;&nbsp;
				<input class="mradio" type="radio" name="bridge_icon" value="bicon3" ' . checked($bicon, 3, false) . ' /> 
				<img src="' . get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/bridge_icon2.jpg" width="32" /> &nbsp;&nbsp; &nbsp;&nbsp;
				<input class="mradio" type="radio" name="bridge_icon" value="bicon4" ' . checked($bicon, 4, false) . ' /> 
				<img src="' . get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/bridge_icon2.jpg" width="32" /> &nbsp;&nbsp; &nbsp;&nbsp;
				<input class="mradio" type="radio" name="bridge_icon" value="bicon5" ' . checked($bicon, 5, false) . ' /> 
				<img src="' . get_bloginfo('template_directory') . '/includes/cnet_v2/inc/images/bridge_icon2.jpg" width="32" /> &nbsp;&nbsp; &nbsp;&nbsp;
			</td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'bridgebasic_metabox_save' );
add_action( 'plugins_loaded', 'bridgebasic_metabox_save' );
function bridgebasic_metabox_save( $post_id ) {
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
	if( isset( $_POST['bridge_phone'] ) )
		update_post_meta( $post_id, 'bridge_phone', wp_kses( $_POST['bridge_phone'], $allowed ) );
	if( isset( $_POST['bridge_statute_mile'] ) )
		update_post_meta( $post_id, 'bridge_statute_mile', wp_kses( $_POST['bridge_statute_mile'], $allowed ) );
	if( isset( $_POST['bridge_vhf'] ) )
		update_post_meta( $post_id, 'bridge_vhf', wp_kses( $_POST['bridge_vhf'], $allowed ) );
	if( isset( $_POST['bridge_type'] ) )
		update_post_meta( $post_id, 'bridge_type', wp_kses( $_POST['bridge_type'], $allowed ) );
	if( isset( $_POST['bridge_clearance'] ) )
		update_post_meta( $post_id, 'bridge_clearance', wp_kses( $_POST['bridge_clearance'], $allowed ) );
	if( isset( $_POST['bridge_schedule'] ) )
		update_post_meta( $post_id, 'bridge_schedule', wp_kses( $_POST['bridge_schedule'], $allowed ) );
	if( isset( $_POST['bridge_icon'] ) )
		update_post_meta( $post_id, 'bridge_icon', wp_kses( $_POST['bridge_icon'], $allowed ) );
	if( isset( $_POST['bridge_location'] ) )
		update_post_meta( $post_id, 'bridge_location', wp_kses( $_POST['bridge_location'], $allowed ) );
	
}

?>