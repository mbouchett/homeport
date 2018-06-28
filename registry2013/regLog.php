<?php
//regLog.php 2018/05
// Log Into a Gift Registry
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');
// collect variables
$recno = $_REQUEST['recno'];

if(!$recno) $recno = 0;
$regnum = $_COOKIE["regnum"];
$partner1F = $_COOKIE["partner1F"];
$partner2F = $_COOKIE["partner2F"];
$unlog = $_REQUEST['unlog'];

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

if($unlog){
    session_unset();
    setcookie("regnum", "",time()-4200,"/");
    setcookie("partner1F", "",time()-4200,"/");
    setcookie("partner2F", "",time()-4200,"/");
    header('Location: ../index.php?ref=browsethis');
    }

if($partner1F && $recno){
  // get the item data
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  $sql = 'SELECT * FROM `items` WHERE `item_ID` = '.$recno ;
  $result = mysqli_query($db, $sql);
  mysqli_close($db);
  $item=mysqli_fetch_assoc($result);

  $a1 = $item['item_ID'];
  $a2 = str_replace('"', '', $item['item_desc']);
  $a2 = str_replace("'", "", $a2);
  $a3 = $item['item_retail'];

  //Open The Database
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  //create insert string
  $sql = "INSERT `".$db_db."`.`reg_items` (`ri_desc`, `ri_price`, `ri_qty`, `reg_ID`, `item_ID`)
  		 VALUES ('$a2', '$a3', '1', '$regnum', '$a1')";
  //perform action

  $result = mysqli_query($db, $sql); // create the query object
  //close the connection
  mysqli_close($db);
}
if($partner1F){
  // load couples registry
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  $sql = 'SELECT * FROM `reg_items` WHERE `reg_ID` = \''.trim($regnum).'\' ' ;
  $result = mysqli_query($db, $sql); // create the query object
  $num_results=mysqli_num_rows($result); //How many records meet select
  mysqli_close($db); //close the connection
  for($i=0; $i<$num_results; $i++){
    $list[$i] = mysqli_fetch_assoc($result);
  }
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  for($i=0; $i<$num_results; $i++){
    $sql = 'SELECT * FROM `items` WHERE `item_ID` = '.$list[$i]['item_ID'];      //Create The Search Query
    $result = mysqli_query($db, $sql);                                      //Initiate The Query
    //Store the Results To A Local Array
    $item=mysqli_fetch_assoc($result);                              //Fetch The Current Record
    $list[$i]['item_pic'] = $item['item_pic'];
  }
  mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>

<?php if($partner1F){ ?> <!-- customer is logged in -->
<head>
  <link href="css/registry.css" rel="stylesheet" type="text/css" />
  <title>Add To <?= $partner1F ?> & <?= $partner2F ?>'s Registry</title>
  <?php include '../popstyle.php'; ?>
</head>
<body>

<div id="banner" >
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <img class="cartpic" src="images/gift_box.png" />
</div>
<br />

<h5><?= $partner1F ?> & <?= $partner2F ?>'s Registry</h5><a href="../registry2013/regDash.php">Manage Account</a>
<a href="regLog.php?recno=<?=$recno?>&unlog=yes"><h6>Not you? click here</h6></a>
<form name="cart" action="saveuModifyReg.php" method="post">
  <table width="700" align="center">
    <tr class="bigwhite" bgcolor="#4a4a4a">
        <td>Picture</td><td>Description</td><td>Price</td><td align="center">Wanted</td><td align="center">Received</td>
    </tr>

  <?php for($i=0; $i<$num_results; $i++){ ?>
        <tr class="bigblack">
            <td>
                <a class="thumbnail" href="#thumb">
                <img border="0" height="25" src="<?=resolve($list[$i]['item_pic'])?>">
                <span><img src="<?=resolve($list[$i]['item_pic'])?>" /><b><?=$list[$i]['ri_desc']?></b></span></a>
            </td>
            <td><?=$list[$i]['ri_desc']?></td>
            <td><?=$list[$i]['ri_price']?></td>
            <td class="itemquan" title="0 Here Will Delete The Item From Your Registry" align="center">
                <?php if($list[$i]['ri_sold'] < $list[$i]['ri_qty']) { ?>
                <input align="center" size="2" name="adjQty[<?=$i?>]" value="<?=$list[$i]['ri_qty']?>" />
                <?php }else{ ?>
                <?=$list[$i]['ri_qty']?>
                <?php } ?>
                <input type="hidden" name="recno[<?= $i ?>]" value="<?=$list[$i]['ri_ID']?>" />
            </td>
            <td align="center"><?=$list[$i]['ri_sold']?></td>
        </tr>
        <tr><td height="1" bgcolor="#4a4a4a" colspan="6"></td></tr>
  <?php } ?>
  </table>
<a class="button" onclick="window.close()">Shop Some More!</a>
<a class="button" onClick="document.cart.submit()"><img height="14" alt="Refresh" src="../images/refresh.png" /> Update Registry</a>
<div style="display: none"><input type="submit" name="" value="" /></div>
</form>
</body>
<?php }else{ ?>         <!-- customer is NOT logged in -->
<head>
  <link href="css/registry.css" rel="stylesheet" type="text/css" />
  <title>Registry Login</title>
  <?php include '../popstyle.php'; ?>

</head>

<body>

<div id="banner" >
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <img class="cartpic" src="images/gift_box.png" />
</div>
<br />
<div><h2>Homeport Gift Registry Login</h2></div>
<br />
<?php if($message){?>
    <div class="errormessage">*<?=$message?>*</div>
<?php }?>

<form name="logverify" action="processRegLog.php" method="post">
<table align="center" border="0" width="300">
	<tr>
    	<td class="logpass" align="center">Username: <input name="username" type="text" /></td>
    </tr>
	<tr>
    	<td class="logpass" align="center">Password: <input name="password" type="password" /></td>
    </tr>
	<tr>
    	<td align="center"><a class="button3" onClick="document.logverify.submit()">Login</a></td>
    </tr>
</table>
<?php if($message == "Incorrect Login"){ ?>
<table align="center" width="300">
	<tr>
    	<td align="left"><div style="color:#0033FF; font-size: 12px; cursor: pointer;"><a onclick="window.open('lostPassword.php','Password', 'height=200,width=300,top=200,left=200,menubars=0');">forgot user name or password</a></div></td>
    </tr>
</table>
<?php } ?>
<br />
<center>
Don't have a Homeport gift registry yet?<br />
<a href="createReg.php">Click here to create one and get started</a><br />
adding items right away
</center>
<br />
<div align="center"><a class="button" onclick="window.close()">Go back to shopping</a></div>
<input type="hidden" name="recno" value="<?= $recno ?>" />
<input type="hidden" name="popLog" value="yes" />
</form>
<br />
<?php unset($message); ?>
 </body>
<?php } ?>
</html>