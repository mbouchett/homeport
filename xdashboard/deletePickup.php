<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
$recno = $_REQUEST['recno'];
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the delete
$sql = "DELETE FROM `".$db_db."`.`pickup` WHERE `recno` = '".$recno."';";
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
header('Location: smsLite.php');
die;

?>