jQuery(document).ready(function() {
    
    // Latitude Calculation
    jQuery('.refresh-lat').click(function(){
    	
    	var lat_deg=document.getElementById('cvcf-lat_deg');
    	var lat_min=document.getElementById('cvcf-lat_min');
    	var lat_dir=document.getElementById('cvcf-lat_dir');
    	var lat_dec=document.getElementById('cvcf-latitude_dec');
    	
    	var lat_deg_check=lat_deg.value;
    	
    	// convert deg/min/dir to decimal
    	if (lat_deg_check != "") {
    		
    		var lat_val_min=lat_min.value;
    
    		var lat_min_result=lat_val_min/60;
        	lat_min_result=lat_min_result.toFixed(8);
       	
       		var lat_val_deg=lat_deg.value;
       		var lat_final=parseFloat(lat_val_deg)+parseFloat(lat_min_result);
       	
       		var lat_val_dir=lat_dir.value;
       		var longitude=lat_final*lat_val_dir;
       	
       		jQuery('#cvcf-latitude_dec').val(longitude);
    		
    	// convert decimal to deg/min/dir
    	} else {
    	
    		var lat_dec_value=lat_dec.value;
    		var val_deg=lat_dec_value.toString().split('.')[0];
    		
    		var val_min = lat_dec_value - val_deg;
    		val_min=val_min*60;
    		val_min=val_min.toFixed(4);
    		
    		
    		// is positive (east)
    		if (lat_dec_value > 0) {
    			
    			jQuery('#cvcf-lat_dir').val(1)
    			jQuery('#cvcf-lat_deg').val(val_deg);
    			jQuery('#cvcf-lat_min').val(val_min);
    			
    		// is negative (west)
    		} else {
    		
    			jQuery('#cvcf-lat_dir').val(-1);
    			val_deg=val_deg*-1;
    			jQuery('#cvcf-lat_deg').val(val_deg);
    			val_min=val_min*-1;
    			jQuery('#cvcf-lat_min').val(val_min);
    		
    		}
    		
    	}
		
    });
    
    // Longitude Calculation
    jQuery('.refresh-lon').click(function(){
    	
    	var lon_deg=document.getElementById('cvcf-lon_deg');
    	var lon_min=document.getElementById('cvcf-lon_min');
    	var lon_dir=document.getElementById('cvcf-lon_dir');
    	var lon_dec=document.getElementById('cvcf-longitude_dec');
    	
    	var lon_deg_check=lon_deg.value;
    	
    	// convert deg/min/dir to decimal
    	if (lon_deg_check != "") {
    		
    		var lon_val_min=lon_min.value;
    
    		var lon_min_result=lon_val_min/60;
        	lon_min_result=lon_min_result.toFixed(8);
       	
       		var lon_val_deg=lon_deg.value;
       		var lon_final=parseFloat(lon_val_deg)+parseFloat(lon_min_result);
       	
       		var lon_val_dir=lon_dir.value;
       		var longitude=lon_final*lon_val_dir;
       	
       		jQuery('#cvcf-longitude_dec').val(longitude);
    		
    	// convert decimal to deg/min/dir
    	} else {
    	
    		var lon_dec_value=lon_dec.value;
    		var val_deg=lon_dec_value.toString().split('.')[0];
    		
    		var val_min = lon_dec_value - val_deg;
    		val_min=val_min*60;
    		val_min=val_min.toFixed(4);
    		
    		
    		// is positive (east)
    		if (lon_dec_value > 0) {
    			
    			jQuery('#cvcf-lon_dir').val(1)
    			jQuery('#cvcf-lon_deg').val(val_deg);
    			jQuery('#cvcf-lon_min').val(val_min);
    			
    		// is negative (west)
    		} else {
    		
    			jQuery('#cvcf-lon_dir').val(-1);
    			val_deg=val_deg*-1;
    			jQuery('#cvcf-lon_deg').val(val_deg);
    			val_min=val_min*-1;
    			jQuery('#cvcf-lon_min').val(val_min);
    		
    		}
    		
    	}
		
    });
    
    // Clear Fields
    jQuery('.clear-lat').click(function(){
    	jQuery('#cvcf-lat_deg, #cvcf-lat_min, #cvcf-latitude_dec').val("");
    });
    jQuery('.clear-lon').click(function(){
    	jQuery('#cvcf-lon_deg, #cvcf-lon_min, #cvcf-longitude_dec').val("");
    });
    
    
    // Build Chartview URL (this URL is NOT saved in the database.
    // Ultimately it is drawn from stored data, but can be "refreshed"
    // to reflect current coordinate values.
    jQuery('.url-refresh').click(function() {
    	var curr_lat=document.getElementById('cvcf-latitude_dec');
    	var curr_lon=document.getElementById('cvcf-longitude_dec');
    	var curr_zoom=document.getElementById('cvcf-zoomlevel');
    	var curr_highlight=document.getElementById('marina_highlight');

    	var base_url = 'http://cruisersnet.net/cruisersnet-marine-map/?ll=';
    	var url = base_url+curr_lat.value+','+curr_lon.value+'&z='+curr_zoom.value;
    	
    	if (curr_highlight.checked) {
    		var curr_url = url+'&highlight=1';
    		jQuery('#cvlink').val(curr_url);
    	} else {
    		var curr_url = url;
    		jQuery('#cvlink').val(curr_url);
    	}
    	
    });
    
        
});