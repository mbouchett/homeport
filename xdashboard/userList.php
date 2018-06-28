<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
date_default_timezone_set('America/New_York');
//create short variable name
//load users
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `dashusers` ORDER BY `username`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<link rel="SHORTCUT ICON" href="http://www.homeportonline.com/registry/images/bg.ico">
<title>HomePort Dashboard Users</title>
<link href="css/users.css" rel="stylesheet" type="text/css" />
</head>
<body>

Homeport Dashboard Users

<form action="processUsername.php" method="post" >
<table>
  <?php for($i=0; $i<$num_results; $i++){
      $row=mysqli_fetch_assoc($result); ?>
  <tr>
    <td><input class="names" name="username" value="<?=stripslashes($row['username'])?>"></td>
    <td><input class="email" name="email" value="<?=stripslashes($row['email'])?>"></td>
    <td><input class="numInput" name="level" value="<?=stripslashes($row['level'])?>"></td>
    <td><input class="numInput" name="del" value="<?=stripslashes($row['level'])?>"></td>
  </tr>
<?php } ?>
</table>
<input type="submit" name="Save Changes" value="Save Changes">
<input value="Return To Dashboard" onClick="parent.location='dashboard.php'" type="button">
</form>
</body>
</html>
