<?php
//saveuChangePassword.php 2018/05
// saves a password change
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_COOKIE['regnum'])){
    $r=$_SESSION['r'];
  }else{
        echo "No Authorization";
        exit;
  }
//r[0]=regnum
//r[1]=partner 1 First Name
//r[2]=partner 2 First Name

$newPass=$_POST['newPass'];
$verifyPass=$_POST['verifyPass'];

// Verify That All Fields Are Filled In
if(!$newPass || !$verifyPass){
	header('Location: uChangePassword.php?message=All Fields Are Required&messColor=FF0066&messSize=24');
	die;
}

// Verify That oldPass===newPass
if($newPass !== $verifyPass){
	header('Location: uChangePassword.php?message=New Password Does Not Match Verify Password&messColor=FF6600&messSize=24');
	die;
}

//hash the new password
$hash = crypt($newPass, '$2a$07$theclockswerestrikingthirteen$');

// Save The New Password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the update
$sql = "UPDATE `".$db_db."`.`registry` SET `reg_pw` = '".$hash."' WHERE `reg_ID` = '".$r[0]."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: uChangePassword.php?message=Password Changed&messColor=33CC00&messSize=24');
die;
?>