<?php
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

$vendor=$_REQUEST['ven'];
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
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png"/>
  <title>Vendor Edit (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<div align="center"><img src="../../images/banner2010.jpg" style="border: 0px solid" alt="Homeport Online"></div>
<br />
<form action="processVendorEdit.php" method="POST" >
<hr size="12" noshade="noshade"/>
<table align="center">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='items.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Edit'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Cancel Changes" onclick="parent.location='venEdit.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Main Dashboard" onclick="parent.location='../dashboard.php'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit"/></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table class="count" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>

<table class="count">
    <tr >
        <td colspan="2">
        		<h1>
        			<?= $vendors['number'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        			<input name="v[1]" size="40" value="<?= $vendors['name'] ?>" />
        			Count Group:<input name="v[14]" size="5" value="<?= $vendors['count_group'] ?>" />
        		</h1>        		
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr class="vendor">
        <td>Address Line 1:<input name="v[2]" size="40" value="<?= $vendors['addr1'] ?>" /></td>
        <td align="right">Representative: <input name="v[6]" size="40" value="<?= $vendors['rep'] ?>" /></td>
    </tr>
    <tr class="vendor">
        <td>Address Line 2:<input name="v[3]" size="40" value="<?= $vendors['addr2'] ?>" /></td>
        <td align="right">Fax Number:<input name="v[7]" size="40" value="<?= $vendors['fax'] ?>" /></td>
    </tr>
    <tr class="vendor">
        <td>Address Line 3:<input name="v[4]" size="40" value="<?= $vendors['addr3'] ?>" /></td>
        <td align="right">Voice Number:<input name="v[8]" size="40" value="<?= $vendors['voice'] ?>" /></td>
    </tr>
    <tr class="vendor">
        <td >Email Address :<input name="v[5]" size="40" value="<?= $vendors['email'] ?>" /></td>
        <td align="right">Price Multiplier:<input name="v[11]" size="40" value="<?= $vendors['multi'] ?>" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">Ship Method 1: <input name="v[9]" size="92" value="<?= $vendors['ship1'] ?>" /></td>
    </tr>
    <tr>
        <td colspan="2">Ship Method 2: <input name="v[10]" size="92" value="<?= $vendors['ship2'] ?>" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2">
            Note: <input name="v[12]" size="105" value="<?= $vendors['note'] ?>" />
            <?php
                 $checked = "";
                 if($vendors['hti'] == 1) $checked = 'checked="checked"'
            ?>
            HTI<input name="v[13]" type="checkbox" <?= $checked ?>  />
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table align="center">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='items.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Edit'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Cancel Changes" onclick="parent.location='venEdit.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Main Dashboard" onclick="parent.location='../dashboard.php'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit"/></td>
    </tr>
</table>
<input type="hidden" name="record" value="<?= $vendors['recno'] ?>" />
<input type="hidden" name="v[0]" value="<?= trim($vendors['number']) ?>" />
</form>
</div>
</body>

</html>