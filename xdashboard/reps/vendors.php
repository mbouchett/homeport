<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";

function getOrders($num){
    include "../../db.php";
    //open order database and retrieve sent orders
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
        $sql = "SELECT * FROM `orders` WHERE `vendor` LIKE '".$num."' AND `dateOrd` IS NOT NULL ORDER BY `orderNum` DESC";//Create The Search Query
        //echo $sql."<br>";
        $result = mysqli_query($db, $sql);                    //Initiate The Query
        $orderCount = mysqli_num_rows($result);
    for($i=0; $i<$orderCount; $i++){
        $x = $GLOBALS[orderCounter]++;
        $row=mysqli_fetch_assoc($result);                     //Fetch The Current Record
        $orders[$x]=$row;                                     //Save The Record To The Array
    }
    mysqli_close($db);
}

date_default_timezone_set('America/New_York');
header('Cache-Control: max-age=900');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['useremail'])){
    header('Location: index.php');
    die;
  }

$email = $_SESSION['useremail'];

// load vendors associated with this email
//Open Item Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `email` LIKE"%'.$email.'%" ORDER BY `name`' ; //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $vendor[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$vendorCount=count($vendor);

$orderCounter = 0;
for($i = 0; $i < $vendorCount; $i++){
   getOrders($vendor[$i]['recno']);
}
//echo $orderCounter;
//echo count($orders);

?>
<!DOCTYPE HTML>

<html>

<head>
  <link rel="SHORTCUT ICON" href="dash.ico">
  <link rel="stylesheet" href="../css/dashboard.css" type="text/css" />
  <title>Vendors</title>
</head>

<body>
<?php for($i = 0; $i < $vendorCount; $i++){ ?>
<a href="items.php?ven=<?= $vendor[$i]['number'] ?>"><?= $vendor[$i]['name'] ?> </a><br>
<?php } ?>
======================= Orders =======================<br>
<?php for($i = 0; $i <= $orderCounter; $i++){ ?>
<?= $orders[$i]['po'] ?><br>
<?php } ?>
</body>

</html>