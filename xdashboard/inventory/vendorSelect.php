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

$direction=$_REQUEST['direction'];
//Open An SQL Database And Store It In A Local Array
//               Database     Username         Pass    Database Name
//               Location                      Word
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT `recno`, `number`, `name` FROM `vendors` ORDER BY `name`' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $vendors[$i]=$row;                      //Save The Record To The Array
    }                                           //Close The Loop
$vencount=count($vendors);

// indicates which program to run
$dir="items";
if($direction=="Edit") $dir="venEdit";
if($direction=="Enter") $dir="enterCount";
if($direction=="Add Details") $dir="details";
if($direction=="Count") $dir="printCount";
if($direction=="Order") $dir="offCycle";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
  <title>Vendor Selection (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body class="dash">
  <div id="banner">
    <a href="../../index.php"><img alt="Homeport Logo" src="design/hplogosm.png" /></a>
    
  </div>
<div id="wrapper">
<table class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Main Dashboard" onclick="parent.location='../dashboard.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Log Out" onclick="parent.location='../loggedOut.php'" type="button" /></td>
    </tr>
</table>
<br />
<form action="vendorDirect.php" method="POST" >
<table align="center">
    <tr>
        <td align="center"><h1>Select A Vendor To <?= $direction ?></h1></td>
    </tr>
    <tr >
        <td align="center">
            <select name="vendor" size="1">
            <?php for($i=0; $i<$vencount; $i++){ ?>
            <option  onclick="parent.location='<?= $dir ?>.php?ven=<?= trim($vendors[$i]['number']) ?>'" value="<?= trim($vendors[$i]['number']) ?>"><?= $vendors[$i]['name'] ?></option>
            <? } ?>
            </select>
            <input type="submit" name="" value="Select" />
        </td>
    </tr>
</table>
<input type="hidden" name="dir" value="<?= $dir ?>" />
</form>
</div>
</body>

</html>