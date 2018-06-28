<?php
/*function sanatize($text) {
    //get rid of html
    strip_tags($text);
    addslashes($text);
    addcslashes($text, '"')
    return $text;
}*/
include "../../db.php";
$fn = $_REQUEST['fn'];
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username']) && !$fn){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$vendor=$_POST['vendor'];
$sku=strtoupper($_POST['isku']);
$description=ucwords(strtolower($_POST['description']));
$department=$_POST['department'];
$pack=$_POST['pack'];
$cost=number_format(doubleval($_POST['cost']),2);
$retail=number_format(doubleval($_POST['retail']),2,'.','');

//echo $description."<br>";

//clean data
$description = strip_tags($description);
//echo $description."<br>";
$description = str_replace('"','”',$description);
//echo $description."<br>";
$description = addslashes($description);
//echo $description."<br>";

//exit;
//if information is missing
if(!$sku  || !$description || !$department || !$pack || !$cost || !$retail){
	header('Location: items.php?ven='.$vendor.'&message=ITEM NOT SAVED! All Fields Are Required&messColor=CC0033&messSize=20');
	die;
}

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `sku` FROM `items` WHERE `sku` LIKE"%'.$sku.'%"' ;          //Create The Search Query
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

// Fix the department
if(strlen($department) < 2){
  if(is_numeric($department)){
    $department="0".$department;
  }
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT `".$db_db."`.`items` (`vendor`, `sku`, `description`, `department`, `pack`, `cost`, `retail`, `items_history`)
        VALUES ('$vendor', '$sku', '$description', '$department', '$pack', '$cost', '$retail', '0,0,0,0,0,0,0,0,0,0,0,0')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: items.php?ven='.$vendor.'&message=Item Added '.date('l jS \of F Y h:i:s A'));
die;
?>