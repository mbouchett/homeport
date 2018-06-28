<?php
//processAddDept.php 2018/06
// Saves a new department to the schedule system
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../');
	die;
}

$name = $_REQUEST['name'];
$abb = $_REQUEST['abb'];
$color = $_REQUEST['color'];

if(!$name || !$abb || !$color){
  header('location: editDepts.php?message=*** All Fields Required - Department Not Saved***');
}

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT `".$db_db."`.`sch_dept` (`sch_dept_name`, `sch_dept_abbv`, `sch_dept_color`)
        VALUES ('$name', '$abb', '$color')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
if(!$result){
	echo "Add Department - No Good<br>";
   echo $sql;
   echo mysqli_error($db);
   die;
}
header('location: editDepts.php?message=***Department Added***');
?>