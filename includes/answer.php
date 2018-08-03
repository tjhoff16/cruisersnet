<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/charts/php/includes/db_v3.php');
    $qnumber   = htmlentities($_POST['qnumber'], ENT_QUOTES);
    $snippet   = htmlentities($_POST['snippet'], ENT_QUOTES);
    $answer    = htmlentities($_POST['answer'],  ENT_QUOTES);
    $ipaddress = get_client_ip();

    $dquery = "INSERT INTO Answers (qnumber,snippet,answer,IP) VALUES ('$qnumber','$snippet','$answer','$ipaddress')";
    
    if ( $res = mysqli_query($dbCharts, $dquery) ) {
        echo 'Success! ';
    } else {
        echo 'Failure! Err: ' . mysqli_error($dbCharts);
    }
    echo ' Snippet:' . $snippet . ' Qnswer: ' . $answer . ' IPAddress: ' . $ipaddress;
    mysqli_close($dbCharts);
    
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
?>
