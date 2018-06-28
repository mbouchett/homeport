<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

//Establish Variables
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Order Info
$orderNum=$_POST['orderNum'];
//Items Info
$qty=$_POST['qty'];
$recno=$_POST['recno'];

// Add the sku to the order
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    // Add the record to order_items
    $sql = "INSERT INTO `".$db_db."`.`order_items` (`item`, `qty`, `order`)
            VALUES ( '$recno', '$qty', '$orderNum');";
    $result = mysqli_query($db, $sql);      // create the query object
    mysqli_close($db);                      //close the connection
    
header('Location: viewOrder.php?order='.$orderNum);
die;
?>