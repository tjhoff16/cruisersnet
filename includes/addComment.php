<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Detroit');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/charts/php/UpdateDB/libraries/swiftmailer-5.x/lib/swift_required.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/charts/php/includes/db_v3.php');
    header('Content-Type: application/json');
    $response = [ 'commentError' => TRUE, 'commentType' => 'UNDEFINED' ];
    //
    //  Validate the input
    //
    $inputErrors = validateInput();
    if ( count($inputErrors)!=0 ) {
        $response=array_merge($response,$inputErrors);
    } else {
        //
        //  Process valid input - insert or email
        //
        $email     = htmlentities($_POST['comment_email'], ENT_QUOTES);
        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $response['commentEmailError'] = "Email '$email' is invalid.";
        } else {
            $postID    = $_POST['comment_post_ID'];
            $author    = htmlentities($_POST['comment_name'], ENT_QUOTES);
            $message   = htmlentities($_POST['comment_message'], ENT_QUOTES);
            $ipaddress = get_client_ip();
            if ( $postID>0 ) {
                insertComment($dbWP, $postID, $author, $email, $message, $ipaddress);
            } else {
                $subject = htmlentities($_POST['comment_subject'], ENT_QUOTES);
                emailComment($author, $email, $subject, $message, $ipaddress);
            }
        }
    }
    //
    //  Return data to caller
    //
    mysqli_close($dbCharts);
    mysqli_close($dbWP);
    echo json_encode($response);
    
    
    /*************************************************************
    
     
     *************************************************************/

    function insertComment($dbWP, $postID, $author, $email, $message, $ipaddress) {
        global $response;
        $response['commentType']='inserted';
        //
        // Input is valid, insert into database
        //
        $date  = date("Y-m-d H:i:s", time());
        $gmt   = gmdate("Y-m-d H:i:s", time());
        $agent = $_SERVER['HTTP_USER_AGENT'];
        /*
         `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
           `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
           `comment_author` tinytext NOT NULL,
           `comment_author_email` varchar(100) NOT NULL DEFAULT '',
         `comment_author_url` varchar(200) NOT NULL DEFAULT '',
           `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
           `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
           `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
           `comment_content` text NOT NULL,
         `comment_karma` int(11) NOT NULL DEFAULT '0',
           `comment_approved` varchar(20) NOT NULL DEFAULT '1',
           `comment_agent` varchar(255) NOT NULL DEFAULT '',
         `comment_type` varchar(20) NOT NULL DEFAULT '',
         `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
         `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
         */
        $dquery = "INSERT INTO wp_comments (comment_post_ID,comment_author,comment_author_email,comment_author_IP,comment_date,comment_date_gmt,comment_content,comment_approved,comment_agent) VALUES($postID,'$author','$email','$ipaddress','$date','$gmt','$message',0,'$agent')";
        $response['commentQuery'] = $dquery;
        //
        //  Check the insert success
        //
        if ( $res = mysqli_query($dbWP, $dquery) ) {
            unset($response['commentError']);
            $response['commentSubmitStatus']='Successful';
        } else {
            $response['commentSQLError'] = mysqli_error($dbWP);
        }
    }
    
    function emailComment($author, $email, $subject, $content, $ipaddress) {
        global $emailPW, $response;
        $response['commentType']='emailed';
        $emailTO   = array('Curtis.Hoff@CruisersNet.net');  // Contact@cruisersnet.net
        if ( ! isset($emailPW) ) {
            $response['commentEmailPWError'] = 'ERROR: Email password not set.';
            return;
        }
        $from = 'CurtisJHoff@SeaDocSoftware.com';
        $transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
        ->setUsername($from)
        ->setPassword($emailPW);
        $mailer = Swift_Mailer::newInstance($transport);
        
        $messageBody = createMessageBody($author, $email, $subject, $content, $ipaddress);
        
        $message = Swift_Message::newInstance("SSECN CRUISING NEWS SUBMISSION")
        ->setFrom($from)
        ->setTo  ($emailTO)
        ->setCc  ($email)
        ->setBody($messageBody, 'text/html');
        try {
            $mailer->send($message);
            unset($response['commentError']);
            $response['commentSubmitStatus']='Successful';
        }
        catch (\Swift_TransportException $e) {
            $response['commentEmailError'] = 'ERROR: ' . $e->getMessage();
        }
    }
    
    function createMessageBody($author, $email, $subject, $content, $ipaddress) {
        $latlon = "Unknown";
        $org = "Unknown";
        $city = "Unknown";
        $region = "Unknown";
        $country = "Unknown";
        $ipDetails = json_decode(@file_get_contents("http://ipinfo.io/{$ipaddress}/json"));
        if ( is_object($ipDetails) ) {
            if ( property_exists($ipDetails, 'loc'    ) ) $latlon  = $ipDetails->loc;
            if ( property_exists($ipDetails, 'org'    ) ) $org     = $ipDetails->org;
            if ( property_exists($ipDetails, 'city'   ) ) $city    = $ipDetails->city;
            if ( property_exists($ipDetails, 'region' ) ) $region  = $ipDetails->region;
            if ( property_exists($ipDetails, 'country') ) $country = $ipDetails->country;
        }
        /*
            $latlon = $ipDetails->loc;
            $org = $ipDetails->org;
            $city = $ipDetails->city;
            $region = $ipDetails->region;
            $country = $ipDetails->country;
         */
        return
'<html><head><title>SSECN CRUISING NEWS SUBMISSION</title></head>' .
  '<body><table width="99%" border="0" cellpadding="1" cellspacing="0" bgcolor="#EAEAEA"><tr><td>' .
        '<table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF"> ' .
           addTableRow('Your Name',     $author    ) .
           addTableRow('Your Email',    "<a href='mailto:$email'>$email</a>"  ) .
           addTableRow('Subject',       $subject   ) .
           addTableRow('Cruising News', $content   ) .
           addTableRow('IP',            $ipaddress ) .
           addTableRow('Lat/Lon',       "<a href='http://www.google.com/maps/place/$latlon'>$latlon</a>" ) .
           addTableRow('ISP Organization',  $org ) .
           addTableRow('Location',      "$city, $region  $country" ) .
        '</table></td></tr>' .
    '</table></body></html>';
}
    
    function addTableRow($title, $data) {
        return
'<tr bgcolor="#EAF2FA"><td colspan="2"><font style="font-family: sans-serif; font-size:12px;"><strong>' . $title . '</strong></font></td></tr>' .
'<tr bgcolor="#FFFFFF"><td width="20">&nbsp;</td><td>' . $data . '</td></tr>' ;
}

    function validateInput() {
        $inputErrors=array();
        $inputErrors=isInputSet($inputErrors, 'comment_email');
        $inputErrors=isInputSet($inputErrors, 'comment_message');
        $inputErrors=isInputSet($inputErrors, 'comment_name');
        $inputErrors=isInputSet($inputErrors, 'comment_parent');
        $inputErrors=isInputSet($inputErrors, 'comment_post_ID');
        $inputErrors=isInputSet($inputErrors, 'comment_subject');
        // $inputErrors=isInputSet($inputErrors, 'error_testing');
        return $inputErrors;
    }

    function isInputSet($inputErrors, $d) {
        if ( isset($_POST[$d]) ) return $inputErrors;
        $inputErrors[]="ERROR: $d is not set";
        return $inputErrors;
    }
    
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

