<?php
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
/*  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }*/

//Establish Variables
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$cat=$_POST['cat'];
$save=$_POST['save'];
$vendor=$_POST['vendor'];
$oq=$_POST['oq'];
$recno=$_POST['recno'];
$onhand=$_POST['loh'];
$recordCount=$_POST['recordcount'];
$po=$_POST['po'];
$today=date('m/d/Y');
$shipdate=$_POST['shipdate'];
if(!$shipdate) $shipdate="ASAP";
$comments=$_POST['comments'];
if(!$comments) $comments="Please Apply Discount - Special Terms - And Freight Allowance";

//Testing
      //echo $process."<br />";
      //echo $save."<br />";
      //echo $vendor."<br />";

      //for($i=0; $i<$recordCount; $i++){
      // echo $recno[$i]."-".$oh[$i]."-".$oq[$i]."<br />";
      //}
      //exit;

//Clear All Entries

if($save=="Clear Entries"){
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i=0; $i<$recordCount; $i++){
        $sql = "UPDATE `".$db_db."`.`items` SET `oq` = '0' WHERE `recno` = '".$recno[$i]."';";
        $result = mysqli_query($db, $sql); // create the query object
    }
    mysqli_close($db); //close the connection
    header('Location: offCycle.php?ven='.$vendor);
    die;
}
//Process Order
if($save=="Process Order"){
    //Get Current Item Data
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
        $sql = 'SELECT * FROM `items` WHERE `vendor` LIKE"%'.$vendor.'%" ORDER BY `description`' ;          //Create The Search Query
        $result = mysqli_query($db, $sql);          //Initiate The Query
        $num_results=mysqli_num_rows($result);      //Count The Query Matches
        mysqli_close($db);                          //Close The Connection
    //Store the Results To A Local Array
        for($i=0; $i<$num_results; $i++){         //Iniate The Loop
            $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
            $items[$i]=$row;                        //Save The Record To The Array
        }                                           //Close The Loop
    $itemcount=count($items);

    if($recordCount != $itemcount) header('Location: offCycle.php?ven='.$vendor.'&message=Problem Processing Order!&messColor=CC0000&messSize=20');
    $ordereditems=0;
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    // Perform Data Updates
    for($i=0; $i<$recordCount; $i++){
        $loh[$i]=$onhand[$i]+$oq[$i]; //loh
        $pdat[$i]=$items[$i]['ldat'];
        $ldat[$i]=$today;
        $pq[$i]=$items[$i]['lq'];
        $lq[$i]=$oq[$i];
        $ppo[$i]=$items[$i]['lpo'];
        $lpo[$i]=$po;
        if($oq[$i]>0 ){
            $ordereditems=$ordereditems+1;
        $sql = "UPDATE `".$db_db."`.`items`
            SET `loh` = '".$loh[$i]."',
             `lq` = '".$lq[$i]."',
             `ldat` = '".$ldat[$i]."',
             `lpo` = '".$lpo[$i]."',
             `pq` = '".$pq[$i]."',
             `pdat` = '".$pdat[$i]."',
             `ppo` = '".$ppo[$i]."'
             WHERE `recno` = '".$recno[$i]."';";
        $result = mysqli_query($db, $sql); // create the query object
        }
    }
    mysqli_close($db); //close the connection

// Create The Order File

//Save A Single Value To A Flat File
$fp = fopen('data/po/'.$po.'.txt', "w"); //Open The File For Overwrite
  fwrite($fp,$vendor."\n");              //Save The Vendor
  fwrite($fp,$today."\n");               //Save The date
  fwrite($fp,$ordereditems."\n");        //Save The # of Items
  fwrite($fp,$shipdate."\n");            //Save The Ship Date
  fwrite($fp,$comments."\n");            //Save The Comments
  fwrite($fp,$useremail."\n");           //Save Buyer's Email
  for($i=0; $i<$recordCount; $i++){
    if($oq[$i]>0 ){
        fwrite($fp,$recno[$i]."\n");        //Item Record Number
        fwrite($fp,$oq[$i]."\n");        //Item Record Number
     }
    }
fclose($fp);         		             //close the file
//Redirect to view page
header('Location: viewOrder.php?po='.$po.'&cat='.$cat);
die;
}
//Save Work Progress DEFAULT
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$recordCount; $i++){
    $sql = "UPDATE `".$db_db."`.`items` SET `oq` = '".$oq[$i]."' WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection
header('Location: offCycle.php?ven='.$vendor.'&message=Work SAVED!&messColor=006600&messSize=20');
die;
?>