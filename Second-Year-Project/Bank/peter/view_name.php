<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Description:			Drop down list - includes customer names with deposit accounts	only.	
						List used in view_deposit_ac.html.php
-->

<?php

include '../common/db.inc.php';			// connection to Bank database

date_default_timezone_set('Europe/London');			// set time to database format


$sql = "SELECT customer.customerNumber, firstName, surname,address1,address2,address_town,address_county,birthDate, accountHolder.accountNumber, balance 
		FROM customer, accountHolder, depositAccount
		WHERE customer.customerNumber = accountHolder.customerNumber and accountHolder.accountNumber = depositAccount.accountNumber
		ORDER BY surname desc";


if(!$result = mysql_query($sql,$con)) 		// check if query is correct
	{
		die('Error in querying the database' . mysql_error());
	}
	
	
	echo "<select name = 'nameListbox' id = 'nameListbox' onclick = 'fillBox()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$reverseName = $row['surname'].", ". $row['firstName'];
		$dob = $row['birthDate'];
		$dob = date("Y-m-d", strtotime($dob));
		$address = $row['address1'] . "<br>" . $row['address2'] . "<br>" . $row['address_town'] . "<br>" . $row['address_county'];		// concatenate address to one string
		$account = $row['accountNumber'];
		$balance = $row['balance'];
		$display = "$id#$name#$address#$dob#$account#$balance";
		
		
		echo "<option value = '$display'>$reverseName </option>";
	}
	
	echo "</select>";
	
	
	mysql_close($con);

?>