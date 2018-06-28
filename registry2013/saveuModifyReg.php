<?php
//saveuModifyReg.php 2018/05
// save alter registry
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // start up your PHP session!
 if(isset($_COOKIE['regnum'])){
 	$r=$_SESSION['r'];
	}else{
   	echo "No Authorization";
   	exit;
	}
$adjQty=$_POST['adjQty'];
$recno=$_POST['recno'];
$count = count($recno);
//Fix Under Wanted
for($i=0; $i<$adjCount; $i++){
if($recd[$i] && $adjQty[$i] < $recd[$i]) $adjQty[$i]=$recd[$i];
}
//perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$count; $i++){
    $sql = "UPDATE `".$db_db."`.`reg_items`
        SET `ri_qty` = '".$adjQty[$i]."'
        WHERE `ri_ID` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql);
}

if(!$result) {
	echo "Update Resigtry Failed<br>";
	echo mysqli_error($db);
	die;
}

mysqli_close($db); //close the connection

//Perform the deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `reg_items` WHERE `ri_qty` < '1';";
$result = mysqli_query($db, $sql);

if(!$result) {
	echo "delete from registry Failed<br>";
	echo mysqli_error($db);
	die;
}

mysqli_close($db); //close the connection

header('Location: regLog.php');
die;
?>