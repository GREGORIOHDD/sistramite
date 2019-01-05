<?php
session_regenerate_id(TRUE);
$con = mysqli_connect("localhost","gregorio","PA12jh34");
if (!$con)
  {
  die('Could not connect: '.mysqli_error($con));
  }


mysqli_select_db($con,'bdsistramdoc');

$table='table2';

//-----------------user level in members table not in use this is why I set admin here--
$admin="admin";
//-------------------------------------------------
$title="I.E. Ernesto Villanueva Muñoz";

?>