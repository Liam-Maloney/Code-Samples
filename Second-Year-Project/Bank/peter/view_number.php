<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Description:			Drop down list - includes customer numbers of deposit accounts	only.	
						List used in view_deposit_ac.html.php
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
	
	
	echo "<select name = 'listbox' id = 'listbox' onclick = 'viewNumber()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$dob = $row['birthDate'];
		$dob = date("Y-m-d", strtotime($dob));
		$address = $row['address1'] . "<br>" . $row['address2'] . "<br>" . $row['address_town'] . "<br>" . $row['address_county'];		// concatenate address to one string
		$account = $row['accountNumber'];
		$balance = $row['balance'];
		$display = "$id#$name#$address#$dob#$account#$balance";
		
		
		echo "<option value = '$display'>$id</option>";
	}
	
	echo "</select>";
		
	mysql_close($con);

?>

<script>

	function viewNumber() 
	{
			// -------------- populate the deposit account details ----------------------------------
			var details = document.getElementById("interest_box");
			var result = details.options[details.selectedIndex].value;
			var accountDetails = result.split('#');
	
			document.getElementById("accountIdDIV").innerHTML = accountDetails[0];		// account number
			document.getElementById("accountID").value = accountDetails[0];
		
			document.getElementById("balanceDIV").innerHTML = accountDetails[1];
			document.getElementById("balance").value = accountDetails[1];

			// -------------- populate the customer details ----------------------------------
			var details2 = document.getElementById("listbox");
			var result = details.options[details.selectedIndex].value;
			var customerDetails = result.split('#');
	
			document.getElementById("customerIdDiv").innerHTML = customerDetails[2];
			document.getElementById("customerId").value = customerDetails[2];
	
	
			document.getElementById("customerNameDiv").innerHTML = customerDetails[3];
			document.getElementById("customerName").value = customerDetails[3];
	
	
			document.getElementById("customerAddressDiv").innerHTML = customerDetails[4];
			document.getElementById("customerAddress").value = customerDetails[4];
			
			document.getElementById("customerDOBDiv").innerHTML = customerDetails[5];
			document.getElementById("customerDOB").value = customerDetails[5];
	}

</script>

