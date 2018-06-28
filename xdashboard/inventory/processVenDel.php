<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2016/05
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$vendor=$_POST['vendor'];

// delete vendor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `vendors` WHERE `recno` = '".$vendor."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

// return to the dashboard
header('location: inventory.php');
?>