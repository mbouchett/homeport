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
$v[12] = ucwords($v[12]);
$flag = 0;
if($v[13]) $flag = 1;
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
//exit;
if(!$v[9]) $v[9] = "Please Call With Freight Quote";
if(!$v[10]) $v[10] = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";

// Make the query string
$sql = "UPDATE `".$db_db."`.`vendors`
    SET `name` = '".addslashes($v[1])."',
        `hti` = '".addslashes($flag)."',
        `addr1` = '".addslashes($v[2])."',
        `addr2` = '".addslashes($v[3])."',
        `addr3` = '".addslashes($v[4])."',
        `email` = '".addslashes($v[5])."',
        `rep` = '".addslashes($v[6])."',
        `fax` = '".addslashes($v[7])."',
        `voice` = '".addslashes($v[8])."',
        `ship1` = '".addslashes($v[9])."',
        `ship2` = '".addslashes($v[10])."',
        `multi` = '".addslashes($v[11])."',
        `note` = '".addslashes($v[12])."'
     WHERE `recno` = '".trim($record)."';";

//perform the update
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
//echo $sql;
//exit;
// Go Back And Do It Again
$dest ='Location: venEdit.php?ven='.$v[0].'&message=Changes Saved&messColor=009900&messSize=24';
header($dest);
die;
?>