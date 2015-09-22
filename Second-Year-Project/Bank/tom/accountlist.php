<?php
/*
* File Produced By: Tom Anderson - C00174844 - 2015
* Purpose: 			
*/
include '../common/db.inc.php';
$sql = "  SELECT DISTINCT accountHolder.customerNumber, accountHolder.accountNumber, accountType, balance FROM accountHolder
 
 		INNER JOIN 
		(SELECT  accountNumber , balance FROM `loanAccount` where closed != 1
		UNION
		SELECT  accountNumber , balance FROM `currentAccount` where closed != 1
		UNION
		SELECT accountNumber , balance FROM `loanAccount` where closed != 1) as accounts
		INNER JOIN
		(SELECT customer.customerNumber FROM customer WHERE `deleted` != 1) as customers
        on accountHolder.accountNumber = accounts.accountNumber
        ORDER BY accountNumber;
		";

if (!$result = mysql_query ($sql, $con))
{
	die ('Error in querying the database in account select box' . mysql_error());
}

echo "<select name='selectaccount' id='selectaccount' disabled onchange='setAccount(this.selectedIndex)'>";
	echo "<option selected disabled hidden value=''></option>";
while ($row = mysql_fetch_array($result))
{
	$type = UCWORDS( strtolower($row['accountType']));
	echo "<option value = '$row[customerNumber]#$row[balance]#$type#$row[accountNumber]'>$type Account : $row[accountNumber]</option>";
}

echo "</select>";
mysql_close($con);

?>