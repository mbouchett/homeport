<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!

if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `usernum`, `username`, `email` FROM `dashusers` WHERE `username` = \''.trim($username).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

$row=mysqli_fetch_assoc($result); //fetch result into an associative array eg.stripslashes($row['password'])

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Add User: Logged In As <?=$username?> (a)</title>
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
<span class="dashtitle">Change Login or Email for <?=$username?></span><br />
<form name="submituserchanges" action="processChangePassword.php" method="post">
<table class="leftjusttable" border="0" style="border-color: #FF9900" align="center">

  <tr>
    <td><h3>Password*</h3></td><td><input name="password" type="password" size="20" /></td>
  </tr>
  <tr>
    <td><h3>Retype Password*</h3></td><td><input name="passwordRetype" type="password" size="20" /></td>
  </tr>
  <tr>
    <td><h3>Email Address</h3></td><td><input name="useremail" size="40" value="<?=stripslashes($row['email'])?>" /></td>
  </tr>
 </table>
<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
<br />
<table align="center">
    <tr><td align="center">
    	<input name="oldEmail" type="hidden" value="<?=stripslashes($row['email'])?>" />
        <a class="dashbut"  onClick="document.submituserchanges.submit()" name=""  /><span class="icontext">&#128190;&nbsp;</span>Submit Changes</a>
		<a class="dashbut"  onclick="parent.location='dashboard.php'"><span class="icontext">&#128281;&nbsp;</span>Main Dashboard</a>
    </td></tr>
</table>
<div class="hiddenstuff">
<input type="submit" />
</div>
</form>
</body>
</html>
