<?php

include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
function convert($str,$ky='cornflakes'){
if($ky=='')return $str;
$ky=str_replace(chr(32),'',$ky);
if(strlen($ky)<8)exit('key error');
$kl=strlen($ky)<32?strlen($ky):32;
$k=array();for($i=0;$i<$kl;$i++){
$k[$i]=ord($ky{$i})&0x1F;}
$j=0;for($i=0;$i<strlen($str);$i++){
$e=ord($str{$i});
$str{$i}=$e&0xE0?chr($e^$k[$j]):chr($e);
$j++;$j=$j==$kl?0:$j;}
return $str;
}

//Load our email address
$fp = fopen('../email.txt', "r");  //Open The File For Reading
  $data = fgets($fp);                    //Load The Value
fclose($fp);
$homeportEmail = substr($data,12,19).".com";

// collect up all of the data
$visitID=$_POST['visitID'];
$cart=$_POST['cart'];
$cartCount=count($cart);
        // $cart[$i][0] -> sku
        // $cart[$i][1] -> description
        // $cart[$i][2] -> qty
        // $cart[$i][3] -> price
        // $cart[$i][4] -> extention
        // $cart{$i][4] -> if Registry Item (Reg# 1)
$totals=$_POST['totals'];
        // $totals[0] -> merchandise total
        // $totals[1] -> tax total
        // $totals[2] -> shipping total
        // $totals[3] -> total charge
$ccInfo=$_POST['CC'];
        // $ccInfo[0] -> Card Type*
        // $ccInfo[1] -> Card #*
        // $ccInfo[2] -> Exp Month*
        // $ccInfo[3] -> Exp Year*
        // $ccInfo[4] -> CVV2 Code*
        // $ccInfo[5] -> Name On Card*
$xCard[0]=convert($ccInfo[1]);
$xCard[1]=convert($ccInfo[1]);
$xCard[2]=convert($ccInfo[1]);
$xCard[3]=convert($ccInfo[1]);

$billing=$_POST['b'];
        // $billing[0] ->First Name:*
        // $billing[1] ->Last Name:*
        // $billing[2] ->Company Name:
        // $billing[3] ->Address:*
        // $billing[4] ->Address2:
        // $billing[5] ->City:*
        // $billing[6] ->State:*
        // $billing[7] ->Zip Code:*
        // $billing[8] ->Country:*
        // $billing[9] ->Telephone#*
        // $billing[10] ->Email:*
$shipping=$_POST['s'];
        // $shipping[0] ->First Name:*
        // $shipping[1] ->Last Name:*
        // $shipping[2] ->Company Name:
        // $shipping[3] ->Address:*
        // $shipping[4] ->Address2:
        // $shipping[5] ->City:*
        // $shipping[6] ->State:*
        // $shipping[7] ->Zip Code:*
        // $shipping[8] ->Country:*
        // $shipping[9] ->Telephone#*
        // $shipping[10] ->Email:*
$pickup=$_POST['p'];
        // $pickup[0] ->Hold For Name
        // $pickup[1] ->phone or email
        // $pickup[2] ->Who Should Contact
if(!$pickup[0]) $pickup[0] = $billing[0];

$comments=$_POST['comments'];

