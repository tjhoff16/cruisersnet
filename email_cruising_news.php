<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    date_default_timezone_set('America/Detroit');
    header('Content-Type: application/text');
    
    $name = "MY NAME";
    $email = "MY EMAIL";
    $subject = "MY SUBJECT";
    $cruisingnews = "MY CRUISING NEWS";
    
    $start = <<<EOT
    <html>
    <head><title>SSECN CRUISING NEWS SUBMISSION</title></head>
    <body>
    <table width="99%" border="0" cellpadding="1" cellspacing="0" bgcolor="#EAEAEA"><tr><td>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
    EOT;
    
    $middle =   row('Your Name', $name) .
                row('Your Email', "<a href='mailto:$email'>$email</a>") .
                row('Subject', $subject) .
                row('Cruising News', $cruisingnews);
    
    $end = <<<EOT
    </table></td></tr>
    </table>
    </body>
    </html>
    EOT;
    
    $data = $start . $middle . $end;
    echo $data;
    
    function row($title, $data) {
        return
        '<tr bgcolor="#EAF2FA">' .
        '  <td colspan="2"><font style="font-family: sans-serif; font-size:12px;"><strong>' . $title . '</strong></font></td>' .
        '</tr>' .
        '<tr bgcolor="#FFFFFF">' .
        ' <td width="20">&nbsp;</td>' .
        ' <td><font style="font-family: sans-serif; font-size:12px;">' . $data . '</font></td>' .
        '</tr>';
    }
?>
