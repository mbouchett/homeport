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

//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `g_couples` WHERE `regnum` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

// load couples registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `g_items` WHERE `regnum` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$regitems=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
 for($i=0; $i<$regitems; $i++){
    $items[$i] = mysqli_fetch_assoc($result);
 }

//pick up Item Details
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$regitems; $i++){
    $sql = "SELECT * FROM `items` WHERE `recno` = '".$items[$i]['item']."';";
    $result = mysqli_query($db, $sql); // create the query object
    $rows=mysqli_fetch_assoc($result);
      $items[$i]['pic']=$rows['pic'];
      $items[$i]['retail']=$rows['retail'];
      $items[$i]['department']=$rows['department'];
      $items[$i]['vendor']=$rows['vendor'];
      $items[$i]['details']=$rows['details'];
}
mysqli_close($db); //close the connection
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
  <title><?=stripslashes($row['partner1F'])?> & <?=stripslashes($row['partner2F'])?> Change Registry Profile (a)</title>
  <script type="text/javascript" src="../webtools/date/datetimepicker_css.js"></script>

  <STYLE TYPE="text/css">
     <!--
     A:visited { color: #660066; text-decoration: none; background: transparent;}
     A:link { color: #330066; text-decoration: none; background: transparent;}
     A:active { color: White; text-decoration: none; background: transparent;}
     A:hover { color: orange; text-decoration: none; background: transparent;}
     -->
</STYLE>
<?php include '../popstyle.php'; ?>
</head>
<body>
<div align="center"><img src="../images/tagline.jpg" style="border: 0px solid" alt="Homeport Online">
</div>
<br />
<table align="center" width="400">
<tr><td><div align="center" style=" font-family: Arial; font-size: 20px">Change Registry Profile</div></td></tr>
<tr><td align="center"><?=stripslashes($row['partner1F'])?> & <?=stripslashes($row['partner2F'])?></td></tr>
</table>
<br />
<form action="dashSaveuChangeProfile.php" method="post">
<table align="center">
    <tr><td align="left">Partner 1:</td><td>First*</td><td><input name="rN[0]" type="text" value="<?=stripslashes($row['partner1F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[1]" type="text" value="<?=stripslashes($row['partner1L'])?>" /></td>
    </tr>
    <tr><td align="left">Partner 2:</td><td>First*</td><td><input name="rN[2]" type="text" value="<?=stripslashes($row['partner2F'])?>" /></td>
   		<td>Last*</td><td><input name="rN[3]" type="text" value="<?=stripslashes($row['partner2L'])?>" /></td>
    </tr>
</table>
<table align="center">
	 <tr><td colspan="5"><hr /></td></tr>
	 <tr>
         <td><div style="color:#<?=$alertColor?>">Event Date*</div></td><td><div style="color:#<?=$alertColor?>">Main Phone*</div></td>
         <td>Alternate Phone</td><td><div style="color:#<?=$alertColor?>">Main Email*</div></td><td>Alternate Email</td>
     </tr>
     <tr>
		<td><input name="rN[4]" placeholder="yyyy-mm-dd" type="date" value="<?=stripslashes($row['eventdate'])?>" size="10" id="demo1" /></td><td><input name="rN[5]" type="text" value="<?=stripslashes($row['phone01'])?>" /></td>
        <td><input name="rN[6]" type="text" value="<?=stripslashes($row['phone02'])?>" /></td><td><input name="rN[7]" type="text" value="<?=stripslashes($row['email01'])?>" /></td>
        <td><input name="rN[8]" type="text" value="<?=stripslashes($row['email02'])?>" /></td>
    </tr>
    <tr><td colspan="5"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td colspan="2">Address Pre-Event</td><td colspan="2">Address Post-Event <small>(if different)</small></td>
    </tr>
	<tr>
    	<td rowspan="2">Street Address</td>
        <td align="center"><input size="37" name="rN[9]" type="text" value="<?=stripslashes($row['addr01'])?>" /></td>
        <td rowspan="2">Street Address</td>
        <td align="center"><input size="37" name="rN[17]" type="text" value="<?=stripslashes($row['postaddr01'])?>" /></td>
    </tr>
	<tr>
    	<td align="center"><input size="37" name="rN[10]" type="text" value="<?=stripslashes($row['addr02'])?>" /></td>
        <td align="center"><input size="37" name="rN[18]" type="text" value="<?=stripslashes($row['postaddr02'])?>" /></td>
    </tr>
	<tr>
    	<td>City, State, Zip</td>
        <td align="center"><input size="37" name="rN[11]" type="text" value="<?=stripslashes($row['addr03'])?>" /></td>
        <td>City, State, Zip</td><td align="center"><input size="37" name="rN[19]" type="text" value="<?=stripslashes($row['postaddr03'])?>" /></td>
    </tr>
        <tr><td colspan="4"><hr /></td></tr>
</table>
<table align="center">
	<tr>
    	<td>Contact Name:</td><td><input size="37" name="rN[12]" type="text" value="<?=stripslashes($row['contact'])?>" /></td>
        <td>Relation To You:</td><td><input size="37" name="rN[13]" type="text" value="<?=stripslashes($row['relation'])?>" /></td>
    </tr>
	<tr>
    	<td>Contact Phone:</td><td><input size="37" name="rN[14]" type="text" value="<?=stripslashes($row['cphone01'])?>" /></td>
        <td>Alternate Phone</td><td><input size="37" name="rN[15]" type="text" value="<?=stripslashes($row['cphone02'])?>" /></td>
    </tr>
	<tr>
    	<td colspan="2" align="right">Contact Email:</td>
        <td align="left" colspan="2"><input size="37" name="rN[16]" type="text" value="<?=stripslashes($row['cemail'])?>" /></td>
    </tr>
    <tr><td colspan="4"><hr /></td></tr>
</table>
<table width="700" align="center">
<?php if($regitems>0){ ?>
  <tr>
      <td>Picture</td><td>Description</td><td>Price</td><td align="center">Wanted</td><td align="center">Received</td>
  </tr>
    <?php for($i=0; $i<$regitems; $i++){ ?>
        <tr>
            <td>
                <a class="thumbnail" href="#thumb"><img border="0" height="25" src="<?=resolve($items[$i]['pic'])?>">
                    <span><img src="<?=resolve($items[$i]['pic'])?>" /><b><?=$items[$i]['description']?></b></span>
                </a>
            </td>
            <td><?=stripslashes($items[$i]['description'])?></td>
            <td><?=stripslashes($items[$i]['price'])?></td>
            <td align="center"><?=stripslashes($items[$i]['qty'])?></td>
            <td align="center"><?=stripslashes($items[$i]['sold'])?></td>
        </tr>
        <tr><td height="1" bgcolor="#BBBBBB" colspan="6"></td></tr>
    <?php }
}else { ?>
    <tr>
        <td><input type="checkbox" name="delete" />
            If you Check Here and Save the changes The Registry Will Be Unrecoverable
            <hr />
        </td>
    </tr>
    <?php } ?>
</table>
<table align="center">
    <tr>
        <td align="center">
            <input type="submit" name="" value="Save Changes" />
        </td>
        <td align="center">
            <input value="Return To Registry Manager" onclick="parent.location='dashProfileEdit.php'" type="button">
        </td>
    </tr>
</table>
<input type="hidden" name="regnum" value="<?=$regnum?>" />
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