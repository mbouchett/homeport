<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$po=$_REQUEST['order'];

$date = date('F d, Y');

// Update the order as sent
//includes loads from the rootr so: ../../ ../
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `acknowledged` = \"M-".$date."\"
        WHERE `orders`.`orderNum` = ".$po.";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: viewOrder.php?order='.$po);
die();
?>