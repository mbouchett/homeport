<?php
//saveuChangePassword.php 2018/05
// edit a profile
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_COOKIE['regnum'])){
    $r=$_SESSION['r'];
  }else{
        echo "No Authorization";
        exit;
  }
//r[0]=regnum
//r[1]=partner 1 First Name
//r[2]=partner 2 First Name
  $message=$_REQUEST['message'];
  $messColor=$_REQUEST['messColor'];
  $messSize=$_REQUEST['messSize'];
  
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID` = \''.trim($r[0]).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>

<html>

<head>
  <link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
  <link rel="stylesheet" href="css/registry.css" type="text/css" />
  <title><?=$r[1]?> & <?=$r[2]?> Change Your Profile</title>
  <script type="text/javascript" src="../webtools/date/datetimepicker_css.js"></script>

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
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Change Profile</div></td></tr>
<tr><td align="center"><?=$r[1]?> & <?=$r[2]?></td></tr>
</table>
<br />
<form action="saveuChangeProfile.php" method="post">
<table align="center">
    <tr><td align="left">Partner 1:</td><td>First*</td><td><input name="rN[0]" type="text" value="<?=stripslashes($row['reg_partner1F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[1]" type="text" value="<?=stripslashes($row['reg_partner1L'])?>" /></td>
    </tr>
    <tr><td align="left">Partner 2:</td><td>First*</td><td><input name="rN[2]" type="text" value="<?=stripslashes($row['reg_partner2F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[3]" type="text" value="<?=stripslashes($row['reg_partner2L'])?>" /></td> 
    </tr>  
</table>
<table align="center">
	 <tr><td colspan="5"><hr /></td></tr>
	 <tr>
         <td><div style="color:#<?=$alertColor?>">Event Date*</div></td><td><div style="color:#<?=$alertColor?>">Main Phone*</div></td>     <td>Alternate Phone</td><td><div style="color:#<?=$alertColor?>">Main Email*</div></td><td>Alternate Email</td>
     </tr>
     <tr>
		<td><input title="Use Calender To The Right To Modify The Date" readonly="readonly" name="rN[4]" type="text" value="<?=stripslashes($row['reg_event_date'])?>" size="10" id="demo1" /><a title="Click here to edit date" href="javascript:NewCssCal('demo1')"><img border="0" src="../webtools/date/images/cal.gif" width="16" height="16" alt="Pick a date"></a></td><td><input name="rN[5]" type="text" value="<?=stripslashes($row['reg_phone01'])?>" /></td>
        <td><input name="rN[6]" type="text" value="<?=stripslashes($row['reg_phone02'])?>" /></td><td><input name="rN[7]" type="text" value="<?=stripslashes($row['reg_email01'])?>" /></td>
        <td><input name="rN[8]" type="text" value="<?=stripslashes($row['reg_email02'])?>" /></td>    
    </tr>
    <tr><td colspan="5"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td colspan="2">Address Pre-Event</td><td colspan="2">Address Post-Event <small>(if different)</small></td>
    </tr>
	<tr>
    	<td rowspan="2">Street Address</td><td align="center"><input size="37" name="rN[9]" type="text" value="<?=stripslashes($row['reg_addr01'])?>" /></td><td rowspan="2">Street Address</td><td align="center"><input size="37" name="rN[17]" type="text" value="<?=stripslashes($row['reg_postaddr01'])?>" /></td>
    </tr>
	<tr>
    	<td align="center"><input size="37" name="rN[10]" type="text" value="<?=stripslashes($row['reg_addr02'])?>" /></td><td align="center"><input size="37" name="rN[18]" type="text" value="<?=stripslashes($row['reg_postaddr02'])?>" /></td>
    </tr>
	<tr>
    	<td>City, State, Zip</td><td align="center"><input size="37" name="rN[11]" type="text" value="<?=stripslashes($row['reg_addr03'])?>" /></td><td>City, State, Zip</td><td align="center"><input size="37" name="rN[19]" type="text" value="<?=stripslashes($row['reg_postaddr03'])?>" /></td>
    </tr>
        <tr><td colspan="4"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td>Contact Name:</td><td><input size="37" name="rN[12]" type="text" value="<?=stripslashes($row['reg_contact'])?>" /></td><td>Relation To You:</td><td><input size="37" name="rN[13]" type="text" value="<?=stripslashes($row['reg_relation'])?>" /></td>
    </tr>
	<tr>
    	<td>Contact Phone:</td><td><input size="37" name="rN[14]" type="text" value="<?=stripslashes($row['reg_cphone01'])?>" /></td><td>Alternate Phone</td><td><input size="37" name="rN[15]" type="text" value="<?=stripslashes($row['reg_cphone02'])?>" /></td>
    </tr>
	<tr>
    	<td colspan="2" align="right">Contact Email:</td><td align="left" colspan="2"><input size="37" name="rN[16]" type="text" value="<?=stripslashes($row['reg_cemail'])?>" /></td>
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
</table>
<table align="center">
    <tr><td align="center"><input type="submit" name="" value="Save Changes" /></td><td align="center"><input value="Return To Registry Manager" onclick="parent.location='regDash.php'" type="button">
</td></tr>

</table>
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
