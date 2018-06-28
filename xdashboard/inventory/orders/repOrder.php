<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

//Load our email address
$fp = fopen('../../../email.txt', "r");  //Open The File For Reading
  $data = fgets($fp);                    //Load The Value
fclose($fp);
$homeportEmail = substr($data,12,19).".com";

function compare_sku($a, $b) {
  return strnatcmp($a['sku'], $b['sku']);
}

$po=$_REQUEST['order'];
$sortby=$_REQUEST['sortby'];

//Get PO
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "SELECT * FROM `orders` WHERE `orderNum` = '".$po."'";   //Create The Search Query
    $result = mysqli_query($db, $sql);
    mysqli_close($db);                                              //Close The Connection
    $order = mysqli_fetch_assoc($result);                           //Fetch The Current Record
$poNum = $order['orderNum'].$order['orderedBy'];
if($order['offCycle'] == 1) $poNum .= "X";

//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `recno` = "'.$order[vendor].'"';          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    mysqli_close($db);                          //Close The Connection
    //Store the Results To A Local Array
    $vendors=mysqli_fetch_assoc($result);       //Fetch The Current Record

// Get Order Items
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `order_items` WHERE `order` = "'.$po.'"';          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $itemCount=mysqli_num_rows($result);        //Count The Query Matches
    mysqli_close($db);
    for($i=0; $i<$itemCount; $i++){             //Iniate The Loop
      $row=mysqli_fetch_assoc($result);         //Fetch The Current Record
      $items[$i]=$row;                          //Save The Record To The Array
    }
// add item information
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i=0; $i<$itemCount; $i++){             //Iniate The Loop
        $sql = 'SELECT `sku`, `description`, `cost`, `department`  FROM `items` WHERE `recno` = "'.$items[$i]['item'].'"' ;//Create The Search Query
        $result = mysqli_query($db, $sql);          //Initiate The Query
        $row=mysqli_fetch_assoc($result);           //Fetch The Current Record
        $items[$i]['cost'] = $row['cost'];
        $items[$i]['description'] = stripslashes($row['description']);
        $items[$i]['sku'] = $row['sku'];
        $items[$i]['department'] = $row['department'];
    }


if($sortby=="SKU"){
    usort($items, 'compare_sku');
}

$pages=ceil($itemCount/25);
$page=1;
$line=0;
$totalorder=0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252" />
  <link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title>View <?= $vendors['name'] ?> Order (a)</title>
  <link href="../design/vieworder.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../design/printorder.css" rel="stylesheet" type="text/css" media="print" />
</head>
<body >
<div id="wrapper" >
<table class="count">
    <tr><td >Purchase Order# <?= $poNum ?><br />Order Date:<?= $order['dateOrd'] ?></td><td align="right">Page <?= $page ?> of  <?= $pages ?></td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <tr><td>From:</td><td></td><td>For:</td></tr>
    <tr valign="top">
        <td>
            <b><span style="font-family: Arial; font-size: 24px"><a href="sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b><br />
            52 Church Street<br />
            Burlington, VT 05401<br /><br />
            email: <?= $selfmail ?><br />
            v(802) 863-4832, f(802) 660-0523<br />
        </td>
        <td >
            <?php if($vendors['hti'] == 1){ ?>
                <img src="../design/hti.jpg" alt="HTI" height="125px" />
            <?php } ?>
        </td>
        <td>
            <span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendors['name'] ?> (<?= $vendors['rep'] ?>)</span><br />
            <?= $vendors['addr1'] ?><br />
            <?= $vendors['addr2'] ?><br />
            <?= $vendors['addr3'] ?><br />
            <?= $vendors['email'] ?><br />
            v.<?= $vendors['voice'] ?> - f.<?= $vendors['fax'] ?>
        </td>
    </tr>
    <tr><td colspan="5"><hr /></td></tr>
