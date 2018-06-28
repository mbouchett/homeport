<?php
// processClosePo.php 10/29/2017

//includes loads from the rootr so: ../../ ../
include "../../../db.php";

//Get Vars
$po = $_REQUEST['po'];
$stat = $_REQUEST['stat'];

// Update the order as closed by ap
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `orders_status` = ".$stat."
        WHERE `orders`.`orderNum` = ".substr($po,0,7).";";
        
        //echo $sql;
        //die;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: sentOrders.php');
die;
?>