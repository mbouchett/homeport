<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
$recno = $_REQUEST['recno'];
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
$sql = "UPDATE `".$db_db."`.`pickup` SET `confirmed` = 1 WHERE `recno` = ".trim($recno).";";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: sms.php');
die;

?>