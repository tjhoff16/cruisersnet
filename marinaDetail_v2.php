<?php

include('/var/www/vhosts/cruisersnet.net/httpdocs/charts/includes/db.php');
include('/var/www/vhosts/cruisersnet.net/httpdocs/charts/includes/kml_helpers.php');
mysql_select_db('cnet0617_earthnc',$dbh);

if (isset($_GET['id'])){
$dquery = 'SELECT * FROM poi WHERE category="marina" AND id='.(int)$_GET['id'].' LIMIT 1';
$res = mysql_query($dquery,$dbh);

$iconbase = '/charts/icons/';
//$kmlname='marinas_gmap.kml';

while ($br = mysql_fetch_assoc($res)){
    $desc = stripslashes(str_replace(array('Â',' Ãƒâ€šÃ‚Â','¼',"’",'”','“','—','’','–','.',' ',"\r\n",'/images/','½'),
                                               array(' ',' ','1/4',"'",'"','"',"-","'",'-','.',' ','<br>','/images/','1/2'),$br['description']));
    $desc = str_replace('<br />','<br>',$desc);
    $desctmp = explode('<br>',$desc);
    $desc = '';
    $loc_flag = 0;
    for ($i=0; $i<count($desctmp); $i++){
    if ($i==0) $desctmp[$i] = '<b><a href="/'.$br['slug'].'" target="_blank">'.$desctmp[$i].' (Click For This Facility\'s Full Marina Directory Listing)</a><br>
                                  <a href="/'.$br['slug'].'" target="_blank">This Marina has '.$br['comments'].' Comments. (Click to Read/Submit Comments)</a></b>';
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
        mysql_select_db('cnet0617_wpcruisers',$dbi);
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
    // put in the marina service icons
    mysql_select_db('cnet0617_wpcruisers',$dbi);
    $iquery = 'SELECT * FROM  `wp_postmeta` WHERE meta_key LIKE "mcf-%" AND post_id='.$br['post_id'];
    $res2 = mysql_query($iquery,$dbi);
    $sicons = '';
    while ($im = mysql_fetch_assoc($res2)){  
				$sicons .= '<img class="marina-services" width="48" height="48" alt=' . $im['meta_key'] . ' src="/wp-content/themes/CruisersNetBlue/images/marina-services/' . $im['meta_key'] . '.png" />';
    }
    
    $desc = $desc.'<br>'.$sicons.'<br><br><br><br>';

}


echo $desc;

}

?>
