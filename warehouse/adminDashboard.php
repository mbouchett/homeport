<?php
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$bgColor="#555555";  //Background Color For the table cell
$tag=$_REQUEST['tag'];
unset($enabled);
if(!$tag) $enabled='disabled="disabled"';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="SHORTCUT ICON" href="../images/278.ico">
<title>Warehouse Administrator Dashboard</title>
</head>

<body>
<br />
<center><big><b>Warehouse Administrator Dashboar<a style="text-decoration: none" href="adminDashboard.php?tag=woopie" >d</a></b></big>
<br /><br />
<table align="center" width="600" border="4" bordercolor="#BE873B" cellpadding="8">
	<tr>
		<td align="center" bgcolor="<?=$bgColor?>"><input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Inventory&nbsp&nbsp;&nbsp;&nbsp;" onclick="parent.location='addWhseInventory.php'" type="button"></td>
        <td align="center" bgcolor="<?=$bgColor?>"><input value="&nbsp;&nbsp;&nbsp;&nbsp;Edit Inventory&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='searchEdit.php'" type="button"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="<?=$bgColor?>"><input <?= $enabled ?> value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tag Verify&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='tag.php'" type="button"></td>
		<td align="center" bgcolor="<?=$bgColor?>">
        <input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='../dashboard/'" type="button">
        </td>
	</tr>
</table>
</center>
</body>
</html>
