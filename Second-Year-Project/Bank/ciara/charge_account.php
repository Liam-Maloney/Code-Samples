<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

$sql = "SELECT customer.customerNumber, accountHolder.accountNumber, accountType, balance, overdraftLimit, rate.rate, description
		FROM customer, accountHolder, currentAccount, rate
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountNumber = currentAccount.accountNumber AND accountHolder.accountType = 'Current'
		AND customer.deleted ='0' AND description ='Overdraft charge rate'";		
		
if(!$result = mysql_query($sql,$con))
	{
		die('Error can not go through with withdrawals query' . mysql_error());
	}

echo "<select name='Accountlist' id='Accountlist' onchange='showCharge()' onclick='disabled=false'  >";
echo "<br><option id='-1' selected disabled hidden value ='</br>,</br>'></option>";

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Account = $row['accountNumber'];
		$Bal =$row['balance'];
		$Limit =$row['overdraftLimit'];
		$Rates =$row['rate'];
		$Type = $row['accountType'];
		
		$Limit = '($Limit * -1)';
		
		if($Bal <= 0)
		{
			$Details ="$ID,$Account,$Bal,$Rates";
			echo"<option id='$ID' value ='$Details' hidden>$Type $Account</option>";
		}
	}	
echo"</select>";	
mysql_close($con);
?>