<?php

function marinaservices_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'marinaservices', 'Marina Services', 'marinaservices_metabox_cb', 'cnet_marinas', 'normal', 'high' );
	add_meta_box( 'marinaservices', 'Marina Services', 'marinaservices_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'marinaservices_metabox_add' );

function marinaservices_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);
	
	$mtdock = isset( $values['mcf-transient-dock'] ) ? esc_attr( $values['mcf-transient-dock'][0] ) : '';
	$mtdock_type = isset( $values['mcf-transient-dock-type'] ) ? esc_attr( $values['mcf-transient-dock-type'][0] ) : '';
	$mtdock_slips = isset( $values['mcf-transient-dock-slips'] ) ? esc_attr( $values['mcf-transient-dock-slips'][0] ) : '';
	$mtdock_rate = isset( $values['mcf-transient-dock-rate'] ) ? esc_attr( $values['mcf-transient-dock-rate'][0] ) : '';
	$mtdockmonth_rate = isset( $values['mcf-transient-monthly-dock-rate'] ) ? esc_attr( $values['mcf-transient-monthly-dock-rate'][0] ) : '';
	$mtdock_reservation = isset( $values['mcf-transient-dock-reservation'] ) ? esc_attr( $values['mcf-transient-dock-reservation'][0] ) : '';
	
	$mpower2030 = isset( $values['mcf-power-20-30'] ) ? esc_attr( $values['mcf-power-20-30'][0] ) : '';
	$mpower203050 = isset( $values['mcf-power-20-30-50'] ) ? esc_attr( $values['mcf-power-20-30-50'][0] ) : '';
	$mpower30 = isset( $values['mcf-power-30'] ) ? esc_attr( $values['mcf-power-30'][0] ) : '';
	$mpower50 = isset( $values['mcf-power-50'] ) ? esc_attr( $values['mcf-power-50'][0] ) : '';
	$mpower3050 = isset( $values['mcf-power-30-50'] ) ? esc_attr( $values['mcf-power-30-50'][0] ) : '';
	$mpower3050100 = isset( $values['mcf-power-30-50-100'] ) ? esc_attr( $values['mcf-power-30-50-100'][0] ) : '';
	$mfreshwater = isset( $values['mcf-fresh-water'] ) ? esc_attr( $values['mcf-fresh-water'][0] ) : '';
	$mshower = isset( $values['mcf-shower'] ) ? esc_attr( $values['mcf-shower'][0] ) : '';
	$mlaundry = isset( $values['mcf-laundry'] ) ? esc_attr( $values['mcf-laundry'][0] ) : '';
	$mswimming = isset( $values['mcf-swimming-pool'] ) ? esc_attr( $values['mcf-swimming-pool'][0] ) : '';
	
	$mfood = isset( $values['mcf-food'] ) ? esc_attr( $values['mcf-food'][0] ) : '';
	$mfood_recommend = isset( $values['mcf-food-recommend'] ) ? esc_attr( $values['mcf-food-recommend'][0] ) : '';
	
	$mpropane = isset( $values['mcf-propane-ng'] ) ? esc_attr( $values['mcf-propane-ng'][0] ) : '';
	$mnaturalgas = isset( $values['mcf-natural-gas'] ) ? esc_attr( $values['mcf-natural-gas'][0] ) : '';
	
	$mwaste = isset( $values['mcf-waste'] ) ? esc_attr( $values['mcf-waste'][0] ) : '';
	
	
	
	
	$mwifi = isset( $values['mcf-wifi'] ) ? esc_attr( $values['mcf-wifi'][0] ) : '';
	
	
	
	
	$mwififvp = isset( $values['mcf-wifi-fvp'] ) ? esc_attr( $values['mcf-wifi-fvp'][0] ) : '';
	
	$mtdock_notes = isset( $values['mcf-transient-dock-notes'] ) ? esc_attr( $values['mcf-transient-dock-notes'][0] ) : '';
	$mpower2030_notes = isset( $values['mcf-power-20-30-notes'] ) ? esc_attr( $values['mcf-power-20-30-notes'][0] ) : '';
	$mpower203050_notes = isset( $values['mcf-power-20-30-50-notes'] ) ? esc_attr( $values['mcf-power-20-30-50-notes'][0] ) : '';
	$mpower30_notes = isset( $values['mcf-power-30-notes'] ) ? esc_attr( $values['mcf-power-30-notes'][0] ) : '';
	$mpower50_notes = isset( $values['mcf-power-50-notes'] ) ? esc_attr( $values['mcf-power-50-notes'][0] ) : '';
	$mpower3050_notes = isset( $values['mcf-power-30-50-notes'] ) ? esc_attr( $values['mcf-power-30-50-notes'][0] ) : '';
	$mpower3050100_notes = isset( $values['mcf-power-30-50-100-notes'] ) ? esc_attr( $values['mcf-power-30-50-100-notes'][0] ) : '';
	$mfreshwater_notes = isset( $values['mcf-fresh-water-notes'] ) ? esc_attr( $values['mcf-fresh-water-notes'][0] ) : '';
	$mshower_notes = isset( $values['mcf-shower-notes'] ) ? esc_attr( $values['mcf-shower-notes'][0] ) : '';
	$mlaundry_notes = isset( $values['mcf-laundry-notes'] ) ? esc_attr( $values['mcf-laundry-notes'][0] ) : '';
	$mswimming_notes = isset( $values['mcf-swimming-pool-notes'] ) ? esc_attr( $values['mcf-swimming-pool-notes'][0] ) : '';
	$mfood_notes = isset( $values['mcf-food-notes'] ) ? esc_attr( $values['mcf-food-notes'][0] ) : '';
	$mpropane_notes = isset( $values['mcf-propane-ng-notes'] ) ? esc_attr( $values['mcf-propane-ng-notes'][0] ) : '';
	$mnaturalgas_notes = isset( $values['mcf-natural-gas-notes'] ) ? esc_attr( $values['mcf-natural-gas-notes'][0] ) : '';
	$mwaste_notes = isset( $values['mcf-waste-notes'] ) ? esc_attr( $values['mcf-waste-notes'][0] ) : '';
	$mwifi_notes = isset( $values['mcf-wifi-notes'] ) ? esc_attr( $values['mcf-wifi-notes'][0] ) : '';
	
	$mboatus = isset( $values['mcf-boatus-discount'] ) ? esc_attr( $values['mcf-boatus-discount'][0] ) : '';
	$mmarinalife = isset( $values['mcf-marinalife-discount'] ) ? esc_attr( $values['mcf-marinalife-discount'][0] ) : '';
	$mseatow = isset( $values['mcf-seatow-discount'] ) ? esc_attr( $values['mcf-seatow-discount'][0] ) : '';
	
	$mboatus_notes = isset( $values['mcf-boatus-discount-notes'] ) ? esc_attr( $values['mcf-boatus-discount-notes'][0] ) : '';
	$mmarinalife_notes = isset( $values['mcf-marinalife-discount-notes'] ) ? esc_attr( $values['mcf-marinalife-discount-notes'][0] ) : '';
	$mseatow_notes = isset( $values['mcf-seatow-discount-notes'] ) ? esc_attr( $values['mcf-seatow-discount-notes'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		<tr>
			<td class="label2">Transient Dockage:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-transient-dock" value="yes" ' . checked($mtdock, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-transient-dock-notes" id="mcf-transient-dock-notes" value="' . $mtdock_notes . '" /></td>
					</tr>
					<tr>
						<td class="nlabel">Type:</td>
						<td><input type="text" name="mcf-transient-dock-type" id="mcf-transient-dock-type" value="' . $mtdock_type . '" /></td>
					</tr>
					<tr>
						<td class="nlabel"># of Slips/Berths:</td>
						<td><input type="text" name="mcf-transient-dock-slips" id="mcf-transient-dock-slips" value="' . $mtdock_slips . '" /></td>
					</tr>
					
					<tr>
						<td class="nlabel">Rate:</td>
						<td><input type="text" name="mcf-transient-dock-rate" id="mcf-transient-dock-rate" value="' . $mtdock_rate . '" /></td>
					</tr>
					<tr>
						<td class="nlabel">Marina Life URL:</td>
						<td><input type="text" name="mcf-transient-dock-reservation" id="mcf-transient-dock-reservation" value="' . $mtdock_reservation . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td class="label2">Boat/US Dockage Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-boatus-discount" value="yes" ' . checked($mboatus, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-boatus-discount-notes" id="mcf-boatus-discount-notes" value="' . $mboatus_notes . '" /></td>
					</tr>
				</table>				
			</td>
		</tr>
		<tr>
			<td class="label2">MarinaLife Dockage Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-marinalife-discount" value="yes" ' . checked($mmarinalife, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-marinalife-discount-notes" id="mcf-marinalife-discount-notes" value="' . $mmarinalife_notes . '" /></td>
					</tr>
				</table>				
			</td>
		</tr>
		<tr>
			<td class="label2">SeaTow Dockage Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-seatow-discount" value="yes" ' . checked($mseatow, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-seatow-discount-notes" id="mcf-seatow-discount-notes" value="' . $mseatow_notes . '" /></td>
					</tr>
				</table>				
			</td>
		</tr>
		
		<tr>
			<td class="label2">Power 20/30:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-20-30" value="yes" ' . checked($mpower2030, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-20-30-notes" id="mcf-power-20-30-notes" value="' . $mpower2030_notes . '" /></td>
					</tr>
				</table>				
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Power 20/30/50:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-20-30-50" value="yes" ' . checked($mpower203050, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-20-30-50-notes" id="mcf-power-20-30-50-notes" value="' . $mpower203050_notes . '" />
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Power 30:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-30" value="yes" ' . checked($mpower30, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-30-notes" id="mcf-power-30-notes" value="' . $mpower30_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Power 50:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-50" value="yes" ' . checked($mpower50, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-50-notes" id="mcf-power-50-notes" value="' . $mpower50_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Power 30/50:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-30-50" value="yes" ' . checked($mpower3050, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-30-50-notes" id="mcf-power-30-50-notes" value="' . $mpower3050_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Power 30/50/100:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-power-30-50-100" value="yes" ' . checked($mpower3050100, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-power-30-50-100-notes" id="mcf-power-30-50-100-notes" value="' . $mpower3050100_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Fresh Water:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-fresh-water" value="yes" ' . checked($mfreshwater, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-fresh-water-notes" id="mcf-fresh-water-notes" value="' . $mfreshwater_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Showers:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-shower" value="yes" ' . checked($mshower, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-shower-notes" id="mcf-shower-notes" value="' . $mshower_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Laundry:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-laundry" value="yes" ' . checked($mlaundry, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-laundry-notes" id="mcf-laundry-notes" value="' . $mlaundry_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Swimming Pool:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-swimming-pool" value="yes" ' . checked($mswimming, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-swimming-pool-notes" id="mcf-swimming-pool-notes" value="' . $mswimming_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Restaurant:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-food" value="yes" ' . checked($mfood, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-food-notes" id="mcf-food-notes" value="' . $mfood_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">LPG/Propane:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-propane-ng" value="yes" ' . checked($mpropane, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-propane-ng-notes" id="mcf-propane-ng-notes" value="' . $mpropane_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Comp. Natural Gas:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-natural-gas" value="yes" ' . checked($mnaturalgas, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-natural-gas-notes" id="mcf-natural-gas-notes" value="' . $mnaturalgas_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td class="label2">Waste:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-waste" value="yes" ' . checked($mwaste, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-waste-notes" id="mcf-waste-notes" value="' . $mwaste_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="label2">Wifi:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-wifi" value="yes" ' . checked($mwifi, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Free/Paid:</td>
						<td>
							<input class="mradio" type="radio" name="mcf-wifi-fvp" value="free" ' . checked($mwififvp, 'free',false) . ' /> free &nbsp;&nbsp;
							<input class="mradio" type="radio" name="mcf-wifi-fvp" value="paid" ' . checked($mwififvp, 'paid',false) . ' /> paid
						</td>
					</tr>
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="mcf-wifi-notes" id="mcf-wifi-notes" value="' . $mwifi_notes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	';
}

add_action( 'save_post', 'marinaservices_metabox_save' );
add_action( 'plugins_loaded', 'marinaservices_metabox_save' );
function marinaservices_metabox_save( $post_id ) {
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

	// make sure your data is set before trying to save it (except for checkboxes...)
	update_post_meta( $post_id, 'mcf-transient-dock', wp_kses( $_POST['mcf-transient-dock'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-20-30', wp_kses( $_POST['mcf-power-20-30'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-20-30-50', wp_kses( $_POST['mcf-power-20-30-50'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-30', wp_kses( $_POST['mcf-power-30'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-50', wp_kses( $_POST['mcf-power-50'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-30-50', wp_kses( $_POST['mcf-power-30-50'], $allowed ) );
	update_post_meta( $post_id, 'mcf-power-30-50-100', wp_kses( $_POST['mcf-power-30-50-100'], $allowed ) );
	update_post_meta( $post_id, 'mcf-fresh-water', wp_kses( $_POST['mcf-fresh-water'], $allowed ) );
	update_post_meta( $post_id, 'mcf-shower', wp_kses( $_POST['mcf-shower'], $allowed ) );
	update_post_meta( $post_id, 'mcf-laundry', wp_kses( $_POST['mcf-laundry'], $allowed ) );
	update_post_meta( $post_id, 'mcf-swimming-pool', wp_kses( $_POST['mcf-swimming-pool'], $allowed ) );
	update_post_meta( $post_id, 'mcf-food', wp_kses( $_POST['mcf-food'], $allowed ) );
	update_post_meta( $post_id, 'mcf-propane-ng', wp_kses( $_POST['mcf-propane-ng'], $allowed ) );
	update_post_meta( $post_id, 'mcf-natural-gas', wp_kses( $_POST['mcf-natural-gas'], $allowed ) );
	update_post_meta( $post_id, 'mcf-waste', wp_kses( $_POST['mcf-waste'], $allowed ) );
	update_post_meta( $post_id, 'mcf-wifi', wp_kses( $_POST['mcf-wifi'], $allowed ) );
	update_post_meta( $post_id, 'mcf-boatus-discount', wp_kses( $_POST['mcf-boatus-discount'], $allowed ) );
	update_post_meta( $post_id, 'mcf-marinalife-discount', wp_kses( $_POST['mcf-marinalife-discount'], $allowed ) );
	update_post_meta( $post_id, 'mcf-seatow-discount', wp_kses( $_POST['mcf-seatow-discount'], $allowed ) );
	
	if( isset( $_POST['mcf-transient-dock-type'] ) )
		update_post_meta( $post_id, 'mcf-transient-dock-type', wp_kses( $_POST['mcf-transient-dock-type'], $allowed ) );
	if( isset( $_POST['mcf-transient-dock-slips'] ) )
		update_post_meta( $post_id, 'mcf-transient-dock-slips', wp_kses( $_POST['mcf-transient-dock-slips'], $allowed ) );
	if( isset( $_POST['mcf-transient-dock'] ) )
		update_post_meta( $post_id, 'mcf-transient-dock-rate', wp_kses( $_POST['mcf-transient-dock-rate'], $allowed ) );
	if( isset( $_POST['mcf-transient-dock'] ) )
		update_post_meta( $post_id, 'mcf-transient-dock-reservation', wp_kses( $_POST['mcf-transient-dock-reservation'], $allowed ) );
	if( isset( $_POST['mcf-food-recommend'] ) )
		update_post_meta( $post_id, 'mcf-food-recommend', wp_kses( $_POST['mcf-food-recommend'], $allowed ) );
	if( isset( $_POST['mcf-gas'] ) )
		update_post_meta( $post_id, 'mcf-gas', wp_kses( $_POST['mcf-gas'], $allowed ) );
	if( isset( $_POST['mcf-diesel'] ) )
		update_post_meta( $post_id, 'mcf-diesel', wp_kses( $_POST['mcf-diesel'], $allowed ) );
	if( isset( $_POST['mcf-wifi-fvp'] ) )
		update_post_meta( $post_id, 'mcf-wifi-fvp', wp_kses( $_POST['mcf-wifi-fvp'], $allowed ) );
	if( isset( $_POST['mcf-transient-dock-notes'] ) )
		update_post_meta( $post_id, 'mcf-transient-dock-notes', wp_kses( $_POST['mcf-transient-dock-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-20-30-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-20-30-notes', wp_kses( $_POST['mcf-power-20-30-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-20-30-50-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-20-30-50-notes', wp_kses( $_POST['mcf-power-20-30-50-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-30-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-30-notes', wp_kses( $_POST['mcf-power-30-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-50-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-50-notes', wp_kses( $_POST['mcf-power-50-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-30-50-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-30-50-notes', wp_kses( $_POST['mcf-power-30-50-notes'], $allowed ) );
	if( isset( $_POST['mcf-power-30-50-100-notes'] ) )
		update_post_meta( $post_id, 'mcf-power-30-50-100-notes', wp_kses( $_POST['mcf-power-30-50-100-notes'], $allowed ) );
	if( isset( $_POST['mcf-fresh-water-notes'] ) )
		update_post_meta( $post_id, 'mcf-fresh-water-notes', wp_kses( $_POST['mcf-fresh-water-notes'], $allowed ) );
	if( isset( $_POST['mcf-shower-notes'] ) )
		update_post_meta( $post_id, 'mcf-shower-notes', wp_kses( $_POST['mcf-shower-notes'], $allowed ) );
	if( isset( $_POST['mcf-swimming-pool-notes'] ) )
		update_post_meta( $post_id, 'mcf-swimming-pool-notes', wp_kses( $_POST['mcf-swimming-pool-notes'], $allowed ) );
	if( isset( $_POST['mcf-laundry-notes'] ) )
		update_post_meta( $post_id, 'mcf-laundry-notes', wp_kses( $_POST['mcf-laundry-notes'], $allowed ) );
	if( isset( $_POST['mcf-food-notes'] ) )
		update_post_meta( $post_id, 'mcf-food-notes', wp_kses( $_POST['mcf-food-notes'], $allowed ) );
	if( isset( $_POST['mcf-gas-notes'] ) )
		update_post_meta( $post_id, 'mcf-gas-notes', wp_kses( $_POST['mcf-gas-notes'], $allowed ) );
	if( isset( $_POST['mcf-diesel-notes'] ) )
		update_post_meta( $post_id, 'mcf-diesel-notes', wp_kses( $_POST['mcf-diesel-notes'], $allowed ) );
	if( isset( $_POST['mcf-propane-ng-notes'] ) )
		update_post_meta( $post_id, 'mcf-propane-ng-notes', wp_kses( $_POST['mcf-propane-ng-notes'], $allowed ) );
	if( isset( $_POST['mcf-natural-gas-notes'] ) )
		update_post_meta( $post_id, 'mcf-natural-gas-notes', wp_kses( $_POST['mcf-natural-gas-notes'], $allowed ) );
	if( isset( $_POST['mcf-waste-notes'] ) )
		update_post_meta( $post_id, 'mcf-waste-notes', wp_kses( $_POST['mcf-waste-notes'], $allowed ) );
	if( isset( $_POST['mcf-wifi-notes'] ) )
		update_post_meta( $post_id, 'mcf-wifi-notes', wp_kses( $_POST['mcf-wifi-notes'], $allowed ) );
	if( isset( $_POST['mcf-boatus-discount-notes'] ) )
		update_post_meta( $post_id, 'mcf-boatus-discount-notes', wp_kses( $_POST['mcf-boatus-discount-notes'], $allowed ) );
	if( isset( $_POST['mcf-marinalife-discount-notes'] ) )
		update_post_meta( $post_id, 'mcf-marinalife-discount-notes', wp_kses( $_POST['mcf-marinalife-discount-notes'], $allowed ) );
	if( isset( $_POST['mcf-seatow-discount-notes'] ) )
		update_post_meta( $post_id, 'mcf-seatow-discount-notes', wp_kses( $_POST['mcf-seatow-discount-notes'], $allowed ) );
			
}



/*remove custom field meta box */

function remove_post_custom_fields() {
	remove_meta_box( 'categorydiv' , 'cnet_marinas' , 'side' );
}

add_action( 'admin_menu' , 'remove_post_custom_fields' );


?>