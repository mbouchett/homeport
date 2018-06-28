<?php
//printCount.php 2018/01
// Prints a vendor count worksheet
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  	if(!isset($_SESSION['username'])){
		header('Location: ../index.php');
		die;
  	}

$vendor_ID = $_REQUEST['vendor_ID'];
if(!$vendor_ID) $vendor_ID = 516;

$desCol="#00CC00";
$catCol="#0000FF";

// used to indicate if the user has selected to order by category or description
unset($cat);
$cat=$_REQUEST['cat'];
$today = date("F d, Y");

// Load vendor data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor_ID;//Create The Search Query
$result = mysqli_query($db, $sql);          //Initiate The Query
mysqli_close($db);                          //Close The Connection

if($result) {
	$vendor = mysqli_fetch_assoc($result);//Get The Record
}else{
	echo "Vendor Not Found";
	die;
}

// load vendor catalog into array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `items` 
		  LEFT JOIN `items_hist` USING (`item_ID`)
        LEFT JOIN `departments` USING (`dept_ID`)
		  WHERE `items`.`vendor_ID` = '.$vendor['vendor_ID']."
		  ORDER BY `dept_belongs_to`, `dept_ID`, `item_desc`";
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db); 

//Store the Results To A Local Array
for($i=0; $i<$num_results; $i++){
	$items[$i] = mysqli_fetch_assoc($result);
}
	
$itemcount=count($items);
$pages=ceil($itemcount/23);
$page=1;
$line=0;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $vendor['vendor_name'] ?> Count</title>
	<link href="css/printCount.css" rel="stylesheet" type="text/css" />
	
</head>
<body onafterprint="hey(<?= $vendor_ID ?>);">
<table class="count">
    <tr >
        <th><?= $vendor['vendor_name'] ?>(<?= $vendor['vendor_group'] ?>)</th>
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
        <td>Cost</td>
        <td>Retail</td>
        <td>Last Order Info</td>
        <td>Pack</td>
        <td>O/H</td>
        <td>Order</td>
    </tr>
    <tr><td height="1" colspan="10" bgcolor="#000000"></td></tr>
    <?php  for($i=0; $i<$itemcount; $i++){
            $line=$line+1;
            if(strlen($items[$i]['item_desc']) > 78){
                $items[$i]['item_desc'] = substr($items[$i]['item_desc'],0,78)."...";
            }
            $hist = "[".$items[$i]['h1']."] [".$items[$i]['h2']."] [".$items[$i]['h3']."] [".$items[$i]['h4']."] [".
					$items[$i]['h5']."] [".$items[$i]['h6']."] [".$items[$i]['h7']."] [".$items[$i]['h8']."]";
    ?>
    <tr >
        <td class="print" rowspan="2" ><?= $items[$i]['item_sku'] ?><img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($items[$i]['item_pic']) ?>" /></td>
        <td class="print" style="font-size: 12px"><?= $items[$i]['item_desc'] ?></td>
        <td class="print" rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</td>
        <td class="print" rowspan="2"><?= $items[$i]['dept_belongs_to'] ?>-<?= $items[$i]['dept_ID'] ?></td>
        <td class="print" rowspan="2" ><?= $items[$i]['item_cost'] ?></td>
        <td class="print" rowspan="2" ><?= $items[$i]['item_retail'] ?></td>
        <td class="print" style="font-size: 10px">[<?= $items[$i]['loq'] ?>] <?= $items[$i]['lpo'] ?> : <?= $items[$i]['ldat'] ?></td>
        <td class="print" rowspan="2" ><?= $items[$i]['item_pack'] ?></td>
        <td class="print" width="35" rowspan="2" ><span style="color: #C6C6C6"><?= $items[$i]['item_qty'] ?></span></td>
        <td class="print" width="35" rowspan="2" ></td>
    </tr>
    <tr>
        <td class="print" style="font-size: 12px "> History:&nbsp;&nbsp;&nbsp; <?= $hist ?> </td>
        <td class="print" style="font-size: 10px ">[<?= $items[$i]['poq'] ?>] <?= $items[$i]['ppo'] ?> : <?= $items[$i]['pdat'] ?></td>
    </tr>
    <tr><td height="1" colspan="10" bgcolor="#767676"></td></tr>
    <?php
      if($line==23){
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
        <td>Cost</td>
        <td>Retail</td>
        <td>Last Order Info</td>
        <td>Pack</td>
        <td>O/H</td>
        <td>Order</td>
    </tr>
    <tr><td height="1" colspan="10" bgcolor="#000000"></td></tr>
    <?php  }
    } ?>
	</table>
<hr width="960" size="12" noshade="noshade"/>
<script defer="defer" type="text/javascript" src="js/printCount.js"></script>
</body>

</html>