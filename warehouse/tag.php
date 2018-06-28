<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard/');
    die;
  }

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
    $sql = "UPDATE `".$db_db."`.`whseInv` SET `comment` = 'Verify'";
    $result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: '.$rootLoc.'adminDashboard.php');
die();
?>