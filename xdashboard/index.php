<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(isset($_SESSION['username'])){
    header('Location: dashboard.php');
    die;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Look At this fine web page -->
<head>
  <link rel="SHORTCUT ICON" href="dash.ico">
  <link rel="stylesheet" href="css/dashboard.css" type="text/css" />
  <title>Homeport Dashboard Login (a)</title>

<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}
</script>
</head>

<body onload="setFocus()">
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
</div>
<br />
<form name="scheduleLogin" action="processLogin.php" method="post">
    <div class="loginbox">
    <table>
        <tbody>
        <tr>
        <td><h3>User Name </h3></td>
        <td><input id="start" name="username" type="text"><br /></td>
        </tr>
        <tr>
            <td><h3>Password </h3></td>
            <td><input value="" id="pw" name="pw" type="password" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><a class="dashbut"  onClick="document.scheduleLogin.submit()" name=""><span class="icontext">&#128273;&nbsp;</span>Login</a></td>
        </tr>


        </tbody>
    </table>
  </div>
<div class="hiddenstuff">
<input type="submit" />
</div>
</form>
<?php if($message){?>
    <table align="center" border="1" style="border-color: #FFFFFF">
        <tr><td><div style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
    </table>
<?php  }?>
    <script defer="defer" type="text/javascript" src="js/login.js"></script>
</body>

</html>