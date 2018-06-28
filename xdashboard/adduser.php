<?php
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="dash.ico">
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<title>Add User: Logged In As <?=$username?> (a)</title>
</head>

<body>

<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>

</div>
<br />




<span class="dashtitle"><b>Add User Dashbord</b></span>
<br />
<br />
<form name="submitadduser" action="processAdduser.php" method="post">
<table class="leftjusttable" border="0" style="border-color: #FF9900" align="center">
  <tr>
    <td><h3>New User*</h3></td><td><input name="username" size="40" /></td>
  </tr>
  <tr>
    <td><h3>Password*</h3></td><td><input name="password" type="password" size="20" /> <i><small>(min 6chrs)</small></i></td>
  </tr>
  <tr>
    <td><h3>Retype Password*</h3></td><td><input name="passwordRetype" type="password" size="20" /></td>
  </tr>
  <tr>
    <td><h3>Email Address</h3></td><td><input name="useremail" size="40" /></td>
  </tr>

  <tr>
    <td colspan="2" align="center"><h3>Authorization Level (Pick 1 - 5 only 5 can add users)*:</h3><br /><input name="userlevel" />
    </td>
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
        <a class="dashbut"  onClick="document.submitadduser.submit()" name=""  /><span class="icontext">&#59136;&nbsp;</span>Add User</a>
		<a class="dashbut"  onclick="parent.location='dashboard.php'"><span class="icontext">&#128281;&nbsp;</span>Main Dashboard</a>
        <a class="dashbut"  onclick="parent.location='loggedOut.php'" title="1"><span class="icontext">&#59201;&nbsp;</span>Log Out</a>

<div class="hiddenstuff">
<input type="submit" />
</div>
</form>
</body>
</html>
