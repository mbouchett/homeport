<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$recordCount=$_POST['recordcount'];
$vendor=$_POST['vendor'];
$recno=$_POST['recno'];
$image=$_POST['image'];

//echo $vendor."<br />";

//for($i=0; $i<$recordCount; $i++){
// echo $recno[$i]."-".$image[$i]."<br />";
//}
//exit;
//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the update
for($i=0; $i<$recordCount; $i++){
    $sql = "UPDATE `".$db_db."`.`items` SET `image` = '".$image[$i]."' WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection
header('Location: pictures.php?ven='.$vendor.'&message=Changes Saved '.date('l jS \of F Y h:i:s A'));
die;
?>