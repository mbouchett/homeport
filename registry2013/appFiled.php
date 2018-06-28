<?php
date_default_timezone_set('America/New_York');
session_start(); // start up your PHP session!
  if(isset($_SESSION['loggedIn'])){
    $r=$_SESSION['r'];
    $rootLoc=$_SESSION['rootLoc'];
  }
  if(!isset($_SESSION['loggedIn'])){
  	$rootLoc='../registry/';
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
  <title>Application Accepted</title>
<script type="text/javascript">
// Popup window code
  function newPopup(url) {
    popupWindow = window.open(
    url,'popUpWindow','height=450,width=450,left=150,top=150,resizable=yes,scrollbars=no,menubar=no,directories=no,status=yes')
  }
</script>
<link href="css/registry.css" rel="stylesheet" type="text/css" />


</head>
<body>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a>
  <div id="menu">
      <ul>
        <li><a href="../index.php" class="menubutton">HOME</a></li>
        <li><a href="index.php" class="menubutton">REGISTRY</a></li>
        <li><a href="../departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
  </div>
</div>
<br />
<h2>Application Accepted, Thank You</h2>
<br />
<div class="thankyoubox">
       <b><?=$r[0]?><?php if($r[2]) echo " & ".$r[2]; ?>,</b>
       <br /><br />
        Thanks so much for registering with us at Homeport. We recognize that you have quite a bit to
        do between now and your big event. With that in mind we are committed to making the registry process as easy for you and your
        guests as possible.
</div>
<br /><br />
<div class="infocontainer">
  <div class="infoleft"><h3>Adding Items</h3><br />
       To add items to your registery browse through our homepage and click on an item to see its details. Below the Add To Cart
       button you will see an <a class="samplebutton">Add to Registry &#9829;</a> Button. Click on the button to add the selected item to your registry.
       Don&#39;t worry, If you are not logged on you will be prompted to do so.
  </div>
  <div class="infocenter"><h3>Items Not On The Web</h3><br />
       Because we have such a wide selection of fun stuff at Homeport and only a percentage is represented on our web site, you will want to
       come by the store so that you can add a full range of items for your guests to choose from. It's real easy to do.
       Now that you have created your registry all you need to do is give us a call (802) 863-4832 to set up an appointment.
  </div>
  <div class="inforight"><h3>Contacting Us</h3><br />
       If you'd like to make an appointment to visit the store to add item to your registry or if experience any difficulty with the process
       don't hesitate to contact us at <input class="button3" value="home@homeportonline.com" onclick="parent.location='mailto:home@homeportonline.com'" type="button">
      <br /><br /> or by phone (802) 863-4832</div>

</div>
<div align="center"><a class="button3" href="../index.php?ref=browsethis">Return To Homeport</a></div>
</body>
</html>