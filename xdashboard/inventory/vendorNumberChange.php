<?php //vendorNumberChange.php
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$message=$_REQUEST['message'];

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Vendor Number Change (a)</title>
</head>

<body>
<form action="processVendorNumberChange.php" method="post">
    Current Vendor # <input name="venNumber"><br>
    Change To: <input name="newNumber"><br>
    <input name="" type="submit" value="Submit">
</form>
<?php echo $message ?>
</body>

</html>