<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

//Establish Variables
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Order Info
$orderNum=$_REQUEST['orderNum'];

//delete items
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "DELETE FROM `".$db_db."`.`order_items` WHERE `order` =".$orderNum;
    $result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

//delete order
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "DELETE FROM `".$db_db."`.`orders` WHERE `orderNum`=".$orderNum;
    $result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: sentOrders.php');
die;
?>