jQuery(document).ready(function() {
	
	// Make the preview field readonly
	jQuery('.acf-field-56828ee370908 input').prop('readonly', true);
	
	// Process New vs. Update Post Stuff
	jQuery('.acf-field-56828e2565599 input:radio').click(function() {
		
		var thisVal = jQuery(this).val();
		console.log(thisVal);
		
		if (thisVal == 'update') {
			
			var existingID = jQuery('#acf-field_56828ee370908').val();
			if (!existingID) {
				
				var noIDWarning = '<div class="facebook-update-warning"><strong>Warning</strong>: There is no Facebook post for this article. A new Facebook post will be created.</div>';
				jQuery('#acf-field_56828ee370908').parent().append(noIDWarning);
				
			}
			
		} else {
			
			jQuery('.facebook-update-warning').remove();
			
		}
		
	});

});