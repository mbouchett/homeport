<?php
$forward = $_REQUEST['forward'];

// Load a file directory into an array
$path = "images/"; //Enter sub paths to picture folder
$dir_handle = @opendir($path) or die("Unable to open $path");  //using the opendir function
//run the while loop
$xx=0;
while ($file = readdir($dir_handle))
{
	if (substr($file,0,1)<>".") {
   		$dirItem[$xx]=$file;
		$xx=$xx+1;
		}
}
closedir($dir_handle);
$picCount=count($dirItem);

unset($request);
if($forward){
    $request =  "<script type=\"text/javascript\">\n";
    $request .= "window.open('../../dashboard/sms.php?cust=";
    $request .= "Bring To Store&comp=Display Item";
    $request .= "&sku=N/A&desc=display: $forward', 'newwindow')\n";
    $request .= "</script>\n";
}
?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Displays</title>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
top: 10px;
left: -1000px;
border: 1px solid Black;
visibility: hidden;
color: black;
text-decoration: none;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 10;
left: 5px; /*position where enlarged image should offset horizontally */

}
</style>

</head>

<body>
<?= $request ?>
    <h1>At The Warehouse</h1>
            <?php
            $bump = 0;
            for($i=0; $i<$picCount; $i++){
                if(substr($dirItem[$i],0,1) == "w"){
                    ++$bump;
                    if(($bump-1) % 10 == 0) echo "<br />";
            ?>
              <a class="thumbnail" href="switch.php?filename=<?= $dirItem[$i] ?>" >
              <img title="click to use" border="0" height="100" src="images/<?= $dirItem[$i] ?>">
              <span><img title="click to enlarge" src="images/<?= $dirItem[$i] ?>" /></span></a>
             <?php } } ?>
    <hr>
    <h1>In Use</h1>
            <?php
            $bump = 0;
            for($i=0; $i<$picCount; $i++){
                if(substr($dirItem[$i],0,1) != "w"){
                    ++$bump;
                    if(($bump-1) % 10 == 0) echo "<br />";
            ?>
              <a class="thumbnail" href="switch.php?filename=<?= $dirItem[$i] ?>" >
              <img title="click to return" border="0" height="100" src="images/<?= $dirItem[$i] ?>">
              <span><img title="click to enlarge" src="images/<?= $dirItem[$i] ?>" /></span></a>
             <?php } } ?>
</body>

</html>