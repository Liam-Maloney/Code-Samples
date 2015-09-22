<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include '../common/db.inc.php';
$sql = "SELECT * FROM `customer` 	
		WHERE `deleted` = 0 	
		ORDER BY customerNumber";

if (!$result = mysql_query ($sql, $con))
{
	die ('Error in querying the database' . mysql_error());
}

echo "<script>var noarray = new Array();</script><input name='selectnumber' id='selectnumber' list='custnumbers' oninput='populate(this.value)'></input>";
	echo "<option selected disabled hidden value=''></option><datalist id='custnumbers' >";
while ($row = mysql_fetch_array($result))
{
	$dob = $row['birthDate'];
	$birthDate = date("Y-m-d", strtotime($dob));
	echo "<script> 
				noarray['$row[customerNumber]'] = {'id': '$row[customerNumber]','fname': '$row[firstName]','sname': '$row[surname]','address1': '$row[address1]','address2': '$row[address2]','town': '$row[address_town]','county': '$row[address_county]','dob': '$birthDate','phone': '$row[telephone]','email':'$row[email]','occupation': '$row[occupation]','salary': '$row[salary]','guarantor': '$row[guarantor]' };	
				noarray['$row[customerNumber]'] = {'id': '$row[customerNumber]','fname': '$row[firstName]','sname': '$row[surname]','address1': '$row[address1]','address2': '$row[address2]','town': '$row[address_town]','county': '$row[address_county]','dob': '$birthDate','phone': '$row[telephone]','email':'$row[email]','occupation': '$row[occupation]','salary': '$row[salary]','guarantor': '$row[guarantor]', 'normalname': '$row[firstName]'+' '+'$row[surname]',
				'address':  '$row[address1]<br />$row[address2]<br />$row[address_town]<br />$row[address_county]' };	
				</script>";
	
	echo "<option value = '$row[customerNumber]'></option>";
}

echo "</datalist>";
mysql_close($con);

?>