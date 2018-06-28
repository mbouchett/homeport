<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
    //Establish Variables
  $date = date('F jS Y');
  $username=$_POST['username'];
  $password=$_POST['password'];
  $passwordRetype=$_POST['passwordRetype'];
  $useremail=$_POST['useremail'];
  $userlevel=$_POST['userlevel'];

//if information is missing
if(!$username  || !$password || !$passwordRetype || !$userlevel){
	header('Location: adduser.php?message=Username Password and Level Are Mandatory&messColor=CC0033&messSize=20');
	die;
}

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `usernum`, `username`, `password`, `email`, `level` FROM `dashusers` WHERE `username` = \''.trim($username).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results>0){
	header('Location: adduser.php?message=User Profile Already Exists&messColor=CC0033&messSize=24');
	die;
}
// Check length of password
if(strlen($password)<6){
	header('Location: adduser.php?message=Password must be at least 6 Characters&messColor=CC0033&messSize=20');
	die;
}
// Check password against re-type
if($password!=$passwordRetype){
	header('Location: adduser.php?message=Passwords Must Match&messColor=FF9933&messSize=24');
	die;
}
$hash=crypt($password, '$2a$bugger$');
//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//create insert string
$sql = "INSERT INTO `".$db_db."`.`dashusers` (`username`, `password`, `email`, `level`)
        VALUES ('$username', '$hash', '$useremail', '$userlevel')";

//perform action
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: adduser.php?message='.$username.': User Information Saved&messColor=339933&messSize=24');
exit;
?>