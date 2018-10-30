<!DOCTYPE html>
<html>
<head>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=of5ifxe3ls8fdxa89e2ja3o4h2e0de9fp38rxhwpttatu8xq"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<link rel="stylesheet" href="../main.css">
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

if(isset($_REQUEST['content'])){

$content = urlencode($_REQUEST['content']);
$campaign = $_REQUEST['campaign'];

//echo urlencode($_REQUEST['content']);

$createcampaignsql = "CALL CreateModifyCampaign('$campaign','$content','','','','','','','','','','');";

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

$selectcampaignsql = "SELECT * from content WHERE CampaignName = '$campaign';";

$result = $conn->query($selectcampaignsql);


?>

<FONT COLOR="#FFFFFF">

<h2>Select or Create Email Campaign from Template</h2>

<FORM ACTION="<?php $_SERVER["PHP_SELF"]; ?>" METHOD="POST">

<?php

if($campaign == "New"){ ?>

<b>Name of Campaign: </b><INPUT TYPE="TEXT" Value="" Name="campaign">

<br><br>

<?php

} else {

?>

<b>Name of Campaign: </b><INPUT TYPE="TEXT" Value="<?php echo $campaign; ?>" Name="campaign">

<br><br></FONT>
<?php }

if($campaign != "New"){

    // output data of each row
    while($row1 = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<textarea rows=\"20\" cols=\"80\" name=\"content\">".urldecode($row1['Markup'])."</textarea>";
    }

} else { ?>

<textarea rows="20" cols="80" name="content">Create a new email template here!</textarea>

<?php } ?>

<BR><BR>

<button class="btn" style="width:25%" type="submit">Save Campaign</button>

</FORM>

<?php } else { ?>

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

<?php }} ?>



</CENTER>
</body>
</html>