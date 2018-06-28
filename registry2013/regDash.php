<?php
//regDash.php 2018/05
// registry dashboard
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

// Get user and password sent from login form
$x_user=$_POST['username'];
$x_password=$_POST['password'];

// Verify That both Fields Are Filled In
if(!$x_user || !$x_password){
	header('Location: index.php?message=Both Fields Are Required&messColor=FF5555&messSize=24');
	die;
}

$hash = crypt($x_password, '$2a$07$theclockswerestrikingthirteen$');

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

//check database for user's account
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `registry` WHERE `reg_username` LIKE '".trim($x_user)."'";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db);

//if the account is not found
if($num_results==0){
   	header('Location: index.php?message=Username/Password combination Not Found&messColor=FF5555&messSize=24');
    die;
}

//load the result into an associative array
$reg=mysqli_fetch_assoc($result);

//if username and password don't match
if($hash != $reg['reg_pw']){
   	header('Location: index.php?message=Username/Password combination Not Found&messColor=FF5555&messSize=24');
    die;
}

$r[0]=stripslashes($reg['reg_ID']);
$r[1]=stripslashes($reg['reg_partner1F']);
$r[2]=stripslashes($reg['reg_partner2F']);
$r[3]=stripslashes($reg['reg_partner1L']);
$r[4]=stripslashes($reg['reg_partner2L']);
$r[5]=stripslashes($reg['reg_event_date']);

session_start(); // start up your PHP session!
$_SESSION['r']=$r;

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

setcookie("regnum", $r[0],time()+60*60*24*30,"/");
setcookie("partner1F", $r[1],time()+60*60*24*30,"/");
setcookie("partner2F", $r[2],time()+60*60*24*30,"/");

// load couples registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `reg_items` WHERE `reg_ID` ='.$r[0];
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
<link rel="stylesheet" href="css/registry.css" type="text/css" />
<title><?=$r[1]?> & <?=$r[2]?> Manage Your Registry</title>
<script type="text/javascript">
// Popup window code
  function newPopup(url) {
    popupWindow = window.open(
    url,'popUpWindow','height=500,width=400,left=10,top=10,resizable=yes,scrollbars=no,menubar=no,directories=no,status=yes')
  }
</script>

<?php include '../popstyle.php'; ?>
</head>

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
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Registry Manager</div></td></tr>
<tr><td align="center"><?=$r[1]?> & <?=$r[2]?></td></tr>
</table>
<br />
<table align="center" width="400">
    <tr bgcolor="#FFFFEA"><td align="center" width="200"><div style="font-size: 20px; font-family: Arial"><a href="uChangePassword.php">Change Password</a></div></td><td align="center" title="modify contact information"><div style="font-size: 20px; font-family: Arial"><a href="uChangeProfile.php">Edit Profile</a></div></td></tr>
    <tr bgcolor="#FFFFEA"><td align="center" width="200" title="delete items or change quantities"><div style="font-size: 20px; font-family: Arial"><a href="uModifyReg.php">Modify Registry</a></div></td><td align="center"><div style="font-size: 20px; font-family: Arial"><a href="logout.php">Log Out</a></div></td></tr>
    <tr bgcolor="#FFFFEA"><td colspan="2" align="center" width="200" title="Add Items To Your Registry"><a href="../index.php?ref=browsethis"><div style="font-size: 20px; font-family: Arial">Add Items To Your Registry</div></a></td></tr>
</table>
<br />
<table align="center" border="0" width="700">
	<tr bgcolor="#FFFFEA">
      <td align="center"><div style="font-size: 20px"><a href="JavaScript:newPopup('../registry2013/addInfo.php');">Adding Items</a></div></td>
      <td align="center"><div style="font-size: 20px"><a href="JavaScript:newPopup('../registry2013/nonwebInfo.php');">Adding Items Not On the Website</a></div></td>
      <td align="center"><div style="font-size: 20px"><a href="JavaScript:newPopup('../registry2013/contactInfo.php');">Contact Homeport</a></div></td>
    </tr>
</table>
<br />
<table width="800" align="center">
  <tr bgcolor="#ECD9FF">
      <td align="center">
      <?=$r[1]?> <?=$r[3]?> &
      <?=$r[2]?> <?=$r[4]?>
      <b> - The Big Day: <?=$r[5]?></b>
      </td>
  </tr>
  <tr>
      <td><hr /></td>
  </tr>
</table>
<table width="800" align="center">
  <tr>
      <td>Picture</td><td>Description</td><td>Price</td><td align="center">Wanted</td><td align="center">Received</td><td>Purchase Info</td>
  </tr>
  <tr>
      <td colspan="6"><hr /></td>
  </tr>
  <?php if($itemcount){
      for($i=0; $i<$itemcount; $i++){ ?>
        <tr>
        <td><a class="thumbnail" href="#thumb"><img border="0" height="25" src="<?=resolve($item[$i]['pic'])?>"><span><img src="<?=resolve($item[$i]['pic'])?>" /><b><?=$item[$i]['description']?></b></span></a></td>
        <!--<td><a class="thumbnail" href="#thumb"><img border="0" height="25" src="http://www.homeportonline.com/images/<?=$item['category']?>/<?=stripslashes($row['sku'])?>.jpg"><span><img src="http://www.homeportonline.com/images/<?=stripslashes($row['category'])?>/<?=stripslashes($row['sku'])?>.jpg" /><b><?=stripslashes($row['description'])?></b></span></a></td>-->
        <td><?=$item[$i]['ri_desc']?></td>
        <td><?=$item[$i]['ri_price']?></td>
        <td align="center"><?=$item[$i]['ri_qty']?></td>
        <td align="center"><?=$item[$i]['ri_sold']?></td>
        <td style="font-size: 10px; font-family: Arial; font-weight: normal"><?=$item[$i]['ri_on_hold']?></td>
        </tr>
  <?php }
  }else { ?>
    <tr>
      <td colspan="6" align="center">You Probably Want To Get Started Adding Items To your Registry Right Now!</td>
  </tr>

  <?php } ?>
</table>
</html>