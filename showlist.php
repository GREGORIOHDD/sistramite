<html>
<head>
<title>DMS</title>
<style>
tr:hover {background:#bfbfbf;}

a {color:blue;  text-decoration: none;}
table {
text-align:center;
padding:2;
border:10px solid grey;
border-radius:8px;
background-image: url('img/ptn.jpg');
width:95%;}
td {padding:2;}
input {font-size:15;font-weight:bold}
body{font-size:14;font-weight:bold;
background-image: url('img/sil.jpg');
}
thead {background:grey;}
</style>

</head><body>
<?php
session_start();
require_once"config.php";

if (!isset($_SESSION['user'])) {header("location:index.php");} else {
echo "<h1>$title <a href='index.php'><img src='img/favicon.ico'></a></h1>";
$sql='SELECT * FROM '.$table;

if (isset($_POST['condition'])) { $sql=$sql.' WHERE '.$_POST['condition'].' ';

if (!empty($_POST['criteriaa'])) { $sql=$sql.$_POST['criteriaa'].' ';} 
else { echo "Please set a criteria"; exit();}

if (!empty($_POST['value4comparison'])) { 
$_POST['value4comparison']=trim($_POST['value4comparison']);
if ($_POST['criteriaa']==">" or $_POST['criteriaa']=="<") {
$sql=$sql.$_POST['value4comparison']; }
else {$sql=$sql."'%".$_POST['value4comparison']."%'";}


}

else { echo "Please set a value for search"; exit();} }



$result=mysqli_query($con,"$sql");
if (!$result) {echo "No results found  ".mysqli_error($con); exit();} 
// ------------------import labels --------------------
$lbl='SELECT * FROM table1';

$labelz=mysqli_query($con,"$lbl");

$rowlbl = mysqli_fetch_array($labelz);

// ----------------------------------------------
echo "<center><table >";
echo "<thead><tr><td>".$rowlbl['field1']."</td><td>file type</td><td>".$rowlbl['field2']."</td><td>".$rowlbl['field3']."</td><td>".$rowlbl['field5']."</td><td>".$rowlbl['field6']."</td><td>".$rowlbl['field7']."</td><td>".$rowlbl['field8']."</td><td>delete</td><td>edit</td></tr></thead>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";


if (!empty($row[9])) { echo "<td><b>$row[1]</b></td>";} 
$fileasm='upload/'.$row[1].'/'.$row[8].'/'.$row[9];
 $ext = substr($fileasm, strrpos($fileasm, '.') + 1);
 echo "<td><a href='upload/$row[1]/$row[8]/$row[9]' target=new>
<img src='img/".$ext .".png'></a></td>";
if (!empty($row[2])) { echo "</td><td>$row[2]</td>";} else { echo "<td>..</td>";}

if (!empty($row[3])) { echo "<td>$row[3]</td>";} else { echo "<td></td>";}
// if (!empty($row[4])) { echo "<td>$row[4]</td>";} else { echo "<td></td>";}
if (!empty($row[5])) { echo "<td>$row[5]</td>";} else { echo "<td></td>";}
if (!empty($row[6])) { echo "<td>$row[6]</td>";} else { echo "<td></td>";}
if (!empty($row[7])) { echo "<td>$row[7]</td>";} else { echo "<td></td>";}
if (!empty($row[8])) { echo "<td> $row[8]</td>";} else { echo "<td></td>";}


if ($_SESSION['user']=="admin"){echo "<td><a href='dell.php?id=$row[id]&which=".$fileasm."'><img src='img/delete.png'></a></td>";

echo "<td><a href='edit.php?id=$row[id]'><img src='img/edit.png'></a></td></tr>";}

}

echo "</table>";
mysqli_close($con);

}
echo "<br><a href='index.php'>Go Back</a>";
?> 
