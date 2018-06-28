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
$regnum=$_REQUEST['regnum'];
//$regnum=regnum
/* nb. Here are the field correlations
rN[0]=partner1F			rN[10]=addr02
rN[1]=partner1L			rN[11]=addr03
rN[2]=partner2F			rN[12]=contact
rN[3]=partner2L			rN[13]=relation
rN[4]=eventdate			rN[14]=cphone01
rN[5]=phone01			rN[15]=cphone02
rN[6]=phone02			rN[16]=cemail
rN[7]=email01			rN[17]=postaddr01
rN[8]=email02			rN[18]=postaddr02
rN[9]=addr01			rN[19]=postaddr03
*/

$rN=$_POST['rN'];
$delete = $_POST['delete'];

// Verify That All Required Fields Are Filled In
if(!$rN[0] || !$rN[1] || !$rN[2] || !$rN[3] || !$rN[4] || !$rN[5] || !$rN[7]){
	$_SESSION['r']=$r;
	header('Location: dashModifyRegProfile.php?message=Please Fill All Required Fields&messColor=CC0000&messSize=24');
	die;
}

//echo 'day '.$day.'<br />';
//echo 'month '.$month.'<br />';
//echo 'year '.$year.'<br />';

// Save The New Password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

//perform the update
    $sql = "UPDATE `".$db_db."`.`g_couples`
        SET `partner1F` = '".$rN[0]."',
            `partner1L` = '".$rN[1]."',
            `partner2F` = '".$rN[2]."',
            `partner2L` = '".$rN[3]."',
            `eventdate` = '".$rN[4]."',
            `phone01` = '".$rN[5]."',
            `phone02` = '".$rN[6]."',
            `email01` = '".$rN[7]."',
            `email02` = '".$rN[8]."',
            `addr01` = '".$rN[9]."',
            `addr02` = '".$rN[10]."',
            `addr03` = '".$rN[11]."',
            `contact` = '".$rN[12]."',
            `relation` = '".$rN[13]."',
            `cphone01` = '".$rN[14]."',
            `cphone02` = '".$rN[15]."',
            `cemail` = '".$rN[16]."',
            `postaddr01` = '".$rN[17]."',
            `postaddr02` = '".$rN[18]."',
            `postaddr03` = '".$rN[19]."'
         WHERE `regnum` = '".trim($regnum)."';";
    $result = mysqli_query($db, $sql); // create the query object

//perform deletes
	if($delete){
		$sql = "DELETE FROM `".$db_db."`.`g_couples`
			 WHERE `regnum` = '".$regnum."';";
		$result = mysqli_query($db, $sql); // create the query object
        header('Location: registryEdit.php');
        die;
        //echo "would be deleting -->".$regnum."<br />";
        //exit;
	}
mysqli_close($db); //close the connection

header('Location: dashModifyRegProfile.php?message=Changes Saved&messColor=33CC00&messSize=24&regnum='.$regnum);
die;
?>