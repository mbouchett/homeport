<?php
//index.php 2018/01
// department search
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";
session_start(); // Resume up your PHP session!
// Get the cookies
$visitID=$_COOKIE['visitID'];
if(!$visitID){
    //Load New Visit Tag
	$fp = fopen("../visit.txt", "r");
        $idNum = fgets($fp);     //get the current visit
    fclose($fp);            //close the visit file

    // Set The Cookie
    setcookie("visitID", $idNum,time()+60*60*24*2,"/");
    $visitID = $idNum;
    $idNum = $idNum+1;
    if($idNum>99999) $idNum=1000;
    //Save the new Visit Number
    $fp = fopen("../visit.txt", "w");
        fwrite($fp, $idNum);
    fclose($fp);            //close the visit file
}
unset($cartfull);
// load the cart data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart` WHERE `customer` = \''.trim($visitID).'\' AND `purchased` IS NULL ' ;
$result = mysqli_query($db, $sql); // create the query object
if($result) {
	$cart_results=mysqli_num_rows($result); //How many records meet select
}
mysqli_close($db); //close the connection
if($cart_results>0) $cartfull = 1;

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `departments` ORDER BY `dept_name`' ;
$result = mysqli_query($db, $sql); // create the query object
$dept_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
for($i=0; $i<$dept_results; $i++){         //Iniate The Loop
    $department[$i]=mysqli_fetch_assoc($result);     //Fetch The Current Record
}

// Get Pictures
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
for($i=0; $i<$dept_results; $i++){         //Iniate The Loop
//    $department[$i]=mysqli_fetch_assoc($result);     //Fetch The Current Record
	$sql = "SELECT * FROM `items` WHERE `dept_ID` LIKE '".$department[$i]['dept_ID']."' AND `item_pic` IS NOT NULL LIMIT 50";//Create The Search Query
	$result = mysqli_query($db, $sql); // create the query object
	if($result) {
		$tot_results=mysqli_num_rows($result);
		$x = rand(0, $tot_results-1);
		for($z=0; $z<$tot_results; $z++){
			$pic=mysqli_fetch_assoc($result);     //Fetch The Current Record
			if($z == $x){
				$department[$i]['pic'] = $pic['item_pic'];
				break;
			}
		}
	}
}
mysqli_close($db); //close the connection
?>
<!DOCTYPE html>

<html>

<head>
  <link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="images/HM.ICO">
  <title>Homeport - Departments*</title>
  <script>
  function cart(recno){
    window.open('../cart2013/addToCart.php?recno='+recno,'MyWindow','left=125,top=150,menubar=0,scrollbars=1,width=800,height=500');
    if(recno){
      document.getElementById("basketCase").src = "images/full.png";
    }
  }
  </script>
</head>

<body>
<div id="banner">
  <a href="http://www.homeportonline.com"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <div style=" margin-top: -30px" id="department"><br />802-863-4644</div>
  <div style=" margin-top: -30px" id="department" class="deplink"><br /><br />Departments:
</div>
  <div id="menu">
      <ul>
        <li><a href="http://www.homeportonline.com/" class="menubutton">HOME</a></li>
        <!--<li><a href="http://www.homeportonline.com/webcam.php" class="menubutton">WEBCAM</a></li>-->
        <li><a href="http://www.homeportonline.com/registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="http://www.homeportonline.com/departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
        <?php if($cartfull){ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="../images/full.png" /></a>
        <?php }else{ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="../images/empty.png" /></a>
        <?php } ?>
  </div>
</div> <br />
<div id="navstrip">
<?php for($i=0; $i<$dept_results; $i++){ ?>
<a href="../index.php?department=<?= $department[$i]['dept_ID'] ?>&depname=<?= preg_replace('/\&/', 'And', $department[$i]['dept_name']) ?>">
<?= preg_replace('/\&/', 'And', $department[$i]['dept_name']) ?></a>
<br />
<?php } ?>
</div>
<div class="picmenu">
<?php
    for($i=0; $i<$dept_results; $i++){
        $skew = rand(0,6);
?>
    <div onclick=" pop('xxx<?= $i ?>')" class="polaroid<?= $skew ?>" >
        <a href="../index.php?department=<?= $department[$i]['dept_ID'] ?>&depname=<?= preg_replace('/\&/', 'And', $department[$i]['dept_name']) ?>">
        <img style=" max-width: 200px; max-height: 250px" src="<?= resolve($department[$i]['pic']) ?>" alt="No Image Available For: " /><br />
        <br /><?= $department[$i]['dept_name'] ?></a>
    </div>
<?php } ?>
</div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8450012-2");
pageTracker._trackPageview();
} catch(err) {}
</script>
<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=1053180&mt_adid=169812&v1=&v2=&v3=&s1=&s2=&s3='></script>
</body>

</html>