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

header('Cache-Control: max-age=900');

function cmp($a, $b)
{
    return strcmp($b["sortDate"], $a["sortDate"]);
}

$fs = $_REQUEST['fs'];

$username = $_SESSION['username'];
$useremail = $_SESSION['useremail'];
$key = trim($_POST['key']);

//open order database and retrieve sent orders
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = "SELECT * FROM `orders` WHERE `dateOrd` IS NOT NULL ORDER BY `orderNum` DESC";            //Create The Search Query
    $result = mysqli_query($db, $sql);                                      //Initiate The Query
    $orderCount = mysqli_num_rows($result);
for($i = 0; $i<$orderCount; $i++){
    $row = mysqli_fetch_assoc($result);                                       //Fetch The Current Record
    $orders[$i] = $row;                                                       //Save The Record To The Array
}

//Open Vendor Database And Store It In A Local Array
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i = 0; $i<$orderCount; $i++){
        $sql = 'SELECT `name` FROM `vendors` WHERE `recno` = "'.$orders[$i]['vendor'].'"' ;         //Create The Search Query
        $result = mysqli_query($db, $sql);                                  //Initiate The Query
        $row = mysqli_fetch_assoc($result);                                   //Fetch The Current Record
        $orders[$i]['name'] = $row['name'];
        $orders[$i]['po'] = $orders[$i]['orderNum'].$orders[$i]['orderedBy'];
        if($orders[$i]['offCycle']) $orders[$i]['po'] .= "X";
        $orders[$i]['sortDate'] = substr($orders[$i]['dateOrd'], 6, 4).substr($orders[$i]['dateOrd'], 0, 2).substr($orders[$i]['dateOrd'], 3, 2);
    }
mysqli_close($db);
usort($orders, "cmp");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="SHORTCUT ICON" href="design/4923-48x48x32.png">
	<title>View Purchase Order (a)</title>
	<link href="../design/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<div class="title">Homeport Online</div>
<form action="sentOrders.php" method="post" >
<table class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchases Dashboard" onclick="parent.location='../inventory.php'" type="button"></td>
        <td class="dashcell"><input name="key" /></td>
    </tr>
</table>
</form>
<div class="filter">
Filter By:
	<ul>
		<li><a href="sentOrders.php?fs=1">Processed</a></li>
		<li><a href="sentOrders.php?fs=2">Sent</a></li>
		<li><a href="sentOrders.php?fs=3">Checkin</a></li>
		<li><a href="sentOrders.php?fs=4">Received</a></li>
		<li><a href="sentOrders.php?fs=5">Closed</a></li>
		<li><a href="sentOrders.php">No Filter</a></li>
	</ul>
</div>

<table class="menu">
    <tr class="print" style="font-weight: bold"><td width="100">Purchase<br />Order #</td><td>Vendor Name</td><td>Order Date</td><td>Ship Date</td><td>Acknowledged</td><td>Status</td></tr >
    <tr><td height="1" bgcolor="#000000" colspan="6"></td></tr>
    <?php
        for($i = 0; $i < $orderCount; $i++){
        	   if($orders[$i]['orders_status'] == 1) {
        			$bgc = "#ffffb3"; // light yellow Processed
        			$status = "Processed";
        		}elseif($orders[$i]['orders_status'] == 2) {
        			$bgc = "#b3ffb3"; // light yellow Green Sent
        			$status = "Sent";
     			}elseif($orders[$i]['orders_status'] == 3) {
        			$bgc = "#e6b3ff"; // light purple Being Checked in
        			$status = "Checkin";
     			}elseif($orders[$i]['orders_status'] == 4) {
        			$bgc = "#bf8040"; // light orange Fully or Partially Received
        			$status = "Received";
     			}elseif($orders[$i]['orders_status'] == 5) {
        			$bgc = "#808080"; // light grey Considered closed by Accts. Payable
        			$status = "Closed";
     			}
     			
        		if($key){
        		if(stripos(" ".$orders[$i]['name'], trim($key))){			
    ?>
    <tr class="print"><!-- Matches the search key -->
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['po'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['name'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['dateOrd'] ?></a></td>
        <td style="text-align: center"><a title="Click To View" style=" color: #000000; text-decoration: none; font-style: italic;" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['shipDate'] ?></a></td>
		  <td><?= $orders[$i]['acknowledged'] ?></td>  
		  <td ondblclick="changeStat('<?= $orders[$i]['po'] ?>', '<?= $status ?>');" bgcolor="<?= $bgc ?>" ><?= $status ?></td> 
    </tr >
    <tr><td height="1" bgcolor="#996633" colspan="6"></td></tr>
    <?php } }else{ 
					if(!$fs || $orders[$i]['orders_status'] == $fs) {    
    ?>
    <tr class="print"><!-- All Pos + Filter -->
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['po'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['name'] ?></a></td>
        <td><a title="Click To View" style=" color: #000000; text-decoration: none" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['dateOrd'] ?></a></td>
        <td style="text-align: center"><a title="Click To View" style=" color: #000000; text-decoration: none; font-style: italic;" href="viewOrder.php?order=<?= $orders[$i]['orderNum'] ?>"><?= $orders[$i]['shipDate'] ?></a></td>
        <td><?= $orders[$i]['acknowledged'] ?></td>
		  <td ondblclick="changeStat('<?= $orders[$i]['po'] ?>','<?= $status ?>');" bgcolor="<?= $bgc ?>" ><?= $status ?></td>
    </tr >
    <tr><td height="1" bgcolor="#996633" colspan="6"></td></tr>
    <?php } } }?>
</table>

<table  class="menu">
    <tr >
        <td class="dashcell"><input class="dashbut" value="Purchases Dashboard" onclick="parent.location='../inventory.php'" type="button"></td>
    </tr>
</table>
</div>
<script defer="defer" type="text/javascript" src="js/sentOrders.js"></script>
</body>

</html>