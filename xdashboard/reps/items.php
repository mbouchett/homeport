<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";
include "../../functions/f_resolve.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['useremail'])){
    header('Location: index.php');
    die;
  }

$useremail=$_SESSION['useremail'];
unset($message);
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];
$sortBy = $_REQUEST['sort'];
if(!$sortBy || $sortBy == "des"){
	$sortBy = "des";
	$descS = "**";
	$skuS = "";
}else {
	$descS = "";
	$skuS = "**";
} 

unset($focus);


$vendor=$_REQUEST['ven'];
//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `number` LIKE"%'.$vendor.'%"' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
$vendors=mysqli_fetch_assoc($result);       //Fetch The Current Record

//Open Item Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	 if($sortBy == "des") $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `description`' ; //Create The Search Query
	 if($sortBy == "sku") $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `sku`' ; 			//Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $items[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$itemcount=count($items);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title><?= $vendors['name'] ?></title>
<link href="css/style01.css" rel="stylesheet" type="text/css" />
</head>

<body onload="<?= $focus ?>">
<div id="wrapper">
<hr size="12" noshade="noshade"/>
<form action="processEditItems.php" method="post" >
<table align="center">
    <tr >
        <td class="dashcell"><input class="dashbut" value="vendor list" onclick="parent.location='vendors.php'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
    </tr>
</table>
<input type="hidden" name="recordcount" value="<?= trim($itemcount) ?>" />
<input type="hidden" name="vendor" value="<?= trim($vendor) ?>" />
<input type="hidden" name="multi" value="<?= $vendors['multi'] ?>" />
<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php  }?>
<table align="center">
    <tr >
        <td colspan="2"><h1><?= $vendors['name'] ?></h1></td>
    </tr>
    <tr class="vendor"><td><?= $vendors['addr1'] ?></td><td><?= $vendors['rep'] ?></td></tr>
    <tr class="vendor"><td><?= $vendors['addr2'] ?></td><td>Fax: <?= $vendors['fax'] ?></td></tr>
    <tr class="vendor"><td><?= $vendors['addr3'] ?></td><td>Voice: <?= $vendors['voice'] ?></td></tr>
    <tr class="vendor"><td ><?= $vendors['email'] ?></td><td></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td colspan="2" style="font-family: Arial; font-size: 10px; color: #CC0000">
<?php if($wantcount>0 && !$message){ ?>
        Wantlists To Be Ordered: <br />
<?php for($i=0; $i< $wantcount; $i++){ ?>
          <a target="_blank" href="../wantlist/customer.php?cust=<?= $wants[$i]['customer'] ?>"><?= $wants[$i]['description'] ?></a><br />
<?php }
} ?>
        </td>
    </tr>
</table>
<table class="maintable">
    <tr><td>Pic</td><td><a href="items.php?sort=sku&ven=<?= $vendor ?>">Sku <?= $skuS ?></a></td><td><a href="items.php?sort=des&ven=<?= $vendor ?>">Description <?= $descS ?></a></td><td>Pack Quantity</td><td>Old Price</td><td>Revised Price</td></tr>
    <?php for($i=0; $i<$itemcount; $i++){ ?>
    <tr >
        <td width="55" onclick="pop(<?= $items[$i]['recno'] ?>)">
            <?php if($items[$i]['pic']) { ?>
            <a class="thumbnail" href="http://www.homeportonline.com?recno=<?= $items[$i]['recno'] ?>" target="_blank">
            <img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($items[$i]['pic']) ?>" />
            <span><img src="<?= resolve($items[$i]['pic']) ?>"/></span>
            </a>
            <?php }else{ ?>
                <a onclick="pop(<?= $items[$i]['recno'] ?>)" ><img border="0" src="design/add-button.jpg" /></a>
            <?php } ?>
        </td>
        <td width="100"><?= strtoupper($items[$i]['sku']) ?></td>
        <td><?= ucwords(strtolower(stripslashes($items[$i]['description']))) ?></td>
        <?php $display = "disabled = \"disabled\"";
              if (is_numeric($items[$i]['pack'])) $display = "";
        ?>
        <td width="60" title="Enter DNR(for do not reorder) or DISC(for discontinued)"><input size="2" name="pack[<?= $i ?>]" value="<?= $items[$i]['pack'] ?>" <?= $display ?> /></td>
        <td width="80"><?= number_format($items[$i]['cost'],2) ?></td>
        <td width="80"><input style=" text-align: right" size="7" name="cost[<?= $i ?>]" value="" /></td>
        <input type="hidden" name="recno[<?= $i ?>]" value="<?= $items[$i]['recno'] ?>" />
    </tr>
    <?php } ?>
</table>
<br />
<table align="center">
    <tr >
        <td class="dashcell"><input class="dashbut" value="vendor list" onclick="parent.location='vendors.php'" type="button"></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
    </tr>
</table>
</form>
</div>
</body>
</html>