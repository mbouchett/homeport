<?php
date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(!isset($_COOKIE['regnum'])){
        echo "No Authorization";
        die;
  }
$r=$_SESSION['r'];
//r[0]=regnum
//r[1]=partner 1 First Name
//r[2]=partner 2 First Name
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
  <title><?=$r[1]?> & <?=$r[2]?> Change Your Password</title>
  <link rel="stylesheet" href="css/registry.css" type="text/css" />


</head>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a>
  <div id="menu">
      <ul>
        <li><a href="../index.php" class="menubutton">HOME</a></li>
        <li><a href="../registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="../departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>
</div>
<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Change Password</div></td></tr>
<tr><td align="center"><?=$r[1]?> & <?=$r[2]?></td></tr>
</table>
<br />
<form action="saveuChangePassword.php" method="post">
<table align="center" width="400">

    <tr><td align="left">New Password:</td><td><input name="newPass" type="password" /></td></tr>
    <tr><td align="left">Verify Password:</td><td><input name="verifyPass" type="password" /></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td align="center"><input type="submit" name="" value="Save Changes" /></td><td align="center"><input value="Return To Registry Manager" onclick="parent.location='regDash.php'" type="button">
</td></tr>
</table>
</form>
<br />
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>

</body>

</html>
