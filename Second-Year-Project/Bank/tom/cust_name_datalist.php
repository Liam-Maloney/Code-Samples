<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include '../common/db.inc.php';

$sql = "SELECT * FROM `customer` WHERE `deleted` = 0 ORDER BY surname";

if (!$result = mysql_query ($sql, $con))
{
	die ('Error in querying the database' . mysql_error());
}

echo "<script>var namearray = new Array();</script><input name='selectname' id='selectname' list='custnames' onblur='populate(this.value)'></input>";
	echo "<option selected disabled hidden value=''></option><datalist id='custnames' >";
while ($row = mysql_fetch_array($result))
{
	$dob = $row['birthDate'];
	$birthDate = date("Y-m-d", strtotime($dob));
	echo "<script> 
				namearray['$row[surname], $row[firstName]'] = {'id': '$row[customerNumber]','fname': '$row[firstName]','sname': '$row[surname]','address1': '$row[address1]','address2': '$row[address2]','town': '$row[address_town]','county': '$row[address_county]','dob': '$birthDate','phone': '$row[telephone]','email':'$row[email]','occupation': '$row[occupation]','salary': '$row[salary]','guarantor': '$row[guarantor]', 'normalname': '$row[firstName]'+' '+'$row[surname]',
				'address':  '$row[address1]<br />$row[address2]<br />$row[address_town]<br />$row[address_county]'};	
				</script>";
	
	echo "<option value ='$row[surname], $row[firstName]'></option>";
}

echo "</datalist>";
mysql_close($con);

?>