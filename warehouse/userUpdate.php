<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard/');
    die;
  }
//Establish Variables
$referPage=$_POST['referPage'];
$record=$_POST['record'];
$rootLoc=$_SESSION['rootLoc'];
$catSelected=$_POST['catSelected'];
$recordCount=count($record);
$searchKey=$_POST['searchKey'];

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the update
for($i=0; $i<$recordCount; $i++){
    $sql = "UPDATE `".$db_db."`.`whseInv`
        SET `purchased` = '".$record[$recordCount-$i-1][7]."',
         `customer` = '".$record[$recordCount-$i-1][8]."',
         `employee` = '".$record[$recordCount-$i-1][9]."',
		 `comment` = '".$record[$recordCount-$i-1][10]."'
         WHERE `recno` = '".$record[$recordCount-$i-1][0]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection
if($referPage=='category'){
header('Location: '.$rootLoc.'viewInventory.php?message=Changes Saved '.date('l jS \of F Y h:i:s A').'&catSelected='.$catSelected);
die();
}else {
header('Location: '.$rootLoc.'searchInventory.php?message=Changes Saved '.date('l jS \of F Y h:i:s A').'&referSearch='.$searchKey);
die();
}
?>