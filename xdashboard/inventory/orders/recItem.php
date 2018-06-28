<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

//Establish Variables
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Order Info
//Items Info
$order=$_REQUEST['order'];
$recno=$_REQUEST['recno'];
$today = date('m/d/Y');

// Update the order as checkin printed
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `orders_status` = 4
        WHERE `orders`.`orderNum` = ".$order.";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

//Save Work Progress DEFAULT
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "UPDATE `".$db_db."`.`order_items` SET `received` = '".$today."' WHERE `recno` = '".$recno."';";
    $result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: viewOrder.php?order='.$order);
die;
?>