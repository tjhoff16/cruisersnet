<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/CruisersNet/includes/get_question.php');
    if ( isset($dbCharts) )
        $question = ! isset($_COOKIE['nCookie']) ? get_newsletter_questions($dbCharts) :
                                                   get_question( $dbCharts, isset($_COOKIE['qCookie']) ? $_COOKIE['qCookie'] : -1 );
    /*
    if( ! isset($_COOKIE['nCookie']) ) {
        $question = get_newsletter_questions();
    } else {
        $lastQuestionNum=-1;
        $qCookie = 'qCookie'; // Tracking general question
        if( isset($_COOKIE[$qCookie]) ) $lastQuestionNum = $_COOKIE[$qCookie];
        $question = get_question($lastQuestionNum);
    }

    <script type='text/javascript' src='/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
    <script type='text/javascript' src='/wp-includes/js/jquery/jquery-migrate.js?ver=1.4.1'></script>
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/jquery-ui.min.js"></script>

     */
echo <<<HTML1
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Question Testings</title>
<link href="/wp-content/themes/CruisersNet/css/bootstrap.css" rel="stylesheet">
<link href="/wp-content/themes/CruisersNet/css/styles.css" rel="stylesheet">
<link href="/wp-content/themes/CruisersNet/css/icoMoon.css" rel="stylesheet">
<link href="/wp-content/themes/CruisersNet/css/font-awesome.min.css" rel="stylesheet">
<script type='text/javascript' src='/wp-content/themes/CruisersNet/js/questions.js'></script>
</head>
<body>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<a href="javascript:resetQuestions()"><div class="cnet-button blue cnet-button-small cnet-button-right">&nbsp;Reset Questions&nbsp;</div></a>
    <br />
    <br />
HTML1;

    if( isset($question) && $question!="" ) {
        echo '<style>';
        echo '.divDialog { width: 500px; max-height: 400px; }';
        echo '.ui-dialog .ui-dialog-titlebar { height: 0px; }';
        echo '</style>';
        echo $question . '<div id="divDialog" style="background-color:white; border: 2px solid black; padding: 0px 20px 0px 20px;"></div>';
    }

echo <<<HTML4
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
</body>
</html>
HTML4;

?>
