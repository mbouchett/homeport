<?php
//includes loads from the rootr so: ../../ ../
include "../../db.php";

date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: ../dashboard.php');
    die;
  }
$email = $_SESSION['useremail'];

unset($message);
$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

// load vendors associated with this email
//Open Item Database And Store It In A Local Array
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `reps`' ; //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $num_results=mysqli_num_rows($result);      //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $rep[$i]=mysqli_fetch_assoc($result); //Fetch The Current Record
    }                                         //Close The Loop
$repCount=count($rep);

?>
<!DOCTYPE HTML>

<html>

<head>
  <link rel="SHORTCUT ICON" href="dash.ico">
  <link href="css/style01.css" rel="stylesheet" type="text/css" />
  <title>Vendors</title>
</head>

<body>
    <form action="processDelRep.php" method="post">
  <table class="maintable">
    <tr >
        <td >Email Adderess</td><td >Delete</td>
    </tr>
  <?php for($i = 0; $i < $repCount; $i++){ ?>
    <tr >
        <td class="reptable"><?= $rep[$i]['email'] ?></td><td class="reptable"><input name="del[<?= $i ?>]" type="checkbox"></td>
    </tr>
  <?php } ?>
  </table>
  </form>
  <br>
  <form action="processAddRep.php" method="post">
  <table class="maintable">
    <tr><td colspan="5">Add Trusted Rep:</td></tr>
    <tr><td rowspan="2">Email Address:</td><td rowspan="2"><input name="email"></td><td>Password:</td><td><input type="password" name="passw1"></td><td rowspan="2"><input type="submit" value="Add"></td></tr>
    <tr><td>Verify Password:</td><td><input type="password" name="passw2"></td></tr>
  </table>
  </form>

<?php if($message){?>
    <br>
    <table class="maintable" align="center" border="1" style="border-color: #FFFFFF" >
        <tr><td><div style="font-size: <?=$messSize?>px; color: #<?=$messColor?>"><?=$message?></div></td></tr>
    </table>
<?php  }?>
</body>

</html>