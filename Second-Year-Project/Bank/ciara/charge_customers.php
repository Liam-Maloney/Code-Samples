<?php
include '../common/db.inc.php';
date_default_timezone_set('Europe/London');

$sql = "SELECT customer.customerNumber, firstName, surname,  address1, address2, address_town ,address_county, telephone, accountHolder.accountNumber
		FROM customer, accountHolder, currentAccount
		WHERE customer.customerNumber = accountHolder.customerNumber AND accountHolder.accountNumber = currentAccount.accountNumber AND currentAccount.closed = '0' AND customer.deleted =0
		ORDER BY surname desc";

if(!$result = mysql_query($sql,$con))
	{
		die('Error in query' . mysql_error());
	}

echo "<select name = 'listbox' id='listbox' onclick='Charge()'";
echo "<br><option id='-1' selected disabled hidden value ='&nbsp;,</br>,</br>,</br>'></option>";
$lastID = '-1';

while($row = mysql_fetch_array($result))
	{
		$ID= $row['customerNumber'];
		$Name = $row['firstName'] . " " . $row['surname'];
		$Home = $row['address1'] ."<br>" . $row['address2']  ."<br>" . $row['address_town'] ."<br>" . $row['address_county'];
		$Phone = $row['telephone'];
		
		$display ="$ID,$Name,$Home, $Phone";
				
		if($ID == $lastID)
		{	
			echo"<option id='$ID' value='$display' hidden>$Name</option>";
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