</table>
<table class="count">
    <tr><td>Enter Ship Date:</td><td colspan="3"><?= $order['shipDate'] ?></td></tr>
    <tr><td>Freight Instructions: </td><td colspan="4"><?= $order['freight01'] ?>
    <?php if(substr($comments,0,3)=="HTI"){ ?>
            Member<br /><img border="0" src="design/hti.jpg" width="100" alt="Member HTI Buying Group" />
    <?php } ?>
    </td></tr>
    <tr><td>Order Instructions: </td><td colspan="4"><?= $order['freight02'] ?></td></tr>
    <tr valign="top"><td>Order Comments:</td><td colspan="4"><?= $order['orderComments'] ?></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table class="count">
    <tr class="print"><td>Order</td><td><a href="repOrder.php?order=<?= $po ?>&sortby=SKU">Sku</a></td><td><a href="repOrder.php?order=<?= $po ?>">Description</a></td><td>Cost</td><td>Extention</td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <?php  for($i=0; $i<$itemCount; $i++){
            $line=$line+1;
            $totalorder=$totalorder+($items[$i]['cost']*$items[$i]['qty']);
    ?>
    <tr >
        <td class="print" ><?= $items[$i]['qty'] ?></td>
        <td class="print" ><?= strtoupper($items[$i]['sku']) ?></td>
        <td class="print" ><?= ucwords(strtolower($items[$i]['description'])) ?></td>
        <td align="right" class="print" ><?= number_format($items[$i]['cost'],2) ?></td>
        <td align="right" class="print" ><?= number_format($items[$i]['cost']*$items[$i]['qty'],2) ?></td>
        <!--<td align="right" class="print" >#<?= $items[$i]['department'] ?></td>-->
    </tr>
        <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <?php
      if($line==25){
      $line=0;
      $page=$page+1;
      ?>
        </table>
        <P CLASS="breakhere">
<table class="count">
    <tr><td >Purchase Order# <?= $poNum ?><br />Order Date:<?= $order['dateOrd'] ?></td><td align="right">Page <?= $page ?> of  <?= $pages ?></td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <tr><td>From:</td><td>For:</td></tr>
    <tr valign="top">
        <td>
            <b><span style="font-family: Arial; font-size: 24px"><a href="http://www.homeportonline.com/dashboard/inventory/sentOrders.php" style="text-decoration: none; color: #000000">Homeport</a></span></b><br />
            52 Church Street<br />
            Burlington, VT 05401<br /><br />
            email: <?= $homeportEmail ?><br />
            v(802) 863-4832, f(802) 660-0523<br />
        </td>
        <td>
            <span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendors['name'] ?> (<?= $vendors['rep'] ?>)</span><br />
            <?= $vendors['addr1'] ?><br />
            <?= $vendors['addr2'] ?><br />
            <?= $vendors['addr3'] ?><br />
            <?= $vendors['email'] ?><br />
            v.<?= $vendors['voice'] ?> - f.<?= $vendors['fax'] ?>
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table class="count">
<?php if($order['discount'] > 0) { ?>
    <tr><td colspan="4">Order Discount: <?= $order['discount']?>%</td></tr>
<?php } ?>
    <tr><td>Enter Ship Date:</td><td colspan="3"><?= $order['shipDate'] ?></td></tr>
    <tr><td>Freight Instructions: </td><td colspan="4"><?= $order['freight01'] ?>
    <?php if(substr($comments,0,3)=="HTI"){ ?>
            Member<br /><img border="0" src="design/hti.jpg" width="100" alt="Member HTI Buying Group" />
    <?php } ?>
    </td></tr>
    <tr><td>Order Instructions: </td><td colspan="4"><?= $order['freight02'] ?></td></tr>
    <tr valign="top"><td>Order Comments:</td><td colspan="4"><?= $order['orderComments'] ?></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table  class="count">
    <tr class="print"><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extention</td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <?php  }
    } ?>
</table>
<br />
<table class="count">
    <tr class="print">
        <td align="right">Order Total <?= number_format($totalorder,2) ?></td>
    </tr>
</table>
</div>
</body>
</html>