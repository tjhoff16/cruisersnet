jQuery(document).ready(function() {
    
    // Latitude Calculation
    var lat_deg=document.getElementById('cvcf-lat_deg');
    var lat_min=document.getElementById('cvcf-lat_min');
    var lat_dir=document.getElementById('cvcf-lat_dir');
    
    lat_min.onkeyup=function()
    {
        var lat_val_min=lat_min.value;
        if(lat_val_min.length > 0 && isNaN(lat_val_min)) 
        {
            jQuery('#cvcf-latitude_dec').val('Invalid number!');
            return false;
        }

        var lat_min_result=lat_val_min/60;
        lat_min_result=lat_min_result.toFixed(8);
       	
       	var lat_val_deg=lat_deg.value;
       	var lat_final=parseFloat(lat_val_deg)+parseFloat(lat_min_result);
       	
       	var lat_val_dir=lat_dir.value;
       	
       
        if(parseFloat(lat_min_result)>0) 
        {
           jQuery('#cvcf-latitude_dec').val(lat_final);            
        }
        
        jQuery('#cvcf-lat_dir').change(function() {
        	var current_lat_dir = jQuery('#cvcf-lat_dir').val();
        	if ( current_lat_dir = "S") {
        		jQuery('#cvcf-latitude_dec').val('-'+lat_final);
        	}
        });
    }
    
    
     // Longitude Calculation
    var lon_deg=document.getElementById('cvcf-lon_deg');
    var lon_min=document.getElementById('cvcf-lon_min');
    var lon_dir=document.getElementById('cvcf-lon_dir');
    
    lon_min.onkeyup=function()
    {
        var lon_val_min=lon_min.value;
        if(lon_val_min.length > 0 && isNaN(lon_val_min)) 
        {
            jQuery('#cvcf-longitude_dec').val('Invalid number!');
            return false;
        }

        var lon_min_result=lon_val_min/60;
        lon_min_result=lon_min_result.toFixed(8);
       	
       	var lon_val_deg=lon_deg.value;
       	var lon_final=parseFloat(lon_val_deg)+parseFloat(lon_min_result);
       	
       
        if(parseFloat(lon_min_result)>0) 
        {
           jQuery('#cvcf-longitude_dec').val(lon_final);            
        }
    }
    
});