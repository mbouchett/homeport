<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}
$username=$_SESSION['username'];
session_destroy();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link rel="stylesheet" href="css/dashboard.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="dash.ico">
  <title>Dashboard Logged Out (a)</title>
</head>

<body>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <div id="menu">
      <ul>
        <li><a href="../index.php" class="menubutton">HOME</a></li>
        <li><a href="../registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="../departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>
</div>
<br />
<br />
<span class="dashtitlered"><?=$username?> is logged out</span>
<br /><br />
<div style="text-align: center">
<a class="dashbut" onclick="parent.location='index.php'"><span class="icontext">&#128273;&nbsp;</span>Log Back In</a>
<a class="dashbut" onclick="parent.location='../index.php'"><span class="icontext">&#8962;&nbsp;</span>Return To Homepage</a>
</div>
</body>
</html>
