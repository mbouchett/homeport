<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$recordCount=$_POST['recordcount'];
$vendor=$_POST['vendor'];
$recno=$_POST['recno'];
$sku=$_POST['sku'];
$description=$_POST['description'];
$department=$_POST['department'];
$pack=$_POST['pack'];
$cost=$_POST['cost'];
$retail=$_POST['retail'];
$loh=$_POST['loh'];

//echo $vendor."<br />";
for($i=0; $i<$recordCount; $i++){
    //clean data
    $description[$i] = strip_tags($description[$i]);
    //echo $description."<br>";
    $description[$i] = str_replace('"','”',$description[$i]);
    //echo $description."<br>";
    $description[$i] = addslashes($description[$i]);
    //echo $description."<br>";
    // echo $recno[$i]."-".$sku[$i]."-".$description[$i]."-". $department[$i]."-".$pack[$i]."-".$cost[$i]."-".$retail[$i]."<br />";
}
//exit;

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
for($i=0; $i<$recordCount; $i++){
  // Fix the department
if(strlen(trim($department[$i]))<2){
  if(is_numeric(trim($department[$i]))){
    $department[$i]="0".$department[$i];
  }
  // Fix NULL On Hand
  if(!$loh[$i]) $loh[$i] = 0;
}
// Fix prices
$cost[$i] = str_replace(',', '', $cost[$i]);
$retail[$i] = str_replace(',', '', $retail[$i]);
if(!$loh[$i]) $loh[$i] = 0; 

    $sql = "UPDATE `".$db_db."`.`items`
        SET `sku` = '".$sku[$i]."',
         `description` = '".mysqli_real_escape_string($db,$description[$i])."',
         `department` = '".$department[$i]."',
		 `pack` = '".$pack[$i]."',
         `cost` = '".$cost[$i]."',
         `retail` = '".$retail[$i]."',
         `loh` = '".$loh[$i]."'
         WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
    if(!$result){
    echo "No Good!<br>";
    echo $sql." - ".$i."<br>";
    echo mysqli_error($db);
    die;
}
}
mysqli_close($db); //close the connection

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform deletes
for($i=0; $i<$recordCount; $i++){
	if(trim($sku[$i])==""){
		$sql = "DELETE FROM `items` WHERE `recno` = '".$recno[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
        //echo "would be deleting -->".$description[$i]."<br />";
	}
}
$now = date('l jS \of F Y h:i:s A');
mysqli_close($db); //close the connection
header('Location: items.php?ven='.$vendor.'&message=Changes Saved '.$now);
die;
?>