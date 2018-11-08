<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="../main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<CENTER>

<?php

require_once '../config.php';

// Create connection
$dbname = "campaigns";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive Notification Request from Embedded Email
if(isset($_REQUEST['target']) || isset($_REQUEST['campaignname'])){
	
$target = $_REQUEST['target'];

$campaignname = $_REQUEST['campaignname'];	
	
$ip = $_SERVER['REMOTE_ADDR'];

$ua = $_SERVER['HTTP_USER_AGENT'];
	
// Insert Request Into DATABASE
$insertrequest = "CALL InsertRequest('$target','$campaignname','$ip','$ua');";

$result = $conn->query($insertrequest);

// Send Slack Notification	
$message = "Email was just opened by ".$target." using ".$campaignname." campaign! (<".$APIDomain."/campaigns/results?ip=".$ip."|".$ip.">)";

$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$slackchannel.'", "username": "EmailBot", "text": "'.$message.'", "icon_emoji": ":e-mail:"}\' '.$SlackIncomingWebhookURL.'';
//echo $cmd;
exec($cmd);	
	
}

// View an Existing Campaign Template's Contents
if(isset($_REQUEST['content'])){

$content = base64_encode($_REQUEST['content']);
$campaign = $_REQUEST['campaign'];
if(isset($_REQUEST['variable1name'])){$variable1name = $_REQUEST['variable1name'];}else{$variable1name = "";}
if(isset($_REQUEST['variable2name'])){$variable2name = $_REQUEST['variable2name'];}else{$variable2name = "";}
if(isset($_REQUEST['variable3name'])){$variable3name = $_REQUEST['variable3name'];}else{$variable3name = "";}
if(isset($_REQUEST['variable4name'])){$variable4name = $_REQUEST['variable4name'];}else{$variable4name = "";}
if(isset($_REQUEST['variable5name'])){$variable5name = $_REQUEST['variable5name'];}else{$variable5name = "";}
if(isset($_REQUEST['variable6name'])){$variable6name = $_REQUEST['variable6name'];}else{$variable6name = "";}
if(isset($_REQUEST['variable7name'])){$variable7name = $_REQUEST['variable7name'];}else{$variable7name = "";}
if(isset($_REQUEST['variable8name'])){$variable8name = $_REQUEST['variable8name'];}else{$variable8name = "";}
if(isset($_REQUEST['variable9name'])){$variable9name = $_REQUEST['variable9name'];}else{$variable9name = "";}
if(isset($_REQUEST['variable10name'])){$variable10name = $_REQUEST['variable10name'];}else{$variable10name = "";}

$createcampaignsql = "CALL CreateModifyCampaign('$campaign','$content','$variable1name','$variable2name','$variable3name','$variable4name','$variable5name','$variable6name','$variable7name','$variable8name','$variable9name','$variable10name');";

$result = $conn->query($createcampaignsql);

?>

<BR><BR><FONT COLOR="#FFFFFF"><H3>Saved!</H3></FONT>

<BR><BR><FORM METHOD="GET" ACTION="../index.php">

<button class="btn" style="width:10%" type="submit">Home</button>

</FORM>

<?php

} else {

if(isset($_REQUEST['existingcampaign'])){

$campaign = $_REQUEST['existingcampaign'];

$selectcampaignsql = "CALL SelectCampaign('$campaign');";

$result = $conn->query($selectcampaignsql);


?>

<FONT COLOR="#FFFFFF">

<h2>Email Campaign from Template</h2>




<?php

if($campaign == "New"){ ?>

<FORM ACTION="<?php $_SERVER["PHP_SELF"]; ?>" METHOD="POST" enctype="multipart/form-data">

<b>Name of Campaign: </b><INPUT TYPE="TEXT" Value="" Name="campaign">

<br><br>

<script>
function Addvariable1()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable1name").value + "}}";

iFrameBody.focus();
}

function Addvariable2()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable2name").value + "}}";

iFrameBody.focus();
}

function Addvariable3()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable3name").value + "}}";

iFrameBody.focus();
}

function Addvariable4()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable4name").value + "}}";

iFrameBody.focus();
}

function Addvariable5()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable5name").value + "}}";

iFrameBody.focus();
}

function Addvariable6()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable6name").value + "}}";

iFrameBody.focus();
}

function Addvariable7()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable7name").value + "}}";

iFrameBody.focus();
}

function Addvariable8()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable8name").value + "}}";

iFrameBody.focus();
}

function Addvariable9()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable9name").value + "}}";

iFrameBody.focus();
}

