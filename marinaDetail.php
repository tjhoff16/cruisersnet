<?php

include('/var/www/vhosts/cruisersnet.net/httpdocs/charts/includes/db_v3.php');
include('/var/www/vhosts/cruisersnet.net/httpdocs/charts/includes/kml_helpers.php');
include('/var/www/vhosts/cruisersnet.net/httpdocs/wp-content/plugins/adrotate-pro/adrotate-functions.php');
mysql_select_db('cnetv3_earthnc',$dbh);

if (isset($_GET['id'])){
$dquery = 'SELECT * FROM poiV3 WHERE category="marina" AND id='.(int)$_GET['id'].' LIMIT 1';
$res = mysql_query($dquery,$dbh);
//echo $dquery;

$iconbase = '/charts/icons/';

while ($br = mysql_fetch_assoc($res)){

  // get the post metadata and create an associative array
  mysql_select_db('cnetv3',$dbi);
  $metaArray = array();
  $metaQ = 'SELECT * from wp_postmeta WHERE post_id='.$br['post_id'];
  $meta_query = mysql_query($metaQ,$dbi);
  while($meta = mysql_fetch_assoc($meta_query)){
    $metaArray[$meta['meta_key']]= $meta['meta_value'];
  }
  
  $lat = $metaArray['cvcf-latitude_dec'];
  $lon = $metaArray['cvcf-longitude_dec'];
  
   
  //get the number of comments
  mysql_select_db('cnetv3',$dbi);
  $cquery = 'SELECT * from wp_comments WHERE comment_post_ID='.$br['post_id'];
  $cres = mysql_query($cquery,$dbi);
  $numcoms = mysql_num_rows($cres);
  if ($numcoms==0){$commentAnchor='repsond';}else{$commentAnchor='comments';}
  $desc = '';
  $desc .= '<div class="popUpTitle">'.$br['name'].'</div>';
  $desc .='<a href="/marina/'.$br['slug'].'" target="_blank">(Click Here to View This Facility\'s Full Marina Directory Listing)</a><br><br>
           This Marina has '.$numcoms.' Comments/Reviews<br><a href="/marina/'.$br['slug'].'/#'.$commentAnchor.'" target="_blank">Click Here to Read/Submit Comments/Reviews</a><br>';
  
  if (isset($metaArray['marina_sponsor_ad_id']) && $metaArray['marina_sponsor_ad_id']!='') {
           $hash = function_exists (adrotate_hash) ? adrotate_hash($metaArray['marina_sponsor_ad_id'], 0, 0) : '';
           $desc .= '<br><center><a class="gofollow" data-track="'.$hash.'"href="'.$metaArray['marina_url'].'" target="_blank"><img src="'.$metaArray['marina_sponsor_graphic'].'" /></a><br>';
  }

  if (isset($metaArray['marina_phone']) && $metaArray['marina_phone']!=''){
    $desc .= '<br>'.$metaArray['marina_phone'];
  }
  
  if (isset($metaArray['marina_url']) && $metaArray['marina_url']!=''){
    if (isset($metaArray['marina_sponsor_ad_id']) && $metaArray['marina_sponsor_ad_id']!=''){
      $desc .= '<br><a href="'.$metaArray['marina_url'].'" target="_blank">'.$metaArray['marina_url'].'</a>';
    } else {
      $desc .= '<br>'.$metaArray['marina_url'].'<br>';
    }
  }
  
  if (isset($metaArray['marina_statute_mile']) && $metaArray['marina_statute_mile']!=''){
    $desc .= '<br><br>Statute Mile: '.$metaArray['marina_statute_mile'];
  }
  
  if (isset($metaArray['cvcf-lat_deg']) && $metaArray['cvcf-lat_deg']!=''){
    if ($metaArray['cvcf-lat_dir']!=-1){$ldir='N';} else {$ldir='S';}
    if ($metaArray['cvcf-lon_dir']!=-1){$lgdir='E';} else {$lgdir='W';}
    $desc .= '<br>Lat/Lon: '.$metaArray['cvcf-lat_deg'].'&deg; '.$metaArray['cvcf-lat_min'].$ldir.', '.
                                $metaArray['cvcf-lon_deg'].'&deg; '.$metaArray['cvcf-lon_min'].$lgdir;
  }
  
  if (isset($metaArray['marina_location']) && $metaArray['marina_location']!=''){
    $desc .= '<br>Location: '.str_replace('’',"'",$metaArray['marina_location']);
  }
  
  if (isset($metaArray['marina_depth_min']) && $metaArray['marina_depth_min']!=''){
    $desc .= '<br>Depths: '.$metaArray['marina_depth_min']."ft.";
    if (isset($metaArray['marina_depth_max']) && $metaArray['marina_depth_max']!=''){
     $desc .=' to '.$metaArray['marina_depth_max']."ft.";
     }
  }
  
  if ((isset($metaArray['gas_price']) && $metaArray['gas_price']!='') || (isset($metaArray['diesel_price']) && $metaArray['diesel_price']!='')){
    $desc .= '<br><br>Fuel Price Reporting Date: '.str_replace('’',"'",$metaArray['marina_reporting_date']);
    if (isset($metaArray['gas_price']) && $metaArray['gas_price']!=''){
      $desc .='<br>Gasoline Price (including all taxes): $'.$metaArray['gas_price'];
    }
    if (isset($metaArray['diesel_price']) && $metaArray['diesel_price']!=''){
      $desc .='<br>Diesel Price (including all taxes): $'.$metaArray['diesel_price'];
    }
    $desc .='<br><a href="/marina/'.$br['slug'].'/#fuel-div" target="_blank">Click Here For Complete Fuel Price Info</a>';
  }
    
    /*
    if ($loc_flag==0) $desc .= $desctmp[$i].'<br>';
    if (strpos($desctmp[$i],'Location:')!==false) $loc_flag=1;
    if (strpos($desctmp[$i],'Depths:')!==false){
      if ($loc_flag==0){$loc_flag=1;} 
      else {$desc .= $desctmp[$i].'<br>'; $loc_flag=1;}
      }
    if ($i>12 && strpos($desctmp[$i],'<img src=')!==false ) {
    //$desc.='fuel:'.$desctmp[$i];
    
    if (strpos($desctmp[$i],'<img src="/images/SSE_fuel1button.jpg"')!==false || strpos($desctmp[$i],'<img src="/images/SSE_fuel1button.jpg')!== false){
    //$desc .='Fuel1';
        // get the URL
        $st = strpos($desctmp[$i],'"'); $en = strpos($desctmp[$i],'"',$st+1);
        $slug = explode('/',substr($desctmp[$i],$st+1,$en-$st-1)); $slug = $slug[count($slug)-1];
        $fplink = $slug;
        //get the fuel post
        mysql_select_db('cnetv3',$dbi);
        $fquery = 'SELECT post_content FROM wp_posts WHERE post_name="'.$slug.'" LIMIT 1';
        //echo $fquery;
        $fres = mysql_query($fquery,$dbi);
        $slug = mysql_fetch_assoc($fres);
        $slug = str_replace("\r\n",'<br />',$slug['post_content']);
        $st = strpos($slug,'Reporting');
        $en = strpos($slug,'Any');
        $desc.= '<br />Fuel Price '.rtrim(substr($slug,$st,$en-$st).'<a href="/'.$fplink.'" target="_blank">Click for Full Price Info</a><br /><br />');
        } //exit fuel price check    
    //$desc .= $desctmp[$i];
    break;
    }
    }
    
    */
    
    
    // put in the marina service icons
    mysql_select_db('cnetv3',$dbi);
    $iquery = 'SELECT * FROM  `wp_postmeta` WHERE meta_key LIKE "mcf-%" AND meta_key NOT LIKE "mcf-%notes" AND post_id='.$br['post_id'];
    $res2 = mysql_query($iquery,$dbi);
    $sicons = '';
    while ($im = mysql_fetch_assoc($res2)){  
        if(is_file('../../wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/' . $im['meta_key'] . '-v3.png') && $im['meta_value']=="yes"){
				//$desc.=$im['meta_value'];
        $sicons .= '<img class="marina-services" width="48" height="48" alt=' . $im['meta_key'] . ' src="/wp-content/themes/CruisersNetBlue-DynamicHome/images/marina-services/' . $im['meta_key'] . '-v3.png" />';
        }
    }
    
    $desc = $desc.'<br><br>'.$sicons.'<br><br><br><br>';



//}
echo $desc;
}
}

?>
