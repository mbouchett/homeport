<?php
//includes
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');
// Establish Variables
$visitID=$_COOKIE['visitID'];
$cart=$_POST['cart'];   // $cart[x][0]  -> quantity
                        // $cart[x][1]  -> delete status
                        // $cart[x][2]  -> cart.recno

// if the cart has not been established (this will be improved later)
if(!$visitID){
  echo '...You have not been assigned a cart. If you feel that you received this message in error<br/>';
  echo 'please contact (802) 863-4644<br/>';
  echo '<a href="http://www.homeportonline.com/store2009/categories/">Find Cool Stuff!</a>';
  exit;
}

$qtyCount=count($cart);

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the updates
for($i=0; $i<$qtyCount; $i++){
    $sql = "UPDATE `".$db_db."`.`cart`
        SET `cart_qty` = '".$cart[$i][0]."'
         WHERE `cart_ID` = '".$cart[$i][2]."';";
    $result = mysqli_query($db, $sql); // create the query object
    if($cart[$i][0]==0) $cart[$i][1] ='on'; // if the quantity was set to 0 then delete the item
}

//perform deletes
for($i=0; $i<$qtyCount; $i++){
	if($cart[$i][1]){
		$sql = "DELETE FROM `cart` WHERE `cart_ID` = '".$cart[$i][2]."';";
		$result = mysqli_query($db, $sql); // create the query object
	}
}
mysqli_close($db); //close the connection
header('Location: viewCart.php');
?>