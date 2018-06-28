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

$message=$_REQUEST['message'];
$messColor=$_REQUEST['messColor'];
$messSize=$_REQUEST['messSize'];

$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

//Open The Database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `departments` ORDER BY `depnum`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
//Store the Results To A Local Array
    for($i=0; $i<$num_results; $i++){         //Iniate The Loop
        $row=mysqli_fetch_assoc($result);       //Fetch The Current Record
        $cats[$i]=$row;                        //Save The Record To The Array
    }                                           //Close The Loop
$catcount=count($cats);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="SHORTCUT ICON" href="../style/images/cl.ico">
<title>Homeport Edit Categories (a)</title>
<link href="css/style01.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center"><img src="../images/banner2010.jpg" style="border: 0px solid" alt="Homeport Online">
</div>
<br /><br />
<h1>Edit Categories</h1>
<form action="processEditDep.php" method="post">
<table border="0" align="center">
    <tr>
        <td>
            <input class="dashbut" value="Return To Dashboard" onclick="parent.location='dashboard.php'" type="button">
        </td>
    </tr>
</table>
<table class="dashtable" border="1" align="center">
<tr><td>Number</td><td>Department Name</td></tr>
<?php for($i=0; $i<$catcount; $i++){ ?>
    <tr>
        <td><?= $cats[$i]['depnum'] ?></td>
        <td><?= $cats[$i]['department'] ?></td>
    </tr>
<?php } ?>
</table>
</form>

</body>
</html>