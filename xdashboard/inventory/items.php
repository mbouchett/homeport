<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";
include "../../functions/f_resolve.php";
$imageLocation = "http://www.rockingbones.site/homeportonline/";

$go = $_REQUEST['go'];
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username']) && $go != 1){
    echo 'No Authorization'.$username;
    exit;
  }
if(!$_SESSION['username']) $_SESSION['username']="homeport";
if(!$_SESSION['useremail']) $_SESSION['username']="home@homeportonline.com";
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];
unset($message);
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];
unset($focus);

if(substr($message, 0, 10)=="Item Added") $focus="setFocus()";

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
    $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `department`, `description`' ; //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $items[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$itemcount=count($items);

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `departments` ORDER BY `depnum`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $cats[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$catcount=count($cats);

//Open wantlist Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `wantlist` WHERE `vendor` = "'.$vendors['recno'].'" ' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
$ii = 0;
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);     //Fetch The Current Record
        if(!$row['dateordered']){
            $wants[$ii] =  $row;
            $ii = $ii+1;
        }
    }                                         //Close The Loop
$wantcount=count($wants);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title><?= $vendors['name'] ?> - (<?= $itemcount ?>) (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body onload="<?= $focus ?>">
<div onclick=" pop_clear()" id="screen" class="blackout"></div>
<div id="wrapper">
<hr size="12" noshade="noshade"/>
<form action="processEditItems.php" method="post" >
<table align="center">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Prepare Count" onclick="parent.location='printCount.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Orders" onclick="parent.location='orders/enterCount.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Work'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Edit Vendor Info" onclick="parent.location='venEdit.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Log Out" onclick="parent.location='../loggedOut.php'" type="button" /></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Save Changes" type="submit" /></td>
    </tr>
</table>
<input type="hidden" name="recordcount" value="<?= trim($itemcount) ?>" />
<input type="hidden" name="vendor" value="<?= trim($vendor) ?>" />
<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF9900">
    <tr><td><div align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
</table>
<?php  }?>
<table width="800" align="center">
    <tr >
        <td colspan="2"><h1><?= $vendors['name'] ?></h1></td>
    </tr>
    <tr class="vendor"><td><?= $vendors['addr1'] ?></td><td><?= $vendors['rep'] ?></td></tr>
    <tr class="vendor"><td><?= $vendors['addr2'] ?></td><td>Fax: <?= $vendors['fax'] ?></td></tr>
    <tr class="vendor"><td><?= $vendors['addr3'] ?></td><td>Voice: <?= $vendors['voice'] ?></td></tr>
    <tr class="vendor"><td ><?= $vendors['email'] ?></td><td>Multiplier: <input style="border: none; background: #555555; color: #FFFF99" id="multi" name="multi" size="4" value="<?= $vendors['multi'] ?>" /></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr>
        <td>
            Ship Method 1: <?= $vendors['ship1'] ?>
        </td>
        <td rowspan="2">
            <?php if($vendors['hti'] == 1){ ?>
            <img src="design/hti.jpg" alt="HTI" height="50px" />
            <?php } ?>
        </td>
    </tr>
    <tr><td>Ship Method 2: <?= $vendors['ship2'] ?></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td colspan="2">
        Note: <?= $vendors['note'] ?>
    </td></tr>
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
<table>
    <tr><td style="font-family: Arial; font-size: 10px">Recno</td><td>Pic</td><td>Sku</td><td>Description</td><td>Cat</td><td>Pack</td><td>Cost</td><td>Retail</td><td>LOH</td><td>Last Order Info</td></tr>
    <?php for($i=0; $i<$itemcount; $i++){ ?>
    <tr>
        <td style="font-family: Arial; font-size: 10px"><?= $items[$i]['recno'] ?></td>
        <td onclick="pop(<?= $items[$i]['recno'] ?>)">
            <?php if($items[$i]['pic']) { ?>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($items[$i]['pic']) ?>" />
            <span><img src="<?= resolve($items[$i]['pic']) ?>"/></span>
            </a>
            <?php }else{ ?>
                <a onclick="pop(<?= $items[$i]['recno'] ?>)" ><img border="0" src="design/add-button.jpg" /></a>
            <?php } ?>
        </td>
        <td width="140" title="Deleting The Sku Will Delete The Item!"><input size="19" name="sku[<?= $i ?>]" value="<?= strtoupper($items[$i]['sku']) ?>" /></td>
        <td width="335"><input size="55" name="description[<?= $i ?>]" value="<?= ucwords(strtolower(stripslashes($items[$i]['description']))) ?>" /></td>
        <td width="40"><input size="2" name="department[<?= $i ?>]" value="<?= $items[$i]['department'] ?>" /></td>
        <td width="40"><input size="2" name="pack[<?= $i ?>]" value="<?= $items[$i]['pack'] ?>" /></td>
        <?php unset($ccolor); if($items[$i]['cost'] > $items[$i]['retail']) $ccolor = "; background-color: #FFCC99";?>
        <td width="60"><input alt="<?= $i ?>" onchange="retailCalc(this, event)" style=" text-align: right<?= $ccolor ?>" size="7" name="cost[<?= $i ?>]" value="<?= number_format((float)$items[$i]['cost'],2) ?>" /></td>
        <td width="60"><input alt="r<?= $i ?>" style=" text-align: right" size="7" name="retail[<?= $i ?>]" value="<?= number_format((float)$items[$i]['retail'],2) ?>" /></td>
        <td width="40"><input style=" text-align: right" size="2" name="loh[<?= $i ?>]" value="<?= $items[$i]['loh'] ?>" /></td>
        <td style="font-size: 12px" title="Previous: <?= $items[$i]['h2Dat'] ?> [<?= $items[$i]['h2Qty'] ?>] <?= $items[$i]['h2Po'] ?>">
        <?= $items[$i]['h1Dat'] ?> [<?= $items[$i]['h1Qty'] ?>] <a href="http://www.homeportonline.com/dashboard/inventory/orders/viewOrder.php?order=<?= substr($items[$i]['h1Po'],0,7) ?>"><?= $items[$i]['h1Po'] ?></a></td>
        <input type="hidden" name="recno[<?= $i ?>]" value="<?= $items[$i]['recno'] ?>" />
        <td title="<?= $items[$i]['details'] ?>" class="plus" onclick="pop2(<?= $items[$i]['recno'] ?>,'<?= addslashes($items[$i]['details']) ?>' )">+</td>
    </tr>
    <?php } ?>