function Addvariable10()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "{{" + document.getElementById("variable10name").value + "}}";

iFrameBody.focus();
}


</script>

<?php if($campaign == "New"){ ?>

Variable 1: <input id="variable1name" name="variable1name" type="text" value="" placeholder="e.g. FirstName"><input name="variable1button" type="button" value="Add" onclick="Addvariable1()" /><br />
<BR>
Variable 2: <input id="variable2name" name="variable2name" type="text" value="" placeholder="e.g. LastName"><input name="variable2button" type="button" value="Add" onclick="Addvariable2()" /><br />
<BR>
Variable 3: <input id="variable3name" name="variable3name" type="text" value="" placeholder="e.g. HyperlinkMarkup"><input name="variable3button" type="button" value="Add" onclick="Addvariable3()" /><br />
<BR>
Variable 4: <input id="variable4name" name="variable4name" type="text" value="" placeholder="e.g. SenderFirstName"><input name="variable4button" type="button" value="Add" onclick="Addvariable4()" /><br />
<BR>
Variable 5: <input id="variable5name" name="variable5name" type="text" value="" placeholder="e.g. SenderLastName"><input name="variable5button" type="button" value="Add" onclick="Addvariable5()" /><br />
<BR>
Variable 6: <input id="variable6name" name="variable6name" type="text" value="" placeholder="e.g. RecipientCompany"><input name="variable6button" type="button" value="Add" onclick="Addvariable6()" /><br />
<BR>
Variable 7: <input id="variable7name" name="variable7name" type="text" value="" placeholder="e.g. SenderCompany"><input name="variable7button" type="button" value="Add" onclick="Addvariable7()" /><br />
<BR>
Variable 8: <input id="variable8name" name="variable8name" type="text" value="" placeholder="e.g. EmailSignature"><input name="variable8button" type="button" value="Add" onclick="Addvariable8()" /><br />
<BR>
Variable 9: <input id="variable9name" name="variable9name" type="text" value="" placeholder="e.g. RecipientDepartment"><input name="variable9button" type="button" value="Add" onclick="Addvariable9()" /><br />
<BR>
Variable 10: <input id="variable10name" name="variable10name" type="text" value="" placeholder="e.g. SenderDepartment"><input name="variable10button" type="button" value="Add" onclick="Addvariable10()" /><br />
<BR>

<?php
}} else {
// IF THE CAMPAIGN IS AN EXISTING ONE, SHOW MARKUP FROM DATABASE
?>
<TABLE BORDER="0">
<TR><TH>Name of Campaign: </TH><TH><INPUT TYPE="TEXT" Value="<?php echo $campaign; ?>" Name="campaign" ID="campaigntitle"></TH></TR>

<?php } 

