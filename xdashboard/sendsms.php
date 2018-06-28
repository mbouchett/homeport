<?php
date_default_timezone_set('America/New_York');

//rev 2015/11
session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    echo 'No Authorization'.$username;
    exit;
  }
  
//includes loads from the rootr so: ../../ ../
include "../db.php";
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';  
  
// scrub text for database
function scrubText($text){
    $scrubbedText = str_replace("'", "", $text);
    $scrubbedText = str_replace('"', '', $scrubbedText);
    $scrubbedText = str_replace("\\", "-", $scrubbedText);
    return $scrubbedText;
}

$username=$_POST['username'];
$who=$_POST['who'];
$what=$_POST['what'];
$time=$_POST['time'];
$date=$_POST['date'];
$day=$_POST['day'];
$customer=$_POST['customer'];
$company=$_POST['company'];
$sku=$_POST['sku'];
$description=$_POST['description'];
$message=stripslashes($_POST['message']);

if(!$username) $username = $_POST['user'];
if(!$date) $date = "xxx";
if(!$time) $time = "xxx";
if(!$day) $day = "xxx";
if(!$sku) $sku = "N/A";
if(!$description) $description = "xxx";
if(!$customer) $customer = "xxx";
if(!$company) $company = "xxx";

$when = "[".$day."] [".$time."] [".$date."]";

// att          -> 8025551212@txt.att.net
// verizon      -> 8025551212@vtext.com
// tmobile      -> 8025551212@tomomail.net
// Sprint       -> 8025551212@messaging.sprintpcs.com
// Virgin       -> 8025551212@vmobl.com


switch ($who) {
   case "harrison":
        $to = "+18023492987";
        
        break;
    case "francois":
        $to = "+18023630546";
        
        break;
    case "mark":
        $to = "+18023731035";
        break;
    case "frank":
        $to = "+18023731036";
        
        break;
}

//Scrub the data
$when = scrubText($when);
$who = scrubText($who);
$what = scrubText($what);
$customer = scrubText($customer);
$company = scrubText($company);
$sku = scrubText($sku);
$description = scrubText($description);
$message = scrubText($message);
$username = scrubText($username);

// save to the message log
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "INSERT INTO `".$db_db."`.`pickup` (`when`, `who`, `what`, `customer`, `company`, `sku`, `description`, `message`, `username`)
        VALUES ('$when', '$who', '$what', '$customer', '$company', '$sku', '$description', '$message','$username')";
//perform action
$result = mysqli_query($db, $sql); // create the query object
$sql = "SELECT `recno` FROM `pickup` ORDER BY `recno` DESC Limit 1";
$result = mysqli_query($db, $sql); // create the query object
$latest=mysqli_fetch_assoc($result);
mysqli_close($db);

$text = "Pick Up:\www.homeportonline.com/dashboard/pickup.php?recno=".$latest[recno]."\n";

//***********************************************************************************************

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC728398f52ebbfc782a8d3ec00a81d9e7';
$token = '69cb081f2f9e7dffd2463657cb7fc71d';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    $to,
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+18029921899',
        // the body of the text message you'd like to send
        'body' => $text
    )
);

//***********************************************************************************************

?>
<script type="text/javascript">
    alert("Message Sent");
    window.location="sms.php"
</script>mail($to,$subject,$txt,$headers);