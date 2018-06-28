<?php
	//dashboard.php 2018/01
	// dashboard
	date_default_timezone_set('America/New_York');

	session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: index.php');
		die;
  	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Homeport Dashboard - <?= $_SESSION['username']?> </title>
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
	Homeport Dashboard - <?= $_SESSION['username']?><br>
	<table>
		<tr>
			<td><a href="../signs">Signs</a></td>
			<td><a href="../phpSchedule/viewSchedule.php">Time Schedules</a></td>
			<td><a href="webschedule">Time Clock</a></td>	
		</tr>
		<tr>
			<td><a href="registry/">Registry</a></td>	
			<td><a href="giftcard/swipe.php">Gift Card Transaction</a></td>
			<td><a href="cs/whPickup.php" >Schedule Pickup</a></td>	
		</tr>
		<tr>
			<td><a href="cs/">Customer Service</a></td>	
			<td><a href="giftcard/gcDash.php">Gift Card Reports</a></td>
			<td><a href="purchasing/">Purchasing</a></td>	
		</tr>
		<tr>
			<td><a href="phonesale/phoneSale.php">Phone Sale Form</a></td>	
			<td>Time Schedule Admin</td>
			<td><a href="depts/depts.php">Departments</a></td>	
		</tr>
		<tr>	
			<td><a href="warehouse/searchInventory.php">Warehouse Inventory</a></td>
			<td><a href="warehouse/whDash.php">Warehouse Admin</a></td>	
			<td><a href="warehouse/rec.php">Receiving Log</a></td>
		</tr>
		<?php if($_SESSION['userlevel'] > 3) { ?>
		<tr>
			<td><a href="../cart2013/cartPeek.php">Shopping Cart Admin</a></td>	
			<td>Site Utilities</td>
			<td><a href="processLogout.php">Log Out</a></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
