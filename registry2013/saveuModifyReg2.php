<?php
//saveuModifyReg.php 2018/05
// couple adds to registry
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_COOKIE['regnum'])){
    $r=$_SESSION['r'];
  }else{
        echo "No Authorization";
        exit;
  }
$today=date('l jS \of F Y h:i:s A');

$adjQty=$_POST['adjQty'];
$recno=$_POST['recno'];
$deleteMe=$_POST['deleteMe'];

$count = count($recno);
//Fix Under Wanted
for($i=0; $i<$adjCount; $i++){
if($recd[$i] && $adjQty[$i] < $recd[$i]) $adjQty[$i]=$recd[$i];
}
//perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$count; $i++){
    if($deleteMe[$i]) $adjQty[$i] = -1;
    $sql = "UPDATE `".$db_db."`.`reg_items`
        SET `ri_qty` = '".$adjQty[$i]."'
        WHERE `ri_ID` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection

//Perform the deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `reg_items` WHERE `ri_qty` < '1';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: uModifyReg.php?message=Changes Saved: '.$today.'&messColor=339933&messSize=24');
die;
?>