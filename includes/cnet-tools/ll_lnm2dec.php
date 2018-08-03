<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    if ( ! isset($_GET['ll']) ) die("no ll error");
    // Clean up data
    $latlon=strtoupper($_GET['ll']);
    $chars=array('N','S','E','W','/',',',':',';','|',' ');
    foreach ( $chars as $c ) $latlon=str_replace(array("  $c"," $c","$c  ","$c "),
                                                 array(  "$c", "$c","$c",  "$c"), $latlon);
    $latlon=str_replace(array('N','S','E','W'),array('','','',''),$latlon);
    $exploded = array($latlon);
    if      ( strpos($latlon,'/') !== FALSE ) $exploded = explode('/',$latlon);
    else if ( strpos($latlon,',') !== FALSE ) $exploded = explode(',',$latlon);
    else if ( strpos($latlon,':') !== FALSE ) $exploded = explode(':',$latlon);
    else if ( strpos($latlon,';') !== FALSE ) $exploded = explode(';',$latlon);
    else if ( strpos($latlon,'|') !== FALSE ) $exploded = explode('|',$latlon);
    $count = count($exploded);
    if      ( $count==1 ) die( convertLLToFloat($exploded[0]) );
    else if ( $count==2 ) die( convertLLToFloat($exploded[0]).',-'.convertLLToFloat($exploded[1]) );
    die("explode count error: $latlon");

function convertLLToFloat($str) {
    $str=str_replace(' ','-',$str);
    $exploded = explode('-', $str);
    foreach ($exploded as $part )
        if ( ! is_numeric($part) ) die("part numeric error: '$part'");
    $count = count($exploded);
    if ( $count<1 || $count>4) die("dash count error: $str");
    $floatValue = abs($exploded[0]);
    if ( $count>1 ) $floatValue += abs($exploded[1]/60);
    if ( $count>2 ) $floatValue += abs($exploded[2]/3600);
    if ( $count>3 ) $floatValue += abs($exploded[3]/3600/10);
    return sprintf("%.6f", $floatValue);
}

