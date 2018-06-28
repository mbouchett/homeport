<?php
//includes loads from the rootr so: ../../ ../
include "../../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
// use session info to verify login status
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
  
//Establish Variables
// collect logged in user info
$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

// Order Info
$today=date('m/d/Y');
$save=$_POST['save'];
$vendor=$_POST['vendor'];
$orderNum=$_POST['orderNum'];
$recordCount=$_POST['recordcount'];
$shipdate=$_POST['shipdate'];
if(!$shipdate) $shipdate="ASAP";
$comments=$_POST['comments'];
if(!$comments) $comments="Please Apply Discount - Special Terms - And Freight Allowance";
$discount=$_POST['discount'];
$freight01 = $_POST['freight01'];
if(!$freight01) $freight01 = "Please Call With Freight Quote";
$freight02 = $_POST['freight02'];
if(!$freight02) $freight02 = "Cancel 30 Days After Ship Date - No Backorders Without Prior Approval";
$offCycle = $_POST['offCycle'];
if($offCycle){
    $offCycle = 1;
}else $offCycle = 0;

$po = $orderNum.strtoupper(substr($username,1,2));
if($offCycle == 1) $po .= "X";

//Items Info
$oh=$_POST['oh'];
$oq=$_POST['oq'];
$recno=$_POST['recno'];

//Save Work Progress DEFAULT
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

$sql = "UPDATE `".$db_db."`.`orders`
        SET `shipDate` = \"".$shipdate."\",
        `orderComments` = \"".$comments."\",
        `discount` = \"".$discount."\",
        `freight01` = \"".$freight01."\",
        `freight02` = \"".$freight02."\",
        `offCycle` = \"".$offCycle."\"
        WHERE `orders`.`orderNum` = ".$orderNum.";";
    $result = mysqli_query($db, $sql); // create the query object

for($i=0; $i<$recordCount; $i++){
    if(!$oh[$i]) $oh[$i] = 0;
    if(!$oq[$i]) $oq[$i] = 0;
    
    $sql = "UPDATE `".$db_db."`.`items`
        SET `oh` = '".$oh[$i]."',
        `oq` = '".$oq[$i]."'
        WHERE `recno` = '".$recno[$i]."';";
    $result = mysqli_query($db, $sql); // create the query object
    if(!$result){
        echo "No Good<br>";
        echo $sql;
        die;
    }
}
mysqli_close($db); //close the connection

//Process Order
if($save == "Process Order"){

    //Check for an empty order
    $totalItems = 0;
    for($i=0; $i<$recordCount; $i++){
        $totalItems = $totalItems+$oq[$i];
    }

    if($totalItems < 1){
        // for a cycle order process count and delete the order
        header('Location: enterCount.php?ven='.$vendor.'&message=No Items Ordered!&messColor=CC0000&messSize=20');
        die;
    }
    //Add items to orderItems
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $ii = 0; // items that got ordered subcount
    for($i=0; $i<$recordCount; $i++){
        $a1 = $recno[$i];
        $a2 = $oq[$i];
        //only add items with order quantities

        if($oq[$i] > 0){
            // Add the record to order_items
            $sql = "INSERT INTO `".$db_db."`.`order_items` (`item`, `qty`, `order`)
                    VALUES ( '$a1', '$a2', '$orderNum');";
            $result = mysqli_query($db, $sql);
            // get item data from main item table
            $sql = 'SELECT * FROM `items` WHERE `recno` = "'.$recno[$i].'"';    //Create The Search Query
            $result = mysqli_query($db, $sql);                                  //Initiate The Query
            $items[$ii] = mysqli_fetch_assoc($result);                          //Fetch The Current Record
            $ii++;
        }
    }
    mysqli_close($db);

    //  update the items database
    $itemCt = count($items);
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i = 0; $i < $itemCt; $i++){
        $h2Qty = $items[$i]['h1Qty'];
        $h1Qty = $items[$i]['thisQty'];
        $h2Dat = $items[$i]['h1Dat'];
        $h1Dat = $today;
        $h2Po = $items[$i]['h1Po'];
        $h1Po = $po;
        if(!$h2Qty) $h2Qty = 0;
		  if(!$h1Qty) $h1Qty = 0;

        // variances for off and on cycle orders
        $newOH = $items[$i]['thisOh'] + $items[$i]['thisQty'];
        if($offCycle == 1) $newOH = $items[$i]['thisQty'];
        

        //perform Update
        if($newOH) {
        $sql = "UPDATE `".$db_db."`.`items`
        SET `h2Qty` = '".$h2Qty."',
		      `h1Qty` = '".$h1Qty."',
            `h2Dat` = '".$h2Dat."',
            `h1Dat` = '".$h1Dat."',
            `h2Po` = '".$h2Po."',
            `h1Po` = '".$h1Po."',
            `loh` = '".$newOH."'
        WHERE `recno` = ".$items[$i]['recno'].";";
        }else {
        $sql = "UPDATE `".$db_db."`.`items`
        SET `h2Qty` = '".$h2Qty."',
		      `h1Qty` = '".$h1Qty."',
            `h2Dat` = '".$h2Dat."',
            `h1Dat` = '".$h1Dat."',
            `h2Po` = '".$h2Po."',
            `h1Po` = '".$h1Po."'
        WHERE `recno` = ".$items[$i]['recno'].";";       
        }
        
        $result = mysqli_query($db, $sql); // create the query object
	// on update error
	if(!$result){
		echo "No Good!<br>";
		echo $sql." - ".$i."<br>";
		echo mysqli_error($db);
		die;
	}
       //echo $sql."<br>";
    }
    mysqli_close($db);

    // update order info
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);

    $sql = "UPDATE `".$db_db."`.`orders`
            SET `dateOrd` = \"".$today."\",
                `orders_status` = 1
        WHERE `orders`.`orderNum` = ".$orderNum.";";
    $result = mysqli_query($db, $sql); // create the query object
    mysqli_close($db); //close the connection

    //View The Order
    header('Location: viewOrder.php?order='.$orderNum);
    die;
}

header('Location: enterCount.php?ven='.$vendor.'&message=Work SAVED!&messColor=006600&messSize=20');
die;
?>