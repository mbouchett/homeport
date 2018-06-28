<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];

//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `number` LIKE"%'.$vendor.'%"' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
$vendors=mysqli_fetch_assoc($result);       //Fetch The Current Record

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
  <title>Add Vendor (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<div align="center"><img src="../../images/banner2010.jpg" style="border: 0px solid" alt="Homeport Online"></div>
<br />
<form action="processAddVendor.php" method="POST" >
<hr size="12" noshade="noshade"/>
<table class="count">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Main Dashboard" onclick="parent.location='../dashboard.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Log Out" onclick="parent.location='../loggedOut.php'" type="button" /></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table class="menu">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>

<table class="count">
    <tr class="vendor">
        <td>Vendor Name: <input name="v[1]" size="35" /></td>
        <td align="right"></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr class="vendor">
        <td>Address Line 1:<input name="v[2]" size="35" /></td>
        <td align="right">Representative: <input name="v[6]" size="35" /></td>
    </tr>
    <tr class="vendor">
        <td>Address Line 2:<input name="v[3]" size="35" /></td>
        <td align="right">Fax Number:<input name="v[7]" size="35" /></td>
    </tr>
    <tr class="vendor">
        <td>Address Line 3:<input name="v[4]" size="35" /></td>
        <td align="right">Voice Number:<input name="v[8]" size="35" /> </td>
    </tr>
    <tr class="vendor">
        <td >Email Address :<input name="v[5]" size="35" /></td>
        <td align="right">Price Multiplier:<input name="v[11]" size="35" value="2.4" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Ship Method 1: <input name="v[9]" size="92" value="Please Call With Quote" /></td>
    </tr>
    <tr>
        <td colspan="2">Ship Method 2: <input name="v[10]" size="92" value="Cancel 30 Days After Ship Date - No Backorders Without Prior Approval" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Note: <input name="v[12]" size="105" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table class="count">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Main Dashboard" onclick="parent.location='../dashboard.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Log Out" onclick="parent.location='../loggedOut.php'" type="button" /></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
    </tr>
</table>
</form>
</div>
</body>

</html>