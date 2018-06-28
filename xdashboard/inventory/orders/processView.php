<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

//Establish Variables
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Order Info
$orderNum=$_POST['orderNum'];
$shipdate=$_POST['shipdate'];
$comments=$_POST['comments'];
$discount=$_POST['discount'];
$freight01 = $_POST['freight01'];
$freight02 = $_POST['freight02'];

//Items Info
$oq=$_POST['qty'];
$recno=$_POST['recno'];
$rec=$_POST['rec'];
$recordCount = count($oq);
$sku=$_POST['sku'];

//Save Work Progress DEFAULT
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

$sql = "UPDATE `".$db_db."`.`orders`
        SET `shipDate` = \"".$shipdate."\",
        `orderComments` = \"".$comments."\",
        `discount` = \"".$discount."\",
        `freight01` = \"".$freight01."\",
        `freight02` = \"".$freight02."\"
        WHERE `orders`.`orderNum` = ".$orderNum.";";
    $result = mysqli_query($db, $sql);
    
unset($recstat);
for($i=0; $i<$recordCount; $i++){
	 if($rec[$i]) $recstat += 1;
    $sql = "UPDATE `".$db_db."`.`order_items` SET `qty` = '".$oq[$i]."', `received` = '".$rec[$i]."' WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection


if($recstat > 0){
	// Update the order as Received
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`orders`
	        SET `orders_status` = 4
	        WHERE `orders`.`orderNum` = ".$orderNum.";";
	$result = mysqli_query($db, $sql); // create the query object
	mysqli_close($db); //close the connection
}

//process deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recordCount; $i++){
    if($oq[$i] < 1) {
        $sql = "DELETE FROM `order_items` WHERE `recno` = '".$recno[$i]."';";
        $result = mysqli_query($db, $sql); // create the query object
    }
}
mysqli_close($db); //close the connection

// update the new system
include "/home/homeportonline/crc/2018.php";
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recordCount; $i++){
	if($rec[$i]){
// get old quantity
		$sql = "SELECT `item_qty` FROM `items` WHERE `item_sku`='".$sku[$i]."';";
		$result = mysqli_query($db, $sql);
if($result) {
		$oldqty = mysqli_fetch_assoc($result);
// save new quantity
		$sql = "UPDATE `".$db_db."`.`items` SET `item_qty`=".($oq[$i] + $oldqty['item_qty'])." WHERE `item_sku`='".$sku[$i]."';";
		$result = mysqli_query($db, $sql);
		if(!$result) {
			echo "Update Item On Hand Failed<br>";
			echo mysqli_error($db);
			die;
		}
}
	}
}
mysqli_close($db);
header('Location: viewOrder.php?order='.$orderNum);
die;
?>