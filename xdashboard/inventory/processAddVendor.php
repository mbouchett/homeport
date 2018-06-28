<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
    //Establish Variables
$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];
$v=$_POST['v'];
$record=$_POST['record'];

//echo $record."<br />";
//echo $v[0]."<br />"; //number
//echo $v[1]."<br />"; //name
//echo $v[2]."<br />"; //addr1
//echo $v[3]."<br />"; //addr2
//echo $v[4]."<br />"; //addr3
//echo $v[5]."<br />"; //email
//echo $v[6]."<br />"; //rep
//echo $v[7]."<br />"; //fax
//echo $v[8]."<br />"; //voice
//echo $v[9]."<br />"; //ship1
//echo $v[10]."<br />"; //ship2
//echo $v[11]."<br />"; //multi
//echo $v[12]."<br />"; //note
//echo 'venEdit.php?ven='.$v[0].'&message=Changes Saved&messColor=009900&messSize=24';

//Check for missing data
//if information is missing
if(!$v[1]){
	header('Location: addVendor.php?message=Vendor Name Is Required&messColor=CC0033&messSize=20');
	die;
}
if(!$v[9]) $v[9] = "Please Call With Freight Quote";
if(!$v[10]) $v[10] = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";


//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `number` FROM `vendors` ORDER BY `number`' ;         //Create The Search Query
$result = mysqli_query($db, $sql);                                  // create the query object
$num_results=mysqli_num_rows($result);                              //How many records meet select
mysqli_close($db);                                                  //close the connection
for($i=0; $i<$num_results; $i++){                                   //Iniate The Loop
    $ven[$i]=mysqli_fetch_assoc($result);                           //Fetch The Current Record & Save To The Array
    if ($ven[$i]['number'] > $i){
        $v[0] = $i;
        if (strlen($v[0]) < 3) $v[0] = "0".$i;
        if (strlen($v[0]) < 3) $v[0] = "00".$i;
        break;
    }
}
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT `".$db_db."`.`vendors` (`number`, `name`, `addr1`, `addr2`, `addr3`, `email`, `rep`, `fax`, `voice`, `ship1`, `ship2`, `multi`, `note`)
        VALUES ('$v[0]', '$v[1]', '$v[2]', '$v[3]', '$v[4]', '$v[5]', '$v[6]', '$v[7]', '$v[8]', '$v[9]', '$v[10]', '$v[11]', '$v[12]')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: venEdit.php?ven='.$v[0].'&message=Vendor Added '.date('l jS \of F Y h:i:s A'));
die;
?>