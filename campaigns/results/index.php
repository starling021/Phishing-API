<HTML>
<HEAD>
<link rel="stylesheet" href="../../main.css">
</HEAD>
<BODY>
<CENTER>
<?php 

// Read Database Connection Variables
require_once '../../config.php';

$dbname = "campaigns";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


<?php

// Show Credentails for the Selected Project 
if(isset($_REQUEST['ip'])){
$ip = $_REQUEST['ip'];

$ip = filter_var($ip, FILTER_SANITIZE_SPECIAL_CHARS);
$ip = mysqli_real_escape_string($conn, $ip);

$sql = "Call GetRecord('$ip');";
$result = $conn->query($sql);

?>
    <h2><FONT COLOR="#FFFFFF">Received Requests</FONT></h2>
<TABLE BORDER=1><TR><TH>Date/Time</TH><TH>IP</TH><TH>Target</TH><TH>Campaign</TH><TH>UserAgent</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<tr><td>".$row["DateTime"]."</td><td>".$row["IP"]."</td><td>".$row["Target"]."</td><td>".$row["Campaign"]."</td><td>".$row["UserAgent"]."</td></tr>";
    }

printf($conn->error);



$conn->close();
}
?></TABLE>
</CENTER>
</BODY>
</HTML>