// open file for write
$fp = fopen("orders/$visitID.html", 'w');
fwrite($fp, 'Order #'.$visitID.'<br />');
for($i=0; $i<$cartCount; $i++){
    $xString= $cart[$i][0].' ->'.$cart[$i][1].' ->'.$cart[$i][2].' ->'.$cart[$i][3].' ->'.$cart[$i][4].'<br />';
    fwrite($fp, $xString);
}
fwrite($fp,'<hr />');
fwrite($fp,'Merchandise Total $'.$totals[0].'<br />');
fwrite($fp,'Tax Total $'.$totals[1].'<br />');
fwrite($fp,'Shipping Total $'.$totals[2].'<br />');
fwrite($fp,'<hr />');
fwrite($fp,'Card Type: '.$ccInfo[0].'<br />');
fwrite($fp,'Card #: '.$ccInfo[1].'<br />');
fwrite($fp,'Exp: '.$ccInfo[2].'/'.$ccInfo[3].'<br />');
fwrite($fp,'CVV2 Code: '.$ccInfo[4].'<br />');
fwrite($fp,'Name On Card: '.$ccInfo[5].'<br />');
fwrite($fp,'<hr />');
fwrite($fp,'<table>');
fwrite($fp,'<tr><td><b>Billing</b></td><td><b>Shipping</b></td></tr>');
fwrite($fp,'<tr><td>'.$billing[0].'</td><td>'.$shipping[0].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[1].'</td><td>'.$shipping[1].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[2].'</td><td>'.$shipping[2].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[3].'</td><td>'.$shipping[3].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[4].'</td><td>'.$shipping[4].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[5].'</td><td>'.$shipping[5].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[6].'</td><td>'.$shipping[6].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[7].'</td><td>'.$shipping[7].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[8].'</td><td>'.$shipping[8].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[9].'</td><td>'.$shipping[9].'</td></tr>');
fwrite($fp,'<tr><td>'.$billing[10].'</td><td>'.$shipping[10].'</td></tr>');
fwrite($fp,'</table>');
fwrite($fp,'<hr />');
fwrite($fp,'Hold For: '.$pickup[0].'<br />');
fwrite($fp,'Contact At: '.$pickup[1].'<br />');
fwrite($fp,'Who Will Contact: '.$pickup[2].'<br />');
fwrite($fp,'<hr />');
fwrite($fp,'Comments:<br />');
fwrite($fp,$comments);
fclose($fp);

					//Begin Verifications
//Verify Card #
$cc_num=trim($ccInfo[1]);
$type=trim($ccInfo[0]);

switch ($type) {
	case "amex":
		$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
		if (preg_match($pattern,$cc_num) && strlen($cc_num)==15) {
		$verified = true;
		} else {
		$verified = false;
		}
        $ccInfo[0]="American Express";
		break;

	case "discover":
		$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
		if (preg_match($pattern,$cc_num) && strlen($cc_num)==16) {
		$verified = true;
		} else {
		$verified = false;
		}
        $ccInfo[0]="Discover";
		break;

	case "mc":
		$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
		if (preg_match($pattern,$cc_num) && strlen($cc_num)==16) {
		$verified = true;
		} else {
		$verified = false;
		}
        $ccInfo[0]="MasterCard";
		break;

	case "visa":
		$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
		if (preg_match($pattern,$cc_num) && strlen($cc_num)==16) {
		$verified = true;
		} else {
		$verified = false;
		}
        $ccInfo[0]="Visa";
		break;
}

	if($verified == false) {
	//Do something here in case the validation fails
	header('Location: checkOut.php?visitID='.$visitID.'&shipping='.$totals[2].'&zipCode='.$shipping[7].'&message=Credit Card Type or Number Not Valid');
	die;
	}
	
	// Check For Valid Email
	if (!filter_var($billing[10], FILTER_VALIDATE_EMAIL)) {
		//Do this stuff if the email is invalid
		header('Location: checkOut.php?visitID='.$visitID.'&shipping='.$totals[2].'&zipCode='.$shipping[7].'&message=Billing Email Address Is Invalid&bgcolor=FFFF00');
		die;
	}
	
