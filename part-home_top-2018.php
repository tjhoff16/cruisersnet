<?php
    echo '<!-- BEGIN ' . basename(__FILE__) . ' -->';
    echo '<!-- Begin Constant Contact Active Forms -->';
    echo '<script> var _ctct_m = "702562fd485569797bdd7327ee122cd8"; </script>';
    echo '<script id="signupScript" src="//static.ctctcdn.com/js/signup-form-widget/current/signup-form-widget.min.js" async defer></script>';
    echo '<!-- End Constant Contact Active Forms -->';
    echo "<div id='divDialog' class='dialog_newsletter_div'></div>";
    echo "<div id='divNewsletter' class='dialog_newsletter_div'>";
    include ($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/CruisersNet/newsletter_question.php');
    echo "</div>";
    include ($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/CruisersNet/comment_question.php');
    //
    //  Process other question is newletter question answer is set
    //
    include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/CruisersNet/includes/get_question.php');
    if ( ! isset($_COOKIE['nCookie']) ) {
        echo '<!-- nCookie is: NOT SET -->';
        echo get_newsletter_questions($dbCharts);
    } else {
        $nCookieValue = $_COOKIE['nCookie'] ;
        echo "<!-- nCookie is: $nCookieValue -->";
        $qCookieValue = isset($_COOKIE['qCookie']) ? $_COOKIE['qCookie'] : -1;
        echo "<!-- qCookie is: $qCookieValue -->";
        echo get_question($dbCharts, $qCookieValue);
    }
    echo '<!-- END ' . basename(__FILE__) . ' -->';
?>
