<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

//r[0]=regnum
//r[1]=partner 1 First Name
//r[2]=partner 2 First Name
/* nb. Here are the field correlations
rN[0]=partner1F			rN[10]=addr02
rN[1]=partner1L			rN[11]=addr03
rN[2]=partner2F			rN[12]=contact
rN[3]=partner2L			rN[13]=relation
rN[4]=eventdate			rN[14]=cphone01
rN[5]=phone01			rN[15]=cphone02
rN[6]=phone02			rN[16]=cemail
rN[7]=email01			rN[17]=postaddr01
rN[8]=email02			rN[18]=postaddr02
rN[9]=addr01			rN[19]=postaddr03
*/

$adjQty=$_POST['adjQty'];
$deleteMe=$_POST['deleteMe'];
$sku=$_POST['sku'];
$regNum=$_POST['regNum'];
$recd=$_POST['recd'];
$hold=$_POST['hold'];
$recno=$_POST['recno'];
$adjCount=count($adjQty);
$desc=$_POST['desc'];
$price=$_POST['price'];
$item = $_POST['item'];

//Fix Under Wanted
for($i=0; $i<$adjCount; $i++){
if($recd[$i] && $adjQty[$i] < $recd[$i]) $adjQty[$i]=$recd[$i];
}

//perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$adjCount; $i++){
    $sql = "UPDATE `".$db_db."`.`g_items`
        SET `qty` = '".$adjQty[$i]."',
            `onhold` = '".$hold[$i]."',
            `description` = '".$desc[$i]."',
            `item` = '".$item[$i]."',
            `price` = ".$price[$i].",
            `sold` = '".$recd[$i]."'
         WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection

//Perform the deletes
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$adjCount; $i++){
	if($adjQty[$i]=0 || !$adjQty[$i] || $deleteMe[$i]){
    	$sql = "DELETE FROM `".$db_db."`.`g_items` WHERE `recno` = '".$recno[$i]."';";
    	$result = mysqli_query($db, $sql); // create the query object
	}
}
mysqli_close($db); //close the connection
if($regNum){
header('Location: dashEditRegItems.php?message=Changes Saved&messColor=33CC00&messSize=24&regnum='.$regNum[0]);
}else {

}
die;
?>