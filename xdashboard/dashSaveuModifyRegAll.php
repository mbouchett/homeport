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

$adjQty=$_POST['adjQty'];
$deleteMe=$_POST['deleteMe'];
$sku=$_POST['sku'];
$regNum=$_POST['regNum'];
$recd=$_POST['recd'];
$hold=$_POST['hold'];
$recno=$_POST['recno'];
$adjCount=count($adjQty);
$desc=$_POST['desc'];
$item = $_POST['item'];

//perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$adjCount; $i++){
    $sql = "UPDATE `".$db_db."`.`g_items`
        SET `qty` = '".$adjQty[$i]."',
            `onhold` = '".$hold[$i]."',
            `description` = '".$desc[$i]."',
            `item` = '".$item[$i]."',
            `sold` = '".$recd[$i]."'
         WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection

//Perform the deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$adjCount; $i++){
	if($adjQty[$i]=0 || !$adjQty[$i] || $deleteMe[$i]){
    	$sql = "DELETE FROM `".$db_db."`.`g_items` WHERE `recno` = '".$recno[$i]."';";
    	$result = mysqli_query($db, $sql); // create the query object
	}
}
mysqli_close($db); //close the connection
if($regNum){
header('Location: dashEditRegItemsaAll.php?message=Changes Saved&messColor=33CC00&messSize=24');
}else {

}
die;
?>


