<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

$sql = "SELECT DISTINCT customer.customerNumber, accountHolder.accountNumber, firstName, surname, address1, address2, address_town, address_county, telephone, accountHolder.accountType, currentAccount.closed, depositAccount.closed 
		FROM customer, accountHolder, currentAccount, depositAccount 
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountType != 'loan' AND currentAccount.closed ='0'";
	
if(!$result = mysql_query($sql,$con))
	{
		die('Error in query' . mysql_error());
	}

echo "<select name = 'listbox' id='listbox' onclick='Withdraw(this)'";
echo "<br><option id='-1' selected disabled hidden value ='&nbsp;,</br>,</br>,</br>'></option>";
$lastID = '-1';

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Name = $row['firstName'] . " " . $row['surname'];
		$Home = $row['address1'] ."<br>" . $row['address2']  ."<br>" . $row['address_town'] ."<br>" . $row['address_county'];
		$Phone = $row['telephone'];
		$Type = $row['accountType'];
		$Account = $row['accountNumber'];
		
		$display ="$ID,$Name,$Home,$Phone";
		
		if($ID == $lastID)
		{	
			echo"<option id='$ID' value = '$display' hidden>$Name</option>";
		}
		else
		{
			echo"<option id='$ID' value = '$display'>$Name</option>";
		}
		$lastID = $ID;
	}
echo"</select>";	
mysql_close($con);
?>