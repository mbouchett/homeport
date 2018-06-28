<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";
include "../functions/f_resolve.php";
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$referPage=$_POST['referPage'];
$record=$_POST['record'];
$rootLoc=$_SESSION['rootLoc'];
$catSelected=$_POST['catSelected'];
$recordCount=count($record);
$searchKey=$_POST['searchKey'];
//for($i=0; $i<$recordCount; $i++){
//echo  $record[$i][11]."<br>" ;
//}
//exit;
//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//clean data
for($i=0; $i < $recordCount; $i++){
    for($ii = 1; $ii < 11; $ii++){
        $record[$i][$ii] = strip_tags($record[$i][$ii]);
        $record[$i][$ii] = addslashes($record[$i][$ii]);
    }
}
//perform the updates
for($i=0; $i<$recordCount; $i++){
    $sql = "UPDATE `".$db_db."`.`whseInv`
        SET `vendor` = '".$record[$i][1]."',
		 `sku` = '".$record[$i][2]."',
		 `price` = '".$record[$i][3]."',
		 `description` = '".$record[$i][4]."',
		 `location` = '".$record[$i][5]."',
		 `picture` = '".$record[$i][6]."',
		 `purchased` = '".$record[$i][7]."',
         `customer` = '".$record[$i][8]."',
         `employee` = '".$record[$i][9]."',
		 `comment` = '".$record[$i][10]."',
		 `category` = '".$record[$i][11]."'
         WHERE `recno` = '".trim($record[$i][0])."';";
    $result = mysqli_query($db, $sql); // create the query object
}

//perform deletes
for($i=0; $i<$recordCount; $i++){
	if($record[$i][12]){
		$sql = "DELETE FROM `whseInv` WHERE `recno` = '".$record[$i][0]."';";
		$result = mysqli_query($db, $sql); // create the query object
	}
}

mysqli_close($db); //close the connection

if($referPage=='category'){
header('Location: '.$rootLoc.'editInventory.php?message=Changes Saved '.date('l jS \of F Y h:i:s A').'&catSelected='.$catSelected);
die();
}else {
header('Location: '.$rootLoc.'searchEdit.php?message=Changes Saved '.date('l jS \of F Y h:i:s A').'&referSearch='.$searchKey);
die();
}
?>