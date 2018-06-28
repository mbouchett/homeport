<?php
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
  date_default_timezone_set('America/New_York');
$bgColor="#555555";  //Background Color For the table cells
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Homeport Registry Editor</title>
</head>

<body>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <!-- <div id="menu">
      <ul>
        <li><a href="http://www.homeportonline.com/" class="menubutton">HOME</a></li>
        <li><a href="http://www.homeportonline.com/webcam.php" class="menubutton">WEBCAM</a></li>
        <li><a href="http://www.homeportonline.com/registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="http://www.homeportonline.com/departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>  -->
</div>

<br />
<span class="dashtitle">Homeport Registry Editor</span>
<br /><br />

		<a class="dashbut"  onclick="parent.location='dashProfileEdit.php'" title="1"><span class="icontext">&#9998;&nbsp;</span>Edit Registry Profile</a>
        <a class="dashbut"  onclick="parent.location='dashEditItem.php'"><span class="icontext">&oplus;&nbsp;</span>Add/Edit Items</a>
		<a class="dashbut"  onclick="parent.location='dashboard.php'"><span class="icontext">&#128281;&nbsp;</span>Main Dashboard</a>

</body>
</html>
