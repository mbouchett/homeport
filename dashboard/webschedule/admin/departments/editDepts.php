<?php
//editDepts.php 2018/06
// webschedule login
include "/home/homeportonline/crc/2018.php";
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('location: ../../');
    die;
  }

$message=$_REQUEST['message'];

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `sch_dept` ORDER BY `sch_dept_name`';
$result = mysqli_query($db, $sql);
$depCount=mysqli_num_rows($result);
mysqli_close($db); 
for($i = 0;$i < $depCount; $i++) {
	$depts[$i]=mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Departments</title>
</head>

<body>
<br />
Edit Departments
<br />
<form action="processEditDepts.php" method="post">
<table>
	<tr><td>Department</td><td>Abbreviation</td><td>Color#</td><td style="text-align: center;">X</td></tr>
<?php   for($i=0; $i<$depCount; $i++){  ?>
<tr>
	<td>
		<input type="text" name="name[<?=$i?>]" value="<?=$depts[$i]['sch_dept_name']?>" >
		<input type="hidden" name="dept_ID[<?=$i?>]" value="<?=$depts[$i]['sch_dept_ID']?>">
	</td>
	<td><input type="text" name="abb[<?=$i?>]" value="<?=$depts[$i]['sch_dept_abbv']?>" ></td>
	<td bgcolor="#<?=$depts[$i]['sch_dept_color']?>">
		<input style="background-color: #<?=$depts[$i]['sch_dept_color']?>; border: none;" type="text" name="color[<?= $i ?>]" value="<?=$depts[$i]['sch_dept_color']?>">
	</td>
	<td><input type="checkbox" name="del[<?=$i?>]" ></td>
</tr>
<?php } ?>
<tr><td colspan="4"><small><small>Try and keep department Abbreviation to 3 chrs</small></small></td></tr>
<tr>
	<td align="center" colspan="4">
		<input type="submit" value="Save Changes" />
		<input value="Exit" onclick="parent.location='../'" type="button">
	</td>
</tr>

<?php
if($message)
    echo '<tr><td align="center" colspan="4"><div style="font-weight: bold; color: #009900">'.$message.'</div></td></tr>'."\n";
    unset($message);
?>

</table>
</form>

<br />
<form action="processAddDept.php" method="post">
<table>
	<tr><td>Department Name</td><td>Abbreviation</td><td>Color#</td><td></td></tr>
	<tr>
		<td><input type="text" name="name"></td>
		<td><input type="text" name="abb"></td>
		<td><input type="text" name="color"></td>
		<td align="center"><input type="submit" value="Add Department" /></td>
	</tr>
</table>
</form>
<br />
<table>
<tr><td bgcolor="#FF0000">FF0000</td><td bgcolor="#00FFFF">00FFFF</td><td bgcolor="#0000FF">0000FF</td><td bgcolor="#FF0080">FF0080</td><td bgcolor="#FFFF00">FFFF00</td><td bgcolor="#00FF00">00FF00</td></tr>
<tr><td bgcolor="#FF00FF">FF00FF</td><td bgcolor="#FFFFFF">FFFFFF</td><td bgcolor="#C0C0C0">C0C0C0</td><td bgcolor="#FF8040">FF8040</td><td bgcolor="#808000">808000</td><td bgcolor="#408080">408080</td></tr>
<tr><td bgcolor="#F778A1">F778A1</td><td bgcolor="#C38EC7">C38EC7</td><td bgcolor="#C2DFFF">C2DFFF</td><td bgcolor="#348781">348781</td><td bgcolor="#C3FDB8">C3FDB8</td><td bgcolor="#FDD017">FDD017</td></tr>
</table>
</body>
</html>
