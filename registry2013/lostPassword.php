<?php
date_default_timezone_set('America/New_York');
  $message=$_REQUEST['message'];

  if(!$message) {
                    $messColor="000000";
                    $messSize="12";
                    $message='Please enter the address that you registered
                            with and then click the button your username
                            and password will be emailed to that address.
                            If you cannot remember the email address you
                            must contact the store @ 802-863-4644 or email
                            your request to homeport@homeportonline.com';
                }else {
                 $messColor="990000";
                 $messSize="16";
                }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/registry.css" type="text/css" />

<title>Recover Lost Password</title>
</head>

<body>
<br />
<form name="pass" action="emailPassword.php" method="post">
<table align="center" >
    <tr><td align="center">Email: <input name="emailAddress" /></td></tr>
    <tr><td align="center"></td></tr>
</table>
</form>
<div align="center" style="font-size: <?=$messSize?>px; font-style: italic; color: #<?=$messColor?>" >
<?=$message?>
</div>
<a class="button3" style="cursor: pointer" onClick="document.pass.submit()">Request Password</a>
<a class="button3" onclick="window.close()">[x]Close Window</a>
</body>
</html>
