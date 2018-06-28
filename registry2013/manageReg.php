<?php
date_default_timezone_set('America/New_York');
    session_start(); // Resume up your PHP session!
    session_destroy();
    setcookie("regnum", $r[0],time()-4200,"/");
    setcookie("partner1F", $r[1],time()-4200,"/");
    setcookie("partner2F", $r[2],time()-4200,"/");
  //if($x[0]) header('Location: regDash.php');
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="images/bg.ico" />
<link rel="stylesheet" href="css/registry.css" type="text/css" />
<title>Login To Your Registry</title>
  <meta http-equiv="X-UA-Compatible" content="IE-edge" />
<script type="text/javascript">
var newwindow;
function poptastic(url)
{
newwindow=window.open(url,'name','location=0,height=170,width=350');
newwindow.moveTo(450,325)
if (window.focus) {newwindow.focus()}
}
</script>

</head>
<body>

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
<br />
<div align="center" style=" font-family:Arial, Helvetica, sans-serif; font-size: 22px ">Homeport Gift Registry Login</div><br />
<form name="regdash" action="regDash.php" method="post">
<table class="regapp" align="center" border="0" width="300">
	<tr>
    	<td align="center">Username:<input name="username" type="text" /></td>
    </tr>
	<tr>
    	<td align="center">Password:<input name="password" type="password" /></td>
    </tr>
	<tr>
    	<td align="center"><a class="button3" onClick="document.regdash.submit()">Login</a></td>
    </tr>
</table>
<table align="center" width="300">
	<tr>
    	<td align="left"><div style="color:#999999"><a href="javascript:poptastic('lostPassword.php')">forgot user name or password</a></div></td>
    </tr>
</table>
<br />
<div align="center"><input type="button" value="Cancel And Return" onclick="parent.location='index.php'" /> <!-- Go Back --></div>
</form>
<br />
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><span style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></span></td></tr>
</table>
<?php unset($message);
 }?>
</body>
</html>