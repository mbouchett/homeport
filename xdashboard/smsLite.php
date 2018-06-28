<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
$username=$_SESSION['username'];
$cust=$_REQUEST['cust'];
$comp=$_REQUEST['comp'];
$sku=$_REQUEST['sku'];
$desc=$_REQUEST['desc'];
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
<link rel="SHORTCUT ICON" href="dash.ico">
<title>Homeport Warehouse Pickup</title>
<link href="../style01.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Refresh" content="300">

</head>

<body style="text-align: center">
<span style="font-family: Arial; font-size: 24px; font-weight: bold; ">Homeport Website Dashboard</span>

<br />
 <center><b>Message Log</b></center>
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
    <td><input type="button" value="Delete" onclick="parent.location='deletePickup.php?recno=<?= $pickup[$i]['recno'] ?>'" /></td>
  </tr>
  <?php } ?>
 </table>
</body>
</html>