if($campaign != "New"){ 

$x = 1;

    // output data of each row
    while($row1 = $result->fetch_assoc()) {
?>
		
<script>
function Replacevariables()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

<?php

if($row1['Variable1Name'] != ""){

?>

var variable1value = document.getElementById("variable1name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable1Name']; ?>}}/g, variable1value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable2Name'] != ""){

?>

var variable2value = document.getElementById("variable2name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable2Name']; ?>}}/g, variable2value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable3Name'] != ""){

?>

var variable3value = document.getElementById("variable3name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable3Name']; ?>}}/g, variable3value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable4Name'] != ""){

?>

var variable4value = document.getElementById("variable4name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable4Name']; ?>}}/g, variable4value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable5Name'] != ""){

?>

var variable5value = document.getElementById("variable5name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable5Name']; ?>}}/g, variable5value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable6Name'] != ""){

?>

var variable6value = document.getElementById("variable6name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable6Name']; ?>}}/g, variable6value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable7Name'] != ""){

?>

var variable7value = document.getElementById("variable7name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable7Name']; ?>}}/g, variable7value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable8Name'] != ""){

?>

var variable8value = document.getElementById("variable8name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable8Name']; ?>}}/g, variable8value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable9Name'] != ""){

?>

var variable9value = document.getElementById("variable9name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable9Name']; ?>}}/g, variable9value);

iFrameBody.innerHTML = res;

<?php 

}

?>

<?php

if($row1['Variable10Name'] != ""){

?>

var variable10value = document.getElementById("variable10name").value;

var str = iFrameBody.innerHTML;

var res = str.replace(/{{<?php echo $row1['Variable10Name']; ?>}}/g, variable10value);

iFrameBody.innerHTML = res;

<?php 

}

?>

var checkBox = document.getElementById("embednotification");

if (checkBox.checked == true){

   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }
//    alert(iFrameBody.innerHTML);

iFrameBody.innerHTML = iFrameBody.innerHTML + "<IMG SRC=\"<?php echo $APIDomain; ?>/campaigns?target=" +  document.getElementById("recipientemail").value + "&campaignname=" + document.getElementById("campaigntitle").value + "\" height=1 width=1>";

}

iFrameBody.focus();

}
</script>

<TR><TD>Recipient Email Address: </TD><TD><input type="text" placeholder="someone@target.com" id="recipientemail"></TD></TR>
		
<?php
if($row1['Variable1Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable1Name']."\" id=\"variable1name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable2Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable2Name']."\" id=\"variable2name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable3Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable3Name']."\" id=\"variable3name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable4Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable4Name']."\" id=\"variable4name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable5Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable5Name']."\" id=\"variable5name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable6Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable6Name']."\" id=\"variable6name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable7Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable7Name']."\" id=\"variable7name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable8Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable8Name']."\" id=\"variable8name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable9Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable9Name']."\" id=\"variable9name\" value=\"\"></TD></TR>"; $x = $x + 1;}
if($row1['Variable10Name'] != ""){echo "<TR><TD>Variable ".$x.": </TD><TD><input type=\"text\" placeholder=\"".$row1['Variable10Name']."\" id=\"variable10name\" value=\"\"></TD></TR>";}

?>

<TR><TD COLSPAN="2"><b>Embed Notification for Opened Email? <input type="checkbox" checked id="embednotification"></b></TD></TR>

</TABLE>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=of5ifxe3ls8fdxa89e2ja3o4h2e0de9fp38rxhwpttatu8xq"></script>
<script>
tinymce.init({
    selector: 'textarea',
    visual : false
});
</script>

<?php

echo "<br><input name=\"ReplaceVariables\" class=\"btn\" type=\"button\" value=\"Update Variables\" onclick=\"Replacevariables()\" /><br><br><textarea rows=\"20\" cols=\"80\" name=\"content\" id=\"contentbox\">".base64_decode($row1['Markup'])."</textarea>";
    }

} else { ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=of5ifxe3ls8fdxa89e2ja3o4h2e0de9fp38rxhwpttatu8xq"></script>
<script>
tinymce.init({
    selector: 'textarea',
    visual : false
});
</script>

</FONT><textarea rows="20" cols="80" name="content" id="contentbox">Create a new email template here!</textarea>

<?php } 

?>

<?php

if(isset($campaign) && $campaign != "New"){

?>

<script>
function showhtml()
{
   var iFrame =  document.getElementById('contentbox_ifr');
   var iFrameBody;
   if ( iFrame.contentDocument )
   { // FF
     iFrameBody = iFrame.contentDocument.getElementsByTagName('body')[0];
   }
   else if ( iFrame.contentWindow )
   { // IE
     iFrameBody = iFrame.contentWindow.document.getElementsByTagName('body')[0];
   }

alert(iFrameBody.innerHTML);
}
</script>

<br><input class="btn" style="width:20%" type="button" onclick="showhtml()" value="View HTML" />

<?php
}
if(isset($campaign) && $campaign == "New"){

?>

<BR><BR>
<FONT COLOR="#FFFFFF">Tip: Try Pasting Formatted Content Here From Another Source!</FONT><BR><BR>
<button class="btn" style="width:25%" type="submit">Save Campaign</button>

</FORM>

<?php }} else { ?>

<h2><font color="#FFFFFF">Select Campaign</FONT></h2>
<FORM METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
<SELECT NAME="existingcampaign" width="300" style="width: 300px">

<option value="New" selected>Create New</option>

<?php

$selectcampaignsql = "SELECT DISTINCT CampaignName from content;";

$result = $conn->query($selectcampaignsql);

    // output data of each row
    while($row1 = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<option value=\"".$row1["CampaignName"]."\">".$row1["CampaignName"]."</option>";
    }
?>
</SELECT><br><br>
<button class="btn" style="width:10%" type="submit">Go</button>
</FORM>

<BR>
<FONT COLOR="#FFFFFF"><H2>OR</H2><br>Use Your Own and Embed a Notification Tag</FONT><BR><BR>
<textarea style="text-align:center" class="js-emaillink"><IMG SRC="<?php echo $APIDomain; ?>/campaigns?target=EMAIL@RECIPIENT.COM&campaignname=ITCAMPAIGN" height="1" width="1"></textarea>
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

<?php }} ?>



</CENTER>



</body>
</html>
