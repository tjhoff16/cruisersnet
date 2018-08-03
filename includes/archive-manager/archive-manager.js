jQuery(document).ready(function() {
	
	jQuery('td.archive-options-column').on('click', '.archive-action', function() {
		
		var id = jQuery(this).data('id');
		var option = jQuery(this).data('option');
		
		console.log(id);
		console.log(option);
		
		jQuery.ajax({
			url: 'http://cruisersnet.net/wp-admin/admin-ajax.php',
			data: {
				action: 'archive_option',
				option: option,
				id: id
			},
			dataType: 'json',
			type: 'POST',
			success: function(response) {
				
				console.log(response['result']);
				
				if (response['result'] == 'archived') {
					
					jQuery('#row-' + id).css({'background' : '#E8FFD8'});
					jQuery('#col-post-type-' + id).html('<strong>cnet_archive</strong>');
					jQuery('#col-option-' + id).html('<a class="archive-action" data-id="' + id + '" data-option="restore" href="javascript:void(0);"><span class="dashicons dashicons-image-rotate"></span> Restore</a>');
					
				} else if (response['result'] == 'restored') {
					
					jQuery('#row-' + id).css({'background' : '#E2F7FC'});
					jQuery('#col-post-type-' + id).html('<strong>' + response['post_type'] + '</strong>');
					jQuery('#col-option-' + id).html('<a class="archive-action" data-id="' + id + '" data-option="archive" href="javascript:void(0);"><span class="dashicons dashicons-category"></span> Archive</a>');
					
				} else {
					
					jQuery('#row-' + id).css({'background' : '#FFECEC'});
					jQuery('#col-option-' + id).html('Error: Reload this page and try again.');
					
				}
				
			},
			error: function() {
				console.log('error');
			},
			async: false
		});
		
	});
	
});