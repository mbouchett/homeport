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
$oh=$_POST['oh'];
$oq=$_POST['oq'];
$recno=$_POST['recno'];
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
        $sql = "UPDATE `".$db_db."`.`items` SET `oh` = '0', `oq` = '0' WHERE `recno` = '".$recno[$i]."';";
        $result = mysqli_query($db, $sql); // create the query object
    }
    mysqli_close($db); //close the connection
    header('Location: enterCount.php?ven='.$vendor);
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

    if($recordCount != $itemcount) header('Location: enterCount.php?ven='.$vendor.'&message=Problem Processing Order!&messColor=CC0000&messSize=20');
    $ordereditems=0;
    // Perform Data Updates
    for($i=0; $i<$recordCount; $i++){
        if($oq[$i]>0 ) $ordereditems=$ordereditems+1;
        $h2Dat[$i]=$items[$i]['h1Dat'];
        $h1Dat[$i]=$today;
        $h2Qty[$i]=$items[$i]['h1Qty'];
        $h1Qty[$i]=$oq[$i];
        $h2Po[$i]=$items[$i]['h1Po'];
        $h1Po[$i]=$po;
    }
/*
                                                          *******This Bit Is Used only for testing*******
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Testing</title>
</head>
<body >
<table align="center" border="1">
    <tr>
        <td>recno</td><td>sku</td><td>h1</td><td>h2</td><td>h3</td><td>h4</td><td>h5</td><td>h6</td><td>h7</td><td>h8</td><td>h9</td><td>oh</td><td>lq</td><td>ldat</td><td>lpo</td><td>pq</td><td>pdat</td><td>ppo</td>
    </tr>
<?php     for($i=0; $i<$recordCount; $i++){ ?>
    <tr>
        <td><?= $items[$i]['recno'] ?></td>
        <td><?= $items[$i]['sku'] ?></td>
        <td><?= $items[$i]['h1'] ?></td>
        <td><?= $items[$i]['h2'] ?></td>
        <td><?= $items[$i]['h3'] ?></td>
        <td><?= $items[$i]['h4'] ?></td>
        <td><?= $items[$i]['h5'] ?></td>
        <td><?= $items[$i]['h6'] ?></td>
        <td><?= $items[$i]['h7'] ?></td>
        <td><?= $items[$i]['h8'] ?></td>
        <td><?= $items[$i]['h9'] ?></td>
        <td><?= $items[$i]['loh'] ?></td>
        <td><?= $items[$i]['lq'] ?></td>
        <td><?= $items[$i]['ldat'] ?></td>
        <td><?= $items[$i]['lpo'] ?></td>
        <td><?= $items[$i]['lq'] ?></td>
        <td><?= $items[$i]['ldat'] ?></td>
        <td><?= $items[$i]['ppo'] ?></td>
    </tr>
    <tr>
        <td><?= $recno[$i] ?></td>
        <td>unsent</td>
        <td><?= $h1[$i] ?></td>
        <td><?= $h2[$i] ?></td>
        <td><?= $h3[$i] ?></td>
        <td><?= $h4[$i] ?></td>
        <td><?= $h5[$i] ?></td>
        <td><?= $h6[$i] ?></td>
        <td><?= $h7[$i] ?></td>
        <td><?= $h8[$i] ?></td>
        <td><?= $h9[$i] ?></td>
        <td><?= $oh[$i] ?></td>
        <td><?= $lq[$i] ?></td>
        <td><?= $ldat[$i] ?></td>
        <td><?= $lpo[$i] ?></td>
        <td><?= $pq[$i] ?></td>
        <td><?= $pdat[$i] ?></td>
        <td><?= $ppo[$i] ?></td>
    </tr>
    <tr>
        <td colspan="18"><hr /></td>
    </tr>
<?php } ?>
</table>
</body>
</html>
                                                          *******End Of Bit*******
*/
//perform the update
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i=0; $i<$recordCount; $i++){
        $sql = "UPDATE `".$db_db."`.`items`
            SET `oh` = '".$oh[$i]."',
             	 `h1Qty` = '".$h1Qty[$i]."',
             	 `h2Qty` = '".$h2Qty[$i]."',
             	 `h1Dat` = '".$h1Dat[$i]."',
             	 `h2Dat` = '".$h2Dat[$i]."',
             	 `h1Po` = '".$h1Po[$i]."',
             	 `h2Po` = '".$h2Po[$i]."',
             	 `oh` = '".$oh[$i]."'
            WHERE `recno` = '".$recno[$i]."';";
        $result = mysqli_query($db, $sql); // create the query object
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
    $sql = "UPDATE `".$db_db."`.`items` SET `oh` = '".$oh[$i]."', `oq` = '".$oq[$i]."' WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
}
mysqli_close($db); //close the connection
header('Location: enterCount.php?ven='.$vendor.'&message=Work SAVED!&messColor=006600&messSize=20');
die;
?>