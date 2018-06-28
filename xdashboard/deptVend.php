<?php
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');
// Load departments

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `departments` ORDER BY `depnum`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $depts[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$depcount=count($depts);

// Load Items
//Open Item Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT `items`.`department`, `items`.`vendor`, `vendors`.`name`
            FROM `items`
            LEFT JOIN `vendors` ON `items`.`vendor` = `vendors`.`number`
            ORDER BY `department`, `vendor`' ; //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $items[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$itemcount=count($items);
for($i = 0; $i < $itemcount; $i++){
    for($ii = 0; $ii < $depcount; $ii++){
        if($depts[$ii]['depnum'] == $items[$i]['department']){
            $items[$i]['depname'] = $depts[$ii]['department'];
            break;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Vendors By Department (a)</title>
  <link href="design/deptVend.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!--<table>
<tr><td>Number</td><td>Department Name</td></tr>
<?php for($i=0; $i<$depcount; $i++){ ?>
    <tr>
        <td >
            <?= $depts[$i]['depnum'] ?>
        </td>
        <td><?= $depts[$i]['department'] ?></td>
    </tr>
<?php } ?>
</table>-->

<table>
<tr><td>Department</td><td>Dept Name</td><td>Vendor</td><td>Vendor Name</td></tr>
<?php
    for($i=0; $i<$itemcount; $i++){
        if($v != $items[$i]['vendor']){
?>
    <tr>
        <?php if($d != $items[$i]['department']) { ?>
        <td ><?= $items[$i]['department'] ?></td>
        <td ><?= $items[$i]['depname'] ?></td>
        <?php }else{ ?>
        <td></td><td></td>
        <?php }?>
        <td><?= $items[$i]['vendor'] ?></td>
        <td><a href="inventory/items.php?ven=<?= $items[$i]['vendor'] ?>"><?= $items[$i]['name'] ?></a></td>
    </tr>
<?php
        }
        $v = $items[$i]['vendor'];
        $d = $items[$i]['department'];
    }
?>
</table>
</body>
</html>