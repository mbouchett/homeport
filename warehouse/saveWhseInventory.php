<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard/');
    die;
  }

$quantity=$_POST['quantity'];
$newItem=$_POST['newItem'];
$button =$_POST['button'];

/*
    <td><input value="<?=$x_qty?>" name="quantity" size="5" maxlength="5" /></td><!-- Quantity -->
    <td><input value="<?=$x_vendor?>" name="newItem[0]" size="20" maxlength="50" /></td><!-- Vendor -->
    <td><input value="<?=$x_sku?>" name="newItem[1]" size="15" maxlength="25" /></td><!-- SKU -->
    <td><input value="<?=$x_price?>" name="newItem[2]" size="15" maxlength="10" /></td><!-- Price -->
    <td><input value="<?=$x_description?>" name="newItem[3]" size="30" maxlength="100" /></td><!-- Description -->
    <td><input value="<?=$x_location?>" name="newItem[4]" size="15" maxlength="25" /></td><!-- Location -->
    <td><input value="<?=$x_picture?>" name="newItem[5]" size="20" maxlength="100" /></td><!-- Picture -->
*/
$newItem[0] = addslashes($newItem[0]);
$newItem[1] = addslashes($newItem[1]);
$newItem[2] = addslashes($newItem[2]);
$newItem[3] = addslashes($newItem[3]);
$newItem[4] = addslashes($newItem[4]);

if($button=="Find Sku"){
  //Check For A Picture
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  $sql = 'SELECT * FROM `items` WHERE `sku` = "'.$newItem[1].'"' ;
  $result = mysqli_query($db, $sql); // create the query object
  $num_results=mysqli_num_rows($result); //How many records meet select
  mysqli_close($db); //close the connection
  if($num_results==0){
    header('Location: addWhseInventory.php?message=SKU Not Found&x_sku='.$newItem[1].'&x_qty='.$quantity);
    die();
  }
  $row=mysqli_fetch_assoc($result);
  $x_price=stripslashes($row['retail']);
  $x_picture = $row['pic'];
  $x_description=stripslashes($row['description']);

  //Get Vendor Name
  $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
  $sql = 'SELECT `name` FROM `vendors` WHERE `number` LIKE"%'.trim($row['vendor']).'%"' ;          //Create The Search Query
  $result = mysqli_query($db, $sql);          //Initiate The Query
  mysqli_close($db);                          //Close The Connection
  $vendors=mysqli_fetch_assoc($result);       //Fetch The Current Record
  $x_vendor=trim($vendors['name']);
 // echo 'addWhseInventory.php?x_vendor='.$x_vendor.'&x_price='.$x_price.'&x_description='.$x_description.'&x_picture='.$x_picture.'&x_sku='.$newItem[1];
 // exit;
  header('Location: addWhseInventory.php?x_vendor='.$x_vendor.'&x_price='.$x_price.'&x_description='.$x_description.'&x_picture='.$x_picture.'&x_sku='.$newItem[1]);
  die();
}

if(!$newItem[1]||!$quantity){
  header('Location: addWhseInventory.php?message=SKU AND QUANTITY REQUIRED&x_sku='.$newItem[1].'&x_qty='.$quantity);
  die();
}
//echo $newItem['1']."<br>";
//echo $row['pic']."<br>";
for($i=0; $i<$quantity; $i++){
//  echo $newItem[0].'-'.$newItem[1].'-'.$newItem[2].'-'.$newItem[3].'-'.$newItem[4].'-'.$newItem[5].'-'.$newItem[6]."<br>\n";


      // save to database
      $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
      	//create insert string
      $sql = "INSERT INTO `".$db_db."`.`whseInv` (`vendor`, `sku`, `price`, `description`, `location`, `picture`, `category`)
              VALUES ('$newItem[0]', '$newItem[1]', '$newItem[2]', '$newItem[3]', '$newItem[4]', '$newItem[5]', '$newItem[6]')";
      	//perform action
      $result = mysqli_query($db, $sql); // create the query object


}
// exit;
	//close the connection
mysqli_close($db);

header('Location: ../warehouse/addWhseInventory.php?message=Added '.$quantity.' '.$newItem[3].'-'.date('l jS \of F Y h:i:s A').'&cLoc='.$newItem[4].'&cDes='.$newItem[3].'&cPic='.$newItem[5].'&cQty='.$quantity);
//die();
?>