<?php
// pickup.php
// Mark Bouchett
// 12/04/2015
//includes loads from the rootr so: ../../ ../
include "../db.php";

date_default_timezone_set('America/New_York');

$recno = $_POST['recno'];
if(!$recno) $recno = $_REQUEST['recno'];

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `pickup` WHERE `recno` = '".$recno."'";
$result = mysqli_query($db, $sql); // create the query object
$pickup=mysqli_fetch_assoc($result);
mysqli_close($db);

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>PickUp</title>
  <style type="text/css">
    table {
      width: 90%;
      font-size: xx-large;
    }
    input {
      width: 80%;
      font-size: x-large;
    }
    td {
      border: solid #484848 thin;
    }

  </style>
</head>

<body>
    <table>
        <tr>
            <td>When</td><td><?= $pickup['when'] ?></td>
        </tr>
        <tr>
            <td>Type</td><td><?= $pickup['what'] ?></td>
        </tr>
        <tr>
            <td>Customer</td><td><?= $pickup['customer'] ?></td>
        </tr>
        <tr>
            <td>Company</td><td><?= $pickup['company'] ?></td>
        </tr>
        <tr>
            <td>SKU</td><td><?= $pickup['sku'] ?></td>
        </tr>
        <tr>
            <?php if(substr($pickup['description'],0,8) == "display:"){ ?>
            <td>Description</td><td><img src="../warehouse/display/images/<?= substr($pickup['description'],9) ?>" alt="<?= $pickup['description'] ?>" /></td>
            <?php }else { ?>
            <td>Description</td><td><?= $pickup['description'] ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td>Message</td><td><?= $pickup['message'] ?></td>
        </tr>
        <tr>
            <?php if($pickup['confirmed'] == 0){ ?>
            <td colspan="2"><input onclick="parent.location='acknowledge.php?recno=<?= $pickup['recno'] ?>'" name="confirm" type="button" value="Acknowledge"></td>
            <?php }else{ ?>
            <td colspan="2">CONFIRMED</td>
            <?php } ?>
        </tr>
    </table>
</body>

</html>