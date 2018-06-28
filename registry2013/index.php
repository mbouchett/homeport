<?php
//items.php 2018/05
// Gift Registry Homepage
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
setcookie("regnum", "",time()-3600,"/");
setcookie("partner1F", "",time()-3600,"/");
setcookie("partner2F", "",time()-3600,"/");

$visitID=$_COOKIE['visitID'];
$searchKey=$_POST['searchKey'];
$words = explode(" ",$searchKey,3);
$i = count($words);

header('Cache-Control: max-age=900');
unset($message);

if($i>1) $searchKey = $words[$i-1];
if(!$searchKey) $searchKey = "You'renevergonnafindthis";

//load Couples
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` ORDER BY `reg_event_date` DESC ' ;
if($searchKey) $sql = 'SELECT * FROM `registry` WHERE `reg_partner1L` LIKE"%'.$searchKey.'%" OR `reg_partner2L` LIKE"%'.$searchKey.'%" OR `reg_partner1F` LIKE"%'.$searchKey.'%" OR `reg_partner2F` LIKE"%'.$searchKey.'%" ORDER BY `reg_event_date` DESC ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

// Resume up your PHP session!
session_start(); // Resume up your PHP session!
session_destroy();
setcookie("regnum", $r[0],time()-4200,"/");
setcookie("partner1F", $r[1],time()-4200,"/");
setcookie("partner2F", $r[2],time()-4200,"/");

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/registry.css" type="text/css" />
  <title>HomePort Gift Registry</title>
  <script type="text/javascript">
  var newwindow;
  function poptastic(url)
  {
  newwindow=window.open(url,'name','location=0,height=300,width=600');
  newwindow.moveTo(450,325)
  if (window.focus) {newwindow.focus()}
  }
  </script>
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

<div class="userbox">
  <div class="managebox">
    <h2>Manage Your Registry</h2>
    <br />


    <form name="regdash" action="regDash.php" method="post">
      <h3>Username:</h3><input name="username" type="text" />
      <h3>Password:</h3><input name="password" type="password" />
      <br />
      <a class="button3" onClick="document.regdash.submit()">Login</a>
      <br /><br />
      <a class="nodeco" href="javascript:poptastic('lostPassword.php')"><h5>Forgot Login?</h5></a>
      <br />
    </form>
  </div>
  <div class="creatbox">
    <h2>Don't have a Homeport gift registry yet?</h2>
    <a class="button4" href="createReg.php">Click here to <br />Create One</a>
    <br />
    <h3>and start adding items right away!</h3>
  </div>
</div>

<br />

<!-- Login error messages -->
<?php if($message){?>
<table align="center" border="0" >
    <tr><td><span style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></span></td></tr>
</table>
<?php if($message!="Logged Out") { ?>
<table align="center" width="300">
	<tr>
    	<td><a class="nodeco" href="javascript:poptastic('lostPassword.php')">Forgot Login?</a></td>
    </tr>
</table>

 <?php } }?>
<!-- End Login error messages -->

<br /><br />
<h2>Find Someone Who Has Registered</h2>
<table class="regapp" align="center" width="600" border="0">
  <tr>
    <td>
        <form name="searchreg" action="index.php" method="post">
        Enter Name to Search For <input id="searchKey" name="searchKey" /> <a class="button3" onClick="document.searchreg.submit()">Search</a>
        </form>
    </td>
    <td>
        <span style="font-size: 18px; font-family: Arial">Big Day</span>
    </td>
  </tr>
  <tr><td height="20" colspan="2"></td></tr>
  <?php for($i=0; $i<$num_results; $i++){
      $row=mysqli_fetch_assoc($result);
      $day=substr(stripslashes($row['reg_event_date']),-2);
      $month=substr(stripslashes($row['reg_event_date']),5,2);
      $year=substr(stripslashes($row['reg_event_date']),0,4);
      if($year !="0000") {
  ?>
  <tr><td><a class="decolink" href="shopReg.php?regnum=<?=stripslashes($row['reg_ID'])?>"><?=stripslashes($row['reg_partner1F'])?> <?=stripslashes($row['reg_partner1L'])?>
  <?php if($row['reg_partner2L']){ ?>
  &amp; <?=stripslashes($row['reg_partner2F'])?> <?=stripslashes($row['reg_partner2L'])?>
   <?php } ?>
  </a></td>
  <td><?=$month?>/<?=$day?>/<?=$year?></td></tr>
<?php
    }
} ?>
</table>
 <br />
<script type="text/javascript">
    document.getElementById("searchKey").focus();
</script>

<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8450012-2");
pageTracker._trackPageview();
} catch(err) {}
</script>
<script type="text/javascript" defer="defer" src="https://mylivechat.com/chatinline.aspx?hccid=10055331"></script>
</body>
</html>
