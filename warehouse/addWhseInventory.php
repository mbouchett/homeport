<?php
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$message=$_REQUEST['message'];
$x_vendor=$_REQUEST['x_vendor'];
$x_price=$_REQUEST['x_price'];
$x_description=$_REQUEST['x_description'];
$x_picture=$_REQUEST['x_picture'];
$x_sku=$_REQUEST['x_sku'];
$x_qty=$_REQUEST['x_qty'];
$cLoc=$_REQUEST['cLoc'];
$cDes=$_REQUEST['cDes'];
$cQty=$_REQUEST['cQty'];
$cPic=$_REQUEST['cPic'];

//Load categories Into Array
$fp = fopen('data/categories.txt', "r");
// get the categories records and store them in the cats array
$i=0;
while (!feof($fp)) {
    $item= fgets($fp);
    $cats[$i] =trim($item);
    $i++;
    }
fclose($fp);         		//close the categories file
sort($cats);    			//Sort the records on category name
$catCount=count($cats); 	//How many categories in the list
include "../functions/f_resolve.php";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Add Items</title>
</head>

<body>
<br /><br />
<div align="center" style="font-size: 18px; font-weight: bold">Add Items to Warehouse Inventory</div>
<form action="saveWhseInventory.php" method="POST">
<table align="center" border="4" bordercolor="#808000">
  <tr>
    <td>Qty</td>
    <td>Vendor</td>
    <td>Sku</td>
    <td>Price</td>
    <td>Description</td>
    <td>Location</td>
    <td>Picture</td>
    <td>Category</td>
  </tr>
  <tr>
    <td><input value="<?=$x_qty?>" name="quantity" size="5" maxlength="5" /></td><!-- Quantity -->
    <td><input value="<?=$x_vendor?>" name="newItem[0]" size="20" maxlength="50" /></td><!-- Vendor -->
    <td><input value="<?=$x_sku?>" name="newItem[1]" size="15" maxlength="25" /></td><!-- SKU -->
    <td><input value="<?=$x_price?>" name="newItem[2]" size="15" maxlength="10" /></td><!-- Price -->
    <td><input value="<?=$x_description?>" name="newItem[3]" size="30" maxlength="100" /></td><!-- Description -->
    <td><input value="<?=$x_location?>" name="newItem[4]" size="15" maxlength="25" /></td><!-- Location -->
    <td><input value="<?=$x_picture?>" name="newItem[5]" size="20" maxlength="100" /></td><!-- Picture -->
    <td><select name="newItem[6]" size="1">
    <?php for($i=0; $i<$catCount; $i++){
        $selected='';
        if(trim($cats[$i])==trim($x_category)) $selected='selected="selected"';
    ?>

    <option <?=$selected?> value="<?=$cats[$i]?>"><?=$cats[$i]?></option>

    <?php } ?>
    </select></td><!-- Category -->
  </tr>
  <tr>
    <td align="center" colspan="8"><input name="button" type="submit" value="Find Sku" /> <input name="button" type="submit" value="Add Items" /></td>
  </tr>
  <tr><td align="center" colspan="8">
    <input value="&nbsp;&nbsp;&nbsp;&nbsp;Edit Inventory&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='searchEdit.php'" type="button">
    <input value="Return To Dashboard" onclick="parent.location='adminDashboard.php'" type="button">
    <input value="Dashboard" onclick="parent.location='../dashboard/'" type="button">
  </td></tr>
</table>
</form>
<br /><br />
<?php
if($message){
    $mColor="009900";
    if($message=="SKU AND QUANTITY REQUIRED") $mColor="990000"; // if this is the message then make it red
    if($message=="SKU Not Found") $mColor="000099"; // if this is the message then make it Blue
    ?>
    <table align="center" border="4" bordercolor="#808000">
    <tr><td align="center" colspan="8"><div style="font-weight: bold; color: #'.$mColor.'"><?= $message ?></div></td></tr>
    <?php unset($message); ?>
      <tr>
        <td colspan="2">How Many</td><td colspan="2">Picture</td><td colspan="2">Description</td><td colspan="2">Added Where</td>
      </tr>
      <tr bgcolor="#99FF33">
        <td colspan="2" ><div align="center" style="font-size: 60px"><?=$cQty?></div></td>
        <td colspan="2" align="center"><img height="150" border="0" src="<?=resolve($cPic)?>"></td>
        <td colspan="2"><div align="center" style="font-size: 24px"><?=stripslashes($cDes)?></div></td>
        <td colspan="2"><div align="center" style="font-size: 24px"><?=stripslashes($cLoc)?></div></td>
      </tr>
    </table>
<?php    } ?>

</body>

</html>