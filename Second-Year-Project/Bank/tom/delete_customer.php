<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
session_start();
include "verify_user.html.php";
include '../common/db.inc.php';
$sql = "SELECT accountHolder.accountNumber as number,  accountHolder.accountType as type
FROM accountHolder INNER JOIN
(SELECT  accountNumber, closed  FROM `loanaccount` where closed != 1
UNION
SELECT  accountNumber, closed  FROM `currentaccount` where closed != 1
UNION
SELECT accountNumber, closed  FROM `loanaccount` where closed != 1) as accounts
ON accountHolder.accountNumber = accounts.accountNumber 
where accountHolder.customerNumber = '$_POST[selectnumber]'
ORDER BY accountHolder.accountNumber;";
if (!$result = mysql_query($sql, $con))
{
	die ('Error in querying the database, query 1' . mysql_error());
}	
if ( mysql_affected_rows() != 0)
{
	$_SESSION['returnMessage'] = '"Cannot delete customer with the following open accounts,\\n';
	while ($row = mysql_fetch_array($result))
	{	
	$_SESSION['returnMessage'] = $_SESSION['returnMessage']."$row[type] acccount Number : $row[number]\\n";
	}	
	$_SESSION['returnMessage'] = $_SESSION['returnMessage'].'"';
} else 
	
	{
$sql = "UPDATE customer
		SET `deleted` = '1'
		WHERE customerNumber = '$_POST[selectnumber]'";
	
if (!$result = mysql_query($sql, $con))
{
	die ('Error in querying the database, query 2' . mysql_error());
}	else 
	{
		$_SESSION['returnMessage'] = "'Successfully deleted customer number $_POST[selectnumber].'";
	
	}
	
	}	
	mysql_close($con);
header ("location: delete_customer.html.php") ;
?>
