<?php
include "../../db.php";
include "../../functions/f_resolve.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
$priceshow=1;
  if(!isset($_SESSION['username'])){
    unset($priceshow);
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];
$desCol="#00CC00";
$catCol="#0000FF";
unset($cat);
$cat=$_REQUEST['cat'];
$today = date("F d, Y");
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
    //$sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `description`' ;          //Create The Search Query
    $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `department`, `description`' ;
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $items[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$itemcount=count($items);

        $pages=ceil($itemcount/25);
        $page=1;
        $line=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png" />
  <title>Print Count (a)</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<!--<hr width="960" size="12" noshade="noshade"/>   -->
<table class="count">
    <tr >
        <th><?= $vendors['name'] ?></th>
        <th>Counted By:_____ Verified:_____</th>
        <th><?= $today ?></th>
        <th class="thsmall">Page <?= $page ?> of  <?= $pages ?></th>
    </tr>
    <tr><td colspan="4"><hr width="960" size="12" noshade="noshade"/></td></tr>
</table>
<table class="count">
    <tr class="print"> <!-- Titles -->
        <td>Sku</td>
        <td>Description</td>
         <td>BS / FS</td>
        <td>Cat</td>
        <td>Pack</td>
        <td>Cost</td>
        <td>Retail</td>
        <td>Last Order Info</td>
        <td>O/H</td>
        <td>Order</td>
    </tr>
    <tr><td height="1" colspan="10" bgcolor="#000000"></td></tr>
    <?php  for($i=0; $i<$itemcount; $i++){
            $line=$line+1;
            if(strlen($items[$i]['description']) > 78){
                $items[$i]['description'] = substr($items[$i]['description'],0,78)."...";
            }
    ?>
    <tr >
        <td class="print" rowspan="2" ><?= strtoupper($items[$i]['sku']) ?><img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($items[$i]['pic']) ?>" /></td>
        <td class="print" style="font-size: 12px"><?= $items[$i]['description'] ?></td>
        <td class="print" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</td>
        <td class="print" rowspan="2"><?= $items[$i]['department'] ?></td>
        <td class="print" rowspan="2" ><?= $items[$i]['pack'] ?></td>
        <td class="print" rowspan="2" ><?= $items[$i]['cost'] ?></td>
        <td class="print" rowspan="2" >
            <?php if($priceshow) echo $items[$i]['retail'] ?>
        </td>
        <td class="print" style="font-size: 10px"><?= $items[$i]['h1Dat'] ?> [<?= $items[$i]['h1Qty'] ?>] <?= $items[$i]['h1Po'] ?></td>
        <td class="print" width="35" rowspan="2" ><span style="color: #C6C6C6"><?= $items[$i]['loh'] ?></span></td>
        <td class="print" width="35" rowspan="2" ></td>
    </tr>
    <tr>
        <td class="print" style="font-size: 12px ">
            History:&nbsp;&nbsp;&nbsp;
            [ <?= $items[$i]['h3Dat'] ?> ( <?= $items[$i]['h3Qty'] ?> ) ]
            [ <?= $items[$i]['h4Dat'] ?> ( <?= $items[$i]['h4Qty'] ?> ) ]
        </td>
        <td class="print" style="font-size: 10px "><?= $items[$i]['h2Dat'] ?> [<?= $items[$i]['h2Qty'] ?>] <?= $items[$i]['h2Po'] ?></td></tr>
        <tr><td height="1" colspan="10" bgcolor="#767676"></td></tr>
    <?php
      if($line==25){
      $line=0;
      $page=$page+1;
      ?>
        </table>
        <P CLASS="breakhere" ></p>
    <table class="count">
        <tr >
            <td ><h2><?= $vendors['number'] ?></h2></td>
            <td><h2><?= $vendors['name'] ?></h2></td>
            <td><h2><?= $today ?></h2></td>
            <td>Page <?= $page ?> of  <?= $pages ?></td>
        </tr>
        <tr><td colspan="4"><hr /></td></tr>
    </table>
    <table class="count">
    <tr class="print"> <!-- Titles -->
        <td>Sku</td>
        <td>Description</td>
		  <td>BS / FS</td>
        <td>Cat</td>
        <td>Pack</td>
        <td>Cost</td>
        <td>Retail</td>
        <td>Last Order Info</td>
        <td>O/H</td>
        <td>Order</td>
    </tr>
    <tr><td height="1" colspan="10" bgcolor="#000000"></td></tr>
    <?php  }
    } ?>
</table>
<hr width="960" size="12" noshade="noshade"/>
</div>
</body>

</html>