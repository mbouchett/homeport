<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";
include "../functions/f_resolve.php";
date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//Establish Variables
$message=$_REQUEST['message'];
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
$sql = 'SELECT * FROM `whseInv` WHERE `category` LIKE "%'.$catSelected.'%" ORDER BY `'.$order.'`, `sku`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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


  <link rel="SHORTCUT ICON" href="http://www.homeportonline.com/images/278.ico">
  <title> Edit Inventory</title>

  <script type="text/javascript">
var newwindow;
function poptastic(url)
{
newwindow=window.open(url,'name','height=360,width=360');
if (window.focus) {newwindow.focus()}
}
  </script>

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
    <td align="center" width="90" bgcolor="<?=$bgc?>"><a style=" text-decoration: none" href="editInventory.php?catSelected=<?=$cats[$i]?>"  ><?=$cats[$i]?></a></td>
    <?php } ?>
  </tr>
</table>

<!-- Go to a specific page -->
<center><input value="Search Inventory" onclick="parent.location='../warehouse/searchEdit.php'" type="button"></center>

<form action="adminUpdate.php" method="post" >
<table align="center" border="4" bordercolor="#B8860B">
    <tr><td>Vendor</td><td>Sku</td><td>Price</td><td>Description</td><td>Location</td><td>Picture</td><td>Purchased On</td><td>Purchased By</td><td>Employee</td><td>Comment</td><td>Category</td><td>Del</td></tr>
    <?php
      for($i=0; $i<$num_results; $i++){
        $row=mysqli_fetch_assoc($result); //
        //echo '<center>'.stripslashes($row['sku']).' - '.stripslashes($row['description']).'</center>'."\n";
    ?>
    <tr>
      <input name="record[<?=$i?>][0]" type="hidden" value="<?=stripslashes($row['recno'])?>" />
      <td><input name="record[<?=$i?>][1]" type="text" size="10" value="<?=stripslashes($row['vendor'])?>" /></td>
      <td title="<?= stripslashes($row['category']) ?>"><input name="record[<?=$i?>][2]" type="text" size="15" value="<?=stripslashes($row['sku'])?>" /></td>
      <td><input name="record[<?=$i?>][3]" type="text" size="5" value="<?=stripslashes($row['price'])?>" /></td>
      <td><input name="record[<?=$i?>][4]" type="text" size="30" value="<?=stripslashes($row['description'])?>" /></td>
      <td><input name="record[<?=$i?>][5]" type="text" size="10" value="<?=stripslashes($row['location'])?>" /></td>
      <td><input name="record[<?=$i?>][6]" type="text" size="10" value="<?=stripslashes($row['picture'])?>" /></td>
      <td><input name="record[<?=$i?>][7]" type="text" size="10" value="<?=stripslashes($row['purchased'])?>" /></td>
      <td><input name="record[<?=$i?>][8]" type="text" size="10" value="<?=stripslashes($row['customer'])?>" /></td>
      <td><input name="record[<?=$i?>][9]" type="text" size="7" value="<?=stripslashes($row['employee'])?>" /></td>
      <td><input name="record[<?=$i?>][10]" type="text" size="12" value="<?=stripslashes($row['comment'])?>" /></td>
      <td><select name="record[<?=$i?>][11]" size="1">
    <?php for($ii=0; $ii<$catCount; $ii++){ 
            unset($opt);
            if (trim($cats[$ii])==trim(stripslashes($row['category']))) $opt='selected="yes"';
	?>

    <option <?=$opt?> value="<?=$cats[$ii]?>"><?=$cats[$ii]?></option>

    <?php } ?>
    </select></td><!-- Category -->
      
      <td><input name="record[<?=$i?>][12]" type="checkbox"/></td>
    </tr>
<?php }

if($message)
    echo '<tr><td align="center" colspan="12"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>
    <tr><td colspan="12" align="center">
    <input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add Inventory&nbsp&nbsp;&nbsp;&nbsp;" onclick="parent.location='addWhseInventory.php'" type="button">
    <input value="Return To Dashboard" onclick="parent.location='adminDashboard.php'" type="button">
    <input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="parent.location='../dashboard/'" type="button">
    <input name="" type="submit" value="Save Changes" /> 
    </td></tr>
</table>
<input type="hidden" name="catSelected" value="<?=$catSelected?>" />
<input type="hidden" name="referPage" value="category" />
</form>

</body>

</html>