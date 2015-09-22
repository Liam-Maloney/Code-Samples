<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

$sql = "SELECT customer.customerNumber, accountHolder.accountNumber, accountType, overdraftLimit, balance
		FROM customer, accountHolder, currentAccount
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountNumber = currentAccount.accountNumber AND accountHolder.accountType = 'Current'
		ORDER BY surname desc";	
//this sql query is to get different current acount customers acount set up to be displayed
if(!$result = mysql_query($sql,$con))
	{
		die('Error unable to load accounts ' . mysql_error());
	}

echo "<select name='Accounts' id='Accounts' onclick='myAccounts()'>";
echo "<br><option id='-1' selected disabled hidden value =','></option>";

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Account = $row['accountNumber'];
		$Bal =$row['balance'];
		$Limit =$row['overdraftLimit'];
		$Type =$row['accountType'];
	
		$Details ="$ID,$Account,$Bal,$Limit";
		echo"<option id='$ID' value ='$Details' hidden>$Type $Account</option>";
	}	
echo"</select>";	
mysql_close($con);
?>