//Now we will build the order/invoice
$story ='<table align="center" width="600">'."\n".
        '    <tr>'."\n".
        '        <td><a href="http://www.homeportonline.com"><img width="250" src="http://www.homeportonline.com/secure2013/images/logo.jpg" border="0" /></a></td>'."\n".
        '        <td align="center"><H2>Homeport</H2><br />'."\n".
        '            52 Church Street<br />'."\n".
        '            Burlington, VT 05401<br />'."\n".
        '            (802) 863-4644<br /> '."\n".
        '            www.homeportonline.com<br />'."\n".
        '            email: home@homeportonline.com'."\n".
        '        </td>'."\n".
        '    </tr>'."\n".
        '    <tr bgcolor="#9C9C9C"><td colspan="2"></td></tr>'."\n".
        '    <tr><td class="form">Order #'.$visitID.'</td><td align="right" class="form">Order Date:'.date('m/d/Y').'</td></tr>'."\n".
        '    <tr bgcolor="#9C9C9C"><td colspan="2"></td></tr>'."\n".
        '</table>'."\n".
        '<table align="center" width="550">'."\n".
        '    <tr>'."\n".
        '        <td class="form"><b>Purchased By:</b><br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[0].' '.$billing[1].'<br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[2].'<br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[3].'<br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[4].'<br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[5].', '.$billing[6].' '.$billing[7].'<br />'."\n".
        '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$billing[8].'<br />'."\n".
        '        </td>'."\n";
        if($totals[2]=="pickup"){ // If the order is for pickup
$story .='<td class="form"><b>*Held In Store For:</b><br /><br />'."\n".
         '            <h2>'.$pickup[0].'</h2>'."<br />\n".
		 '            '.$pickup[1]."\n".
         '        </td>'."\n";
         } else { // If the order is to be shipped
$story .='<td class="form"><b>Order Will Ship To:</b><br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[0].' '.$shipping[1].'<br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[2].'<br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[3].'<br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[4].'<br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[5].', '.$shipping[6].' '.$shipping[7].'<br />'."\n".
         '            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$shipping[8].'<br />'."\n".
		 '        </td>'."\n";
}
$story .='    </tr>'."\n".
		 '</table>'."\n".
		 '<table align="center" width="600">'."\n".
		 '    <tr bgcolor="#9C9C9C"><td colspan="5"></td></tr>'."\n".
		 '    <tr bgcolor="#D5D5D5">'."\n".
		 '        <td width="100">Item</td>'."\n".
		 '        <td>Description</td>'."\n".
		 '        <td align="center" width="50">Qty</td>'."\n".
		 '        <td align="center" width="60">Price</td>'."\n".
		 '        <td align="center" width="65">Total</td>'."\n".
		 '    </tr>'."\n";
for($i=0; $i<$cartCount; $i++){
$story .='    <tr>'."\n".
		 '        <td><a href="http://www.homeportonline.com?recno='.$cart[$i][0].'">'.$cart[$i][0].'</a></td>'."\n".
		 '        <td>'.$cart[$i][1].'</td>'."\n".
		 '        <td align="center">'.$cart[$i][2].'</td>'."\n".
		 '        <td align="right">'.$cart[$i][3].'</td>'."\n".
		 '        <td align="right">'.$cart[$i][4].'</td>'."\n".
		 '    </tr>'."\n";
}
$story .='    <tr>'."\n".
		 '<tr><td colspan="3"></td>'."\n".
		 '<td bgcolor="#D5D5D5">Subtotal</td><td align="right" bgcolor="#D5D5D5">$'.$totals[0].'</td></tr>'."\n".
		 '<tr><td colspan="3"></td>'."\n".
		 '<td bgcolor="#D5D5D5">Tax</td><td align="right" bgcolor="#D5D5D5">$'.$totals[1].'</td></tr>'."\n".
		 '<tr>'."\n";
if($totals[2]=="pickup"){
$story .='<td align="center" colspan="3" bgcolor="#D5D5D5">Item Held For Pickup</td><td bgcolor="#D5D5D5"></td><td align="right" bgcolor="#D5D5D5">$0.00</td></tr>'."\n";
} else {
$story .='<td colspan="3"></td><td bgcolor="#D5D5D5">Shipping</td><td align="right" bgcolor="#D5D5D5">$'.$totals[2].'</td></tr>'."\n";
}
$story .='<tr bgcolor="#D5D5D5">'."\n".
		 '<td align="right" colspan="4"><b>Total Charge</b></td><td align="right"><b>$'.number_format($totals[3],2).'</b></td></tr>'."\n";
