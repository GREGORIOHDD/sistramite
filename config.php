<?php
session_regenerate_id(TRUE);
$con = mysqli_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: '.mysqli_error($con));
  }


mysqli_select_db($con,'mydb9eng');

$table='table2';

//-----------------user level in members table not in use this is why I set admin here--
$admin="admin";
//-------------------------------------------------
$title="I.E. Ernesto Villanueva Muñoz";

?>