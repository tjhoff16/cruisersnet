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
    
    
    // LNM Calculation
    jQuery('.convert-lnm').click(function(){
        var lnm_text = document.getElementById('lnm_text');
        var URL='/wp-content/themes/CruisersNet/includes/cnet-tools/ll_lnm2dec.php?ll='+lnm_text.value;
        jQuery('#lnm_dec, #cvcf-latitude_dec, #cvcf-longitude_dec').val("");
        jQuery.post(URL,function(data,status,xhr) {
            if ( data.toUpperCase().indexOf('ERROR') === -1 ) {
                jQuery('#lnm_dec').val(data);
                var parts = data.split(",");
                if (parts.length > 0) jQuery('#cvcf-latitude_dec').val(parts[0]);
                if (parts.length > 1) jQuery('#cvcf-longitude_dec').val(parts[1]);
            } else {
                jQuery('#llnr_desc').val(data);
                alert(data);
            }
        }, 'text');
    });
    
    // Get LLNR
    jQuery('.convert-llnr').click(function(){
        var district_text = document.getElementById('district_text');
        var llnr_text = document.getElementById('llnr_text');
        var URL='/charts/php/llnr.php?district='+district_text.value+'&llnr='+llnr_text.value;
        jQuery('#llnr_desc, #lnm_text, #lnm_dec, #cvcf-latitude_dec, #cvcf-longitude_dec').val("");
        jQuery.post(URL,function(data,status,xhr) {
            if ( data.toUpperCase().indexOf('ERROR') === -1 ) {
                var parts = data.split(",");
                jQuery('#lnm_text').val(parts[0]);
                if (parts.length > 0) jQuery('#llnr_desc').val(parts[1]);
                if (parts.length > 1) jQuery('.convert-lnm').trigger('click');
            } else {
                jQuery('#llnr_desc').val(data);
                alert(data);
            }
        }, 'text');
    });
    
    // Clear Fields
    jQuery('.clear-lat').click(function(){
        jQuery('#cvcf-lat_deg, #cvcf-lat_min, #cvcf-latitude_dec').val("");
    });
    jQuery('.clear-lon').click(function(){
        jQuery('#cvcf-lon_deg, #cvcf-lon_min, #cvcf-longitude_dec').val("");
    });
    jQuery('.clear-lnm').click(function(){
        jQuery('#lnm_format, #lnm_dec').val("");
    });
    jQuery('.clear-llnr').click(function(){
        jQuery('#district_text, #llnr_text, #llnr_desc').val("");
    });
    jQuery('.clear-ad_id').click(function(){
        jQuery('#ad_id_text').val("");
    });
    
    // Build Chartview URL (this URL is NOT saved in the database.
    // Ultimately it is drawn from stored data, but can be "refreshed"
    // to reflect current coordinate values.
    jQuery('.url-refresh').click(function() {
        refreshChartImages(true);
    });
    
    
    // display in post conditional
    var display_default = jQuery('#chartlet-display input[type=radio]:checked').val();
    if (display_default == 'enable') {
        jQuery('.chartlet-option').show();
    }
    
    if (display_default == '' || display_default == undefined) {
        jQuery('.chartlet-option').hide();
    }
    
    if (display_default == 'disable') {
        jQuery('.chartlet-option').hide();
    }
    
    jQuery('#chartlet-display input[type=radio]').click(function() {
        var display = jQuery(this).val();
        if      (display == 'enable' ) jQuery('.chartlet-option').show();
        else if (display == 'disable') jQuery('.chartlet-option').hide();
    });
    
    var fb_radio = jQuery("#facebook-image-options input[type='radio']:checked");
    current_fb_radio = fb_radio.attr('value');
    jQuery('#facebook-image-options input[type=radio]').click(function() {
        var fb_radio = jQuery("#facebook-image-options input[type='radio']:checked");
        var imagetype = fb_radio.attr('value');
        var loadng_gif_element = document.getElementById("loading_gif");
        var loadng_gif_style = document.getElementById("loading_gif").style;
        var loadng_gif_display = document.getElementById("loading_gif").style.display;
        var isLoading = document.getElementById("loading_gif").style.display == "block";
        if ( isLoading ){
            alert("Please Wait.  Your previous feature image is still processing.");
            jQuery('#facebook-image-options input[type=radio][name='+current_fb_radio+']').attr('checked',true);
        } else if ( imagetype==='adrotate' ) { // Process adrotate ONLY upon refresh-ad_id click, NOT HERE, just show add't items
            jQuery('#adrotate_refresh').show();
            jQuery('#type_rotate_id').show();
            jQuery('#ad_id_text').show();
            jQuery('#type_media-library_select').hide();
            jQuery('#upload_file').hide();
        } else if ( imagetype==='media-library' ) {
            jQuery('#adrotate_refresh').hide();
            jQuery('#type_rotate_id').hide();
            jQuery('#ad_id_text').hide();
            jQuery('#type_media-library_select').show();
            jQuery('#upload_file').hide();
        } else if ( imagetype==='upload_file' ) {
            jQuery('#adrotate_refresh').hide();
            jQuery('#type_rotate_id').hide();
            jQuery('#ad_id_text').hide();
            jQuery('#type_media-library_select').hide();
            jQuery('#upload_file').show();
        } else {
            fixedChoiceFeatureImage();
            jQuery('#adrotate_refresh').hide();
            jQuery('#type_rotate_id').hide();
            jQuery('#ad_id_text').hide();
            jQuery('#type_media-library_select').hide();
            jQuery('#upload_file').hide();
        }
        current_fb_radio = imagetype;
    });
    
    jQuery('.refresh-ad_id').click(function(){
        var fb_radio = jQuery("#facebook-image-options input[type='radio']:checked");
        var imagetype = fb_radio.attr('value');
        var adID = jQuery('#ad_id_text').val();
        if ( imagetype!=='adrotate' ) alert("ERROR: Banner must be selected before refresh");
        else if ( adID==='')          alert("ERROR: Ad ID must be entered before refresh");
        else                          fixedChoiceFeatureImage();
    });
    
    upload_timeout_id=-1;
    jQuery(document).on('change','#upload_file',function(){
        var files = document.getElementById('upload_file').files;
        if ( files.length==1 ) uploadFeatureImage();
    });
    
    //The hash (#) specifies to select elements by their ID's
    // The dot (.) specifies to select elements by their classname
    // Set all variables to be used in scope
    var frame,
        metaBox = jQuery('#meta-box-id.postbox'), // Your meta box id here
        addImgLink = metaBox.find('.upload-custom-img'),
        delImgLink = metaBox.find( '.delete-custom-img'),
        imgContainer = metaBox.find( '.custom-img-container'),
        imgIdInput = metaBox.find( '.custom-img-id' );
    
    jQuery('#add-feature-image-from-media-library').click(function(event){
        event.preventDefault();
        if ( frame ) {
            frame.open();
            return;
        }
        frame = wp.media({  // Create a new media frame
            title: 'Select or Upload Feature Image',
            button: { text: 'Use This Image' },
            multiple: false
        });
        frame.on( 'select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            updateFeatureImage('social_image', 'media_library', 'no_file', attachment.id);
        });
        frame.open();  // Finally, open the modal on click
   });
    //
    //  This should catch editing an old post and automatically creating the chartlet images
    //
    var chartlet_img = jQuery("#chartlet_image");
    if ( ! IsImageOk(chartlet_img[0]) )
        refreshChartImages(false);
});
    
