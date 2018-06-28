<?php
//processEditDepts.php 2018/06
// processes department edits
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	header('Location: ../');
	die;
}

$dept_ID = $_POST['dept_ID'];
$name = $_POST['name'];
$abb = $_POST['abb'];
$color = $_POST['color'];
$del = $_POST['del'];
$itemCount = count($dept_ID);

// Process Edits
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemCount; $i++) {
	$sql = "UPDATE `".$db_db."`.`sch_dept`
    		  SET `sch_dept_name` = '".addslashes($name[$i])."',
        		   `sch_dept_abbv`='".$abb[$i]."', 
               `sch_dept_color`='".$color[$i]."'  
     		  WHERE `sch_dept_ID`=".$dept_ID[$i];
   $result = mysqli_query($db, $sql);
	if(!$result) {
		echo "Department Update Failed<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
}
mysqli_close($db);

//Process Deletes
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i = 0; $i < $itemCount; $i++) {
	if($del[$i]) {
		$sql = "DELETE FROM `sch_dept` WHERE `sch_dept`.`sch_dept_ID`=".$dept_ID[$i];
	   $result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Department Delete Failed<br>";
			echo $sql."<br>";
			echo mysqli_error($db);
			die;
		}
	}
}
mysqli_close($db);

header('location: editDepts.php');
die;
?>