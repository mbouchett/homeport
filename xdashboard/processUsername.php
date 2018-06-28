<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
date_default_timezone_set('America/New_York');
//Establish Variables
$department=$_POST['department'];
$del=$_POST['del'];
$recno=$_POST['recno'];
$depnum=$_POST['depnum'];
$recordCount = count($recno);

//for($i=0; $i<$recordCount; $i++){
// echo $i."-".$catname[$i]."-".$del[$i]."<br />";
//}
//exit;
//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the update
for($i=0; $i<$recordCount; $i++){
  // Fix the department
    $sql = "UPDATE `".$db_db."`.`departments`
            SET `departmen` = '".$department[$i]."',
                `depnum` = '".$depnum[$i]."'
             WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}


//perform deletes
for($i=0; $i<$recordCount; $i++){
	if($del[$i]){
		$sql = "DELETE FROM `".$db_db."`.`departments`
			 WHERE `recno` = '".$recno[$i]."';";
		$result = mysqli_query($db, $sql); // create the query object
	}
}
mysqli_close($db); //close the connection
header('Location: departments.php?message=Changes Saved '.date('l jS \of F Y h:i:s A'));
die;
?>