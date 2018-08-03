<?php

function marinafuel_metabox_add() {
	global $_wp_post_type_features;
	add_meta_box( 'marinafuel', 'Fuel Price Information', 'marinafuel_metabox_cb', 'cnet_marinas', 'normal', 'high' );
	//add_meta_box( 'marinafuel', 'Fuel Price Information', 'marinafuel_metabox_cb', 'post', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'marinafuel_metabox_add' );

function marinafuel_metabox_cb($post) {
	
	global $post;
	
	$values = get_post_custom($post->ID);
	
	$mgasavail = isset( $values['mcf-gas'] ) ? esc_attr( $values['mcf-gas'][0] ) : '';
	$mgasprice = isset( $values['gas_price'] ) ? esc_attr( $values['gas_price'][0] ) : '';
	$mdieselavail = isset( $values['mcf-diesel'] ) ? esc_attr( $values['mcf-diesel'][0] ) : '';
	$mdieselprice = isset( $values['diesel_price'] ) ? esc_attr( $values['diesel_price'][0] ) : '';
	$mvalvtech = isset( $values['valvtech_only'] ) ? esc_attr( $values['valvtech_only'][0] ) : '';
	$mboatus = isset( $values['boatus_discount_only'] ) ? esc_attr( $values['boatus_discount_only'][0] ) : '';
	$mboatusnotes = isset( $values['marina_boatus_notes'] ) ? esc_attr( $values['marina_boatus_notes'][0] ) : '';
	$mreportdate = isset( $values['marina_reporting_date'] ) ? esc_attr( $values['marina_reporting_date'][0] ) : '';
	$mseatow = isset( $values['marina_seatow_discount'] ) ? esc_attr( $values['marina_seatow_discount'][0] ) : '';
	$mseatownotes = isset( $values['marina_seatow_notes'] ) ? esc_attr( $values['marina_seatow_notes'][0] ) : '';
    
    $mother = isset( $values['marina_other_discount'] ) ? esc_attr( $values['marina_other_discount'][0] ) : '';
    $mothernotes = isset( $values['marina_other_notes'] ) ? esc_attr( $values['marina_other_notes'][0] ) : '';
    
    $mssecn = isset( $values['marina_ssecn_discount'] ) ? esc_attr( $values['marina_ssecn_discount'][0] ) : '';
    $mssecnnotes = isset( $values['marina_ssecn_notes'] ) ? esc_attr( $values['marina_ssecn_notes'][0] ) : '';
    
	$mquantity = isset( $values['marina_quantity_discount'] ) ? esc_attr( $values['marina_quantity_discount'][0] ) : '';
	$mquantitynotes = isset( $values['marina_quantity_discount_notes'] ) ? esc_attr( $values['marina_quantity_discount_notes'][0] ) : '';
	$fuelnotes = isset( $values['fuel_notes'] ) ? esc_attr( $values['fuel_notes'][0] ) : '';
	
	$mgasnotes = isset( $values['marina_gas_notes'] ) ? esc_attr( $values['marina_gas_notes'][0] ) : '';
	$mdieselnotes = isset( $values['marina_diesel_notes'] ) ? esc_attr( $values['marina_diesel_notes'][0] ) : '';
	
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	
	echo '
	<table class="cnet_metabox_table" cellpadding="0" cellspacing="0">
		<tr>
			<td class="label2">Gas Available:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-gas" value="yes" ' . checked($mgasavail, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Price:</td>
						<td><input type="text" name="gas_price" id="gas_price" value="' . $mgasprice . '" /></td>
					</tr>
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="marina_gas_notes" id="marina_gas_notes" value="' . $mgasnotes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="label2">Diesel Available:</td>
			<td class="mcheckbox"><input type="checkbox" name="mcf-diesel" value="yes" ' . checked($mdieselavail, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Price:</td>
						<td><input type="text" name="diesel_price" id="diesel_price" value="' . $mdieselprice . '" /></td>
					</tr>
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="marina_diesel_notes" id="marina_diesel_notes" value="' . $mdieselnotes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		
        <tr>
            <td class="label2">CruisersNet Discount:</td>
            <td class="mcheckbox"><input type="checkbox" name="marina_ssecn_discount" value="yes" ' . checked($mssecn, 'yes',false) . ' /></td>
            <td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="nlabel">Notes:</td>
                        <td><input type="text" name="marina_ssecn_notes" id="marina_ssecn_notes" value="' . $mssecnnotes . '" /></td>
                    </tr>
				</table>
            </td>
        </tr>
    
		<tr>
			<td class="label2">Boat/US Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="boatus_discount_only" value="yes" ' . checked($mboatus, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="marina_boatus_notes" id="marina_boatus_notes" value="' . $mboatusnotes . '" /></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="label2">SeaTow Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="marina_seatow_discount" value="yes" ' . checked($mseatow, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="marina_seatow_notes" id="marina_seatow_notes" value="' . $mseatownotes . '" /></td>
					</tr>
				</table>		
			</td>
		</tr>
    
        <tr>
            <td class="label2">Other Discount:</td>
            <td class="mcheckbox"><input type="checkbox" name="marina_other_discount" value="yes" ' . checked($mother, 'yes',false) . ' /></td>
            <td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="nlabel">Notes:</td>
                        <td><input type="text" name="marina_other_notes" id="marina_other_notes" value="' . $mothernotes . '" /></td>
                    </tr>
				</table>
            </td>
        </tr>
    
		
		<tr>
			<td class="label2">Quantity Discount:</td>
			<td class="mcheckbox"><input type="checkbox" name="marina_quantity_discount" value="yes" ' . checked($mquantity, 'yes',false) . ' /></td>
			<td class="notes">
				<table class="notes-table" cellpadding="0" cellspacing="0">
					<tr>
						<td class="nlabel">Notes:</td>
						<td><input type="text" name="marina_quantity_discount_notes" id="marina_quantity_discount_notes" value="' . $mquantitynotes . '" /></td>
					</tr>
				</table>		
			</td>
		</tr>
		
		<tr>
			<td class="label2">ValvTect Dealer:</td>
			<td class="mcheckbox"><input type="checkbox" name="valvtech_only" value="yes" ' . checked($mvalvtech, 'yes',false) . ' /></td>
			<td class="notes"> </td>
		</tr>
		<tr>
			<td class="label2">Reporting Date:</td>
			<td colspan="2"><input id="datepicker" type="text" name="marina_reporting_date" id="marina_reporting_date" value="' . $mreportdate . '" /></td>
		</tr>
		
		<tr>
			<td class="label2">Fuel Notes:</td>
			<td colspan="2"><input id="datepicker" type="text" name="fuel_notes" id="fuel_notes" value="' . $fuelnotes . '" /></td>
		</tr>
		
	</table>
	';
}

add_action( 'save_post', 'marinafuel_metabox_save' );
add_action( 'plugins_loaded', 'marinafuel_metabox_save' );
function marinafuel_metabox_save( $post_id ) {
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
	update_post_meta( $post_id, 'mcf-gas', wp_kses( $_POST['mcf-gas'], $allowed ) );
	update_post_meta( $post_id, 'mcf-diesel', wp_kses( $_POST['mcf-diesel'], $allowed ) );
	update_post_meta( $post_id, 'boatus_discount_only', wp_kses( $_POST['boatus_discount_only'], $allowed ) );
	update_post_meta( $post_id, 'marina_seatow_discount', wp_kses( $_POST['marina_seatow_discount'], $allowed ) );
    update_post_meta( $post_id, 'marina_ssecn_discount', wp_kses( $_POST['marina_ssecn_discount'], $allowed ) );
    update_post_meta( $post_id, 'marina_other_discount', wp_kses( $_POST['marina_other_discount'], $allowed ) );
	update_post_meta( $post_id, 'marina_quantity_discount', wp_kses( $_POST['marina_quantity_discount'], $allowed ) );
	update_post_meta( $post_id, 'valvtech_only', wp_kses( $_POST['valvtech_only'], $allowed ) );
	
	if( isset( $_POST['gas_price'] ) )
		update_post_meta( $post_id, 'gas_price', wp_kses( $_POST['gas_price'], $allowed ) );
		
	if( isset( $_POST['diesel_price'] ) )
		update_post_meta( $post_id, 'diesel_price', wp_kses( $_POST['diesel_price'], $allowed ) );
		
	if( isset( $_POST['gas_price'] ) )
		update_post_meta( $post_id, 'marina_gas_notes', wp_kses( $_POST['marina_gas_notes'], $allowed ) );
		
	if( isset( $_POST['diesel_price'] ) )
		update_post_meta( $post_id, 'marina_diesel_notes', wp_kses( $_POST['marina_diesel_notes'], $allowed ) );
		
	if( isset( $_POST['marina_boatus_notes'] ) )
		update_post_meta( $post_id, 'marina_boatus_notes', wp_kses( $_POST['marina_boatus_notes'], $allowed ) );
		
	if( isset( $_POST['marina_reporting_date'] ) )
		update_post_meta( $post_id, 'marina_reporting_date', wp_kses( $_POST['marina_reporting_date'], $allowed ) );
		
	if( isset( $_POST['marina_quantity_discount_notes'] ) )
		update_post_meta( $post_id, 'marina_quantity_discount_notes', wp_kses( $_POST['marina_quantity_discount_notes'], $allowed ) );
		
	if( isset( $_POST['marina_seatow_notes'] ) )
		update_post_meta( $post_id, 'marina_seatow_notes', wp_kses( $_POST['marina_seatow_notes'], $allowed ) );
    
    if( isset( $_POST['marina_ssecn_notes'] ) )
        update_post_meta( $post_id, 'marina_ssecn_notes', wp_kses( $_POST['marina_ssecn_notes'], $allowed ) );
    
    if( isset( $_POST['marina_other_notes'] ) )
        update_post_meta( $post_id, 'marina_other_notes', wp_kses( $_POST['marina_other_notes'], $allowed ) );

		
	if( isset( $_POST['fuel_notes'] ) )
		update_post_meta( $post_id, 'fuel_notes', wp_kses( $_POST['fuel_notes'], $allowed ) );
	
}

?>
