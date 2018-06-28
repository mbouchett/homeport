<?php

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('Location: index.php');
    die;
  }
$filename = $_REQUEST['filename'];
$basename = substr($filename,1);
$dir = getcwd();
$sName = "s".$basename;
$wName = "w".$basename;

if(substr($filename,0,1) == "w"){
    rename($dir.'/images/'.$filename, "images/".$sName);
    $forward = $sName;
} else {
    rename($dir.'/images/'.$filename, "images/".$wName);
}

header('location: index.php?forward='.$forward);
?>