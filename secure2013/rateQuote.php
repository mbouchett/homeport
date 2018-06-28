<?php
//includes loads from the rootr so: ../../ ../
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
	$zip=$_POST['zip'];
    $visitID=$_POST['visitID'];
    $totalOrder = $_POST['totalOrder'];
	$zc=substr($zip,0,3);
//look up the zone
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `zipzone` WHERE `zip` = \''.trim($zc).'\' ' ;
	$result = mysqli_query($db, $sql); // create the query object
	$row=mysqli_fetch_assoc($result);
mysqli_close($db); //close the connection
	$zone=$row['zone'];

	switch ($zone) {
        case 1:
			$rate=0.10;
			break;
		case 2:
			$rate=0.15;
			break;
		case 3:
			$rate=0.20;
			break;
		case 4:
			$rate=0.25;
			break;
		case 5:
			$rate=0.30;
			break;	
		case 6:
  			$rate=0.35;
			break;
		case 7:
			$rate=0.40;
			break;
		case 8:
			$rate=0.45;
			break;
		case 9:
			$rate=0.50;
			break;
		default:
			$rate= -1;
			break;
	}
if($rate == -1) $shipping = -1;
if($rate > 0) $shipping = number_format($totalOrder * $rate,2)*100;
if($shipping < 1199 && $rate > 0) $shipping = 1199;

  header('Location: ../secure2013/checkOut.php?shipping='.$shipping.'&visitID='.$visitID.'&zipCode='.$zip);
  die();
?>