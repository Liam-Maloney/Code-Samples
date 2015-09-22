<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

date_default_timezone_set('Europe/London');
$sql = "SELECT customer.customerNumber, firstName, surname, address1, address2, address_town ,address_county, birthDate, accountHolder.accountNumber, balance, overdraftLimit 
		FROM customer, accountHolder, currentAccount
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountNumber = currentAccount.accountNumber AND currentAccount.closed = '0' AND customer.deleted =0
		ORDER BY surname desc";

if(!$result = mysql_query($sql,$con))
	{
		die('Error in query' . mysql_error());
	}

echo "<select name = 'listbox' id='listbox' onclick='closing(this)' onclick='disabled=true'";
echo "<br><option id='-1' selected disabled hidden value ='&nbsp;,&nbsp;,&nbsp;,</br>,</br>,</br>'></option>";

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Name = $row['firstName'] . $row['surname'];
		$RName = $row['surname'] . " " .$row['firstName'];
		$dob = date("D-m-y");
		$Home = $row['address1'] ."<br>" . $row['address2']  ."<br>" . $row['address_town'] ."<br>" . $row['address_county'];
		$Account =$row['accountNumber'];
		$Bal =$row['balance'];
		$Limit =$row['overdraftLimit'];
		
		$display ="$ID,$Name,$Home,$dob,$Account,$Bal,$Limit";
		echo"<option id='$ID' value = '$display'>$RName</option>";
	}	
echo"</select>";	

mysql_close($con);
?>
