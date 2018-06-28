<?php
// processAddRep.php
// Adds a trusted rep to the system
// Mark Bouchett
// 01/08/2016
//includes loads from the rootr so: ../../ ../
include "../../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
  header('Location: ../dashboard.php');
  die;
}

$email = $_POST['email'];
$passw1 = $_POST['passw1'];
$passw2 = $_POST['passw2'];

// Verify All Fields present
if(!$email || !$passw1 || !$passw2){
    header('location: reps.php?message=Please Fill All Fields&messColor=CC0033&messSize=20');
    die;
}

// Password verification
if($passw1 != $passw2){
    header('location: reps.php?message=Passwords Do NOT Match&messColor=CC0033&messSize=20');
    die;
}

$hash=crypt($passw1, '$2a$bugger$');

//Open The Database Look for existing email
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `reps` WHERE `email` = '".$email."'" ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results>0){
   	header('Location: reps.php?message=Email Exists&messColor=CC0033&messSize=20');
    die;
}

// Verify for valid email
$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; //Valid Email
if(!eregi($pattern, $email)){
    header('location: reps.php?message=Not A Valid Email&messColor=CC0033&messSize=20');
    die;
}

//Open The Database to add email
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT INTO `".$db_db."`.`reps` (`email`, `password`)
        VALUES ('$email', '$hash')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
$recno = mysqli_insert_id($db);                         // create the query object
mysqli_close($db); //close the connection

header('location: reps.php?message=Email Added&messColor=268F0F&messSize=20');
die;
?>