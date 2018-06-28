<?php
//Load Company Info Into Array
$fp = fopen($rootLoc.'data/companyInfo.txt', "r");
    // get the Company records and store them in the users array
     $i=0;
       while (!feof($fp)) {
          $item= fgets($fp);
          $compInfo[$i] =$item;
          $i++;
       }
fclose($fp);         		//close the Company file
?>

<table width="100%" vspace="0">
	<tr>
    	<td align="center"><div style="font-size:36px"><img width="200" src="<?=$compInfo[1]?>"> <?=$compInfo[0]?></div></td>
	</tr>
</table>