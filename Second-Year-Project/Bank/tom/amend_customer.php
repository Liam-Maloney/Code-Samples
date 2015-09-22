<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include "verify_user.html.php";
include '../common/db.inc.php';
$sql = "UPDATE customer
		SET firstName = '$_POST[fname]', surname = '$_POST[sname]',address1 = '$_POST[address1]',
		address2 = '$_POST[address2]', address_town = '$_POST[town]', address_county = '$_POST[county]',email = '$_POST[myemail]',birthDate = '$_POST[dob]' ,
		telephone = '$_POST[phone]', occupation = '$_POST[occupation]',
		salary = '$_POST[salary]',guarantor = '$_POST[guarantor]'
		WHERE customerNumber = '$_POST[selectnumber]'";
	
if (!$result = mysql_query($sql, $con))
{
	die ('Error in querying the database, query 1' . mysql_error());
}	

	mysql_close($con);
header ("location: amend_customer.html.php") ;
?>
