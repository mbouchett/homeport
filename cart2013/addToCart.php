<?php
//includes
include "/home/homeportonline/crc/2018.php";
//Establish Variables
date_default_timezone_set('America/New_York');
$ip=$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");
$visitID=$_COOKIE['visitID'];
$recno = $_REQUEST['recno'];
$regnum = $_REQUEST['regnum'];
$qty = $_REQUEST['qty'];
$price = $_REQUEST['price'];

if($recno && is_numeric($recno)){
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  $sql = 'SELECT * FROM `items` WHERE `item_ID` = '.$recno ;          //Create The Search Query
  //search Item Database And Store It In A Local Array
  $result = mysqli_query($db, $sql);          //Initiate The Query
  $num_results = mysqli_num_rows($result);      //Count The Query Matches
  mysqli_close($db);                          //Close The Connection
  //Store the Results To A Local Array
  $row1=mysqli_fetch_assoc($result);       //Fetch The Current Record
  $item=$row1;

  $retail = $item['item_retail'];

  //echo $ip."<br />";
  //echo $date."<br />";
  //echo $recno."<br />";
  //echo $visitID."<br />";
  //echo $item['retail']."<br />";
  //exit;

  //create insert string
  $sql = "INSERT INTO `".$db_db."`.`cart` (`cart_date`, `customer`, `ip`, `item_ID`, `cart_retail`, `cart_qty`)
	     VALUES ('$date', '$visitID', '$ip' , '$recno','$retail', '1')";
  if($regnum){
  $sql = "INSERT INTO `".$db_db."`.`cart` (`cart_date`, `customer`, `ip`, `item_ID`, `cart_retail`, `cart_qty`, `regnum`)
	     VALUES ('$date', '$visitID', '$ip' , '$recno','$price', '$qty', '$regnum')";
  }
  if($visitID){
  	//open the custcart file to insert the selected item
  	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  	$result = mysqli_query($db, $sql); // create the query object
  	if(!$result) {
		echo "Add To Cart Failed<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
	}
  	mysqli_close($db); //close the connection
  }
}
header('Location: viewCart.php');
die;
?>