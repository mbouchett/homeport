<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
$vendor = $_REQUEST['vendor'];
$recno = $_REQUEST['recno'];
$fn = $_REQUEST['fn'];

//If nothing submitted then clear the record from the database
if(!$fn){
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "UPDATE `".$db_db."`.`items` SET `pic` = NULL WHERE `recno` = '".$recno."';";
    $result = mysqli_query($db, $sql); // create the query object
    mysqli_close($db);
    header('Location: items.php?ven='.$vendor.'&message=Picture Removed ');
    die;
}

//do the database stuff & perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`items` SET `pic` = '".$fn."' WHERE `recno` = '".$recno."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: items.php?ven='.$vendor.'&message=Picture Added&go=1');
die;
?>