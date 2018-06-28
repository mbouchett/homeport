<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['useremail'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$recordCount=$_POST['recordcount'];
$vendor=$_POST['vendor'];
$recno=$_POST['recno'];
$pack=$_POST['pack'];
$cost=$_POST['cost'];
$multi=$_POST['multi'];

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//perform the update
for($i=0; $i<$recordCount; $i++){
    if(is_numeric($pack[$i]) || $pack[$i]=="DNR" || $pack[$i]=="DISC"){
      $sql = "UPDATE `".$db_db."`.`items` SET `pack` = '".$pack[$i]."' WHERE `recno` = '".$recno[$i]."';";
      $result = mysqli_query($db, $sql); // create the query object
    }
}

for($i=0; $i<$recordCount; $i++){
    if($cost[$i]){
        if(is_numeric($cost[$i])){
          // Fix prices
          $cost[$i] = str_replace(',', '', $cost[$i]);
          $retail = $cost[$i]*$multi;
          $sql = "UPDATE `".$db_db."`.`items`
                 SET `cost` = '".$cost[$i]."',
                 `retail` = '".$retail."'
                 WHERE `recno` = '".$recno[$i]."';";
          $result = mysqli_query($db, $sql); // create the query object
      }
    }
}
mysqli_close($db); //close the connection
$now = date('l jS \of F Y h:i:s A');
header('Location: items.php?ven='.$vendor.'&message=Changes Saved '.$now);
die;
?>