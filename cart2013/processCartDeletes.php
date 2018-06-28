<?php
// Mark Bouchett 06/08/2018
// processCartDeletes.php
// as the name implies
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}

$delete=$_POST['delete'];
$record=$_POST['record'];
$recCount=count($record);

// Delete The Cart entry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recCount; $i++){
   if($delete[$i]){
   	$sql = "DELETE FROM `cart` WHERE `cart_ID`=".$record[$i];
   	$result = mysqli_query($db, $sql);
	}
}
mysqli_close($db);
header('Location:cartPeek.php');
?>