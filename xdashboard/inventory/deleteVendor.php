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

    //Establish Variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

$ven=$_REQUEST['ven'];
$recno=$_REQUEST['recno'];

//echo $record."<br />";
//echo $v[0]."<br />"; //number
//echo $v[1]."<br />"; //name
//echo $v[2]."<br />"; //addr1
//echo $v[3]."<br />"; //addr2
//echo $v[4]."<br />"; //addr3
//echo $v[5]."<br />"; //email
//echo $v[6]."<br />"; //rep
//echo $v[7]."<br />"; //fax
//echo $v[8]."<br />"; //voice
//echo $v[9]."<br />"; //ship1
//echo $v[10]."<br />"; //ship2
//echo $v[11]."<br />"; //multi
//echo $v[12]."<br />"; //note
//echo 'venEdit.php?ven='.$v[0].'&message=Changes Saved&messColor=009900&messSize=24';
//exit;
$ven=$_REQUEST['ven'];
//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `recno` = "'.$recno.'"' ;          //Create The Search Query
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
  <title>Delete Vendor (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center"><img src="../../images/banner2010.jpg" style="border: 0px solid" alt="Homeport Online"></div>
<br />
<hr size="12" noshade="noshade"/>
<table align="center">
    <tr >
        <td class="dashcell"><input title="Do Not Delete" class="dashbut" value="Cancel Changes" onclick="parent.location='venEdit.php?ven=<?= $ven ?>'" type="button"></td>
        <td title="This operation Cannot Be Undone" class="dashcell"><a style="text-decoration: none; color: #FF0000; font-family: Arial" href="processVenDel.php?ven=<?= $vendors['number'] ?>&recno=<?= $vendors['recno'] ?>">Clicking Here Will Delete the Vendor And All Assocaited items</a></td>
    </tr>
</table>

<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php unset($message);
 }?>
<table style="font-family: Arial" width="800" align="center">
    <tr>
        <td align="center" style=" font-family: Arial Black; font-size: 24px">Preparing To Delete</td>
    </tr>
    <tr >
        <td align="center" style=" font-family: Arial Black; font-size: 24px"><?= $vendors['number'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $vendors['name'] ?></td>
    </tr>
    <tr >
        <td align="center" style=" font-family: Arial Black; font-size: 14px; color: #FF3333">This operation Cannot Be Undone!</td>
    </tr>
</table>
</body>
</html>
