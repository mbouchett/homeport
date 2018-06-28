<?php
//rev 20100514
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
unset($detail);
$detail=$_REQUEST['detail'];
$today = date("F j, Y, g:i a");
$stamp=$_REQUEST['stamp'];
$before=$_REQUEST['before'];

$username=$_SESSION['username'];
$userlevel=$_SESSION['userlevel'];

// get the Company records and store them in the users array
$fp = @fopen('data/companydata.txt', "r");
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $compInfo[$i] =trim($item);
          $i++;
       }
fclose($fp);         		//close the Company file

//Load gift card log Into Array
$fp = fopen('data/gclog.txt', "r");
    // get the search records and store them in the searches array
     $i=0;
       while (!feof($fp)) {
          $item= fgetcsv($fp, ",");
          $searches[$i] =array($item[0],$item[1],$item[2],$item[3],$item[4],$item[5]);
          $i++;
       }

fclose($fp);         		    //close the searches file
$recCount=count($searches); 	//How many searches in the list
unset($gotSome);
//Update Date Stamp
$fp = fopen('data/datestamp.txt', "w");
  fwrite($fp,$stamp);
fclose($fp);         		    //close the file

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Homeport Cash Report</title>
<link href="design/style01.css" rel="stylesheet" type="text/css" />
</head>
<?php include('design/header.html'); ?>
<br />
 <center><b><?= $compInfo[0] ?> Gift Card Daily Report <?= date("m/d/Y @ H:i") ?></b></center><br />
 <table width="550" align="center" border="4" >
   <tr>
    <td>Date/Time</td><td>Card #</td><td>Balance</td><td>Redeem</td><td>Issued</td><td>User</td>
  </tr>

 <?php
 
 for($i=$recCount-2; $i>-1; $i--){
 $day = substr($searches[$i][0],8,2);
 $month = substr($searches[$i][0],5,2);
 $year = substr($searches[$i][0],0,4);
 $hour = substr($searches[$i][0],11,2);
 $minute = substr($searches[$i][0],14,2);
 $tSamp = $month.'/'.$day.'/'.$year.', '.$hour.':'. $minute;
 if($searches[$i][0]> $before){
    $gotSome=1;
 ?>
    <tr>
        <td><?= $tSamp?></td><td><?=$searches[$i][1]?></td><td align="right"><?=$searches[$i][2]?></td><td align="right"><?=$searches[$i][3]?><td align="right"><?=$searches[$i][4]?><td><?=$searches[$i][5]?></td>
    </tr>
  <?php
  $redeemed=$redeemed+$searches[$i][3];
  $issued=$issued+$searches[$i][4];
  } }

  if(!$gotSome){ ?>
    <tr>
        <td colspan="6" align="center"><h4>No New Transactions</h4></td>
    </tr>
  <?php } ?>
 </table><br />
 <table width="550" align="center" border="4" >
    <tr>
        <td align="right">Total Redeemed: $<?= number_format($redeemed,2) ?></td><td align="right">Total Issued: $<?= number_format($issued,2) ?></td><td align="center"><input value="Print This Report" TYPE="button" onClick="window.print()"></td>
    </tr>
 </table>
<br />
<table align="center">
<tr><td align="center"><input value="Return To Dashboard" onclick="parent.location='dashboard.php'" type="button">
</td></tr>
</table>
<?php
if($gotSome){
    $today = date("F j, Y, g:i a");

    //Open The Database load cards
    $db= new mysqli('localhost', 'homepor1_demo', 'demo', 'homepor1_giftcard');
    $sql = 'SELECT * FROM `'.$compInfo[1].'_gc`' ;
    $result = mysqli_query($db, $sql); // create the query object
    $num_results=mysqli_num_rows($result); //How many records meet select
    mysqli_close($db); //close the connection
    unset($total);
    for($i=0; $i<$num_results; $i++){
        $row=mysqli_fetch_assoc($result);
        $cards[$i]=$row;
    }
    unset($finalStory);

    for($i=0; $i<$num_results; $i++){
      $finalStory = $finalStory.$cards[$i]['cardnumber'].','.$cards[$i]['balance'].','.$cards[$i]['dateissued'].','.$cards[$i]['dateredeemed'].','.$cards[$i]['alert']."\n";
    }
    // Compose Mail
    mail($compInfo[2],'Gift Card Backup '.$compInfo[0].' :'.$today,$finalStory);
    mail('gc_backup@vermontsbs.com','Gift Card Backup '.$compInfo[0].' :'.$today,$finalStory);
}
?>
</body>
</html>