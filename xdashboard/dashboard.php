<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    die;
  }
//get user variables

$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Homeport Dashboard: <?= $username ?> (a)</title>
</head>

<body>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
</div>
<br />
<span class="dashtitle">Homeport Dashboard: <?= $username ?></span>
<br /><br />

<div class="dashbutcont">
	<button onclick="parent.location='inventory/inventory.php'" title="3"><span class="icontext">&#59148;&nbsp;</span>Purchasing</button>
   <button disabled="disabled" onclick="parent.location='deptVend.php'" ><span class="icontext">&#128197;&nbsp;</span>Department(Vendors)</button>
   <br />
<?php if($userlevel >= 3){ ?>
	<br />
	<button onclick="parent.location='searchReport.php'" ><span class="icontext">&#128203;&nbsp;</span>Search Report</button>
<?php } ?>
</div>
</body>
</html>
