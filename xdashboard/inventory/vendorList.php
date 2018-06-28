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

//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` ORDER BY `number`' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results-1; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $vendors[$i]=$row;                        //Save The Record To The Array
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
  <title>Vendor List (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<div align="center"><img src="../../images/banner2010.jpg" style="border: 0px solid" alt="Homeport Online"></div>
<table class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" type=button value="Close Window" onClick="javascript:window.close();"></td>
    </tr>
</table>
<table class="menu">
    <tr><td>Vendor #</td><td>Vendor Name</td></tr>
    <tr><td height="1" bgcolor="#000000" colspan="2"></td></tr>
    <?php for($i=0; $i < $num_results-1; $i++){ ?>
    <tr>
        <td><?= $vendors[$i]['number'] ?></td>
        <td><?= $vendors[$i]['name'] ?></td>
    </tr >
    <tr><td height="1" bgcolor="#996633" colspan="2"></td></tr>
    <?php } ?>
</table>
<table class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" type=button value="Close Window" onClick="javascript:window.close();"></td>
    </tr>
</table>
</div>
</body>

</html>