<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";
include "../../../functions/f_resolve.php";

date_default_timezone_set('America/New_York');
//rev 2015/11

// use session info to verify login status
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
// collect logged in user info
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// this will extend the purchase order with the user's initials
$poExtention=strtoupper(trim(substr($useremail,0,2)));

//from url establish
$vendor=$_REQUEST['ven'];   // which vendor is being worked

unset($message);            // these are status containers from various processing utilities
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

//Open Vendor Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `number` LIKE"%'.$vendor.'%"' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
$vendors=mysqli_fetch_assoc($result);       //Fetch The Current Record

//Open Item Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    //$sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `description`' ;          //Create The Search Query
    $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `department`, `description`' ;
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){           //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $items[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$itemcount=count($items);
$total=0;

//Get want list info from customer service
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `wantlist` WHERE `vendor` = "'.$vendors['recno'].'" ' ;          //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
$ii = 0;
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){           //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        if(!$row['dateordered']){
            $wants[$ii] =  $row;
            $ii = $ii+1;
        }
    }                                           //Close The Loop
$wantcount=count($wants);

//look for an open order
unset($order);
unset($reload);
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "SELECT * FROM `orders` WHERE `vendor` = '".$vendors['recno']."' AND `dateOrd` IS NULL";   //Create The Search Query
    $result = mysqli_query($db, $sql);                                                                //Initiate The Query
    $num_results = mysqli_num_rows($result);
    if($num_results > 0){
        $order = mysqli_fetch_assoc($result);                                                   //Fetch The Current Record
    }else{
        $reload = 1;
        $a1 = $vendors['recno'];
        $a2 = $vendors['ship1'];
        $a3 = $vendors['ship2'];
        $a4 = $vendors['note'];

        $sql = "INSERT INTO `".$db_db."`.`orders` (`vendor`, `orderedBy`, `shipDate`, `freight01`, `freight02`, `orderComments`)
                VALUES ( '$a1', '$poExtention', 'ASAP', '$a2', '$a3', '$a4');";
        $result = mysqli_query($db, $sql);
        if(!$result){
            echo "No Good<br>";
            echo $sql;
            die;
        }
    }
    mysqli_close($db);

    if($reload){
        $rd = "location: enterCount.php?ven=$vendor";
        header($rd);
        die;
    }
    // Workout extentions and totals
    for($i=0; $i<$itemcount; $i++){
        $linetotal[$i] = ($items[$i]['oq']*$items[$i]['cost']*((100-$order['discount'])/100));
        $total = $total+($items[$i]['oq']*$items[$i]['cost']*((100-$order['discount'])/100));
    }
