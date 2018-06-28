<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}
    //Establish Variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

    $delete=$_POST['delete'];
    $record=$_POST['record'];
    $recCount=count($record);

// Delete The Cart entry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recCount; $i++){
    if($delete[$i]){
    $sql = "DELETE FROM `".$db_db."`.`custcart`
    	 WHERE `recno` = '".trim($record[$i])."';";
    $result = mysqli_query($db, $sql); // create the query object
    }
}
mysqli_close($db); //close the connection
header('Location:cartPeek.php');
?>