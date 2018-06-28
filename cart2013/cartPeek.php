<?php
// Mark Bouchett 06/08/2018
// cartPeek.php
// admin look at shopping cart
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

// load the cart data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart` 
		  LEFT JOIN `items` USING(item_ID)' ;
$result = mysqli_query($db, $sql); // create the query object
$cart_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//store the results to the $cart array
for($i=0;$i<$cart_results; $i++){
    $cart[$i]=mysqli_fetch_assoc($result);
}
$cartCount=count($cart);
 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="SHORTCUT ICON" href="http://www.homeportonline.com/images/HM.ICO" />
	<title>Homeport - Shopping Cart</title>
	<meta http-equiv="X-UA-Compatible" content="IE-edge" />
	<link href="css/peek.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	function roll(img_name, img_src)
	   {
	   document[img_name].src = img_src;
	   }
	</script>
</head>
<body>
<div align="center">
<img src="images/cartTagline.jpg" />
</div><br />
<h2>Homeport Shopping Carts 2013</h2>
<br />
<form action="processCartDeletes.php"  method="post">
<table align="center" width="900" cellpadding="2">
<tr bgcolor="#D5D5D5">
    <td width="40">Item</td>
    <td>Description</td>
    <td width="50">Qty</td>
    <td align="center" width="60">Price</td>
    <td align="center" width="65">Total</td>
    <td align="center" width="60">Visit ID</td>
    <td align="center" width="60">Date Added</td>
    <td align="center" width="60">Purchased</td>
    <td align="center" width="20">Delete</td>
</tr>
<?php for($i=0;$i<$cartCount; $i++){ ?>
	<tr>
    	<td>
            <a class="thumbnail" href="#thumb"><img class="imgthumb" src="<?=resolve($cart[$i]['item_pic'])?>" />
            <span><img src="<?=resolve($cart[$i]['item_pic'])?>" /><b><?=$cart[$i]['item_desc']?></b></span>
            </a>
        </td>
        <td><?= $cart[$i]['item_desc'] ?>
        <?php if($cart[$i]['regnum']){ ?>
        (Reg #<?= $cart[$i]['regnum'] ?>)
        <?php } ?>
        </td>
    	<td><?= $cart[$i]['cart_qty'] ?></td>
        <td align="right"><?= $cart[$i]['cart_retail'] ?></td>
        <td align="right"><?= $cart[$i]['qty']*$cart[$i]['cart_retail'] ?></td>
        <td align="center"><a href="https://www.homeportonline.com/secure2013/orders/<?= $cart[$i]['customer']?>.html"><?= $cart[$i]['customer']?></a></td>
        <td align="center"><?= $cart[$i]['cart_date']?></td>
        <td align="center"><?= $cart[$i]['cart_purch_date']?></td>
        <td title="<?= $cart[$i]['ip'] ?>" align="center"><input type="checkbox" name="delete[<?= $i ?>]" /><input type="hidden" name="record[<?= $i ?>]" value="<?= $cart[$i]['cart_ID']?>" /></td>
    </tr>
<?php } ?>
<tr height="2" bgcolor="#D5D5D5"><td colspan="10"></td></tr>
<tr ><td colspan="5"><input type="submit" name="" value="Process Deletes" /></td><td colspan="5"><input value="Return To Dashboard" onclick="parent.location='../dashboard/dashboard.php'" type="button"></td></tr>
</table>

</form>
</body>
</html>