function uploadFeatureImage() {
    var file0 = document.getElementById('upload_file').files[0];
    var image_name = file0.name;
    var image_extension = image_name.split('.').pop().toLowerCase();
    if ( jQuery.inArray(image_extension,['gif','jpg','jpeg','png','']) == -1){
        alert("Invalid image file type: "+image_extension);
        return;
    }
    updateFeatureImage('social_image', 'upload_file', file0, 0);
}

function fixedChoiceFeatureImage() {
    jQuery('#msg').html("Updating feature image...");
    var fb_radio = jQuery("#facebook-image-options input[type='radio']:checked");
    var imagetype = fb_radio.attr('value');
    var adID = jQuery('#ad_id_text').val();
    updateFeatureImage('social_image', imagetype, 'no_file', adID);
}

function updateFeatureImage(task, type, file, theID) {
    var form_data = new FormData();
    form_data.append("task",task);
    form_data.append("type",type);
    form_data.append("postID",jQuery("#post_ID").val());
    form_data.append("ID",theID);
    form_data.append("file",file);
    
    jQuery.ajax({
    url:'/charts/php/UpdateDB/update_db.php',
    // timeout: 15000,
    method:'POST',
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
    xhr: function()
        {var xhr = jQuery.ajaxSettings.xhr();
            xhr.upload.onprogress = function(e) {
                if ( e.lengthComputable ) {
                    var progress = Math.ceil(e.loaded / e.total * 100);
                    if( progress < 100)
                    jQuery('#msg').html("UPLOADING " + progress + "%");
                    else {
                        upload_timeout_id = setInterval(function() {
                            jQuery.post("/charts/php/UpdateDB/check_update_status.php",function(data) {
                                console.log( data.length!=0 ? data+' string length='+data.length : 'No text provided by check_update_status.php');
                                if ( data!='') jQuery('#msg').html(data);
                            });
                        },100);
                    }
                }
            };
            return xhr;
        },
    beforeSend: function(jqXHR, settings){
        if ( type=='upload_file' ) jQuery('#msg').html('Uploading File: '+file);
        jQuery('#loading_gif').show();
    },
    success: function( data, textStatus, jqXHR) {
        data = data.replace(/(\r\n|\n|\r)/gm,""); // If any blank lines at end of *any* php files after >? will return extra \n
        clearInterval(upload_timeout_id);
        if ( data.toUpperCase().indexOf('ERROR') !== -1 ) {
           alert(data);
           jQuery('#loading_gif').hide();
            setTimeout(function(){
                jQuery('#msg').html("");
            }, 3000);
        } else {
           jQuery('#msg').html("Loading Feature Image (" + data + ")");
           setTimeout(function(){ // Wait a bit for wp.media.featuredImage.set to process
                jQuery('#loading_gif').hide();
                jQuery('#msg').html("Successfully Changed Feature Image");
            }, 5000);
           wp.media.featuredImage.set(data);
       }
    },
    error: function (jqXHR, exception) {
        clearInterval(upload_timeout_id);
        var msg = '';
        if (jqXHR.status === 0)               msg = 'Not connected. Verify Network.';
        else if (jqXHR.status == 404)         msg = 'Requested page not found. [404]';
        else if (jqXHR.status == 500)         msg = 'Internal Server Error [500].';
        else if (exception === 'parsererror') msg = 'Requested JSON parse failed.';
        else if (exception === 'timeout')     msg = 'Time out error.';
        else if (exception === 'abort')       msg = 'Ajax request aborted.';
        else                                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
        alert(msg);
        jQuery('#msg').html("");
        jQuery('#loading_gif').hide();
    },
    complete: function(jqXHR, textStatus ) {
        //setTimeout(function(){ // Make sure it hides utlimately
        //    jQuery('#loading_gif').hide();
        //}, 10000);
    }
    });
}

