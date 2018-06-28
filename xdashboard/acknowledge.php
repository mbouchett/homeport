<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

// acknowledge.php
// Mark Bouchett
// 12/04/2015
date_default_timezone_set('America/New_York');
$recno = $_REQUEST['recno'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`pickup` SET `confirmed` = 1 WHERE `recno` = '".$recno."'";
$result = mysqli_query($db, $sql); // create the query object
@$pickup = mysqli_fetch_assoc($result);
mysqli_close($db);

header('location: pickup.php?recno='.$recno);

?>