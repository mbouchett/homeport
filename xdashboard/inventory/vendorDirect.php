<?php
date_default_timezone_set('America/New_York');
//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

$username=$_SESSION['username'];
$useremail=$_SESSION['useremail'];

$dir=$_POST['dir'];
$vendor=$_POST['vendor'];
header('Location: '.$dir.'.php?ven='.$vendor);
die;
?>