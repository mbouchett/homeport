<?php
date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_SESSION['loggedIn'])){
    $r=$_SESSION['r'];
    $rootLoc=$_SESSION['rootLoc'];
  }
  if(!isset($_SESSION['loggedIn'])){
  	$_SESSION['loggedIn']="yes";
  	$_SESSION['rootLoc']=$rootLoc;
  }

//Establish Variables
$message=$_REQUEST['message'];
$date = date('F jS Y');
$today=date('m/d/Y');
$alertColor="000000";
if($message) $alertColor="ff0000";

/* nb. Here are the field correlations
r[0]=partner1F			r[10]=addr02			r[20]=username
r[1]=partner1L			r[11]=addr03			r[21]=password
r[2]=partner2F			r[12]=contact
r[3]=partner2L			r[13]=relation
r[4]=eventdate			r[14]=cphone01
r[5]=phone01			r[15]=cphone02
r[6]=phone02			r[16]=cemail
r[7]=email01			r[17]=postaddr01
r[8]=email02			r[18]=postaddr02
r[9]=addr01				r[19]=postaddr03
*/
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="SHORTCUT ICON" href="../registry/images/bg.ico">
  <title>Create A Registry</title>
  <script type="text/javascript" src="date/datetimepicker_css.js"></script>
  <link href="css/registry.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
	  td{
	    font-size: 12px;
	    font-family: Arial;
	  }
  </style>
</head>
<body>
<div id="banner" >
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <img class="cartpic" src="images/gift_box.png" />
</div>
<br />
<?php if($message){ ?>
<div align="center" style="font-size: 18px; color: #FF0000" ><?= $message ?>.'</div>
<?php }?>

<div align="center" style=" font-family:Arial, Helvetica, sans-serif; font-size: 22px ">Homeport Gift Registry Application</div>
<form name="sendregapp" action="processCreateReg.php" method="post">
<table align="center" width="800"><tr><td><div style="font-size: 18px ">Let's Get Started!</div></td></tr></table>
<table class="regapp" align="center" border="0" width="600">
	<tr>
        <td>Your Name:</td>
        <td><span style="color:#<?=$alertColor?>">First*</span></td><td><input size="30" name="r[0]" type="text" value="<?=$r[0]?>" /></td>
        <td><span style="color:#<?=$alertColor?>">Last*</span></td><td><input size="30" name="r[1]" type="text" value="<?=$r[1]?>" /></td>
    </tr>
    <tr>
        <td rowspan="2">Partner's Name:<br /></td>
        <td><div style="color:#<?=$alertColor?>">First</div></td><td><input size="30" name="r[2]" type="text" value="<?=$r[2]?>" /></td>
        <td><div style="color:#<?=$alertColor?>">Last</div></td><td><input size="30" name="r[3]" type="text" value="<?=$r[3]?>" /></td>
    </tr>
    <tr><td align="left" colspan="3"><span style="font-size: 9px"><img alt="arrow" src="images/arrow_upleft.png" height="12" />  Leave Partner&acute;s Name fields blank for a personal gift registry</span></td></tr>
    <tr>
    	<td><div style="color:#<?=$alertColor?>">Event Date*</div></td><td colspan="2"><input onclick="javascript:NewCssCal('demo1')" title="Use Calender To The Right To Set The Date" readonly="readonly" name="r[4]" type="text" value="<?=$r[4]?>" size="10" id="demo1" /><a title="Click here to set date" href="javascript:NewCssCal('demo1')"><img border="0" src="../webtools/date/images/cal.gif" width="16" height="16" alt="Pick a date"></a></td>
        <td  rowspan="3" colspan="2"><div style="font-size: 14px ">
We are aware that this can be a very busy time for you so if there is someone you would prefer us to contact should details arise please enter that information here.
</div></td>
    </tr>
    <tr>
        <td><div style="color:#<?=$alertColor?>">Main Phone*</div></td><td colspan="2"><input name="r[5]" type="text" value="<?=$r[5]?>" /></td>
    </tr>
    <tr>
        <td>Alternate Phone</td><td colspan="2"><input name="r[6]" type="text" value="<?=$r[6]?>" /></td>

    </tr>
    <tr>
        <td><div style="color:#<?=$alertColor?>">Main Email*</div></td><td colspan="2"><input name="r[7]" type="text" value="<?=$r[7]?>" /></td>
        <td>Contact Name:</td><td colspan="2"><input size="30" name="r[12]" type="text" value="<?=$r[12]?>" /></td>
    </tr>
    <tr>
        <td>Alternate Email</td><td colspan="2"><input name="r[8]" type="text" value="<?=$r[8]?>" /></td>
        <td>Relation To You:</td><td colspan="2"><input size="30" name="r[13]" type="text" value="<?=$r[13]?>" /></td>
    </tr>

    <tr>
    	<td colspan="3">Address Pre-Event</td>
        <td>Contact Phone:</td><td colspan="2"><input size="30" name="r[14]" type="text" value="<?=$r[14]?>" /></td>
    </tr>
	<tr>
    	<td rowspan="2">Street Address</td><td align="center" colspan="2"><input size="37" name="r[9]" type="text" value="<?=$r[9]?>" /></td>
        <td>Alternate Phone</td><td colspan="2"><input size="30" name="r[15]" type="text" value="<?=$r[15]?>" /></td>
    </tr>
	<tr>
    	<td align="center" colspan="2"><input size="37" name="r[10]" type="text" value="<?=$r[10]?>" /></td>
        <td>Contact Email:</td><td colspan="2"><input size="30" name="r[16]" type="text" value="<?=$r[16]?>" /></td>
    </tr>
	<tr>
    	<td>City, State, Zip</td><td align="center" colspan="2"><input size="37" name="r[11]" type="text" value="<?=$r[11]?>" /></td>
    </tr>
    <tr>
        <td colspan="3">Address Post-Event <br /><small>(if different)</small></td>
    </tr>
    <tr>
        <td rowspan="2">Street Address</td><td align="center" colspan="2"><input size="37" name="r[17]" type="text" value="<?=$r[17]?>" /></td>
    </tr>
    <tr>
        <td align="center" colspan="2"><input size="37" name="r[18]" type="text" value="<?=$r[18]?>" /></td>
    </tr>
    <tr>
        <td>City, State, Zip</td><td align="center" colspan="2"><input size="37" name="r[19]" type="text" value="<?=$r[19]?>" /></td>
    </tr>
</table>


<table align="center" width="800"><tr><td><div style="font-size: 18px ">Create a Username and Password </div></td></tr></table>
<table class="regapp" align="center" border="0" width="400">
	<tr>
    	<td><div style="color:#<?=$alertColor?>">User Name:*</div></td><td><input name="r[20]" size="30" type="text" /></td>
    </tr>
    <tr>
        <td><div style="color:#<?=$alertColor?>">Password:*</div></td><td><input name="r[21]" size="30" type="password" /></td>
	</tr>
</table>
<table align="center" width="700"><tr></tr></table>
<table class="regapp" align="center" border="0" width="800">
	<tr>

    </tr>
	<tr>

    </tr>
	<tr>
    	<td align="center" colspan="2"><a class="button5" onClick="document.sendregapp.submit()">Confirm & Send</a><br /><a class="button" onclick="window.close()">Cancel and Return</a><br /><br /></td>
    </tr>
</table>
</form>

</body>

</html>