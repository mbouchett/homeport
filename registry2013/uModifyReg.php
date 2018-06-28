<?php
//uModifyReg.php 2018/05
// alter registry
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_COOKIE['regnum'])){
    $r=$_SESSION['r'];
  }
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];

header('Cache-Control: max-age=900');
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID` = \''.trim($r[0]).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

$r[0]=stripslashes($row['reg_ID']);
$r[1]=stripslashes($row['reg_partner1F']);
$r[2]=stripslashes($row['reg_partner2F']);
$r[3]=stripslashes($row['reg_partner1L']);
$r[4]=stripslashes($row['reg_partner2L']);
$r[5]=stripslashes($row['reg_event_date']);

// load couples registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `reg_items` WHERE `reg_ID` = \''.trim($r[0]).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
for($i=0; $i<$num_results; $i++){
    $row=mysqli_fetch_assoc($result);
    $item[$i] = $row;
}
$itemcount = count($item);
//pick up Item Details
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$itemcount; $i++){
    $sql = "SELECT * FROM `items` WHERE `item_ID` = '".$item[$i]['item_ID']."';";
    $result = mysqli_query($db, $sql); // create the query object
    $row=mysqli_fetch_assoc($result);
      $item[$i]['pic']=$row['item_pic'];
      $item[$i]['retail']=$row['item_retail'];
      $item[$i]['department']=$row['dept_ID'];
      $item[$i]['vendor']=$row['vendor_ID'];
      $item[$i]['details']=$row['item_details'];
}
mysqli_close($db); //close the connection
?>
<!DOCTYPE html>
<html>
<head>
<link rel="SHORTCUT ICON" href="http://www.homeportonline.com/registry/images/bg.ico">
<link rel="stylesheet" href="css/registry.css" type="text/css" />
<title><?=$r[1]?> & <?=$r[2]?> Manage Your Registry</title>


<?php include '../popstyle.php'; ?>
</head>

<body>

<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a>
  <div id="menu">
      <ul>
        <li><a href="http://www.homeportonline.com/" class="menubutton">HOME</a></li>
        <li><a href="http://www.homeportonline.com/registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="http://www.homeportonline.com/departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>
</div>
<br />
<br />
<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Registry Manager</div></td></tr>
<tr><td align="center"><?=$r[1]?> & <?=$r[2]?></td></tr>
</table>

<table width="700" align="center">
  <tr bgcolor="#ECD9FF">
      <td align="center"><b>The Suspects:</b>
      <?=$r[1]?> <?=$r[3]?> &
      <?=$r[2]?> <?=$r[4]?>
      <b>The Big Day: <?=$r[5]?></b>
      </td>
  </tr>
  <tr>
      <td><hr /></td>
  </tr>
</table>
<form action="saveuModifyReg2.php" method="post">
<table width="700" align="center">
  <tr>
      <td>Picture</td><td>Description</td><td>Price</td><td align="center">Wanted</td><td align="center">Received</td><td align="center">Remove</td>
  </tr>
  <tr>
      <td colspan="6"><hr /></td>
  </tr>
  <?php if($itemcount){
      for($i=0; $i<$itemcount; $i++){
      $enabled = "";
      if(!stripslashes(!$item[$i]['ri_sold'])) $enabled = 'disabled="disabled"';
      ?>
        <tr>
        <td><a class="thumbnail" href="#thumb"><img border="0" height="25" src="<?=resolve($item[$i]['pic'])?>"><span><img src="<?=resolve($item[$i]['pic'])?>" /><b><?=$item[$i]['description']?></b></span></a></td>
        <td><?=$item[$i]['ri_desc']?>
        <input type="hidden" name="recno[<?= $i ?>]" value="<?=stripslashes($item[$i]['ri_ID'])?>" />
        </td>
        <td><?=stripslashes($item[$i]['ri_price'])?></td>
        <td align="center"><input <?= $enabled ?> size="4" name="adjQty[<?=$i?>]" value="<?=stripslashes($item[$i]['ri_qty'])?>" /></td>
        <td align="center"><?=stripslashes($item[$i]['ri_sold'])?></td>
        <td title="Checking Here Will Delete The Item From Your Registry" align="center">
        <input type="checkbox" name="deleteMe[<?=$i?>]" <?= $enabled ?> />
        <input name="sku[<?=$i?>]" type="hidden" value="<?=stripslashes($item[$i]['sku'])?>" />
        <input name="regNum[<?=$i?>]" type="hidden" value="<?=stripslashes($item[$i]['reg_ID'])?>" />
        <input name="recd[<?=$i?>]" type="hidden" value="<?=stripslashes($item[$i]['sold'])?>" />
        </td>
        </tr>
        <tr><td height="1" bgcolor="#3d3d3d" colspan="6"></td></tr>
  <?php }
  }else { ?>
    <tr>
      <td colspan="6" align="center">You Probably Want To Get Started Adding Items To your Registry Right Now!</td>
  </tr>

  <?php } ?>
</table>
<br />
<div align="center">
<input type="submit" value="Save Changes" /><input value="Return To Registry Manager" onclick="parent.location='regDash.php'" type="button"></div>
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