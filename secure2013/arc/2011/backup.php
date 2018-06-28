<?php
//rev 20100514
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }

// get the Company records and store them in the users array
$fp = @fopen('data/companydata.txt', "r");
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $compInfo[$i] =trim($item);
          $i++;
       }
fclose($fp);         		//close the Company file

$today = date("F j, Y, g:i a");

//Open The Database and look for the card
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
header('Location: reports.php?message=Backup Successful&messColor=339933&messSize=24');
exit;
?>