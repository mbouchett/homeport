<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//create short variable name
//load Couples
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `g_couples` ORDER BY `eventdate` DESC ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
<link rel="SHORTCUT ICON" href="http://www.homeportonline.com/registry/images/bg.ico">
<title>Homeport Gift Registry (a)</title>

</head>
<body>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <!-- <div id="menu">
      <ul>
        <li><a href="http://www.homeportonline.com/" class="menubutton">HOME</a></li>
        <li><a href="http://www.homeportonline.com/webcam.php" class="menubutton">WEBCAM</a></li>
        <li><a href="http://www.homeportonline.com/registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="http://www.homeportonline.com/departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>  -->
</div>
<br />
<span class="dashtitle">Homeport Registry Profile Editor</span><br />
<a class="dashbut" onclick="parent.location='registryEdit.php'" type="button"><span class="icontext">&#128281;&nbsp;</span>Registry Dashboard</a>
<br />
<table id="regtable" width="600" align="center" cellspacing="5"  bgcolor="#CCEEFF">
  <tr><td align="center"><h3>Couple</h3></td><td><h3>Big Day</h3></td></tr>
  <tr><td colspan="2"><hr></td></tr>
  <?php for($i=0; $i<$num_results; $i++){
      $row=mysqli_fetch_assoc($result);
      $day=substr(stripslashes($row['eventdate']),-2);
      $month=substr(stripslashes($row['eventdate']),5,2);
      $year=substr(stripslashes($row['eventdate']),0,4);
  ?>
  <tr><td align="center"><a href="dashModifyRegProfile.php?regnum=<?=stripslashes($row['regnum'])?>"><div><?=stripslashes($row['partner1F'])?> <?=stripslashes($row['partner1L'])?> & <?=stripslashes($row['partner2F'])?> <?=stripslashes($row['partner2L'])?></div></a></td>
  <td><div><?=$month?>/<?=$day?>/<?=$year?></div></td></tr>
<?php } ?>
<tr><td colspan="2"><hr></td></tr>
</table>
 <br />
<a class="dashbut" onclick="parent.location='registryEdit.php'" type="button"><span class="icontext">&#128281;&nbsp;</span>Registry Dashboard</a>
<br />
</body>
</html>
