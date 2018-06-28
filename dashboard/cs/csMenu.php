<?php
//csMenu.php 2018/01
// Display the customer service menu
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Homeport Dashboard</title>
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
<br />
Customer Service Dashboard
<br />

<table>
	<tr><td><a href="csSearch.php" >Search</a></td><td><a href="printTag.php" >Print Queued Tags</a></td></tr>
	<tr><td><a href="addCustomer.php" >Add Customer</a></td><td><a href="uncalled.php" >List Un-Called Up</a></td></tr>
	<tr><td><a href="unpicked.php" >List Un-Picked-Up</a></td><td><a href="../">Exit</a></td></tr>
</table>

</body>
</html>