if($comments){
$story .='<tr><td colspan="5">'.stripslashes($comments).'</td></tr>'."\n";
}
$hpStory = $story;
$story .='    <tr bgcolor="#9C9C9C"><td colspan="5"></td></tr>'."\n".
		 '    <tr><td colspan="5">Paid With: '.$ccInfo[0].' | xxxx '.substr($ccInfo[1],-4).'</td></tr>'."\n".
		 '    <tr bgcolor="#9C9C9C"><td colspan="5"></td></tr>'."\n".
		 '</table>'."\n".
		 '<table align="center" width="600">'."\n".
		 '<tr><td align="center" class="form"><h1>Thank You Very Much For Your Order!</h1></td></tr>'."\n";
		 '</table>'."\n";
$header="From: homeportonline.com <homeport@homeportonline.com>\r\n";
$header.="Content-Type: text/html; charset=ISO-8859-1\r\n";
// Email the order to customer
mail($billing[10],'Homeport Online Order#'.$visitID,$story,$header);

// this part for homeport email only
$hpStory .='<tr bgcolor="#9C9C9C"><td colspan="5"></td></tr>'."\n".
		   '<tr><td colspan="5">Card Holder: '.$ccInfo[5].' | CVV2 :'.$ccInfo[4].'</td>'."\n".
		   '<tr><td colspan="5">Paid With: '.$ccInfo[0].' | '.$ccInfo[1].' | Exp '.$ccInfo[2].'/'.$ccInfo[3].'</td>'."\n".
		   '<tr bgcolor="#9C9C9C"><td colspan="5"></td></tr>'."\n".
		   '<tr><td colspan="5">Who Will Contact :'.$pickup[2].' at :'.$pickup[1].'</td></tr>'."\n".
           '<tr><td colspan="5">Telephone # '.$billing[9].'</td></tr>'."\n".
		   '</table>'."<br /><br />\n".
           '(__)Responded'."<br />\n".
           '(__)Entered Into The Spreadsheet'."<br />\n".
           '(__)Encrypted And Archived'."<br />\n".
           '(__)Shipped Or Held'."<br />\n".
           '(__)Rung In'."<br />\n".
           'Return Address: '.$billing[10]."<br />\n";
mail($homeportEmail,'Homeport Online Order#'.$visitID,$hpStory,$header);

for($i=0; $i<$cartCount; $i++){
    if($cart[$i][5]){
      // get sold data from registry database
      $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
      $sql = 'SELECT * FROM `reg_items` WHERE `reg_ID`='.$cart[$i][5].' AND `item_ID`='.$cart[$i][0];
      $result = mysqli_query($db, $sql);
		// on update error
		if(!$result){
			echo "Sold Update No Good!<br>";
			echo $sql."<br>";
			echo mysqli_error($db);
			die;
		}      
      $reg=mysqli_fetch_assoc($result);
      // update sold data from registry database
      $sold = $reg['ri_sold'] + $cart[$i][2];
      $sql = "UPDATE `reg_items` SET `ri_sold` = '".$sold."' WHERE ri_ID=".$reg['ri_ID'];
      $result = mysqli_query($db, $sql);
      mysqli_close($db);
    }
}
//Clear the Cart
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.`cart` SET `cart_purch_date` = '".date('Y-m-d')."' WHERE `customer` = '".$visitID."';";
$result = mysqli_query($db, $sql);
if(!$result) {
	echo "Update Cart Failed<br>";
	echo $sql."<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db); //close the connection

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="../secure2013/images/HM.ICO" />
  <title>Secure Checkout</title>
  <meta http-equiv="X-UA-Compatible" content="IE-edge" />
  <link href="cart.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?= $story ?>
<table align="center" width="600">
<?php if($totals[2]=="pickup"){ ?>
<tr>
    <td align="center">
        *For Items to be picked up at the store, please wait for an email confirming stock<br />
        or Call (802) 863-4644 between 10am and 6pm for an immediate confirmation.
    </td>
</tr>
<?php } ?>
<tr><td align="center"><input value="Print This Page" TYPE="button" onClick="window.print()"> <input value="Return To Homeport Online" onclick="window.close()" type="button"></td></tr>
</table>
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