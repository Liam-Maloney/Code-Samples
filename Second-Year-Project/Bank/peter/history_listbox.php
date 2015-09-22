<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Description:			Drop down list to only include deposit accounts	
						Used in deposit_ac_history.html.php
						
						NOTE: JAVASCRIPT INCLUDED IN FILE
								
-->

<?php

include '../common/db.inc.php';			// connection to Bank database

date_default_timezone_set('Europe/London');			// set time to database format
	
/*
	$sql = "SELECT DISTINCT customer.customerNumber, firstName, surname,address1,address2,address_town,address_county,birthDate, accountHolder.accountNumber, balance 
		FROM customer, accountHolder, depositAccount
		WHERE customer.customerNumber = accountHolder.customerNumber and accountHolder.accountNumber = depositAccount.accountNumber
		ORDER BY surname desc";
*/
	$sql  ="SELECT distinct depositAccount.accountNumber,balance,accountHolder.customerNumber,firstName,surname,firstName, surname,address1,address2,address_town,address_county,birthDate
			FROM depositAccount, accountHolder, customer
			WHERE depositAccount.accountNumber = accountHolder.accountNumber
			ORDER BY depositAccount.accountNumber desc;";
	
	if(!$result = mysql_query($sql,$con)) 		// check if query is correct
	{
		die('Error in querying the database' . mysql_error());
	}
	
	
	echo "<select name = 'historybox' id = 'historybox' onclick = 'fillHistory()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$account = $row['accountNumber'];
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$display = "$account#$id#$name";
		
		echo "<option value = '$display'>$account</option>";
	}
	
	echo "</select>";
		
	mysql_close($con);

?>

<script>

	function fillHistory() 
	{
			// -------------- populate customer details on screen ----------------------------------
			
			var details = document.getElementById("historybox");
			var result = details.options[details.selectedIndex].value;
			var customerDetails = result.split('#');
	
			document.getElementById("customerIdDiv").innerHTML = customerDetails[1];
			document.getElementById("customerId").value = customerDetails[1];
	
	
			document.getElementById("customerNameDiv").innerHTML = customerDetails[2];
			document.getElementById("customerName").value = customerDetails[2];
	
	
	}

</script>