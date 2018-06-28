<?php
//rev 2015/11
session_start(); // Resume up your PHP session!
if(!isset($_SESSION['username'])){
	echo 'No Authorization'.$username;
	exit;
}
date_default_timezone_set('America/New_York');
$arch = $_REQUEST['file'];
//Load Searchess Into Array
if($arch) $fp = fopen("websearch/".$arch, "r");
if(!$arch) $fp = fopen('searches.txt', "r");
    // get the search records and store them in the searches array
     $i=0;
       while (!feof($fp)) {
          $item= fgetcsv($fp, ",");
          $searches[$i] =array($item[0],$item[1],$item[2],$item[3]);
          $i++;
       }
fclose($fp);         		    //close the searches file
$recCount=count($searches); 	//How many searches in the list

// Load a file directory into an array
$path = "websearch/"; //Enter sub paths to picture folder
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
rsort($dirItem);
$dirCount=count($dirItem);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Homeport Online Search Report</title>
  <link rel="SHORTCUT ICON" href="dash.ico">
</head>
<body>
<table align="center">
    <tr>
        <td align="center"><input value="Return To Dashboard" onclick="parent.location='dashboard.php'" type="button">
        <input value="Log Out" onclick="parent.location='loggedOut.php'" type="button">
        </td>
    </tr>
</table>
<br />
 <center><b>Homeport Online Search Report</b></center>

<table align="center">
    <tr>
        <td>
            <table align="center" border="4" style="border-color: #B8860B">
                <tr>
                    <td>Search#</td><td>Search Term</td><td>Search Date</td><td>Time</td><td>Hits</td>
                </tr>
                <tr>
                <?php for($i=0; $i<$recCount-1; $i++){ ?>
                    <td><?=$recCount-$i-2?></td>
                    <td><?=$searches[$recCount-$i-2][0]?></td>
                    <td><?=$searches[$recCount-$i-2][1]?></td>
                    <td><?=$searches[$recCount-$i-2][2]?></td>
                    <td><?=$searches[$recCount-$i-2][3]?></td>
                </tr>
                <?php } ?>
            </table>
        </td>
        <td valign="top">
            <table align="center">
                <?php for($i=0; $i<$dirCount; $i++){ ?>
                <tr><td><a href="searchReport.php?file=<?= $dirItem[$i] ?>"><?= substr($dirItem[$i],0,-4) ?></a></td></tr>
                <?php } ?>
            </table>
        </td>
    </tr>
</table>
<br />
</body>

</html>