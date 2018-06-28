<?php
//processRegLog.php 2018/05
// Log Into a Gift Registry
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!

// Get user and password sent from login form
$x_user=$_POST['username'];
$x_password=$_POST['password'];
$recno=$_POST['recno'];

// Verify That both Fields Are Filled In
if(!$x_user || !$x_password){
	header('Location: regLog.php?message=Both fields are required&unlog=yes&recno='.$recno);
	die;
}

//check database for user's account
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_username` = \''.trim($x_user).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results==0){
   	header('Location: regLog.php?message=Incorrect Login&unlog=yes&recno='.$recno);
    die;
}

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

$hash = crypt($x_password, '$2a$07$theclockswerestrikingthirteen$');

//if username and password don't match
if(trim($hash) != trim(stripslashes($row['reg_pw']))){
   	header('Location: regLog.php?message=Incorrect Login&unlog=yes&recno='.$recno);
    die;
}

$r[0]=stripslashes($row['reg_regnum']);
$r[1]=stripslashes($row['reg_partner1F']);
$r[2]=stripslashes($row['reg_partner2F']);

//save login info to
$_SESSION['regnum']=$r[0];
$_SESSION['r']=$r;

setcookie("regnum", $r[0],time()+60*60*24*30,"/");
setcookie("partner1F", $r[1],time()+60*60*24*30,"/");
setcookie("partner2F", $r[2],time()+60*60*24*30,"/");
header('Location: regLog.php?recno='.$recno);
die;
?>