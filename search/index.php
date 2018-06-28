<?php
//index.php 2018/01
// search
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";

header('Cache-Control: max-age=900');
date_default_timezone_set('America/New_York');

$search = $_POST['search'];                 //Get the search key via form
if(!$search) $search = $_REQUEST['search']; //Get the search key via URL

// If empty search return
if(!$search){
    header('Location: ../index.php?ref=browsethis');
    die;
}

$saveit = TRUE;                             // set to save the search event

if(substr($search,0,3) == "***") {          // if the search is prefixed ***
$search = substr($search,3);                // trim the prefix
$saveit = FALSE;                            // set to NOT save the search event
}

$depname = $search;
session_start(); // Resume up your PHP session!
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
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cart` WHERE `customer` = \''.trim($visitID).'\' AND `cart_purch_date` IS NULL ' ;
$result = mysqli_query($db, $sql); // create the query object
$cart_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection
if($cart_results>0) $cartfull = 1;

//clean the search key
//$search = strip_tags($search);
//mysql_escape_string($search);

// convert the search to lower case
$search = strtolower($search);
// remove S
if(substr($search,-1)=="s") $search = substr($search,0,-1);

// Break Up The Words
$xsearch = explode(" ",$search,3);
$xcount = count($xsearch);
//echo $xcount." - ".$xsearch[0]." - ".$xsearch[1]." - ".$xsearch[2];
if($xcount < 1) $xcount=1;

//Only one search word
if($xcount == 1){
$sql = "SELECT *
        FROM `items`
        WHERE (`item_desc` LIKE '%".$search."%' || `item_details` LIKE'%".$search."%')
        AND `item_pic` IS NOT NULL";
}

//More than one search word
if($xcount > 1){
$sql = "SELECT *
        FROM `items`
        WHERE
              (`item_desc` LIKE '%".$xsearch[0]."%' || `item_details` LIKE'%".$xsearch[0]."%') AND
              (`item_desc` LIKE '%".$xsearch[1]."%' || `item_details` LIKE'%".$xsearch[1]."%')
        AND `item_pic` IS NOT NULL";
}

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$result = mysqli_query($db, $sql);
$itemCount = mysqli_num_rows($result);
mysqli_close($db);

for($i=0; $i<$itemCount; $i++){
    $item[$i]=mysqli_fetch_assoc($result);
}

$hits = $itemCount;
unset($no_results);
if($hits<1) {
 //$no_results = "Either you just made up ".$search." or we don't have anything that matches ".$search."<br />... This is really awkward for one of us!";
$no_results = "We are working as fast as we can to get all of our categories up on to the new Web Site<br />
Please check back with us soon or contact us at (802) 863-4644<br />
if you did not find what you were looking for.<br />";
}
// save the search key
$time = date('h:ia');
$date = date('F jS Y');
if($saveit) {
	$keyPath="../dashboard/searches.txt";
	$fp = @fopen("$keyPath", "a");
	$search = str_replace(',',' ',$search);
	$saveString = $search.','.$date.','.$time.','.$hits."\n";
	fwrite($fp,$saveString);
	fclose($fp);
}

//Load our email address
$fp = fopen('../email.txt', "r");  //Open The File For Reading
  $data = fgets($fp);                    //Load The Value
fclose($fp);
$homeportEmail = substr($data,12,19).".com";
?>
<!DOCTYPE html>

<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="../images/HM.ICO">
  <title>Homeport Online - Burlington Vermont Source For: Housewares, Furniture, Kitchen Accessories, and More</title>
  <meta name="description=" content="Located on Burlington's pedestrian only Church Street, Homeport has three and a half floors of everything you want for your home. From kitchen gadgets to floor lamps, placemats to sofas, and candles to shower curtains, we probably have what you need, even if you didn't know you needed it!"/>
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
    window.open('../cart2013/addToCart.php?recno='+recno,'MyWindow','left=125,top=150,menubar=0,scrollbars=1,width=800,height=500');
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
    window.open('../registry2013/regLog.php?recno='+recno,'MyWindow','left=125,top=150,menubar=0,scrollbars=1,width=850,height=500');
  }
  </script>
  <meta property="og:image" content="../images/hplogosm.png"/>
</head>
<body>
<div title="" onclick=" pop_clear()" id="screen" class="blackout"></div>
<div id="banner">
  <a href="http://www.homeportonline.com"><img alt="Homeport Logo" src="../images/hplogosm.png" /></a>
  <div style=" margin-top: -30px" id="department"><br />802-863-4644</div>
  <?php if($depname){ ?>
  <div id="department"><br />Looking For: <?= $depname ?></div>
  <?php } ?>
  <div id="menu">
      <ul>
        <li><a href="../index.php" class="menubutton">HOME</a></li>
        <li><a href="../registry2013" class="menubutton">REGISTRY</a></li>
        <li><a href="../departments" class="menubutton">DEPARTMENTS</a></li>
      </ul>
    <form name="searcharoo" action="index.php" method="post">
        <img class="bumpdown"  alt="Search:" width="25" src="../images/Search.png" onClick="document.searcharoo.submit()"/><a class="searchbutton" onClick="document.searcharoo.submit()">Search</a>
        <input name="search" size="15" type="text" />
        <?php if($cartfull){ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="../images/full.png" /></a>
        <?php }else{ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="../images/empty.png" /></a>
        <?php } ?>
    </form>
  </div>
</div>
<br /><br /><br />
<div id="middle" >
<?php if($no_results){ ?>
    <h3><?= $no_results ?></h3><br />
    <img src="../images/awkward.png" border="0" />
<?php  }
  for($i=0; $i<$itemCount; $i++){
    $img=resolve($item[$i]['item_pic']);
    $skew = rand(0,6);
?>
    <!-- clicker('<?= $img ?>');  -->
    <div onclick=" pop('xxx<?= $i ?>')" class="polaroid<?= $skew ?>" >
        <img style=" max-width: 200px; max-height: 250px" src="<?= $img ?>" alt="No Image Available For: " />
        <br />
        <?= $item[$i]['item_desc'] ?>
    </div>
    <div class="popup" id="xxx<?= $i ?>">
        <div id="popwindow">
            <div class="hiddeninfo">
            <?php if($item[$i]['item_details']){ ?>
                <?= $item[$i]['item_details'] ?>
            <?php }else{ ?>
                For more information about<br />
                <span style="font-size: 20px; font-weight: bold;"><?= $item[$i]['item_desc'] ?></span><br />
                Contact Homeport at (802) 863-4644<br />
                or by email <?= $homeportEmail ?>
            <?php } ?>
            <br /><br />
            <?php if(substr($item[$i]['dept_ID'],0,2)=="23"){ ?>
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
                <h4><?= $item[$i]['item_desc'] ?></h4>
                <h3>$<?= number_format($item[$i]['item_retail'],2) ?></h3>
                <a class="button2" onclick="cart('<?= $item[$i]['item_ID'] ?>')" >Add to Cart</a><br />
                <a class="button3" onclick="reglog('<?= $item[$i]['item_ID'] ?>')">Add to Gift Registry</a>
                <div id="social">
                    <!-- Pintrest Pin -->
                     <a data-pin-config="below" href="//pinterest.com/pin/create/button/?url=http://www.homeportonline.com/index.php?recno=<?= $item[$i]['item_ID'] ?>&media=<?= $img ?>&description=Homeport - <?= $item[$i]['item_desc'] ?> - <?= $item[$i]['item_retail'] ?>" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png"  /></a>
                    <!-- Facebook Like -->
                     <a href="http://www.facebook.com/sharer.php?u=http://www.homeportonline.com/homeport_remix/index.php?recno=<?= $item[$i]['item_ID'] ?>" target="_blank"  ><img src="../images/facebook_button.png" height="20" border="0" /></a>
                    <!-- Tweet -->
                    <a class="cursor" onclick="window.open('http://twitter.com/home?status=Check Out Homeport: <?= $item[$i]['item_desc'] ?> www.homeportonline.com/index.php?recno=<?= $item[$i]['item_ID'] ?>','Share this on Twitter','height=350,width=650,top=200,left=300,resizable');"  >
                    <img height="20" alt="Twitter Share" src="../images/twitter_button.png" /></a>
                </div>
            </div>
            <div id="popwindow_bar">
                <div id="popwindow_buttons">
                    <h3>See More...</h3><a class="button" href="../dep.php?department=<?= trim($item[$i]['dept_ID']) ?>">Similar<br />To This</a>
                    <a class="button" href="../index.php?vendor=<?= $item[$i]['vendor_ID'] ?>">From<br />This Company</a>
                    <a class="button" href="../index.php?price=<?= $item[$i]['item_retail'] ?>">In This<br />Price Range</a>
                </div>
            </div>
        <?php if($item[$i]['item_qty'] == 0){ ?>
        <div class="os"><img src="../images/os.png" alt="This Item Is Temporarily Out Of Stock" title="<?= $item[$i]['item_qty'] ?>" /> </div>
        <?php } ?>
        </div>
    </div>
<?php } ?>
<div id="result"></div>
</div>
<br/>
</body>
</html>