<?php
	//index.php 2018/01
	// dashboard
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}
function getWeek(){
	$seconds = time();
	//echo "Seconds since 01/01/1970 ->".$seconds."<br>";
	$minutes = floor($seconds/60);
	//echo "Minutes since 01/01/1970 ->".$minutes."<br>";
	$hours = floor($minutes/60);
	//echo "Hours since 01/01/1970 ->".$hours."<br>";
	$days = floor($hours/24)-3;
	//echo "Days since 01/01/1970 ->".$days."<br>";
	$weeks = floor($days/7);
	//echo "Hours since 01/01/1970 ->".$weeks."<br>";
	$currentWeek = (($weeks-1) % 8) + 1;
	//echo "Current week ->".$currentWeek."<br>";
	return $currentWeek;
}  	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Homeport Purchasing - <?= $_SESSION['username']?> </title>
<style type="text/css">
	td {
		border-style: solid;
		border-width: 1px;
		padding: 5px;
		width: 150px;	
	}
</style>
</head>
<body>
	Homeport Purchasing - <?= $_SESSION['username']?><br>
	<table>
		<tr>
			<td><a href="vendorSelect.php?direction=Work">Items</a></td>	
			<td><a href="vendorSelect.php?direction=Edit">Edit Vendor</a></td>	
		</tr>
		<tr>
			<td><a href="orders/sentOrders.php">View Orders</a></td>	
			<td><a href="vendors/addVendor.php">Add Vendor</a></td>	
		</tr>
		<tr>
			<td><a href="trustedReps.php">Trusted Reps</a></td>	
			<td><a href="../">Exit</a></td>	
		</tr>
	</table>
	<div><a href="countList.php?group=<?= getWeek() ?>" >Now Counting Group: <?= getWeek() ?></a></div>
	<a href="../../xdashboard/inventory/orders/sentOrders.php">Old Orders</a>
</body>
</html>
