<?php
 /*
  File Produced By: 	Tom Anderson - C00174844 - 2015
  Purpose: 				Sql queries to add a customer to the database
 */
session_start();
include '../common/db.inc.php';

	$sql = "SELECT max(customerNumber) as MAXNUM FROM customer";
		if (!$result = mysql_query($sql, $con))
{	die ('Error in querying the database, query 1' . mysql_error());
}	$rowcount = mysql_affected_rows();
		if ($rowcount = 1) 
	{
		$row= mysql_fetch_array($result);
		$_SESSION['accountNumber'] = $row['MAXNUM'] +1;
	} else 
	{
		$_SESSION['accountNumber'] = 1;
	}
	$_SESSION['firstname'] = $_POST['firstname'];
	$_SESSION['surname'] = $_POST['surname'];
		$sql = "INSERT INTO customer(customerNumber,
	firstName, surname, address1, address2,
	address_town, address_county, birthDate,
	telephone, email, occupation, salary, guarantor)
	VALUES( '$_SESSION[accountNumber]', '$_POST[firstname]',
	'$_POST[surname]', '$_POST[address1]',
	'$_POST[address2]', '$_POST[town]',
	'$_POST[county]', '$_POST[dob]',
	'$_POST[phone]', '$_POST[myemail]', 
	'$_POST[occupation]',
	'$_POST[salary]', '$_POST[guarantor]');";
		if (!$result = mysql_query($sql, $con))
	{
		die ('Error in querying the database, query 2' . mysql_error());
	}		
			
	mysql_close($con);
header ("location: add_customer.html.php") ;

?>
