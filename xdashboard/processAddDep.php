<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
    //Establish Variables
  $department=$_POST['department'];
  $depnum=$_POST['depnum'];

//if information is missing
if(!$department || !$depnum){
	header('Location: departments.php?message=Name And Number Required&messColor=CC0033&messSize=20');
	die;
}

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `departments` WHERE `depnum` = \''.trim($depnum).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
//if the account is found

if($num_results>0){
	header('Location: departments.php?message=Category Already Exists&messColor=CC0033&messSize=24');
	die;
}

$department = ucwords($department);
//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT INTO `".$db_db."`.`departments` (`department`, `depnum`)
        VALUES ('$department','$depnum')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: departments.php?message='.$category.' Added&messColor=339933&messSize=24');
exit;
?>