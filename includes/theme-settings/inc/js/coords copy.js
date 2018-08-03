jQuery(document).ready(function() {
    
    // Latitude Calculation
    jQuery('.refresh-lat').click(function(){
    	
    	var lat_deg=document.getElementById('cvcf-lat_deg');
    	var lat_min=document.getElementById('cvcf-lat_min');
    	var lat_dir=document.getElementById('cvcf-lat_dir');
    
    	var lat_val_min=lat_min.value;
    
    	var lat_min_result=lat_val_min/60;
        lat_min_result=lat_min_result.toFixed(8);
       	
       	var lat_val_deg=lat_deg.value;
       	var lat_final=parseFloat(lat_val_deg)+parseFloat(lat_min_result);
       	
       	var lat_val_dir=lat_dir.value;
       	var latitude=lat_final*lat_val_dir;
       	
       	jQuery('#cvcf-latitude_dec').val(latitude); 
       	
    });
    
    // Longitude Calculation
    jQuery('.refresh-lon').click(function(){
    	
    	var lon_deg=document.getElementById('cvcf-lon_deg');
    	var lon_min=document.getElementById('cvcf-lon_min');
    	var lon_dir=document.getElementById('cvcf-lon_dir');
    
    	var lon_val_min=lon_min.value;
    
    	var lon_min_result=lon_val_min/60;
        lon_min_result=lon_min_result.toFixed(8);
       	
       	var lon_val_deg=lon_deg.value;
       	var lon_final=parseFloat(lon_val_deg)+parseFloat(lon_min_result);
       	
       	var lon_val_dir=lon_dir.value;
       	var longitude=lon_final*lon_val_dir;
       	
       	jQuery('#cvcf-longitude_dec').val(longitude); 
       	
    });
    
    // Clear Fields
    jQuery('.clear-lat').click(function(){
    	jQuery('#cvcf-lat_deg, #cvcf-lat_min, #cvcf-latitude_dec').val("");
    });
    jQuery('.clear-lon').click(function(){
    	jQuery('#cvcf-lon_deg, #cvcf-lon_min, #cvcf-longitude_dec').val("");
    });
        
});