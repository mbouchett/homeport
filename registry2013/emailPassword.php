<?php
//lostPassword.php 2018/05
// email a lost password
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
$emailAddress=$_POST['emailAddress'];

// Verify for valid email
if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
	header('Location: lostPassword.php?message=<br>Email Not Valid');
	die;
}

//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_email01` LIKE \'%'.trim($emailAddress).'%\' ' ;
$result = mysqli_query($db, $sql); 
$num_results=mysqli_num_rows($result);
mysqli_close($db);

//if the email address is not found
if($num_results==0){
	header('Location: lostPassword.php?message=Email '.$emailAddress.' Not Found<br>Please Contact The Store For Help<br>802-863-4644 or home@homeportonline.com');
	die;
}

$reg=mysqli_fetch_assoc($result);

// generate new password
$pw_length = rand(7,10);
$new_pw = "";
for($i = 0; $i < $pw_length; $i++) {
	$new_pw = $new_pw.chr(rand(33,122));	
}

//hash the new password
$hash = crypt($new_pw, '$2a$07$theclockswerestrikingthirteen$');

//save the new password
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `registry` SET `reg_pw` = '".$hash."' WHERE `registry`.`reg_ID`=".$reg['reg_ID'];
$result = mysqli_query($db, $sql); 
if(!$result) {
	echo "Update Password Failed<br>";
	echo mysqli_error($db);
	die;
}
mysqli_close($db);

//compose message
$message="Homeport Online Gift Registry \n\n".
            "Username: ".stripslashes($reg['reg_username'])."\n".
            "Password reset to: ".$new_pw."\n\n\n".
            "Homeport\n".
            "52 Church Street\n".
            "Burlington, VT 05401\n".
            "802-863-4644 - home@homeportonline.com\n".
            "http:\\www.homeportonline.com";

//send email
mail(stripslashes($reg['reg_email01']),"Homeport Gift Registry Logon Info",$message,"From: Homeport Gift Registry <home@homeportonline.com>");

?>
<br />
<table align="center" >
<tr><td>Email Sent To:</td></tr>
<tr><td><?=stripslashes($reg['reg_email01'])?></td></tr>
</table>
<br />
<div style="cursor: pointer" align="center"><a onclick="window.close()">[x]Close Window</a></div>