</table>
</form>

<form action="processAddItems.php" method="post" >
<table>
    <tr><td>Sku</td><td>Description</td><td>Cat</td><td>Pack</td><td>Cost</td><td>Retail</td><td>Last Order Info</td></tr>
    <tr>
        <td width="140"><input onblur="checkSku()" id="theSku" size="19" name="isku" value="" /></td>
        <td width="375"><input size="58" name="description" value="" /></td>
        <td width="40"><input id="deptAdd" onfocus="catPop()" onblur="catUnPop()" size="2" name="department" value="" /></td>
        <td width="40"><input id="pack" size="2" name="pack" value="" /></td>
        <td width="60"><input id="cost" onblur="price()" style=" text-align: right" size="7" name="cost" value="" /></td>
        <td width="60"><input id="retail" style=" text-align: right" size="7" name="retail" value="" /></td>
        <td style="font-size: 14px; font-weight: bold; font-family: Arial" >&#60;-<input style="font-weight: bold" class="dashbut" value="Add New Item Here" type="submit" /></td>
    </tr>
</table>
<table>
    <tr >
        <td class="dashcell"><input class="dashbut" value="Prepare Count" onclick="parent.location='printCount.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Orders" onclick="parent.location='orders/enterCount.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Change Vendor" onclick="parent.location='vendorSelect.php?direction=Work'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Edit Vendor Info" onclick="parent.location='venEdit.php?ven=<?= $vendor ?>'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='inventory.php'" type="button"></td>
        <td class="dashcell"><input class="dashbut" value="Log Out" onclick="parent.location='../loggedOut.php'" type="button" /></td>
        <td class="dashcell"><input style="font-weight: bold" class="dashbut" value="Add Item" type="submit" /></td>
    </tr>
</table>
<input type="hidden" name="vendor" value="<?= trim($vendor) ?>" />
</form>
<hr size="12" noshade="noshade"/>
<?php if($wantcount>0 && !$message){
        $wlm = "There Are ".$wantcount." Unordered Wantlists Associated With This Vendor\\n\\n";
        for($i=0; $i< $wantcount; $i++){
          $wlm .= $wants[$i]['description'].'\\n';
        }
        echo '<script type="text/javascript"> alert("'.$wlm.'"); </script>';
} ?>
    <div id="pop" class="popup" >     <!--Upload Image Here-->
      <form enctype="multipart/form-data" action="<?= $imageLocation ?>saveImage.php" method="post">
      Submit Empty To Delete Image
          <table>
            <tr>
              <td>
                  <span id="recspan"></span>
                  <input id="record" type="hidden" name="recno" value="" />
                  <input type="hidden" name="vendor" value="<?= trim($vendor)?>" />
              </td>
            </tr>
<!--            <tr>
              <td>Image To Uplaod</td><td><input name="filename" type="file" size="50" /></td>
            </tr>-->
            <tr>
              <td>Url To Grab</td><td><input name="url" size="50" /></td>
            </tr>
            <tr>
              <td>Picture To Load</td><td><input type="file" name="pic" size="50" /></td>
            </tr>
            <tr><td align="center" colspan="2"><input type="submit" name="submit" value="Submit" /></td> </tr>
          </table>
      </form>
    </div>

<div id="pop2" class="popup" >  <!--Enter Item Details Here-->
  <form enctype="multipart/form-data" action="processDetailsUpload.php" method="post">
      <table>
        <tr>
          <td>
              <span id="recspan2"></span>
              <input id="record2" type="hidden" name="recno" value="" />
              <input type="hidden" name="vendor" value="<?= trim($vendor)?>" />
          </td>
        </tr>
        <tr>
          <td>Details</td><td><textarea id="theDet" name="details" rows="4" cols="50"></textarea></td>
        </tr>
        <tr><td align="center" colspan="2"><input type="submit" name="submit" value="Submit" /></td></tr>
      </table>
  </form>
</div>

<?php if($itemcount == 0) { // There are no items for this vendor?>
    <form id="delVen" action="" method="post">
         <div class="delete" onclick="deleteVendor()"><input class="delete" name="" type="button" value="Delete Vendor" /></div>
         <input type="hidden" name="vendor" value="<?=  trim($vendors['recno']) ?>" />
    </form>
<?php } ?>

<div id="departments">
<table>
<tr><td>Number</td><td>Department Name</td></tr>
<?php for($i=0; $i<$catcount; $i++){ ?>
    <tr  onclick="putCat('<?= $cats[$i]['depnum'] ?>')">
        <td>
            <?= $cats[$i]['depnum'] ?>
        </td>
        <td>
            <?= $cats[$i]['department'] ?>
        </td>
    </tr>
<?php } ?>
</table>
</div>
</div>
<script defer="defer" type="text/javascript" src="inventoryItems.js"></script>
</body>
</html>