function createChartImages(type) {
    var cvlink = document.getElementById('cvlink');
    var parts = cvlink.value.split("?");
    if (parts.length < 2 || parts[1]=='ll=,&z=' ) {
        alert('You must first create a valid Chartview URL before generating the Image.');
        return;
    }
    if ( type==='chartlet' ) setImageSrc('#chartlet_image', '', "Please wait, loading ... ");
    // jQuery('#msg').html("Creating chart images ..");
    var postID = jQuery("#post_ID").val();
    var url = '/charts/php/makechartimages.php?' + parts[1] +'&postID='+postID+'&type='+type;
    jQuery.post(url,function(data,status,xhr) {
        var fb_radio = jQuery("#facebook-image-options input[type='radio']:checked");
        var imagetype = fb_radio.attr('value');
        if ( data.toUpperCase().indexOf('ERROR') !== -1 ) {
            alert("ERROR OCCURRED: " + data);
        } else if ( this.url.indexOf('&type=chartlet') !==-1 ) {
            setImageSrc('#chartlet_image', data, data);
        } else if ( this.url.indexOf('&type=small')    !==-1 ) {
            if ( imagetype==='small' ) fixedChoiceFeatureImage();
        } else if ( this.url.indexOf('&type=large')    !==-1 ) {
            if ( imagetype==='large' ) fixedChoiceFeatureImage();
        } else {
            alert("Unknown type: "+type+" with url: "+this.url);
        }
    }, "text")
    .success(function(response){
        if (response.status == 400 ) {
            //error stuff
        }
    })
    .done(function() {
        // alert( "second success" );
    })
    .fail( function(xhr, textStatus, errorThrown) {
        alert("REQUEST FAIL: " + xhr.responseText);
    })
    .always(function() {
        // alert( "Finished" );
    });
}

function setImageSrc(img_id, src, alt) {
    var img = jQuery(img_id)[0];
    img.alt = alt;
    img.src = src;
    var image_a = jQuery(img_id+'_url');
    image_a.prop('href', src);
}

function refreshChartImages($showAlert) {
    var clat=document.getElementById('cvcf-latitude_dec');
    var clon=document.getElementById('cvcf-longitude_dec');
    var cz=document.getElementById('cvcf-zoomlevel');
    var chl=document.getElementById('marina_highlight');
    
    var error='';
    if ( typeof clat === 'undefined' || clat == null || clat.value.length==0) error=error+"- No Latitude\n";
    if ( typeof clon === 'undefined' || clon == null || clon.value.length==0) error=error+"- No Longitude\n";
    if ( typeof cz   === 'undefined' || cz   == null || cz.value.length==0  ) error=error+"- No Zoom\n";
    if ( typeof chl  === 'undefined' || chl  == null || typeof chl.checked !== 'boolean'  ) error=error+"- No marina_highlight\n";
    if ( error!='' ) {
        if ( $showAlert ) alert("ERROR - Cannot build ChartView URL due due:\n"+error);
        return;
    }
    var url = '/cruisersnet-marine-map/?ll='+clat.value+','+clon.value+'&z='+cz.value + (chl.checked ? '&highlight=1' : '');
    jQuery('#cvlink').val(url);
    //
    //  Create the images
    //
    createChartImages('chartlet');
    createChartImages('small');
    createChartImages('large');
}

function IsImageOk(img) {
    if ( typeof img === 'undefined' ) return false;
    if ( img.naturalWidth > 0 && img.naturalHeight > 0)
            return true;
    if ( ! img.complete)
            return false;
    return true;
}

