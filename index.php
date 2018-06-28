<?php
//index.php 2018/01
// frontend homepage
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";
include "/home/homeportonline/crc/functions/f_isMobile.php";

date_default_timezone_set('America/New_York');

$recno = $_REQUEST['recno'];
if (isMobile() && !$recno && !$_REQUEST['department']) {
   // do something for mobile devices
   header('Location: http://m.homeportonline.com');
	die;
}
date_default_timezone_set('America/New_York');
 // Resume up your PHP session!
/*session_start();  */
// Get the cookies
$visitID=$_COOKIE['visitID'];
if(!$visitID){
    //Load New Visit Tag
	$fp = fopen("visit.txt", "r");
        $idNum = fgets($fp);     //get the current visit
    fclose($fp);            //close the visit file

    // Set The Cookie
    setcookie("visitID", $idNum,time()+60*60*24*2,"/");
    $visitID = $idNum;
    $idNum = $idNum+1;
    if($idNum>99999) $idNum=1000;
    //Save the new Visit Number
    $fp = fopen("visit.txt", "w");
        fwrite($fp, $idNum);
    fclose($fp);            //close the visit file
}
unset($cartfull);
// load the cart data
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart` WHERE `customer` = \''.trim($visitID).'\' AND `purchased` IS NULL ' ;
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection
if($result){
	$cart_results=mysqli_num_rows($result); //How many records meet select
	if($cart_results>0) $cartfull = 1;
}

//Load our email address
$fp = fopen('email.txt', "r");  //Open The File For Reading
  $data = fgets($fp);                    //Load The Value
fclose($fp);
$homeportEmail = substr($data,12,19).".com";

// check to see if this is a refered paged

unset($depname);
$department = $_REQUEST['department'];
$depname = $_REQUEST['depname'];
$vendor = $_REQUEST['vendor'];
$price = $_REQUEST['price'];



$ref =$_REQUEST['ref'];

// get parent department if dep chosen
if(strlen($department) > 2) {
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `departments` WHERE `dept_ID` = '.substr($department,0,2) ;
	$result = mysqli_query($db, $sql);
	mysqli_close($db);
	if($result) $dep=mysqli_fetch_assoc($result);
}

if($vendor){
    //Open Vendor Database And Store It In A Local Array
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `vendors` WHERE `vendor_ID`='.$vendor;
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    if($result) {
    	$vendor_info=mysqli_fetch_assoc($result);
    	$depname =  $vendor_info['vendor_name'];
    }
}

$x = $price-5;
$y = $price+5;

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

// select the right query
$sql = 'SELECT * FROM `items` WHERE `item_pic` IS NOT NULL ORDER BY RAND() LIMIT 100';
if($recno) $sql = 'SELECT * FROM `items` WHERE `item_ID` = '.$recno;
if($vendor) $sql = "SELECT * FROM `items` WHERE `vendor_ID` =".$vendor." AND `item_pic` IS NOT NULL";
if($department) $sql = "SELECT * FROM `items` WHERE `dept_ID` LIKE '".$department."' AND `item_pic` IS NOT NULL ORDER BY RAND() LIMIT 100";

$result = mysqli_query($db, $sql);

if($result) {
	$num_results = mysqli_num_rows($result);
}
mysqli_close($db);

for($i=0; $i<$num_results; $i++){         //Iniate The Loop
	$row1=mysqli_fetch_assoc($result);       //Fetch The Current Record
	$item[$i]['description']=stripslashes($row1['item_desc']);
	$item[$i]['pic']=$row1['item_pic'];
	$item[$i]['retail']=$row1['item_retail'];
	$item[$i]['recno']=$row1['item_ID'];
	$item[$i]['department']=$row1['dept_ID'];
	$item[$i]['vendor']=$row1['vendor_ID'];
	$item[$i]['details']=$row1['item_details'];
	$item[$i]['loh']=$row1['item_qty'];
}

$_SESSION['sql']=addslashes($sql);

unset($no_results);

if($num_results<1) {
	$no_results = "We are working as fast as we can to get all of our categories up on to the new Web Site<br />
	Please check back with us soon or contact us at (802) 863-4644<br />
	if you did not find what you were looking for.<br />";
}

?>
<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="images/HM.ICO">
	<title>Homeport Online - Homeport Online - Burlington Vermont Source For: Housewares, Furniture, Kitchen Accessories, and More (a)</title>
	<meta name="description=" content="
													Located on Burlington's pedestrian only Church Street, 
													Homeport has three and a half floors of everything you want for your home. 
													From kitchen gadgets to floor lamps, placemats to sofas, and candles to shower curtains, 
													we probably have what you need, even if you didn't know you needed it!"/>

  <script>
  function pop_clear(el_id)
  {
      if(el_id) {
      document.getElementById(el_id).style.visibility  = "hidden";
      } else{
      var el_id = document.getElementById("screen").title ;
      document.getElementById(el_id).style.visibility  = "hidden";
      }
      document.getElementById("screen").style.visibility  = "hidden";
  }
  function pop(el_id)
  {
    var doc_width = document.documentElement.clientWidth;
    doc_width = doc_width/2-350;
    document.getElementById(el_id).style.left = doc_width+"px";
    document.getElementById(el_id).style.top = "100px";
    document.getElementById(el_id).style.visibility  = "visible";
    document.getElementById("screen").style.visibility  = "visible";
    document.getElementById("screen").title  = el_id;
  }
  function cart(recno){
    window.open('cart2013/addToCart.php?recno='+recno,'_blank');
    if(recno){
      document.getElementById("basketCase").src = "images/full.png";
    }
  }
  function clicker(recno)
  {
   var adr = "count.php?item="+recno.toString();
   window.open(adr,"counc", "height=10,width=10,top=500,left=500,menubars=0");
  }
  function reglog(recno){
    window.open('registry2013/regLog.php?recno='+recno,'_blank');
  }
  function balPop()
{
      var balwin = window.open('checkBal.php','popUpWindow','height=379,width=602,left=150,top=150,resizable=0,scrollbars=0,menubar=0,status=0,titlebar=0')
      balwin.focus();
}
  </script>
<meta property="og:image" content="images/hplogosm.png"/>
</head>
<body>
	<div title="" onclick=" pop_clear()" id="screen" class="blackout"></div>
	<div id="banner">
		<a href="index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a>
		<div style=" margin-top: -30px" id="department"><br />802-863-4644</div>
  		<?php if($depname){ ?>
		<div style=" margin-top: -30px" id="department" class="deplink"><br /><br />
		<a href="departments/">Departments</a>
		<a href="index.php?department=<?= $dep['depnum'] ?>&depname=<?= preg_replace('/\&/', 'And', $dep['department']) ?>">
			<?php if($dep['department']){ ?> : <?= $dep['department'] ?> <?php } ?>
		</a>
		: <?= $depname ?></div>
		<?php } ?>
		<div id="menu">
			<ul>
				<li><a href="index.php" class="menubutton">HOME</a></li>
				<li><a href="registry2013" class="menubutton">REGISTRY</a></li>
				<li><a href="departments" class="menubutton">DEPARTMENTS</a></li>
			</ul>
			<form name="searcharoo" action="search/index.php" method="post">
			<img class="bumpdown"  alt="Search:" width="25" src="images/Search.png" onClick="document.searcharoo.submit()"/><a class="searchbutton" onClick="document.searcharoo.submit()">Search</a>
			<input name="search" size="15" type="text" />
			<?php if($cartfull){ ?>
			<a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="images/full.png" /></a>
			<?php }else{ ?>
			<a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="images/empty.png" /></a>
			<?php } ?>
			</form>
		</div>
	</div>
	<br /><br /><br />
	<div id="middle" >
		<?php if($no_results){ ?>
		<h3><?= $no_results ?></h3><br />
		<img src="images/awkward.png" border="0" />
		<?php  }
		for($i=0; $i<$num_results; $i++){
			$img = resolve($item[$i]['pic']);
			$skew = rand(0,6);
		?>
		<div onclick=" pop('xxx<?= $i ?>')" class="polaroid<?= $skew ?>" >
			<img style=" max-width: 200px; max-height: 250px" src="<?= $img ?>" alt="No Image Available For: " />
			<br />
			<?= $item[$i]['description'] ?>
		</div>
		<div class="popup" id="xxx<?= $i ?>">
        <div id="popwindow">
            <div class="hiddeninfo">
            <?php if($item[$i]['details']){ ?>
                <?= $item[$i]['details'] ?>
            <?php }else{ ?>
                For more information about<br />
                <span style="font-size: 14px; font-weight: bold;"><?= $item[$i]['description'] ?></span><br />
                Contact Homeport at (802) 863-4644<br />
                or by email <?= $homeportEmail ?>
            <?php } ?>
            <br /><br />
            <?php if(substr($item[$i]['department'],0,2)=="23"){ ?>
                <div style="font-size: 12px; font-style: italic">please keep in mind that seasonal items like these are not always in stock.
                We make every effort to verify for you within 24 hours and, of course, feel free to contact us at any time
                for immideate stock verification.</div>
            <?php } ?>
            </div>
            <div id="popwinimg">
                <img class="winimg" src="<?= $img ?>" alt="No Image Available For: " />
            </div>
            <div id="popwindow_description">
                <a class="closewin" onclick="pop_clear('xxx<?= $i ?>')">X</a>
                <h4><?= $item[$i]['description'] ?></h4>
<?php if(substr($item[$i]['details'],0,23)=="Available In Store Only"){ ?>
                Available For In Store Pick Up Only
<?php } ?>
                <h3>$<?= number_format(floatval($item[$i]['retail']),2) ?></h3>
                <a class="button2" onclick="cart('<?= $item[$i]['recno'] ?>')" >Add to Cart &#8594;</a><br />
                <a class="button3" onclick="reglog('<?= $item[$i]['recno'] ?>')">Add to Gift Registry &#9829;</a>
                <div id="social">
                    <!-- Pintrest Pin -->
                     <a data-pin-config="below" href="//pinterest.com/pin/create/button/?url=http://www.homeportonline.com/index.php?recno=<?= $item[$i]['recno'] ?>&media=http://www.homeportonline.com/images/product/<?= $img ?>&description=Homeport - <?= $item[$i]['description'] ?> - <?= $item[$i]['retail'] ?>" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png"  /></a>
                    <!-- Facebook Like -->
                     <a href="http://www.facebook.com/sharer.php?u=http://www.homeportonline.com/index.php?recno=<?= $item[$i]['recno'] ?>" target="_blank"  ><img src="images/facebook_button.png" height="20" border="0" /></a>
                    <!-- Tweet -->
                    <a class="cursor" onclick="window.open('http://twitter.com/home?status=Check Out Homeport: <?= $item[$i]['description'] ?> www.homeportonline.com/index.php?recno=<?= $item[$i]['recno'] ?>','Share this on Twitter','height=350,width=650,top=200,left=300,resizable');"  >
                    <img height="20" alt="Twitter Share" src="images/twitter_button.png" /></a>
                </div>
            </div>
            <div id="popwindow_bar">

                <div id="popwindow_buttons">
                    <h3>See More...</h3><a class="button" href="index.php?department=<?= $item[$i]['department'] ?>">Similar<br />To This</a>
                    <a class="button" href="index.php?vendor=<?= $item[$i]['vendor'] ?>">From<br />This Company</a>
                    <a class="button" href="index.php?price=<?= $item[$i]['retail'] ?>">In This<br />Price Range</a>
                </div>
            </div>
        <?php if($item[$i]['loh'] == 0){ ?>
        <div class="os"><img src="images/os.png" alt="This Item Is Temporarily Out Of Stock" title="<?= $item[$i]['loh'] ?>" /> </div>
        <?php } ?>
        </div>
    </div>
<?php } ?>
<div id="result"></div>
</div>
<br />
</body>
</html>