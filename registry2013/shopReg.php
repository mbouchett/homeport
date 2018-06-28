<?php
//shopReg.php 2018/05
// shop Gift Registry
include "/home/homeportonline/crc/2018.php";
include "/home/homeportonline/crc/functions/f_resolve.php";
date_default_timezone_set('America/New_York');

header('Cache-Control: max-age=900');
$regnum=$_REQUEST['regnum'];
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
    //Save the new Visit Number
    $fp = fopen("visit.txt", "w");
        fwrite($fp, $idNum);
    fclose($fp);            //close the visit file
}
//Look Up Account
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `registry` WHERE `reg_ID` = \''.trim($regnum).'\' ' ;
$result = mysqli_query($db, $sql); // create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//load the result into an associative array
$row=mysqli_fetch_assoc($result);

$r[1]=stripslashes($row['reg_partner1F']);
$r[2]=stripslashes($row['reg_partner2F']);
$r[3]=stripslashes($row['reg_partner1L']);
$r[4]=stripslashes($row['reg_partner2L']);
$r[5]=stripslashes($row['reg_event_date']);

// load couples registry
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * 
		  FROM `reg_items` 
		  LEFT JOIN `items` USING(`item_ID`)
		  WHERE `reg_ID` = \''.trim($regnum).'\' 
		  ORDER BY `ri_prio`' ;
$result = mysqli_query($db, $sql);
$num_results=mysqli_num_rows($result);
mysqli_close($db);
for($i=0; $i<$num_results; $i++){
    $item[$i] = mysqli_fetch_assoc($result);
}
$itemcount = count($item);
if($num_results<1) {
 $no_results = "$r[1] & $r[2] Have not added any items to the registry yet. Please check back soon to see if they have.";
}

?>
<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/regstyle.css" type="text/css" />
  <title>Homeport Online Gift Registry For: <?= $r[1] ?> & <?= $r[2] ?></title>
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
  function cart(recno,regnum,qty,price){
    window.open('../cart2013/addToCart.php?recno='+recno+'&regnum='+regnum+'&qty='+qty+'&price='+price,'MyWindow','left=125,top=150,menubar=0,scrollbars=1,width=800,height=500');
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
    window.open('registry2013/regLog.php?recno='+recno,'MyWindow','left=125,top=150,menubar=0,scrollbars=1,width=850,height=500');
  }
  </script>
  <meta property="og:image" content="images/hplogosm.png"/>
</head>
<body>
<div title="" onclick=" pop_clear()" id="screen" class="blackout"></div>
<div id="banner">
  <a href="../index.php"><img alt="Homeport Logo" src="images/hplogosm.png" /></a>
  <div id="menu">
      <ul>
        <li><a href="../index.php" class="menubutton">HOME</a></li>
        <li><a href="index.php" class="menubutton">REGISTRY</a></li>
      </ul>
        <?php if($cartfull){ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="images/full.png" /></a>
        <?php }else{ ?>
        <a class="cursor" onclick="cart()" ><img id="basketCase" class="bumpdown2" alt="Cart" src="images/empty.png" /></a>
        <?php } ?>
  </div>
</div>
<br />
<h4>Homeport Online Gift Registry For: <br /><img class="cartpic" src="images/gift_box.png" /><br /><?= $r[1] ?> & <?= $r[2] ?></h4>
<br /><br /><br />
<div id="middle" >
<?php if($no_results){ ?>
    <h3><?= $no_results ?></h3><br />
    <img src="images/awkward.png" border="0" />
<?php  }
  for($i=0; $i<$itemcount; $i++){
    $skew = rand(0,6);
    $qty = $item[$i]['ri_qty']-$item[$i]['ri_sold'];
?>
    <!-- clicker('<?= $img ?>');  -->
    <div onclick=" pop('xxx<?= $i ?>')" class="polaroid<?= $skew ?>" >
        <img style=" max-width: 200px; max-height: 250px" src="<?= resolve($item[$i]['item_pic']) ?>" alt="No Image Available For: " />
        <br />
        <?= $item[$i]['item_desc'] ?>
        <?php if($qty==0 && $item[$i]['ri_sold']!=-1){ ?>
            <h6>Purchased</h6>
        <?php } ?>
        <?php if($item[$i]['ri_sold']==-1){ ?>
            <h6>Out-Of-Stock</h6>
        <?php } ?>
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
                or by email homeport@homeportonline.com
            <?php } ?>
            <br /><br />
            <?php if($item[$i]['dept_ID']=="23"){ ?>
                <div style="font-size: 12px; font-style: italic">please keep in mind that seasonal items like these are not always in stock.
                We make every effort to verify for you within 24 hours and, of course, feel free to contact us at any time
                for immideate stock verification.</div>
            <?php } ?>
            </div>
            <div id="popwinimg">
                <img class="winimg" src="<?= resolve($item[$i]['item_pic']) ?>" alt="No Image Available For: " />
            </div>
            <div id="popwindow_description">
                <a class="closewin" onclick="pop_clear('xxx<?= $i ?>')">X</a>
                <h4><?= $item[$i]['item_desc'] ?></h4>
                <h3>$<?= number_format($item[$i]['ri_price'],2) ?></h3>
                <?php if($qty==0 && $item[$i]['ri_sold']!=-1){ ?>
                This item has already been purchased.
                <?php }else if($item[$i]['ri_sold']==-1){ ?>
                This Item Is Currently Unavailable For Purchase
                <?php }else{ ?>
                <a class="button2" onclick="cart('<?= $item[$i]['item_ID'] ?>','<?= $regnum ?>','1','<?= $item[$i]['ri_price'] ?>')" >Add to Cart  &#8594;</a><br />
                <?= $r[1] ?> & <?= $r[2] ?> are still hoping for <?= $qty ?> of these
                <?php } ?>
                <h5>*Hover over image to see description.</h5>
            </div>
        </div>
    </div>
<?php } ?>
<div id="result"></div>
</div>
<br />

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
} catch(err) {}</script>
</body>
</html>