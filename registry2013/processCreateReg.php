<?php
//processCreateReg.php 2018/01
//Processes a registry application
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['loggedIn'])){
    echo 'No Authorization'.$username;
    exit;
  }

/* nb. Here are the field correlations
r[0]=partner1F			r[10]=addr02			r[20]=username
r[1]=partner1L			r[11]=addr03			r[21]=password
r[2]=partner2F			r[12]=contact			
r[3]=partner2L			r[13]=relation
r[4]=eventdate			r[14]=cphone01
r[5]=phone01			r[15]=cphone02
r[6]=phone02			r[16]=cemail
r[7]=email01			r[17]=postaddr01
r[8]=email02			r[18]=postaddr02
r[9]=addr01				r[19]=postaddr03
*/

$r=$_POST['r'];

//Capitalize Names
$r[0]=ucwords($r[0]);
$r[1]=ucwords($r[1]);
$r[2]=ucwords($r[2]);
$r[3]=ucwords($r[3]);

$_SESSION['r']=$r;

// Verify That All Required Fields Are Filled In
if(!$r[0] || !$r[1] || !$r[4] || !$r[5] || !$r[7] || !$r[20] || !$r[21]){
	$_SESSION['r']=$r;
	header('Location: createReg.php?message=Please Fill All Required Fields');
	die;
}

// Verify for valid email
if (!filter_var($r[7], FILTER_VALIDATE_EMAIL)) {
	$_SESSION['r']=$r;
	header('Location: createReg.php?message=<br>Please Verify That Email Address Is Valid');
	die;
}

//Check to see if user name is available
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT `reg_username` FROM `registry`' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

for($i=0; $i<$num_results; $i++){
  $row=mysqli_fetch_assoc($result);
  //echo stripslashes($row['username']);
  if($r[20]==stripslashes($row['username'])){
  	 header('Location: createReg.php?message=This User Name Is Not Available Please Choose Another');
	 exit; 
  }
}

// hash password
$hash=crypt($r[21], '$2a$07$theclockswerestrikingthirteen$');

$day=substr($r[4],3,2);
$month=substr($r[4],0,2);
$year=substr($r[4],-4);
$r[4]=$year."-".$month."-".$day;

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

$sql = "INSERT `".$db_db."`.`registry` 
			(`reg_partner1F`, `reg_partner1L`, `reg_partner2F`, `reg_partner2L`, `reg_event_date`, `reg_phone01`, `reg_phone02`, `reg_email01`,
			 `reg_email02`, `reg_addr01`, `reg_addr02`, `reg_addr03`, `reg_contact`, `reg_relation`, `reg_cphone01`, `reg_cphone02`, `reg_cemail`,
			 `reg_postaddr01`, `reg_postaddr02`, `reg_postaddr03`, `reg_username`, `reg_pw`)
        VALUES ('$r[0]', '$r[1]', '$r[2]', '$r[3]', '$r[4]', '$r[5]', '$r[6]', '$r[7]', '$r[8]', '$r[9]', '$r[10]', '$r[11]', '$r[12]', '$r[13]',
         '$r[14]', '$r[15]', '$r[16]', '$r[17]', '$r[18]', '$r[19]', '$r[20]', '$hash')";
$result = mysqli_query($db, $sql);
if(!$result) {
		echo "Create Registry Failed!<br>";
		echo $sql."<br>";
		echo mysqli_error($db);
		die;
}
mysqli_close($db);

header('Location: appFiled.php?message=application filed');
exit;
?>