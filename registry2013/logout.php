<?php
date_default_timezone_set('America/New_York');
$rootLoc=$_SESSION['rootLoc'];
session_destroy();
    setcookie("regnum", "",time()-4200,"/");
    setcookie("partner1F", "",time()-4200,"/");
    setcookie("partner2F", "",time()-4200,"/");

header('Location: index.php?message=Logged Out&messColor=3366FF&messSize=24');
?>
