<?php
//includes
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
$bgcolor=$_REQUEST['bgcolor'];
$message=$_REQUEST['message'];
$shipping=$_REQUEST['shipping'];
if($shipping && $shipping != "pickup") $shipping=$shipping/100;
if(!$shipping)$shipping = -2;
$totalOrder=0;
$visitID=$_REQUEST['visitID'];
$zipCode=$_REQUEST['zipCode'];
if(!$bgcolor) $bgcolor="FFFFFF";
// load the cart data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart`
		  LEFT JOIN `items` USING(`item_ID`)
		  WHERE `customer` = \''.trim($visitID).'\' AND `cart_purch_date` IS NULL ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
//if($result){
    $cart_results=mysqli_num_rows($result);
    unset($regnum);
    //store the results to the $cart array
    for($i=0;$i<$cart_results; $i++){
        $cart[$i]=mysqli_fetch_assoc($result);
        if($cart[$i]['regnum']) $regnum=$cart[$i]['regnum'];
    }
//}
if($regnum){
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID`='.$regnum;
$result = mysqli_query($db, $sql);
mysqli_close($db);

//load the result into an associative array
if($result) $row=mysqli_fetch_assoc($result);

$r[0]=stripslashes($row['reg_partner1F']);
$r[1]=stripslashes($row['reg_partner2F']);
if($regnum) $r[8]=$r[0].' & '.$r[1];
$r[2]=stripslashes($row['reg_postaddr01']);
$r[3]=stripslashes($row['reg_postaddr02']);
$r[4]=stripslashes($row['reg_postaddr03']);
$r[5]="-";
$r[6]="On File";
$r[7]=stripslashes($row['reg_email01']);
    for($i=0; $i<7; $i++){
      if(!$r[$i]) $r[$i]="On File";
    }
}
$cartCount=count($cart);

if($shipping!="pickup" && $cartCount == 1 && substr($cart[0]['description'],-9) == "Gift Card") $shipping = 3.5
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="SHORTCUT ICON" href="../secure2013/images/HM.ICO" />
  <title>Secure Checkout</title>
  <meta http-equiv="X-UA-Compatible" content="IE-edge" />
  <link href="css/cart.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function data_copy()
{
      if(document.getElementById("copy").checked){
      document.getElementById("s0").value=document.getElementById("b0").value;
      document.getElementById("s1").value=document.getElementById("b1").value;
      document.getElementById("s2").value=document.getElementById("b2").value;
      document.getElementById("s3").value=document.getElementById("b3").value;
      document.getElementById("s4").value=document.getElementById("b4").value;
      document.getElementById("s5").value=document.getElementById("b5").value;
      document.getElementById("s6").value=document.getElementById("b6").value;
      document.getElementById("s7").value=document.getElementById("b7").value;
      document.getElementById("s8").value=document.getElementById("b8").value;
      document.getElementById("s9").value=document.getElementById("b9").value;
      document.getElementById("s10").value=document.getElementById("b10").value;
      }else{
      document.getElementById("s0").value="";
      document.getElementById("s1").value="";
      document.getElementById("s2").value="";
      document.getElementById("s3").value="";
      document.getElementById("s4").value="";
      document.getElementById("s5").value="";
      document.getElementById("s6").value="";
      document.getElementById("s7").value="";
      document.getElementById("s8").value="";
      document.getElementById("s9").value="";
      document.getElementById("s10").value="";
      }
}
function chkbut()
{
      document.getElementById("checkbut").style.display  = "none";
      document.getElementById("credit").style.display  = "inline";
}
function checkForm()
{
        var go=0;
        if (!document.getElementById("b0").value)
        {
          go++;
          document.getElementById("b0").style.backgroundColor = "#FF9999";
        } else document.getElementById("b0").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b1").value)
        {
          go++;
          document.getElementById("b1").style.backgroundColor = "#FF9999";
        }else document.getElementById("b1").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b3").value)
        {
          go++;
          document.getElementById("b3").style.backgroundColor = "#FF9999";
        }else document.getElementById("b3").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b5").value)
        {
          go++;
          document.getElementById("b5").style.backgroundColor = "#FF9999";
        }else document.getElementById("b5").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b6").value)
        {
          go++;
          document.getElementById("b6").style.backgroundColor = "#FF9999";
        }else document.getElementById("b6").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b7").value)
        {
          go++;
          document.getElementById("b7").style.backgroundColor = "#FF9999";
        }else document.getElementById("b7").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b8").value)
        {
          go++;
          document.getElementById("b8").style.backgroundColor = "#FF9999";
        }else document.getElementById("b8").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b9").value)
        {
          go++;
          document.getElementById("b9").style.backgroundColor = "#FF9999";
        }else document.getElementById("b9").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("b10").value)
        {
          go++;
          document.getElementById("b10").style.backgroundColor = "#FF9999";
        }else document.getElementById("b10").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("cc1").value)
        {
          go++;
          document.getElementById("cc1").style.backgroundColor = "#FF9999";
        }else document.getElementById("cc1").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("cc4").value)
        {
          go++;
          document.getElementById("cc4").style.backgroundColor = "#FF9999";
        }else document.getElementById("cc4").style.backgroundColor = "#FFFFFF";

        if (!document.getElementById("cc5").value)
        {
          go++;
          document.getElementById("cc5").style.backgroundColor = "#FF9999";
        }else document.getElementById("cc5").style.backgroundColor = "#FFFFFF";

        document.getElementById("cc1").focus();

        if(go == 0) // the form is verified
        {

          try{
          //alert("verify - "+go);
          if(document.getElementById("s0").value=="") document.getElementById("s0").value=document.getElementById("b0").value;
          if(document.getElementById("s1").value=="") document.getElementById("s1").value=document.getElementById("b1").value;
          if(document.getElementById("s2").value=="") document.getElementById("s2").value=document.getElementById("b2").value;
          if(document.getElementById("s3").value=="") document.getElementById("s3").value=document.getElementById("b3").value;
          if(document.getElementById("s4").value=="") document.getElementById("s4").value=document.getElementById("b4").value;
          if(document.getElementById("s5").value=="") document.getElementById("s5").value=document.getElementById("b5").value;
          if(document.getElementById("s6").value=="") document.getElementById("s6").value=document.getElementById("b6").value;
          if(document.getElementById("s7").value=="") document.getElementById("s7").value=document.getElementById("b7").value;
          if(document.getElementById("s8").value=="") document.getElementById("s8").value=document.getElementById("b8").value;
          if(document.getElementById("s9").value=="") document.getElementById("s9").value=document.getElementById("b9").value;
          if(document.getElementById("s10").value=="") document.getElementById("s10").value=document.getElementById("b10").value;
          }
          catch(err){
          var booger = "Not Sure What Happened";
          }
          document.form1.submit();
        }else
        {
          alert("Please fill in all Hilighted fields!");
        }
}
</script>
</head>
<body>
<div align="center">
<div id="banner" >
  <a href="../index.php"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <img class="cartpic" src="../images/shopping_cart.png" />

</div>
</div><br />
<h2>Homeport Shopping Cart</h2>
<br />
<form name="form1" action="processOrder.php" method="post">
<table align="center" width="700" cellpadding="2">
<tr class="bigwhite" bgcolor="#4a4a4a"><td width="100">Item</td><td>Description</td><td width="50">Qty</td><td align="center" width="60">Price</td><td align="center" width="65">Total</td></tr>
<?php for($i=0;$i<$cartCount; $i++){
 unset($regDat);
 if($cart[$i]['regnum']) $regDat='(Reg#'.$cart[$i]['regnum'].')';
 if($cart[$i]['dept_ID']=="22") $nonTax=$nonTax+($cart[$i]['cart_qty']*$cart[$i]['cart_retail']); // total non-taxable items
 $totalOrder=$totalOrder+($cart[$i]['cart_qty']*$cart[$i]['cart_retail']);
?>
 <input type="hidden" name="cart[<?= $i?>][5]" value="<?= $regDat ?>" />
	<tr class="bigblack">
    	<td><?=$cart[$i]['item_ID']?><input type="hidden" name="cart[<?= $i ?>][0]" value="<?= $cart[$i]['item_ID'] ?>" /></td>
        <td><?= $cart[$i]['item_desc'] ?><?= $regDat ?><input type="hidden" name="cart[<?= $i ?>][1]" value="<?= $cart[$i]['item_desc'] ?><?= $regDat ?>" /></td>
    	<td><?= $cart[$i]['cart_qty'] ?><input type="hidden" name="cart[<?= $i ?>][2]" value="<?= $cart[$i]['cart_qty'] ?>" /></td>
        <td align="right"><?= $cart[$i]['cart_retail'] ?><input type="hidden" name="cart[<?= $i ?>][3]" value="<?= $cart[$i]['cart_retail'] ?>" /></td>
        <td align="right"><?= number_format($cart[$i]['cart_qty']*$cart[$i]['cart_retail'],2) ?>
            <input type="hidden" name="cart[<?= $i ?>][4]" value="<?= $cart[$i]['cart_qty']*$cart[$i]['cart_retail'] ?>" />
            <input type="hidden" name="cart[<?= $i ?>][5]" value="<?= $cart[$i]['regnum'] ?>" />
            </td>
    </tr>
<?php }
$tax=number_format(($totalOrder-$nonTax)*.07,2);
?>
	<tr height="2" bgcolor="#4a4a4a"><td colspan="5"></td></tr>
	<tr class="bigblack2"><td align="right" colspan="4">Total</td><td align="right">$<?= number_format($totalOrder,2) ?>
        <input type="hidden" name="totals[0]" value="<?= number_format($totalOrder,2) ?>" />
        </td></tr>
	<tr class="bigblack2"><td align="right" colspan="4">Tax</td><td align="right">$<?= number_format($tax,2) ?>
        <input type="hidden" name="totals[1]" value="<?= $tax ?>" />
        </td></tr>
    <?php if($shipping=="pickup"){ ?>
	<tr>
    	<td align="right" colspan="4"><span style="font-family:Arial Black, Helvetica, sans-serif; color:#0000FF">You have opted to have your items held for in-store pickup</span></td>
        <input type="hidden" name="totals[2]" value="pickup" />
        <input name="totals[3]" type="hidden" value="<?= $totalOrder+$tax ?>" />

    </tr>
 	<tr class="bigblack3">
    	<td align="right" colspan="4">Your Total Charge Will Be</td><td align="right">$<?= number_format($totalOrder+$tax,2) ?></td>
    </tr>
    <?php } ?>

    <?php if($shipping == -.01){ ?>

	<tr>
    	<td align="right" colspan="4"><span style="font-family:Arial Black, Helvetica, sans-serif; color:#FF0000">Unable To Ship To This Location</span></td><td></td>
    </tr>
 	<tr>
    	<td align="right" colspan="4"><span style="font-family:Arial, Helvetica, sans-serif; font-weight:bold">Please Contact the store for further information or enter another Zip Code</span></td></td>
    </tr>
    <?php  } ?>

    <?php if($shipping==2.5){ ?>
	<tr>
    	<td align="right" colspan="4"><span style="font-family:Arial Black, Helvetica, sans-serif; color:#FF0000">Unable To Ship To This Location</span></td><td></td>
    </tr>
 	<tr>
    	<td align="right" colspan="4"><span style="font-family:Arial, Helvetica, sans-serif; font-weight:bold">Please Contact the store for further information or enter another Zip Code</span></td></td>
    </tr>
    <?php  } ?>
    <?php if($shipping>2.5){ ?>
		<tr class="bigblack2"><td colspan="4" align="right">Shipping</td><td align="right">$<?= number_format($shipping,2) ?>
        <input type="hidden" name="totals[2]" value="<?= $shipping ?>" />
        </td></tr>
 	<tr class="bigblack3">
    	<td align="right" colspan="4">Your Total Charge Will Be: </td>
        <td align="right">$<?= number_format($totalOrder+$tax+$shipping,2) ?>
        <input name="totals[3]" type="hidden" value="<?= $totalOrder+$tax+$shipping ?>" /></td>
    </tr>
    <?php } ?>
    <tr height="2" bgcolor="#4a4a4a"><td colspan="5"></td></tr>
    <!-- Christmas Cut-Off Message -->
    <!--<tr><td style="font-weight: bold; color: #990033" colspan="5">Orders Placed After December 16th Cannot Be Guaranteed to arrive before December 25th</td></tr>-->
</table>

<!-- This part gets the shipping and payment data -->
<?php if($shipping >=0) { ?>
<div id="checkbut"><a class="button3" onclick="chkbut()" >Continue To Checkout</a></div>
<br />
<?php } ?>
<?php if($message) { ?>
    <script type="text/javascript">
    chkbut();
    </script>
<?php } ?>
<div id="credit">
<table align="center" width="700" cellpadding="2" bgcolor="#BBBBBB">
    <tr>
        <td ><img src="images/cclogos.jpg" /> 
        <?php if($message) { ?>
        	<span style=" font-size:16px; font-weight:bold; color:#FF0000"><?= $message ?></span>
        <?php } ?>
        </td>
        <td rowspan="3" >
            <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=Dm0zbGkRNI0OXhkxhHC8ho9gDHjRg4kQNoBfErlo4Bx6z1rJNeRau8K5vggu"></script></span>
        </td>

    </tr>
    <tr>
        <td class="form" >Card Type*
            <select style="background-color:#<?= $bgcolor ?>" name="CC[0]" size="1">
            <option selected="selected" value="visa">Visa</option>
            <option value="mc">Mastercard</option>
            <option value="discover">Discover</option>
            <option value="amex">American Express</option>
            </select>
             Card#*<input style="background-color:#<?= $bgcolor ?>" name="CC[1]" id="cc1" />
             Expiry Date:*
             <select style="background-color:#<?= $bgcolor ?>" name="CC[2]" size="1">
             <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option>
             <option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option>
             <option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
             </select>
             <select style="background-color:#<?= $bgcolor ?>" name="CC[3]" size="1">
             <option value="<?= date('Y') ?>"><?= date('Y') ?></option><option value="<?= date('Y')+1 ?>"><?= date('Y')+1 ?></option>
             <option value="<?= date('Y')+2 ?>"><?= date('Y')+2 ?></option><option value="<?= date('Y')+3 ?>"><?= date('Y')+3 ?></option>
             <option value="<?= date('Y')+4 ?>"><?= date('Y')+4 ?></option><option value="<?= date('Y')+5 ?>"><?= date('Y')+5 ?></option>
             <option value="<?= date('Y')+6 ?>"><?= date('Y')+6 ?></option><option value="<?= date('Y')+7 ?>"><?= date('Y')+7 ?></option>
             <option value="<?= date('Y')+8 ?>"><?= date('Y')+8 ?></option><option value="<?= date('Y')+9 ?>"><?= date('Y')+9 ?></option>
             </select>

        </td>
    </tr>
    <tr>
        <td class="form">
            CVV2 Code*<input style="background-color:#<?= $bgcolor ?>" name="CC[4]" size="3" id="cc4" /> Name On Card:*<input style="background-color:#<?= $bgcolor ?>" name="CC[5]" size="30" id="cc5" />
        </td>
    </tr>
</table>

<table align="center" width="700" cellpadding="2" border="1"><tr>
<td align="center">
Payment Information
<table align="center">
    <tr><td class="form" align="left"><b>Billing Address</b></td><td></td></tr>
    <tr><td class="form" align="left">First Name:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b0" name="b[0]" size="30"  /></td></tr>
    <tr><td class="form" align="left">Last Name:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b1" name="b[1]" size="30" /></td></tr>
    <tr><td class="form" align="left">Company Name: </td><td><input id="b2" name="b[2]" size="30" /></td></tr>
    <tr><td class="form" align="left">Address:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b3" name="b[3]" size="30" /></td></tr>
    <tr><td class="form" align="left">Address2: </td><td><input id="b4" name="b[4]" size="30" /></td></tr>
    <tr><td class="form" align="left">City:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b5" name="b[5]" size="30" /></td></tr>
    <tr><td class="form" align="left">State:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b6" name="b[6]" size="30" /></td></tr>
    <tr><td class="form" align="left">Zip Code:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b7" name="b[7]" size="30" /></td></tr>
    <tr><td class="form" align="left">Country:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b8" name="b[8]" size="30" value="USA" /></td></tr>
    <tr><td class="form" align="left">Telephone #*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b9" name="b[9]" size="30" /></td></tr>
    <tr><td class="form" align="left">Email:*</td><td><input style="background-color:#<?= $bgcolor ?>" id="b10" name="b[10]" size="30" /></td></tr>
</table>
</td>
<td align="center">
<table align="center">
    <?php if($shipping=="pickup"){
    $fn="";
    if($r[0]) $fn=$r[0].' & '.$r[1];
    ?>
        Pickup Information
    <tr height="2" bgcolor="#D5D5D5"><td colspan="2"></td></tr>
    <tr><td class="form" align="left" colspan="2"><b>Hold For:</b></td></tr>
    <tr><td class="form" align="left">Name:*</td><td><input style="background-color:#<?= $bgcolor ?>" name="p[0]" size="30" value="<?= $r[8] ?>" /></td></tr>
    <tr><td class="form" align="left">Phone or Email<br /><span style="font-size: 10px">(not necessary for registry)</span>:</td><td><input name="p[1]" size="30" /></td></tr>
    <tr><td class="form" align="center" colspan="2"><input type="radio" value="Please Contact" name="p[2]" checked="checked" />Please Contact Recipient For Me</td></tr>
    <tr><td class="form" align="center" colspan="2"><input type="radio" value="Do Not Contact" name="p[2]" />I Will Contact Recipient Myself</td></tr>
    <tr height="2" bgcolor="#D5D5D5"><td colspan="2"></td></tr>
    <?php }else{ ?>

    <tr><td class="form" align="left" colspan="2"><b>Shipping Address(If Different)</b> (same as billing <input type="checkbox" id="copy" onclick="data_copy()"/>)</td></tr>
    <tr><td class="form" align="left">First Name:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s0" name="s[0]" size="30" value="<?= $r[8] ?>" /></td></tr>
    <tr><td class="form" align="left">Last Name:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s1" name="s[1]" size="30" value="<?= $r[5] ?>"/></td></tr>
    <tr><td class="form" align="left">Company Name: </td><td><input id="s2" name="s[2]" size="30" /></td></tr>
    <tr><td class="form" align="left">Address:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s3" name="s[3]" size="30" value="<?= $r[2] ?>" /></td></tr>
    <tr><td class="form" align="left">Address2: </td><td><input id="s4" name="s[4]" size="30" value="<?= $r[3] ?>" /></td></tr>
    <tr><td class="form" align="left">City:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s5" name="s[5]" size="30" value="<?= $r[4] ?>" /></td></tr>
    <tr><td class="form" align="left">State:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s6" name="s[6]" size="30" value="<?= $r[5] ?>" /></td></tr>
    <tr><td class="form" align="left">Zip Code:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s7" name="s[7]" value="<?= $r[7] ?>" /></td></tr>
    <tr><td class="form" align="left">Country:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s8" name="s[8]" size="30" value="USA" /></td></tr>
    <tr><td class="form" align="left">Telephone #</td><td><input style="background-color:#<?= $bgcolor ?>" id="s9" name="s[9]" size="30" value="<?= $r[6] ?>" /></td></tr>
    <tr><td class="form" align="left">Email:</td><td><input style="background-color:#<?= $bgcolor ?>" id="s10" name="s[10]" size="30" value="<?= $r[6] ?>" /></td></tr>
    <?php } ?>
</table>
</td>
</tr>
<tr>
    <td align="center" colspan="2">
        Order Comments or Note to Include:<br />
        <textarea name="comments" rows="2" cols="60"></textarea>
    </td>
</tr>
<tr><td align="center" colspan="2"><a class="button2" onClick="checkForm()">Submit Your Order Now</a></td></tr>
</table>
<input type="hidden" name="visitID" value="<?= $visitID ?>" />
</div>
</form>
<!-- This part figures out the shipping rate -->
<br />
<form name="rate" action="rateQuote.php" method="post">
<table align="center" width="480" cellpadding="2">
    <tr>
        <td align="right">
            USA ZIP Code <input name="zip" type="text" size="5" />
        </td>
        <td>
            <a class="button" onClick="document.rate.submit()">Calculate Shipping</a>
        </td>
        <td title="Homeport (802) 863-4644"><span style="font-size: 10px; color: #000000">Foreign Shipments Please<br />Contact Store</span></td>
    </tr>
</table>
<input name="visitID" type="hidden" value="<?= $visitID ?>" />
<input name="totalOrder" type="hidden" value="<?= $totalOrder ?>" />
</form>
<table align="center" width="450" cellpadding="2">
	<tr>
    	<td align="center">

            <a class="button" onclick="parent.location='../cart2013/viewCart.php'; return false">&lt; Go Back to Edit Cart</a>

            <a class="button" onclick="parent.location='checkOut.php?shipping=pickup&visitID=<?= $visitID ?>'; return false">Hold For Pickup</a>
        </td>
    </tr>
</table>
<?php if($message){?>
<br />
<table align="center" border="4" style="border-color: #FF0000">
    <tr><td><div align="center" style="font-size: 20px; color: #000000; font-family: Arial Black"><?=$message?></div></td></tr>
</table>
<?php  }?>
</body>
</html>