unset($offCycle);
if($order['offCycle']==1) $offCycle = "checked=\"checked\"";
if(!$order['comment']) $order['comment'] = "Please Apply Discount - Special Terms - And Freight Allowance";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
        <title>Enter Count - <?= $username ?> (a)</title>
        <link href="../design/style01.css" rel="stylesheet" type="text/css" />
        <script src="js/enterCount.js"></script>
    </head>
    <body >
        <div id="wrapper">
            <hr size="12" noshade="noshade"/>
            <form name="yourform" action="processOrder.php" method="post" >
            <table align="center">
                <tr >
                    <td class="dashcell"><input class="dashbut" name="save" value="Save Work" type="submit" /></td>
                    <td class="dashcell"><button class="dashbut" type="button" onclick="clearEntries()" >Clear Entries</button></td>
                    <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='../items.php?ven=<?= $vendor ?>'" type="button"></td>
                    <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='../inventory.php'" type="button"></td>
                    <td class="dashcell"><input style="font-weight: bold" class="dashbut" name="save" value="Process Order" type="submit" /></td>
                </tr>
            </table>
            <table width="800" align="center">
                <tr>
                    <td onclick="offCycle()" ><label>Off Cycle Order<input <?= $offCycle ?> id="checkNode" type="checkbox" name="offCycle" /></label></td>
                    <td>Ordered By: <?= $poExtention ?></td>
                    <td id="poNum">Order #<?= $order['orderNum'].$poExtention ?></td>
                    <td>Discount: <input name="discount" value="<?= $order['discount']?>" maxlength="2" size="2" />%</td>
                    <td>
                        <span style="font-weight: bold; color: #990000">Order Total as of last save : $<?= number_format($total,2) ?></span>
                        <input type="hidden" name="orderNum" value="<?= $order['orderNum']?>" />
                    </td>
                </tr>
                <tr >
                    <td id="vendor"><h1><?= $vendors['number'] ?></h1></td>
                    <td><h1><?= $vendors['name'] ?></h1></td>
                            <td >
                            <?php if($vendors['hti'] == 1){ ?>
                                <img src="../design/hti.jpg" alt="HTI" height="50px" />
                            <?php } ?>
                            </td>
                    <?php if($message){?>
                    <td >
                        <input id="mesbox" style="color: #<?=$messColor?>; font-size: <?=$messSize?>px; border: none" name="messagebox" value="<?=$message?>" />
                        <!--<span  align="center" style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"></span>-->
                    </td>
                    <?php }?>
                </tr>
                <tr><td>Enter Ship Date:</td><td colspan="3"><input name="shipdate" value="<?= $order['shipDate'] ?>" /></td></tr>
                <tr><td>Freight Instructions: </td><td colspan="4"><input size="125" name="freight01" value="<?= $order['freight01'] ?>" /></td></tr>
                <tr><td>Order Instructions: </td><td colspan="4"><input size="125" name="freight02" value="<?= $order['freight02'] ?>" /></td></tr>
                <tr valign="top"><td>Order Comments:</td><td colspan="4"><input size="125" name="comments" value="<?= $order['orderComments'] ?>" /></td></tr>
                <tr><td colspan="5"><hr /></td></tr>
                    <td colspan="3" style="font-family: Arial; font-size: 10px; color: #CC0000">
            <?php if($wantcount>0 && !$message){ ?>
                    Wantlists To Be Ordered: <br />
            <?php for($i=0; $i< $wantcount; $i++){ ?>
                      <a target="_blank" href="../../wantlist/customer.php?cust=<?= $wants[$i]['customer'] ?>"><?= $wants[$i]['description'] ?></a><br />
            <?php }
            } ?>
                    </td>
            </table>

            <table  align="center" width="1000" >
                <tr class="labels">
                    <td>Pic</td><td>LOH</td><td class="hide">OH</td><td>OQ</td><td>Sku</td><td>Description</td><td>Cat</td>
                    <td>Pack</td><td>Cost</td><td>Retail</td><td>Last Order Info</td><td style="font-size: 10px" >Ext</td>
                </tr>
                <?php
                for($i=0; $i<$itemcount; $i++){ ?>
                <tr>
                    <td>
                        <?php if($items[$i]['pic']) { ?>
                        <a class="thumbnail" href="#thumb">
                        <img border="0" src="<?= resolve($items[$i]['pic']) ?>" height="25" />
                        <span><img src="<?= resolve($items[$i]['pic']) ?>"/></span>
                        </a>
                        <?php } ?>
                    </td>
                    <td><?= $items[$i]['loh'] ?></td>
                    <td class="hide" width="40"><input alt="clear" onclick="document.getElementById('mesbox').value=''"
                        onkeypress="return tabE(this,event)"
                        value="<?= $items[$i]['oh'] ?>" name="oh[<?= $i ?>]" size="2" />
                    </td>
                    <td width="40"><input alt="clear" onclick="document.getElementById('mesbox').value=''"
                        <?php if($i<$itemcount-1){ ?>
                        onkeypress="return tabF(this,event)"
                        <?php } ?>
                        value="<?= $items[$i]['oq'] ?>" name="oq[<?= $i ?>]" size="2" />
                    </td>
                    <td title="<?= number_format($items[$i]['oq']*$items[$i]['cost'],2) ?>"  width="140" style="font-size: 12px" ><?= strtoupper($items[$i]['sku']) ?></td>
                    <td width="375"><?= ucwords(strtolower($items[$i]['description'])) ?></td>
                    <td width="40"><?= $items[$i]['department'] ?></td>
                    <td width="40"><?= $items[$i]['pack'] ?></td>
                    <td width="60"><?= $items[$i]['cost'] ?></td>
                    <td width="60"><?= $items[$i]['retail'] ?></td>
                    <td style="font-size: 12px" title="Previous: <?= $items[$i]['h2Dat'] ?> [<?= $items[$i]['h2Qty'] ?>] <?= $items[$i]['h2Po'] ?>">
                    <?= $items[$i]['h1Dat'] ?> [<?= $items[$i]['h1Qty'] ?>] <?= $items[$i]['h1Po'] ?></td>
                    <td style="font-size: 10px" ><?= number_format($linetotal[$i],2) ?></td>
                    <input type="hidden" name="recno[<?= $i ?>]" value="<?= $items[$i]['recno'] ?>" />
                </tr>
                <tr bgcolor="#EEEEEE"><td height="1" colspan="12"></td></tr>
                <?php } ?>
            </table>
            <input type="hidden" name="recordcount" value="<?= trim($itemcount) ?>" />
            <input type="hidden" name="vendor" value="<?= trim($vendor) ?>" />
            <table align="center">
                <tr >

                    <td class="dashcell"><input class="dashbut" name="save" value="Save Work" type="submit" /></td>
                    <td class="dashcell"><button class="dashbut" type="button" onclick="clearEntries()" >Clear Entries</button></td>
                    <td class="dashcell"><input class="dashbut" value="Edit Items" onclick="parent.location='../items.php?ven=<?= $vendor ?>'" type="button"></td>
                    <td class="dashcell"><input class="dashbut" value="Purchasing Dashboard" onclick="parent.location='../inventory.php'" type="button"></td>
                    <td class="dashcell"><input style="font-weight: bold" class="dashbut" name="save" value="Process Order" type="submit" /></td>
                </tr>
            </table>
            <input type="hidden" name="po" value="<?= trim($po) ?>" />
            <input type="hidden" name="vendor" value="<?= trim($vendor) ?>" />
            </form>
            <hr size="12" noshade="noshade"/>
            <!--<?php if($wantcount>0 && !$message){
                    $wlm = "There Are ".$wantcount." Unordered Wantlists Associated With This Vendor\\n\\n";
                    for($i=0; $i< $wantcount; $i++){
                      $wlm .= $wants[$i]['description'].'\\n';
                    }
                    echo '<script type="text/javascript"> alert("'.$wlm.'"); </script>';
            } ?>-->
        </div>
<script>
//call after page loaded
window.onload=offCycle() ;
</script>
    </body>
</html>