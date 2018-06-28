<?php //processVendorNumberChange.php
include "../../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$venNumber = $_REQUEST['venNumber'];
$newNumber = $_REQUEST['newNumber'];

if(strlen($venNumber) < 3 || strlen($newNumber) < 3){
    header('location: vendorNumberChange.php?message=New and Old numbers must be 3 characters');
    die;
}

//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "UPDATE `".$db_db."`.`vendors` SET `number` = '".$newNumber."' WHERE `vendors`.`number` LIKE '%".$venNumber."%';";
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $sql="UPDATE `".$db_db."`.`items` SET `vendor` = '".$newNumber."' WHERE `items`.`vendor` LIKE '%".$venNumber."%'";
    $result = mysqli_query($db, $sql);          //Initiate The Query                       //Close The Connection
    $x =  mysqli_affected_rows($db);
    mysqli_close($db);

    header('location: vendorNumberChange.php?message='.$venNumber.' changed to '.$newNumber.', '.$x.' items updated!');
    die;
?>