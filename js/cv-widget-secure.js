jQuery(function($) {
	$("#wwSelect").change(function(){
		var min = $('option:selected', this).attr('minMile');
		var max = $('option:selected', this).attr('maxMile');
		document.getElementById('wwMin').innerHTML=min;
		document.getElementById('wwMax').innerHTML=max;
	});
	
	$('#wwSelect').trigger('change');
});
    
function searchMile(){
	var rid = jQuery('option:selected', '#wwSelect').val();
	var mile = jQuery('#wwMile').val();
	jQuery.getJSON("https://cruisersnet.net/charts/php/milePosts.php",{rid: rid, mile: mile, ajax: 'true'}, function(j){
		var url = 'https://cruisersnet.net/cruisersnet-marine-map/?ll='+j.lat+','+j.lon+'&z=14';
		document.location.href=url;            
	});
}
  	
function searchLatLon() {
	
	var lat = jQuery('#csb-lat').val();
	var lon = jQuery('#csb-lon').val();
	
	var lat_deg = jQuery('.lat-deg-input').val();
    var lat_min = jQuery('.lat-min-input').val();
    var lat_dir = jQuery('.lat-deg-dir').val();
    
    var lon_deg = jQuery('.lon-deg-input').val();
    var lon_min = jQuery('.lon-min-input').val();
    var lon_dir = jQuery('.lon-deg-dir').val();
    
    var format = jQuery('input:radio[name="latlon-format"]:checked').val();
    
    // if degrees/minutes/direction format is selected (default)
    if (format == 'format-deg') {
    	
    	// latitude calculation
    	var lat_val_min=lat_min;
    
    	var lat_min_result=lat_val_min/60;
        lat_min_result=lat_min_result.toFixed(8);
       	
       	var lat_val_deg=lat_deg;
       	var lat_final=parseFloat(lat_val_deg)+parseFloat(lat_min_result);
       	
       	var lat_val_dir=lat_dir;
       	var latitude=lat_final*lat_val_dir;

		
		// longitude calculation
		var lon_val_min=lon_min;
    
    	var lon_min_result=lon_val_min/60;
        lon_min_result=lon_min_result.toFixed(8);
       	
       	var lon_val_deg=lon_deg;
       	var lon_final=parseFloat(lon_val_deg)+parseFloat(lon_min_result);
       	
       	var lon_val_dir=lon_dir;
       	var longitude=lon_final*lon_val_dir;
				
		var url = 'https://cruisersnet.net/cruisersnet-marine-map/?ll='+latitude+','+longitude+'&z=14';
		
		// lazy validation
		if (lat_deg == '' || lat_min == '' || lon_deg == '' || lon_min == '') {
		
			if (lat_deg == '') {
				jQuery('.lat-deg-input').addClass('cv-error').attr('placeholder','required');
			} else {
				jQuery('.lat-deg-input').removeClass('cv-error');
			}
			
			if (lat_min == '') {
				jQuery('.lat-min-input').addClass('cv-error').attr('placeholder','required');
			} else {
				jQuery('.lat-min-input').removeClass('cv-error');
			}
			
			if (lon_deg == '') {
				jQuery('.lon-deg-input').addClass('cv-error').attr('placeholder','required');
			} else {
				jQuery('.lon-deg-input').removeClass('cv-error');
			}
			
			if (lon_min == '') {
				jQuery('.lon-min-input').addClass('cv-error').attr('placeholder','required');
			} else {
				jQuery('.lon-min-input').removeClass('cv-error');
			}
			
			return false;
		
		} else {
			
			jQuery('.apple_overlay').hide();
			document.location.href=url;
			
		}	
    	
    }
    
    // if decimal format is selected
    if (format == 'format-dec') {
		
    	var url = 'https://cruisersnet.net/cruisersnet-marine-map/?ll='+lat+','+lon+'&z=14';
		document.location.href=url;

    }

}

jQuery(document).ready(function($) {
    
	$("input[name=latlon-format]:radio").change(function () {
		var curr = $(this).val();
		if (curr == 'format-deg') {
			$('#format-input-dec').hide();
			$('#format-input-deg').show();
		}
		
		if (curr == 'format-dec') {
			$('#format-input-deg').hide();
			$('#format-input-dec').show();
		}
	})
        
});