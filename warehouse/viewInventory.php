<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";
include "../functions/f_resolve.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard/');
    die;
  }

//Establish Variables
$message=$_REQUEST['message'];
$rootLoc=$_SESSION['rootLoc'];
$catSelected=$_REQUEST['catSelected'];
$order=$_REQUEST['order'];

if(!$order) $order="vendor";

//Load categories Into Array
$fp = fopen($rootLoc.'data/categories.txt', "r");
// get the categories records and store them in the cats array
$i=0;
while (!feof($fp)) {
    $item= fgets($fp);
    $cats[$i] =$item;
    $i++;
    }
fclose($fp);         		//close the categories file
sort($cats);    			//Sort the records on category name
$catCount=count($cats); 	//How many categories in the list

if(!$catSelected) $catSelected=trim($cats[0]);

//do the database stuff
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `whseInv` WHERE `category` LIKE \''.$catSelected.'\' ORDER BY `'.$order.'`, `sku`' ;
//echo $sql;
//exit;
$result = mysqli_query($db, $sql); // create the query object

if($result) {
	$num_results=mysqli_num_rows($result); //How many records meet select
}
mysqli_close($db); //close the connection

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<STYLE TYPE="text/css">
     <!--
     A:visited { color: black; text-decoration: none; background: transparent;}
     A:link { color: black; text-decoration: underline; background: transparent;}
     A:active { color: black; text-decoration: underline; background: transparent;}
     A:hover { color: orange; text-decoration: underline; background: transparent;}
     -->
</STYLE>


  <link rel="SHORTCUT ICON" href="../images/278.ico">
  <title> View Inventory</title>
  <?php include '../popstyle.php'; ?>

</head>
<body>
<!-- header bar -->
<div align="center" style="font-size: 20px; font-family: Arial Black">Warehouse Inventory</div>
<table align="center" cellspacing="4">
  <tr>
    <?php for($i=0; $i<$catCount; $i++){
      if(trim($catSelected)==trim($cats[$i])){
        $bgc='#00FF00'; // Active
      }else{
        $bgc='#FFD700'; // Not Active
      } ?>
    <td align="center" width="90" bgcolor="<?=$bgc?>"><a style=" text-decoration: none" href="<?=$rootLoc?>viewInventory.php?catSelected=<?=$cats[$i]?>"  ><?=$cats[$i]?></a></td>
    <?php } ?>
  </tr>
</table>

<!-- Go to a specific page -->
<center><input value="Search Inventory" onclick="parent.location='http://www.homeportonline.com/warehouse/searchInventory.php'" type="button"></center>

<form action="<?=$rootLoc?>userUpdate.php" method="post" >
<table align="center" border="4" bordercolor="#B8860B">
    <tr><td>Picture</td>
        <td><a style=" text-decoration: none" href="<?=$rootLoc?>viewInventory.php?catSelected=<?=$catSelected?>&order=vendor">Vendor</a></td>
        <td><a style=" text-decoration: none" href="<?=$rootLoc?>viewInventory.php?catSelected=<?=$catSelected?>&order=sku">Sku</a></td>
        <td>Price</td>
        <td><a style=" text-decoration: none" href="<?=$rootLoc?>viewInventory.php?catSelected=<?=$catSelected?>&order=description">Description</a></td></td>
        <td>Location</td><td>Date Purchased</td><td>Purchased By</td><td>Employee</td><td>Comment</td><td>PU</td></tr>
    <?php
      for($i=0; $i<$num_results; $i++){
        $row=mysqli_fetch_assoc($result);
        $rowcolor="#FFFFFF";
        $clean_desc = preg_replace('/[^a-zA-Z0-9\s ]/','',stripslashes($row['description'])); //strip punctuation from description
        if(substr($row['comment'],0,6) == "Verify") $rowcolor="#FFFF66";
        if($row['purchased'] || $row['employee'] || $row['customer']) $rowcolor="#FFCCFF";
        //echo '<center>'.stripslashes($row['sku']).' - '.stripslashes($row['description']).'</center>'."\n";
    ?>
    <tr bgcolor="<?= $rowcolor ?>">
      <td><input type="hidden" name="record[<?=$i?>][6]" value="<?=stripslashes($row['picture'])?>" />
            <?php if($row['picture']) { ?>
            <a class="thumbnail" href="#thumb">
            <img style="max-height: 25px; max-width: 100px" border="0" src="<?= resolve($row['picture']) ?>"  />
            <span><img src="<?= resolve($row['picture']) ?>"/></span>
            </a>
            <?php } ?>
      </td>
      <td><input type="hidden" name="record[<?=$i?>][1]" value="<?=stripslashes($row['vendor'])?>" /><?=stripslashes($row['vendor'])?></td>
      <td title="<?=stripslashes($row['category'])?>"><input type="hidden" name="record[<?=$i?>][2]" value="<?=stripslashes($row['sku'])?>" /><?=stripslashes($row['sku'])?></td>
      <td><input type="hidden" name="record[<?=$i?>][3]" value="<?=stripslashes($row['price'])?>" /><?=stripslashes($row['price'])?></td>
      <td><input type="hidden" name="record[<?=$i?>][4]" value="<?=stripslashes($row['description'])?>" /><?=stripslashes($row['description'])?></td>
      <td><input type="hidden" name="record[<?=$i?>][5]" value="<?=stripslashes($row['location'])?>" /><?=stripslashes($row['location'])?></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="record[<?=$i?>][7]" type="text" size="15" value="<?=stripslashes($row['purchased'])?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="record[<?=$i?>][8]" type="text" size="15" value="<?=stripslashes($row['customer'])?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="record[<?=$i?>][9]" type="text" size="15" value="<?=stripslashes($row['employee'])?>" /></td>
      <td><input style="background-color: <?= $rowcolor ?>" name="record[<?=$i?>][10]" type="text" size="25" value="<?=stripslashes($row['comment'])?>" /></td>
      <td>
      <?php if($rowcolor=="#FFCCFF"){ ?>
        <input type="button" value="PU"
        onclick="window.open('../dashboard/sms.php?cust=<?= trim($row['customer']) ?>&comp=<?= trim($row['vendor']) ?>&sku=<?= trim($row['sku']) ?>&desc=<?= trim($clean_desc) ?>&user=<?= trim($row['employee']) ?>', 'newwindow')" />
      <?php  }?>
      </td>
    </tr>
    <input type="hidden" name="record[<?=$i?>][11]" value="<?=stripslashes($row['category'])?>" />
    <input type="hidden" name="record[<?=$i?>][0]" value="<?=stripslashes($row['recno'])?>" />
    <?php }

if($message)
    echo '<tr><td align="center" colspan="11"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
    <tr><td align="center" colspan="11"><input name="" type="submit" value="Save Any Changes" /> <input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='../dashboard/'" type="button"></td></tr>
</table>
<input type="hidden" name="catSelected" value="<?=$catSelected?>" />
<input type="hidden" name="referPage" value="category" />
</form>
</body>

</html>