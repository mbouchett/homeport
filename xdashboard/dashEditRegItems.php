<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";
include "../functions/f_resolve.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

  $regnum=$_REQUEST['regnum'];
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];
  $blast=$_REQUEST['blast'];

//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `g_couples` WHERE `regnum` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

$r[0]=stripslashes($row['regnum']);
$r[1]=stripslashes($row['partner1F']);
$r[2]=stripslashes($row['partner2F']);
$r[3]=stripslashes($row['partner1L']);
$r[4]=stripslashes($row['partner2L']);
$r[5]=stripslashes($row['eventdate']);
$r[6]=stripslashes($row['email01']);

// load couples registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `g_items` WHERE `regnum` = \''.trim($r[0]).'\' ' ;
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
    $sql = "SELECT * FROM `items` WHERE `recno` = '".$item[$i]['item']."';";
    $result = mysqli_query($db, $sql); // create the query object
    $row=mysqli_fetch_assoc($result);
      $item[$i]['pic']=$row['pic'];
      $item[$i]['retail']=$row['retail'];
      $item[$i]['department']=$row['department'];
      $item[$i]['vendor']=$row['vendor'];
      $item[$i]['details']=$row['details'];
}
mysqli_close($db); //close the connection

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8_general_ci" />
<link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
<title><?=$r[1]?> & <?=$r[2]?> Manage Your Registry (a)</title>

<STYLE TYPE="text/css">
     <!--
     A:visited { color: #660066; text-decoration: none; background: transparent;}
     A:link { color: #330066; text-decoration: none; background: transparent;}
     A:active { color: White; text-decoration: none; background: transparent;}
     A:hover { color: orange; text-decoration: none; background: transparent;}
     -->
</STYLE>
<script type="text/javascript">
function setFocus()
{
     document.getElementById("start").focus();
}
</script>
<?php include '../popstyle.php'; ?>
</head>

<body onload="setFocus()">
<div align="center"><img src="../images/tagline.jpg" style="border: 0px solid" alt="Homeport Online">
</div>
<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Dashboard Registry Manager</div></td></tr>
<tr><td align="center"><?=$r[1]?> & <?=$r[2]?> &nbsp;&nbsp;&nbsp;&nbsp;: <?=$r[6]?> :</td></tr>
</table>
<form action="dashAddRegistryItem.php" method="post">
<table width="700" align="center">
  <tr bgcolor="#00CCCC">
      <td align="center"><b>The Suspects:</b>
      <?=$r[1]?> <?=$r[3]?> &
      <?=$r[2]?> <?=$r[4]?>
      <b>The Big Day: <?=$r[5]?></b>
      </td>
  </tr>
  <tr>
      <td>Record#:<input id="start" name="sku" /> Quantity:<input name="qty" size="5" /><input type="submit" name="" value="Add This Item To The Registry" /></td>
  </tr>
  <tr>
      <td><hr /></td>
  </tr>
</table>
<input type="hidden" name="regnum" value="<?=$r[0]?>" />
</form>
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php } ?>
<form action="dashSaveuModifyReg.php" method="POST">
<table width="700" align="center">
  <tr>
      <td>Picture</td>
      <td>Description</td>
      <td>Price</td>
      <td align="center">Want</td>
      <td align="center">Got</td>
      <td align="center">Purchased By- hold/ship/take</td>
      <td align="center">Item</td>
      <td onclick="parent.location='dashEditRegItems.php?regnum=<?= $regnum ?>&blast=yes'" align="center">Remove</td>
  </tr>
  <tr>
      <td colspan="6"><hr /></td>
  </tr>
  <?php if($num_results){
        $total=0;
      for($i=0; $i<$itemcount; $i++){
        $total = $total + ($item[$i]['qty']*$item[$i]['price']);
         ?>
        <tr>
        <td>
            <a class="thumbnail" href="#thumb">
                <img style=" max-height: 25px; max-width: 25px" border="0"  src="<?=resolve($item[$i]['pic'])?>">
                <span><img src="<?=resolve($item[$i]['pic'])?>" /><b><?=$item[$i]['description']?></b></span>
            </a>
        </td>
        <td><input size="40" name="desc[<?=$i?>]" value="<?=$item[$i]['description']?>" />
            <input type="hidden" name="recno[<?= $i ?>]" value="<?=$item[$i]['recno']?>" />
        </td>
        <td><input size="3" name="price[<?=$i?>]" value="<?=$item[$i]['price']?>" /></td>
        <td align="center"><input size="2" name="adjQty[<?=$i?>]" value="<?=$item[$i]['qty']?>" /></td>
        <td align="center"><input name="recd[<?=$i?>]" size="2" value="<?=$item[$i]['sold']?>" /></td>
        <td align="center"><input name="hold[<?=$i?>]" size="30" value="<?=$item[$i]['onhold']?>" /></td>
        <td align="center"><input name="item[<?=$i?>]" size="6" value="<?=$item[$i]['item']?>" /></td>
        <td title="Checking Here Will Delete The Item From Your Registry" align="center">
        <?php if(!$item[$i]['sold'] && $blast=="yes") {?>
        <input type="checkbox" name="deleteMe[<?=$i?>]" />
        <?php } ?>
        <input name="sku[<?=$i?>]" type="hidden" value="<?=$item[$i]['sku']?>" />
        <input name="regNum[<?=$i?>]" type="hidden" value="<?=$item[$i]['regnum']?>" />
        </td>
        </tr>
        <tr><td height="1" bgcolor="#BBBBBB" colspan="6"></td></tr>
  <?php }
  }else { ?>
    <tr>
      <td colspan="6" align="center">You Probably Want To Get Started Adding Items To your Registry Right Now!</td>
    </tr>

  <?php } ?>
    <tr>
      <td ></td><td align="right">Total Registry Value $</td><td><?= number_format($total,2) ?></td>
    </tr>
</table>
<br />
<div align="center">
<input type="submit" value="Save Changes" /><input value="Return To Registry Manager" onclick="parent.location='registryEdit.php'" type="button"></div>
</form>
<br />
<?php if($message){?>
<table align="center" border="4" >
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message); }?>
 </body>
</html>