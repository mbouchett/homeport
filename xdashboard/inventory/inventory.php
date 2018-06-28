<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization... Trace Initiated';
	exit;
}

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
<title>Purchasing Dashboard</title>

<link rel="stylesheet" href="../css/dashboard.css" type="text/css" />
</head>

<body>
<div id="banner">
  <a href="../../index.php"><img alt="Homeport Logo" src="../../images/hplogosm.png" /></a>
</div>
<br />
<span class="dashtitle">Purchasing Dashboard</span>
<br /><br />
<h2>Logged In As: <?= $useremail ?></h2>
<br />


		<a class="dashbut" onclick="parent.location='vendorSelect.php?direction=Work'"><span class="icontext">&#128710;&nbsp;</span>Items / Vendors</a>
        <a class="dashbut" onclick="parent.location='vendorSelect.php?direction=Edit'"><span class="icontext">&#9998;&nbsp;</span>Edit Vendor Info</a>

	<br />

		<a class="dashbut" onclick="parent.location='orders/sentOrders.php'"><span class="icontext">&#59146;&nbsp;</span>View Orders (New)</a>
        <a class="dashbut" onclick="parent.location='addVendor.php'"><span class="icontext">&#59136;&nbsp;</span>Add Vendor</a>

	<br />
        <a class="dashbut" onclick="parent.location='../dashboard.php'"><span class="icontext">&#128281;&nbsp;</span>Back To Dashboard</a>
        <a class="dashbut" onclick="parent.location='../reps/reps.php'"><span class="icontext">&#1932;&nbsp;</span>Trusted Reps</a>
	<br />
</body>
</html>