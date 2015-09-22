
<!--
Group:					BANK
Student Number:			C00186095
Student Name:			CIARA MCMAHON						
Description:			Drop down list to only include deposit accounts	
						Used in calcint_deposit_ac.html.php
								close_deposit_ac.html.php
								
						NOTE: JAVASCRIPT INCLUDED IN FILE
-->

<?php

include '../common/db.inc.php';

date_default_timezone_set('Europe/London');			// set time to database format

	// Query to slect deposit accounts from bank database
	$sql  ="SELECT distinct depositAccount.accountNumber,balance,accountHolder.customerNumber,firstName,surname,firstName, surname,address1,address2,address_town,address_county,birthDate
			FROM depositAccount, accountHolder, customer
			WHERE depositAccount.accountNumber = accountHolder.accountNumber
			ORDER BY depositAccount.accountNumber desc;";
	// error check query
	if(!$result = mysql_query($sql,$con)) 	
	{
		die('Error in querying the database' . mysql_error());
	}
	
	// display listbox of deposit accounts
	echo "<select name = 'interest_box' id = 'interest_box' onclick = 'fillList()'>";
	
	
	while($row = mysql_fetch_array($result))
	{
		$account = $row['accountNumber'];
		$balance = $row['balance'];
		$id = $row['customerNumber'];
		$name = $row['firstName'] . " " .  $row['surname'];
		$reverseName = $row['surname'].", ". $row['firstName'];
		$dob = $row['birthDate'];
		$dob = date("Y-m-d", strtotime($dob));
		$address = $row['address1'] . "<br>" . $row['address2'] . "<br>" . $row['address_town'] . "<br>" . $row['address_county'];
		
		$display = "$account#$balance#$id#$name#$address#$dob";
		
		echo "<option value = '$display'>$account</option>";
	}
	
	echo "</select>";
	
	
	
	mysql_close($con);	// close connection to bank database

?>

<script>

	function fillList() 
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
			var details2 = document.getElementById("nameListbox");
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
