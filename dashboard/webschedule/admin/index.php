<?php
//index.php 2018/01
// schedule admin
date_default_timezone_set('America/New_York');

session_start(); // Resume up your PHP session!
  if(!isset($_SESSION['username'])){
    header('location: ../../');
    die;
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Schedule Administrator Dashboard</title>
</head>

<body>
<br />
Schedule Administrator Dashboard
<br /><br />
<table>
	<tr>
		<td><input value="Add A New Schedule" onclick="parent.location='addSchedule.php'" type="button" disabled="disabled"></td>
        <td><input value="Edit A Schedule" onclick="parent.location='editSchedule.php'" type="button" disabled="disabled"></td>
       	<td><input value="Delete Old Schedule" onclick="parent.location='deleteSchedule.php'" type="button" disabled="disabled"></td>
	</tr>
	<tr>
		<td><input value="Add or Edit Depts" onclick="parent.location='departments/editDepts.php'" type="button"></td>
		<td><input value="Post A Message" onclick="parent.location='postMessage.php'" type="button" disabled="disabled"></td>
		<td><input value="Employee Info" onclick="parent.location='employeeInfo.php'" type="button" disabled="disabled"></td>
	</tr>
	<tr>
		<td><input value="Change Logins" onclick="parent.location='changePassword.php'" type="button" disabled="disabled"></td>
		<td><input value="Company Info" onclick="parent.location='companyInfo.php'" type="button" disabled="disabled"></td>
		<td><input value="Log Out" onclick="parent.location='logout.php'" type="button" disabled="disabled">
        </td>
	</tr>
    <tr>
    	<td><input value="Post A Job" onclick="parent.location='postJob.php'" type="button" disabled="disabled"></td>
		<td><input value="Re-Name A Schedule" onclick="parent.location='renameSchedule.php'" type="button" disabled="disabled"></td>
		<td><input value="View Applications" onclick="parent.location='reviewApps.php'" type="button" disabled="disabled"></td>
    </tr>
</table>
</body>
</html>