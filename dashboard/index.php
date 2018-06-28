<?php
//index.php 2018/01
// dashboard login
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(isset($_SESSION['username'])){
    header('Location: dashboard.php');
    die;
  }
  
$message = $_REQUEST['message'];
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="images/dash.ico">
  	<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
  	<title>Homeport Dashboard Login</title>

<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}

</script>
</head>

<body onload="setFocus()">
<!-- System update under way... give me a couple of minutes okay.. <br>
If you need something for a customer just give Mark A call<br>
Oh, and P.S. Harrison called out today so try and schedule pickups for tomorrow. <br>
but you can call Mark If there's an emergency... -->
<?php //exit; ?>
<form name="scheduleLogin" action="processLogin.php" method="post">
    <table>
        <tbody>
	        <tr>
	        <td><h3>User Name </h3></td>
	        <td><input id="start" name="username" type="text"><br /></td>
	        </tr>
	        <tr>
	            <td><h3>Password </h3></td>
	            <td><input id="pw" name="pw" type="password" /></td>
	        </tr>
	        <tr>
	          <td colspan="2" ><a class="dashbut"  onClick="document.scheduleLogin.submit()" name=""><span class="icontext">&#128273;&nbsp;</span>Login</a></td>
	        </tr>
        </tbody>
    </table>
<div class="hiddenstuff"> <input type="submit" /> </div>
</form>
<?php if($message){?>
    <table >
        <tr><td><?=$message?></td></tr>
    </table>
<?php  }?>
</body>

</html>
