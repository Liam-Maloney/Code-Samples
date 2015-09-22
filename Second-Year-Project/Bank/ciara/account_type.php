<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

$sql = "SELECT customerNumber, customerAccounts.accountNumber, accountType, balance 
		FROM currentAccount 
		INNER JOIN (SELECT DISTINCT customer.customerNumber, accountHolder.accountNumber, accountHolder.accountType 
		FROM customer, accountHolder 
		WHERE (customer.customerNumber = accountHolder.customerNumber) AND customer.deleted ='0') as customerAccounts ON accountType = 'CURRENT' AND customerAccounts.accountNumber = currentAccount.accountNumber 
		UNION DISTINCT SELECT customerNumber, customerAccounts.accountNumber, accountType, balance 
		FROM depositAccount 
		INNER JOIN (SELECT DISTINCT customer.customerNumber, accountHolder.accountNumber, accountHolder.accountType 
		FROM customer, accountHolder 
		WHERE (customer.customerNumber = accountHolder.customerNumber) AND customer.deleted ='0') as customerAccounts ON customerAccounts.accountType = 'deposit' AND customerAccounts.accountNumber = depositAccount.accountNumber";		

if(!$result = mysql_query($sql,$con))
	{
		die('Error can not go through with withdrawals query' . mysql_error());
	}

echo "<select name='Accountlist' id='Accountlist' onclick='showBal()'>";
echo "<br><option id='-1' selected disabled hidden value ='</br>,</br>'></option>";

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Account = $row['accountNumber'];
		$Type =$row['accountType'];
		$Limit =$row['overdraftLimit'];
		
		//these if statements ensure the correct variable go into detals later
		if($Type == 'Current')
		{					
			$Type = 'current'; //the capital C causes a problem when entering into the database later this fixes it
			$Bal =$row['balance'];
			$Limit =$row['overdraftLimit'];
		}
		else if($Type == 'deposit')
		{		
			$Bal =$row['balance'];
			$Limit = '0';//since deposit account do not have a overdraft limit $limit is set to zero
		}
		//this if statements stop loan accounts from end up in the list  
		if($Type != 'loan')
		{
			$Details ="$ID,$Account,$Type,$Bal";
			echo"<option id='$ID' value ='$Details' hidden>$Type $Account</option>";
		}
	}	
echo"</select>";	
mysql_close($con);
?>