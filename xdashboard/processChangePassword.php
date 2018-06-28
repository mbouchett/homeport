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
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
  $password=$_POST['password'];
  $passwordRetype=$_POST['passwordRetype'];
  $useremail=$_POST['useremail'];
  $oldEmail=$_POST['oldEmail'];

//if information is missing
if(!$password && !$passwordRetype && trim($useremail)==trim($oldEmail)){
	header('Location: changePassword.php?message=No Change Detected&messColor=0099FF&messSize=20');
	die;
}

// Check password against re-type

	if($password != $passwordRetype){
		header('Location: changePassword.php?message=Passwords Must Match&messColor=FF9933&messSize=24');
		die;
	}

//Open The dashusers Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$hash=crypt($password, '$2a$bugger$');
if(!$password){ //update only the email address
    $sql = "UPDATE `".$db_db."`.`dashusers`
        SET `email` = '".$useremail."'
         WHERE `username` = '".trim($username)."';";
	$qMess="Email Updated";
}else {         //Update Everything
    $sql = "UPDATE `".$db_db."`.`dashusers`
        SET `email` = '".$useremail."',
			`password` = '".$hash."'
         WHERE `username` = '".trim($username)."';";
	$qMess="Changes Successful";
}
//perform the update
$result = mysqli_query($db, $sql); // send the query object

mysqli_close($db); //close the connection

	header('Location: changePassword.php?message='.$qMess.'&messColor=FF9933&messSize=24');
exit;
?>