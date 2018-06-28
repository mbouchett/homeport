<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
  	 header('location: index.php');
    exit;
  }

//includes loads from the rootr so: ../../ ../
include "../db.php";

unset($del);
$username=$_SESSION['username'];
$cust=$_REQUEST['cust'];
$comp=$_REQUEST['comp'];
$sku=$_REQUEST['sku'];
$desc=$_REQUEST['desc'];
$del=$_REQUEST['del'];
if(!$username) $username = $_REQUEST['user'];

//Open pickup Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM pickup ORDER BY recno DESC';              //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $pickup[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$recCount=count($pickup);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="300">
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Homeport Warehouse Pickup</title>
<link href="../style01.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Refresh" content="300">

</head>

<body style="text-align: center">
<span style="font-family: Arial; font-size: 24px; font-weight: bold; ">Homeport Website Dashboard</span>

<form id="sms" name="sms" method="post" action="sendsms.php"> <!-- action="http://noir15.com/sendsms.php" -->
<table bgcolor="#FFFFCC" align="center" width="600" border="1">
  <tr>
    <td align="right" valign="top">Send To:</td>
    <td align="left"><select name="who" id="carrier">
      <option value="harrison">Harrison</option>
      <option value="mark">Mark</option>
      <option value="francois">François</option>
	  <option value="frank">Frank</option>
    </select></td>
    <td align="center"><input type="submit" name="Submit" value="Send Message" /></td><td><input type="button" onclick="parent.location='dashboard.php'" value="Dashboard" /></td>
  </tr>
  <tr><td align="right">What:</td>
    <td colspan="3">PU@WH <input type="radio" name="what" value="PU@WH" checked="checked" />|
                  PU@STORE<input type="radio" name="what" value="PU@STORE" />|
                  OTHER<input type="radio" name="what" value="OTHER" />
    </td>
  </tr>
  <tr>
    <td align="right" valign="top">When:</td>
    <td title="Time" align="center"><span style="font-size: 9px; color: #A8A8A8">00:00</span><br /><input name="time" size="10" value=""></td>
    <td title="Date" align="center"><span style="font-size: 9px; color: #A8A8A8">yyyy-mm-dd</span><br /><input name="date" size="10" value=""></td>
    <td title="Day" align="center"><span style="font-size: 9px; color: #A8A8A8">Sat Sun Mon Tue Wed Thu Fri</span><br /><input name="day" size="10" value=""></td>
  </tr>
  <tr>
    <td align="right" valign="top">Customer Name:</td>
    <td colspan="3" align="left"><input title="<?= $username ?>" name="customer" size="45" id="customer" value="<?= $cust ?>"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Company</td>
    <td colspan="3" align="left"><input name="company" size="45" id="company" value="<?= $comp ?>"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Sku</td>
    <td colspan="3" align="left"><input name="sku" size="45" id="sku" value="<?= $sku ?>"></td>
  </tr>
    <tr>
    <td align="right" valign="top">Description</td>
    <td colspan="3" align="left"><input name="description" size="45" id="description" value="<?= $desc ?>"></td>
  </tr>
  <tr>
    <td align="right" valign="top">Message:</td>
    <td colspan="3" align="left">
        <input name="message" size="45" id="message" />
        <input type="hidden" name="user" value="<?=$username ?>" />
    </td>
  </tr>
</table>
<br />
 <center><b>Message Lo<a style="text-decoration: none" href="sms.php?del=1">g</a></b></center>
 <table align="center" border="1">
   <tr style=" font-size: 10px; font-family: Arial; font-weight: bold">
    <td></td><td>When</td><td>Who</td><td>What</td><td>Customer</td><td>Company</td><td>Sku</td><td>Description</td><td>Message</td><td>Sent By</td>
  </tr>
 <?php for($i=0; $i<$recCount; $i++){
       $backcolor='';
       $conbut = '';
       if($pickup[$i]['confirmed'] == 1){
          $backcolor='bgcolor="#33FF00"';
       }else {
          $conbut = 'Yes';
       }
 ?>
  <tr <?= $backcolor ?> style="font-size: 10px; font-family: Arial">
<?php if($conbut == "Yes"){ ?>
    <td><input style="font-size: 8px" type="button" value="Confirm" onclick="parent.location='confirm.php?recno=<?= $pickup[$i]['recno'] ?>'" /></td>
<?php }else{ ?>
          <td></td>
<?php } ?>
    <td><?= $pickup[$i]['when'] ?></td>
    <td><?= $pickup[$i]['who'] ?></td>
    <td><?= $pickup[$i]['what'] ?></td>
    <td><?= $pickup[$i]['customer'] ?></td>
    <td><?= $pickup[$i]['company'] ?></td>
    <td><?= $pickup[$i]['sku'] ?></td>
    <td><?= $pickup[$i]['description'] ?></td>
    <td title="<?= $pickup[$i]['message'] ?>"><?= substr($pickup[$i]['message'],0,20) ?></td>
    <td><?= $pickup[$i]['username'] ?></td>
<?php if($del == 1){ ?>
    <td><input type="button" value="Delete" onclick="parent.location='deletePickup.php?recno=<?= $pickup[$i]['recno'] ?>'" /></td>
<?php } ?>
  </tr>
  <?php } ?>
 </table>
</form>
</body>
</html>