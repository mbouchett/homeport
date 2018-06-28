<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$po=$_REQUEST['order'];

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
    $sql = 'SELECT * FROM `order_items` WHERE `order` = '.$po.' AND `received` IS NULL OR `order` = '.$po.' AND `received` = ""';          //Create The Search Query
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
        $sql = 'SELECT `sku`, `description`, `retail`, `department`  FROM `items` WHERE `recno` = "'.$items[$i]['item'].'"' ;//Create The Search Query
        $result = mysqli_query($db, $sql);          //Initiate The Query
        $row=mysqli_fetch_assoc($result);           //Fetch The Current Record
        $items[$i]['retail'] = $row['retail'];
        $items[$i]['description'] = stripslashes($row['description']);
        $items[$i]['sku'] = $row['sku'];
        $items[$i]['department'] = $row['department'];
    }

$pages=ceil($itemCount/25);
$page=1;
$line=0;
$total=0;

// Workout extentions and totals
for($i=0; $i<$itemCount; $i++){
    $total = $total+$items[$i]['qty'];
}

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
        if(!$row['location']){
            $wants[$ii] =  $row;
            $ii = $ii+1;
        }
    }                                         //Close The Loop
$wantcount=count($wants);
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$wantcount; $i++){
    $sql = "SELECT * FROM `customers` WHERE `custnum` = ".$wants[$i]['customer'];
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $row=mysqli_fetch_assoc($result);           //Fetch The Current Record
    $wants[$i]['name']=$row['custname'];
}
mysqli_close($db);                              //Close The Connection

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title>Print <?= $vendors['name'] ?> Backorder Checkin</title>
  <link href="../design/vieworder.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../design/vieworder.css" rel="stylesheet" type="text/css" media="print" />
</head>
<body >
<div id="wrapper">
<table class="count">
    <tr><td >Backorder Checkin For Purchase Order# <?= $poNum ?><br />Order Date:<?= $order['dateOrd'] ?></td><td align="right">Page <?= $page ?> of  <?= $pages ?></td></tr>
    <tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
    <tr><td>From:</td><td>For:</td></tr>
    <tr valign="top">
        <td>
            <b>Homeport</b><br />
            52 Church Street<br />
            Burlington, VT 05401<br /><br />
            email: <?= $useremail ?><br />
            v(802) 863-4832, f(802) 660-0523<br />
        </td>
        <td>
            <span style="font-size: 16px; font-weight: bold; background-color: #00BFFF; font-family: Arial"><?= $vendors['name'] ?> (<?= $vendors['rep'] ?>)</span><br />
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
    <tr><td colspan="2"><?= $order['freight01'] ?></td></tr>
    <tr><td colspan="2"><?= $order['freight02'] ?></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td colspan="2">Ship Date: <?= $order['shipDate'] ?></td></tr>
    <tr><td colspan="2"><b><?= $order['orderComments'] ?></b></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>

<?php if($wantcount>0 && !$message){ ?>
<table class="wantlist">
    <tr>
        <td colspan="4" style="font-weight: bold">
        There Are <?= $wantcount ?> Wantlists Associated With This Vendor
        </td>
    </tr>
        <?php for($i=0; $i< $wantcount; $i++){ ?>
    <tr>
        <td><?= $wants[$i]['qty'] ?></td>
        <td><?= $wants[$i]['sku'] ?></td>
        <td><?= $wants[$i]['description'] ?></td>
        <td><?= $wants[$i]['name'] ?></td>
    </tr>
        <?php } ?>
</table>
<?php } ?>

<table class="count">
    <tr class="print"><td>Recd</td><td>QTY</td><td>Sku</td><td>Description</td><td>Cat</td><td>Retail</td></tr>
    <tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
    <?php  for($i=0; $i<$itemCount; $i++){
            $line=$line+1;
    ?>
    <tr >
        <td width="60" class="print" ></td>
        <td width="40" class="print" ><?= $items[$i]['qty'] ?></td>
        <td class="print" ><?= strtoupper($items[$i]['sku']) ?></td>
        <td class="print" ><?= ucwords(strtolower($items[$i]['description'])) ?></td>
        <td width="40" class="print" ><?= $items[$i]['department'] ?></td>
        <td width="60" align="right" class="print" ><?= number_format($items[$i]['retail'],2) ?></td>
    </tr>
        <tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
    <?php
      if($line==25){
      $line=0;
      $page=$page+1;
      ?>
        </table>
        <P CLASS="breakhere"></p>
<table class="count">
    <tr><td>Backorder Checkin For Purchase Order# <?= $po ?><br />Order Date:<?= $orderdate ?></td><td align="right">Page <?= $page ?> of  <?= $pages ?></td></tr>
    <tr><td>From:</td><td>For:</td></tr>
    <tr valign="top">
        <td>
            <b>Homeport</b><br />
            52 Church Street<br />
            Burlington, VT 05401<br /><br />
            email: <?= $useremail ?><br />
            v(802) 863-4832, f(802) 660-0523<br />
        </td>
        <td>
            <span style="font-size: 16px; font-weight: bold; background-color: #00BFFF; font-family: Arial"><?= $vendors['name'] ?> (<?= $vendors['rep'] ?>)</span><br />
            <?= $vendors['addr1'] ?><br />
            <?= $vendors['addr2'] ?><br />
            <?= $vendors['addr3'] ?><br />
            <?= $vendors['email'] ?><br />
            v.<?= $vendors['voice'] ?> - f.<?= $vendors['fax'] ?>
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>

    <tr><td colspan="2"><?= $vendors['ship1'] ?></td></tr>
    <tr><td colspan="2"><?= $vendors['ship2'] ?></td></tr>
    <tr><td colspan="2"><hr /></td></tr>
    <tr><td colspan="2">Ship Date: <?= $shipdate ?> (Cancel 30 Days After Ship Date) - No Backorders Without Prior Approval</td></tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table class="count">
    <tr class="print"><td>Recd</td><td>QTY</td><td>Sku</td><td>Description</td><td>Cat</td><td>Retail</td></tr>
    <tr><td colspan="6" height="1" bgcolor="#767676"></td></tr>
    <?php  }
    } ?>
</table>
<br />
<table class="count">
    <tr class="print">
        <td>Checked In By:</td><td>Approved By:</td><td>Date:</td><td align="right">Total Items <?= $total ?></td>
    </tr>
</table>
    <div style="margin-left: 120px">
    -------------------------------------------------------------------------------------------------------------------------<br />
    [ ] I put the wantlist items on hold and updated Customer Service&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ ] I attached the packing list<br />
    [ ] I put the items on the shelf and backstocked the extra<br />
    (Yes) (No) I attached an Exception Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Yes) (No) I created a Backorder<br />
    -------------------------------------------------------------------------------------------------------------------------
    </div>
</div>
</body>
</html>