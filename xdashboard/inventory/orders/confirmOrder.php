<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
$email=$_REQUEST['email'];
$po=$_REQUEST['order'];

$finalStory = 'Order Received : <a href="http://www.homeportonline.com/dashboard/inventory/orders/repOrder.php?order='.$po.'">'.$po.'</a>';
//echo $finalStory;
//exit;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Order Receipt Confirmation'. "\r\n";

// Send the email
mail($email,'Confirmation Order# '.$po,$finalStory,$headers);

// Update the order acknowledgment
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$po=$_REQUEST['order'];

$date = date('F d, Y');

// Update the order as sent
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `acknowledged` = \"R-".$date."\"
        WHERE `orders`.`orderNum` = ".$po.";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: confirmConfirmation.php?po='.$po);
die();
?>
