<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$sender = strtoupper(substr($username,0,1)).'. '.ucwords(substr($username,1));

$email=$_REQUEST['email'];
$po=$_REQUEST['po'];

$date = date('F d, Y');

$finalStory = 'Follow the link below to view a purchase order From <h3>&nbsp;&nbsp;&nbsp;&nbsp;Homeport</h3>52 Church Street, Burlington, VT 05401<br />802-863-4832'.
'<br /><br />Navigate Your Browser to: http://www.homeportonline.com/dashboard/inventory/orders/repOrder.php?order='.$po.
'<br/><a href="http://www.homeportonline.com/dashboard/inventory/orders/repOrder.php?order='.$po.'"> Or Click Here To View Purchase Order #'.$po.'</a><br />'.
'<br /><a href="http://www.homeportonline.com/dashboard/inventory/orders/confirmOrder.php?order='.$po.'&email='.$useremail.'">Please Click Here To Confirm Receipt of This Order</a>'.
' or<br />Navigate you browser to: http://www.homeportonline.com/dashboard/inventory/orders/confirmOrder.php?order='.$po.' <br />-Thank You';
//echo $finalStory;
//exit;

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  ' . $username . ' <' . $useremail .'>' . " \r\n";
$headers .= 'Reply-To: '.$useremail. "\r\n";

// Send the email
mail($email,'Homeport Purchase Order# '.$po,$finalStory,$headers);

// Update the order as sent
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`orders`
        SET `emailed` = \"E-".$date."\", 
        		`orders_status` = 2 
        WHERE `orders`.`orderNum` = ".$po.";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: viewOrder.php?order='.$po.'&success=yes');
die();
?>