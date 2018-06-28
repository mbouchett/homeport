<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!

function compare_sku($a, $b) {
  return strnatcmp($a['sku'], $b['sku']);
}

$today = date('m/d/Y');
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

unset($emailsuccess);
$emailsuccess=$_REQUEST['success'];

$po=$_REQUEST['order'];
if(strlen($po) !=7){
    echo "not a valid po# navigate back <<<".strlen($po);
    die;
}

$sortby=$_REQUEST['sortby'];
if($sortby != "SKU") unset($sortby); //control injection

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
if($itemCount == 0){
    echo "No Items On This PO# navigate back <<<";
    die;
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

// parse out category breakdown
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $result = mysqli_query($db, "SELECT * FROM departments WHERE CHAR_LENGTH(depnum)=2 ORDER BY depnum");          //Initiate The Query
    $depCount=mysqli_num_rows($result);             //Count The Query Matches
    mysqli_close($db);                              //Close The Connection
    //Store the Results To A Local Array
    for($i=0; $i<$depCount; $i++){                  //Iniate The Loop
      $row=mysqli_fetch_assoc($result);             //Fetch The Current Record
      $deps[$i]=$row;                               //Save The Record To The Array
      $deps[$i]['total']=0;
    }
for($i=0; $i<$depCount; $i++){
    for($ii=0; $ii < $itemCount; $ii++){
        if($deps[$i]['depnum'] == substr($items[$ii]['department'],0,2)){
        $deps[$i]['total'] =  $deps[$i]['total'] + ($items[$ii]['cost'] * $items[$ii]['qty']*((100-$order['discount'])/100));
        }
    }
}

if($sortby=="SKU"){
    usort($items, 'compare_sku');
}

$pages=ceil($itemCount/25);
$page=1;
$line=0;
$total=0;

// Workout extentions and totals
for($i=0; $i<$itemCount; $i++){
    $linetotal[$i] = ($items[$i]['qty']*$items[$i]['cost']*((100-$order['discount'])/100));
    $total = $total+($items[$i]['qty']*$items[$i]['cost']*((100-$order['discount'])/100));
}

$selfmail='<a href="emailOrder.php?po='.$po.'&email='.$useremail.'" title="Click Here To Email This Order To Yourself" style="text-decoration: none; color: #000000">'.$useremail.'</a>';
if($selfsuccess){
    $selfmail='<a href="emailOrder.php?po='.$po.'&email='.$useremail.'" title="Click Here To Email This Order To Yourself" style="text-decoration: none; color: #000000"><small>'.$useremail.'</small></a><small> (Email Successful)</small>';
}
if(!$username) $selfmail=$useremail;

unset($emaillink);
if($vendors['email']){
    $emaillink='<a href="emailOrder.php?po='.$po.'&email='.$vendors['email'].'" title="Click Here To Email This Order To The Rep" style="text-decoration: none; color: #000000">'.$vendors['email'].'</a>';
}
if($emailsuccess){
    $emaillink='<a href="emailOrder.php?po='.$po.'&email='.$vendors['email'].'" title="Click Here To Email This Order To The Rep" style="text-decoration: none; color: #000000"><small>'.$vendors['email'].'</small></a><small> (Email Successful)</small>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=Windows-1252" />
  <link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title>View <?= $vendors['name'] ?> Order</title>
  <link href="../design/vieworder.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="../design/printorder.css" rel="stylesheet" type="text/css" media="print" />
  <script type="text/javascript">
  function deleteOrd(ordNum, vendor){
    if(confirm('Are you very sure you wish to delete this order\nThis operation is not reversable!')){
        parent.location='deleteOrder.php?orderNum='+ordNum;
    }else{
        return false;
    }
  }
  </script>
</head>
<body >
<div id="wrapper" >
<form action="processView.php" method="post">
<table class="count">
    <tr>
        <td >Purchase Order# <?= $poNum ?><br />Order Date:<?= $order['dateOrd'] ?></td>
        <?php if($order['acknowledged']){ ?><td title="<?= $order['acknowledged'] ?>"><span style="color: #23A923; font-weight: bold">Acknowledged</span></td><?php } ?>
        <td align="right"><input type="button" class="saveButton" onclick="deleteOrd(<?= $order['orderNum'] ?>)" value="Delete" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page <?= $page ?> of  <?= $pages ?></td>
    </tr>
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
            <?= $emaillink ?><br />
            v.<?= $vendors['voice'] ?> - f.<?= $vendors['fax'] ?>
        </td>
    </tr>
    <tr><td colspan="5"><hr /></td></tr>
</table>
<table class="count">
    <tr>
        <td>Order Discount: <input style=" width: 20px" class="ordInput" name="discount" value="<?= $order['discount']?>"/>%</td>
        <td align="right"><input class="saveButton" type="submit" name="" value="Save" /></td>
    </tr>
    <tr>
        <td>Enter Ship Date: <input class="ordInput" name="shipdate" value="<?= $order['shipDate'] ?>" /></td>
        <td align="right"><input type="button" class="saveButton" onclick="parent.location='printCheckin.php?order=<?= $order['orderNum'] ?>'" value="Check In" /></td>
    </tr>
    <tr>
        <td>Freight Instructions: <input class="ordInput" name="freight01" value="<?= $order['freight01'] ?>" />
        <?php if(substr($comments,0,3)=="HTI"){ ?>
                Member<br /><img border="0" src="design/hti.jpg" width="100" alt="Member HTI Buying Group" />
        <?php } ?>
        </td><td align="right"><input onclick="parent.location='viewBo.php?order=<?= $po ?>'" class="saveButton" type="button" value="B/O" /></td>
    </tr>
    <tr>
        <td>Order Instructions: <input class="ordInput" name="freight02" value="<?= $order['freight02'] ?>" /></td>
        <td align="right"><input type="button" class="saveButton" onclick="parent.location='faxOrder.php?order=<?= $order['orderNum'] ?>'" value="Faxed" /></td>
    </tr>
    <tr valign="top">
        <td>Order Comments: <input class="ordInput" size="125" name="comments" value="<?= $order['orderComments'] ?>" /></td>
        <td align="right"><input type="button" class="saveButton" onclick="parent.location='sentOrders.php'" value="Exit" /></td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
</table>
<table class="count">
    <tr class="print"><td>Order</td><td><a href="viewOrder.php?order=<?= $po ?>&sortby=SKU">Sku</a></td><td><a href="viewOrder.php?order=<?= $po ?>">Description</a></td><td>Cost</td><td>Extention</td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <?php  for($i=0; $i<$itemCount; $i++){
            $line=$line+1;
    ?>
    <tr >
        <td title="<?= $items[$i]['recno'] ?>" class="print" >
            <input  style=" width: 30px" class="ordInput" name="qty[<?= $i ?>]" value="<?= $items[$i]['qty'] ?>" />
            <?php if($items[$i]['received']){?>
            <input style="width: 10em;" class="ordInput" name="rec[<?= $i ?>]" value="<?= $items[$i]['received'] ?>" />
            <?php }else{ ?>
            <input class="recd" name="rec[<?= $i ?>]" type="checkbox" value="<?= $today ?>"  /><span class="recd">Received</span>
            <!--<input  type="button" name="rec[<?= $i ?>]" value="Recd." onclick="parent.location='recItem.php?recno=<?= $items[$i]['recno'] ?>&order=<?= $po ?>'" />-->
            <?php }?>
            <input type="hidden" name="recno[<?= $i ?>]" value="<?= $items[$i]['recno'] ?>" />
            <input type="hidden" name="sku[<?= $i ?>]" value="<?= $items[$i]['sku'] ?>" />
            
        </td>
        <td class="print" ><?= strtoupper($items[$i]['sku']) ?></td>
        <td class="print" ><?= ucwords(strtolower($items[$i]['description'])) ?></td>
        <td align="right" class="print" ><?= number_format($items[$i]['cost'],2) ?></td>
        <td align="right" class="print" ><?= number_format($linetotal[$i],2) ?></td>
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
            email: <?= $selfmail ?><br />
            v(802) 863-4832, f(802) 660-0523<br />
        </td>
        <td>
            <span style="font-size: 16px; font-weight: bold; background-color: #FFFF33; font-family: Arial"><?= $vendors['name'] ?> (<?= $vendors['rep'] ?>)</span><br />
            <?= $vendors['addr1'] ?><br />
            <?= $vendors['addr2'] ?><br />
            <?= $vendors['addr3'] ?><br />
            <?= $emaillink ?><br />
            v.<?= $vendors['voice'] ?> - f.<?= $vendors['fax'] ?>
        </td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>
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
<table  class="count">
    <tr class="print"><td>Order</td><td>Sku</td><td>Description</td><td>Cost</td><td>Extention</td></tr>
    <tr><td colspan="5" height="1" bgcolor="#767676"></td></tr>
    <?php  }
    } ?>
</table>
<input type="hidden" name="orderNum" value="<?= $order['orderNum'] ?>" />
</form>
<br />
<table class="count">
    <tr class="print">
    <?php if($username){ ?>
        <td>Logged [&nbsp;&nbsp;&nbsp;&nbsp;]
        Faxed/emailed [
        <?php if($order['emailed']){ ?>
        &nbsp;&nbsp;X&nbsp;&nbsp;
        <?php }else{ ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php } ?>
        ]
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buyer Signature:
        </td>
    <?php } ?>
        <td align="right">Order Total <?= number_format($total,2) ?></td>
    </tr>
</table>
<?php if($order['emailed']){ ?>
<div class="sent"><img title="SENT: <?= $order['emailed'] ?>" alt="SENT: <?= $order['emailed'] ?>" src="../design/sent.png" /></div>
<?php } ?>
</div>
<div class="summary">
<?php
    $num=0;
    for($i=0; $i<$depCount; $i++){

        if($deps[$i]['total']){
           $num++;
        ?>
            #<?= $deps[$i]['depnum'] ?> - <?= $deps[$i]['department'] ?>: $<?= number_format($deps[$i]['total'],2) ?>&nbsp;&nbsp; |&nbsp;&nbsp;
<?php }
    if($num % 4 == 0) echo "<br />";
}?>
</div>
<div class="add">
<form action="addOrderItem.php" method="post">
<table >
    <tr><td><hr /><input type="hidden" name="orderNum" value="<?= $order['orderNum'] ?>" /></td></tr>
    <tr><td>Add Item (Record Number): <input name="recno" /> - Qty: <input style=" width: 25px"  name="qty" /><input name="" type="submit" value="Add Item To Order" /><hr /></td></tr>
</table>
</form>
<div  style="text-align: right"><input type="button" onclick="parent.location='ackOrder.php?order=<?= $order['orderNum'] ?>'" value="Manual Acknowledgment" /></div>

</div>

</body>

</html>