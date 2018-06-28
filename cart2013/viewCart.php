<?php
//includes
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

// establish variables
date_default_timezone_set('America/New_York');
$shipping=$_REQUEST['shipping'];
$totalOrder=0;
$visitID=$_COOKIE['visitID'];
//verify Vist ID
if(!$visitID){
  echo '...You have not been assigned a cart. If you feel that you received this message in error<br/>';
  echo 'please contact (802) 863-4644<br/>';
  echo '<a href="http://www.homeportonline.com/store2009/categories/">Find Cool Stuff!</a>';
  exit;
}

// load the cart data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart`
		  LEFT JOIN `items` USING(`item_ID`) 
		  WHERE `customer` = \''.trim($visitID).'\' AND `cart_purch_date` IS NULL ' ;
$result = mysqli_query($db, $sql); // create the query object
if(!$result) {
	echo "Get Cart Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
$cart_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//store the results to the $cart array
for($i=0;$i<$cart_results; $i++){
	$cart[$i] = mysqli_fetch_assoc($result);
}
$cartCount=count($cart);

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="../images/HM.ICO" />
  <title>Homeport - Cart (<?= $visitID ?>)</title>
  <meta http-equiv="X-UA-Compatible" content="IE-edge" />
  <link href="css/cart.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function roll(img_name, img_src)
   {
   document[img_name].src = img_src;
   }

function closeme()
    {
        window.close();
    }
window.onblur=closeme;

</script>
<?php include 'popstyle.php'; ?>
</head>
<body>
<div id="cart">
<div id="banner" >
  <a href="http://www.homeportonline.com"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <img class="cartpic" src="../images/shopping_cart.png" />

</div>
</div><br />
<h2>Homeport Shopping Cart</h2>
<br />
<form name="cart" action="updateCart.php" method="post">
<table align="center" width="700" cellpadding="2">
    <tr class="bigwhite" bgcolor="#4a4a4a"><td width="40">Item</td><td>Description</td><td width="50">Qty</td><td align="center" width="60">Price</td><td align="center" width="65">Total</td><td align="center" width="60">Remove</td></tr>
<?php for($i=0;$i<$cartCount; $i++){
        $totalOrder=$totalOrder+($cart[$i]['cart_qty']*$cart[$i]['cart_retail']);
?>
	<tr class="bigblack">
    	<td>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 25px" border="0" src="<?= resolve($cart[$i]['item_pic']) ?>" />
            <span><img src="<?= resolve($cart[$i]['item_pic']) ?>"/></span>
            </a>
        </td>
        <td><?= $cart[$i]['item_desc'] ?>
        <?php if($cart[$i]['regnum']){ ?>
        (Reg #<?= $cart[$i]['regnum'] ?>)
        <?php } ?>
        </td>
    	<td><input size="3" name="cart[<?= $i ?>][0]" type="text" value="<?= $cart[$i]['cart_qty'] ?>" /></td>
        <td align="right"><?= $cart[$i]['cart_retail'] ?></td>
        <td align="right"><?= number_format($cart[$i]['cart_qty']*$cart[$i]['cart_retail'],2) ?></td>
        <td align="center"><input name="cart[<?=$i?>][1]" type="checkbox"/>
        <input type="hidden" name="cart[<?= $i ?>][2]" value="<?= $cart[$i]['cart_ID']?>" />
        </td>
    </tr>
<?php } ?>
<?php $tax=number_format(($totalOrder)*.07,2); ?>
<tr height="2" bgcolor="#4a4a4a"><td colspan="6"></td></tr>
<tr class="bigblack2"><td align="right" colspan="4">Total</td><td align="right">$<?= number_format($totalOrder,2) ?></td><td></td></tr>
<tr class="bigblack2"><td align="right" colspan="4">Tax</td><td align="right">$<?= $tax ?></td><td></td></tr>
<tr height="2" bgcolor="#4a4a4a"><td colspan="6"></td></tr>
</table>
<table align="center" width="700" cellpadding="2">
<tr>
	<td align="left">
        <a class="button" onClick="document.cart.submit()"><img height="14" alt="Refresh" src="images/refresh.png" /> Update Cart</a>
    </td>
    <td align="center">
        <a  class="button" onclick="window.close()"><!--category.php?cat=<?=$cat?>&catName=<?=$catName?>&currentItem=<?=$currentItem?>&add=1">-->
            Shop Some More!
        </a>
    </td>
	<td align="right">

    <?php if($totalOrder>0) { ?><!-- must use full URL for secure server -->
    	<a class="button2" href="../secure2013/checkOut.php?visitID=<?= $visitID ?>">
            Proceed to Secure Checkout
        </a>
    <?php } ?>
</td>

    <!--christmas cut-off Message
    <tr><td style="font-weight: bold; color: #990033; font-size: 28px" colspan="3">Orders Placed After December 16th Cannot Be Guaranteed to arrive before December 25th</td></tr>
    -->
</tr>
</table>
</form>
<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8450012-2");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>